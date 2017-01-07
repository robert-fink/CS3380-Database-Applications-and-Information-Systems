<!--
Robert Fink
CS3380
lab5
-->

<!DOCTYPE html>
<html>
<head>
    <title>rwfwcb Lab5</title>
    <style>
        table{
            border = 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<form action="<?=$_SERVER['lab5.php']?>" method="POST">
    <select name="query">
        <option value="1">District & Population of all cities named Springfield</option>

        <option value="2">City name, District, and Population of each city in Brazil</option>

        <option value="3">Country Name, Continent, and Surface Area of 20 smallest countries</option>

        <option value="4">Country Name, Continent, Form of Goverment, and GNP where GNP is greater than 200,000</option>

        <option value="5">10th through 19th Best Life Expectancy Rates</option>

        <option value="6">All City names that start with `B` and end with `s`</option>

        <option value="7">City Name, Name of Country, and City Population greater than 6,000,000. Most populous to least populous</option>

        <option value="8">Country Name, Independence Year, and Region of all countries where English is the official language</option>

        <option value="9">Capital City Name, and Percentage of Population that lives in the Capital City</option>

        <option value="10">All Official Languages, the Country for which it is spoken, and the Number of speakers</option>

        <option value="11">Country Name, Region, GNP, old GNP, and real change in GNP</option>
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
        $sql = "SELECT Name, District, Population FROM City WHERE Name='Springfield' ORDER BY Population DESC";
    }
    elseif ($varQuery==2){
        $sql = "SELECT Name, District, Population FROM City WHERE CountryCode='BRA' ORDER BY Name ASC";
    }
    elseif ($varQuery==3){
        $sql = "SELECT Name, Continent, SurfaceArea FROM Country ORDER BY SurfaceArea ASC LIMIT 20"; 
    }
    elseif ($varQuery==4){
        $sql = "SELECT Name, Continent, GovernmentForm, GNP FROM Country WHERE GNP>200000 ORDER BY Name ASC"; 
    }
    elseif ($varQuery==5){
        $sql = "SELECT Name, LifeExpectancy FROM Country WHERE LifeExpectancy IS NOT NULL ORDER BY LifeExpectancy DESC LIMIT 10 OFFSET 9";
    }
    elseif ($varQuery==6){
        $sql = "SELECT Name FROM City WHERE Name LIKE 'B%s' ORDER BY Population DESC"; 
    }
    elseif($varQuery==7){
        $sql = "SELECT CI.Name AS cityname, CO.Name AS countryname, CI.Population FROM City AS CI INNER JOIN Country AS CO ON CI.CountryCode=CO.Code WHERE CI.Population >6000000 ORDER BY CI.Population DESC";
    }
    elseif($varQuery==8){
        $sql = "SELECT CO.Name, CO.IndepYear, CO.Region FROM CountryLanguage AS CL INNER JOIN COUNTRY AS CO ON CO.Code=CL.CountryCode WHERE CL.Language='English' AND CL.IsOfficial='T' ORDER BY CO.Region, CO.Name";
    }
    elseif($varQuery==9){
        $sql = "SELECT CI.Name, CO.Population/CI.Population AS PercentLivingInCapital FROM City AS CI INNER JOIN Country AS CO ON CO.Capital=CI.ID ORDER BY PercentLivingInCapital DESC";
    }
    elseif($varQuery==10){
        $sql = "SELECT CL.Language, CO.Name, CO.Population, CL.Percentage*CO.Population/100 AS PercentageOfSpeakers FROM CountryLanguage AS CL INNER JOIN Country AS CO ON CO.Code=CL.CountryCode WHERE CL.IsOfficial='T' ORDER BY CL.Percentage*CO.Population DESC";   
    }
    elseif ($varQuery==11){
        $sql = "SELECT Name, Region, GNP, GNPOld, (GNP-GNPOld)/GNPOld AS RealChangeInGNP FROM Country WHERE GNP IS NOT NULL AND GNPOld IS NOT NULL ORDER BY RealChangeInGNP DESC";
    }    
    else{
        echo "Select a query from the dropbox!";
    }
}

    //execute query
    $result = mysqli_query($link, $sql) or die("Query Error " . mysqli_error($link));;
   
    //display result
    printf("Query returned %d rows.<br><br>", mysqli_num_rows($result));

    if ($varQuery==1){
        //print table header
        echo "<table><tr><th>Name</th><th>District</th><th>Population</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["District"]."</td><td>".$row["Population"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif ($varQuery==2){
        //print table header
        echo "<table><tr><th>Name</th><th>District</th><th>Population</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["District"]."</td><td>".$row["Population"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif ($varQuery==3){
        //print table header
        echo "<table><tr><th>Name</th><th>Continent</th><th>Surface Area</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["Continent"]."</td><td>".$row["SurfaceArea"]."</td></tr>";
        }
        echo "</table>";        
    }
    elseif ($varQuery==4){
        //print table header
        echo "<table><tr><th>Name</th><th>Continent</th><th>Form of Government</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["Continent"]."</td><td>".$row["GovernmentForm"]."</td></tr>";
        }
        echo "</table>";

    }
    elseif ($varQuery==5){
        //print table header
        echo "<table><tr><th>Name</th><th>Life Expectancy</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["LifeExpectancy"]."</td></tr>";
        }
        echo "</table>";        
    }
    elseif ($varQuery==6){
        //print table header
        echo "<table><tr><th>Name</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif($varQuery==7){
        //print table header
        echo "<table><tr><th>City</th><th>Country</th><th>City Population</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["cityname"]."</td><td>".$row["countryname"]."</td><td>".$row["Population"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif($varQuery==8){
        //print table header
        echo "<table><tr><th>Name</th><th>Independence Year</th><th>Region</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["IndepYear"]."</td><td>".$row["Region"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif($varQuery==9){
        //print table header
        echo "<table><tr><th>Capital City Name</th><th>Percentage of Population Living in the Capital City </th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["PercentLivingInCapital"]."</td></tr>";
        }
        echo "</table>";
    }
    elseif($varQuery==10){
        //print table header
        echo "<table><tr><th>Official Languages</th><th>Country Spoken</th><th># of Speakers</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Language"]."</td><td>".$row["Name"]."</td><td>".$row["PercentageOfSpeakers"]."</td></tr>";
        }
        echo "</table>";        
    }
    elseif ($varQuery==11){
        //print table header
        echo "<table><tr><th>Name</th><th>Region</th><th>GNP</th><th>old GNP</th><th>Real Change in GNP</th>";
        
        //print rows of data
        while($row = mysqli_fetch_array($result)){
           echo "<tr><td>".$row["Name"]."</td><td>".$row["Region"]."</td><td>".$row["GNP"]."</td><td>".$row["GNPOld"]."</td><td>".$row["RealChangeInGNP"]."</td></tr>";
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