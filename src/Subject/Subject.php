<?php


namespace App\Subject;

use App\Message\Message;

use App\Utility\Utility;

use App\Model\Database;

use PDO;

class Subject extends Database{

    private $subjectId, $subjectName, $combinationid, $subjectCode, $classId ;

    public function setData($postArray){

        if(array_key_exists('subject_id', $postArray) ){
            $this->subjectId = $postArray['subject_id'];
        }

        if(array_key_exists('class_id', $postArray) ){
            $this->classId = $postArray['class_id'];
        }

        if(array_key_exists('combination_id', $postArray) ){
            $this->combinationid = $postArray['combination_id'];
        }

        if(array_key_exists('subject_name', $postArray) ){
            $this->subjectName = $postArray['subject_name'];
        }

        if(array_key_exists('subject_code', $postArray) ){
            $this->subjectCode = $postArray['subject_code'];
        }


    }


    public function storeSubject(){
        $sqlQuery = "INSERT INTO subjects ( subject_name, subject_code) VALUES ( ?, ? )";

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->subjectName, $this->subjectCode];

        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been store successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been store. </div>");

    }



    public function index() {

        $sqlQuery = "SELECT * FROM subjects ORDER BY subject_name";


        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $allData =  $sth->fetchAll();

        return $allData;

    } // end of index()

    public function indexCombination() {
        $sqlQuery = "SELECT classes.class_name,classes.class_id,classes.section,subjects.subject_name,subjects.subject_code,sub_class_combination.combination_id,sub_class_combination.combination_id as scid from sub_class_combination join classes on classes.class_id=sub_class_combination.class_id  join subjects on subjects.subject_id=sub_class_combination.subject_id";

        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $allData =  $sth->fetchAll();


        return $allData;

    } // end of index()

    public function storeSubjectCombination(){
        $sqlQuery = "INSERT INTO sub_class_combination ( subject_id, class_id) VALUES ( ?, ? )";

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->subjectId, $this->classId];

        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been store successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been store. </div>");


    }

    public function is_set_in_resultTable(){

        $query="SELECT * FROM students_result WHERE subject_id =".$this->subjectId;
        $STH=$this->dbh->query($query);

        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetch();
        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete(){

        $sqlQuery = "DELETE FROM subjects WHERE subject_id=" . $this->subjectId;

        $status = $this->dbh->exec($sqlQuery);

        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been delete successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been delete. </div>");


    }// end of delete()
    public function deleteCombination(){
        $sqlQuery = "DELETE FROM sub_class_combination WHERE combination_id=" . $this->combinationid;

        $status = $this->dbh->exec($sqlQuery);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been delete successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not delete store. </div>");




    }// end of delete()



}