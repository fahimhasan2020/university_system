<?php

namespace App\Admin;
if(!isset($_SESSION) )  session_start();
use App\Model\Database as DB;
use App\Message\Message;
use App\Utility\Utility;
use PDO;

class Admin extends DB{

    public $email = "";
    public $password = "";
    private $name;
    private $photo;

    public function __construct(){
        parent::__construct();
    }

    public function setData($data = Array()){
        if (array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }

        if (array_key_exists('adminPhoto', $data)) {
            $this->photo = $data['adminPhoto'];
        }

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }
        if (array_key_exists('password', $data)) {
            $this->password = $data['password'];
        }
        return $this;


    }

    public function view() {
        $sqlQuery = "SELECT * FROM admin WHERE email = '".$this->email."'";

        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $oneData=  $sth->fetch();

        return $oneData;

    } // end of view()

    public function is_registered(){
        $query = "SELECT * FROM admin WHERE email='$this->email' AND password='$this->password'";
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

    public function update() {

        $sqlQuery = "UPDATE admin SET name = ?,email = ?, photo = ? WHERE email='".$this->email."'";

        $sth = $this->dbh->prepare( $sqlQuery );

        $dataArray = [ $this->name, $this->email, $this->photo];
        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been update successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been update. </div>");


    } // end of storeTeacher()


    public function change_password(){
        $query="UPDATE admin SET password = ? WHERE email = '{$this->email}'";
        $result=$this->dbh->prepare($query);
        $result->execute(array($this->password));

        if($result){
            Message::message("
            <div class=\"alert alert-info\">
            <strong>Success!</strong> Password has been updated  successfully.
            </div>");
                    }
        else {
            echo "Error";
        }

    }



}

