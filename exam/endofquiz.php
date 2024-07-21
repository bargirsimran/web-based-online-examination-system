<?php
include("session.php");
include("connection.php");
include("student_detail.php");
ob_start();
?>
<?php
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && isset($_GET['endquiz']) == 'end') {
    unset($_SESSION['6e447159425d2d']);
    $eid = $_GET['eid'];
    $q = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$eid' ") or die('Error197');
    $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id'") or die('Error156');
    while ($row = mysqli_fetch_array($q)) {
        $s = $row['score'];
        $scorestatus = $row['score_updated'];
    }
    if ($scorestatus == "false") {
        $q = mysqli_query($db, "UPDATE history SET score_updated='true' WHERE username='$stud_id' AND eid='$eid' ") or die('Error197');
    }
    header('location:viewresult.php?q=result&eid=' . $eid);
}



?>