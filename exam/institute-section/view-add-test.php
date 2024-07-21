<?php
include("session.php");
include("connection.php");
if (!isset($_GET['test_id'])) {
    header('location:index.php');
}
$tid = $_GET['test_id'];
$qid = $_GET['que_id'];

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
    <title>Courseplus Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Courseplus is - Professional A unique and beautiful collection of UI elements">
    <?php include("css.php"); ?>

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div id="main_cont" class="">
                <div class="mx-4">
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
                                                <div class="flex items-center">
                                                    <div class="text-gray-800 font-bold"><?php echo $title ?></div>
                                                </div>
                                            </th>


                                        </tr>
                                        <tr class="bg-gray-50">
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
                                                <div class="font-semibold text-center">Add Ques</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Edit Test</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Assign Students</div>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-sm divide-y divide-gray-100 border">
                                        <tr>

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
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center"><a href="#" id="addq" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Add Ques</a></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center "><a href="#" id="editt" class="text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Edit Test</a></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap border">
                                                <div class="text-center"><a href="" id="as_std" class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Assign Student</a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            if (isset($_GET['test_id']) && isset($_GET['que_id'])) {
            ?>
                <div class="mx-4 ">
                    <!-- id="addqbox" -->
                    <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                        <div class="p-3">
                            <?php
                            $ques = $db->query("SELECT * FROM questions WHERE  eid='$tid' and qid='$qid'");
                            $qout = $ques->fetch_array();
                            $queid = $qout['qid'];
                            $sn = $qout['sn'];
                            ?>
                            <hr class="mt-2">
                            <form action="update.php?test_id=<?php echo $tid; ?>&questionid=<?php echo $queid; ?>&task=edit" method="POST" id="test_edit" data-t="<?php echo $tid; ?>" data-q="<?php echo $queid; ?>">
                                <div class="ml-2">
                                    <p class="text-center text-green-500 font-bold">Question number&nbsp;<?php echo $sn; ?>&nbsp;:</p>
                                </div>
                                <hr>
                                <div class="row border m-2 pb-2 bg-gray-100">
                                    <div class="col-lg-12">
                                        <p class="text-red-500 font-bold mt-0">Edit Question <?php echo $sn; ?>:</p>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="q_box" class="p-0">
                                            <textarea id="qns" class="tiny" name="qns" placeholder="Edit question number <?php echo $sn; ?> here..."> <?php echo $qout['qns']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="grid sm:grid-cols-1 gap-x-6 gap-y-4 border mt-0 p-4 bg-white" id="opb">

                                            <?php
                                            $opt = $db->query("SELECT * FROM options WHERE qid='$queid' ORDER BY opno ASC");
                                            $x = 1;
                                            while ($opout = $opt->fetch_array()) {
                                            ?>
                                                <div>
                                                    <?php if ($x == '1') { ?>
                                                        <p class="text-center text-blue-500 font-bold">Edit Options</p>
                                                        <hr class="mb-2">
                                                    <?php } ?>
                                                    <input class="with-border " type="text" value="<?php echo $opout["options"]; ?>" id="op<?php echo $x; ?>" name="<?php echo $x; ?>1" placeholder="Enter option <?php echo $x ?>">
                                                </div>
                                            <?php $x++;
                                            } ?>

                                            <div>
                                                <p class="text-center text-green-500 font-bold">Correct Answer</p>
                                                <hr>
                                                <div class="btn-group bootstrap-select rounded-md mt-2" id="ans_box">
                                                    <select class="selectpicker border rounded-md" tabindex="-98" name="ans" id="ans">
                                                        <?php
                                                        $ans = $db->query("SELECT * FROM answer WHERE  qid='$queid'");
                                                        $ansout = $ans->fetch_array();
                                                        $ansid = $ansout['ansid'];
                                                        ?>
                                                        <option value="<?php echo $ansid ?>">
                                                            <?php
                                                            $opt = $db->query("SELECT * FROM options WHERE qid='$queid' ORDER BY opno ASC");
                                                            while ($opout = $opt->fetch_array()) {
                                                                if ($opout['optionid'] == $ansid) {
                                                                    if ($opout['opno'] == 1) {
                                                                        echo "option a";
                                                                    } else if ($opout['opno'] == 2) {
                                                                        echo "option b";
                                                                    } else if ($opout['opno'] == 3) {
                                                                        echo "option c";
                                                                    } else if ($opout['opno'] == 4) {
                                                                        echo "option d";
                                                                    }
                                                                }
                                                            }

                                                            ?>

                                                        </option>
                                                        <?php
                                                        $o = 'a';
                                                        $opt = $db->query("SELECT * FROM options WHERE qid='$queid' ORDER BY opno ASC");
                                                        while ($opout2 = $opt->fetch_array()) { ?>
                                                            <option value="<?php echo $opout2['optionid'] ?>">option <?php echo $o; ?></option>

                                                        <?php
                                                            $o++;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="text-right mt-3 px-0 space-x-1">
                                    <button id="submit" class="button" type="submit">Update question <?php echo $sn; ?></button>

                                </div>


                            </form>


                        </div>
                    </div>
                </div>

            <?php } ?>

            <?php include("footer.php"); ?>

        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>

    </div>

    <script src="validate/department.js"></script>
    <?php include("js.php") ?>

</body>

</html>