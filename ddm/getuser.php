<?php
$q=$_GET["q"];

$con = mysql_connect('localhost', 'root', '5281');
mysql_query("SET NAMES utf8");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("gantt", $con);

$sql="SELECT * FROM tasks WHERE id = '".$q."'";

$result = mysql_query($sql) or die(mysql_error());

echo "<table border='1'>
<tr>
<th>Project name</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  //echo $row['name'];
  echo "<td>" . $row['name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";    

mysql_close($con);
?>