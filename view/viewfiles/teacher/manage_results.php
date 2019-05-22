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

use App\Model\Database;
$db = new Database();

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
                <h2 style="font-weight:200; margin:0px;">Happy School Management System</h2>
            </div>

            <?php include_once("subnav.php");?>

        </div> <!-- Heading Row-->

        <hr style="margin-top:0px;" />

        <hr />

        <h2>Manage Results</h2>

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
            <table class="table table-bordered datatable" id="data-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Roll Id</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $sql = "SELECT  distinct students.name,students.roll_number,students.email,students.student_id,classes.class_name,classes.section from students_result join students on students.student_id = students_result.student_id  join classes on classes.class_id = students_result.class_id";
                    $query = $db->dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                    {   ?>

                        <tr>
                            <td>
                                <?php echo $cnt;?>
                            </td>
                            <td>
                                <?php echo $result->name;?>
                            </td>
                            <td>
                                <?php echo $result->roll_number;?>
                            </td>
                            <td>
                                <?php echo $result->class_name;?>(
                                <?php echo $result->section;?>)
                            </td>
                            <td>
                                <?php echo htmlentities($result->email);?>
                            </td>

                            <td>
                                <a class="btn btn-primary" href="edit_student_result.php?student_id=<?php echo $result->student_id;?>"><i class="entypo-pencil">edit marks</i></a>

                            </td>
                        </tr>
                        <?php $cnt=$cnt+1;}} ?>


                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Roll Id</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- End of Row -->
        <br />
        <!-- Footer -->
        <footer class="main">

            &copy; 2017 <strong>Happy Coders</strong> School Management System by <a href="http://azimmahmud.com" target="_blank">Azim Mahmud</a></footer>
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





