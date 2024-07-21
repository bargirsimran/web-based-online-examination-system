<div class="sidebar">
    <div class="sidebar_inner" data-simplebar>

        <ul class="side-colored">
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "index.php"){echo "active";}?>"><a href="index.php">
                    <ion-icon name="newspaper" class="side-icon"> </ion-icon>
                    <span> Departments </span>

                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "class.php"){echo "active";}?>"><a href="class.php">
                    <ion-icon name="grid" class="side-icon"> </ion-icon>
                    <span> Class And Divisions </span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "subjects.php"){echo "active";}?>"><a href="subjects.php">
                    <ion-icon name="albums" class="side-icon"> </ion-icon>
                    <span> Subjects </span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "students.php"){echo "active";}?>"><a href="students.php">
                    <ion-icon name="people-circle-outline" class="side-icon"> </ion-icon>
                    <span>New Students </span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "studentlist.php"){echo "active";}?>"><a href="studentlist.php">
                    <ion-icon name="people-circle-outline" class="side-icon"> </ion-icon>
                    <span> Students List</span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "groups.php"){echo "active";}?>"><a href="groups.php">
                    <ion-icon name="people-circle-outline" class="side-icon"> </ion-icon>
                    <span>Groups</span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "addtest.php"){echo "active";}?>"><a href="addtest.php">
                    <ion-icon name="laptop" class="side-icon"> </ion-icon>
                    <span> New Test </span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "testlist.php"){echo "active";}?>"><a href="testlist.php">
                    <ion-icon name="newspaper" class="side-icon"> </ion-icon>
                    <span> All Tests</span>
                </a>
            </li>
            
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "admins.php"){echo "active";}?>"><a href="admins.php">
                    <ion-icon name="person" class="side-icon"> </ion-icon>
                    <span> New Admin </span>
                </a>
            </li>

            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "result.php"){echo "active";}?>"><a href="result.php">
                    <ion-icon name="podium" class="side-icon"> </ion-icon>
                    <span> Results </span>
                </a>
            </li>
            <li class="<?php if(basename($_SERVER['PHP_SELF']) == "result-student.php"){echo "active";}?>"><a href="result-student.php">
                    <ion-icon name="podium" class="side-icon"> </ion-icon>
                    <span>Student Result</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="side_overly" uk-toggle="target: #wrapper ; cls: is-collapse is-active"></div>
</div>