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
	<title>rwfwcb Login</title>

</head>

<body>
      <div>
        <h2>Create a user</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
          <div>
              <input type="text" name="username" placeholder="username">
          </div>
          <div>
              <input type="password" name="password" placeholder="password">
          </div>
          <div>
              <input type="submit" name="submit" value="Register">
          </div>
					<div>
							<br>
							<a href="https://cs3380-rwfwcb.cloudapp.net/lab8/index.php">Go to Login</a>
					</div>
        </form>
      </div>
</body>

</html>

<?php
  if(isset($_POST['submit'])) { // Was the form submitted?

    $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b94636c22a5fb4", "e48ac185", "cs3380-rwfwcb") or die ("Connection Error " . mysqli_error($link));
    $sql = "INSERT INTO user (username, salt, hashed_password) VALUES (?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
      $user = $_POST['username'];
      $salt = mt_rand();
      $hpass = password_hash($salt.$_POST['password'], PASSWORD_BCRYPT)  or die("bind param");
      mysqli_stmt_bind_param($stmt, "sss", $user, $salt, $hpass) or die("bind param");
      if(mysqli_stmt_execute($stmt)) {
        echo "<h4>Success</h4>";
      } else {
        echo "<h4>Failed</h4>";
      }
      $result = mysqli_stmt_get_result($stmt);
    } else {
      die("prepare failed");
    }
  }
?>
