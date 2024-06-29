<?php
$dsn = "mysql:host=localhost;dbname=aayojan_net";
$dbusername = "root";
$dbpwd = "";

try{
    $pdo = new PDO($dsn, $dbusername, $dbpwd);//this line is used for connection
    //Rest all lines are for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Connection Failed: " . $e->getMessage();
}
