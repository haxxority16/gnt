<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<?php

 
$db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);
 if (stripos($_SERVER["HTTP_USER_AGENT"],"ie")){
  mysql_query("SET NAMES greek");
  }else {
   mysql_query("SET NAMES utf8");
   }
	//return $link;
     session_start();
$user_id = $_SESSION['user_id'];
$id = $_GET["id"];  
$name = $_GET["name"];
$code = $_GET["code"];
$description = $_GET["description"];
$status = $_GET["status"];
$progress = $_GET["progress"];
$fprogress = $_GET["fprogress"];
$duration = $_GET["duration"];
$depends = $_GET["depends"];
$level = $_GET["level"];
$starti = $_GET["starti"];
$endi = $_GET["endi"];
$startIsMilestone = $_GET["startIsMilestone"];
$endIsMilestone = $_GET["endIsMilestone"];
$full_mes = $_GET["full_mes"];
$now_mes = $_GET["now_mes"];
$ffull_mes = $_GET["ffull_mes"];
$fnow_mes = $_GET["fnow_mes"];

  $dob1=trim($starti);//$dob1='dd/mm/yyyy' format
			list($d, $m, $y) = explode('/', $dob1);
			$start=mktime(0, 0, 0, $m, $d, $y)*1000;
      
  $dob2=trim($endi);//$dob1='dd/mm/yyyy' format
			list($d, $m, $y) = explode('/', $dob2);
		//	$end=mktime(23, 59, 59, $m, $d, $y)*1000+999;
    $end=mktime(0, 0, 0, $m, $d, $y)*1000;
  
   

   if ($id) {
   
    // ta tria ayta erwtimata ginontai prokeimenou na kratame tin istoria twn allagwn stis ergasies
    $quers ='select name,code,level,status,start,duration,end,startIsMilestone,endIsMilestone,depends,description,progress,assigs,project_id,parent,full_mes,now_mes,fprogress,ffull_mes,fnow_mes,readit from tasks where id='.$id.' ';
    $results = mysql_query($quers);
    $lines = mysql_fetch_row($results);
    
    $quersd ='select max(aukswn) from oldtasks where id='.$id.' ';
    $resultsd = mysql_query($quersd);
    $linesd = mysql_fetch_row($resultsd);

     
     $quersf ="INSERT INTO old_tasks (task_id,aukswn,name,code,level,status,start,duration,end,startIsMilestone,endIsMilestone,depends,description,progress,assigs,project_id,parent,full_mes,now_mes,fprogress,ffull_mes,fnow_mes,readit,staff_name) VALUES ('$id','$linesd[0]+1','$lines[0]','$lines[1]','$lines[2]','$lines[3]','$lines[4]','$lines[5]','$lines[6]','$lines[7]','$lines[8]','$lines[9]','$lines[10]','$lines[11]','$lines[12]','$lines[13]','$lines[14]','$lines[15]','$lines[16]','$lines[17]','$lines[18]','$lines[19]','$lines[20]','$user_id')";
     $resultsf = mysql_query($quersf);
     $linesf = mysql_fetch_row($resultsf);

   
   
   // 8elw na dw ti progress eixe arxika i ergasia (prin to update)
    $querw ='select progress,level,fprogress,now_mes from tasks where id='.$id.' ';
    $resultw = mysql_query($querw);
    $linew = mysql_fetch_row($resultw);

/*   
if ($progress==$linew[0] && ($now_mes!=$linew[3])){
if (($full_mes!=0) && ($now_mes!=0)) {    //8a valw ton elegxo na ginetai eksw wste na min mporei na exei timi to now_mes enw to full_mes na eina 0
$progress = (1-(($full_mes-$now_mes)/$full_mes))*100;
}
}
*/
//else{
//$progress = (1-(($full_mes-$now_mes)/$full_mes))*100;
//$now_mes = ($full_mes-(1-($progress/100)*$full_mes));
//}
   
   
   //ginete to update me ta nea dedomena
    $quer ='UPDATE tasks SET name = "'.$name.'" , description ="'.$description.'" , progress ="'.$progress.'" , fprogress ="'.$fprogress.'" , duration="'.$duration.'", depends="'.$depends.'", start="'.$start.'", end="'.$end.'", level="'.$level.'",startIsMilestone="'.$startIsMilestone.'",endIsMilestone="'.$endIsMilestone.'",full_mes="'.$full_mes.'",now_mes="'.$now_mes.'",ffull_mes="'.$ffull_mes.'",fnow_mes="'.$fnow_mes.'" WHERE id='.$id.' ';
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
   
   // vriskw to sinolo twn energeiwn poy vriskontai katw apo ena paketo ergasiwn kai to id toy paketoy ergasiwn 
    $quer1 ='select parent,count(parent) from tasks where parent = (select parent from tasks where id='.$id.') ';
    $result1 = mysql_query($quer1);
    $line1 = mysql_fetch_row($result1); 
    
 //   for ($i=0;$i=$linew[1]; $i++) {        //


 
 //gia na ayksanetai to pososto oloklirwseis twn parrent ergasiwn  !! ypologizei mono postosta
 while ($linew[1])
  {
   /*   To xrisimopoiw gia tin periptwsi poy 8elw ta parents na simplirw8oyn aytomata me vasi ta pososta kai oxi me vasi tis ergatowres
    //vriskw to progress toy paketoy ergasiwn prin
    $quer2 ='select progress,fprogress from tasks where id='.$line1[0].' ';
    $result2 = mysql_query($quer2);
    $line2 = mysql_fetch_row($result2);
    
    // sigkrinw to progress tis diadikasias prin me auto meta to update, an einai megalutero prepei na pros8esw tin diafora alliws prepei na tin afairesw
    if ($progress>$linew[0]){
    $absprogress = abs($progress-$linew[0]);
    $upprogress = $line2[0]+($absprogress/$line1[1]);
    } else {
    $absprogress = abs($progress-$linew[0]);
    $upprogress = $line2[0]-($absprogress/$line1[1]);
    }
        
     // To idio kai gia to oikonomiko paketo
    if ($fprogress>$linew[2]){
    $fabsprogress = abs($fprogress-$linew[2]);
    $fupprogress = $line2[1]+($fabsprogress/$line1[1]);
    } else {
    $fabsprogress = abs($fprogress-$linew[2]);
    $fupprogress = $line2[1]-($fabsprogress/$line1[1]);
    }
     */
     
    $querw ='select progress,level,fprogress from tasks where id='.$line1[0].' ';    //
    $resultw = mysql_query($querw);
    $linew = mysql_fetch_row($resultw);
    
    $quer3 ='select sum(full_mes),sum(now_mes),sum(ffull_mes),sum(fnow_mes) from tasks where parent='.$line1[0].' ';    //
    $result3 = mysql_query($quer3);
    $line3 = mysql_fetch_row($result3);
    
    if ($line3[0]){
    $upprogress = (1-(($line3[0]-$line3[1])/$line3[0]))*100;
    }
    if ($line3[2]){
    $fupprogress = (1-(($line3[2]-$line3[3])/$line3[2]))*100;
    }
    
    $quer ='UPDATE tasks SET progress ="'.$upprogress.'",fprogress ="'.$fupprogress.'",full_mes="'.$line3[0].'",now_mes="'.$line3[1].'",ffull_mes="'.$line3[2].'",fnow_mes="'.$line3[3].'" WHERE id='.$line1[0].' ';       //  ,ful_mes="'.$line3[0].'",now_mes="'.$line3[1].'",fful_mes="'.$line3[2].'",fnow_mes="'.$line3[3].'"
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    $progress = $upprogress;
    $fprogress = $fupprogress; 
    
  // $querw ='select progress from tasks where id='.$line1[0].' ';  //
  //  $resultw = mysql_query($querw);
  //  $linew = mysql_fetch_row($resultw);  
    
    $id = $line[0];
    $quer1 ='select parent,count(parent) from tasks where parent = (select parent from tasks where id='.$line1[0].') ';  
    $result1 = mysql_query($quer1);
    $line1 = mysql_fetch_row($result1); 
    }
    
  /*  
  //Gia na ayksanontai ta antistoixa pososta oloklirwsis alla me vasi tin simplirwsi twn porwn
   while ($linew[1])
  {
    //vriskw to progress toy paketoy ergasiwn prin
    $quer2 ='select progress from tasks where id='.$line1[0].' ';
    $result2 = mysql_query($quer2);
    $line2 = mysql_fetch_row($result2);
    
   
    
    $querw ='select progress,level from tasks where id='.$line1[0].' ';    //
    $resultw = mysql_query($querw);
    $linew = mysql_fetch_row($resultw);
   // $progress = $linec[0];      
    
    $quer ='UPDATE tasks SET progress ="'.$upprogress.'" WHERE id='.$line1[0].' ';
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    $progress = $upprogress;
    
  // $querw ='select progress from tasks where id='.$line1[0].' ';  //
  //  $resultw = mysql_query($querw);
  //  $linew = mysql_fetch_row($resultw);  
    
     $quer1 ='select parent,count(parent) from tasks where parent = (select parent from tasks where id='.$line1[0].') ';  
    $result1 = mysql_query($quer1);
    $line1 = mysql_fetch_row($result1); 
    }
   */
    
    }else{
   $quer1 ="INSERT INTO tasks (name, description, progress, duration, depends, start, end, level) VALUES ('$name','$description', '$progress', '$duration', '$depends', '$start', '$end', '$level')";
     $result1 = mysql_query($quer1);
   $line1 = mysql_fetch_row($result1);
    }  

?>

 </head>
</html>  
