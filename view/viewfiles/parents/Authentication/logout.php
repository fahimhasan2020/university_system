<?php
if(!isset($_SESSION) )session_start();
include('../../../../vendor/autoload.php');
use App\Parents\Parents;
use App\Message\Message;
use App\Utility\Utility;


$auth= new Parents();
$status= $auth->log_out();

session_destroy();
session_start();

Message::message("
                <div class=\"alert alert-success\">
                            <strong>Logout!</strong> You have been logged out successfully.
                </div>");
return Utility::redirect('../index.php');