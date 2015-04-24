<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 5.4.2015 г.
 * Time: 17:47 ч.
 */
try {
    $server_name = "localhost";
    $server_user = "root";
    $conn_db = new PDO("mysql:host=$server_name;dbname=funbox-bg", $server_user);
    $conn_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e ->getMessage();
}
mb_internal_encoding("UTF-8");
$conn_db->exec("SET NAMES UTF8");
