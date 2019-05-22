<?php
require_once ("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Teacher\Teacher;

$obj = new Teacher();

$obj->setData($_GET);

$obj->delete();

$path = $_SERVER['HTTP_REFERER'];

Utility::redirect($path);