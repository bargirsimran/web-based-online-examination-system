<?php
include("session.php");
include("connection.php");
$email = $_SESSION['loginsession'];
// insert department
if (isset($_GET['task']) && $_GET['task'] == 'department') {
    $department = $_POST['department'];
    $sql = "SELECT * FROM departments WHERE dept_name = '$department'";
    $sql_run = $db->query($sql);
    $numrows = $sql_run->num_rows;

    if ($numrows > 0) {
        echo "exists";
    } else {
        $did = uniqid('D-');
        $sql = "INSERT INTO departments (dept_id, dept_name) VALUES('$did','$department')";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "inserted";
        } else {
            echo "wrong";
        }
    }
}
// delete department
if (isset($_GET['task']) && $_GET['task'] == 'department_delete') {
    $did = $_GET['id'];
    $sql_run = $db->query("DELETE FROM departments WHERE dept_id = '$did' ");
    $resulttg = $db->query("SELECT * FROM test_groups WHERE dept_id='$did' ") or die('Error');
    $result = $db->query("SELECT * FROM students WHERE dept_id='$did' ") or die('Error');
    while ($row = $result->fetch_array()) {
        $sid = $row['student_id'];
        $r1  = $db->query("DELETE FROM grp_member WHERE student_id='$sid'") or die('Error');
    }
    $sql_run1 = $db->query("DELETE FROM students WHERE dept_id = '$did' ");

    $resulttd = $db->query("SELECT * FROM testdetails WHERE dept_id='$did' ") or die('Error');
    while ($row = $resulttd->fetch_array()) {
        $eid = $row['eid'];
        $result = $db->query("SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
        while ($rowq = $result->fetch_array()) {
            $qid = $rowq['qid'];
            $r1  = $db->query("DELETE FROM options WHERE qid='$qid'") or die('Error');
            $r2  = $db->query("DELETE FROM answer WHERE qid='$qid' ") or die('Error');
        }
        $r2  = $db->query("DELETE FROM user_answer WHERE eid='$eid' ") or die('Error');
        $r3 = $db->query("DELETE FROM questions WHERE eid='$eid' ") or die('Error');
        $r4 = $db->query("DELETE FROM testdetails WHERE eid='$eid' ") or die('Error');
        $r4 = $db->query("DELETE FROM history WHERE eid='$eid' ") or die('Error');
    }
    $sql_run = $db->query("DELETE FROM subjects WHERE dept_id = '$did' ");
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}

// insert year
if (isset($_GET['task']) && $_GET['task'] == 'class_year') {
    $class_year = $_POST['class_year'];
    $sql = "SELECT * FROM class_years WHERE year_name = '$class_year'";
    $sql_run = $db->query($sql);
    $numrows = $sql_run->num_rows;

    if ($numrows > 0) {
        echo "exists";
    } else {
        $did = uniqid('Y-');
        $sql = "INSERT INTO class_years (year_id, year_name) VALUES('$did','$class_year')";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "inserted";
        } else {
            echo "wrong";
        }
    }
}
// delete year
if (isset($_GET['task']) && $_GET['task'] == 'year_delete') {
    $did = $_GET['id'];
    $sql_run = $db->query("DELETE FROM class_years WHERE year_id = '$did' ");
    $resulttg = $db->query("SELECT * FROM test_groups WHERE year_id='$did' ") or die('Error');
    $result = $db->query("SELECT * FROM students WHERE year_id='$did' ") or die('Error');
    while ($row = $result->fetch_array()) {
        $sid = $row['student_id'];
        $r1  = $db->query("DELETE FROM grp_member WHERE student_id='$sid'") or die('Error');
    }
    $sql_run1 = $db->query("DELETE FROM students WHERE year_id = '$did' ");

    $resulttd = $db->query("SELECT * FROM testdetails WHERE year_id='$did' ") or die('Error');
    while ($row = $resulttd->fetch_array()) {
        $eid = $row['eid'];
        $result = $db->query("SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
        while ($rowq = $result->fetch_array()) {
            $qid = $rowq['qid'];
            $r1  = $db->query("DELETE FROM options WHERE qid='$qid'") or die('Error');
            $r2  = $db->query("DELETE FROM answer WHERE qid='$qid' ") or die('Error');
        }
        $r2  = $db->query("DELETE FROM user_answer WHERE eid='$eid' ") or die('Error');
        $r3 = $db->query("DELETE FROM questions WHERE eid='$eid' ") or die('Error');
        $r4 = $db->query("DELETE FROM testdetails WHERE eid='$eid' ") or die('Error');
        $r4 = $db->query("DELETE FROM history WHERE eid='$eid' ") or die('Error');
    }
    $sql_run = $db->query("DELETE FROM subjects WHERE year_id = '$did' ");
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}
// insert sem
if (isset($_GET['task']) && $_GET['task'] == 'semester') {
    $semester = $_POST['semester'];
    $sql = "SELECT * FROM semesters WHERE sem_name = '$semester'";
    $sql_run = $db->query($sql);
    $numrows = $sql_run->num_rows;

    if ($numrows > 0) {
        echo "exists";
    } else {
        $sid = uniqid('S-');
        $sql = "INSERT INTO semesters (sem_id, sem_name) VALUES('$sid','$semester')";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "inserted";
        } else {
            echo "wrong";
        }
    }
}

// delete sem
if (isset($_GET['task']) && $_GET['task'] == 'sem_delete') {
    $did = $_GET['id'];
    $sql = "DELETE FROM semesters WHERE sem_id = '$did' ";
    $sql_run = $db->query($sql);
    $resulttg = $db->query("SELECT * FROM test_groups WHERE sem_id='$did' ") or die('Error');
    $result = $db->query("SELECT * FROM students WHERE sem_id='$did' ") or die('Error');
    while ($row = $result->fetch_array()) {
        $sid = $row['student_id'];
        $r1  = $db->query("DELETE FROM grp_member WHERE sem_id='$sid'") or die('Error');
    }
    $sql_run1 = $db->query("DELETE FROM students WHERE sem_id = '$did' ");

    $resulttd = $db->query("SELECT * FROM testdetails WHERE sem_id='$did' ") or die('Error');
    while ($row = $resulttd->fetch_array()) {
        $eid = $row['eid'];
        $result = $db->query("SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
        while ($rowq = $result->fetch_array()) {
            $qid = $rowq['qid'];
            $r1  = $db->query("DELETE FROM options WHERE qid='$qid'") or die('Error');
            $r2  = $db->query("DELETE FROM answer WHERE qid='$qid' ") or die('Error');
        }
        $r2  = $db->query("DELETE FROM user_answer WHERE eid='$eid' ") or die('Error');
        $r3 = $db->query("DELETE FROM questions WHERE eid='$eid' ") or die('Error');
        $r4 = $db->query("DELETE FROM testdetails WHERE eid='$eid' ") or die('Error');
        $r4 = $db->query("DELETE FROM history WHERE eid='$eid' ") or die('Error');
    }
    $sql_run = $db->query("DELETE FROM subjects WHERE sem_id = '$did' ");
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}

// insert div
if (isset($_GET['task']) && $_GET['task'] == 'divisions') {
    $div = $_POST['div'];
    $sql = "SELECT * FROM divisions WHERE div_name = '$div'";
    $sql_run = $db->query($sql);
    $numrows = $sql_run->num_rows;

    if ($numrows > 0) {
        echo "exists";
    } else {
        $did = uniqid('DIV-');
        $sql = "INSERT INTO divisions (div_id, div_name) VALUES('$did','$div')";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "inserted";
        } else {
            echo "wrong";
        }
    }
}

// delete division
if (isset($_GET['task']) && $_GET['task'] == 'div_delete') {
    $sid = $_GET['id'];
    $sql = "DELETE FROM divisions WHERE div_id = '$sid' ";
    $sql_run = $db->query($sql);
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}

// add subject
if (isset($_GET['task']) && $_GET['task'] == 'subject') {
    // subject detail
    $department = $_POST['department'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $subject = $db->real_escape_string($_POST['subject']);


    $sql = "SELECT * FROM subjects WHERE dept_id = '$department' && year_id = '$year' && sem_id = '$sem' && subject_name = '$subject'";
    $sql_run = $db->query($sql);
    $numrows = $sql_run->num_rows;

    if ($numrows > 0) {
        echo "exists";
    } else {
        $sid = uniqid('SUB-');
        $sql = "INSERT INTO subjects (subject_id, dept_id, year_id, sem_id, subject_name ) VALUES('$sid','$department','$year','$sem','$subject')";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "inserted";
        } else {
            echo "wrong";
        }
    }
}

// delete subject
if (isset($_GET['task']) && $_GET['task'] == 'subject_delete') {
    $sid = $_GET['id'];
    $sql = "DELETE FROM subjects WHERE subject_id = '$sid' ";
    $sql_run = $db->query($sql);
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}

// create group
if (isset($_GET['task']) && $_GET['task'] == 'group') {
    // subject detail
    $department = $_POST['department'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $grp = $db->real_escape_string($_POST['group']);


    $sql = "SELECT * FROM test_groups WHERE dept_id = '$department' && year_id = '$year' && sem_id = '$sem' && grp_name = '$grp'";
    $sql_run = $db->query($sql);
    $numrows = $sql_run->num_rows;

    if ($numrows > 0) {
        echo "exists";
    } else {
        $sid = uniqid('GRP-');
        $sql = "INSERT INTO test_groups (grp_id, dept_id, year_id, sem_id, grp_name ) VALUES('$sid','$department','$year','$sem','$grp')";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "inserted";
        } else {
            echo "wrong";
        }
    }
}

// delete group
if (isset($_GET['task']) && $_GET['task'] == 'group_delete') {
    $gid = $_GET['id'];
    $sql = "DELETE FROM test_groups WHERE grp_id = '$gid' ";
    $sql_run = $db->query($sql);
    $sql1 = "DELETE FROM grp_member WHERE grp_id = '$gid' ";
    $sql_run1 = $db->query($sql1);
    if ($sql_run && $sql_run1) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}

// add members
if (!empty($_POST['students_list'])  && $_GET['task'] == 'grp_members') {
    $gid = $_GET['grp_id'];
    $del =  $db->query("DELETE FROM grp_member WHERE grp_id='$gid'");
    foreach ($_POST['students_list'] as $value) {
         $data = $db->query("INSERT INTO  grp_member (grp_id,student_id) VALUES( '$gid','$value')");
    }
    echo "updated";
}
// asssign_group
if ($_GET['task'] == 'asssign_group') {
    $tid = $_GET['test_id'];
    $data = "";
    $up_data = "";
    foreach ($_POST['grp_list'] as $value) {
        $data = $data . "," . $value;
    }
    if (strlen($data) != 0) {
        $up_data = substr($data, 1);
    } else {
        $up_data = "";
    }
    $q = $db->query("UPDATE testdetails SET grp_id='$up_data' WHERE eid ='$tid'");
    if ($q) {
        echo "updated";
    }
}

// create admins
if (isset($_GET['task']) && $_GET['task'] == 'admin') {
    // subject detail
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $mpass = md5(md5($pass));
    if ($pass != $cpass) {
        echo "passnotmatch";
    } else if ($email == "") {
        echo "email";
    } else if ($fname == "") {
        echo "fname";
    } else if ($lname == "") {
        echo "lname";
    } else {
        $sql = "SELECT * FROM institute_admin WHERE email = '$email' LIMIT 1";
        $sql_run = $db->query($sql);
        $numrows = $sql_run->num_rows;

        if ($numrows > 0) {
            echo "exists";
        } else {

            $sql = "INSERT INTO institute_admin (fname, lname, email, password ) VALUES('$fname','$lname','$email','$mpass')";
            $sql_run = $db->query($sql);
            if ($sql_run) {
                echo "inserted";
            } else {
                echo "wrong";
            }
        }
    }
}
// delete addmin
if (isset($_GET['task']) && $_GET['task'] == 'admin_delete') {
    $aid = $_GET['id'];
    $sql = "DELETE FROM institute_admin WHERE id = '$aid' ";
    $sql_run = $db->query($sql);
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}

// change password
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
        $sql = "SELECT * FROM institute_admin WHERE email = '$email' and password = '$mpass'";
        $sql_run = $db->query($sql);
        $numrows = $sql_run->num_rows;
        if ($numrows == 0) {
            echo "cr_pass_w";
        } else {
            $sql = "UPDATE institute_admin SET password = '$m2pass' WHERE email = '$email'";
            $sql_run = $db->query($sql);
            if ($sql_run) {
                echo "updated";
            } else {
                echo "not";
            }
        }
    }
}
// change password
if (isset($_GET['task']) && $_GET['task'] == 'std_changepass') {
    $std = $_GET["stud"];
    $n_pass = $_POST["new_password"];
    $c_pass = $_POST["confirm_new_password"];
    $m2pass = md5(md5($c_pass));
    if ($n_pass != $c_pass) {
        echo "passnotmatch";
    } else {

        $sql = "UPDATE students SET password = '$m2pass' WHERE student_id = '$std'";
        $sql_run = $db->query($sql);
        if ($sql_run) {
            echo "updated";
        } else {
            echo "not";
        }
    }
}

// create students
if (isset($_GET['task']) && $_GET['task'] == 'student') {
    // subject detail
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $dept = $_POST['dept'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $examnum = $_POST['exnum'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $mpass = md5(md5($pass));

    if ($pass != $cpass) {
        echo "passnotmatch";
    } else if ($email == "") {
        echo "email";
    } else if ($mname == "") {
        echo "mname";
    } else if ($fname == "") {
        echo "fname";
    } else if ($lname == "") {
        echo "lname";
    } else if ($dob == "") {
        echo "dob";
    } else if ($dept == "") {
        echo "dept";
    } else if ($year == "") {
        echo "year";
    } else if ($sem == "") {
        echo "sem";
    } else if ($examnum == "") {
        echo "examnum";
    } else {
        $sql = "SELECT * FROM students WHERE exam_num = '$examnum' LIMIT 1";
        $sql_run = $db->query($sql);
        $numrows = $sql_run->num_rows;

        if ($numrows > 0) {
            echo "exists";
        } else {
            $sid = uniqid('STD');
            $sql = "INSERT INTO students (fname,mname,lname, email, dob, dept_id, year_id,sem_id, exam_num, password, student_id ) VALUES('$fname','$mname','$lname','$email','$dob','$dept','$year','$sem','$examnum','$mpass','$sid')";
            $sql_run = $db->query($sql);
            if ($sql_run) {
                echo "inserted";
            } else {
                echo "wrong";
            }
        }
    }
}
// delete student
if (isset($_GET['task']) && $_GET['task'] == 'student_delete') {
    $sid = $_GET['id'];
    $sql = "DELETE FROM students WHERE student_id = '$sid' ";
    $sql_run = $db->query($sql);
    if ($sql_run) {
        echo 'deleted';
    } else {
        echo 'wrong';
    }
}
// get subject op
if (isset($_GET['task']) && $_GET['task'] == 'subjectop') {
    $d = $_GET['d'];
    $y = $_GET['y'];
    $s = $_GET['s'];
    if ($d != "" && $y != "" && $s != "") {
        $sql = "SELECT subject_id, subject_name FROM subjects WHERE dept_id = '$d' && year_id = '$y' && sem_id='$s'";
        $sql_run = $db->query($sql);
        echo '<option selected disabled>Choose Subject</option>';
        while ($rows = $sql_run->fetch_assoc()) {
            $si = $rows['subject_id'];
            $sn = $rows['subject_name'];
            echo '<option value="' . $si . '">' . $sn . '</option>';
        }
    }
}
