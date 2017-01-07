<!-- Robert Fink
	 rwfwcb
     CMP_SC 3380
-->
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
