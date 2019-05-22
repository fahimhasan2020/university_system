<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');
use App\User\User;
use App\Model\Database;
use App\Utility\Utility;
use App\Message\Message;
$db = new Database();

$auth= new User();
$status = $auth->setData($_SESSION)->logged_in();

if(!$status) {
    Utility::redirect('index.php');
    return;
}
?>

<?php include_once("head-area.php");?>

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

    <?php include_once("navigation.php");?>

    <div class="main-content">

        <div class="row">
            <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
                <h2 style="font-weight:200; margin:0px;">Happy School Management System</h2>
            </div>

            <?php include_once("subnav.php");?>

        </div> <!-- Heading Row-->

        <hr style="margin-top:0px;" />
        <h3 style="">
            <i class="entypo-right-circled"></i>
            Teacher dashboard           </h3>

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <!-- CALENDAR-->
                    <div class="col-md-12 col-xs-12">
                        <div class="panel panel-primary " data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <i class="fa fa-calendar"></i>
                                    Event Schedule                        </div>
                            </div>
                            <div class="panel-body" style="padding:0px;">
                                <div class="calendar-env">
                                    <div class="calendar-body">
                                        <div id="notice_calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.section -->
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">

                        <div class="tile-stats tile-red">
                            <?php
                            $sql1 ="SELECT student_id from students ";
                            $query1 = $db->dbh -> prepare($sql1);
                            $query1->execute();
                            $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                            $totalstudents=$query1->rowCount();
                            ?>
                            <div class="num" data-start="0" data-end="<?php echo $totalstudents;?>"
                                 data-postfix="" data-duration="800" data-delay="0"></div>
                            <div class="icon"><i class="fa fa-group"></i></div>
                            <h3>student</h3>
                            <p>Total students</p>
                        </div>

                    </div>
                    <div class="col-md-12">

                        <div class="tile-stats tile-green">
                            <?php
                            $sql ="SELECT teacher_id from  teacher ";
                            $query = $db->dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $totalsubjects=$query->rowCount();
                            ?>
                            <div class="num" data-start="0" data-end="<?php echo $totalsubjects;?>"
                                 data-postfix="" data-duration="800" data-delay="0"></div>
                            <div class="icon"><i class="entypo-users"></i></div>
                            <h3>teacher</h3>
                            <p>Total teachers</p>
                        </div>

                    </div>
                    <div class="col-md-12">


                        <div class="tile-stats tile-aqua">
                            <?php
                            $sql2 ="SELECT class_id from  classes ";
                            $query2 = $db->dbh -> prepare($sql2);
                            $query2->execute();
                            $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                            $totalclasses=$query2->rowCount();
                            ?>
                            <div class="num" data-start="0" data-end="<?php echo $totalclasses;?>"
                                 data-postfix="" data-duration="800" data-delay="0"></div>
                            <div class="icon"><i class="entypo-user"></i></div>
                            <h3>class</h3>
                            <p>Total class listed</p>
                        </div>

                    </div>
                    <div class="col-md-12">

                        <div class="tile-stats tile-blue">
                            <?php
                            $sql3="SELECT  distinct student_id from  students_result ";
                            $query3 = $db->dbh -> prepare($sql3);
                            $query3->execute();
                            $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                            $totalresults=$query3->rowCount();
                            ?>
                            <div class="num" data-start="0" data-end="<?php echo $totalresults;?>"
                                 data-postfix="" data-duration="800" data-delay="0"></div>
                            <div class="icon"><i class="entypo-chart-bar"></i></div>

                            <h3>result sheet</h3>
                            <p>Total result sheet of student</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main">

            &copy; 2017 <strong>Happy Coders</strong> School Management System by <a href="http://azimmahmud.com" target="_blank">Azim Mahmud</a>

        </footer>

    </div>


</div>



<!-- Imported styles on this page -->
<link rel="stylesheet" href="../../../resources/assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="../../../resources/assets/js/rickshaw/rickshaw.min.css">
<link rel="stylesheet" href="../../../resources/assets/js/toastr.min.css">

<!-- Bottom scripts (common) -->
<script src="../../../resources/assets/js/gsap/TweenMax.min.js"></script>
<script src="../../../resources/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="../../../resources/assets/js/bootstrap.js"></script>
<script src="../../../resources/assets/js/joinable.js"></script>
<script src="../../../resources/assets/js/resizeable.js"></script>
<script src="../../../resources/assets/js/neon-api.js"></script>
<script src="../../../resources/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../../resources/assets/js/toastr.js"></script>

<!-- Imported scripts on this page -->
<script src="../../../resources/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="../../../resources/assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../../../resources/assets/js/jquery.sparkline.min.js"></script>
<script src="../../../resources/assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="../../../resources/assets/js/rickshaw/rickshaw.min.js"></script>


<!-- Imported scripts on this page -->
<script src="../../../resources/assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="../../../resources/assets/js/neon-calendar.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="../../../resources/assets/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="../../../resources/assets/js/neon-demo.js"></script>

<script>
    $(document).ready(function() {

        var calendar = $('#notice_calendar');

        $('#notice_calendar').fullCalendar({
            header: {
                left: 'title',
                right: 'today prev,next'
            },

            //defaultView: 'basicWeek',

            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,

            events: [

            ]
        });
    });
    $('.msg').fadeIn(6000).delay(3000);
    $('.msg').fadeOut(2000);

</script>




</body>
</html>