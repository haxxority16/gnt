<?php
/*
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Developed By : www.smartcoderszone.com [ Amit Kumar Paliwal ] *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

if(isset($_GET['id']))
{
	// if id is set then get the file with the id from database
	
	include("config.php");
	
	$id    = $_GET['id'];
	$query = "SELECT name, type, size, data " .
			 "FROM file WHERE id = '$id'";
	
	$result = mysql_query($query) or die('Error, query failed');
	list($name, $type, $size, $data) =  mysql_fetch_array($result);
	
	header("Content-length: $size");
	header("Content-type: $type");
	header("Content-Disposition: attachment; filename=$name");
	echo $data;
	
	exit;
}

?>