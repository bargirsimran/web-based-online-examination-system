<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Departments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Departments">
    <?php include("css.php"); ?>

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">

            <div class="container">
                <div class="mb-2">
                    <div class="text-xl font-semibold">Departments</div>
                    <div class="text-sm mt-2">Add New Departments And Check the list of the Departments</div>
                </div>
                <div class="bg-white rounded-md shadow-md">

                    <ul class="space-y-0 rounded-md uk-accordion" uk-accordion="">

                        <li>
                            <a class="uk-accordion-title border-b py-4 px-6" href="#">
                                <div class="flex items-center text-base font-semibold">
                                    Add Department
                                </div>
                            </a>
                            <div class="uk-accordion-content py-6 px-8 mt-0 border-b" hidden="">

                                <p><span class="font-semibold">Enter Department Name</span></p>
                                <form action="" method="post" id="dept">
                                    <div class="grid sm:grid-cols-1 gap-4 mt-3">
                                        <div id="error">
                                        </div>
                                        <div>
                                            <input type="text" name="department" id="department" placeholder="Enter Department name" class="with-border">
                                        </div>

                                    </div>

                                    <div class="flex flex-wrap items-center justify-between py-2 mt-3">
                                        <button type="submit" name="submit" class="button" id="submit">Add Department</button>
                                    </div>
                                </form>

                            </div>
                        </li>
                        <li class="uk-open">
                            <a class="uk-accordion-title border-b py-4 px-6" href="#">
                                <div class="flex items-center text-base font-semibold">
                                    List of Departments
                                </div>
                            </a>
                            <div class="uk-accordion-content py-6 px-8 mt-0 border-b" hidden="">
                                <div class="-m-5 divide-y divide-gray-200 text-sm overflow-x-auto" id="dlist">
                                    <table class="table-auto w-full no-scrollbar">
                                    

                                        <tbody class="text-sm divide-y divide-gray-100">

                                            <?php
                                            $sql = "SELECT * FROM departments";
                                            $sql_run = $db->query($sql);
                                            while ($rows = $sql_run->fetch_assoc()) {
                                            ?>

                                                <tr id="<?php echo $rows['dept_id']?>">
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="h-10"></div>
                                                            <div class="text-gray-800 font-bold"><?php echo $rows['dept_name'] ?></div>
                                                        </div>
                                                    </td>
        
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-center "><a href="#" onclick="delete_dep('<?php echo $rows['dept_id']?>');" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Delete</a></div>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            <?php include("footer.php"); ?>
        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>

    </div>

    <script src="validate/department.js"></script>
    <?php include("js.php") ?>

</body>

</html>