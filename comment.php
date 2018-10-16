<?php
mysql_connect("localhost","jonhall2278deale","andrew93");
mysql_select_db("dealercoll");
$notify = "";
$leads_id=$_POST['leads_id'];
$user_id=$_POST['user_id'];
$users_id=$_POST['users_id'];
$comment=$_POST['comment'];
$dates=$_POST['dates'];
$submit=$_POST['submit'];
if(isset($_POST['notify_box'])){ $notify = $_POST['notify_box']; }
$dbLink = mysql_connect("localhost","jonhall2278deale","andrew93");
    mysql_query("SET character_set_client=utf8", $dbLink);
    mysql_query("SET character_set_connection=utf8", $dbLink);
 $insert=mysql_query("INSERT INTO comments (leads_id, user_id, users_id, comment, dates) VALUES ('$leads_id', '$user_id' , '$users_id' , '$comment' , '$dates') ");

$dbLink = mysql_connect("localhost","jonhall2278deale","andrew93");
mysql_query("SET character_set_results=utf8", $dbLink);
mb_language('uni');
mb_internal_encoding('UTF-8');
 
$sql = "SELECT * FROM comments";
$getquery = mysql_query($sql);
?>
<script language=javascript>
window.history.go(-1);
</script>