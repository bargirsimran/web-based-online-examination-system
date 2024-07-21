<?php
include("session.php");
include("connection.php");
include("student_detail.php");
ob_start();
?>

<?php
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && isset($_POST['anssub']) && (!isset($_GET['delanswer']))) {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $ans   = $_POST['ans'];
    $review   = $_POST['status'];
    $qid   = @$_GET['qid'];
    $z = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid'") or die('Error199');
    $x = mysqli_fetch_array($z);
    $vsn =  $x['sn'];
    $vtotal =  $x['total'];


    $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$eid' ") or die('Error1917');
    if (mysqli_num_rows($q) > 0) {
        $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$eid' ") or die('Error1927');
        while ($row = mysqli_fetch_array($q)) {
            $time   = $row['timestamp'];
            $status = $row['status'];
        }

        $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error1967');
        while ($row = mysqli_fetch_array($q)) {
            $ttime   = $row['time'];
            $qstatus = $row['status'];
        }

        $remaining = (($ttime * 60) - ((time() - $time)));
        if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
            $q = mysqli_query($db, "SELECT * FROM user_answer WHERE eid='$eid' AND username='$stud_id' AND qid='$qid' ") or die('Error115');
            while ($row = mysqli_fetch_array($q)) {
                $prevans = $row['ans'];
            }
            $q = mysqli_query($db, "SELECT * FROM answer WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $ansid = $row['ansid'];
            }
            $q = mysqli_query($db, "SELECT * FROM user_answer WHERE username='$stud_id' AND eid='$eid' AND qid='$qid' ") or die('Error1977');
            if (mysqli_num_rows($q) != 0) {
                $q = mysqli_query($db, "UPDATE user_answer SET ans='$ans', correctans='$ansid', status='$review' WHERE username='$stud_id' AND eid='$eid' AND qid='$qid' ") or die('Error197');
            } else {
                $q = mysqli_query($db, "INSERT INTO user_answer VALUES(NULL,'$qid','$ans','$ansid','$eid','$stud_id','$review')");
            }

            $q = mysqli_query($db, "SELECT * FROM options WHERE qid='$qid' AND optionid='$ans'");
            while ($row = mysqli_fetch_array($q)) {
                $option = $row['option'];
            }

            if (!empty($ans)) {
                if ($ans == $ansid) {
                    $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ");
                    while ($row = mysqli_fetch_array($q)) {
                        $correct = $row['correct'];
                        $wrong   = $row['wrong'];
                    }

                    $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id' ") or die('Error115');
                    while ($row = mysqli_fetch_array($q)) {
                        $s = $row['score'];
                        $r = $row['correct'];
                        $w = $row['wrong'];
                    }

                    if (empty($ans)) {

                    } else if (empty($prevans)) {
                        $r++;
                        $s = $s + $correct;
                        $q = mysqli_query($db, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  username = '$stud_id' AND eid = '$eid'") or die('Error14');
                    } else if (!empty($prevans)) {
                        if ($ans == $ansid) {
                        }
                        if ($prevans != $ansid) {
                            $r++;
                            $w--;
                            $s = $s + $correct + $wrong;
                            $q = mysqli_query($db, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r,`wrong`=$w, date= NOW()  WHERE  username = '$stud_id' AND eid = '$eid'") or die('Error13');
                        }
                    }
                }
                else {
                    $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error129');
                    while ($row = mysqli_fetch_array($q)) {
                        $wrong   = $row['wrong'];
                        $correct = $row['correct'];
                    }

                    $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id' ") or die('Error139');
                    while ($row = mysqli_fetch_array($q)) {
                        $s = $row['score'];
                        $w = $row['wrong'];
                        $r = $row['correct'];
                    }
                    if (empty($ans)) {
                    } else if (empty($prevans)) {
                        $w++;
                        $s = $s - $wrong;
                        $q = mysqli_query($db, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date= NOW()  WHERE  username = '$stud_id' AND eid = '$eid'") or die('Error14');
                    } else if (!empty($prevans)) {
                        if ($ans != $ansid) {
                        }
                        if ($prevans == $ansid) {
                            $r--;
                            $w++;
                            $s = $s - $correct - $wrong;
                            $q = mysqli_query($db, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r,`wrong`=$w, date= NOW()  WHERE  username = '$stud_id' AND eid = '$eid'") or die('Error13');
                        }
                    }
                }
            }
            if ($sn < $total) {

                $m = $sn + 1;
            } else {
                $m = $sn;
            }
            header("location:answer.php?q=quiz&step=2&eid=$eid&n=$m&t=$total") or die('Error152');
        } else {
            unset($_SESSION['6e447159425d2d']);
            $q = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$eid' ") or die('Error1971');
            $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id'") or die('Error156');
            while ($row = mysqli_fetch_array($q)) {
                $s = $row['score'];
                $scorestatus = $row['score_updated'];
            }
            if ($scorestatus == "false") {
                $q = mysqli_query($db, "UPDATE history SET score_updated='true' WHERE username='$stud_id' AND eid='$eid' ") or die('Error1987');
            
            }
            header('location:viewresult.php?q=result&eid=' . $_GET['eid']);
        }
    } else {
        unset($_SESSION['6e447159425d2d']);
        $q = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$eid' ") or die('Error297');
        $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id'") or die('Error156');
        while ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $scorestatus = $row['score_updated'];
        }
        if ($scorestatus == "false") {
            $q = mysqli_query($db, "UPDATE history SET score_updated='true' WHERE username='$stud_id' AND eid='$eid' ") or die('Error397');
        }
        header('location:viewresult.php?q=result&eid=' . $_GET['eid']);
    }
}

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && (!isset($_POST['ans'])) && (isset($_GET['delanswer'])) && $_GET['delanswer'] == "delanswer") {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $qid   = @$_GET['qid'];
    $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$eid' ") or die('Error497');
    if (mysqli_num_rows($q) > 0) {
        $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$eid' ") or die('Error597');
        while ($row = mysqli_fetch_array($q)) {
            $time   = $row['timestamp'];
            $status = $row['status'];
        }

        $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error697');
        while ($row = mysqli_fetch_array($q)) {
            $ttime   = $row['time'];
            $qstatus = $row['status'];
        }

        $remaining = (($ttime * 60) - ((time() - $time)));
        if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
            $q = mysqli_query($db, "SELECT * FROM answer WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $ansid = $row['ansid'];
            }
            $q = mysqli_query($db, "SELECT * FROM user_answer WHERE eid='$eid' AND username='$stud_id' AND qid='$qid' ") or die('Error115');
            $row = mysqli_fetch_array($q);
            $ans = $row['ans'];
            $q = mysqli_query($db, "DELETE FROM user_answer WHERE qid='$qid' AND username='$stud_id' AND eid='$eid' ") or die("Error2222");
            if ($ans == $ansid) {
                $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }

                $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                $r--;
                $s = $s - $correct;
                $q = mysqli_query($db, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  username = '$stud_id' AND eid = '$eid'") or die('Error11');
            } else {
                $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }

                $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                $w--;
                $s = $s + $wrong;
                $q = mysqli_query($db, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date= NOW()  WHERE  username = '$stud_id' AND eid = '$eid'") or die('Error11');
            }
            header('location:answer.php?q=quiz&step=2&eid=' . $_GET['eid'] . '&n=' . $_GET['n'] . '&t=' . $total);
        } else {
            unset($_SESSION['6e447159425d2d']);
            $q = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$eid' ") or die('Error797');
            $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id'") or die('Error156');
            while ($row = mysqli_fetch_array($q)) {
                $s = $row['score'];
                $scorestatus = $row['score_updated'];
            }
            if ($scorestatus == "false") {
                $q = mysqli_query($db, "UPDATE history SET score_updated='true' WHERE username='$stud_id' AND eid='$eid' ") or die('Error897');
            }
            header('location:viewresult.php?q=result&eid=' . $_GET['eid']);
        }
    } else {
        unset($_SESSION['6e447159425d2d']);
        $q = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$eid' ") or die('Error9197');
        $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id'") or die('Error156');
        while ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $scorestatus = $row['score_updated'];
        }
        if ($scorestatus == "false") {
            $q = mysqli_query($db, "UPDATE history SET score_updated='true' WHERE username='$stud_id' AND eid='$eid' ") or die('Error00197');
        }
        header('location:viewresult.php?q=result&eid=' . $_GET['eid']);
    }
}




?>

