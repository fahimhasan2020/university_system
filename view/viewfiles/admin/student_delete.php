<?php
require_once ("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Student\Student;

$obj = new Student();

$obj->setData($_GET);

$obj->delete();

$path = $_SERVER['HTTP_REFERER'];

Utility::redirect($path);