<?php
include("session.php");
include("connection.php");
include("student_detail.php");
if (!isset($_GET['subject'])) {
    header('location:index.php');
}
$subject = $_GET['subject'];
$sql = "SELECT subject_name FROM subjects WHERE subject_id = '$subject'";
$sql_run = $db->query($sql);
$s = $sql_run->fetch_assoc();
$snr = $sql_run->num_rows;
if ($snr == 0) {
    header('location:index.php');
}
$subname = $s['subject_name']
// here we have to write validation from server side so we will write this at the end 
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
            <div class="container">
                <div class="grid lg:grid-cols-3 lg:mt-10 gap-y-5">
                    <?php
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



                    $sql = "SELECT * FROM testdetails WHERE dept_id='$dept_id'AND year_id = '$year_id' AND sem_id = '$sem_id' AND subject_id = '$subject' AND status='enabled'";
                    $sql_run = $db->query($sql);
                    while ($result = $sql_run->fetch_assoc()) {
                        $grp_id = $result['grp_id'];
                        $eid = $result['eid'];
                        $total = $result['total'];
                        $groups = explode(",", $grp_id);
                        $counter = 0;
                        for ($i = 0; $i < count($groups_of_stud); $i++) {
                            if (in_array($groups_of_stud[$i], $groups)) {
                                $counter++;
                            }
                        }

                        if ($counter > 0) {

                            $q12 = $db->query("SELECT score FROM history WHERE eid='$eid' AND username='$stud_id'") or die('Error98');
                            $rowcount = $q12->num_rows;
                            if ($rowcount == 0) {
                    ?>
                                <!-- card 1 -->
                                <div style="margin-bottom:50px; margin-top:10px" class="bg-white pt-16 lg:pt-8 p-8  mx-2 shadow-xl space-y-2 relative rounded-b-md">

                                    <div class="lg:-top-10 top-0 absolute bg-green-600 left-0 p-3 rounded-t-md text-center text-white w-full font-semibold"> <?php echo $subname; ?> </div>

                                    <h4 class="font-semibold text-black-900"><?php echo $result['title']; ?></h4>


                                    <div class="bg-gray-100 p-3 rounded space-x-1.5">
                                        <ul class="uk-switcher change-plan" style="touch-action: pan-y pinch-zoom;">
                                            <li class="flex items-end justify-center uk-active">
                                                <div class="font-semibold text-3xl"><?php echo $result['total'] * $result['correct']; ?> Marks</div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="overflow-x-auto">
                                        <table class="table-auto w-full">
                                            <thead class="text-xs font-semibold uppercase text-gray-400">
                                                <tr>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left">Total Questions:</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left"><?php echo $result['total']; ?></div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left">Marks for Q:</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left"><?php echo $result['correct']; ?></div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left">Negative marks:</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left"><?php echo $result['wrong']; ?></div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left">Time:</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left"><?php echo $result['time']; ?> min</div>
                                                    </th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                    <br>
                                    <a href="answer.php?q=quiz&step=2&eid=<?php echo $eid; ?>&n=1&t=<?php echo $total; ?>&start=start" class="bg-green-600 block p-3 rounded-md space-x-1.5 text-center text-sm text-white hover:text-white font-semibold">Attempt Test</a>

                                </div>

                                <?php
                            } else {
                                $q = $db->query("SELECT * FROM history WHERE username='$stud_id' AND eid='$eid' ") or die('Error197');
                                $row = mysqli_fetch_array($q);
                                $timec  = $row['timestamp'];
                                $status = $row['status'];
                                $q = mysqli_query($db, "SELECT * FROM testdetails WHERE eid='$eid' ") or die('Error197');
                                $row = mysqli_fetch_array($q);
                                $ttimec  = $row['time'];
                                $qstatus = $row['status'];

                                $remaining = (($ttimec * 60) - ((time() - $timec)));
                                if ($remaining > 0 && $qstatus == "enabled" && $status == "ongoing") {

                                ?>
                                    <div style="margin-bottom:50px; margin-top:10px" class="bg-white pt-16 lg:pt-8 p-8  mx-2 shadow-xl space-y-2 relative rounded-b-md">

                                        <div class="lg:-top-10 top-0 absolute bg-yellow-600 left-0 p-3 rounded-t-md text-center text-white w-full font-semibold"> <?php echo $subname; ?> </div>

                                        <h4 class="font-semibold text-black-900"><?php echo $result['title']; ?></h4>


                                        <div class="bg-gray-100 p-3 rounded space-x-1.5">
                                            <ul class="uk-switcher change-plan" style="touch-action: pan-y pinch-zoom;">
                                                <li class="flex items-end justify-center uk-active">
                                                    <div class="font-semibold text-3xl"><?php echo $result['total'] * $result['correct']; ?> Marks</div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="overflow-x-auto">
                                            <table class="table-auto w-full">
                                                <thead class="text-xs font-semibold uppercase text-gray-400">
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Total Questions:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['total']; ?></div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Marks for Q:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['correct']; ?></div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Negative marks:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['wrong']; ?></div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Time:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['time']; ?> min</div>
                                                        </th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                        <br>
                                        <a href="answer.php?q=quiz&step=2&eid=<?php echo $eid; ?>&n=1&t=<?php echo $total; ?>&start=start" class="bg-yellow-600 block p-3 rounded-md space-x-1.5 text-center text-sm text-white hover:text-white font-semibold">Resume test</a>

                                    </div>
                                <?php } else { ?>
                                    <div style="margin-bottom:50px; margin-top:10px" class="bg-white pt-16 lg:pt-8 p-8  mx-2 shadow-xl space-y-2 relative rounded-b-md">

                                        <div class="lg:-top-10 top-0 absolute bg-blue-600 left-0 p-3 rounded-t-md text-center text-white w-full font-semibold"> <?php echo $subname; ?> </div>

                                        <h4 class="font-semibold text-purple-900"><?php echo $result['title']; ?></h4>


                                        <div class="bg-gray-100 p-3 rounded space-x-1.5">
                                            <ul class="uk-switcher change-plan" style="touch-action: pan-y pinch-zoom;">
                                                <li class="flex items-end justify-center uk-active">
                                                    <div class="font-semibold text-3xl"><?php echo $result['total'] * $result['correct']; ?> Marks</div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="overflow-x-auto">
                                            <table class="table-auto w-full">
                                                <thead class="text-xs font-semibold uppercase text-gray-400">
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Total Questions:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['total']; ?></div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Marks for Q:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['correct']; ?></div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Negative marks:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['wrong']; ?></div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Time:</div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left"><?php echo $result['time']; ?> min</div>
                                                        </th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                        <br>
                                        <a href="viewresult.php?q=result&eid=<?php echo $eid; ?>" class="bg-blue-600 block p-3 rounded-md space-x-1.5 text-center text-sm text-white hover:text-white font-semibold">View result</a>

                                    </div>

                                <?php } ?>
                    <?php }
                        }
                    } ?>



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