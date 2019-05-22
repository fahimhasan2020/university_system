<?php
require_once ("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Message\Message;

use App\Classes\Classes;

$obj = new Classes();

$obj->setData($_GET);

$status  = $obj->is_set_in_studentTable();

if($status){
    Message::setMessage("<div class='alert alert-danger'>
    <i class='fa fa-times' style='font-size: 20px'></i>&nbsp;&nbsp;<strong>Sorry!</strong> Student is admitted in this Class </div>");
    return Utility::redirect($_SERVER['HTTP_REFERER']);
}else {
    $obj->delete();

    $path = $_SERVER['HTTP_REFERER'];

    Utility::redirect($path);
}