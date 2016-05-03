<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
if(isset($_POST['btn-login']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM customer_details WHERE username='$uname'");
 $row=mysql_fetch_array($res);
 if($row['password']==$upass)
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: home.php");
 }
 else
 {
  ?>
        <script>alert('wrong details');</script>
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
	  .info{
                                /*height: 450px;
                                width: 700px;*/
                                box-shadow: 0px 3px 4px #999;
                                border-color: white;
                                color: Black;
                                min-width: 120px;
                                background-color:#E2EBF9;
                                /*padding: 1px 5px 1px 5px;*/
                        }
                        .info:hover{
                                box-shadow: 0px 10px 15px #888;
                                background-color: #BED1E6;
                        }
                        div.p{
                        	display:inline;
                        }
</style>
</head>
<body>
<div> <center>
<div style="font-size:40px;"><b>ParkWhizz</b></div>
<br>
<div>An efficient online parking system</div>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</button></td>
</tr>
<tr>
<td><div style="border:solid 1px rgb(55, 67, 83); background: -moz-linear-gradient(top, #769ECB , #374353); height:35px;padding-top:10px;"><center><a href="register.php" style="color:white;font-weight:bold;">SIGN UP HERE</a></center></div></td>
</tr>
<tr>
<td><div style="border:solid 1px rgb(55, 67, 83); background: -moz-linear-gradient(top, #769ECB , #374353); height:35px;padding-top:10px;"><center><a href="adminlogin.php" style="color:white;font-weight:bold;">ADMIN LOGIN</a></center></div></td>
</tr>
</table>
</form>
</div>
</center></div>
</body>
</html>
