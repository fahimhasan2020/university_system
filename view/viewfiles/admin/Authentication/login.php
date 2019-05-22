<?php
if(!isset($_SESSION) )session_start();
include_once('../../../../vendor/autoload.php');
use App\Admin\Admin;
use App\Message\Message;
use App\Utility\Utility;



$auth= new Admin();
$status= $auth->setData($_POST)->is_registered();

if($status){
    $_SESSION['email']=$_POST['email'];
    Message::message("
                <div class='alert alert-success'>
                            <strong><i class='fa fa-check' style='font-size: 20px'></i>&nbsp;&nbsp;Welcome!</strong> You have successfully logged in.
                </div>");
    
     Utility::redirect('../deshboard.php');

}else{
    Message::message("
                <div class=\"alert alert-danger\">
                            <strong><i class='fa fa-times'></i>&nbsp;&nbsp;Wrong information!</strong> Please try again.
                </div>");

    Utility::redirect('../index.php');

}


