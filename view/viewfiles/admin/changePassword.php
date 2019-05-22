<?php
if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');
use App\Admin\Admin;
use App\Message\Message;
use App\Utility\Utility;

$objAdmin = new Admin();


    if (isset($_POST['new_password']) && isset($_POST['confirm_new_password'])) {

        if ($_POST['new_password'] == $_POST['confirm_new_password']) {


            $_POST['password'] = $_POST['new_password'];
            $objAdmin->setData($_POST);
            $objAdmin->change_password();
            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Password reset has been completed, Please login!
                </div>");
            Utility::redirect('profile.php');
            return;
        } else {
            Message::message("
                <div class=\"alert alert-danger\">
                            <strong>Error!</strong> Password doesn't match!
                </div>");
            Utility::redirect('profile.php');
        }
    }

