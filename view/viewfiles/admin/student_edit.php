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

use App\Student\Student;
use App\Classes\Classes;

$objClass = new Classes();

$classData = $objClass->index();

$objStudent = new Student();

$objStudent->setData($_GET);

$oneData = $objStudent->view();

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

        <h3 style=""><i class="entypo-right-circled"></i>Add Student</h3>

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title"><i class="entypo-plus-circled"></i>Edit Form</div>
                    </div>

                    <div class="panel-body">
                        <form action="updateStudent.php" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                            <div class="form-group">
                                <input type="hidden" name="student_id" value="<?php echo $oneData->student_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="studentName" data-validate="required" data-message-required="Value Required" value="<?php echo $oneData->name?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Father Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="fatherName" data-validate="required" data-message-required="Value Required" value="<?php echo $oneData->father_name?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Mother Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="motherName" data-validate="required" data-message-required="Value Required" value="<?php echo $oneData->mother_name?>" autofocus>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Class</label>

                                <div class="col-sm-5">
                                    <select name="classId" class="form-control" id="class_id"
                                            >


                                        <option value="<?php echo $oneData->class_id?>"><?php echo $oneData->class_name?>&nbsp; Section-<?php echo $oneData->section; ?></option>
                                        <option value="">Select Class</option>
                                        <?php foreach( $classData as $singleData) {?>
                                            <option value="<?php echo $singleData->class_id; ?>"><?php echo $singleData->class_name; ?>&nbsp; Section-<?php echo $singleData->section; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Roll</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="studentRoll" value="<?php echo $oneData->roll_number?>" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Birthday</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control datepicker" name="studentDob" value="<?php echo $oneData->dob?>" data-start-view="2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Gender</label>

                                <div class="col-sm-5">
                                    <select name="studentGender" class="form-control" id="field-2">
                                        <option value="">Select</option>
                                        <option <?php if($oneData->gender = "male") echo "selected"?> value="male">Male</option>
                                        <option <?php if($oneData->gender = "female") echo "selected"?> value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Address</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="studentAddress" value="<?php echo $oneData->address?>" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="studentPhone" value="<?php echo $oneData->phone?>" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="studentEmail" value="<?php echo $oneData->email?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="studentPassword" value="<?php echo $oneData->password?>" >
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
                                    <button type="submit" class="btn btn-blue">update</button>
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
<script src="../../../resources/assets/js/jquery.validate.min.js"></script>



</body>
</html>