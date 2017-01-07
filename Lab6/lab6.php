<!--
Robert Fink
CS3380
lab6
-->

<!DOCTYPE html>
<html>
<head>
    <title>rwfwcb Lab6</title>
    <style>
        table{
            border = 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<form action="<?=$_SERVER['lab6.php']?>" method="POST">
    <select name="query">
        <option value="1">Show Person's ID, First Name, and Last Name for all people who have a body weight above 140</option>

        <option value="2">Show the First Name, Last Name and BMI for people with a weight above 150</option>

        <option value="3">Show the name and city of the university that has no people in database</option>

        <option value="4">Show the University ID (UID), First and Last Names of students going to school in Columbia</option>

        <option value="5">Show all activities that were NOT participated in</option>

        <option value="6">Show the Person's ID that participated in running or racquetball</option>

        <option value="7">Show the First and Last Names of all people in the body composition table that are older than 30 years and taller than 65 inches</option>

        <option value="8">Show the First and Last Names, Weight, Height, and Age of all people</option>
    </select> 
    <input type="submit" name="formSubmit" value="Submit">    
</form>
    
<?php
//connection
$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b94636c22a5fb4", "e48ac185", "cs3380-rwfwcb") or die("Connect Error " . mysqli_error($link));

if(isset($_POST['formSubmit'])) {
    //get query variable post form submit
    $varQuery = $_POST['query'];
    
    //determine what query user selected
    if ($varQuery==1){
        $sql = "SELECT * FROM weight";
    }
    elseif ($varQuery==2){
        $sql = "SELECT * FROM bmi";
    }
    elseif ($varQuery==3){
        $sql = "SELECT U.university_name, U.city 
FROM university AS U 
WHERE NOT EXISTS (SELECT * FROM person WHERE U.uid = person.uid)"; 
    }
    elseif ($varQuery==4){
        $sql = "SELECT uid, fname, lname
FROM person 
WHERE uid IN (SELECT uid FROM university WHERE city='Columbia')"; 
    }
    elseif ($varQuery==5){
        $sql = "SELECT activity_name 
FROM activity 
WHERE activity_name NOT IN (SELECT activity_name FROM participated_in)";
    }
    elseif ($varQuery==6){
        $sql = "SELECT pid FROM participated_in WHERE activity_name='running'
UNION
SELECT pid FROM participated_in WHERE activity_name='racquetball'"; 
    }
    elseif($varQuery==7){
        $sql = "SELECT fname, lname FROM person AS P JOIN body_composition AS BC ON P.pid=BC.pid WHERE BC.age>30 AND BC.height>65";
    }
    elseif($varQuery==8){
        $sql = "SELECT fname, lname, weight, height, age FROM person as P JOIN body_composition as BC ON P.pid=BC.pid ORDER BY height DESC, weight ASC, lname ASC";
    }   
    else{
        echo "Select a query from the dropbox!";
    }
}

    //execute query
    $result = mysqli_query($link, $sql) or die("Select a query" . mysqli_error($link));;
   
    //display result
    printf("Query returned %d rows.<br><br>", mysqli_num_rows($result));

    if ($varQuery==1){
        //print table header
        echo "<table><tr><th>Person ID</th><th>First Name</th><th>Last Name</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["pid"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif ($varQuery==2){
        //print table header
        echo "<table><tr><th>First Name</th><th>Last Name</th><th>BMI</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["theBMI"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif ($varQuery==3){
        //print table header
        echo "<table><tr><th>University Name</th><th>City</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["university_name"]."</td><td>".$row["city"]."</td></tr>";
        }
        echo "</table>";        
    }
    elseif ($varQuery==4){
        //print table header
        echo "<table><tr><th>Univ. ID</th><th>First Name</th><th>Last Name</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["uid"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif ($varQuery==5){
        //print table header
        echo "<table><tr><th>Activity Name</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["activity_name"]."</td></tr>";
        }
        echo "</table>";        
    }
    elseif ($varQuery==6){
        //print table header
        echo "<table><tr><th>Person ID</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["pid"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif($varQuery==7){
        //print table header
        echo "<table><tr><th>First Name</th><th>Last Name</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif($varQuery==8){
        //print table header
        echo "<table><tr><th>First Name</th><th>Last Name</th><th>Weight</th><th>Height</th><th>Age</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["weight"]."</td><td>".$row["height"]."</td><td>".$row["age"]."</td></tr>";
        }
        echo "</table>";
    }
    
// Free result set
mysqli_free_result($result);

//Close MySQL connection
mysqli_close($link);
?>
    
</body>
</html>