<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="login.css" />
</head>
<body>
<?php
require('db.php');
session_start();
if (isset($_POST['username'])){
$username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($con,$username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con,$password);
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
  $result = mysqli_query($con,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
        if($rows==1){
      $_SESSION['username'] = $username;
            $date = "UPDATE users SET last_login = NOW()";
      $date .= "WHERE username = '$username' LIMIT 1";

      $result_set = mysqli_query($con, $date);

      if (!$result_set) {
        die("database query failed");
      }
      header("Location: index.php");
         }else{
  echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
  }
    }else{
?>
<div class="login-page">
<center><h2 style="color: #fff; font-family: sans-serif; margin-top: 2px;">KAIMAN BETTA FISH</h2></center>
<div class="form">
  <h3 style="font-family: sans-serif; margin-top: 2px; margin-bottom: 30px;">Log In</h3>
<form class="login-form" action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<button name="submit" type="submit" value="Login">Login</button>
</form>
<p class="message">Not registered yet? <a href='registration.php'>Register Here</a></p>
<p class="message">Forgot Password? <a href='forgotpass.php'>Here</a></p>
</div>
</div>
<?php } ?>
</body>
</html>