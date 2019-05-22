<?php
require_once("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Subject\Subject;

$objClass = new Subject();

$objClass->setData($_POST);

$objClass->storeSubject();

$path = $_SERVER['HTTP_REFERER'];
Utility::redirect($path);