<?php 
include("session.php");
include("connection.php");
// change password
$stud_id = $_SESSION["loginStudent"];
if (isset($_GET['task']) && $_GET['task'] == 'changepass') {
    $cr_pass = $_POST["current_password"];
    $n_pass = $_POST["new_password"];
    $c_pass = $_POST["confirm_new_password"];
    $mpass = md5(md5($cr_pass));
    $m2pass = md5(md5($c_pass));
    if ($cr_pass == '') {
        echo "cr_pass";
    } else if ($n_pass != $c_pass) {
        echo "passnotmatch";
    } else {
        $sql = "SELECT * FROM students WHERE student_id = '$stud_id' and password = '$mpass'";
        $sql_run = $db->query($sql);
        $numrows = $sql_run->num_rows;
        if ($numrows == 0) {
            echo "cr_pass_w";
        } else {
            $sql = "UPDATE students SET password = '$m2pass' WHERE student_id = '$stud_id'";
            $sql_run = $db->query($sql);
            if ($sql_run) {
                echo "updated";
            } else {
                echo "not";
            }
        }
    }
}
?>