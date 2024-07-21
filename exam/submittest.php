<?php
include("session.php");
include("connection.php");
include("student_detail.php");
ob_start();


$testid = $_GET['test_id'];
if (empty($testid)) {
    header("location: index.php");
}

?>

<?php
$q1 = mysqli_query($db, "SELECT * FROM history WHERE eid='$testid' AND username='$stud_id' ") or die('Error157');
$rown = mysqli_num_rows($q1);
if ($rown == 0) {
    header("location: index.php");
}
?>

<?php
$testid = @$_GET['test_id'];
$q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$testid' ") or die('Error19');
$restest = mysqli_fetch_array($q);

 $time = $restest['time'];
 $timeinsec = $time * 60;

$q1 = mysqli_query($db, "SELECT * FROM history WHERE eid='$testid' AND username='$stud_id' ") or die('Error157');
$restest1 = mysqli_fetch_array($q1);
$tp = $restest1['timestamp'];
$timeatinstant = time();
$totaltime =   $tp + $timeinsec;
$condition = $timeatinstant - $totaltime;

if ($condition > 0) {
    $q2 = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
}
header("location: viewresult.php?q=result&eid=$testid");

?>