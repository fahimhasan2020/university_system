<?php


namespace App\Parents;

if(!isset($_SESSION) )session_start();
use App\Model\Database;
use App\Message\Message;
use PDO;

class Parents extends  Database
{
    public $id,
        $name,
        $email,
        $password;

    public function setData($postArray){
        if(array_key_exists("id",$postArray)) {
            $this->id = $postArray["id"];
        }

        if(array_key_exists("password",$postArray)) {
            $this->password = $postArray['password'];
        }

        if(array_key_exists("email",$postArray)) {
            $this->email = $postArray['email'];
        }

        if(array_key_exists("name",$postArray)) {
            $this->name = $postArray['name'];
        }

    }

    public function is_exist(){

        $query="SELECT * FROM parents WHERE parents.email ="."'".$this->email."'";

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

    public function is_registered(){
        $query = "SELECT * FROM parents WHERE email='$this->email' AND password='$this->password'";
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

    public function logged_in(){
        if ((array_key_exists('email', $_SESSION)) && (!empty($_SESSION['email']))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function log_out(){
        $_SESSION['email']="";
        return TRUE;
    }


    public function store() {

        $sqlQuery = "INSERT INTO parents ( name, email, password) VALUES ( ?, ?, ?)";

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->name, $this->email, $this->password];

        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been store successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been store. </div>");


    } // end of storeTeacher()



    public function index() {

        $sqlQuery = "SELECT * FROM parents";


        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $allData =  $sth->fetchAll();

        return $allData;

    } // end of index()

    public function view() {

        $sqlQuery = "SELECT * FROM parents WHERE id =" . $this->id;

        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $oneData=  $sth->fetch();

        return $oneData;

    } // end of view()

    public function delete(){

        $sqlQuery = "DELETE FROM parents WHERE id=" . $this->id;

        $status = $this->dbh->exec($sqlQuery);

        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been delete successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been delete. </div>");



    }// end of delete()

    public function update() {

        $sqlQuery = "UPDATE parents SET  name = ?, email= ? WHERE id=".$this->id;

        $sth = $this->dbh->prepare( $sqlQuery );


        $dataArray = [ $this->name, $this->email];

        $status = $sth->execute($dataArray);


        if($status)
            Message::setMessage("<dic class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been update successfully. </dic>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been update. </div>");


    } // end of storeTeacher()

}