<?php

namespace App\Teacher;
use App\Model\Database;
use App\Message\Message;
use App\Utility\Utility;
use PDO;

class Teacher extends Database{

    private $id,
            $teacherName,
            $teacherDesignation,
            $teacherGender,
            $teacherDob,
            $teacherAddress,
            $teacherEmail,
            $teacherPassword,
            $teacherPhone,
            $teacherPhoto;


    public function setData($postArray){
        if(array_key_exists("teacher_id",$postArray)) {
            $this->id = $postArray["teacher_id"];
        }

        if(array_key_exists("teacherName",$postArray)) {
            $this->teacherName = $postArray["teacherName"];
        }

        if(array_key_exists('teacherDesignation',$postArray)){
            $this->teacherDesignation = $postArray['teacherDesignation'];
        }

        if(array_key_exists('teacherGender',$postArray)){
            $this->teacherGender = $postArray['teacherGender'];
        }


        if(array_key_exists('teacherDob',$postArray)){
            $date = date('Y-m-d', strtotime($postArray['teacherDob']));
            $this->teacherDob = $date;
        }

        if(array_key_exists('teacherAddress',$postArray)){
            $this->teacherAddress = $postArray['teacherAddress'];
        }

        if(array_key_exists('teacherEmail',$postArray)){
            $this->teacherEmail = $postArray['teacherEmail'];
        }

        if(array_key_exists('teacherPassword',$postArray)){
            $this->teacherPassword = $postArray['teacherPassword'];
        }

        if(array_key_exists('teacherPhone',$postArray)){
            $this->teacherPhone= $postArray['teacherPhone'];
        }

        if(array_key_exists('teacherPhoto',$postArray)){
            $this->teacherPhoto = $postArray['teacherPhoto'];
        }

    }

    public function is_exist(){

        $query="SELECT * FROM teacher WHERE teacher.email ="."'".$this->teacherEmail."'";

        $STH=$this->dbh->query($query);

        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();
        $count = $STH->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function store() {

        $sqlQuery = "INSERT INTO teacher ( name, designation, gender, dob, address, email, password, phone, photo) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )";

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->teacherName, $this->teacherDesignation, $this->teacherGender, $this->teacherDob, $this->teacherAddress, $this->teacherEmail, $this->teacherPassword, $this->teacherPhone,  $this->teacherPhoto];

        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been store successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been store. </div>");


    } // end of storeTeacher()



    public function index() {

        $sqlQuery = "SELECT * FROM teacher";


        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $allData =  $sth->fetchAll();

        return $allData;

    } // end of index()

    public function view() {

        $sqlQuery = "SELECT * FROM teacher WHERE teacher_id =" . $this->id;

        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $oneData=  $sth->fetch();

        return $oneData;

    } // end of view()

    public function delete(){

        $sqlQuery = "DELETE FROM teacher WHERE teacher_id=" . $this->id;

        $status = $this->dbh->exec($sqlQuery);

        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been delete successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been delete. </div>");



    }// end of delete()

    public function update() {

        $sqlQuery = "UPDATE teacher SET  name = ?, designation= ?, gender= ?, dob= ?, address= ?, email= ?, password= ?, phone= ?, photo= ? WHERE teacher_id=".$this->id;

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->teacherName, $this->teacherDesignation, $this->teacherGender, $this->teacherDob, $this->teacherAddress, $this->teacherEmail, $this->teacherPassword, $this->teacherPhone,  $this->teacherPhoto];

        $status = $sth->execute($dataArray);


        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been update successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been update. </div>");


    } // end of storeTeacher()
    
}