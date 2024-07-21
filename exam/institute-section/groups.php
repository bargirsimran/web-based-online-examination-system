<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Groups</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Groups">
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

                    <!-- Form for Group  -->
                    <div class="shadow bg-white rounded-md">

                        <h3 class="border-b flex font-semibold items-center justify-between px-7 py-5 text-base"> Add Group </h3>

                        <div class="lg:p-8 p-5">

                            <p> Select respective Departments, Year and semester and submit group Name </p>
                            <div id="error">

                            </div>
                            <form action="" method="post" class="grid sm:grid-cols-2 gap-x-6 gap-y-4 mt-4" id="grp">

                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium"> Department</label>
                                    <div class="btn-group bootstrap-select rounded-md">
                                        <select name="department" class="selectpicker border rounded-md" tabindex="-98">
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
                                    <div class="btn-group bootstrap-select rounded-md">
                                        <select name="year" class="selectpicker border rounded-md" tabindex="-98">
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
                                    <label for="checkout-fn" class="text-sm font-medium"> semester</label>
                                    <div class="btn-group bootstrap-select rounded-md">
                                        <select name="sem" class="selectpicker border rounded-md" tabindex="-98">
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
                                    <label for="checkout-fn" class="text-sm font-medium">Enter Group Name</label>
                                    <input type="text" id="group" name="group" class="with-border" id="checkout-fn" placeholder="Enter Group Name">
                                </div>
                                <hr>
                                <hr>
                                <div>
                                    <button type="submit" name="submit" id="submit"  class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white px-5">
                                        Add Group
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>


                    <!-- form for special search -->
                    <div class="mt-4 w-full mx-auto shadow-lg rounded-md border border-gray-200">
                        <div class="lg:p-4 p-2 ">
                            <form action="" method="get" class="grid sm:grid-cols-4 gap-x-6 gap-y-4">

                                <div>

                                    <div class="btn-group bootstrap-select rounded-md">
                                        <select name="department" class="selectpicker border rounded-md" tabindex="-98" required>
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
                                    <div class="btn-group bootstrap-select rounded-md">
                                        <select name="year" class="selectpicker border rounded-md" tabindex="-98" required>
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
                                    <div class="btn-group bootstrap-select rounded-md">
                                        <select name="sem" class="selectpicker border rounded-md" tabindex="-98" required>
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
                                    <button value="submit" type="submit" style="width:100%" name="submit" id="submit" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white px-5">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">

                        <?php
                        if (isset($_GET['department']) && isset($_GET['year']) && isset($_GET['sem'])) {
                        ?>
                            <div class="p-3">
                                <div class="overflow-x-auto no-scrollbar">
                                    <table class="table-auto w-full no-scrollbar border">
                                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                            <tr>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Department name</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Class Year</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Semester</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Group Name</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Remove </div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap border">
                                                    <div class="font-semibold text-center">Assign Student</div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <?php
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

                                        $sql = "SELECT grp_id, grp_name FROM test_groups WHERE dept_id = '$d' && year_id = '$y' && sem_id='$s'";
                                        $sql_run = $db->query($sql);
                                        while ($rows = $sql_run->fetch_assoc()) {

                                        ?>
                                            <tbody class="text-sm divide-y divide-gray-100 border">
                                                <tr id = "<?php echo $rows['grp_id'] ?>">
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="flex items-center">
                                                            <div class="h-10"></div>
                                                            <div class="text-gray-800 font-bold"><?php echo $dn ?></div>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center font-bold"><?php echo $yn ?></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center text-green-500 font-bold"><?php echo $sn ?></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center font-bold"><?php echo $rows['grp_name'] ?></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center"><a href="#" onclick="delete_sub('<?php echo $rows['grp_id'] ?>')" id="addg" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Remove</a></div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap border">
                                                        <div class="text-center"><a href="members.php?group=<?php echo $rows['grp_id'] ?>" id="addg" class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Assign Students</a></div>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        <?php } ?>
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

    </div>


    <?php include("js.php") ?>
    <script src="validate/groups.js"></script>
</body>

</html>