<?php
require_once("../../../vendor/autoload.php");
if(!isset($_SESSION)) session_start();

use App\Classes\Classes;
$objClass = new Classes();

$allData = $objClass->index();

?>

<?php require_once("head-area.php") ?>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="main-content">

        <div class="row">

            <div class="center-block text-center">
                <h2>Happy School Management System</h2>
            </div>

            <div class="result-search col-md-4 col-md-offset-4">
                <div class="panel login-box">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h4 class="text-center">Result Search Form</h4>
                        </div>
                    </div>

                    <div class="panel-body p-20">

                        <form action="result.php" method="post">
                            <div class="form-group">
                                <label for="roll_number" style="padding-bottom: 10px;">Enter your Roll Id</label>
                                <input type="text" class="form-control" id="roll_number" placeholder="Enter Your Roll Id" required="required" autocomplete="off" name="roll_number" >
                            </div>
                            <div class="form-group">
                                <label for="select" class="col-sm-2 control-label">Class</label><br><br>
                                <select name="class" class="form-control select2" id="select" required="required" autofocus>
                                    <option value="">Select Class</option>
                                    <?php foreach($allData as $oneData) {?>
                                        <option value="<?php echo htmlentities($oneData->class_id); ?>"><?php echo htmlentities($oneData->class_name); ?>&nbsp; Section-<?php echo htmlentities($oneData->section); ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="form-group mt-20">
                                <div class="">

                                    <button type="submit" class="btn btn-blue btn-icon icon-left pull-right">Search<span class="btn-label btn-label-right"><i class="entypo-search"></i></span></button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <a href="../index.php">Back to Home</a>
                            </div>
                        </form>

                        <hr>

                    </div>

                </div>
                <!-- /.panel -->
                <p class="text-muted text-center"><small>Copyright © <a href="http://azimmahmud.com">Happy Coders</a> 2017</small></p>
            </div>
            <!-- /.col-md-6 col-md-offset-3 -->
        </div>
        <!-- /.row -->

    </div>
</div>

<?php require ("footer_js_link.php")?>

</body>
</html>
