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
	<title>Logout</title>
</head>
<body>
	<?php
		session_start();
		session_unset();
		session_destroy();
		header("Location: index.php");
	?>
</body>
</html>
