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
$op = system_CleanVars($_REQUEST, 'op', '', 'string'); //REQUEST 包含全部請求碼
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');  // sn序號,也可用id

/* 程式流程 */
switch ($op){
    case "xxx" :
    $msg = xxx();
    header("location:index.php");//header("location:index.php")為轉向,注意前面不可以有echo輸出
    exit; // 同等die();離開,但不會顯示

    case "logout" : //登出用,在user.php網址後加上?op=loguot
    $msg = logout();
    header("location:index.php");//注意前面不可以有輸出
    exit;

    case "login" :  //登入用
    $msg = login();
    header("location:index.php");//注意前面不可以有輸出
    exit;

    default:
    $op = "op_list";
    op_list();
    break;  //離開
}

/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('user.tpl');

/*---- 函數區-----*/
function logout() {
    $_SESSION['admin']="";
    setcookie("name", "" , time()- 3600 * 24 * 365); //登出後清除COOKIE
    setcookie("token", "" , time()- 3600 * 24 * 365); //登出後清除COOKIE
}

function xxx(){
    global $smarty;
    
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
        header("location:index.php");//所有動作需在頁面挑轉之前完成
    } else {
        header("location:user.php");
    }
    print_r($_POST); // 陣列也可用var_dump(內容顯示的比較多),但不能用echo
    die();
}

function op_list(){
    global $smarty;
}


/* ctrl+h取代 ctrl+f搜尋 */