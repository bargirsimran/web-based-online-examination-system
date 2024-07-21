<?php
include("session.php");
include("connection.php");
include("student_detail.php");
ob_start();
$testid = $_GET['eid'];
if (!isset($testid) || empty($testid)) {
    header("location: index.php");
}

$sqlgrp = "SELECT * FROM grp_member WHERE student_id='$stud_id' GROUP BY grp_id";
$sql_run_grp = $db->query($sqlgrp);
$fetched_grp = "";
$finalgrp = "";
while ($result_grp = $sql_run_grp->fetch_assoc()) {
    $fetched_grp = "," . $result_grp['grp_id'];
}
if (strlen($fetched_grp) != 0) {
    $finalgrp = substr($fetched_grp, 1);
} else {
    $finalgrp  = "";
}
$groups_of_stud = explode(",", $finalgrp);

$q = $db->query("SELECT * FROM testdetails WHERE eid='$testid' ") or die('Error197');
$testdetails = mysqli_fetch_array($q);
$titleT = $testdetails['title'];
$deptT = $testdetails['dept_id'];
$yearT = $testdetails['year_id'];
$semT = $testdetails['sem_id'];
$sub_idT = $testdetails['subject_id'];
$correctT = $testdetails['correct'];
$totalT = $testdetails['total'];
$timeT = $testdetails['time'];
$dateT = $testdetails['date'];
$statusT = $testdetails['status'];
$grp_idT = $testdetails['grp_id'];

$groups = explode(",", $grp_idT);
$counter = 0;
for ($i = 0; $i < count($groups_of_stud); $i++) {
    if (in_array($groups_of_stud[$i], $groups)) {
        $counter++;
    }
}

if ($counter == 0) {
    header("location: index.php");
}

$history    = "SELECT * FROM history WHERE eid='$testid' AND username='$stud_id'";
$resq  = $db->query($history);
$reshis = $resq->fetch_array();
if ($resq->num_rows > 0) {
    $stateH = $reshis['status'];
    $scoreH = $reshis['score_updated'];
    if (($stateH == 'finished') && ($scoreH == 'true')) {
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Home | Subjects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <?php include("css.php"); ?>
    <link rel="stylesheet" href="assets/css/pjms.css">

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="lg:flex lg:space-x-4 mt-4 mx-4">
                <div class="lg:w-8/12 lg:mt-0 mt-4">
                    <?php

                    if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_GET['start']) && $_GET['start'] == "start" && (!isset($_SESSION['6e447159425d2d']))) {

                        $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                        if (mysqli_num_rows($q) > 0) {
                            $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                            while ($row = mysqli_fetch_array($q)) {
                                $timel  = $row['timestamp'];
                                $status = $row['status'];
                            }
                            $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$testid' ") or die('Error197');
                            while ($row = mysqli_fetch_array($q)) {
                                $ttimel  = $row['time'];
                                $qstatus = $row['status'];
                            }
                            $remaining = (($ttimel * 60) - ((time() - $timel)));
                            if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
                                $_SESSION['6e447159425d2d'] = "6e447159425d2d";
                                header('location:answer.php?q=quiz&step=2&eid=' . $testid . '&n=' . $_GET['n'] . '&t=' . $_GET['t']);
                            } else {
                                $q = mysqli_query($db, "UPDATE history SET status='finished' WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                                $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$testid' AND username='$stud_id'") or die('Error156');
                                while ($row = mysqli_fetch_array($q)) {
                                    $s = $row['score'];
                                    $scorestatus = $row['score_updated'];
                                }
                                if ($scorestatus == "false") {
                                    $q = mysqli_query($db, "UPDATE history SET score_updated='true' WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                                }
                                header('location:viewresult.php?q=result&eid=' . $testid);
                            }
                        } else {
                            if (empty($stud_id)) {
                                header("location: login.php");
                            } else {
                                $time = time();
                                $q = mysqli_query($db, "INSERT INTO history VALUES(NULL,'$stud_id','$testid' ,'0','0','0','0',NOW(),'$time','ongoing','false')") or die('Error137');
                                $_SESSION['6e447159425d2d'] = "6e447159425d2d";
                                header('location:answer.php?q=quiz&step=2&eid=' . $testid . '&n=' . $_GET["n"] . '&t=' . $_GET["t"]);
                            }
                        }
                    }

                    ?>

                    <?php
                    if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d") {
                        $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                        $eid   = @$_GET['eid'];
                        $sn    = @$_GET['n'];
                        $total = @$_GET['t'];
                        $z = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid'") or die('Error199');
                        $x = mysqli_fetch_array($z);

                        $vtotal =  $x['total'];
                        if ($sn > $total) {
                            header("location:index.php");
                        }
                        if ($total > $vtotal) {
                            header("location:index.php");
                        }
                        if (mysqli_num_rows($q) > 0) {
                            $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                            while ($row = mysqli_fetch_array($q)) {
                                $time   = $row['timestamp'];
                                $status = $row['status'];
                            }
                            $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$testid' ") or die('Error197');
                            while ($row = mysqli_fetch_array($q)) {
                                $ttime   = $row['time'];
                                $qstatus = $row['status'];
                            }
                            $remaining = (($ttime * 60) - ((time() - $time)));
                            if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
                                $q = mysqli_query($db, "SELECT * FROM history WHERE username='$stud_id' AND eid='$testid' ") or die('Error197');
                                while ($row = mysqli_fetch_array($q)) {
                                    $time = $row['timestamp'];
                                }
                                $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$testid' ") or die('Error197');
                                while ($row = mysqli_fetch_array($q)) {
                                    $ttime = $row['time'];
                                }
                                $remaining = (($ttime * 60) - ((time() - $time)));

                                echo '<script>
                                                                        var seconds = ' . $remaining . ' ;
                                                                        function end(){
                                                                            
                                                                                window.location ="endofquiz.php?q=quiz&step=2&eid=' . $testid . '&n=' . $_GET["n"] . '&t=' . isset($_GET["total"]) . '&endquiz=end";
                                                                            
                                                                        }
                                                                        function enable(){
                                                                            document.getElementById("sbutton").removeAttribute("disabled");
                                                                        
                                                                        }
                                                                        function frmreset(){
                                                                            document.getElementById("sbutton").setAttribute("disabled","true");
                                                                            document.getElementById("qform").reset();
                                                                        }
                                                                            function secondPassed() {
                                                                            var minutes = Math.round((seconds - 30)/60);
                                                                            var remainingSeconds = seconds % 60;
                                                                            if (remainingSeconds < 10) {
                                                                                remainingSeconds = "0" + remainingSeconds; 
                                                                            }
                                                                            document.getElementById(\'countdown\').innerHTML = minutes + ":" +    remainingSeconds;
                                                                            if (seconds <= 0) {
                                                                                clearInterval(countdownTimer);
                                                                                document.getElementById(\'countdown\').innerHTML = "Buzz Buzz...";
                                                                                window.location ="endofquiz.php?q=quiz&step=2&eid=' . $testid . '&n=' . $_GET["n"] . '&t=' . isset($_GET["total"]) . '&endquiz=end";
                                                                            } else {    
                                                                                seconds--;
                                                                            }
                                                                            }
                                                                           var countdownTimer = setInterval(\'secondPassed()\', 1000);
                                                                </script>';
                                $eid   = $_GET['eid'];
                                $sn    = $_GET['n'];
                                $total = $_GET['t'];
                                $q     = mysqli_query($db, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");
                                while ($row = mysqli_fetch_array($q)) {
                                    $qns = stripslashes($row['qns']);
                                    $qid = $row['qid'];
                                    $qh     = mysqli_query($db, "SELECT * FROM answer WHERE qid='$qid'");
                                    while ($rowh = mysqli_fetch_array($qh)) {
                                    }
                                }

                                // this statement is used for visited question

                                $q = mysqli_query($db, "SELECT * FROM user_answer WHERE username='$stud_id' AND eid='$eid' and qid='$qid' ") or die('Error197');
                                if (mysqli_num_rows($q) == 0) {
                                    $qcn = mysqli_query($db, "SELECT * FROM answer WHERE qid='$qid' ") or die('Error197');
                                    $cns = mysqli_fetch_array($qcn);
                                    $cqn = $cns['ansid'];
                                    $q = mysqli_query($db, "INSERT INTO user_answer VALUES(NULL,'$qid','','$cqn','$eid','$stud_id','2')");
                                }
                                //query end
                                echo '<form id="qform" action="updatequiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST" >';
                    ?>
                                <?php   //complete timer and finish
                                echo '<div style="border-radius:none mt-0" class="tube-card z-20 mb-4 overflow-hidden uk-sticky " uk-sticky="cls-active:rounded-none ; media: 500 ; offset:70">
                                <nav class="flex justify-between px-4 py-2">
                                    <p id="countdown" class="bg-yellow-500 hover:bg-yellow-500 text-black font-bold hover:text-black py-2 px-4 border border-yellow-500 hover:border-transparent rounded"></p>
                                    <span class="bg-red-500 hover:bg-red-500 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" onclick="end()" style="font-size:15px;font-weight:bold">
                                                FINISH
                                    </span>
                                </nav>
                               </div>';

                                // complete timer and finish  
                                $eid   = @$_GET['eid'];
                                $sn    = @$_GET['n'];
                                $total = @$_GET['t'];
                                $q     = mysqli_query($db, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");

                                echo '<div class="tube-card p-6" id="Overview">
                                          <div class="space-y-2">';    //this divs not closed yet
                                while ($row = mysqli_fetch_array($q)) {
                                    $qns = stripslashes($row['qns']);

                                    $qid = $row['qid'];
                                    $qh     = mysqli_query($db, "SELECT * FROM answer WHERE qid='$qid'");
                                    while ($rowh = mysqli_fetch_array($qh)) {
                                    }
                                    //question number and question
                                    echo '
                                   <div class="p-2 border border-purple-500">
                                            Q. ' . $sn .  ')' . $qns . '
                                   </div>
                                   
                                   ';
                                }



                                $q = mysqli_query($db, "SELECT * FROM user_answer WHERE qid='$qid' AND username='$stud_id' AND eid='$testid' and status!='2'") or die("Error222");
                                if (mysqli_num_rows($q) > 0) {
                                    $row = mysqli_fetch_array($q);
                                    $ans = $row['ans'];
                                    if (!empty($ans)) {
                                        $q = mysqli_query($db, "SELECT * FROM options WHERE qid='$qid' AND optionid='$ans'") or die("Error222");
                                        $row = mysqli_fetch_array($q);
                                        $ans = stripslashes($row['options']);
                                    }
                                } else {
                                    $ans = "";
                                }
                                if (strlen($ans) > 0) {
                                    echo '<div class="text-center"">
                                                <font class="text-green-500 font-bold">Your Answer: </font><font class="text-black font-bold">' . $ans . '</font>
                                          </div>';
                                }
                                echo '<div class="space-y-2 lg:w-12/12">';
                                $q = mysqli_query($db, "SELECT * FROM options WHERE qid='$qid' ");
                                while ($row = mysqli_fetch_array($q)) {
                                    $option   = stripslashes($row['options']);
                                    $optionid = $row['optionid'];
                                    $ch = mysqli_query($db, "SELECT * FROM user_answer WHERE qid='$qid' and username='$stud_id' and eid='$eid'");
                                    $num = mysqli_num_rows($ch);
                                    $ress = mysqli_fetch_array($ch);
                                    $answ = $ress['ans'];
                                    if (!(empty($answ))) {
                                ?>
                                        <label for="<?php echo $optionid ?>" class="checkbox border p-2 w-full pl-4">
                                            <input type="radio" id="<?php echo $optionid ?>" name="ans" value="<?php echo $optionid ?>" <?php if ($optionid == $answ) {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>>
                                            <label for="<?php echo $optionid ?>" class="ml-4">
                                                <span class="checkbox-icon mt-1 -ml-4"></span> <span class="text-base"> <?php echo $option; ?> </span>
                                            </label>
                                        </label>
                                    <?php
                                    } else {
                                    ?>
                                        <label for="<?php echo $optionid ?>" class="checkbox border p-2 w-full pl-4">
                                            <input type="radio" id="<?php echo $optionid ?>" name="ans" value="<?php echo $optionid ?>">
                                            <label for="<?php echo $optionid ?>" class="ml-4">
                                                <span class="checkbox-icon mt-1 -ml-4"></span> <span class="text-base"> <?php echo $option; ?> </span>
                                            </label>
                                        </label>
                    <?php
                                    }
                                }
                                echo '</div><br><hr>';

                                if ($_GET["t"] > $_GET["n"] && $_GET["n"] != 1) {
                                    echo '<nav class="flex justify-between py-2 w-full">
                                                <a class="text-white bg-blue-500 border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 font-extrabold" href="answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn - 1) . '&t=' . $total . '" > 
                                                 <span class="icon-material-outline-arrow-back">
                                                </span>
                                                </a>
                                            <label for="rvmrk" class="flex text-purple-600 bg-transparent border border-solid border-purple-600 hover:bg-purple-600 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                <input  type="checkbox" class="form-checkbox h-4 w-4"  value="1" name="status" id="rvmrk">
                                                &nbsp;&nbsp;Review
                                            </label>
                                            <button type="submit" name="anssub" id="sbutton" class="text-black bg-yellow-500 border border-solid border-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Save&nbsp;&&nbspNext</button>
                                             <a class="text-white bg-blue-500 border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn + 1) . '&t=' . $total . '" > 
                                             <span class="icon-material-outline-arrow-forward">
                                             </span>
                                             </a>
                                            </nav>
                                        </div></div>
                                     </form>';
                                } else if ($_GET["t"] == $_GET["n"] && $_GET["n"] != 1) {
                                    echo '<nav class="flex justify-between py-2 w-full">
                                                 <a class="text-white bg-blue-500 border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 font-extrabold" href="answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn - 1) . '&t=' . $total . '" > 
                                                 <span class="icon-material-outline-arrow-back">
                                                </span>
                                                </a>
                                            <label for="rvmrk" class="flex text-purple-600 bg-transparent border border-solid border-purple-600 hover:bg-purple-600 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                <input  type="checkbox" class="form-checkbox h-4 w-4"  value="1" name="status" id="rvmrk">
                                                &nbsp;&nbsp;Review
                                            </label>
                                            <button type="submit" name="anssub" id="sbutton" class="text-black bg-yellow-500 border border-solid border-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Save&nbsp;&&nbspNext</button>
                                            </nav>
                                        </div></div>
                                     </form>';
                                } else if ($_GET["t"] == $_GET["n"] && $_GET["n"] == 1) {
                                    echo '<nav class="flex justify-between py-2 w-full">
                                            <label for="rvmrk" class="flex text-purple-600 bg-transparent border border-solid border-purple-600 hover:bg-purple-600 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                <input  type="checkbox" class="form-checkbox h-4 w-4"  value="1" name="status" id="rvmrk">
                                                &nbsp;&nbsp;Review
                                            </label>
                                            <button type="submit" name="anssub" id="sbutton" class="text-black-500 bg-yellow-500 border border-solid border-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Save&nbsp;&&nbspNext</button>
                                            </nav>
                                        </div></div>
                                     </form>';
                                } else if ($_GET["t"] > $_GET["n"] && $_GET["n"] == 1) {
                                    echo '<nav class="flex justify-between py-2 w-full">
                                            <label for="rvmrk" class="flex text-purple-600 bg-transparent border border-solid border-purple-600 hover:bg-purple-600 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                <input  type="checkbox" class="form-checkbox h-4 w-4"  value="1" name="status" id="rvmrk">
                                                &nbsp;&nbsp;Review
                                            </label>
                                            <button type="submit" name="anssub" id="sbutton" class="text-black bg-yellow-500 border border-solid border-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Save&nbsp;&&nbspNext</button>
                                             <a class="text-white bg-blue-500 border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn + 1) . '&t=' . $total . '" >
                                              <span class="icon-material-outline-arrow-forward">
                                             </span>
                                              </a>
                                            </nav>
                                        </div></div>
                                     </form>';
                                }
                            }
                        }
                    

                    ?>
                </div>

                <!-- course intro Sidebar -->
                <div class="lg:w-4/12 space-y-4 lg:mt-0 mt-4">

                    <div uk-sticky="top:0;offset:; offset:90 ; media: 1024">
                        <div class="tube-card justify-start px-4 w-full" uk-sticky="top:600;offset:; offset:90 ; media: @s">
                            <div class="mx-4 flex flex-wrap -mx-2 overflow-hidden sm:-mx-5 md:-mx-4 lg:-mx-3 xl:-mx-4">
                                <?php
                                for ($x = 1; $x <= $totalT; $x++) {
                                    $quetion = "SELECT * FROM questions WHERE eid='$testid' AND sn ='$x'";
                                    $runquestion = mysqli_query($db, $quetion);
                                    $qno  = @$_GET['n'];

                                    $findquestion = mysqli_fetch_array($runquestion);
                                    $qsn  = $findquestion['sn'];
                                    $qsid = $findquestion['qid'];

                                    $uans = "SELECT * FROM user_answer WHERE eid='$testid' and qid='$qsid' and username='$stud_id'";
                                    $runuans = mysqli_query($db, $uans);
                                    $resdata = mysqli_fetch_array($runuans);


                                    if ($check = mysqli_num_rows($runuans) > 0) {

                                        if ($resdata['status'] == 0 && $resdata['ans'] != null) {
                                ?>
                                            <div class="flex justify-center my-2 px-2 pt-2 w-1/5 overflow-hidden sm:my-2 sm:px-5 sm:w-1/5 md:my-2 md:px-4 md:w-1/5 lg:my-2 lg:px-3 lg:w-1/5 xl:my-2 xl:px-4 xl:w-1/5">
                                                <a class="text-white bg-green-500 border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                                    <?php if ($x < 10) {
                                                        echo "0";
                                                    }
                                                    echo $x; ?>
                                                </a>
                                            </div>

                                        <?php

                                        }
                                        if ($resdata['status'] == 1) {
                                        ?>
                                            <div class="flex justify-center my-2 px-2 pt-2 w-1/5 overflow-hidden sm:my-2 sm:px-5 sm:w-1/5 md:my-2 md:px-4 md:w-1/5 lg:my-2 lg:px-3 lg:w-1/5 xl:my-2 xl:px-4 xl:w-1/5">
                                                <a class="text-white bg-purple-500 border border-solid border-purple-500 hover:bg-purple-500 hover:text-white active:bg-purple-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                                    <?php if ($x < 10) {
                                                        echo "0";
                                                    }
                                                    echo $x; ?>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        if (($resdata['status'] == 0 && $resdata['ans'] == null) || $resdata['status'] == 2) {
                                        ?>
                                            <div class="flex justify-center my-2 px-2 pt-2 w-1/5 overflow-hidden sm:my-2 sm:px-5 sm:w-1/5 md:my-2 md:px-4 md:w-1/5 lg:my-2 lg:px-3 lg:w-1/5 xl:my-2 xl:px-4 xl:w-1/5">
                                                <a class="text-white bg-red-500 border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                                    <?php if ($x < 10) {
                                                        echo "0";
                                                    }
                                                    echo $x; ?>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="flex justify-center my-2 px-2 pt-2 w-1/5 overflow-hidden sm:my-2 sm:px-5 sm:w-1/5 md:my-2 md:px-4 md:w-1/5 lg:my-2 lg:px-3 lg:w-1/5 xl:my-2 xl:px-4 xl:w-1/5">
                                            <a class="text-white bg-gray-500 border border-solid border-gray-500 hover:bg-gray-500 hover:text-white active:bg-gray-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                                <?php if ($x < 10) {
                                                    echo "0";
                                                }
                                                echo $x; ?>
                                            </a>
                                        </div>


                                <?php
                                    }
                                }

                                ?>


                                <hr>
                                <?php
                                $g = "SELECT * FROM user_answer WHERE eid='$testid' and username='$stud_id' and status!='2' and ans!=''";
                                $cg = mysqli_query($db, $g);
                                $green = mysqli_num_rows($cg);

                                $b = "SELECT * FROM user_answer WHERE eid='$testid' and username='$stud_id' and status='1'";
                                $bg = mysqli_query($db, $b);
                                $blue = mysqli_num_rows($bg);

                                $red = $total - $green;
                                $gr = "SELECT * FROM user_answer WHERE eid='$testid' and username='$stud_id'";
                                $cgr = mysqli_query($db, $gr);
                                $gray = mysqli_num_rows($cgr);

                                $grays = $total - $gray;
                                ?>
                            </div>
                            <hr>
                            <div class="mx-4 flex flex-wrap -mx-2 overflow-hidden sm:-mx-5 md:-mx-4 lg:-mx-3 xl:-mx-4">
                                <div class="flex justify-start my-2 px-2 pt-2 w-5/5 overflow-hidden sm:my-2 sm:px-5 sm:w-5/5 md:my-2 md:px-4 md:w-5/5 lg:my-2 lg:px-3 lg:w-5/5 xl:my-2 xl:px-4 xl:w-5/5">
                                    <a class="text-white bg-green-500 border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                        <?php echo "0".$green ?>
                                    </a>
                                    <b class="justify-start text-black pt-1.5">Answered</b>
                                </div>
                            </div>
                            <div class="mx-4 flex flex-wrap -mx-2 overflow-hidden sm:-mx-5 md:-mx-4 lg:-mx-3 xl:-mx-4">
                                <div class="flex justify-start my-2 px-2 pt-0 w-5/5 overflow-hidden sm:my-2 sm:px-5 sm:w-5/5 md:my-2 md:px-4 md:w-5/5 lg:my-2 lg:px-3 lg:w-5/5 xl:my-2 xl:px-4 xl:w-5/5">
                                    <a class="text-white bg-red-500 border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                    <?php echo "0".$red ?>
                                    </a>
                                    <b class="justify-start text-black pt-1.5">Not Answered</b>
                                </div>
                            </div>
                            <div class="mx-4 flex flex-wrap -mx-2 overflow-hidden sm:-mx-5 md:-mx-4 lg:-mx-3 xl:-mx-4">
                                <div class="flex justify-start my-2 px-2 pt-0 w-5/5 overflow-hidden sm:my-2 sm:px-5 sm:w-5/5 md:my-2 md:px-4 md:w-5/5 lg:my-2 lg:px-3 lg:w-5/5 xl:my-2 xl:px-4 xl:w-5/5">
                                    <a class="text-white bg-purple-500 border border-solid border-purple-500 hover:bg-purple-500 hover:text-white active:bg-purple-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                    <?php echo "0".$blue ?>
                                    </a>
                                    <b class="justify-start text-black pt-1.5">Marked for review</b>
                                </div>
                            </div>
                            <div class="mx-4 flex flex-wrap -mx-2 overflow-hidden sm:-mx-5 md:-mx-4 lg:-mx-3 xl:-mx-4">
                                <div class="flex justify-start my-2 px-2 pt-0 w-5/5 overflow-hidden sm:my-2 sm:px-5 sm:w-5/5 md:my-2 md:px-4 md:w-5/5 lg:my-2 lg:px-3 lg:w-5/5 xl:my-2 xl:px-4 xl:w-5/5">
                                    <a class="text-white bg-gray-500 border border-solid border-gray-500 hover:bg-gray-500 hover:text-white active:bg-gray-600 font-bold uppercase text-xs px-2 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="<?php echo 'answer.php?q=quiz&step=2&eid=' . $eid . '&n=' . $x . '&t=' . $total; ?>">
                                    <?php echo "0".$grays ?>
                                    </a>
                                    <b class="justify-start text-black pt-1.5">Not Visited</b>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <?php }else{
                header('location:viewresult.php?q=result&eid='.$testid);}
                ?>

            </div>
            <?php include("footer.php"); ?>
        </div>
    </div>

    <!-- sidebar -->
    <?php include("sidebar.php"); ?>

    </div>


    <?php include("js.php") ?>
    <script src="validate/pjms.js"></script>
</body>

</html