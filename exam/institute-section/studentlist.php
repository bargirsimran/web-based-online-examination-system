<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Admin | Students</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Admin | Students">
    <?php include("css.php"); ?>
    <link rel="stylesheet" href="../assets/css/tippy.css">

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="container">
                <div class="mx-auto">
                <div class="mb-2">
                    <div class="text-xl font-semibold">Student List</div>
                </div>

                    <div class="shadow  rounded-md">
                        <div class="lg:p-4 p-2">
                            <form action="" class="grid sm:grid-cols-4 gap-x-6 gap-y-4 ">
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium"> Department</label>
                                    <div class="btn-group bootstrap-select rounded-md" id="dept_box">
                                        <select class="selectpicker border rounded-md" tabindex="-98" id="department" name="department">
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
                                    <label for="checkout-fn" class="text-sm font-medium"> Year</label>
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
                                    <label for="checkout-fn" class="text-sm font-medium"> Semester</label>
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
                                    <label for="" class="text-sm font-medium">Students List</label>
                                    <button type="submit" style="width:100%" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                                        Get List
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>



                    <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                        <?php
                        if (isset($_GET['department']) && isset($_GET['year']) && isset($_GET['sem'])) {
                            $d = $_GET['department'];
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
                        ?>
                            <div class="p-3">
                                <div class="overflow-x-auto no-scrollbar">
                                    <table class="table-auto w-full no-scrollbar border">
                                        <thead class="text-xs font-semibold uppercase">
                                            <tr>
                                                <th colspan="3" class="p-2 whitespace-nowrap ">
                                                    <div class="text-center text-blue-500 font-bold"><?php echo $dn?></div>
                                                </th>
                                                
                                                <th class="p-2 whitespace-nowrap ">
                                                    <div class="text-center text-blue-500 font-bold"><?php echo $yn?></div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap ">
                                                    <div class="text-center text-blue-500 font-bold"><?php echo $sn?></div>
                                                </th>
                                    

                                            </tr>
                                            <tr class="text-gray-400 bg-gray-50">
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
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Change Pass</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Remove </div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100 border">
                                            <?php

                                            $sql = "SELECT * FROM students WHERE dept_id = '$d' && year_id = '$y' && sem_id='$s'";
                                            $sql_run = $db->query($sql);
                                            $nr = $sql_run->num_rows;
                                            while ($rows = $sql_run->fetch_assoc()) {

                                            ?>

                                                <tr id="<?php echo $rows['student_id'] ?>">
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="flex items-center">
                                                            <div class="h-10"></div>
                                                            <div class="text-gray-800 font-bold"><?php echo $rows['exam_num'] ?></div>
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
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center"><a href="change-pass.php?student=<?php echo $rows['student_id'] ?>" class="text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Update Password</a></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center"><a href="#" onclick="delete_std('<?php echo $rows['student_id'] ?>')" id="del" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Remove</a></div>
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

                </div>
            </div>

            <?php include("footer.php"); ?>
        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>
        <script src="validate/student_list.js"></script>

    </div>


    <?php include("js.php") ?>
</body>

</html>