<?php 
 $db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);
        mysql_query("SET NAMES utf8");
	//return $link;

$id = $_GET["id"]; 

  $query = "UPDATE tasks SET readit = 0 WHERE  id = '$id' or parent = '$id' ";
  
  $subquery = "select id from tasks where parent = '$id' ";
  $subresult = mysql_query($subquery);
 if ($subline = mysql_fetch_array($subresult)){
  
  $query.= " or ( parent in ( ";
  $query.=" $subline[0] ";
  while ($subline = mysql_fetch_row($subresult)) {
  $query.=" , '$subline[0]' ";
  }
  $query.=" ))";     
   }             
  
 $result = mysql_query($query);
 $line = mysql_fetch_row($result); 
 
   /*
  $subquery = "select id from tasks where parent = '$id' ";
  $subresult = mysql_query($subquery);
  //$subline = fetch_row($subresult);
   while ($subline = mysql_fetch_row($subresult)) {
     echo $sbline[0];
  }
     */
 



//	$query = "UPDATE tasks SET readit = 0 WHERE id in (select id from tasks where id = '$id' or parent = '$id' or (parent in (select id from tasks where parent = '$id')))";
//  $result = mysql_query($query);
//  mysql_fetch_row($result);

?>
