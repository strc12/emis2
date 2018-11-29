<?php

$DB_NAME = 'emis';
$DB_HOST = 'localhost';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


?>
