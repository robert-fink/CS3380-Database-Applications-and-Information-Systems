<?php
//connect to db
$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b94636c22a5fb4", "e48ac185", "cs3380-rwfwcb");

//display non-editable textbox for attribute $key
function printNonEditable($key) {
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."' readonly>";
	echo "</div>";
}

//display editable textbox for attribute $key
function printInput($key) {
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='text' name='".$key."' value='".$_POST[$key]."' required>";
	echo "</div>";
}

//display editable textbox for numeric attribute $key
function printNumeric($key) {
	echo "<div class='form-group'>";
	echo "<label class='inputdefault'>".$key."</label>";
	echo "<input class='form-control' type='number' name='".$key."' value='".$_POST[$key]."' required>";
	echo "</div>";
}


//editable form for records from the city table
function displayCity() {
	echo "<form action='update.php' method='POST' >";
	echo "<input type='hidden' name='table' value='city'>";
	printNonEditable('ID');
	printNonEditable('Name');
	printNonEditable('CountryCode');
	printInput('District');
	printNumeric('Population');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Back to Index</a>";
	echo "</form>";
}

//editable form for records from the country table
function displayCountry() {
	echo "<form action='update.php' method='POST' >";
	echo "<input type='hidden' name='table' value='country'>";
	printNonEditable('Code');
	printNonEditable('Name');
	printNonEditable('Continent');
	printNonEditable('Region');
	printNonEditable('SurfaceArea');
	printNumeric('IndepYear');
	printNumeric('Population');
	printNonEditable('LifeExpectancy');
	printNonEditable('GNP');
	printNonEditable('GNPOld');
	printInput('LocalName');
	printInput('GovernmentForm');
	printNonEditable('HeadOfState');
	printNonEditable('Capital');
	printNonEditable('Code2');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Back to Index</a>";
	echo "</form>";
}

function displayLanguage() {
	echo "<form action='update.php' method='POST' >";
	echo "<input type='hidden' name='table' value='language'>";
	printNonEditable('CountryCode');
	printNonEditable('Language');
	//echo "<h4>isOfficial<br><br>";
	//echo "<div><input type='radio' name='isOfficial' value='T'> T</div>";
	//echo "<div><input type='radio' name='isOfficial' value='F'> F</div>";
	printNumeric('Percentage');
	echo "<input class='btn btn-info' type='submit' name='save' value='Save'>";
	echo "<a class='btn btn-danger' href='index.php'>Back to Index</a>";
	echo "</form>";
}

//no table was provided, display error message
function fail() {
	header("Location: fail.php");
}

function saveCity() {
	global $link;
	$sql = "UPDATE city SET District=?, Population=? WHERE id=?";
	if ($stmt = mysqli_prepare($link, $sql)) {//prepare successful
		mysqli_stmt_bind_param($stmt, "sss", $_POST['District'], $_POST['Population'], $_POST['ID']) or die("bind param");
		if(mysqli_stmt_execute($stmt)) {//execute successful
			echo "<h2>Successfully Saved Record</h2>";
		} else {
			fail();
		}
	} else { //prepare failed
		fail();
	}
}

function saveCountry() {
	global $link;
	$sql = "UPDATE country SET IndepYear=?, Population=?, LocalName=?, GovernmentForm=? WHERE code=?";
	if ($stmt = mysqli_prepare($link, $sql)) {//prepare successful
		mysqli_stmt_bind_param($stmt, "sssss", $_POST['IndepYear'], $_POST['Population'], $_POST['LocalName'], $_POST['GovernmentForm'], $_POST['code']) or die("bind param");
		if(mysqli_stmt_execute($stmt)) {//execute successful
			echo "<h2>Successfully Saved Record</h2>";
		} else {
			fail();
		}
	} else { //prepare failed
		fail();
	}
}

function saveLanguage() {
	global $link;
	$sql = "UPDATE language SET isOfficial=?, Percentage=? WHERE CountryCode=?";
	if ($stmt = mysqli_prepare($link, $sql)) {//prepare successful
		mysqli_stmt_bind_param($stmt, "sss", $_POST['isOfficial'], $_POST['Percentage'], $_POST['CountryCode']) or die("bind param");
		if(mysqli_stmt_execute($stmt)) {//execute successful
			echo "<h2>Successfully Saved Record</h2>";
		} else {
			fail();
		}
	} else { //prepare failed
		fail();
	}
}


?>

<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">

<?php

	if(isset($_POST['update'])) {//submit came from index.php
		if(isset($_POST['table'])) {//do we have table information?
			switch($_POST['table']) {//what table are we updating
				case "city":
					echo "<h2>Edit City Record</h2>";
					displayCity();
					break;

				case "country":
					echo "<h2>Edit Country Record</h2>";
					displayCountry();
					break;

				case "language":
					echo "<h2>Edit Language Record</h2>";
					displayLanguage();
					break;

				default:
					fail();
					break;
			}
		}
	}

	else if(isset($_POST['save'])) {//submit came from request to save form data
		if(isset($_POST['table'])) {//do we have table information?
			switch($_POST['table']) {//what table are we updating
				case "city":
					echo "<h2>Edit City Record</h2>";
					displayCity();
					saveCity();
					break;

				case "country":
					echo "<h2>Edit Country Record</h2>";
					displayCountry();
					saveCountry();
					break;

				case "language":
					echo "<h2>Edit Language Record</h2>";
					displayLanguage();
					saveLanguage();
					break;

				default:
					//Failed
					fail();
					break;
			}
		}
	}

	/* close connection */
	mysqli_close($link);
?>
		</div>
	</body>
</html>
