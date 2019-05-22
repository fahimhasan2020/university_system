<?php
require_once("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Subject\Subject;

$objSubject = new Subject();

$objSubject->setData($_POST);


$objSubject->storeSubjectCombination();

$path = $_SERVER['HTTP_REFERER'];
Utility::redirect($path);