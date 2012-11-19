<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <style>
body {background-image:url('205.gif');}
</style>
<?php
/*
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Developed By : www.smartcoderszone.com [ Amit Kumar Paliwal ] *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/
include("config.php");
     
 session_start();
$user_id = $_SESSION['user_id'];
$license = $_SESSION['license'];

  $quera ="select deletefile,downloadfile,uploadfile from licenses where license_id = $license";
  $resulta = mysql_query($quera);
  $linea  = mysql_fetch_row($resulta);
               
$content_id = $_GET['id'];
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);
	
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
	}
	

	$query = "INSERT INTO upload set name='".$fileName."', size='".$fileSize."', type='".$fileType."', content='".$content."', content_id='".$content_id."', readit = 1";
	mysql_query($query) or die('Error, query failed');
	echo "<br>Προστέθηκε το αρχείο $fileName <br>";
}


?>
 <body>
<table cellpadding="10" cellspacing="0" width="100%" border="0" align="center">

<tr><td align="center">
<?php
// select records from database if exists to display
$query1 = "SELECT id, name FROM upload where content_id='".$content_id."' and readit = '1' ";
$result1 = mysql_query($query1) or die('Error, query failed');
if(mysql_num_rows($result1)>0)
{
	while(list($id, $name) = mysql_fetch_array($result1))
	{
	?> <?php if ($linea[1]=="true") { ?> 
		<a href="download.php?id=<?php echo $id;?>"><?php echo $name;?></a> 
    <? } else { ?>
    <?php echo $name;
    }?>
    <?php if ($linea[0]=="true") {?> 
     <a  href="#" onclick="deletefile(<? print $id?>)" > <img src="trash.gif" border="0" alt="Διαγραφή"> </a>
     <?php } ?>
     <br> 
	<?php
 	}
} else {
print "Δεν υπάρχουν διαθέσιμα αρχεία";
}
?>
</td></tr>
   <?php if ($linea[2]=="true") {?> 
<tr><td align="center">
	<form method="post" enctype="multipart/form-data">
	<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
	<tr>
	<td width="246">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
	<input name="userfile" type="file" id="userfile">
	</td>
	<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Μεταφόρτωση αρχείου "></td>
	</tr>
	</table>
	</form>
</td></tr>
   <?php }?> 
</table>
  
  <script type="text/javascript">
function deletefile(el){

var xmlhttp;
var id =el; 
// alert(id);
    if (window.XMLHttpRequest) {
      xmlhttp=new XMLHttpRequest();
    }
    else {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");     
   }

   xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("userfile").innerHTML=xmlhttp.responseText;
    }
  }    
xmlhttp.open("GET","delete.php?id="+id,true);
xmlhttp.send();
setTimeout("location.reload(true);",0);
}
</script>

 </head>
</html>  
