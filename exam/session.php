<?php 
session_start();
include("connection.php");
if (!(isset($_SESSION["loginStudent"]))) {
    header('location:login.php');
}
?>
