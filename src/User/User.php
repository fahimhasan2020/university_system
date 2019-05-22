<?php
namespace App\User;
if(!isset($_SESSION) )  session_start();
use App\Message\Message;
use App\Model\Database as DB;
use PDO;

class User extends DB{

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
        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }
        if (array_key_exists('password', $data)) {
            $this->password = $data['password'];
        }

        if (array_key_exists('userPhoto', $data)) {
            $this->photo = $data['userPhoto'];
        }

        return $this;
    }
    public function is_registered(){
        $query = "SELECT * FROM teacher WHERE email='$this->email' AND password='$this->password'";
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

    public function view() {
        $sqlQuery = "SELECT * FROM teacher WHERE email = '".$this->email."'";

        $sth = $this->dbh->query($sqlQuery);

        $sth->setFetchMode(PDO::FETCH_OBJ);

        $oneData=  $sth->fetch();

        return $oneData;

    } // end of view()

    public function update() {

        $sqlQuery = "UPDATE teacher SET name = ?,email = ?, photo = ? WHERE email='".$this->email."'";

        $sth = $this->dbh->prepare( $sqlQuery );

        $dataArray = [ $this->name, $this->email, $this->photo];
        $status = $sth->execute($dataArray);

        if($status)
            Message::setMessage("<div class='alert alert-success'><i class='fa fa-check' style='font-size: 20px'></i>Success! Data has been update successfully. </div>");
        else
            Message::setMessage("<div class='alert alert-danger'><i class='fa fa-times' style='font-size: 20px'></i>Failed! Data has not been update. </div>");


    } // end of storeTeacher()
}

