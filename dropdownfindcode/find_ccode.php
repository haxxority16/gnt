<?php 
 $db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);
        mysql_query("SET NAMES greek");
	//return $link;

$project = $_REQUEST["project"]; 

  $quer ="select * from tasks where project_id = $project ";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    
$asd ='{"tasks":[{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[2].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"","description":"'.$line[11].'","progress":'.$line[12].'}';

   while ($line=mysql_fetch_row($result)) {
$asd.=',{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[2].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":'.$line[12].'}';
   }
$asd.='],"selectedRow":0,"deletedTaskIds":[],"canWrite":true,"canWriteOnParent":true }';

echo $asd;

?>
