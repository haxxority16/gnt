<?php

$hostname = 'localhost';        // Our MySQL hostname. Usualy named as 'localhost', so we're NOT necessary to change this even this script has already online on the internet.
$dbname   = 'gantt'; 			// Our database name.
$username = 'root';             // Our database username.
$password = '5281';             // Our database password. If our database has no password, leave it empty.

// Let's connect to host
mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');
// Select the database
mysql_select_db($dbname) or DIE('Database name is not available!');
// Set unicode for the queries we will do.
mysql_query("SET NAMES utf8");

?>