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

use App\Student\Student;

$objStudent = new Student();

$allData = $objStudent->index();

?>
<!-- Header Start-->
<?php include_once("head-area.php") ?>
<!-- Header End-->

<div class="text-center">

    <?php  if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>

        <div  id="message" class="msg"   style="font-size: 12px;" >

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
        <h2>Students Detail</h2>

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


        <div class="tab-content col-md-12">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="data-table" style="font-size: 12px">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Dob</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Class Name</th>
                        <th>Roll Id</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $serial = 1; foreach ($allData as $oneData) {?>
                    <tr class="gradeX">
                        <td><?php echo $serial ?></td>
                        <td><?php echo $oneData->name?></td>
                        <td><?php echo $oneData->dob?></td>
                        <td><?php echo $oneData->father_name?></td>
                        <td><?php echo $oneData->mother_name?></td>
                        <td><?php echo $oneData->class_name . "( " .$oneData->section . " )"?></td>
                        <td><?php echo $oneData->roll_number?></td>
                        <td><?php echo "<img src='../Uploads/$oneData->photo' style='width: 50px;height: 50px'> "?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!--  PROFILE LINK -->
                                    <li>
                                        <a href="student_view.php?student_id=<?php echo  $oneData->student_id ?>">
                                            <i class="entypo-user"></i>profile</a>
                                    </li>

                                    <!--  EDITING LINK -->
                                    <li>
                                        <a href="student_edit.php?student_id=<?php echo  $oneData->student_id ?>">
                                            <i class="entypo-pencil"></i>edit</a>
                                    </li>
                                    <li class="divider"></li>

                                    <!--  DELETION LINK -->
                                    <li>
                                        <a onclick='return doConfirm()' href="student_delete.php?student_id=<?php echo $oneData->student_id ?>" ><i class="entypo-trash"></i>delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                        <?php $serial = $serial+1; } ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Dob</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Class Name</th>
                        <th>Roll Id</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>

                </div>

            </div>

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
            minimumResultsForSearch: - 1
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































