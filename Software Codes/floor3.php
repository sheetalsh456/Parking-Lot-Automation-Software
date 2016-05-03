<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}

$id = $_SESSION['user'];
$res = mysql_query("SELECT * FROM customer_details WHERE user_id = $id ");
$row = mysql_fetch_array($res);
$f=3;
$z = 0;
$id = $_SESSION['user'];
$x = 0;
if(isset($_POST['book']))
{
 $slot = mysql_real_escape_string($_POST['slot']);
 $floor = mysql_real_escape_string($_POST['floor']);
 $entryh = mysql_real_escape_string($_POST['entryh']);
 $entrym = mysql_real_escape_string($_POST['entrym']);
 $exith = mysql_real_escape_string($_POST['exith']);
 $exitm = mysql_real_escape_string($_POST['exitm']);
 $d = mysql_real_escape_string($_POST['d']);
 $m = mysql_real_escape_string($_POST['m']);
 $y = mysql_real_escape_string($_POST['y']);
 $user_id = $id;
 if((($entryh==$exith)&&($entrym==$exitm))||(($entryh==$exith)&&($entrym>$exitm))||($entryh>$exith))
{
        $z = 1;?><script>alert("Booking not successful!Select a proper range of time");</script><?php
}

 $res = mysql_query("SELECT * FROM slot_details WHERE slot ='$slot' AND day = '$d' AND month = '$m' AND year = '$y' AND floor='$f'");
 while(($row = mysql_fetch_array($res))&&($z==0)){
	if(!($entryh < $row['start_hour'] && $exith < $row['start_hour']) && !($entryh > $row['end_hour'] && $exith > $row['end_hour']) && !($entryh < $row['start_hour'] && $exith == $row['start_hour'] && $exitm < $row['start_min']) && !($entryh == $row['end_hour'] && $exith > $row['end_hour'] && $entrym > $row['end_min']) && !($entryh == $row['start_hour'] && $exith == $row['start_hour'] && $entrym < $row['start_min'] && $exitm < $row['start_min']) && !($entryh == $row['end_hour'] && $exith == $row['end_hour'] && $entrym > $row['end_min'] && $exitm > $row['end_min'])&& !($entryh==$exith && $entrym==$exitm)){
		
		?><script>alert("Sorry! Slot is already booked, choose another slot");</script><?php
		$x = 1;
		break;		
	}
}
if(($x==0)&&($z==0)){
 if(mysql_query("INSERT INTO slot_details(floor,slot,day,month,year,start_hour,start_min,end_hour,end_min,user_id,slot_status) VALUES('$floor','$slot','$d','$m','$y','$entryh','$entrym','$exith','$exitm','$user_id','Booked')"))
 {
  ?>
        <script>alert('Booking slot successful ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while booking slot! try again');</script>
        <?php
 }
}
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/7/70/Rpohare.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome - <?php echo $row['Name']; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="Dashboard%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Dashboard%20Template%20for%20Bootstrap_files/dashboard.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<style>
	.alertclass{
		height:70px;
		width:70px;
		color:white;
		background-color:#100726;
		margin:5px;
	}
	.dd{
		display: inline;
	}
	.table tr td button{
		width:5% !important; 
		height:30px !important;
	}
</style>

<style>
      .panel-body{
        padding:8px;
      }

      .dd-container, .dd-select, .dd-options{
        width: 100% !important;
      }
      .button{
        font-weight: bold;
        width: 30%;
        min-width: 140px;
      }
    </style>
    <style type="text/css">
    .sidebar
    {
      transition: all 0.5s;
      margin-top:-33px;
    }
    body
    {
      background-image: url("background3.jpeg");
    }
     .info{
                                /*height: auto;
                                width: 20%;*/
                                box-shadow: 0px 3px 4px #999;
                                border-color: white;
                                color: Black;
                                min-width: 120px;
                                background-color:white;
                                /*padding: 1px 5px 1px 5px;*/
                        }
                        .info:hover{
                                box-shadow: 0px 10px 15px #888;
                                /*background-color:transparent;*/
                                opacity: 0.8;
                        }

      .noborder > td,.noborder > th{border: none !important; }
    </style>
    <style>
    #db-btn
    {
      position:fixed;
      right:0;
    }
    @media only screen and (max-width: 768px)
    {
      #navbar, #db-btn
      {
        display: block;
      }
      #hide-aside-btn
      {
        display: none;
      }

    }
    @media only screen and (min-width: 768px)
    {
      #navbar, #db-btn
      {
        display: none !important;
      }
      #hide-aside-btn
      {
        display: block;
      }
    }
    .navbar
    {
      background-color: #27334B !important;
      box-shadow: 0 0 2px black;
      border:none !important;
      outline: none !important;
    }
    .navbar-collapse.collapse.in
    {
      background:#444;
    }
   .sidebar
    {
      background-color:#27334B;
      border:none;
      outline:none;
      box-shadow: 0 0 10px #777;
      padding:0;
      margin-top:-33px !important;
    }
    .nav-sidebar > li.active > a
    {
      background-color: #b71c1c !important;
    }
    .dropdown-menu > li > a
    {
      background-color: #b71c1c !important;
    }
    #MainMenu,#MainMenu2
    {
      width:100%;
    }
    .list-group.panel
    {
      border:none;
    }
    .list-group-item
    {
      border:none !important;
      background: #27334B !important;
      border-radius: 0 !important;
      color:white !important;
    }
    a.list-group-item
    {
      font-weight: bold;
    }
    a.list-group-item > i.material-icons
    {
      display: inline !important;
      vertical-align: middle !important;
      margin-right: 10px;
    }
    a.list-group-item:hover
    {
      box-shadow:0 0 3px black;
      border:none !important;
      background: #5D77AB  !important;
      border-radius: 0 !important;
      color:white !important;
      z-index:20;
    }
    #profile > .list-group-item,#courses > .list-group-item,#profile2 > .list-group-item,#courses2 > .list-group-item
    {
      font-weight: normal;
      background-color: #560312 !important;
      color:white;
      border:none;
      border-radius: 0;
    }
    #profile > .list-group-item:hover,#courses > .list-group-item:hover, #profile2 > .list-group-item.active, #courses2 > .list-group-item.active
    {
      background-color:#93021C !important;
    }
    ul.navbar-nav > li > a
    {
      color: white;
      font-weight: bold;
    }
    #info-bar
    {
      width:100%;
      background-color:#27334B;
      color:white;
      font-weight:bold;
      padding:20px;
      text-align: center;
    }
.sidebar
{
  margin-top: -33px;
}
.breadcrumb {
    margin-top: -60px;
    position: fixed;
    z-index: 1010;
    width: 100%;
    padding: 8px 15px;
margin: 0px 0px 20px;
list-style: outside none none;
background-color: #ddd;
border-radius: 0;
box-shadow:0 2px 3px #000;
}
.breadcrumb > li {
    display: inline-block;
    text-shadow: 0px 1px 0px #FFF;
}
.breadcrumb > li > a {
    color:#000;
}
.breadcrumb > li.active > a {
    color:#444;
}
.breadcrumb > li + li:before
{
  color:#444;
}
select{
	width:80px;
}
.fa-sign-out{
		font-size: 30px;
		margin-top:-6px;
	}
#header #right #content a{
		color:#c6dae0;
}	
    </style>
  </head>

  <body>
<form method ="post">

    <nav class="navbar navbar-fixed-top">
      <div class="container-fluid">
     <!-- <button type="button" id="hide-aside-btn" style="position:fixed; top:10px; left:10px; background:none; border:none; outline:none;" onclick="hide_aside();">
            <i class="material-icons" style="font-size:30px; color:white;">toc</i>
      </button>-->

	<div id="header">
 		<div id="left">
			<button type="button" id="hide-aside-btn" style="position:fixed; top:10px; left:10px; background:none; border:none; outline:none;" onclick="hide_aside();">
           			 <i class="material-icons" style="font-size:30px; color:white;">toc</i>
		      </button>
	
    			<label>ParkWhizz</label>
   		 </div>
    	<div id="right">
     		<div id="content">
        		 <a href="logout.php?logout"><i class="fa fa-sign-out"></i></a>
        	</div>
    	</div>
</div>


        
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row main-div">
        <div class="col-sm-3 col-md-2 sidebar">
          <div id="info-bar">
         
          <br/><font style="font-size:18px; text-shadow:0 0 4px black; font-family: 'Roboto', sans-serif; font-weight:bold;"><?php echo $row['Name'];?></font>
          </div>
            <div id="MainMenu">
            <div class="list-group panel">
              <a href="home.php" class="list-group-item" data-parent="#MainMenu"><i class="material-icons">home</i>Home</a>
              <a href="#profile" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">account_circle</i>Profile<i class="material-icons" style="float:right">expand_more</i></a>
              <div class="collapse" id="profile">
                <a href="edit.php" class="list-group-item" data-parent="#SubMenu1"><i class="material-icons">mode_edit</i>Edit Profile</a>
                <a href="changepass.php" class="list-group-item"><i class="material-icons">mode_edit</i>Change password</a>
                <a href="view.php" class="list-group-item"><i class="material-icons">account_circle</i>View Profile</a>
                                <a href="chkstatus.php" class="list-group-item"><i class="material-icons">done_all</i>Check Status</a>
              </div>
              <a href="#courses" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">apps</i>Book slot<i class="material-icons" style="float:right">expand_more</i></a>
              <div class="collapse" id="courses">
                <a href="floor1.php" class="list-group-item"><i class="material-icons">business</i>Floor1</a>
                <a href="floor2.php" class="list-group-item"><i class="material-icons">business</i>Floor2</a>
                <a href="floor3.php" class="list-group-item"><i class="material-icons">business</i>Floor3</a>
              </div>
              <a href="about.php" class="list-group-item"  data-parent="#MainMenu"><i class="material-icons">people</i>About the developers</a>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
        <div id="content-body" class="col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3 main " style="background:transparent">
<div class="row" style="padding-top:10px;">
<div class="col-md-12" style="padding:20px;">
<!--content goes here-->
<center>
<div style="font-weight:bold;font-size=50px;"><center> FLOOR 3</center></div>
		<br><br>
 		<table class="slots1">
                            <tr><td><input type="button" value="1" class="alertclass" data-toggle="modal" data-target="#myModal1">
				<!-- Modal -->
				<div id="myModal1" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
					<div class="row">
					 <div class="col-md-6">
						<h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 1</h3>
					</div>
					<div class="col-md-6">
				        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
					</div>
					</div>
				      </div>
				      <div class="modal-body">
				     	<?php
                                                $n1 = 1;
                                                $res1 = mysql_query("SELECT * FROM slot_details WHERE slot = $n1 AND floor = $f");
						if(!(mysql_num_rows($res1))){echo "Slot 1 is empty!";}else{
						?>
						<div class="row">
                                               		 <div class="col-md-4"><center><b>Date</b></center></div>
                                                	<div class="col-md-4"><center><b>Start time</b></center></div>
                                                	<div class="col-md-4"><center><b>End time</b></center></div>
                                        	</div>
						<?php
						while($row1 = mysql_fetch_array( $res1))
   						{
							?><div class="row">
								<div class="col-md-4"><center><?=$row1['day']?> - <?=$row1['month']?> - <?=$row1['year']?></center></div>
								<div class="col-md-4"><center><?=$row1['start_hour']?> : <?=$row1['start_min']?></center></div>
								<div class="col-md-4"><center><?=$row1['end_hour']?> : <?=$row1['end_min']?></center></div>
							</div><?php
					    	}}
					?>
				      </div>
				    </div>

				  </div>
				</div>

				</td>
				<td><input type="button" value="2" class="alertclass" data-toggle="modal" data-target="#myModal2">
                                <!-- Modal -->
                                <div id="myModal2" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 2</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n2 = 2;
                                                $res2 = mysql_query("SELECT * FROM slot_details WHERE slot = $n2 AND floor = $f");
						if(!(mysql_num_rows($res2))){echo "Slot 2 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row2 = mysql_fetch_array( $res2))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row2['day']?> - <?=$row2['month']?> - <?=$row2['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row2['start_hour']?> : <?=$row2['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row2['end_hour']?> : <?=$row2['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
					
				<td><input type="button" value="3" class="alertclass" data-toggle="modal" data-target="#myModal3">
                                <!-- Modal -->
                                <div id="myModal3" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 3</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n3 = 3;
                                                $res3 = mysql_query("SELECT * FROM slot_details WHERE slot = $n3 AND floor = $f");
						if(!(mysql_num_rows($res3))){echo "Slot 3 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row3 = mysql_fetch_array( $res3))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row3['day']?> - <?=$row3['month']?> - <?=$row3['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row3['start_hour']?> : <?=$row3['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row3['end_hour']?> : <?=$row3['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="4" class="alertclass" data-toggle="modal" data-target="#myModal4">
                                <!-- Modal -->
                                <div id="myModal4" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 4</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n4 = 4;
                                                $res4 = mysql_query("SELECT * FROM slot_details WHERE slot = $n4 AND floor = $f");
						if(!(mysql_num_rows($res4))){echo "Slot 4 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row4 = mysql_fetch_array( $res4))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row4['day']?> - <?=$row4['month']?> - <?=$row4['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row4['start_hour']?> : <?=$row4['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row4['end_hour']?> : <?=$row4['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="5" class="alertclass" data-toggle="modal" data-target="#myModal5">
                                <!-- Modal -->
                                <div id="myModal5" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 5</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n5 = 5;
                                                $res5 = mysql_query("SELECT * FROM slot_details WHERE slot = $n5 AND floor = $f");
						if(!(mysql_num_rows($res5))){echo "Slot 5 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row5 = mysql_fetch_array( $res5))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row5['day']?> - <?=$row5['month']?> - <?=$row5['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row5['start_hour']?> : <?=$row5['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row5['end_hour']?> : <?=$row5['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="6" class="alertclass" data-toggle="modal" data-target="#myModal6">
                                <!-- Modal -->
                                <div id="myModal6" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 6</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n6 = 6;
                                                $res6 = mysql_query("SELECT * FROM slot_details WHERE slot = $n6 AND floor = $f");
						if(!(mysql_num_rows($res6))){echo "Slot 6 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row6 = mysql_fetch_array( $res6))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row6['day']?> - <?=$row6['month']?> - <?=$row6['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row6['start_hour']?> : <?=$row6['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row6['end_hour']?> : <?=$row6['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="7" class="alertclass" data-toggle="modal" data-target="#myModal7">
                                <!-- Modal -->
                                <div id="myModal7" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 7</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n7 = 7;
                                                $res7 = mysql_query("SELECT * FROM slot_details WHERE slot = $n7 AND floor = $f");
						if(!(mysql_num_rows($res7))){echo "Slot 7 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row7 = mysql_fetch_array( $res7))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row7['day']?> - <?=$row7['month']?> - <?=$row7['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row7['start_hour']?> : <?=$row7['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row7['end_hour']?> : <?=$row7['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="8" class="alertclass" data-toggle="modal" data-target="#myModal8">
                                <!-- Modal -->
                                <div id="myModal8" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 8</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n8 = 8;
                                                $res8 = mysql_query("SELECT * FROM slot_details WHERE slot = $n8 AND floor = $f");
						if(!(mysql_num_rows($res8))){echo "Slot 8 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row8 = mysql_fetch_array( $res8))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row8['day']?> - <?=$row8['month']?> - <?=$row8['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row8['start_hour']?> : <?=$row8['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row8['end_hour']?> : <?=$row8['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td></tr>

			    <tr><td><input type="button" value="9" class="alertclass" data-toggle="modal" data-target="#myModal9">
                                <!-- Modal -->
                                <div id="myModal9" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 9</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n9 = 9;
                                                $res9 = mysql_query("SELECT * FROM slot_details WHERE slot = $n9 AND floor = $f");
						if(!(mysql_num_rows($res9))){echo "Slot 9 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row9 = mysql_fetch_array( $res9))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row9['day']?> - <?=$row9['month']?> - <?=$row9['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row9['start_hour']?> : <?=$row9['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row9['end_hour']?> : <?=$row9['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="10" class="alertclass" data-toggle="modal" data-target="#myModal10">
                                <!-- Modal -->
                                <div id="myModal10" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 10</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n10 = 10;
                                                $res10 = mysql_query("SELECT * FROM slot_details WHERE slot = $n10 AND floor = $f");
						if(!(mysql_num_rows($res10))){echo "Slot 10 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row10 = mysql_fetch_array( $res10))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row10['day']?> - <?=$row10['month']?> - <?=$row10['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row10['start_hour']?> : <?=$row10['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row10['end_hour']?> : <?=$row10['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="11" class="alertclass" data-toggle="modal" data-target="#myModal11">
                                <!-- Modal -->
                                <div id="myModal11" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 11</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n11 = 11;
                                                $res11 = mysql_query("SELECT * FROM slot_details WHERE slot = $n11 AND floor = $f");
						if(!(mysql_num_rows($res11))){echo "Slot 11 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row11 = mysql_fetch_array( $res11))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row11['day']?> - <?=$row11['month']?> - <?=$row11['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row11['start_hour']?> : <?=$row11['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row11['end_hour']?> : <?=$row11['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="12" class="alertclass" data-toggle="modal" data-target="#myModal12">
                                <!-- Modal -->
                                <div id="myModal12" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 12</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n12 = 12;
                                                $res12 = mysql_query("SELECT * FROM slot_details WHERE slot = $n12 AND floor = $f");
						if(!(mysql_num_rows($res12))){echo "Slot 12 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row12 = mysql_fetch_array( $res12))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row12['day']?> - <?=$row12['month']?> - <?=$row12['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row12['start_hour']?> : <?=$row12['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row12['end_hour']?> : <?=$row12['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="13" class="alertclass" data-toggle="modal" data-target="#myModal13">
                                <!-- Modal -->
                                <div id="myModal13" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 13</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n13 = 13;
                                                $res13 = mysql_query("SELECT * FROM slot_details WHERE slot = $n13 AND floor = $f");
						if(!(mysql_num_rows($res13))){echo "Slot 13 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row13 = mysql_fetch_array( $res13))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row13['day']?> - <?=$row13['month']?> - <?=$row13['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row13['start_hour']?> : <?=$row13['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row13['end_hour']?> : <?=$row13['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="14" class="alertclass" data-toggle="modal" data-target="#myModal14">
                                <!-- Modal -->
                                <div id="myModal14" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 14</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n14 = 14;
                                                $res14 = mysql_query("SELECT * FROM slot_details WHERE slot = $n14 AND floor = $f");
						if(!(mysql_num_rows($res14))){echo "Slot 14 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row14 = mysql_fetch_array( $res14))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row14['day']?> - <?=$row14['month']?> - <?=$row14['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row14['start_hour']?> : <?=$row14['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row14['end_hour']?> : <?=$row14['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="15" class="alertclass" data-toggle="modal" data-target="#myModal15">
                                <!-- Modal -->
                                <div id="myModal15" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 15</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n15 = 15;
                                                $res15 = mysql_query("SELECT * FROM slot_details WHERE slot = $n15 AND floor = $f");
						if(!(mysql_num_rows($res15))){echo "Slot 15 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row15 = mysql_fetch_array( $res15))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row15['day']?> - <?=$row15['month']?> - <?=$row15['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row15['start_hour']?> : <?=$row15['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row15['end_hour']?> : <?=$row15['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="16" class="alertclass" data-toggle="modal" data-target="#myModal16">
                                <!-- Modal -->
                                <div id="myModal16" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 16</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n16 = 16;
                                                $res16 = mysql_query("SELECT * FROM slot_details WHERE slot = $n16 AND floor = $f");
						if(!(mysql_num_rows($res16))){echo "Slot 16 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row16 = mysql_fetch_array( $res16))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row16['day']?> - <?=$row16['month']?> - <?=$row16['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row16['start_hour']?> : <?=$row16['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row16['end_hour']?> : <?=$row16['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td></tr>

			    <tr><td><input type="button" value="17" class="alertclass" data-toggle="modal" data-target="#myModal17">
                                <!-- Modal -->
                                <div id="myModal17" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 17</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n17 = 17;
                                                $res17 = mysql_query("SELECT * FROM slot_details WHERE slot = $n17 AND floor = $f");
						if(!(mysql_num_rows($res17))){echo "Slot 17 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row17 = mysql_fetch_array( $res17))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row17['day']?> - <?=$row17['month']?> - <?=$row17['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row17['start_hour']?> : <?=$row17['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row17['end_hour']?> : <?=$row17['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="18" class="alertclass" data-toggle="modal" data-target="#myModal18">
                                <!-- Modal -->
                                <div id="myModal18" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 18</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n18 = 18;
                                                $res18 = mysql_query("SELECT * FROM slot_details WHERE slot = $n18 AND floor = $f");
						if(!(mysql_num_rows($res18))){echo "Slot 18 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row18 = mysql_fetch_array( $res18))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row18['day']?> - <?=$row18['month']?> - <?=$row18['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row18['start_hour']?> : <?=$row18['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row18['end_hour']?> : <?=$row18['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="19" class="alertclass" data-toggle="modal" data-target="#myModal19">
                                <!-- Modal -->
                                <div id="myModal19" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 19</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n19 = 19;
                                                $res19 = mysql_query("SELECT * FROM slot_details WHERE slot = $n19 AND floor = $f");
						if(!(mysql_num_rows($res19))){echo "Slot 19 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row19 = mysql_fetch_array( $res19))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row19['day']?> - <?=$row19['month']?> - <?=$row19['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row19['start_hour']?> : <?=$row19['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row19['end_hour']?> : <?=$row19['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="20" class="alertclass" data-toggle="modal" data-target="#myModal20">
                                <!-- Modal -->
                                <div id="myModal20" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 20</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n20 = 20;
                                                $res20 = mysql_query("SELECT * FROM slot_details WHERE slot = $n20 AND floor = $f");
						if(!(mysql_num_rows($res20))){echo "Slot 20 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row20 = mysql_fetch_array( $res20))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row20['day']?> - <?=$row20['month']?> - <?=$row20['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row20['start_hour']?> : <?=$row20['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row20['end_hour']?> : <?=$row20['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="21" class="alertclass" data-toggle="modal" data-target="#myModal21">
                                <!-- Modal -->
                                <div id="myModal21" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 21</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n21 = 21;
                                                $res21 = mysql_query("SELECT * FROM slot_details WHERE slot = $n21 AND floor = $f");
						if(!(mysql_num_rows($res21))){echo "Slot 21 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row21 = mysql_fetch_array( $res21))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row21['day']?> - <?=$row21['month']?> - <?=$row21['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row21['start_hour']?> : <?=$row21['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row21['end_hour']?> : <?=$row21['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="22" class="alertclass" data-toggle="modal" data-target="#myModal22">
                                <!-- Modal -->
                                <div id="myModal22" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 22</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n22 = 22;
                                                $res22 = mysql_query("SELECT * FROM slot_details WHERE slot = $n22 AND floor = $f");
						if(!(mysql_num_rows($res22))){echo "Slot 22 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row22 = mysql_fetch_array( $res22))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row22['day']?> - <?=$row22['month']?> - <?=$row22['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row22['start_hour']?> : <?=$row22['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row22['end_hour']?> : <?=$row22['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="23" class="alertclass" data-toggle="modal" data-target="#myModal23">
                                <!-- Modal -->
                                <div id="myModal23" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 23</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n23 = 23;
                                                $res23 = mysql_query("SELECT * FROM slot_details WHERE slot = $n23 AND floor = $f");
						if(!(mysql_num_rows($res23))){echo "Slot 23 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row23 = mysql_fetch_array( $res23))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row23['day']?> - <?=$row23['month']?> - <?=$row23['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row23['start_hour']?> : <?=$row23['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row23['end_hour']?> : <?=$row23['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="24" class="alertclass" data-toggle="modal" data-target="#myModal24">
                                <!-- Modal -->
                                <div id="myModal24" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 24</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n24 = 24;
                                                $res24 = mysql_query("SELECT * FROM slot_details WHERE slot = $n24 AND floor = $f");
						if(!(mysql_num_rows($res24))){echo "Slot 24 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row24 = mysql_fetch_array( $res24))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row24['day']?> - <?=$row24['month']?> - <?=$row24['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row24['start_hour']?> : <?=$row24['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row24['end_hour']?> : <?=$row24['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td></tr>

			    <tr><td><input type="button" value="25" class="alertclass" data-toggle="modal" data-target="#myModal25">
                                <!-- Modal -->
                                <div id="myModal25" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 25</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n25 = 25;
                                                $res25 = mysql_query("SELECT * FROM slot_details WHERE slot = $n25 AND floor = $f");
						if(!(mysql_num_rows($res25))){echo "Slot 25 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row25 = mysql_fetch_array( $res25))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row25['day']?> - <?=$row25['month']?> - <?=$row25['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row25['start_hour']?> : <?=$row25['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row25['end_hour']?> : <?=$row25['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="26" class="alertclass" data-toggle="modal" data-target="#myModal26">
                                <!-- Modal -->
                                <div id="myModal26" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 26</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n26 = 26;
                                                $res26 = mysql_query("SELECT * FROM slot_details WHERE slot = $n26 AND floor = $f");
						if(!(mysql_num_rows($res26))){echo "Slot 26 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row26 = mysql_fetch_array( $res26))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row26['day']?> - <?=$row26['month']?> - <?=$row26['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row26['start_hour']?> : <?=$row26['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row26['end_hour']?> : <?=$row26['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="27" class="alertclass" data-toggle="modal" data-target="#myModal27">
                                <!-- Modal -->
                                <div id="myModal27" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 27</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n27 = 27;
                                                $res27 = mysql_query("SELECT * FROM slot_details WHERE slot = $n27 AND floor = $f");
						if(!(mysql_num_rows($res27))){echo "Slot 27 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row27 = mysql_fetch_array( $res27))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row27['day']?> - <?=$row27['month']?> - <?=$row27['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row27['start_hour']?> : <?=$row27['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row27['end_hour']?> : <?=$row27['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
			        <td><input type="button" value="28" class="alertclass" data-toggle="modal" data-target="#myModal28">
                                <!-- Modal -->
                                <div id="myModal28" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 28</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n28 = 28;
                                                $res28 = mysql_query("SELECT * FROM slot_details WHERE slot = $n28 AND floor = $f");
						if(!(mysql_num_rows($res28))){echo "Slot 28 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row28 = mysql_fetch_array( $res28))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row28['day']?> - <?=$row28['month']?> - <?=$row28['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row28['start_hour']?> : <?=$row28['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row28['end_hour']?> : <?=$row28['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="29" class="alertclass" data-toggle="modal" data-target="#myModal29">
                                <!-- Modal -->
                                <div id="myModal29" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 29</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n29 = 29;
                                                $res29 = mysql_query("SELECT * FROM slot_details WHERE slot = $n29 AND floor = $f");
						if(!(mysql_num_rows($res29))){echo "Slot 29 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row29 = mysql_fetch_array( $res29))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row29['day']?> - <?=$row29['month']?> - <?=$row29['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row29['start_hour']?> : <?=$row29['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row29['end_hour']?> : <?=$row29['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="30" class="alertclass" data-toggle="modal" data-target="#myModal30">
                                <!-- Modal -->
                                <div id="myModal30" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 30</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n30 = 30;
                                                $res30 = mysql_query("SELECT * FROM slot_details WHERE slot = $n30 AND floor = $f");
						if(!(mysql_num_rows($res30))){echo "Slot 30 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row30 = mysql_fetch_array( $res30))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row30['day']?> - <?=$row30['month']?> - <?=$row30['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row30['start_hour']?> : <?=$row30['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row30['end_hour']?> : <?=$row30['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="31" class="alertclass" data-toggle="modal" data-target="#myModal31">
                                <!-- Modal -->
                                <div id="myModal31" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 31</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n31 = 31;
                                                $res31 = mysql_query("SELECT * FROM slot_details WHERE slot = $n31 AND floor = $f");
						if(!(mysql_num_rows($res31))){echo "Slot 31 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row31 = mysql_fetch_array( $res31))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row31['day']?> - <?=$row31['month']?> - <?=$row31['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row31['start_hour']?> : <?=$row31['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row31['end_hour']?> : <?=$row31['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td>
				<td><input type="button" value="32" class="alertclass" data-toggle="modal" data-target="#myModal32">
                                <!-- Modal -->
                                <div id="myModal32" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                         <div class="col-md-6">
                                                <h3 class="modal-title" style="padding-top:12px;padding-left:25px;">Slot 32</h3>
                                        </div>
                                        <div class="col-md-6">
                                        <button type="button" class="close" data-dismiss="modal" style="box-shadow:0px 0px 0px;margin-right:-100px;">&times;</button>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                                $n32 = 32;
                                                $res32 = mysql_query("SELECT * FROM slot_details WHERE slot = $n32 AND floor = $f");
						if(!(mysql_num_rows($res32))){echo "Slot 32 is empty!";}else{
						?><div class="row">
                                                <div class="col-md-4"><center><b>Date</b></center></div>
                                                <div class="col-md-4"><center><b>Start time</b></center></div>
                                                <div class="col-md-4"><center><b>End time</b></center></div>
                                        </div><?php

                                                while($row32 = mysql_fetch_array( $res32))
                                                {
                                                        ?><div class="row">
                                                                <div class="col-md-4"><center><?=$row32['day']?> - <?=$row32['month']?> - <?=$row32['year']?></center></div>
                                                                <div class="col-md-4"><center><?=$row32['start_hour']?> : <?=$row32['start_min']?></center></div>
                                                                <div class="col-md-4"><center><?=$row32['end_hour']?> : <?=$row32['end_min']?></center></div>
                                                        </div><?php
                                                }}
                                        ?>

					</div></div></div></div>

				</td></tr>
                    </table><br>
<div class="row">
<div class="col-md-2">Floor</div>
<div class="col-md-1">
<select name="floor">
<option value="3">3</option>
</select></div>
</div>
<!--</div>-->
<br>
<div class="row">
<div class="col-md-2">Slot</div>
<div class="col-md-1">
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
</select></div>
</div>

<br>
<div class="row">
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
<div class="col-md-2">Entry time(Hours/minutes)</div>
<div class="col-md-1">
<select name="entryh">
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
</select>
</div>
<div class="col-md-1">
<select name="entrym">
  <option value="1">01</option>
  <option value="2">02</option>
  <option value="3">03</option>
  <option value="4">04</option>
  <option value="5">05</option>
  <option value="6">06</option>
  <option value="7">07</option>
  <option value="8">08</option>
  <option value="9">09</option>
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
  <option value="37">36</option>
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
</div><br>
<div class="row">
<div class="col-md-2">Exit time(Hours/minutes)</div>
<div class="col-md-1">
<select name="exith">
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
</select>
</div>
<div class="col-md-1">
<select name="exitm">
  <option value="1">01</option>
  <option value="2">02</option>
  <option value="3">03</option>
  <option value="4">04</option>
  <option value="5">05</option>
  <option value="6">06</option>
  <option value="7">07</option>
  <option value="8">08</option>
  <option value="9">09</option>
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
  <option value="37">36</option>
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
</div><br>
<div class="floorone"><center><button type="submit" value="Book Slot" class="submit" style="height:50px;width:100px;" name = "book">Book Slot</center></div><br><br>
</center>
<!--content ends here-->
</div>
</div>
</div>


<script type="text/javascript">
	/**
 * Vertically center Bootstrap 3 modals so they aren't always stuck at the top
 */
    $(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        
        // Dividing by two centers the modal exactly, but dividing by three 
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
});	
</script>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="Dashboard%20Template%20for%20Bootstrap_files/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="Dashboard%20Template%20for%20Bootstrap_files/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="Dashboard%20Template%20for%20Bootstrap_files/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="Dashboard%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="nav.js"></script>
  <script type="text/javascript" src="jquery.js"></script>
    <script>
    window.onload=(function(){
      $('#MainMenu2').hide();
    });
    $('.navbar-collapse').on('show.bs.collapse', function() {
      $('#MainMenu2').show();
});
    $('.navbar-collapse').on('hide.bs.collapse', function() {
      $('#MainMenu2').hide();
    });

    (function ($) {
$.fn.tclick = function (onclick) {
    this.bind("touchstart", function (e) { onclick.call(this, e); e.stopPropagation(); e.preventDefault(); });
    this.bind("click", function (e) { onclick.call(this, e); });   //substitute mousedown event for exact same result as touchstart         
    return this;
  };
})(jQuery);
    var _tog_sb=true;
    function hide_aside()
    {
      if(_tog_sb)
      {
      $('.sidebar').css('left', '-300px');
      $('#content-body').removeClass('col-md-10').removeClass('col-md-offset-2').removeClass('col-sm-9').removeClass('col-sm-offset-3').addClass('col-md-12');
    }
      else
      {
      $('.sidebar').css('left', '0px');
      $('#content-body').removeClass('col-md-12').addClass('col-md-10').addClass('col-md-offset-2').addClass('col-sm-9').addClass('col-sm-offset-3');
    }
    _tog_sb=!_tog_sb;
    }
    var num=('#fnav-expanded div').length;
    var _fnav_flag=false;
    $('#fnav-btn').click(function(){
      
      if(_fnav_flag)
      {
        $('#fnav-btn').css('background', '#e8e8e8').css('transform', 'rotate(0deg)').css('color','#444').html('<i id="add-push" class="material-icons">add</i>');
        for(var i=0;i<num;i++)
          {
            $('#fnav-expanded').children().eq(i).stop().css('transform', 'rotate(0deg)').animate({bottom:0+'px'},600, function(){
                $('#fnav-expanded').hide();
            });
          }
              }
      else
      {
        $('#fnav-expanded').show();
        $('#fnav-btn').css('background', '#333').css('transform', 'rotate(360deg)').css('color','#eee').html('<i id="add-push" class="material-icons">remove</i>');
        for(var i=0;i<num;i++)
          {
            var j=1;
            if($('#fnav-btn').offset().top<300)
              var j=-1;
            var np=j*80*(i+1);
            $('#fnav-expanded').children().eq(i).stop().animate({bottom:np+'px'},600).css('transform', 'rotate(360deg)');

          }
      }
      _fnav_flag=!_fnav_flag;
      console.log(_fnav_flag);
    });
    $(document).ready(function() {
    var $dragging = null;
    var _m=true;
    $(document.body).on("mousemove", function(e) {

        if ($dragging) {
          e=e || window.event;
          pauseEvent(e);
            $dragging.offset({
                top: e.pageY,
                left: e.pageX
            });
        if($('#fnav-btn').offset().top<300&&_m)
         {
          _m=false;
          for(var i=0;i<num;i++)
          {
            var np=-1*80*(i+1);
            $('#fnav-expanded').children().eq(i).stop().animate({bottom:np+'px'},600).css('transform', 'rotate(360deg)');
          }
         }
         else if($('#fnav-btn').offset().top>300&&!_m)
         {
          _m=true;
          for(var i=0;i<num;i++)
          {
            var np=80*(i+1);
            $('#fnav-expanded').children().eq(i).stop().animate({bottom:np+'px'},600).css('transform', 'rotate(360deg)');
          }
         }
        }
    });
    
    $(document.body).on("mousedown", function (e) {
      
      
      console.log(e.target.id);
      if(e.target.id=='fnav-btn')
      {
      $dragging = $(e.target).parent().parent();
      e=e || window.event;
      pauseEvent(e);
    }
    else if(e.target.id=='add-push')
    {
      $dragging = $(e.target).parent().parent().parent();
      e=e || window.event;
      pauseEvent(e);
    }
      
    });
    
    $(document.body).on("mouseup", function (e) {
        $dragging = null;
    });
});
    function pauseEvent(e){
    if(e.stopPropagation) e.stopPropagation();
    if(e.preventDefault) e.preventDefault();
    e.cancelBubble=true;
    e.returnValue=false;
    return false;
}

    </script>

</form>
</body>

</html>


