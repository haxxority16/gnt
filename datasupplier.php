<?php 
$db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);

   mysql_query("SET NAMES utf8");
   
$stateID = $_POST['stateID'];
if(isset($stateID))
{
	$my_array = array();
	$result = mysql_query("select id,name from tasks where level=1 and project_id = $stateID ");
	
	while($row = mysql_fetch_array($result))
	{
		$my_array[] = $row["id"];
		$my_array[] = $row["name"];
	}
	
	echo json_encode($my_array);	
}
?>