<?php
include("session.php");
include("connection.php");
include("student_detail.php");
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
                <div class="grid grid-cols-3 gap-3 lg:p-6 p-4 m-4 bg-white border">
                    <?php
                    $sqld = "SELECT dept_name FROM departments WHERE dept_id = '$dept_id' ";
                    $sql_rund = $db->query($sqld);
                    $rowsd = $sql_rund->fetch_assoc();
                    $dn = $rowsd['dept_name'];

                    $sqly = "SELECT year_name FROM class_years WHERE  year_id = '$year_id' ";
                    $sql_runy = $db->query($sqly);
                    $rowsy = $sql_runy->fetch_assoc();
                    $yn = $rowsy['year_name'];

                    $sqls = "SELECT sem_name FROM semesters WHERE sem_id = '$sem_id' ";
                    $sql_runs = $db->query($sqls);
                    $rowss = $sql_runs->fetch_assoc();
                    $sn = $rowss['sem_name'];
                    ?>
                    <div>
                        <label for="first-name"> First name</label>
                        <input type="text" value="<?php echo $fname ?>" id="first-name" class="shadow-none with-border" readonly>
                    </div>
                    <div>
                        <label for="last-name"> Middle name</label>
                        <input type="text" value="<?php echo $mname ?>" id="m-name" class="shadow-none with-border" readonly>
                    </div>
                    <div>
                        <label for="last-name"> Last name</label>
                        <input type="text" value="<?php echo $lname ?>" id="last-name" class="shadow-none with-border" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="email"> Email </label>
                        <input type="text" value="<?php echo $email ?>" id="email" class="shadow-none with-border" readonly>
                    </div>
                    <div>
                        <label for="dob-name">Date of Birth</label>
                        <input type="text" value="<?php echo $dob ?>" id="dob-name" class="shadow-none with-border" readonly>
                    </div>
                    <div class="">
                        <label for="about">Department</label>
                        <input type="text" value="<?php echo $dn;
                                                    ?>" id="email" class="shadow-none with-border" readonly>
                    </div>
                    <div class="">
                        <label for="year">Year </label>
                        <input type="text" value="<?php echo $yn ?>" id="year" class="shadow-none with-border" readonly>
                    </div>


                    <div class="">
                        <label for="sem"> Semester</label>
                        <input type="text" value="<?php echo $sn ?>" id="sem" class="shadow-none with-border" readonly>
                    </div>
                    <div>
                        <label for="enum"> Exam Number</label>
                        <input type="text" value="<?php echo $exam_num ?>" id="enum" class="shadow-none with-border" readonly>
                    </div>

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