<?php
require_once 'head.php';


/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); //REQUEST 包含全部請求碼
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');  // sn序號,也可用id

/* 程式流程 */
switch ($op){
    case "contact_form" :
        $msg = contact_form();
        break; 

    case "ok" :
        $msg = ok();
        break; 
        
    case "login" :  //登入用
        $msg = login();
        // header("location:index.php")為轉向,注意前面不可以有echo輸出
        exit; // 同等die();離開,但不會顯示 

    case "logout" : //登出用,在user.php網址後加上?op=loguot
        $msg = logout();    
        redirect_header ("index.php" , '登出成功' , 3000); 
        // ↑調用轉向函式,括號內容依需求決定要不要下,轉向頁面,訊息,時間,如不下依預設去跑
        exit;

    case "login_form" :
        $msg = login_form();
        break; 

    case "reg_form" :
        $msg = reg_form();
        break; 
    
    case "reg" :
        $msg = reg();    
        redirect_header("index.php", '註冊成功', 3000);
        exit;
    
    default: //網址後面亂輸入的人會跑這,用來防止惡意攻擊
        $op = "op_list";
        break;  //離開
}

/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

$smarty->assign("a0", "關於我們");
$smarty->assign("a1", "服務項目");
$smarty->assign("a2", "產品目錄");
$smarty->assign("a3", "聯絡資訊");
$smarty->assign("a4", "聯絡我們");

/* ctrl+h取代 ctrl+f搜尋 */
// print_r ($_COOKIE);die(); 用來檢查記住我的登入資料有沒有記錄到
// echo $_SESSION['admin'];die(); 用來檢查是否有登入

/*---- 程式結尾-----*/
$smarty->display('theme.tpl');

/*------函數區-----*/
function contact_form() {

}
function ok() {

}
function login_form() {

}
function reg_form(){
    
}
function reg() {
    global $db; // 呼叫入資料庫的值來使用
    #過濾變數,未設定過濾的話將無法輸入'單引號
    $_POST['uname'] = db_filter($_POST['uname'], '帳號');
    $_POST['pass'] = db_filter($_POST['pass'], '密碼');
    $_POST['chk_pass'] = db_filter($_POST['chk_pass'], '確認密碼');
    $_POST['name'] = db_filter($_POST['name'], '姓名');
    $_POST['tel'] = db_filter($_POST['tel'], '電話');
    $_POST['email'] = db_filter($_POST['email'], 'email',FILTER_SANITIZE_EMAIL);
    //echo $_POST['email'];die(); 驗證是否成功攔截
    #加密處理
    if($_POST['pass'] != $_POST['chk_pass']){// 先判斷密碼是否一致再存入資料庫
        redirect_header("index.php?op=reg_form","密碼不一致");
        exit;
    }
    $_POST['pass']  = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $_POST['token']  = password_hash($_POST['uname'], PASSWORD_DEFAULT);
    #寫入語法,sql語法不分大小寫
    $sql="INSERT INTO `users` (`uname`, `pass`, `name`, `tel`, `email`, `token`)  /* INSERT INTO為寫入資料庫的名稱,名稱需用重音包覆` ` */
    VALUES ('{$_POST['uname']}', '{$_POST['pass']}','{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['token']}')";  // VALUES寫入的值,是使用者填入的資料
    $db->query($sql) or die($db->error() . $sql);//執行上面的語法,如有錯誤將印出
    $uid = $db->insert_id;
    /* $sql="INSERT INTO `users` (`uname`, `pass`, `name`, `tel`, `email`)  
        VALUES ('{$_POST['uname']}置入的值為變數的寫法', '{$_POST['pass']}', '{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}');"; */
    // print_r($uid);die("reg"); 測試寫入資料是否正確用
}
function login(){
    global $smarty;
    $name = "admin";
    $pass = "111111";
    $token = "xxxxxx"; //讓密碼不會直接被記憶,是隱藏的
    if($name == $_POST['name'] and $pass == $_POST['pass']){
        $_SESSION['admin'] = true;
        $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : ""; //是否記住密碼的判斷式
        if($_POST['remember']) { //如果選要記住
            setcookie("name", $name, time()+ 3600 * 24 * 365); //time()+3600 * 24 * 365 記住多久,此為一年
            setcookie("token", $token, time()+ 3600 * 24 * 365); 
        }
        redirect_header ("index.php" , '登入成功' , 3000);         
    } else {
        redirect_header ("index.php?op=login_form" , '登入失敗' , 3000); 
    }
    //print_r($_POST);die();  陣列也可用var_dump(內容顯示的比較多),但不能用echo
}
function logout() {
    $_SESSION['admin']="";
    setcookie("name", "" , time()- 3600 * 24 * 365); //登出後清除COOKIE
    setcookie("token", "" , time()- 3600 * 24 * 365); //登出後清除COOKIE
}
// #轉向函式
// function redirect_header($url = "index.php" , $message = '訊息' , $time = 3000) {
//     $_SESSION['redirect'] = true; //呼叫這個函式,表示真時,要轉頁
//     $_SESSION['message'] = $message;
//     $_SESSION['time'] = $time;
//     header("location:{$url}"); // SESSION不會因轉頁,而消除紀錄,古前面用SESSION呼叫
// }