<?php
if($_SERVER['HTTP_HOST'] == "127.0.0.1" or $_SERVER['HTTP_HOST'] == "localhost"){ //近端
    #資料庫伺服器
    $db_host = "localhost";//連結到主機,大部分為localhost
    #資料庫使用者帳號
    $db_user = "root";
    #資料庫使用者密碼
    $db_password = "123456789";
    #資料庫名稱
    $db_name = "web";
}else{ //遠端
    #資料庫伺服器
    $db_host = "localhost";
    #資料庫使用者帳號
    $db_user = "";
    #資料庫使用者密碼
    $db_password = "";
    #資料庫名稱
    $db_name = "";
}
#PHP 5.2.9以後
$db = new mysqli($db_host, $db_user, $db_password, $db_name);  //連結資料庫
if ($db->connect_error) {  //連結不到時顯示↓
    die('無法連上資料庫 (' . $db->connect_errno . ') ' //$db成員 ->後為方法
        . $db->connect_error);
}
#設定資料庫語系
$db->set_charset("utf8");