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
	<title>Login</title>
</head>
<body>
      <div>
        <h2>Login</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
          <div>
              <input type="text" name="username" placeholder="username">
          </div>
          <div>
              <input type="password" name="password" placeholder="password">
          </div>
          <div>
              <input type="submit" name="submit" value="Login">
          </div>
					<div>
							<br>
							<a href="https://cs3380-rwfwcb.cloudapp.net/lab9/register.php">Register New Account</a>
					</div>
        </form>
      </div>
</body>
</html>
<?php
	session_start();
	if(!empty($_SESSION['logged_in'])){
		if($_SESSION['user_type'] == 'admin'){
			header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab9/admin1.php');
		}
		else{
			header('Location: https://' . $_SERVER['HTTP_HOST'] . '/lab9/page1.php');
		}
	}
  if(isset($_POST['submit'])) { // Was the form submitted?
    $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b94636c22a5fb4", "e48ac185", "cs3380-rwfwcb") or die ("Connection Error " . mysqli_error($link));
    $sql = "SELECT * FROM user WHERE username = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $user) or die("bind param");
			$user = $_POST['username'];
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $username, $salt, $hashed_password, $user_type);
      mysqli_stmt_fetch($stmt);
			if (password_verify($salt.$_POST['password'], $hashed_password)) {
				$_SESSION['logged_in'] = "true";
				$_SESSION['username'] = $username;
				if ($user_type == "admin"){
					$_SESSION['user_type'] = "admin";
					header("Location: admin1.php");
				}
				if ($user_type == "user"){
					$_SESSION['user_type'] = "user";
					header("Location: page1.php");
				}
			}	else {
			    echo 'Invalid username or password.';
			}
      mysqli_stmt_close($stmt);
      mysqli_close($link);
  }
}
?>
