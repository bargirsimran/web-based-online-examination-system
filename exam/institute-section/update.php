<?php
include("session.php");
include("connection.php");
if (isset($_GET['task']) && $_GET['task'] == "new_test") {
    $d = $_POST['dept'];
    $y = $_POST['year'];
    $s = $_POST['sem'];
    $sub = $_POST['subject'];
    $title    = $_POST['title'];
    $title    = ucwords(strtolower($title));
    $total   = $_POST['total'];
    $correct = $_POST['right'];
    $wrong   = $_POST['wrong'];
    $time    = $_POST['time'];
    // $subjective    = $_POST['subjective'];
    // $submark    = $_POST['submark'];
    $status  = "disabled";
    $id      = uniqid('T');
    date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
    $date    = date('d-m-Y H:i:s');
    if($subjective>0){
        mkdir($id, 0777, true);
    }
    $sql = $sql = "INSERT INTO testdetails (id, eid, dept_id, year_id, sem_id, subject_id, title, correct, wrong, total, time, date, status) VALUES (NULL,'$id','$d','$y','$s','$sub','$title','$correct','$wrong','$total','$time','$date','$status')";
    $sql_run     = $db->query($sql);

    if ($sql_run) {
        echo '{"msg":"success","test_id":"' . $id . '"}';
    } else {
        echo '{"msg":"error"}';
    }
}


if (isset($_GET['test_id']) && $_GET['task'] == "addqns") {
    $tid      = $_GET['test_id'];
    $query    = "SELECT * FROM testdetails WHERE eid='$tid'";
    $results  = $db->query($query);
    $num      = $results->fetch_array();
    $n        = $num['total'];
    $ch       = "4";
    for ($i = 1; $i <= $n; $i++) {
        $qid  = uniqid('Q-');
        $qns  = addslashes($_POST['qns' . $i]);
        $q3   = $db->query("INSERT INTO questions(id, eid, qid, qns, choice, sn) VALUES (NULL,'$tid','$qid','$qns','$ch','$i')") or die();
        $oaid = uniqid('OP-');
        $obid = uniqid('OP-');
        $ocid = uniqid('OP-');
        $odid = uniqid('OP-');
        $a    = addslashes($_POST[$i . '1']);
        $b    = addslashes($_POST[$i . '2']);
        $c    = addslashes($_POST[$i . '3']);
        $d    = addslashes($_POST[$i . '4']);
        $qa   = $db->query("INSERT INTO options VALUES  (NULL,'$qid','$a','$oaid','1')");
        $qb   = $db->query("INSERT INTO options VALUES  (NULL,'$qid','$b','$obid','2')");
        $qb   = $db->query("INSERT INTO options VALUES  (NULL,'$qid','$c','$ocid','3')");
        $qd   = $db->query("INSERT INTO options VALUES  (NULL,'$qid','$d','$odid','4')");
        $e    = $_POST['ans' . $i];
        switch ($e) {
            case 'a':
                $ansid = $oaid;
                break;

            case 'b':
                $ansid = $obid;
                break;

            case 'c':
                $ansid = $ocid;
                break;

            case 'd':
                $ansid = $odid;
                break;

            default:
                $ansid = $oaid;
        }

        $qans = $db->query("INSERT INTO answer VALUES(NULL,'$qid','$ansid')");
    }
    echo '{"msg":"success","test_id":"' . $tid . '"}';
}

if (isset($_GET['test_id']) && isset($_GET['questionid']) && $_GET['task'] == "edit") {
    $tid = $_GET['test_id'];
    $qid = $_GET['questionid'];
    $qns = addslashes($_POST['qns']);

    $op1 = $_POST['11'];
    $op2 = $_POST['21'];
    $op3 = $_POST['31'];
    $op4 = $_POST['41'];
    $ans = $_POST['ans'];
    $ops = array();
    $ops[0] = addslashes(strval($op1));
    $ops[1] = addslashes(strval($op2));
    $ops[2] = addslashes(strval($op3));
    $ops[3] = addslashes(strval($op4));
    $r1  = $db->query("UPDATE answer SET ansid='$ans' WHERE qid='$qid' ");

    $r2  = $db->query("UPDATE questions SET qns='$qns' WHERE qid='$qid'");

    $opt = $db->query("SELECT * FROM options WHERE  qid='$qid' ORDER BY opno ASC");

    $it = 0;
    while ($opout = $opt->fetch_array()) {
        $opnid = $opout['optionid'];
        $myop = $ops[$it];
        $xa = "UPDATE options SET options = '$myop' WHERE optionid = '$opnid';";
        $x1  = $db->query($xa);
        $it++;
    }
    echo '{"msg":"success","test_id":"' . $tid . '"}';
}

// disable test
if (isset($_GET['test_id']) && $_GET['task'] == "disable") {
    $eid = $_GET['test_id'];
    $r1 = $db->query("UPDATE testdetails SET status='disabled' WHERE eid='$eid' ") or die('Error');
    // $q = mysqli_query($db, "SELECT * FROM cexamhistory WHERE eid='$eid' AND status='ongoing' AND score_updated='false'");
    // while ($row = mysqli_fetch_array($q)) {
    //     $user = $row['username'];
    //     $s = $row['score'];
    //     $r1 = mysqli_query($db, "UPDATE cexamhistory SET status='finished',score_updated='true' WHERE eid='$eid' AND username='$user' ") or die('Error');
    // }
    if($r1){
        echo '{"msg":"disabled"}';
    }
}

// enable test
if (isset($_GET['test_id']) && $_GET['task'] == "enable") {
    $tid = $_GET['test_id'];
    $r1  = $db->query("UPDATE testdetails SET status='enabled' WHERE eid='$tid' ") or die('Error');
    if($r1){
        echo '{"msg":"enabled"}';
    }
}
// remove
if (isset($_GET['test_id']) && $_GET['task'] == "remove") {
    $eid = $_GET['test_id'];
    $result = $db->query("SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
    while ($row = $result->fetch_array()) {
        $qid = $row['qid'];
        $r1  = $db->query("DELETE FROM options WHERE qid='$qid'") or die('Error');
        $r2  = $db->query("DELETE FROM answer WHERE qid='$qid' ") or die('Error');
    }
    $r2  = $db->query("DELETE FROM user_answer WHERE eid='$eid' ") or die('Error');
    $r3 = $db->query("DELETE FROM questions WHERE eid='$eid' ") or die('Error');
    $r4 = $db->query("DELETE FROM testdetails WHERE eid='$eid' ") or die('Error');
    $r4 = $db->query("DELETE FROM history WHERE eid='$eid' ") or die('Error');
    
    if (file_exists($eid)) {
        rmdir($eid);
    }
    echo '{"msg":"removed"}';
}
