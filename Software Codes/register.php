<?php
session_start();
if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $name = mysql_real_escape_string($_POST['name']);
 $add = mysql_real_escape_string($_POST['add']);
 $age = mysql_real_escape_string($_POST['age']);
 $num = mysql_real_escape_string($_POST['num']);
 $upass = mysql_real_escape_string($_POST['pass']);
 
 if(mysql_query("INSERT INTO customer_details(Name,contact_number,age,address,username,password) VALUES('$name','$num','$age','$add','$uname','$upass')"))
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/7/70/Rpohare.png">
<title>ParkWhizz</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
body{
	background-image:url("background3.jpeg");
}
</style>

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="name" placeholder="Your Name" required /></td>
</tr>
<tr>
<td><input type="text" name="num" placeholder="Contact Number" required /></td>
</tr>
<tr>
<td><input type="number" name="age" placeholder="Your Age" required /></td>
</tr>
<tr>
<td><input type="text" name="add" placeholder="Your Address" required /></td>
</tr>
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="index.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>


</center>
</body>
</html>
