<?php
session_start();
include('connection.php');
$username = $db->real_escape_string($_POST['username']);
$password = $db->real_escape_string($_POST['password']);
$mpass    = md5(md5($password));

$sql = "SELECT * FROM students WHERE exam_num = '$username'";
$sql_run = $db->query($sql);
if ($sql_run) {
    $rows = $sql_run->fetch_assoc();
    $nr = $sql_run->num_rows;
    if ($nr > 0) {
        $student_id = $rows['student_id'];
        $pass = $rows['password'];
        if ($mpass == $pass) {
            if (isset($_POST["rem_me"])) {
                setcookie("eusername0", $username, time() + (365 * 24 * 60 * 60));
                setcookie("epass0", $password, time() + (365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE["eusername0"])) {
                    setcookie("eusername0", "");
                }
                if (isset($_COOKIE["epass0"])) {
                    setcookie("epass0", "");
                }
            }
            echo '{"msg":"success"}';
            $_SESSION["loginStudent"] = $student_id;
        } else {
            echo '{"msg":"wrong"}';
        }
    }else{
        echo '{"msg":"wrong"}'; 
    }
} else {
    echo '{"msg":"wrong"}';
}
