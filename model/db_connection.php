<?php

$dataSource = "mysql:host=localhost;dbname=id11305519_test";
$username = "root";
$password = "sipho";

try{
    $conn = new PDO($dataSource, $username, $password);
} catch (PDOException $ex){
    include($_SERVER["DOCUMENT_ROOT"] . "/view/404.php");
    exit();
}


?>