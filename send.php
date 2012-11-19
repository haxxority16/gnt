<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <form enctype='multipart/form-data' name='frmupload' action='' method='POST'>
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
	<tr>
	<td width="246">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
	<input name="userfile" type="file" id="userfile" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" >
  
  <?php 
//function savedata1(){ 
 include("config.php");   
if(isset($_POST['saveButton']) && $_FILES['userfile']['size'] > 0)
{   
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type']; 
 //$id = $_POST["id"]; 
 //  $id = 0;
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);
	
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
	}
	$query = "INSERT INTO upload set name='".$fileName."', size='".$fileSize."', type='".$fileType."', content='".$content."'";
	 mysql_query($query) or die('Error, query failed');
 }  
?> 


<div id="moreUploads"></div>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput();">Πρόσθεσε και άλλο αρχείο</a></div>  
 <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Επιφόρτωση Αρχείου "></td></form>  
<!--- <input type="file" name="attachment" id="attachment" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />  -->
	</td>
</tr>
	</table>
   
  
  
   <script type="text/javascript">  
    //αυτο χρησιμοποιείται για την περίπτωση που θέλουμε να ανεβάσουμε περισσότερα του ενός αρχεία 
 var upload_number = 1;
function addFileInput() {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", "userfile"+upload_number);
 	d.appendChild(file);
 	document.getElementById("moreUploads").appendChild(d);
 	upload_number++;
}
    </script>