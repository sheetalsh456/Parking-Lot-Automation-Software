<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['ad']))
{
 header("Location: adminlogin.php");
}
date_default_timezone_set("India");
$d1 = date("d");
$m1 = date("m");
$y1 = date("Y");
$h1 = date("h");
$mi1 = date("i");
$mm = $mi1 + $h1*60;
if(isset($_POST['update'])){

$status = mysql_real_escape_string($_POST['status']);
$floor = mysql_real_escape_string($_POST['floor']);
$slot = mysql_real_escape_string($_POST['slot']);
$entryh = mysql_real_escape_string($_POST['entryh']);
$entrym = mysql_real_escape_string($_POST['entrym']);
$exith = mysql_real_escape_string($_POST['exith']);
$exitm = mysql_real_escape_string($_POST['exitm']);
$d = mysql_real_escape_string($_POST['d']);
$m = mysql_real_escape_string($_POST['m']);
$y = mysql_real_escape_string($_POST['y']);

$res = mysql_query("SELECT * FROM slot_details WHERE floor='$floor' AND slot = '$slot' AND start_hour = '$entryh' AND start_min = '$entrym' AND end_hour='$exith' AND end_min='$exitm' AND day='$d' AND month='$m' AND year = '$y'");
$row = mysql_fetch_array($res);
if($row==0){
	?><script>alert("No such data exists!");</script><?php
}
else{
$id = $row['event_id'];
if(mysql_query("UPDATE slot_details SET slot_status = '$status' WHERE event_id = $id")){
	//$_SESSION['color'] = $status;
	?><script>alert("Status successfully updated!");</script><?php
}
else{
	?><script>alert("Error occured! try again!");</script><?php
}
}
}
if(isset($_POST['auto'])){
$res1 = mysql_query("SELECT * FROM slot_details WHERE day='$d1' AND month = '$m1' AND year = '$y1'");

while($row1 = mysql_fetch_array($res1))
{
	$id1= $row1['event_id'];
	$ho = $row1['start_hour'];
	$min = $row1['start_min'];
	if((($ho<=$h1)||(($ho==$h1)&&($min<=$mi1)))&&((($h1-$ho)*60+($mi1-$min))<30))
	{
	
		if(mysql_query("UPDATE slot_details SET slot_status = 'booked and not reported' WHERE event_id = $id1")){
		?><script>alert("Status successfully updated!");</script><?php
		}
		else{
			?><script>alert("Error occured! try again!");</script><?php
		}
	}
	else if((($h1-$ho)*60+($mi1-$min))>=30)
	{
		if(mysql_query("UPDATE slot_details SET slot_status = 'Vacant' WHERE event_id = $id1")){
		?><script>alert("Status successfully updated!");</script><?php
		}
		else{
			?><script>alert("Error occured! try again!");</script><?php
		}
	}
}
}
if(isset($_POST['vacate'])){
if(mysql_query("DELETE * FROM slot_details WHERE slot_status = 'Vacant'"))
{
	?><script>alert("Slots vacated successfully!");</script><?php
}
else
{
	?><script>alert("Slot vacation unsuccessful!");</script><?php
}
}
?>



<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/7/70/Rpohare.png">
	<title>Admin home page</title>
	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<style>
body{
	background-image:url("background3.jpeg");
}
</style>
</head>
<body>
<form method="post">
<br>
<div style="font-size:40px;">
	<center>
		<b>ADMIN PAGE</b>
	</center>
</div>
<br>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Floor</div>
	<div class="col-md-4">
		<select name="floor">
            <option value="1">Floor1</option>
            <option value="2">Floor2</option>
            <option value="3">Floor3</option>
          </select>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Slot number</div>
	<div class="col-md-4">
		<select name="slot">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
          </select>
	</div>
</div>
<br>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-2">Date(dd/mm/yyyy)</div>
<div class="col-md-1">
 <select name="d">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>
</div>
<div class="col-md-1">
        <select name="m">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
        </select>
</div>
<div class="col-md-1">
        <select name="y">
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
        </select>
</div>

</div><br>



<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Entry time</div>
	<div class="col-md-1">
		<select name="entryh">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
        </select>
	</div>
	<div class="col-md-1">
		<select name="entrym">
			<option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>
            <option value="59">59</option>
            <option value="60">60</option>
   		</select>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Exit time</div>
	<div class="col-md-1">
		<select name="exith">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
        </select>
	</div>
	<div class="col-md-1">
		<select name="exitm">
			<option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>
            <option value="59">59</option>
            <option value="60">60</option>
   		</select>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Change status to</div>
	<div class="col-md-4">
		<select name="status">
            <option value="vacant">Vacant</option>
            <option value="booked and reported">Booked and Reported</option>
            <option value="booked and not reported">Booked and not Reported</option>            
          </select>
	</div>
</div>
<br>

<div class="row text-center">
    <div class="col-md-12">
       <div class="actions">
      <button name="update" type="submit" value="Update Profile" style="font-weight:bold; width:10%;height:30px; box-shadow:0 2px 2px #999; min-width:150px;">Update Status</button>
    </div>
    </div>
  </div>
<br>
<!--<div class="row text-center">
    <div class="col-md-12">
       <div class="actions">
      <button name="auto" type="submit" value="Update status" style="font-weight:bold; width:10%;height:30px; box-shadow:0 2px 2px #999; min-width:150px;">Auto status update</button>
    </div>
    </div>
  </div>
  <br>-->
  <div class="row text-center">
    <div class="col-md-12">
       <div class="actions">
      <button name="vacate" type="submit" value="Update status" style="font-weight:bold; width:10%;height:30px; box-shadow:0 2px 2px #999; min-width:150px;">Vacate Slots</button>
    </div>
    </div>
  </div>
  <br>
<div><center><!--<button style="width:100px; height:50px;">--><a href="adlogout.php?adlogout" style="color:black">Sign out</a><!--</button>--></center></div>
</form>
</body>
</html>
