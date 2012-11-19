<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<style type="text/css">
<!--
@import url("style.css");
-->
</style>
<?php
/*
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Developed By : www.smartcoderszone.com [ Amit Kumar Paliwal ] *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/
include("config.php");
 
 /*    Den exoume dikaiwmata pros to paron
   session_start();
   $user_id = $_SESSION['user_id'];
   $license = $_SESSION['license'];

  $quera ="select deletefile,downloadfile,uploadfile from licenses where license_id = $license";
  $resulta = mysql_query($quera);
  $linea  = mysql_fetch_row($resulta);
    */
  
               
$staff_id = $_GET['staff_id'];



?>
 
<table id="rounded-corner" summary="Έργα και δικαιώματα χρηστών">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">Έργο</th>
            <th scope="col" class="rounded-q1">Δικαιώματα</th>
        <!---    <th scope="col" class="rounded-q2">Q2</th>
            <th scope="col" class="rounded-q3">Q3</th>
            <th scope="col" class="rounded-q4">Q4</th>   -->
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td  class="rounded-foot-left"><em>Για αλλαγή των στοιχείων πατήστε πάνω στην εγγραφή</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<tr>
      <?php
// select records from database if exists to display
$queryq = "SELECT role from staff where user_id='".$staff_id."' ";
$resultq = mysql_query($queryq) or die('Error, query failed');
$lineq=mysql_fetch_row($resultq);

$query = "SELECT project_id from staff_tasks where user_id='".$staff_id."' ";
$result = mysql_query($query) or die('Error, query failed');
 while ($line=mysql_fetch_row($result)) {
 $query1 = "SELECT name from projects where project_id='".$line[0]."' ";
$result1 = mysql_query($query1);
$line1=mysql_fetch_row($result1);
 ?>
      	<td><?echo $line1[0]; ?></td>
            <td><?echo $lineq[0]; ?></td>

        </tr>
  <?}?>
    </tbody>
</table>





 </head>
</html>  
