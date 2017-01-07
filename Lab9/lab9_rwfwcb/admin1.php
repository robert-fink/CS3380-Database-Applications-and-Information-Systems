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
	<title>Admin Home Page</title>
</head>
<body>
	<div>
		<?php
			session_start();
			if(empty($_SESSION['logged_in'])){
    		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab9/index.php');
			}
      if ($_SESSION['user_type'] == 'admin'){
        echo "<h1>Welcome admin, you have super priviledges!</h1>";
      }
      else {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab9/index.php');
      }
			echo '<a href="logout.php">Click here to logout</a>';
		 ?>
	</div>
</body>
</html>
