<?php
 
 
function Connect()
{
 $dbhost = "localhost";
 $dbuser = "jonhall2278deale";
 $dbpass = "andrew93";
 $dbname = "Dealerformdaysoff";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 
 return $conn;
}
 
?>