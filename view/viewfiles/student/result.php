<?php
require_once("../../../vendor/autoload.php");

if(!isset($_SESSION)) session_start();

use App\Model\Database;

$db = new Database();

?>

<?php require_once("head-area.php");?>

<div class="content-container">

                    <!-- /.left-sidebar -->
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-12" >
                                    <h2 class="title" align="center" style="color: #fff; padding: 20px 0 10px 0">Happy School Management System</h2>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">



                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
<?php

// code Student Data
$rollid=$_POST['roll_number'];
$classid=$_POST['class'];
$_SESSION['roll_number']=$rollid;
$_SESSION['classid']=$classid;
$qery = "SELECT   students.name,students.roll_number,students.email, students.father_name,students.dob, students.mother_name,students.student_id,classes.class_id,classes.class_name,classes.section from students join classes on classes.class_id = students.class_id where students.roll_number=:roll_number and students.class_id=:classid ";
$stmt = $db->dbh->prepare($qery);
$stmt->bindParam(':roll_number',$rollid,PDO::PARAM_STR);
$stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
$stmt->execute();
$studentDetails=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($studentDetails as $row)
{   ?>
<p><b>Student Name :</b> <?php echo $row->name;?></p>
<p><b>Father Name :</b> <?php echo $row->father_name;?></p>
<p><b>Mother Name :</b> <?php echo $row->mother_name;?></p>
<p><b>Date of Birth:</b> <?php echo $row->dob;?>
<p><b>Student Roll Id :</b> <?php echo $row->roll_number;?>
<p><b>Student Class:</b> <?php echo $row->class_name;?> Section - (<?php echo $row->section;?>)
    <?php } ?>
    </div>
<div class="panel-body p-20">







    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Marks</th>
            <th>Grade</th>
        </tr>
        </thead>




        <tbody>
        <?php
        // Code for result

        $query ="select t.name,t.roll_number,t.class_id,t.marks,subjects.subject_name from (select sts.name,sts.roll_number,sts.class_id,tr.marks,subject_id from students as sts join  students_result as tr on tr.student_id = sts.student_id) as t join subjects on subjects.subject_id=t.subject_id where (t.roll_number=:roll_number and t.class_id=:classid)";
        $query= $db->dbh -> prepare($query);
        $query->bindParam(':roll_number',$rollid,PDO::PARAM_STR);
        $query->bindParam(':classid',$classid,PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($countrow = $query->rowCount()>0)
        {
            foreach($results as $result){

                ?>

                <tr>
                    <th scope="row"><?php echo htmlentities($cnt);?></th>
                    <td><?php echo htmlentities($result->subject_name);?></td>
                    <td><?php echo htmlentities($result->marks);?></td>
                    <td><?php
                    
                        $studeent_marks = $result->marks;
                    
                        switch($studeent_marks){
                            case ($studeent_marks>79) :
                                $remarks = "A+";
                                break;

                            case ($studeent_marks>74) :
                                $remarks = "A";
                                break;

                            case ($studeent_marks>69) :
                                $remarks = "A-";
                                break;

                            case ($studeent_marks>64) :
                                $remarks = "B+";
                                break;
                            case ($studeent_marks>59) :
                                $remarks = "B";
                                break;

                            case ($studeent_marks>49) :
                                $remarks = "C";
                                break;

                            case ($studeent_marks >= 40) :
                                $remarks = "D";
                                break;

                            default:
                                $remarks = "F";
                        }

                        echo $remarks;

                        if ($remarks == "F" ) {
                            $comment = "Fail";
                        }else {
                            $comment = "Pass";
                        }

                    ?></td>



                </tr>
                <?php
                $cnt++;}
            ?>
            <tr>
                <th scope="row" colspan="3">Comment</th>
                <td><b><?php global $comment; echo $comment; ?></b></td>
            </tr>
            <tr>
                <?php  foreach ($studentDetails as $result){?>
                <th scope="row" colspan="3">Download Result</th>
                <td><b><a href="download_result.php?roll_number=<?php echo $result->roll_number?>&class_id=<?php echo $result->class_id?>">Download </a> </b></td>
                <?php }?>
            </tr>

        <?php } else { ?>
        <div class="alert alert-warning left-icon-alert" role="alert">
            <strong>Notice!</strong> Your result not declare yet
            <?php }
            ?>
        </div>
        <?php
        } else
        {?>

        <div class="alert alert-danger left-icon-alert" role="alert">
            <strong>Oh snap!</strong>
            <?php
            echo htmlentities("Invalid Roll Id");
            }
            ?>
        </div>



        </tbody>
    </table>

</div>
</div>
<!-- /.panel -->
</div>
<!-- /.col-md-6 -->

<div class="form-group">

    <div class="col-sm-6" style="margin: 20px 0 50px 0;">
        <a href="search_result.php" style="color: #fff; ">Back to Home</a>
    </div>
</div>

</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->
</section>
<!-- /.section -->

</div>
<!-- /.main-page -->


</div>

<?php require_once ("footer_js_link.php") ?>

</body>
</html>
