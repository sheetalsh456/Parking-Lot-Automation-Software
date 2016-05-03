<?php
session_start();

if(!isset($_SESSION['ad']))
{
 header("Location: adminlogin.php");
}
else if(isset($_SESSION['ad'])!="")
{
 header("Location: adminhome.php");
}

if(isset($_GET['adlogout']))
{
 session_destroy();
 unset($_SESSION['ad']);
 header("Location: adminlogin.php");
}
?>

