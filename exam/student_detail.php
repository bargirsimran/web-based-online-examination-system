<?php
$stud_id = $_SESSION["loginStudent"];
$sql = "SELECT * FROM students WHERE student_id = '$stud_id'";
$sql_run = $db->query($sql);
$rows = $sql_run->fetch_assoc();
$fname = $rows['fname'];
$mname = $rows['mname'];
$lname = $rows['lname'];
$email = $rows['email'];
$year_id = $rows['year_id'];
$dept_id = $rows['dept_id'];
$sem_id = $rows['sem_id'];
$exam_num = $rows['exam_num'];
$dob = $rows['dob'];

$sqld = "SELECT dept_name FROM departments WHERE dept_id = '$dept_id' ";
$sql_rund = $db->query($sqld);
$rowsd = $sql_rund->fetch_assoc();
$dn = $rowsd['dept_name'];

$sqly = "SELECT year_name FROM class_years WHERE  year_id = '$year_id' ";
$sql_runy = $db->query($sqly);
$rowsy = $sql_runy->fetch_assoc();
$yn = $rowsy['year_name'];

$sqls = "SELECT sem_name FROM semesters WHERE sem_id = '$sem_id' ";
$sql_runs = $db->query($sqls);
$rowss = $sql_runs->fetch_assoc();
$sn = $rowss['sem_name'];
?>