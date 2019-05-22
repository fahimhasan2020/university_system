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


use App\Model\Database;

$db = new Database();

use App\Message\Message;

use App\Classes\Classes;

$objClass = new Classes();

$classData = $objClass->index();

if(isset($_POST['submit'])) {

    $marks = array();
    $class = $_POST['class_id'];
    $studentid = $_POST['studentid'];
    $mark = $_POST['marks'];

    $stmt = $db->dbh->prepare("SELECT subjects.subject_name,subjects.subject_id FROM sub_class_combination join  
                              subjects on  subjects.subject_id=sub_class_combination.subject_id WHERE sub_class_combination.class_id=:cid 
                              order by subjects.subject_name");
    $stmt->execute(array(':cid' => $class));
    $sid1 = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($sid1, $row['subject_id']);
    }

    for ($i = 0; $i < count($mark); $i++) {
        $mar = $mark[$i];
        $sid = $sid1[$i];
        $sql = "INSERT INTO  students_result(student_id,class_id,subject_id,marks) VALUES(:studentid,:class,:sid,:marks)";
        $query = $db->dbh->prepare($sql);
        $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $query->bindParam(':class', $class, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':marks', $mar, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $db->dbh->lastInsertId();

        if ($lastInsertId) {
            Message::setMessage("<div class='alert alert-success'>
    <i class='fa fa-check' style='font-size: 20px'></i>&nbsp;&nbsp;<strong>Success!</strong> Result is added. </div>");
        } else {
            Message::setMessage("<div class='alert alert-danger'>
    <i class='fa fa-times' style='font-size: 20px'></i>&nbsp;&nbsp;<strong>Sorry!</strong> Something went wrong. Please try again. </div>");
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="../../../resources/assets/images/favicon.ico">

    <title>Admin || Happy School Management System</title>

    <link rel="stylesheet" href="../../../resources/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="../../../resources/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="../../../resources/assets/css/font-icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="../../../resources/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../../resources/assets/css/neon-core.css">
    <link rel="stylesheet" href="../../../resources/assets/css/neon-theme.css">
    <link rel="stylesheet" href="../../../resources/assets/css/neon-forms.css">
    <link rel="stylesheet" href="../../../resources/assets/css/custom.css">
    <link rel="stylesheet" href="../../../resources/css/main.css">

    <script src="../../../resources/assets/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="../../../resources/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        body {
            color: #222;
        }
    </style>

    <script>
        function getStudent(val) {
            $.ajax({
                type: "POST",
                url: "get_student_details.php",
                data:'classid='+val,
                success: function(data){
                    $("#studentid").html(data);

                }
            });
            $.ajax({
                type: "POST",
                url: "get_student_details.php",
                data:'classid1='+val,
                success: function(data){
                    $("#subject").html(data);

                }
            });
        }
    </script>
    <script>
        function getresult(val,clid) {

            var clid=$(".clid").val();
            var val=$(".stid").val();;
            var abh=clid+'$'+val;
            //alert(abh);
            $.ajax({
                type: "POST",
                url: "get_student_details.php",
                data:'studclass='+abh,
                success: function(data){
                    $("#mark").html(data);

                }
            });
        }
    </script>

</head>
<body class="page-body  page-left-in">



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

       <h3 style=""><i class="entypo-right-circled"></i>Add Result</h3>

		<div class="row">

			<div class="col-md-12">

					<div class="panel panel-primary" data-collapsed="0">
			        	<div class="panel-heading">
			            	<div class="panel-title"><i class="entypo-plus-circled"></i>Marks Assignment Form</div>
			            </div>

						<div class="panel-body">
                            <form class="form-horizontal" method="post" >

                                <div class="form-group">
                                    <label for="classid" class="col-sm-2 control-label">Class</label>
                                    <div class="col-sm-6">
                                        <select name="class_id" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
                                            <option value="">Select Class</option>

                                            <?php
                                            foreach($classData as $result) { ?>
                                                <option value="<?php echo htmlentities($result->class_id); ?>"><?php echo htmlentities($result->class_name); ?>&nbsp; Section-<?php echo htmlentities($result->section);  ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="studentid" class="col-sm-2 control-label ">Student Name</label>

                                    <div class="col-sm-6">
                                        <select name="studentid" class="form-control stid " id="studentid" required="required" onChange="getresult(this.value);"></select>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <div  id="mark"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="col-sm-2 control-label">Subjects</label>
                                    <div class="col-sm-6">
                                        <div  id="subject"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Declare Result</button>
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
<script>
    $('.msg').fadeIn(6000).delay(3000);
    $('.msg').fadeOut(2000);
</script>
</body>
</html>