<?php
function savedata1($arxeio,$id){  
 include("config.php");
 
//if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
//{ 
  
	$fileName = $arxeio['name'];
	$tmpName  = $arxeio['tmp_name'];
	$fileSize = $arxeio['size'];
	$fileType = $arxeio['type'];
  
  
//	$ida = $_GET["id"];  
  
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);
	
  
//	if(!get_magic_quotes_gpc())
//	{
//		$fileName = addslashes($fileName);
//	}
	
	$query = "INSERT INTO upload set name='".$fileName."', size='".$fileSize."', type='".$fileType."', content='".$content."', content_id='".$id."'";
//	mysql_query($query) or die('Error, query faddiled');
  
//	echo "<br>File $fileName uploaded<br>"; 
//}

//$query = "INSERT INTO upload set name='asdas', size='2', type='asdasd', content='asdasd', content_id=23 ";
$result1 = mysql_query($query);
$line1 = mysql_fetch_row($result1);

 }  
?> 

