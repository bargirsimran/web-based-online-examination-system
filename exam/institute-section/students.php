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

                    <div class="shadow bg-white rounded-md">

                        <h3 class="border-b flex font-semibold items-center justify-between px-7 py-5 text-base"> Add Students </h3>

                        <div class="lg:p-8 p-5">
                            <div id="error"></div>
                            <p> Select respective Departments, Year and semister and Add Students </p>
                            <form action="" metho="post" class="grid sm:grid-cols-3 gap-x-6 gap-y-4 mt-4" id="student">
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">First Name</label>
                                    <input type="text" class="with-border" id="fname" name="fname" placeholder="Enter First Name">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Middle Name</label>
                                    <input type="text" class="with-border" id="mname" name="mname" placeholder="Enter Middle name">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Lastname</label>
                                    <input type="text" class="with-border" id="lname" name="lname" placeholder="Enter Lastname">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Email</label>
                                    <input type="email" class="with-border" id="email" name="email" placeholder="Enter Email">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Date of Birth</label>
                                    <input type="date" class="with-border pl-4 pr-4" id="dob" name="dob" placeholder="Date of Birth">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium"> Department</label>
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
                                    <label for="checkout-fn" class="text-sm font-medium">Exam Number</label>
                                    <input type="text" class="with-border" id="exnum" name="exnum" placeholder="Enter Exam Number">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Password</label>
                                    <input type="text" class="with-border" id="pass" name="pass" placeholder="Password">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Confirm password</label>
                                    <input type="text" class="with-border" id="cpass" name="cpass" placeholder="Confirm Password">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Add Student</label>

                                    <button style="width:100%" type="submit" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                                        Add Student
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
 
                </div>
            </div>

            <?php include("footer.php"); ?>
        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>
        <script src="validate/students.js"></script>

    </div>


    <?php include("js.php") ?>
</body>

</html>