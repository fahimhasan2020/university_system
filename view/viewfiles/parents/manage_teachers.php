<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');

use App\User\User;
use App\Message\Message;
use App\Utility\Utility;

$auth= new User();
$status = $auth->setData($_SESSION)->logged_in();

if(!$status) {
    Utility::redirect('index.php');
    return;
}

use App\Teacher\Teacher;
$objTeacher = new Teacher();

$allData = $objTeacher->index();

?>


<?php include_once("head-area.php") ?>

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
        <h2>Teachers Detail</h2>

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

        <table class="table table-bordered datatable" id="data-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Address</th>
                <th>email</th>
                <th>Phone</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $serial = 1; foreach ($allData as $oneData) {
                if (strlen($oneData->address) > 30){
                    $subAddress = substr($oneData->address, 0 , 25) . "....";
                } else {
                    $subAddress =$oneData->address;
                }

                ?>

                <tr>
                    <td><?php echo $serial?></td>
                    <td><?php echo $oneData->name?></td>
                    <td><?php echo $oneData->designation?></td>
                    <td><?php echo $subAddress ?></td>
                    <td><?php echo $oneData->email?></td>
                    <td><?php echo $oneData->phone?></td>
                    <td><?php echo "<img src='../Uploads/$oneData->photo' style='width: 50px;height: 50px'> "?></td>

                    <td><a class="btn btn-blue" href="teacher_view.php?teacher_id=<?php echo  $oneData->teacher_id ?>">
                                        <i class="entypo-user"></i>profile</a></td>


                </tr>

                <?php $serial++;} ?>


            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Address</th>
                <th>email</th>
                <th>Phone</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>



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































