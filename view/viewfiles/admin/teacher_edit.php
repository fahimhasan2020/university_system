<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\Utility\Utility;

$auth= new Admin();
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
                <h2 style="font-weight:200; margin:0px;">Student Management System</h2>
            </div>
            <!-- Raw Links -->
            <?php include_once("subnav.php");?>

        </div> <!-- Heading Row-->

        <hr style="margin-top:0px;" />

        <h3 style=""><i class="entypo-right-circled"></i>Add Teacher</h3>

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title"><i class="entypo-plus-circled"></i>Add Form</div>
                    </div>

                    <div class="panel-body">
                        <form action="updateTeacher.php" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                            <div class="form-group">
                                <input type="hidden" name="teacher_id" value="<?php echo $oneData->teacher_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="teacherName" value="<?php echo $oneData->name?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Designation</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="teacherDesignation"  value="<?php echo $oneData->designation?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Birthday</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control datepicker" name="teacherDob" value="<?php echo $oneData->dob?>" data-start-view="2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Gender</label>

                                <div class="col-sm-5">
                                    <select name="teacherGender" class="form-control">
                                        <option disabled> -- Select Your Gender -- </option>
                                        <option <?php if ($oneData->gender == 'Male' ) echo 'selected' ; ?> value="Male">Male</option>
                                        <option <?php if ($oneData->gender == 'Female' ) echo 'selected' ; ?> value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Address</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="teacherAddress" value="<?php echo $oneData->address?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="teacherPhone" value="<?php echo $oneData->phone?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="teacherEmail" value="<?php echo $oneData->email?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="teacherPassword" value="<?php echo $oneData->password?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Photo</label>

                                <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                        <img src="../Uploads/<?php echo $oneData->photo?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 6px;"></div>
                                    <div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input name="File2Upload" accept="image/*" type="file">
									</span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-info">update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>		<!-- End of Row -->

        <!-- Footer -->
        <footer class="main">

            &copy; 2017 <strong>Happy Coders</strong> School Management System by <a href="http://azimmahmud.com" target="_blank">Azim Mahmud</a>

        </footer>

    </div>


</div>


<?php require_once("footer_js_link.php") ?>
<script src="../../../resources/assets/js/bootstrap-datepicker.js"></script>



</body>
</html>