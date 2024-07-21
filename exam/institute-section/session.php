<?php 
session_start();
include("connection.php");
if (!(isset($_SESSION["loginsession"]))) {
    header('location:login.php');
}
?>
