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
                <form action="" method="GET" class="grid sm:grid-cols-2 gap-x-6 gap-y-4 mt-4 bg-white p-2 border">
                    <div>
                        <input type="text" class="with-border" name="student" placeholder="Enter exam number">
                    </div>
                    <div>
                        <button style="width:100%" type="submit" name="submit" id="submit" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                            Search Student
                        </button>
                    </div>
                </form>
                <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                    <?php
                    if (isset($_GET['student'])) {
                        $roll = $_GET['student'];
                        $query = "SELECT * FROM students WHERE exam_num='$roll'";
                        $results = $db->query($query);
                        $rows = $results->fetch_array();
                        $fname = $rows['fname'];
                        $mname = $rows['mname'];
                        $lname = $rows['lname'];
                        $email = $rows['email'];
                        $year = $rows['year_id'];
                        $dept = $rows['dept_id'];
                        $sem = $rows['sem_id'];
                        $exam_num = $rows['exam_num'];
                        $stud_id = $rows['student_id'];

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


                    ?>
                        <div class="p-3">
                            <div class="overflow-x-auto no-scrollbar">
                                <table class="table-auto w-full no-scrollbar border">
                                    <thead class="text-xs font-semibold uppercase">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $fname . " " . $mname . " " . $lname ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $dn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $roll ?></div>
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
                                                <div class="font-semibold text-center">Subjetc</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Test Name</div>
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
                                        $query = "SELECT * FROM history WHERE username='$stud_id'";
                                        $run = $db->query($query);
                                        while ($result = $run->fetch_array()) {
                                            $stud_id = $result['username'];
                                            $testid = $result['eid'];

                                            $query = "SELECT * FROM testdetails WHERE eid='$testid '";
                                            $results = $db->query($query);
                                            $rows = $results->fetch_array();
                                            $n = $rows['total'];
                                            $title = $rows['title'];
                                            $subject = $rows['subject_id'];
                                            $title = $rows['title'];
                                            $correct = $rows['correct'];
                                            $wrong = $rows['wrong'];
                                            $time = $rows['time'];

                                            $sqlsub = "SELECT subject_name FROM subjects WHERE subject_id = '$subject'";
                                            $sql_run = $db->query($sqlsub);
                                            $rows = $sql_run->fetch_assoc();
                                            $subname = $rows['subject_name'];


                                        ?>

                                            <tr>
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
                                                        <div class="text-gray-800 font-bold">
                                                            <?php
                                                            echo $title;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $result['score']; ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $result['correct']; ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo $result['wrong']; ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap border">
                                                    <div class="text-center text-green-500 font-bold"><?php echo ($n - $result['correct'] - $result['wrong']); ?></div>
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