<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');

use App\User\User;
use App\Utility\Utility;


$auth= new User();
$status = $auth->setData($_SESSION)->logged_in();

if(!$status) {
    Utility::redirect('index.php');
    return;
}

use App\Teacher\Teacher;
$objTeacher = new Teacher();
$objTeacher->setData($_GET);
$oneData = $objTeacher->view();

?>



    <!-- Header Start-->
<?php include_once("head-area.php") ?>
    <!-- Header End-->


    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        <!-- Navigation Start-->
        <?php include_once("navigation.php") ?>
        <!-- Navigation End-->

        <div class="main-content">

            <div class="row">
                <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
                    <h2 style="font-weight:200; margin:0px;">Happy School Management System</h2>
                </div>
                <!-- Raw Links -->
                <?php include_once("subnav.php");?>

            </div> <!-- Heading Row-->

            <hr style="margin-top:0px;" />

            <h3 style=""><i class="entypo-right-circled"></i>Teacher Info</h3>

            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <img class="img-responsive img-circle user_img"  src="../Uploads/<?php echo $oneData->photo?>" alt="<?php echo $oneData->name?> Photo" width="150px" height="150px">
                    <table class="table table-bordered centered" style="word-wrap: break-word; table-layout: fixed">
                        <thead>

                        <tr>
                            <th class="col-md-4"><strong>Title</strong></th>
                            <th class="col-md-8"><strong>Information</strong></th>
                        </tr>
                        </thead>

                        <tbody >
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $oneData->name?></td>
                        </tr>

                        <tr>
                            <td>Designation:</td>
                            <td><?php echo $oneData->designation?></td>
                        </tr>

                        <tr>
                            <td>Gender:</td>
                            <td><?php echo $oneData->gender?></td>
                        </tr>

                        <tr>
                            <td>Date of Birth:</td>
                            <td><?php echo $oneData->dob?></td>
                        </tr>

                        <tr>
                            <td>Address:</td>
                            <td><?php echo $oneData->address?></td>
                        </tr>

                        <tr>
                            <td>Email:</td>
                            <td><?php echo $oneData->email?></td>
                        </tr>

                        <tr>
                            <td>Password:</td>
                            <td><?php echo $oneData->password?></td>
                        </tr>

                        <tr>
                            <td>Phone Number:</td>
                            <td><?php echo $oneData->phone?></td>
                        </tr>
                        </tbody>

                    </table>
                    <a class="btn btn-blue col-md-offset-5" href="manage_teachers.php">Close</a>
                </div>
            </div>
            <!-- Footer -->
            <footer class="main">

                &copy; 2017 <strong>Happy Coders</strong> School Management System by <a href="http://azimmahmud.com" target="_blank">Azim Mahmud</a>

            </footer>

        </div>


    </div>





<?php require_once("footer_js_link.php") ?>


    </body>
    </html>
