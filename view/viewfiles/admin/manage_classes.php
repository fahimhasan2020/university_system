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

use App\Classes\Classes;
$objClasses = new Classes();
$allData = $objClasses->index();
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

	<hr />
		<h2>Class Detail</h2>
		
		<br />
		
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				var $table1 = jQuery( '#data-table' );

				// Initialize DataTable
				$table1.DataTable( {
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true
				});

				// Initalize Select Dropdown after DataTables is created
				$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
					minimumResultsForSearch: -1
				});
			} );
		</script>



		<div class="row">
			
			<!--CONTROL TABS START-->
			<ul class="nav nav-tabs bordered">
				<li class="active">
	            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
						class list                    	</a></li>
				<li>
	            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
						add class                    	</a></li>
			</ul>
	    	<!--CONTROL TABS END-->

	    	<div class="tab-content">
	            <!--TABLE LISTING STARTS-->
		            <div class="tab-pane box active" id="list">
						
						<table class="table table-bordered datatable" id="data-table">
							<thead>
								<tr>
									<th>#e</th>
									<th>Class Name</th>
									<th>Class Numeric</th>
									<th>Section</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php $serial = 1; foreach ($allData as $oneData) {?>
                                <tr class="gradeX">
                                    <td><?php echo $serial ?></td>
                                    <td><?php echo $oneData->class_name?></td>
                                    <td><?php echo $oneData->class_numeric?></td>
                                    <td><?php echo $oneData->section?></td>
                                    <td>

                                        <a class="btn btn-danger btn-icon" onclick="return doConfirm();"   href="class_delete.php?class_id=<?php echo $oneData->class_id ?>">Delete<i class="entypo-cancel"></i></a>


                                    </td>
                                </tr>
                                <?php $serial++; }?>

							</tbody>
							<tfoot>
								<tr>
                                    <th>#e</th>
                                    <th>Class Name</th>
                                    <th>Class Numeric</th>
                                    <th>Section</th>
                                    <th>Action</th>
								</tr>
							</tfoot>
						</table>

				
					</div>



						<!--CREATION FORM STARTS-->
					<div class="tab-pane box" id="add" style="padding: 5px">
		                <div class="box-content">
		                	<form action="storeClass.php" class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8">
		                        <div class="padded">
		                            <div class="form-group">
		                                <label class="col-sm-3 control-label">name</label>
		                                <div class="col-sm-5">
		                                    <input type="text" class="form-control" name="className" data-validate="required" data-message-required="Value Required"/>
		                                </div>
		                            </div>
		                            <div class="form-group">
		                                <label class="col-sm-3 control-label">name numeric</label>
		                                <div class="col-sm-5">
		                                    <input type="text" class="form-control" name="classNumeric"/>
		                                </div>
		                            </div>
		                             <div class="form-group">
		                                <label class="col-sm-3 control-label">Section</label>
		                                <div class="col-sm-5">
		                                    <input type="text" class="form-control" name="section"/>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                              <div class="col-sm-offset-3 col-sm-5">
		                                  <button type="submit" class="btn btn-info">add class</button>
		                              </div>
									</div>
		                    </form>                
		                </div>                
					</div>
					<!--CREATION FORM ENDS-->
				</div>	

			</div>
			<!-- End of Row -->
		
	
		<br />




		<!-- Footer -->
		<footer class="main">

			&copy; 2017 <strong>Happy Coders</strong> School Management System by <a href="http://azimmahmud.com" target="_blank">Azim Mahmud</a>

		</footer>
	
	</div>


</div>



<?php require_once("footer_js_link.php") ?>

<!-- DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var datatable = $("#data-table").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
    $('.msg').fadeIn(6000).delay(3000);
    $('.msg').fadeOut(2000);

    function doConfirm() {

        var result = confirm("Are you sure you want to delete?");

        return result;


    }
</script>

   

</body>
</html>

