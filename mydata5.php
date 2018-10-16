<html>
<head>
</head>
<body>
<?php

$con = mysql_connect("localhost","jonhall2278deale","andrew93");
if (!$con){
die("Can not connect: " . mysql_error());
}
mysql_select_db("Dealerformdaysoff",$con);


if(isset($_POST['update'])){
$UpdateQuery = "UPDATE tb_cform SET id='$_POST[ID]', hours='$_POST[hours]', jobs='$_POST[jobs]', date='$_POST[date]'";               
mysql_query($UpdateQuery, $con);
};

if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM tb_cform WHERE id='$_POST[id]'";          
mysql_query($DeleteQuery, $con);
};

if(isset($_POST['add'])){
$AddQuery = "INSERT INTO tb_cform (ID, hours, jobs, date) VALUES ('$_POST[ID]','$_POST[hours]','$_POST[jobs]','$_POST[date]')";         
mysql_query($AddQuery, $con);
};
 echo "<meta http-equiv='refresh' content='1; url=http://hfbcrm.com/dealer/admin/settings/working_days'>";


$sql = "SELECT * FROM tb_cform";
$myData = mysql_query($sql,$con);
echo "<table border=1>
<tr>
<th>ID</th>
<th>hours</th>
<th>jobs</th>
<th>Blackout dates</th>
</tr>";
while($record = mysql_fetch_array($myData)){
echo "<form action=http://hfbcrm.com/dealer/mydata5.php method=post>";
echo "<tr>";
echo "<td>" . "<input type=text name=id value='" . $record['ID'] . "' </td>";
echo "<td>" . "<input type=text name=hours value='" . $record['hours'] . "' </td>";
echo "<td>" . "<input type=text name=jobs value='" . $record['jobs'] . "' </td>";
echo "<td>" . "<input type=text name=date value='" . $record['date'] . "' </td>";
echo "<td>" . "<input type=submit name=update value=update" . " </td>";
echo "<td>" . "<input type=submit name=delete value=delete" . " </td>";
echo "</tr>";
echo "</form>";
}
echo "<form action=http://hfbcrm.com/dealer/mydata5.php method=post>";
echo "<tr>";
echo "<td><input type=text name=id></td>";
echo "<td><input type=text name=hours></td>";
echo "<td><input type=text name=jobs></td>";
echo "<td><input type=text name=date></td>";
echo "<td>" . "<input type=submit name=add value=add" . " </td>";
echo "</tr>";
echo "</form>";
echo "</table>";
mysql_close($con);

?>


</body>
</html>