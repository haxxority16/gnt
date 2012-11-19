<?php 
require_once('config.php');
// simulate that this proccess might take a while so you can see the loadingMessage option work.
sleep(1);

$stateID = $_POST['stateID'];
if(isset($stateID))
{
	$my_array = array();
	$result = mysql_query('select id,name from tasks where level=0');
	
	while($row = mysql_fetch_array($result))
	{
		$my_array[] = $row["id"];
		$my_array[] = $row["name"];
	}
	
	echo json_encode($my_array);	
}
?>