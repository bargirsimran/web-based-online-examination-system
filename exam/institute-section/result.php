<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Results</title>
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
            <div class="lg:p-8 p-5">

                <p class="font-bold"> Result </p>
                <form action="" method="GET" class="grid sm:grid-cols-5 gap-x-6 gap-y-4 mt-4 bg-white p-2 border">
                    <div>
                        <div class="btn-group bootstrap-select rounded-md" id="dept_box">
                            <select class="selectpicker border rounded-md" tabindex="-98" id="dept" name="dept">
                                <option selected disabled>Choose Department</option>
                                <?php
                                $sql = "SELECT * FROM departments";
                                $sql_run = $db->query($sql);
                                while ($rows = $sql_run->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rows['dept_id'] ?>"><?php echo $rows['dept_name'] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="btn-group bootstrap-select rounded-md" id="year_box">
                            <select class="selectpicker border rounded-md" tabindex="-98" id="year" name="year">
                                <option selected disabled>Choose year</option>
                                <?php
                                $sql = "SELECT * FROM class_years";
                                $sql_run = $db->query($sql);
                                while ($rows = $sql_run->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rows['year_id'] ?>"><?php echo $rows['year_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="btn-group bootstrap-select rounded-md" id="sem_box">
                            <select name="sem" id="sem" class="selectpicker border rounded-md" tabindex="-98">
                                <option selected disabled>Choose semester</option>
                                <?php
                                $sql = "SELECT * FROM semesters";
                                $sql_run = $db->query($sql);
                                while ($rows = $sql_run->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rows['sem_id'] ?>"><?php echo $rows['sem_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div>

                        <select id="subject" name="subject" class="form-control text-semibold px-4">
                            <option selected disabled>Choose Subject</option>
                        </select>

                    </div>
                    <div>
                        <button style="width:100%" type="submit" name="submit" id="submit" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                            Search Tests
                        </button>
                    </div>
                </form>

                <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                    <?php
                    if (isset($_GET['dept']) && isset($_GET['year']) && isset($_GET['sem'])) {
                        $d = $_GET['dept'];
                        $sqld = "SELECT dept_name FROM departments WHERE dept_id = '$d' ";
                        $sql_rund = $db->query($sqld);
                        $rowsd = $sql_rund->fetch_assoc();
                        $dn = $rowsd['dept_name'];

                        $y = $_GET['year'];
                        $sqly = "SELECT year_name FROM class_years WHERE  year_id = '$y' ";
                        $sql_runy = $db->query($sqly);
                        $rowsy = $sql_runy->fetch_assoc();
                        $yn = $rowsy['year_name'];

                        $s = $_GET['sem'];
                        $sqls = "SELECT sem_name FROM semesters WHERE sem_id = '$s' ";
                        $sql_runs = $db->query($sqls);
                        $rowss = $sql_runs->fetch_assoc();
                        $sn = $rowss['sem_name'];

                        $subj = $_GET['subject'];
                        $sqlsubj = "SELECT subject_name FROM subjects WHERE subject_id = '$subj' ";
                        $sql_runsubj = $db->query($sqlsubj);
                        $rowssub = $sql_runsubj->fetch_assoc();
                        $sn = $rowssub['subject_name'];

                    ?>
                        <div class="p-3">
                            <div class="overflow-x-auto no-scrollbar">
                                <table class="table-auto w-full no-scrollbar border">
                                    <thead class="text-xs font-semibold uppercase">
                                        <tr>
                                            <th colspan="2" class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $dn ?></div>
                                            </th>

                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $yn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $sn ?></div>
                                            </th>


                                        </tr>
                                        <tr class="text-gray-400 bg-gray-50">
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Subject</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Test Title</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Marks</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Action</div>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100 border">
                                        <?php

                                        $sql = "SELECT * FROM testdetails WHERE dept_id = '$d' && year_id = '$y' && sem_id='$s'&& subject_id = '$subj'";
                                        $sql_run = $db->query($sql);
                                        $nr = $sql_run->num_rows;
                                        while ($rows = $sql_run->fetch_assoc()) {
                                            $x = $rows['subject_id'];
                                            $sql = "SELECT subject_name FROM subjects WHERE subject_id = '$x'";
                                            $sql_runs = $db->query($sql);
                                            $sub  = $sql_runs->fetch_assoc();
                                            $subname = $sub['subject_name'];;
                                        ?>

                                            <tr id="<?php echo $rows['eid'] ?>">
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="flex items-center">
                                                        <div class="h-10"></div>
                                                        <div class="text-gray-800 font-bold">
                                                            <?php
                                                            echo $subname;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="flex items-center">
                                                        <div class="text-gray-800 font-bold"><?php echo $rows['title'] ?></div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $rows['total'] * $rows['correct'] ?></div>
                                                </td>


                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center "><a href="result.php?test_id=<?php echo $rows['eid'] ?>&task=result" class="text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">View Result</a></div>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    <?php }
                    ?>
                </div>

                <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                    <?php
                    if (isset($_GET['test_id']) && $_GET['task'] == 'result') {
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
                        <div class="p-3">
                            <div class="overflow-x-auto no-scrollbar">
                                <table class="table-auto w-full no-scrollbar border">
                                    <thead class="text-xs font-semibold uppercase">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $dn ?></div>
                                            </th>

                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $yn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $sn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $subname ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $title ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $ass_grps ?></div>
                                            </th>


                                        </tr>
                                        <tr class="text-gray-400 bg-gray-50">
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Exm Number</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Student Name</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Marks</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Correct</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Wrong</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">UnAttempted</div>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100 border">
                                        <?php
                                        $query = "SELECT * FROM history WHERE eid='$tid'";
                                        $run = $db->query($query);
                                        while ($results = $run->fetch_array()) {
                                            $stud_id = $results['username'];
                                            $sql = "SELECT * FROM students WHERE student_id = '$stud_id'";
                                            $sql_run = $db->query($sql);
                                            $rows = $sql_run->fetch_assoc();
                                            $fname = $rows['fname'];
                                            $mname = $rows['mname'];
                                            $lname = $rows['lname'];
                                            $exam_num = $rows['exam_num'];
                                        ?>

                                            <tr>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="flex items-center">
                                                        <div class="h-10"></div>
                                                        <div class="text-gray-800 font-bold">
                                                            <?php
                                                            echo $exam_num;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="flex items-center">
                                                        <div class="text-gray-800 font-bold">
                                                            <?php
                                                            echo $fname . " " . $mname . " " . $lname;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $results['score']; ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $results['correct']; ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $results['wrong']; ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo ($n - $results['correct'] - $results['wrong']); ?></div>
                                                </td>



                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                    }
                        ?>
                        </div>
                </div>
       
        <?php include("footer.php"); ?>
    </div>

    <!-- sidebar -->
    <?php include("sidebar.php"); ?>

    </div>


    <?php include("js.php") ?>
    <script src="validate/addtest.js"></script>
</body>

</html>