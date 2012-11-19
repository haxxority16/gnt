<?php 
 $db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);
        mysql_query("SET NAMES utf8");
	//return $link;
    session_start();
    $project = $_REQUEST["project"];
    $license = $_SESSION['license'];
    $user_id = $_SESSION['user_id'];
    $quer1 ="select canwrite,canwriteonparent from licenses where license_id = $license";
    $result1 = mysql_query($quer1);
    $line1  = mysql_fetch_row($result1); 
 // $line[0] = "false";
 // $line1[1] = "false";
if ($project=='full'){
   $quer ="select * from tasks where parent = 0 and readit = 1 and project_id in (select project_id from staff_tasks where user_id = $user_id)";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    
$asd ='{"tasks":[{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":'.$line[16].',"now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';

   while ($line=mysql_fetch_row($result)) {
$asd.=',{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":'.$line[16].',"now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';
   }
$asd.='],"selectedRow":0,"deletedTaskIds":[],"canWrite":'.$line1[0].',"canWriteOnParent":'.$line1[1].'}';

}else{
  $quer ="select * from tasks where project_id = $project and readit = 1";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    
$asd ='{"tasks":[{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":'.$line[16].',"now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';

   while ($line=mysql_fetch_row($result)) {
$asd.=',{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":'.$line[16].',"now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';
   }
$asd.='],"selectedRow":0,"deletedTaskIds":[],"canWrite":'.$line1[0].',"canWriteOnParent":'.$line1[1].' }';
}
echo $asd;

?>
