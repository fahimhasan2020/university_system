<?php
require_once("../../../vendor/autoload.php");
use App\Model\Database;
$db = new Database();


if (!empty($_POST["classid"])) {

    $cid = intval($_POST['classid']);

    if (!is_numeric($cid)) {

        echo htmlentities("invalid Class");

        exit;

    } else {
        $stmt = $db->dbh->prepare("SELECT name,student_id FROM students WHERE class_id= :id order by name");

        $stmt->execute(array( ':id' => $cid ));

        ?><option value="">Select Student </option>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>

            <option value="<?php echo htmlentities($row['student_id']); ?>">
                <?php echo htmlentities($row['name']); ?>
            </option>

            <?php
        }
    }

}

// Code for Subjects
if (!empty($_POST["classid1"])) {

    $cl_id1 = intval($_POST['classid1']);

    if (!is_numeric($cl_id1)) {
        echo htmlentities("invalid Class");
        exit;

    } else {

        $status = 0;
        $stmh   = $db->dbh->prepare("SELECT subjects.subject_name,subjects.subject_id FROM sub_class_combination join  subjects on  subjects.subject_id = sub_class_combination.subject_id 
                                              WHERE sub_class_combination.class_id=:cl_idl order by subjects.subject_name");
        $stmh->execute(array(':cl_idl' => $cl_id1));

        while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) { ?>
            <label> <?php echo htmlentities($row['subject_name']); ?></label>
            <input type="text"  name="marks[]" value="" class="form-control" required="" placeholder="Enter marks out of 100" autocomplete="off">
            <br>
            <?php
        }
    }
}

?>

<?php

if (!empty($_POST["studclass"])) {
    $id    = $_POST['studclass'];
    $dta   = explode("$", $id);
    $id    = $dta[0];
    $id1   = $dta[1];
    $query = $db->dbh->prepare("SELECT student_id,class_id FROM students_result WHERE student_id=:id1 and class_id=:id ");
    //$query= $dbh -> prepare($sql);
    $query->bindParam(':id1', $id1, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt     = 1;
    if ($query->rowCount() > 0) {

        ?>
        <p>
            <?php
            echo "<p style='color:red; font-weight: bold;' class='text-center'> Result Already Declare .</p>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
            ?>
        </p>

    <?php } } ?>

