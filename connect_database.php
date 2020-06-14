<?php
$db_host = "localhost";
$db_name = "tonas_mojang";
$db_user = "root";
$db_passwd = "";
$db_charset = "utf8mb4";
$dsn ="mysql:host=$db_host;
        dbname=$db_name;
        charset=$db_charset";
$db_opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
);
$db = new PDO($dsn, $db_user, $db_passwd, $db_opt);
?>