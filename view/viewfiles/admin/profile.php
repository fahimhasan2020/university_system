<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\Utility\Utility;
use App\Model\Database;
use App\Message\Message;
$db = new Database();

$auth= new Admin();
$status = $auth->setData($_SESSION)->logged_in();

if(!$status) {
    Utility::redirect('index.php');
    return;
}

$allData = $auth->view();
$email = $_SESSION['email'];
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
                <h2 style="font-weight:200; margin:0px;">Student Management System</h2>
            </div>
            <!-- Raw Links -->
            <?php include_once("subnav.php");?>

        </div> <!-- Heading Row-->

        <hr style="margin-top:0px;" />
        <h3 style="">
            <i class="entypo-right-circled"></i>
            manage profile           </h3>

        <div class="row">
            <div class="col-md-12">

                <!------CONTROL TABS START------>
                <ul class="nav nav-tabs bordered">

                    <li class="active">
                        <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                            manage profile                    	</a></li>
                </ul>
                <!------CONTROL TABS END------>


                <div class="tab-content">
                    <!----EDITING FORM STARTS---->
                    <div class="tab-pane box active" id="list" style="padding: 5px">
                        <div class="box-content">
                            <form action="updateProfile.php" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="name" value="<?php echo $allData->name;?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">email</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="email" value="<?php echo $allData->email;?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">photo</label>

                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                <img src="../Uploads/<?php echo $allData->photo;?>" alt="...">
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
                                        <button type="submit" class="btn btn-info">update profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!----EDITING FORM ENDS-->

                </div>
            </div>
        </div>


        <!--password-->
        <div class="row">
            <div class="col-md-12">

                <!------CONTROL TABS START------->
                <ul class="nav nav-tabs bordered">

                    <li class="active">
                        <a href="#list" data-toggle="tab"><i class="entypo-lock"></i>
                            change password                    	</a></li>
                </ul>
                <!------CONTROL TABS END------->


                <div class="tab-content">
                    <!----EDITING FORM STARTS---->
                    <div class="tab-pane box active" id="list" style="padding: 5px">
                        <div class="box-content padded">
                            <form action="changePassword.php" class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8">
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" name="email" value="<?php echo $email;?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">new password</label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" name="new_password" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">confirm new password</label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" class="btn btn-info">update profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!----EDITING FORM ENDS--->

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main">

            &copy; 2017 <strong>Happy Coders</strong> School Management System by <a href="http://azimmahmud.com" target="_blank">Azim Mahmud</a>

        </footer>

    </div>


</div>


<?php include_once("footer_js_link.php");?>

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