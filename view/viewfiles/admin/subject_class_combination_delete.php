<?php
require_once ("../../../vendor/autoload.php");

use App\Utility\Utility;
use App\Subject\Subject;


$objSubject = new Subject();

$objSubject->setData($_GET);

$objSubject->deleteCombination();

$path = $_SERVER['HTTP_REFERER'];

Utility::redirect($path);
