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
                <div class="grid lg:grid-cols-3 gap-3 mb-0 mt-5">
                    <?php
                    $sql = "SELECT subject_id, subject_name FROM subjects WHERE dept_id = '$dept_id' && year_id = '$year_id' && sem_id='$sem_id'";
                    $sql_run = $db->query($sql);
                    while ($rows = $sql_run->fetch_assoc()) {
                    ?>
                        <a href="subject.php?subject=<?php echo $rows['subject_id']; ?>" class="mb-0">
                            <div class="bg-gray-200 rounded-md overflow-hidden relative w-full lg:h-44 h-36 shadow-sm uk-transition-toggle">
                                <img src="assets/images/graybg.jpg" class="absolute w-full h-full object-cover" alt="">
                                <div class="absolute -bottom-1.5 w-full p-3 text-white z-20 line-clamp-2 text-opacity-95 font-medium text-base"><?php echo $rows['subject_name']; ?></div>
                                <p class="uk-position-center text-white font-bold -mt-4 z-10 text-xl text-center p-2"><?php echo $rows['subject_name']; ?></p>
                                <div class="absolute w-full h-full -bottom-1/2 bg-gradient-to-b from-transparent to-gray-800 z-10"></div>
                            </div>
                        </a>
                    <?php } ?>
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