<<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');
use App\Message\Message;

use App\Model\Database;

$db = new Database();

$stid=intval($_GET['student_id']);

if(isset($_POST['submit']))
{

    $rowid=$_POST['id'];
    $marks=$_POST['marks'];


    foreach($_POST['id'] as $count => $id){
        $mrks=$marks[$count];
        $iid=$rowid[$count];
        for($i=0;$i<=$count;$i++) {

            $sql="update students_result  set marks=:mrks where result_id=:iid ";
            $query = $db->dbh->prepare($sql);
            $query->bindParam(':mrks',$mrks,PDO::PARAM_STR);
            $query->bindParam(':iid',$iid,PDO::PARAM_STR);
            $status = $query->execute();

            if ($status) {
                Message::setMessage("<div class='alert alert-success'>
                 <i class='fa fa-check' style='font-size: 20px'></i>&nbsp;&nbsp;<strong>Success!</strong> Result is update. </div>");
            }

        }
    }
}
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

            <?php include_once("subnav.php");?>
	
		</div> <!-- Heading Row-->
				
	<hr style="margin-top:0px;" />

       <h3 style=""><i class="entypo-right-circled"></i>Add Result</h3>

		<div class="row">

			<div class="col-md-12">

					<div class="panel panel-primary" data-collapsed="0">
			        	<div class="panel-heading">
			            	<div class="panel-title"><i class="entypo-plus-circled"></i>Marks Edit Form</div>
			            </div>

						<div class="panel-body">
                            <form class="form-horizontal" method="post" >
                                <?php

                                $ret = "SELECT students.name,classes.class_name,classes.section from students_result join students on students_result.student_id=students_result.student_id join subjects on subjects.subject_id=students_result.subject_id join classes on classes.class_id=students.class_id where students.student_id=:stid limit 1";
                                $stmt = $db->dbh->prepare($ret);
                                $stmt->bindParam(':stid',$stid,PDO::PARAM_STR);
                                $stmt->execute();
                                $result=$stmt->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($stmt->rowCount() > 0)
                                {
                                foreach($result as $oneData){
                                ?>

                                <div class="form-group">
                                    <label for="classid" class="col-sm-2 control-label">Class</label>
                                    <div class="col-sm-6">
                                        <h5><?php echo $oneData->class_name?><?php echo " ".( $oneData->section )?></h5>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="classid" class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-6">
                                        <h5><?php echo $oneData->name?></h5>
                                    </div>
                                </div>
                                    
                                <?php } }?>

                                <?php
                                $sql = "SELECT distinct students.name,students.student_id,classes.class_name,classes.section,subjects.subject_name,students_result.marks,students_result.result_id as resultid from students_result join students on students.student_id=students_result.student_id join subjects on subjects.subject_id=students_result.subject_id join classes on classes.class_id=students.class_id where students.student_id=:stid ";
                                $query = $db->dbh->prepare($sql);
                                $query->bindParam(':stid',$stid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {  ?>



                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label"><?php echo htmlentities($result->subject_name)?></label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="id[]" value="<?php echo htmlentities($result->resultid)?>">
                                        <input type="text" name="marks[]" class="form-control" id="marks" value="<?php echo htmlentities($result->marks)?>" maxlength="5" required="required" autocomplete="off">
                                    </div>
                                </div>

                                <?php }} ?>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Update Result</button>
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