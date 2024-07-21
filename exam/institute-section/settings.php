<?php
include("session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Institute | Admin | Settings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute | Admin | Settings">
    <?php include("css.php"); ?>

</head>

<body>

    <div id="wrapper" class="is-verticle">

        <?php include("header.php"); ?>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="container">
                <div class="grid lg:grid-cols-3 gap-8 md:mt-12">
                    <div>
                        <div uk-sticky="offset:100;bottom:true;media:992" class="uk-sticky" style="color:inherit">
                            <h3 class="text-lg mb-2 font-semibold"> Password</h3>
                            <p> Enter your current password, new password and confirm it and click on change Password.</p>
                            <div id="error"></div>
                        </div>
                        <div class="uk-sticky-placeholder" style="height: 90px; margin: 0px;" hidden=""></div>
                    </div>
                    <div class="bg-white rounded-md lg:shadow-md shadow col-span-2">
                        <form action="" method="post" id="changepass">
                            <div class="lg:p-6 p-4 space-y-4">
                                <div>
                                    <label for="current_password">Current password</label>
                                    <input type="text" placeholder="" id="current_password" name="current_password" class="shadow-none with-border">
                                </div>
                                <div>
                                    <label for="new_password">New password</label>
                                    <input type="text" placeholder="" id="new_password" name="new_password" class="shadow-none with-border">
                                </div>
                                <div>
                                    <label for="confirm_new_password">Confirm new password</label>
                                    <input type="text" placeholder="" id="confirm_new_password" name="confirm_new_password"  class="shadow-none with-border">
                                </div>
                                <div class="flex flex-wrap items-center justify-between py-2 mt-3">
                                    <button class="button" type="submit">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php include("footer.php"); ?>
        </div>

        <!-- sidebar -->
        <?php include("sidebar.php"); ?>
        <script src="validate/settings.js"></script>

    </div>


    <?php include("js.php") ?>
</body>

</html>