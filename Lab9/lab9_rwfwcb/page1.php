<!-- Robert Fink
	 	 rwfwcb
     CMP_SC 3380
-->
<?php
	// if request is not secure, redirect to secure url
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Home Page</title>
</head>
<body>
	<div>
		<?php
			session_start();
			if(empty($_SESSION['logged_in'])){
    		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab9/index.php');
			}
      if ($_SESSION['user_type'] == 'admin'){
        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab9/admin1.php');
      }
      if ($_SESSION['user_type'] == 'user'){
        echo "<h1>Welcome ".$_SESSION['username']."!</h1>";
      }
			echo '<a href="logout.php">Click here to logout</a>';
		 ?>
	</div>
</body>
</html>
