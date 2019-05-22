<?php
require_once("../../../vendor/autoload.php");

use App\Student\Student;
use App\Message\Message;
use App\Utility\Utility;

$obj = new Student();

$obj->setData($_POST);

$status= $obj->is_exist();

if($status){
    Message::setMessage("<div class='alert alert-danger'>
    <i class='fa fa-times' style='font-size: 20px'></i>&nbsp;&nbsp;<strong>Taken!</strong> Email has already been taken. </div>");
    return Utility::redirect($_SERVER['HTTP_REFERER']);
}else {

    // Start of Physically Moving Files to its Destination

    $fileName = time() . $_FILES["File2Upload"]["name"] ;

    $source = $_FILES["File2Upload"]["tmp_name"];

    $destination = "../Uploads/". $fileName;

    move_uploaded_file($source, $destination);

    // End of Physically Moving Files to its Destination

    $_POST["studentPhoto"] = $fileName;

    $obj->setData($_POST);

    $obj->storeStudent();

    $path = $_SERVER['HTTP_REFERER'];
    Utility::redirect($path);

}




