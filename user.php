<!--  $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : "" ; 
        isset判斷式($_POST['remember']) 成立顯示? $_POST['remember'] 不成立顯示: ""

        echo $_POST['name'] . "<br>" ;
        echo $_POST['pass'] . "<br>" ;
        echo $_POST['remember'] . "<br>" ;
        /cho $_POST['op'] . "<br>" ;
        die(); 3-10為除錯用範例 -->

<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'login_form', 'string'); //REQUEST 包含全部請求碼
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');  // sn序號,也可用id

/* 程式流程 */
switch ($op){
    case "reg_form" :
    $msg = reg_form();
    break; 

    case "logout" : //登出用,在user.php網址後加上?op=loguot
    $msg = logout();    
    redirect_header ("user.php" , '登出成功' , 5000); 
    // ↑調用轉向函式,括號內容依需求決定要不要下,轉向頁面,訊息,時間,如不下依預設去跑
    exit;

    case "reg" : //登出用,在user.php網址後加上?op=loguot
    $msg = reg();
    header("location:index.php");//所有動作需在頁面挑轉之前完成
    exit;

    case "login" :  //登入用
    $msg = login();
    // header("location:index.php");//header("location:index.php")為轉向,注意前面不可以有echo輸出
    exit; // 同等die();離開,但不會顯示

    default: //網址後面亂輸入的人會跑這,用來防止惡意攻擊
    $op = "login_form";
    login_form();
    break;  //離開
}

/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('user.tpl');

/*---- 函數區-----*/
function reg_form(){
    global $smarty;
    
}

function reg() {
    global $db; // 呼叫入$db的值來使用
    #過濾變數,未設定過濾的話將無法輸入'單引號
    $_POST['uname'] = $db->real_escape_string($_POST['uname']);
    $_POST['pass'] = $db->real_escape_string($_POST['pass']);
    $_POST['chk_pass'] = $db->real_escape_string($_POST['chk_pass']);
    $_POST['name'] = $db->real_escape_string($_POST['name']);
    $_POST['tel'] = $db->real_escape_string($_POST['tel']);
    $_POST['email'] = $db->real_escape_string($_POST['email']);
    #加密處理
    if($_POST['pass'] != $_POST['chk_pass'])die("密碼不一致"); // 先判斷密碼是否一致再存入資料庫
    $_POST['pass'] = password_hash($pass, PASSWORD_DEFAULT);
    #寫入語法,sql語法不分大小寫
    $sql="INSERT INTO `users` (`uname`, `pass`, `name`, `tel`, `email`)  /* INSERT INTO為寫入資料庫的名稱,名稱需用重音包覆` ` */
    VALUES ('{$_POST['uname']}', '{$_POST['pass']}','{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}')";  // VALUES寫入的值,是使用者填入的資料
    $db->query($sql) or die($db->error() . $sql); //執行上面的語法,如有錯誤將印出
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
        redirect_header ("user.php" , '登入失敗' , 3000); 
    }
    print_r($_POST); // 陣列也可用var_dump(內容顯示的比較多),但不能用echo
    die();
}

function logout() {
    $_SESSION['admin']="";
    setcookie("name", "" , time()- 3600 * 24 * 365); //登出後清除COOKIE
    setcookie("token", "" , time()- 3600 * 24 * 365); //登出後清除COOKIE
}

#轉向函式
function redirect_header($url = "index.php" , $message = '訊息' , $time = 3000) {
    $_SESSION['redirect'] = true; //呼叫這個函式,表示真時,要轉頁
    $_SESSION['message'] = $message;
    $_SESSION['time'] = $time;
    header("location:{$url}"); // SESSION不會因轉頁,而消除紀錄,古前面用SESSION呼叫
}

function login_form(){
    global $smarty;
}


/* ctrl+h取代 ctrl+f搜尋 */