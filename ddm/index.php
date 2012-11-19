<?php 

$con = mysql_connect('localhost', 'root', '5281');
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("gantt", $con);
	mysql_query("SET NAMES utf8");
    $resultnames = mysql_query("SELECT id,name FROM tasks WHERE level=0") or die(mysql_error());
	
?>


<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="src/jquery.relatedselects.min.js" type="text/javascript"></script>

<style type="text/css">
body { font:12px helvetica, arial, sans-serif; }
</style>


<script>
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
}
</script>

<script type="text/javascript">

	function ajax_mine(stateID)
	{
		alert(stateID);
		$.ajax({
			type: "POST",
			url: "datasupplier.php",
			dataType: "json",
			data: {stateID:stateID},
     		success: function(data)
				{
					console.log("debug!");
					alert(data);
					//$('#secondselect').append('<option value="" selected="selected">Select YpoTask</option>');
					
					$("#secondselect option[value='secondmaker']").remove();
					
					for (var i=1; i<data.length; i+=2) {
						//console.log(data[i]);
						$('#secondselect').append('<option value="secondmaker">'+data[i]+'</option>');
					}
					
				}, error:function(data,msg,xhr) {console.log(data); console.log(msg); console.log(xhr);}
			});
	}
</script>

</head>
<body>

<form>
<select name="stateID" style="width:200px" onchange="showUser(this.value); ajax_mine(this.value);">
  <option value="">Select a project:</option>
  <?php while($rownames = mysql_fetch_array($resultnames)) {?> 
      <option value=" <?php echo $rownames['id']; ?> "><?php echo $rownames['name'];?></option> <?php }?>  
</select>

<select id="secondselect" name="countyID" onchange="showUser(this.value)";>
		<option value="" selected="selected">Select Task</option>
</select>
	
</form>

<br />
<div id="txtHint"><b>Projects will be listed here.</b></div>

</body>
</html>