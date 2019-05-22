<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\Utility\Utility;
use App\Message\Message;

$auth= new Admin();
$status = $auth->setData($_SESSION)->logged_in();

if(!$status) {
    Utility::redirect('index.php');
    return;
}

?>

<!-- Header Start-->
<?php include_once("head-area.php") ?>
<!-- Header End-->

<div class="text-center">

    <?php  if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>

        <div  id="message" class="msg"   style="font-size: 12px;  " >

            <?php if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
                echo "&nbsp;".Message::message();
            }
            Message::message(NULL);
            ?>
        </div>
    <?php } ?>

</div>


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

       <h3 style=""><i class="entypo-right-circled"></i>Add Teacher</h3>

		<div class="row">

			<div class="col-md-12">

					<div class="panel panel-primary" data-collapsed="0">
			        	<div class="panel-heading">
			            	<div class="panel-title"><i class="entypo-plus-circled"></i>Add Form</div>
			            </div>

						<div class="panel-body">
			                <form action="storeTeacher.php" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Name</label>
			                        
									<div class="col-sm-5">
										<input type="text" class="form-control" name="teacherName" data-validate="required" data-message-required="Value Required" value="" autofocus>
									</div>
								</div>

                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Designation</label>

                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="teacherDesignation" data-validate="required" data-message-required="Value Required" value="" autofocus>
                                    </div>
                                </div>

								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Birthday</label>
			                        
									<div class="col-sm-5">
										<input type="text" class="form-control datepicker" name="teacherDob" value="" data-start-view="2">
									</div> 
								</div>
								
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Gender</label>
			                        
									<div class="col-sm-5">
										<select name="teacherGender" class="form-control">
			                              <option value="">Select</option>
			                              <option value="male">Male</option>
			                              <option value="female">Female</option>
			                          </select>
									</div> 
								</div>
								
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Address</label>
			                        
									<div class="col-sm-5">
										<input type="text" class="form-control" name="teacherAddress" value="">
									</div> 
								</div>
								
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Phone</label>
			                        
									<div class="col-sm-5">
										<input type="text" class="form-control" name="teacherPhone" value="">
									</div> 
								</div>
			                    
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Email</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="teacherEmail"  value="">
									</div>
								</div>
								
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Password</label>
			                        
									<div class="col-sm-5">
										<input type="password" class="form-control" name="teacherPassword" value="">
									</div> 
								</div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">photo</label>

                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                <img src="http://placehold.it/200x200" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="File2Upload" accept="image/*">
                                            </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
			                    
			                    <div class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<button type="submit" class="btn btn-info">add teacher</button>
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
<script>
    $('.msg').fadeIn(6000).delay(3000);
    $('.msg').fadeOut(2000);
</script>
   

</body>
</html>



