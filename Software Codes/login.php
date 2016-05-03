<?php
/*require "conn.php";
$user_name = $_POST["user_name"];
$user_password = $_POST["password"];
$mysql_qry = "select * from customer_details where username like '$user_name' and password '$user_password';";
$result = mysqli_query($conn,$mysql_qry);
if(mysqli_num_rows($result)>0){
	echo "login successful";
}
else{
	echo "login not successful";
}*/

require "conn.php";
$user_name = "Navya";
$user_password = "navy8296@gmail.com";
$mysql_qry = "select * from 'customer' where 'Name' = '".$user_name."' and 'Email' ='".$user_password."';";
$result = mysqli_query($conn,$mysql_qry);
if($result!=0){
        echo "login successful";
}
else{
        echo "login not successful";
}

?>
