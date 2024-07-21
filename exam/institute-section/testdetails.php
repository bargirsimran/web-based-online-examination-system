<?php
ob_start();
include("session.php");
include("connection.php");

$tid = $_GET['test_id'];

$query = "SELECT * FROM testdetails WHERE eid='$tid'";
$results = $db->query($query);
$rows = $results->fetch_array();
$n = $rows['total'];
$title = $rows['title'];
$dept = $rows['dept_id'];
$year = $rows['year_id'];
$sem = $rows['sem_id'];
$subject = $rows['subject_id'];
$title = $rows['title'];
$correct = $rows['correct'];
$wrong = $rows['wrong'];
$time = $rows['time'];
$ass_grps = $rows['grp_id'];
$statusT = $rows['status'];
$ass_grp_arr = explode(",", $ass_grps);

$sql = "SELECT * FROM questions WHERE eid = '$tid'";
$sql_run = $db->query($sql);
$numrowcount = $sql_run->num_rows;


$sqld = "SELECT dept_name FROM departments WHERE dept_id = '$dept' ";
$sql_rund = $db->query($sqld);
$rowsd = $sql_rund->fetch_assoc();
$dn = $rowsd['dept_name'];

$sqly = "SELECT year_name FROM class_years WHERE  year_id = '$year' ";
$sql_runy = $db->query($sqly);
$rowsy = $sql_runy->fetch_assoc();
$yn = $rowsy['year_name'];

$sqls = "SELECT sem_name FROM semesters WHERE sem_id = '$sem' ";
$sql_runs = $db->query($sqls);
$rowss = $sql_runs->fetch_assoc();
$sn = $rowss['sem_name'];

$sqlsub = "SELECT subject_name FROM subjects WHERE subject_id = '$subject'";
$sql_run = $db->query($sqlsub);
$rows = $sql_run->fetch_assoc();
$subname = $rows['subject_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Admin | Test Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Admin | Test Details">
    <?php include("css.php"); ?>
    <link rel="stylesheet" href="../assets/css/pjms.css">

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">

            <div class="m-4">

                <div class="">
                    <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                        <div class="p-3">
                            <div class="overflow-x-auto no-scrollbar">
                                <table class="table-auto w-full no-scrollbar border">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 ">
                                        <tr>
                                            <th colspan="3" class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $dn ?></div>
                                            </th>

                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $yn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $sn ?></div>
                                            </th>
                                            <th colspan="2" class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-red-500 font-bold"><?php echo $subname ?></div>
                                            </th>

                                        </tr>
                                        <tr class="bg-gray-50">
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Title</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Total Ques</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Marks</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">negative marks </div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Time (min) </div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Action</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Assign Groups</div>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-sm divide-y divide-gray-100 border">
                                        <tr>

                                            <td class="p-2 whitespace-nowrap border py-4">
                                                <div class="text-center font-bold"><?php echo $title ?></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border py-4">
                                                <div class="text-center font-bold"><?php echo $n ?></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center text-green-500 font-bold"><?php echo $correct * $n ?></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center font-bold"><?php echo $wrong ?></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center font-bold"><?php echo $time ?></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border" id="en-db-<?php echo $tid  ?>">
                                                <?php
                                                if ($statusT  == "enabled") {
                                                ?>
                                                    <div class="text-center"><span onclick="disable('<?php echo $tid;  ?>')" class="text-yellow-500 bg-transparent border border-solid border-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Disable</span></div>
                                                <?php } else { ?>
                                                    <div class="text-center"><span onclick="enable('<?php echo $tid  ?>')" class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Enable</span></div>
                                                <?php } ?>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center"><a href="" uk-toggle="target: #modal-close-default" id="as_std" class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Assign Groups</a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php
                    if (isset($_GET['test_id']) && isset($_GET['task']) && $_GET['task'] == "view") {
                        if ($numrowcount == $n) {
                    ?>
                            <div class="bg-white rounded-md shadow-lg ">

                                <ul class="space-y-0 rounded-md uk-accordion" uk-accordion="">
                                    <?php
                                    for ($i = 1; $i <= $n; $i++) {
                                    ?>
                                        <li class="uk-open">
                                            <a class="uk-accordion-title border-b py-4 px-6" href="#">
                                                <div class="flex items-center text-base font-semibold">
                                                    Question No <?php echo $i ?>
                                                </div>
                                            </a>
                                            <div class="uk-accordion-content py-6 px-8 mt-0 border-b" hidden="">
                                                <div class="row ">
                                                    <div class="col-lg-6 border">
                                                        <?php
                                                        $ques = $db->query("SELECT * FROM questions WHERE  eid='$tid' and sn='$i'");
                                                        $qout = $ques->fetch_array();
                                                        $queid = $qout['qid'];
                                                        $qns = $qout['qns'];
                                                        ?>
                                                        <div class="overflow-y-auto p-4 h-40 no-scrollbar "><?php echo $qns ?></div>
                                                    </div>
                                                    <div class="col-lg-4 border">
                                                        <div class="overflow-y-auto h-40 no-scrollbar">
                                                            <table class=" w-full no-scrollbar">
                                                                <tbody class="text-sm divide-y divide-gray-100 ">
                                                                    <?php
                                                                    $ans = $db->query("SELECT * FROM answer WHERE qid='$queid'");
                                                                    $ansout = $ans->fetch_array();
                                                                    $answer = $ansout['ansid'];
                                                                    $opt = $db->query("SELECT * FROM options WHERE qid='$queid'");
                                                                    while ($opout = $opt->fetch_array()) {
                                                                    ?>
                                                                        <tr>
                                                                            <td class="p-2 whitespace-nowrap">
                                                                                <div class="flex items-center">
                                                                                    <div class="<?php if ($answer == $opout['optionid']) { ?>text-green-500 <?php } else { ?>text-gray-800 <?php } ?> font-bold"><?php echo $opout['options'] ?></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>


                                                                    <?php
                                                                    } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 border  place-items-center flex justify-center py-4">
                                                        <div>
                                                            <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="edittest.php?test_id=<?php echo $tid ?>&que_id=<?php echo $queid ?>">Edit Q <?php echo $i; ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>

                            </div>
                    <?php } else {
                            $sql = "DELETE * FROM questions WHERE eid = '$tid'";
                            $sql_run = $db->query($sql);
                            header('location:testdetails.php?test_id=' . $tid . '&task=question');
                        }
                    } ?>
                    <br>
                    <?php
                    if (isset($_GET['test_id']) && isset($_GET['task']) && $_GET['task'] == "question") {
                        if ($numrowcount == $n) {
                            header('location:testdetails.php?test_id=' . $tid . '&task=view');
                        } else {
                    ?>
                            <div class="">
                                <!-- id="addqbox" -->
                                <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                                    <div class="p-3">
                                        <form action="update.php?test_id=<?php echo $tid; ?>&task=addqns" method="POST" id="test" data-set="<?php echo $n; ?>">
                                            <?php
                                            for ($i = 1; $i <= $n; $i++) {
                                            ?>
                                                <div class="ml-2">
                                                    <p class="text-center text-green-500 font-bold">Question number&nbsp;<?php echo $i; ?>&nbsp;:</p>
                                                </div>
                                                <hr>
                                                <div class="row border m-2 pb-2 bg-gray-100">
                                                    <div class="col-lg-12">
                                                        <p class="text-red-500 font-bold mt-0">Write Question <?php echo $i; ?>:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div id="q_box-<?php echo $i; ?>" class="p-0">
                                                            <textarea id="qns-<?php echo $i; ?>" class="tiny" name="qns<?php echo $i; ?>" placeholder="Write question number <?php echo $i; ?> here..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="grid sm:grid-cols-1 gap-x-6 gap-y-4 border mt-0 p-4 bg-white" id="opb-<?php echo $i; ?>">

                                                            <div>
                                                                <p class="text-center text-blue-500 font-bold">Enter Options</p>
                                                                <hr>
                                                                <input class="with-border mt-2" type="text" value="" id="op<?php echo $i; ?>1" name="<?php echo $i; ?>1" placeholder="Enter option 1">
                                                            </div>
                                                            <div>
                                                                <input class="with-border" type="text" value="" id="op<?php echo $i; ?>2" name="<?php echo $i; ?>2" placeholder="Enter option 2">
                                                            </div>
                                                            <div>
                                                                <input class="with-border" type="text" value="" id="op<?php echo $i; ?>3" name="<?php echo $i; ?>3" placeholder="Enter option 3">
                                                            </div>
                                                            <div>
                                                                <input class="with-border" type="text" value="" id="op<?php echo $i; ?>4" name="<?php echo $i; ?>4" placeholder="Enter option 4">
                                                            </div>

                                                            <div>
                                                                <p class="text-center text-green-500 font-bold">Correct Answer</p>
                                                                <hr>
                                                                <div class="btn-group bootstrap-select rounded-md mt-2" id="ans_box<?php echo $i; ?>">
                                                                    <select class="selectpicker border rounded-md" tabindex="-98" name="ans<?php echo $i; ?>" id="ans<?php echo $i; ?>">
                                                                        <option value="" selected disabled>Select Correct answer <?php echo $i; ?></option>
                                                                        <option value="a">option 1</option>
                                                                        <option value="b">option 2</option>
                                                                        <option value="c">option 3</option>
                                                                        <option value="d">option 4</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                            <?php
                                            }
                                            ?>
                                            <div class="uk-modal-footer text-right mt-6 px-0 space-x-1">
                                                <button id="submit" class="button" type="submit">Add Question</button>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>


            <!-- This is the modal with the default close button -->
            <div id="modal-close-default" uk-modal>
                <div class="uk-modal-dialog uk-modal-body rounded-md shadow-2xl">
                    <button class="uk-modal-close-default bg-gray-300 p-2 rounded-full m-3" type="button" id="cn" uk-close></button>
                    <h2 class="mb-2 font-bold">Assign Groups To Test</h2>
                    <hr>
                    <form action="" method="POST" id="assign" dataset="<?php echo $tid; ?>">
                        <?php
                        $sql_run = $db->query("SELECT * FROM test_groups WHERE dept_id='$dept' AND year_id = '$year' AND sem_id='$sem'");
                        while ($grps = $sql_run->fetch_assoc()) {
                        ?>
                            <div class="inline-flex items-center mt-3 p-2 border m-2">
                                <input type="checkbox" value="<?php echo $grps['grp_id'] ?>" name="grp_list[]" class="form-checkbox h-5 w-5 text-green-600" <?php if (in_array($grps['grp_id'], $ass_grp_arr)) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>><span class="ml-2 text-gray-700"><?php echo $grps['grp_name'] ?></span>
                            </div>
                        <?php } ?>
                        <br>
                        <hr>
                        <button style="height:100%" id="submit" class="text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none  ease-linear transition-all duration-150 mt-4 ml-2" type="submit">Assign Groups</button>
                    </form>
                </div>
            </div>

            <?php include("footer.php"); ?>
        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>

    </div>

    <script src="../assets/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="../assets/tinymce/js/tinymce/init.tinymce.min.js"></script>
    <?php include("js.php") ?>
    <?php
    if (isset($_GET['test_id']) && isset($_GET['task']) && $_GET['task'] == "question") {
    ?>
        <script src="validate/testdetails.js"></script>
    <?php } ?>
    <script src="validate/grpassign.js"></script>
    <script src="validate/fun.js"></script>
    <script src="../validate/pjms.js"></script>
</body>

</html>