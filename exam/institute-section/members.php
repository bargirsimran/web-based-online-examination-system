<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Group Members</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Group Members">
    <?php include("css.php"); ?>
    <link rel="stylesheet" href="../assets/css/tippy.css">

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="container">
                <div class="text-right mt-3 px-0 space-x-1">
                    <button id="submit" class="button" form="grp_std_add" type="submit">Add Students to Group</button>
                </div>
                <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                    <?php
                    if (isset($_GET['group'])) {
                        $gid = $_GET['group'];

                        $query = "SELECT * FROM test_groups WHERE grp_id='$gid'";
                        $results = $db->query($query);
                        $rows = $results->fetch_array();
                        $dept = $rows['dept_id'];
                        $year = $rows['year_id'];
                        $sem = $rows['sem_id'];
                        $gn = $rows['grp_name'];



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
                                            <th colspan="2" class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $dn ?></div>
                                            </th>

                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $yn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $sn ?></div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap ">
                                                <div class="text-center text-blue-500 font-bold"><?php echo $gn ?></div>
                                            </th>


                                        </tr>
                                        <tr class="text-gray-400 bg-gray-50">
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Add </div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Exam Number</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Student Name</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Email</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap border">
                                                <div class="font-semibold text-center">Date of Birth</div>
                                            </th>


                                        </tr>
                                    </thead>
                                  
                                    <form action="brain.php?task=grp_members&grp_id=<?php echo $gid; ?>" method="post" id="grp_std_add">
                                        
                                        <tbody class="text-sm divide-y divide-gray-100 border">
                                            <?php

                                            $sql = "SELECT * FROM students WHERE dept_id = '$dept' && year_id = '$year' && sem_id='$sem' ORDER BY exam_num ASC";
                                            $sql_run = $db->query($sql);
                                            $nr = $sql_run->num_rows;
                                            while ($rows = $sql_run->fetch_assoc()) {
                                                $sid = $rows['student_id'];
                                                $sql_r = $db->query("SELECT student_id FROM grp_member WHERE grp_id = '$gid' AND student_id = '$sid'");
                                                $nr1 = $sql_r->num_rows;
                                            ?>

                                                <tr id="<?php echo $rows['student_id'] ?>">
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center">
                                                            <label class="inline-flex items-center mt-3">
                                                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="students_list[]" value="<?php echo $rows['student_id'] ?>" <?php if($nr1>0){ echo "checked";} ?>>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="flex items-center">
                                                            <div class="h-10"></div>
                                                            <div class="text-gray-800 font-bold text-center"><?php echo $rows['exam_num'] ?></div>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center font-bold"><?php echo $rows['fname'] . " " . $rows['mname'] . " " . $rows['lname'] ?></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center text-green-500 font-bold"><?php echo $rows['email'] ?></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center font-bold"><?php echo $rows['dob'] ?></div>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>


                    <?php }
                    ?>
                </div>
            </div>
            <?php include("footer.php"); ?>


        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>

    </div>


    <?php include("js.php") ?>
    <script src="validate/members.js"></script>
</body>

</html>