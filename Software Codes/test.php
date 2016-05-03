<?php
 $con = mysql_connect("localhost","root","recyclebin");
 mysql_select_db("customer_details",$con);
 
 echo($con);
$sql_query = ("select * from customer");
echo($sql_query);
while($row = mysql_fetch_array($sql_query)){
  echo($row[0]);
  echo($row[1]);
  echo("Hello!");
}
?>
