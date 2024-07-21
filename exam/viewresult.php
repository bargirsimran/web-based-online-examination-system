<?php
include("session.php");
include("connection.php");
include("student_detail.php");
ob_start();
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

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="bg-white border m-8 mx-8 p-10">
                <?php
                $testid = @$_GET['eid'];
                $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$testid' ") or die('Error197');
                $restest = mysqli_fetch_array($q);
                ?>

                <?php

                if (@$_GET['q'] == 'result' && @$_GET['eid']) {
                    $eid = @$_GET['eid'];
                    $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error157');
                    while ($row = mysqli_fetch_array($q)) {
                        $total = $row['total'];
                    }
                    $q = mysqli_query($db, "SELECT * FROM history WHERE eid='$eid' AND username='$stud_id' ") or die('Error157');

                    while ($row = mysqli_fetch_array($q)) {
                        $s      = $row['score'];
                        $w      = $row['wrong'];
                        $r      = $row['correct'];
                        $status = $row['status'];
                    }
                    if ($status == "finished") {
                    }
                    else {
                        header("location:submittest.php?test_id=$eid");
                    }
                }




                ?>
                <div class="mx-container">
                    <div class="text-center font-bold mb-2">
                        <?php echo $restest['title']?>
                        
                    </div>
                    <hr>
                    <ul class="grid lg:grid-cols-1 sm:grid-cols-1 gap-3 mb-0 mt-5 justify-center">
                        <div>
                            <li class="items-center justify-center flex justify-center">
                                <div class="flex justify-center items-center content-center bg-gradient-to-br from-pink-300 to-pink-600 shadow-md hover:shadow-lg h-20 w-20 rounded-full fill-current text-white">
                                    <p class="text-2xl font-bold"><?php echo $s?></p>
                                </div>
                            </li>
                            <div class="text-center pt-4">
                                <b class="text-center">Marks Obtained</b>
                            </div>
                        </div>
                    </ul>
                </div>
                <br><br>
                <div class="mx-container">
                    <ul class="grid lg:grid-cols-4 sm:grid-cols-2 gap-3 mb-0 mt-5 justify-center">
                        <div>
                            <li class="items-center flex justify-center">
                                <div class="flex justify-center items-center content-center bg-gradient-to-br from-blue-300 to-blue-600 shadow-md hover:shadow-lg h-20 w-20 rounded-full fill-current text-white">
                                    <p class="text-2xl font-bold"><?php echo $total?></p>
                                </div>
                            </li>
                            <div class="text-center pt-4">
                                <b class="text-center">Total Question</b>
                            </div>
                        </div>

                        <div>
                            <li class="items-center flex justify-center">
                                <div class="flex justify-center items-center content-center bg-gradient-to-br from-green-300 to-green-600 shadow-md hover:shadow-lg h-20 w-20 rounded-full fill-current text-white">
                                    <p class="text-2xl font-bold"><?php echo $r?></p>
                                </div>
                            </li>
                            <div class="text-center pt-4">
                                <b class="text-center">Correct </b>
                            </div>
                        </div>

                        <div>
                            <li class="items-center justify-center flex justify-center">
                                <div class="flex justify-center items-center content-center bg-gradient-to-br from-purple-300 to-purple-600 shadow-md hover:shadow-lg h-20 w-20 rounded-full fill-current text-white">
                                    <p class="text-2xl font-bold"><?php echo $w?></p>
                                </div>
                            </li>
                            <div class="text-center pt-4">
                                <b class="text-center">Wrong</b>
                            </div>
                        </div>

                        <div>
                            <li class="items-center justify-center flex justify-center">
                                <div class="flex justify-center items-center content-center bg-gradient-to-br from-pink-300 to-pink-600 shadow-md hover:shadow-lg h-20 w-20 rounded-full fill-current text-white">
                                    <p class="text-2xl font-bold"><?php echo ($total-$r-$w)?></p>
                                </div>
                            </li>
                            <div class="text-center pt-4">
                                <b class="text-center">UnAttempted</b>
                            </div>
                        </div>

                    </ul>
                </div>
            </div>

            <?php include("footer.php"); ?>
        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>

    </div>


    <?php include("js.php") ?>
</body>

</html>


<!-- This is the last line of the project  -->