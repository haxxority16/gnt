<?php
/*
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Developed By : www.smartcoderszone.com [ Amit Kumar Paliwal ] *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

// Database connection variables
$dbServer = "localhost";
$dbDatabase = "gantt";
$dbUsername = "root";
$dbPassword = "5281";

$Conn = mysql_connect($dbServer, $dbUsername, $dbPassword) or die("Couldn't connect to database server");
mysql_select_db($dbDatabase, $Conn) or die("Couldn't connect to database $dbDatabase");

?>