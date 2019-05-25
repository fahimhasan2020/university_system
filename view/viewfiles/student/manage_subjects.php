<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');
use App\Student\Auth;
use App\Model\Database;
use App\Utility\Utility;
use App\Message\Message;
$db = new Database();

$auth= new Auth();
$status = $auth->setData($_SESSION)->logged_in();

if(!$status) {
    Utility::redirect('index.php');
    return;
}

use App\Subject\Subject;
$objTeacher = new Subject();
$allData = $objTeacher->index();
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
					<h2 style="font-weight:200; margin:0px;">Student Management System</h2>
			    </div>
				<!-- Raw Links -->
                <?php include_once("subnav.php");?>
	
		</div> <!-- Heading Row-->
				
		<hr style="margin-top:0px;" />

	<hr />
		<h2>Subjects Detail</h2>
		
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
			


	    	<div class="tab-content col-md-12">
	            <!--TABLE LISTING STARTS-->
		            <div class="tab-pane box active" id="list">

                        <table class="table table-bordered datatable" id="data-table">
                            <thead>
                            <tr>
                                <th>#e</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $serial = 1; foreach ($allData as $oneData) {?>
                                <tr class="gradeX">
                                    <td><?php echo $serial ?></td>
                                    <td><?php echo $oneData->subject_name?></td>
                                    <td><?php echo $oneData->subject_code?></td>

                                </tr>
                                <?php $serial++;} ?>


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#e</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>

                            </tr>
                            </tfoot>
                        </table>

				
					</div>

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
    </script>

   

</body>
</html>

