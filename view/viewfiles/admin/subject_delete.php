<?php
require_once ("../../../vendor/autoload.php");

use App\Utility\Utility;
use App\Message\Message;
use App\Subject\Subject;

$obj = new Subject();


$obj->setData($_GET);


$status  = $obj->is_set_in_resultTable();

if($status){
    Message::setMessage("<div class='alert alert-danger'>
    <i class='fa fa-times' style='font-size: 20px'></i>&nbsp;&nbsp;<strong>Sorry!</strong> Subject is in this student result sheet </div>");
    return Utility::redirect($_SERVER['HTTP_REFERER']);
}else {

    $obj->delete();

    $path = $_SERVER['HTTP_REFERER'];

    Utility::redirect($path);
}