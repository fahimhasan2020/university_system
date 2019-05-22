<?php


namespace App\Classes;

use App\Model\Database;

use App\Utility\Utility;

use App\Message\Message;

use PDO;

class Classes extends Database{

    private $classId, $className, $classNumeric, $section;

    public function setData($postArray){
        if(array_key_exists('class_id', $postArray) ){
            $this->classId = $postArray['class_id'];
        }

        if(array_key_exists('className', $postArray) ){
            $this->className = "Class " . $postArray['className'];
        }

        if(array_key_exists('classNumeric', $postArray) ){
            $this->classNumeric = $postArray['classNumeric'];
        }

        if(array_key_exists('section', $postArray) ){
            $this->section = $postArray['section'];
        }

    }


    public function storeClass() {

        $sqlQuery = "INSERT INTO classes ( class_name, class_numeric, section) VALUES ( ?, ?, ?)";

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->className, $this->classNumeric, $this->section ];


        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been store successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been store. </div>");


    } // end of storeTeacher()



    public function is_set_in_studentTable(){

        $query="SELECT * FROM students WHERE class_id =".$this->classId;
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


    public function index() {

        $sqlQuery = "SELECT * FROM classes ORDER BY class_name";


        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $allData =  $sth->fetchAll();

        return $allData;

    } // end of index()

    public function delete(){

        $sqlQuery = "DELETE FROM classes WHERE class_id=" . $this->classId;

        $status = $this->dbh->exec($sqlQuery);


        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been delete successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been delete. </div>");



    }// end of delete()

}