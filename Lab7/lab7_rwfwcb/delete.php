<!-- Robert Fink
	 rwfwcb
     CMP_SC 3380
-->
<!DOCTYPE html>
<html>

<head>
	<title> 	</title>
</head>

<body>
	<?php
	/* make connection */
	$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b94636c22a5fb4", "e48ac185", "cs3380-rwfwcb");

	/* check connection */
	if (!$link){
	    printf("Connect failed: %s\n", mysqli_connect_error());
	}



	if(isset($_POST['delete'])) {
			$query = "DELETE FROM city WHERE ID=?";
	    if ($stmt = mysqli_prepare($link, $query)){

				$id = $_POST["deleter"];

				/* bind variables */
		    mysqli_stmt_bind_param($stmt, 's', $id);

		    /* execute statement */
		    mysqli_stmt_execute($stmt);

		    printf("%d row deleted.\n", mysqli_stmt_affected_rows($stmt));

		    /* close statement and connection */
		    mysqli_stmt_close($stmt);
		    mysqli_close($link);

				echo "<a class='btn btn-danger' href='index.php'>Back to Index</a>";

			}
	}


	?>
</body>

</html>
