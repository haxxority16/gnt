<?php

include("config.php");
	
	$id    = $_GET['id'];
	$query = "UPDATE upload SET readit = 0 WHERE id = '$id'";
  $result = mysql_query($query);
  mysql_fetch_row($result);

?>