<?php
require_once("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Classes\Classes;

$objClass = new Classes();

$objClass->setData($_POST);

$objClass->storeClass();

$path = $_SERVER['HTTP_REFERER'];
Utility::redirect($path);