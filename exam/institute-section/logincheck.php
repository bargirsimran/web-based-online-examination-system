<?php
session_start();
include('connection.php');
$username = $db->real_escape_string($_POST['username']);
$password = $db->real_escape_string($_POST['password']);
$mpass    = md5(md5($password));

$sql = "SELECT * FROM institute_admin WHERE email = '$username' AND password = '$mpass' LIMIT 1 ";
$sql_run = $db->query($sql);
$rows = $sql_run->fetch_array();
$numrows = $sql_run->num_rows;
if ($numrows > 0) {
    if (isset($_POST["rem_me"])) {
        setcookie("eusername1", $username, time() + (365 * 24 * 60 * 60));
        setcookie("epass1", $password, time() + (365 * 24 * 60 * 60));
    } else {
        if (isset($_COOKIE["eusername1"])) {
            setcookie("eusername1", "");
        }
        if (isset($_COOKIE["epass1"])) {
            setcookie("epass1", "");
        }
    }
    echo "success";
    $_SESSION["loginsession"] = $username;
} else {
    echo "wrong";
}
