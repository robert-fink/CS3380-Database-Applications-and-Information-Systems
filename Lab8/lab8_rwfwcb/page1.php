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
	<div>
		<?php
			session_start();
			if(empty($_SESSION['logged_in'])){
    		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab8/index.php');
			}
			echo "<h1>Congratulations! You are logged in!</h1><br>";
			echo '<a href="logout.php">Click here to logout</a>';
		 ?>
	</div>
</body>

</html>
