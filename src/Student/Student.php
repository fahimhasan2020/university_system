<?php
namespace App\Student;

use App\Model\Database;

use App\Message\Message;

use App\Utility\Utility;

use PDO;

class Student extends Database{

    private $id,
        $studentName,
        $studentDob,
        $studentFatherName,
        $studentMotherName,
        $className,
        $rollNumber,
        $studentGender,
        $studentAddress,
        $studentEmail,
        $studentPassword,
        $studentPhone,
        $studentPhoto;


    public function setData($postArray){
        if(array_key_exists("student_id",$postArray)) {
            $this->id = $postArray["student_id"];
        }

        if(array_key_exists("studentName",$postArray)) {
            $this->studentName = $postArray["studentName"];
        }

        if(array_key_exists('studentDob',$postArray)){
            $date = date('Y-m-d', strtotime($postArray['studentDob']));
            $this->studentDob = $date;
        }

        if(array_key_exists('fatherName',$postArray)){
            $this->studentFatherName = $postArray['fatherName'];
        }


        if(array_key_exists('motherName',$postArray)){
            $this->studentMotherName = $postArray['motherName'];
        }

        if(array_key_exists('classId',$postArray)){
            $this->className = $postArray['classId'];
        }

        if(array_key_exists('studentRoll',$postArray)){
            $this->rollNumber = $postArray['studentRoll'];
        }

        if(array_key_exists('studentGender',$postArray)){
            $this->studentGender = $postArray['studentGender'];
        }


        if(array_key_exists('studentAddress',$postArray)){
            $this->studentAddress = $postArray['studentAddress'];
        }

        if(array_key_exists('studentEmail',$postArray)){
            $this->studentEmail = $postArray['studentEmail'];
        }

        if(array_key_exists('studentPassword',$postArray)){
            $this->studentPassword = $postArray['studentPassword'];
        }

        if(array_key_exists('studentPhone',$postArray)){
            $this->studentPhone= $postArray['studentPhone'];
        }

        if(array_key_exists('studentPhoto',$postArray)){
            $this->studentPhoto = $postArray['studentPhoto'];
        }

    }

    public function is_exist(){

        $query="SELECT * FROM students WHERE `email` ='$this->studentEmail' ";
        $sth=$this->dbh->query($query);

        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->fetchAll();

        $count = $sth->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }



    public function storeStudent() {

        $sqlQuery = "INSERT INTO students ( name, dob, father_name, mother_name, class_id, roll_number, gender, address, email, password, phone, photo)
                     VALUES ( ?, ?, ?, ?, ?, ?, ? , ?, ? , ?, ?, ? )";

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->studentName, $this->studentDob, $this->studentFatherName,
            $this->studentMotherName, $this->className, $this->rollNumber, $this->studentGender, $this->studentAddress,
            $this->studentEmail, $this->studentPassword, $this->studentPhone,  $this->studentPhoto];

        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been store successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been store. </div>");

    } // end of storeTeacher()


    public function index() {

        $sqlQuery = "SELECT students.name,students.dob,students.father_name,students.mother_name,students.student_id,students.class_id,students.gender,students.roll_number,
                    students.address,students.email,students.phone,students.photo,students.password,classes.class_name,classes.section from students join classes on classes.class_id=students.class_id";


        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $allData =  $sth->fetchAll();

        return $allData;

    } // end of index()



    public function view() {
        $sqlQuery = "SELECT students.name,students.student_id,students.roll_number,students.father_name,students.mother_name,students.email,students.address,students.gender,students.dob,students.phone,students.photo,students.password,classes.class_id,classes.class_name,classes.section from students join classes on classes.class_id=students.class_id where students.student_id=". $this->id;

        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $oneData=  $sth->fetch();

        return $oneData;

    } // end of view()

    public function delete(){

        $sqlQuery = "DELETE FROM students WHERE student_id=" . $this->id;
        $status = $this->dbh->exec($sqlQuery);

        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been delete successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been delete. </div>");



    }// end of delete()

    public function update() {

        $sqlQuery = "UPDATE students SET name = ?, dob = ?, father_name = ?, mother_name = ?, class_id = ?, roll_number = ?, gender = ?, address = ?, email = ?, password = ?, phone = ?, photo = ? WHERE student_id=".$this->id;
        $sth = $this->dbh->prepare( $sqlQuery );

        $dataArray = [ $this->studentName, $this->studentDob, $this->studentFatherName,
            $this->studentMotherName, $this->className, $this->rollNumber, $this->studentGender, $this->studentAddress,
            $this->studentEmail, $this->studentPassword, $this->studentPhone,  $this->studentPhoto];
        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been update successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been update. </div>");


    } // end of storeTeacher()


}