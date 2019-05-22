<?php
require_once '../../../vendor/dompdf/dompdf/lib/html5lib/Parser.php';
require_once '../../../vendor/dompdf/dompdf/src/Autoloader.php';
use Dompdf\Dompdf;
ob_start();

include_once ('../../../vendor/autoload.php');
use App\Model\Database;
$db = new Database();



?>

<!DOCTYPE html>
<html lang="en">

<?php

$rollid = $_GET['roll_number'] ;
$classid = $_GET['class_id'];
$qery = "SELECT  students.name,students.roll_number,students.student_id,students.father_name,students.mother_name,students.dob,classes.class_name,classes.section from students join classes on classes.class_id=students.class_id where students.roll_number='{$rollid}' and students.class_id='{$classid}'";
$query= $db->dbh -> prepare($qery);
$query->bindParam(':roll_number',$rollid,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($countrow = $query->rowCount()>0)
{
    $trs="";
foreach ($results as $result){
    $name =  $result->name;
    $father =$result->father_name;
    $mother =$result->mother_name;
    $roll_number = $result->roll_number;
    $section =$result->section;
    $dob =$result->dob;
    $class =$result->class_name;


    $trs .= "<p style='font-size: 16px;font-weight: 400'> Name: $name</p>";
    $trs .= "<p style='font-size: 16px;font-weight: 400'> Father Name: $father</p>";
    $trs .= "<p style='font-size: 16px;font-weight: 400'> Mother Name: $mother</p>";
    $trs .= "<p style='font-size: 16px;font-weight: 400'> Date of Birth: $dob </p>";
    $trs .= "<p style='font-size: 16px;font-weight: 400'> Class: $class </p>";
    $trs .= "<p style='font-size: 16px;font-weight: 400'> Roll Number: $roll_number </p>";
    $trs .= "<p style='font-size: 16px;font-weight: 400'> Section: $section </p><br>";


}}
?>

<div class="table-responsive">
    <?php global $trs; echo $trs;?>
</div>

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
    $cnt=1;
    $trs="";
    foreach ($results as $result){
        $subject =  $result->subject_name;
        $marks = $result->marks;
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

        if ($remarks == "F" ) {
            $comment = "Fail";
        }else {
            $comment = "Pass";
        }




        $trs .= "<tr>";
        $trs .= "<td width='50'> $cnt</td>";
        $trs .= "<td width='50'> $subject</td>";
        $trs .= "<td width='50'> $marks </td>";
        $trs .= "<td width='250'> $remarks</td>";
        $cnt++;
    }}
?>

<div class="table-responsive table-bordered" style="font-size: 20px;">
    <table class="table">
        <thead>
        <tr>
            <th align='left'>Serial</th>
            <th align='left'>Subject</th>
            <th align='left' >Marks</th>
            <th align='left' >Grade</th>
        </tr>
        </thead>
        <tbody>

        <?php global $trs; echo $trs;?>

        </tr>
        <tr>
            <th scope="row" colspan="3">Comment</th>
            <td><?php global $comment; echo $comment;?></td>
        </tr>
        </tbody>

        </tbody>
    </table>

</div>


</html>

<?php
$html = ob_get_clean();
$dompdf = new Dompdf();
$dompdf->setPaper('A4', 'landscape');
$dompdf->loadhtml($html);
$dompdf->render();
//dompdf->stream("",array("Attachment" => false));
$dompdf->stream("result.pdf");
?>
?>