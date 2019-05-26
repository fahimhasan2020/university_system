<?php

namespace App\Model;

use PDO;
use PDOException;

class Database
{
    public $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:host=127.0.0.1;dbname=happy_coders_sms", "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Database Connection Successful!<br>";
        } catch (PDOException $error) {
            echo $error;
            // echo  $error->getMessage();
        }
    }
}