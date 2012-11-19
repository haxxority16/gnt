<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<?php

 
$db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);

   mysql_query("SET NAMES utf8");
   

$user_id = $_POST["user_id"];  
$name = $_POST["name"];
$license = $_POST["license"];

  
     $quer1 ="select description from licenses where license_id = '$license' ";
     $result1 = mysql_query($quer1);
     $line1 = mysql_fetch_row($result1);
  
     $quer ="INSERT INTO staff (user_id,name,password,role,licenses) VALUES ('$user_id','$name','$name','$line1[0]','$license')";
     $result = mysql_query($quer);
     $line = mysql_fetch_row($result);

?>

 </head>
</html>  
