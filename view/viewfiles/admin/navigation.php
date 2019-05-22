<div class="sidebar-menu">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="deshboard.php">
                    <i class="fa fa-university " style="font-size: 60px; "></i>
                    <h4 style="color: #fff" >Happy School</h4>
                </a>

            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>




        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li class="opened active">
                <a href="deshboard.php">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="">
                    <i class="fa fa-group"></i>
                    <span class="title">Students</span>
                </a>
                <ul>
                    <li>
                        <a href="student_add.php">
                            <span class="title"><i class="entypo-dot"></i> Admit Student</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_students.php">
                            <span class="title"><i class="entypo-dot"></i>Student List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-sub ">
                <a href="">
                    <i class="entypo-users"></i>
                    <span class="title">Teachers</span>
                </a>
                <ul>
                    <li>
                        <a href="teacher_add.php">
                            <span class="title"><i class="entypo-dot"></i> Add Teacher</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_teachers.php">
                            <span class="title"><i class="entypo-dot"></i>Teacher List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="has-sub ">
                <a href="">
                    <i class="entypo-flow-tree"></i>
                    <span class="title">Class</span>
                </a>
                <ul>
                    <li>
                        <a href="manage_classes.php">
                            <span class="title"><i class="entypo-dot"></i>Add Class</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="has-sub ">
                <a href="">
                    <i class="entypo-docs"></i>
                    <span class="title">Subject</span>
                </a>
                <ul>
                    <li>
                        <a href="manage_subjects.php">
                            <span class="title"><i class="entypo-dot"></i>Add Subject</span>
                        </a>
                    </li>
                    <li>
                        <a href="subject_assignment.php">
                            <span class="title"><i class="entypo-dot"></i>Class and Subject Combination</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="has-sub ">
                <a href="">
                    <i class="entypo-graduation-cap"></i>
                    <span class="title">Results</span>
                </a>
                <ul>
                    <li>
                        <a href="students_result_add.php">
                            <span class="title"><i class="entypo-dot"></i>Add Result</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_results.php">
                            <span class="title"><i class="entypo-dot"></i>Manage Results</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="root-level ">
                <a href="profile.php">
                    <span class="title"><i class="entypo-lock"></i>Account</span>
                </a>
            </li>

        </ul>

    </div>

</div>
