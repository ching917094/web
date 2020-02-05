<?php
/*
1. head.php為前台每個程式都會引入的檔案
2. 所有檔案都必須執行的流程，請放到這裡
3. smarty_01
 */
session_start(); //啟用 $_SESSION,前面不可以有輸入任何指令或空格,放在伺服端,一定執行
error_reporting(E_ALL);@ini_set('display_errors', true); //設定有錯誤時,顯示錯誤
$http = 'http://';
if (!empty($_SERVER['HTTPS'])) { // !代表反意,empty代表空 反意,!empty會負負的正,數字0為假,0以外為真
    $http = ($_SERVER['HTTPS'] == 'on') ? 'https://' /* ←成立的話 */ : 'http://' /* ←不成立的話 */ ;
}

# dirname(__FILE__)網站實體路徑(不含 /)
define('_WEB_PATH', str_replace("\\", "/", dirname(__FILE__))); // str_replace 讓"A",被"B"取代
// define是常數的定義方式,定義後所有地方都能使用但就不能更改了,不成文的規定_+大寫為常數EX:_WEB_PATH

#網站URL(不含 /)
define('_WEB_URL', $http . $_SERVER["HTTP_HOST"] . str_replace($_SERVER["DOCUMENT_ROOT"], "", _WEB_PATH));

#--------- WEB -----
#程式檔名(含副檔名)
$WEB['file_name'] = basename($_SERVER['PHP_SELF']); //index.php
//basename(__FILE__)head.php
#--------- WEB END -----

// die(); 程式讀到這裡停止,列印使用print_r來停止

#
/*---- 必須引入 require_once只會引入一次 ----*/
#引入樣板引擎
require_once _WEB_PATH.'/smarty.php';
#引入資料庫設定
// require_once _WEB_PATH.'/sqlConfig.php';
#引入設定檔,引入所有function
require_once _WEB_PATH . '/function.php';

$_SESSION['admin'] = ($_SESSION['admin']) ? $_SESSION['admin'] : false ; // 登入用
// 設定一個變數$_SESSION['admin(自訂的變數名稱)'] = SESSION變數判斷式→($_SESSION['admin']) ? $_SESSION['admin'] : false ; ?後為正確時指令 :後為錯誤時指令

//記住我COOKIE判斷式
if(!$_SESSION['admin']) { //先判斷是否為管理員
    $_COOKIE['token'] = isset($_COOKIE['token']) ? $_COOKIE['token'] : "" ; //token是否正確的判斷式
    $_COOKIE['name'] = isset($_COOKIE['name']) ? $_COOKIE['name'] : "" ; //name是否正確的判斷式
    if($_COOKIE['name'] == "admin" and $_COOKIE['token'] == "xxxxxx")$_SESSION['admin'] = true; //↑如果name和token都正確時執行,登入正確的判斷式
}