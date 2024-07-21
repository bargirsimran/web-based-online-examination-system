<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Add Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Add Test">
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

                        <h3 class="border-b flex font-semibold items-center justify-between px-8 py-5 text-base"> New Test </h3>

                        <div class="lg:p-8 p-5">

                            <p> Select respective information and fill test information </p>
                            <div id="error"></div>
                            <form action="" id="new_test" method="POST" class="grid sm:grid-cols-3 gap-x-6 gap-y-4 mt-4">

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
                                    <label for="checkout-fn" class="text-sm font-medium"> Subject</label>

                                    <select id="subject" name="subject" class="form-control text-semibold px-4">
                                        <option selected disabled>Choose Subject</option>
                                    </select>

                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Enter title of Test</label>
                                    <input type="text" class="with-border" id="title" name="title" placeholder="Enter Title ">
                                </div>

                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Enter total Questions</label>
                                    <input type="number" class="with-border" id="total" name="total" min="1"  placeholder="Total Questions">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Marks for each Questions</label>
                                    <input type="number" class="with-border" id="right" name="right" placeholder="Marks for each Quetion" min="0" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places." >
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Negative marks </label>
                                    <input type="number" class="with-border" id="wrong" name="wrong" placeholder="Negative marks for each Question" min="0" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places.">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Total time in minute</label>
                                    <input type="number" class="with-border" id="time" name="time" placeholder="Total time in minute" min="0" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places.">
                                </div>
                                <!-- <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Total subjective</label>
                                    <input type="number" class="with-border" id="subjective" name="subjective" placeholder="Total time in minute" min="0" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places.">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Marks for each Subjective</label>
                                    <input type="number" class="with-border" id="submark" name="submark" placeholder="Total time in minute" min="0" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="This should be a number with up to 2 decimal places.">
                                </div> -->
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Create Test</label>
                                    <button style="width:100%" type="submit" name="submit" id="submit" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white">
                                        Create Test
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

    </div>


    <?php include("js.php") ?>
    <script src="validate/addtest.js"></script>
</body>

</html>