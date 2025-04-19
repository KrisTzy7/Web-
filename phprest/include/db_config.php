<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "phprest";
    $db = new PDO("mysql:host=$db_server;dbname=$db_name",$db_user, $db_password);
        
    define("APP_NAME","PHPREST");
    
?>