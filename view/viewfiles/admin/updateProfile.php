<?php
require_once ("../../../vendor/autoload.php");

use App\Utility\Utility;

use App\Admin\Admin;

$obj = new Admin();

$obj->setData($_POST);

$oneData = $obj->view();

$fileName = $oneData->photo;

if( !empty($_FILES["File2Upload"]["name"]) ){

    // Start of physically moving file to its destination
    $fileName =   time().$_FILES["File2Upload"]["name"];

    $source = $_FILES["File2Upload"]["tmp_name"];

    $destination = "../Uploads/".$fileName;

    move_uploaded_file($source, $destination);

    // End of physically moving file to its destination

}
// Start of the process to store file name to the table
$_POST["adminPhoto"] = $fileName;

$obj->setData($_POST);

$obj->update();

Utility::redirect('profile.php');

// End of the process to store file name to the table

