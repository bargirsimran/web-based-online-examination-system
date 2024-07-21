<div class="sidebar">
    <div class="sidebar_inner" data-simplebar>

        <ul class="side-colored">

            <li class="<?php if (basename($_SERVER['PHP_SELF']) == "index.php") {
                            echo "active";
                        } ?>"><a href="index.php">
                    <ion-icon name="home" class="side-icon"> </ion-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
            $sql = "SELECT subject_id, subject_name FROM subjects WHERE dept_id = '$dept_id' && year_id = '$year_id' && sem_id='$sem_id'";
            $sql_run = $db->query($sql);
            while ($rows = $sql_run->fetch_assoc()) {
            ?>
                <li class="<?php if (isset($_GET['subject']) && $_GET['subject'] == $rows['subject_id']) {
                                echo "active";
                            } ?>"><a href="subject.php?subject=<?php echo $rows['subject_id']; ?>">
                        <ion-icon name="book" class="side-icon"> </ion-icon>
                        <span> <?php echo $rows['subject_name']; ?> </span>
                    </a>
                </li>
            <?php } ?>


            <li class="<?php if (basename($_SERVER['PHP_SELF']) == "result.php") {
                            echo "active";
                        } ?>"><a href="result.php">
                    <ion-icon name="podium" class="side-icon"> </ion-icon>
                    <span> Results </span>
                </a>
            </li>

            <li class="<?php if (basename($_SERVER['PHP_SELF']) == "profile.php") {
                            echo "active";
                        } ?>"><a href="profile.php">
                    <ion-icon name="person" class="side-icon"> </ion-icon>
                    <span> Profile </span>
                </a>
            </li>
            <li class="<?php if (basename($_SERVER['PHP_SELF']) == "settings.php") {
                            echo "active";
                        } ?>"><a href="settings.php">
                    <ion-icon name="lock-closed" class="side-icon"> </ion-icon>
                    <span> Change Password</span>
                </a>
            </li>

            <li class="<?php if (basename($_SERVER['PHP_SELF']) == "logout.php") {
                            echo "active";
                        } ?>"><a href="logout.php">
                    <ion-icon name="log-out" class="side-icon"> </ion-icon>
                    <span> Log-out </span>
                </a>
            </li>



        </ul>

    </div>

    <div class="side_overly" uk-toggle="target: #wrapper ; cls: is-collapse is-active"></div>
</div>