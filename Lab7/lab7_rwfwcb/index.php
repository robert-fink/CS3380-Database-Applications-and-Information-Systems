<!-- Robert Fink
	 rwfwcb
     CMP_SC 3380
-->
<!DOCTYPE html>
<html>

<head>
	<title></title>

    <style>
        button{
            text-align: center;
        }
        .form1{
            text-align: center;
        }
				th td.table{
					width: auto;
					padding: 15px;
					text-align: center;
				}


    </style>
</head>

<body>

    <form action="<?=$_SERVER['index.php']?>" class="form1" method="POST">
			<div>
				<input type="radio" name="searchType" value="city" checked> City
        <input type="radio" name="searchType" value="country"> Country
        <input type="radio" name="searchType" value="language"> Language <br>
			</div>
        <br>
			<div>
        <input type="text" name="searchInput" placeholder="Enter search criteria">
        <input type="submit" value="Submit">
    </form>
    <button><a href="insert.php">Insert into City</a></button>
	</div>
    <hr>

    <?php
    /* make connection */
    $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b94636c22a5fb4", "e48ac185", "cs3380-rwfwcb");

    /* check connection */
    if (!$link){
        printf("Connect failed: %s\n", mysqli_connect_error());
    }

    //print_r($_POST); this prints everything in $_POST variable
    if(isset($_POST['searchType'])) {

        $varQuery = $_POST['searchType'];
        $userSearch = $_POST['searchInput'] . '%';

        /* if City radio selected */
        if($varQuery == "city"){

            /* create a prepared statement */
            		if($stmt = mysqli_prepare($link, "SELECT * FROM city WHERE name LIKE ? ORDER BY name ASC")){

                /* bind parameters for mark */
                mysqli_stmt_bind_param($stmt, "s", $userSearch);

                /* execute query */
                mysqli_stmt_execute($stmt);

								/* store result */
								mysqli_stmt_store_result($stmt);
								printf("Query returned %d rows.<br><br>", mysqli_stmt_num_rows($stmt));

                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $ID, $Name, $CountryCode, $District, $Population);

								/* print the number of results returned */

                /* print headers */
                echo "<table><thead><tr><th></th><th></th><th>ID</th><th>Name</th><th>Country Code</th><th>District</th><th>Population</th></tr></thead>";

                /* print output */
                while (mysqli_stmt_fetch($stmt)){
									?>
									<form action="update.php" method="POST">
										<input type="hidden" name="table" value="city">
										<input type="hidden" name="ID" value="<?=$ID?>">
										<input type="hidden" name="Name" value="<?=$Name?>">
										<input type="hidden" name="CountryCode" value="<?=$CountryCode?>">
										<tr>
											<td><input type="submit" name="update" value="Update"></td>
									</form>

									<form action="delete.php" method="POST">
										<input type="hidden" name="deleter" value="<?=$ID?>">
										<td><input type="submit" name="delete" value="Delete"></td>
									</form>

										<?php
                    echo "<td>".$ID."</td><td>".$Name."</td><td>".$CountryCode."</td><td>".$District."</td><td>".$Population."</td></tr>";
                }
                echo "</table>";

                /* close statement */
                mysqli_stmt_close($stmt);

            }

            /* close connection */
            mysqli_close($link);
        }

        /* if Country radio selected */
        if($varQuery == "country"){

            /* create a prepared statement */
            if ($stmt = mysqli_prepare($link, "SELECT * FROM country WHERE name LIKE ? ORDER BY name ASC")){

                /* bind parameters for mark */
                mysqli_stmt_bind_param($stmt, "s", $userSearch);

                /* execute query */
                mysqli_stmt_execute($stmt);

								/* store result */
								mysqli_stmt_store_result($stmt);
								printf("Query returned %d rows.<br><br>", mysqli_stmt_num_rows($stmt));

                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $Code, $Name, $Continent, $Region, $SurfaceArea, $IndepYear, $Population, $LifeExpectancy, $GNP, $GNPOld, $LocalName, $GovernmentForm, $HeadOfState, $Capital, $Code2);

                /* print headers */
                echo "<table><thead><tr><th></th><th></th><th>Code</th><th>Name</th><th>Continent</th><th>Region</th><th>Surface Area</th><th>Independence Year</th><th>Population</th><th>LifeExpectancy</th><th>GNP</th><th>GNP Old</th><th>Local Name</th><th>Government Form</th><th>Head of State</th><th>Capital</th><th>Code 2</th></tr></thead>";

                /* print output */
                while (mysqli_stmt_fetch($stmt)){
									?>
									<form action="update.php" method="POST">
										<input type="hidden" name="table" value="country">
										<input type="hidden" name="Code" value="<?=$Code?>">
										<input type="hidden" name="Name" value="<?=$Name?>">
										<input type="hidden" name="Continent" value="<?=$Continent?>">
										<input type="hidden" name="Region" value="<?=$Region?>">
										<input type="hidden" name="SurfaceArea" value="<?=$SurfaceArea?>">
										<input type="hidden" name="IndepYear" value="<?=$IndepYear?>">
										<input type="hidden" name="Population" value="<?=$Population?>">
										<input type="hidden" name="LifeExpectancy" value="<?=$LifeExpectancy?>">
										<input type="hidden" name="GNP" value="<?=$GNP?>">
										<input type="hidden" name="GNPOld" value="<?=$GNPOld?>">
										<input type="hidden" name="LocalName" value="<?=$LocalName?>">
										<input type="hidden" name="GovernmentForm" value="<?=$GovernmentForm?>">
										<input type="hidden" name="HeadOfState" value="<?=$HeadOfState?>">
										<input type="hidden" name="Capital" value="<?=$Capital?>">
										<input type="hidden" name="Capital" value="<?=$Code2?>">
										<tr>
											<td><input type="submit" name="update" value="Update"></td>
									</form>

									<form action="delete.php" method="POST">
										<input type="hidden" name="deleter" value="<?=$Code?>">
										<td><input type="submit" name="delete" value="Delete"></td>
									</form>

									<?php
                    echo "<td>".$Code."</td><td>".$Name."</td><td>".$Continent."</td><td>".$Region."</td><td>".$SurfaceArea."</td><td>".$IndepYear."</td><td>".$Population."</td><td>".round($LifeExpectancy, 4)."</td><td>".$GNP."</td><td>".$GNPOld."</td><td>".$LocalName."</td><td>".$GovernmentForm."</td><td>".$HeadOfState."</td><td>".$Capital."</td><td>".$Code2."</td>";
                }
                echo "</table>";

                /* close statement */
                mysqli_stmt_close($stmt);
            }

            /* close connection */
            mysqli_close($link);
        }

        /* if Language radio selected */
        if($varQuery == "language"){

            /* create a prepared statement */
            if ($stmt = mysqli_prepare($link, "SELECT * FROM CountryLanguage WHERE Language LIKE ? ORDER BY Language ASC")){

                /* bind parameters for mark */
                mysqli_stmt_bind_param($stmt, "s", $userSearch);

                /* execute query */
                mysqli_stmt_execute($stmt);

								/* store result */
								mysqli_stmt_store_result($stmt);
								printf("Query returned %d rows.<br><br>", mysqli_stmt_num_rows($stmt));

                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $CountryCode, $Language, $IsOfficial, $Percentage);

                /* print headers */
                echo "<table><thead><tr><th></th><th></th><th>Country Code</th><th>Language</th><th>Is Official</th><th>Percentage</th></tr></thead>";

                /* print output */
                while (mysqli_stmt_fetch($stmt)){
									?>
									<form action="update.php" method="POST">
										<input type="hidden" name="table" value="language">
										<input type="hidden" name="CountryCode" value="<?=$CountryCode?>">
										<input type="hidden" name="Language" value="<?=$Language?>">
										<input type="hidden" name="IsOfficial" value="<?=$IsOfficial?>">
										<input type="hidden" name="Percentage" value="<?=$Percentage?>">
										<tr>
											<td><input type="submit" name="update" value="Update"></td>
									</form>

									<form action="delete.php" method="POST">
										<input type="hidden" name="deleter" value="<?=$CountryCode?>">
										<td><input type="submit" name="delete" value="Delete"></td>
									</form>

									<?php
                    echo "<td>".$CountryCode."</td><td>".$Language."</td><td>".$IsOfficial."</td><td>".$Percentage."</td>";
                }
                echo "</table>";

                /* close statement */
                mysqli_stmt_close($stmt);
            }

            /* close connection */
            mysqli_close($link);
        }
    }
    ?> <!-- end of php -->
    </body>
