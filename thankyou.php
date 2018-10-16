<?php

require 'connection.php';
$conn    = Connect();
$hours   = $conn->real_escape_string($_POST['hours']);
$jobs   = $conn->real_escape_string($_POST['jobs']);
$date   = $conn->real_escape_string($_POST['date']);
$query   = "INSERT into tb_cform (hours,jobs,date) VALUES('" . $hours . "','" . $jobs . "','" . $date . "')";
$success = $conn->query($query);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}

echo "Your Info has been updated <a href='/dealer/admin/settings/working_days'>Go Back</a><br>";

$conn->close();

?>