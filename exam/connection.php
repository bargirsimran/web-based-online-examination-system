<?php
include("data.php");
$db = new mysqli($hostname, $username, $password, $dbname);
if(!$db){
    die("Connection Not Established".$db->connect_error);
}
?>