<HTML>
<?php 
 $db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
       	mysql_select_db($db);
        mysql_query("SET NAMES utf8");
?>




<head>
<SCRIPT LANGUAGE="Javascript"><!--
function senddata(){
  var pap=window.parent;
  alert('asdasd');
<?
  
$project = $_GET["project"]; 
?>

--></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<BODY ONLOAD="javascript:senddata();">
</BODY>
</HTML>
