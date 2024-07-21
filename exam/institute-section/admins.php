<?php
include("session.php");
include("connection.php");
$ses = $_SESSION["loginsession"];
$sql = "SELECT * FROM institute_admin WHERE email = '$ses'";
$sql_run = $db->query($sql);
$rows = $sql_run->fetch_assoc();
if ($rows['type'] == 'super') {
} else {
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Admins</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Admins">
    <?php include("css.php"); ?>
    <link rel="stylesheet" href="../assets/css/tippy.css">

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="container">
                <div class="mb-2">
                    <div class="text-xl font-semibold">Create Admins</div>
                </div>
                <div class="mx-auto">

                    <div class="shadow-lg  rounded-md border border-gray-200">
                        <div class="lg:p-4 p-2">
                            <div id="error"></div>
                            <form action="" method="POST" class="grid sm:grid-cols-3 gap-x-6 gap-y-4 " id="admin">
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Enter First Name</label>
                                    <input type="text" class="with-border" id="fname" name="fname" placeholder="Enter First name">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Enter Last Name</label>
                                    <input type="text" class="with-border" id="lname" name="lname" placeholder="Enter Last name">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Enter Email</label>
                                    <input type="email" class="with-border" id="email" name="email" placeholder="Enter Email">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Enter Password</label>
                                    <input type="text" class="with-border" id="pass" name="pass" placeholder="Enter password">
                                </div>
                                <div>
                                    <label for="checkout-fn" class="text-sm font-medium">Confirm Password</label>
                                    <input type="text" class="with-border" id="cpass" name="cpass" placeholder="Confirm password">
                                </div>

                                <div>
                                    <label for="" class="text-sm font-medium">Create Admin</label>
                                    <button type="submit" name="submit" style="width:100%" class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white ">
                                        Create Admin
                                        </a>
                                </div>
                            </form>
                        </div>

                    </div>

                    <br>
                    <div class="mb-2">
                        <div class="text-xl font-semibold">Admin Details</div>
                    </div>

                    <div class="mt-4 w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                        <header class="border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Customers</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Name</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Email</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Role</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Action</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        <?php
                                        $sql = "SELECT * FROM institute_admin ";
                                        $sql_run = $db->query($sql);
                                        while ($rows = $sql_run->fetch_assoc()) {
                                        ?>
                                            <tr id="<?php echo $rows['id']?>">
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="flex items-center">

                                                        <div class="text-left"><?php echo $rows['fname'] . " " . $rows['lname'] ?></div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left"><?php echo $rows['email'] ?></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">Admin</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap text-center">
                                                    <?php if ($rows['type'] != "super") { ?>
                                                        <div class="text-center"><a href="#" onclick="delete_admin('<?php echo $rows['id'] ?>')" id="addq" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Remove</a></div>
                                                    <?php }else{
                                                        echo "Permanent";
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
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
    <script src="validate/admin.js"></script>
</body>

</html>