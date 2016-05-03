<?php
	$server_name = "localhost";
	$mysql_username = "root";
	$mysql_password = "recyclebin";
	$db_name = "customer_details";
	$conn = mysqli_connect($server_name, $mysql_username,$mysql_password,$db_name);
	if($conn){
		echo "connection established";
	}
	else {
		echo "connection not established";
	}
	date_default_timezone_set("India");
	$d1 = date("d");
	echo $d1;
	$user_name = "Navya";
	$user_password = "navy8296@gmail.com";
	$mysql_qry = "select * from 'customer' where 'Name' = '".$user_name."' and 'Email' ='".$user_password."';";
	$result = mysqli_query($conn,$mysql_qry);
	if(mysqli_num_rows($result)>0){
        	echo "login successful";
	}
	else{
        	echo "login not successful";
	}

?>

