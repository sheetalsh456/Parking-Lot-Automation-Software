<?php
session_start();
include_once 'dbconnect.php';
$res = mysql_query("SELECT * FROM customer_details");
$row = mysql_fetch_array($res);
$id = $row['user_id'];
?>
