<?php
namespace App\classes;
class Database
{
    public function dbConnection() {
        $hostName = 'localhost';
        $userName = 'root';
        $pass = '';
        $databaseName = 'blog';
        $link = mysqli_connect($hostName, $userName, $pass, $databaseName);
        return $link;
    }
}