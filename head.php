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
if($WEB['file_name'] == "index.php"){
        $WEB['web_title'] = "工作室";
    }elseif($WEB['file_name'] == "user.php"){
        $WEB['web_title'] = "會員管理";
    }elseif($WEB['file_name'] == "prod.php"){
        $WEB['web_title'] = "商品管理";
    }elseif($WEB['file_name'] == "kind.php"){
        $WEB['web_title'] = "類別管理";
    }elseif($WEB['file_name'] == "menu.php"){
        $WEB['web_title'] = "選單管理";
    }elseif($WEB['file_name'] == "cart.php"){
        $WEB['web_title'] = "購物車";
    }elseif($WEB['file_name'] == "slide.php"){
        $WEB['web_title'] = "輪播圖管理";
    }else{
        $WEB['web_title'] = "";//
    }
    //basename(__FILE__)head.php
#--------- WEB END -----

// die(); 程式讀到這裡停止,列印使用print_r來停止

#
/*---- 必須引入 require_once只會引入一次 ----*/
#引入樣板引擎
require_once _WEB_PATH.'/smarty.php';
#引入資料庫設定
require_once _WEB_PATH.'/sqlConfig.php';
#引入設定檔,引入所有function
require_once _WEB_PATH . '/function.php';

$_SESSION['user']['kind'] = isset($_SESSION['user']['kind']) ? $_SESSION['user']['kind'] : "" ; // 登入用
// 設定一個變數$_SESSION['user']['kind''](自訂的變數名稱) = SESSION變數判斷式→($_SESSION['user']['kind']) ? $_SESSION['user']['kind'] : false ; ?後為正確時指令 :後為錯誤時指令

#記住我COOKIE判斷式
if($_SESSION['user']['kind'] === "") { //先判斷是否為管理員
    $_COOKIE['token'] = isset($_COOKIE['token']) ? $_COOKIE['token'] : "" ; //token是否正確的判斷式
    $_COOKIE['uname'] = isset($_COOKIE['uname']) ? $_COOKIE['uname'] : "" ; //uname是否正確的判斷式
    
    $_COOKIE['uname'] = db_filter($_COOKIE['uname'], '');// 過濾變數,過濾變數不用必填故最後面用''即可
    $_COOKIE['token'] = db_filter($_COOKIE['token'], '');
    
    if($_COOKIE['uname'] && $_COOKIE['token']){
        $sql = "SELECT *
            FROM `users`
            WHERE `uname` = '{$_COOKIE['uname']}'
    ";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        if($_COOKIE['token'] === $row['token']){
            //取出的資料陣列，是以欄位順序為陣列索引,一次一筆
            $row['uname'] = htmlspecialchars($row['uname']); //文字過濾成字串
            $row['uid'] =  (int)$row['uid']; //數字過濾成整數
            $row['kind'] =  (int)$row['kind']; //數字過濾成整數
            $row['name'] = htmlspecialchars($row['name']); //文字過濾成字串
            $row['tel'] = htmlspecialchars($row['tel']); //文字過濾成字串
            $row['email'] = htmlspecialchars($row['email']); //文字過濾成字串
            $row['pass'] = htmlspecialchars($row['pass']); //文字過濾成字串
            $row['token'] = htmlspecialchars($row['token']); //文字過濾成字串

            //登入成功,↓將資料寫進會員資料中
            $_SESSION['user']['uid'] = $row['uid'];
            $_SESSION['user']['uname'] = $row['uname'];
            $_SESSION['user']['name'] = $row['name'];
            $_SESSION['user']['tel'] = $row['tel'];
            $_SESSION['user']['email'] = $row['email'];
            $_SESSION['user']['kind'] = $row['kind']; //$_SESSION['user']['kind'] 等於smarty的 $smarty.session.user.kind
        }
    }
    
    // print_r($row);die();
    
}

#轉向用,送幾個值過去,就要有幾段
#有呼叫才會有值,為了防止報錯,要給一個三元運算,讓他自己判斷是否有值
$_SESSION['redirect'] = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : "";
$_SESSION['message'] = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$_SESSION['time'] = isset($_SESSION['time']) ? $_SESSION['time'] : "";

#轉向用
$smarty->assign("redirect" , $_SESSION['redirect']); //樣板使用法 <{$redirect}>
$smarty->assign("message" , $_SESSION['message']);
$smarty->assign("time" , $_SESSION['time']);

#清理轉向過的值,不要每次都重複轉向
$_SESSION['redirect'] = "";
$_SESSION['message'] = "";
$_SESSION['time'] = "";

#購物車圖示的判斷
$_SESSION['cartAmount'] = isset($_SESSION['cartAmount']) ? $_SESSION['cartAmount'] : 0;