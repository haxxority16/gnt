<?php

// Inialize session
session_start();

// Include database connection settings
require('connection.php');

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string(md5($_POST['password']));

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT name FROM staff WHERE (name = '" . $username . "') and (password = '" . $password . "')");

// Check username and password match
if (mysql_num_rows($login) == 1) {

/* 	Setting the username variable on session.			*
/*	This will be used on gantt.php to know each time 	*
 *	which username logged in and what permissions will 	* 
 *	be given. 											*/
$_SESSION['username'] = $_POST['username'];

// Jump to secured page
header('Location: gantt.php');
}
else {
// Jump to login page
header('Location: index.php');
}

?>