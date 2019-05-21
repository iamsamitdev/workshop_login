<?php
session_start();
require 'config.php';

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT;
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_ENCODING
);

try {
    $connect = @new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    //echo "Connect Database Successfully";
} catch (PDOException $e) {
    echo "Connection Fail " . $e->getMessage();
}
