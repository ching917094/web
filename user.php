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
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');  // sn序號,也可用id

/* 程式流程 */
switch ($op){
    case "xxx" :
    $msg = xxx();
    header("location:index.php");//header("location:index.php")為轉向,注意前面不可以有echo輸出
    exit; // 同等die();離開,但不會顯示

    case "login" :
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
function xxx(){
    global $smarty;
    
}
function login(){
    global $smarty;
    $name = "admin";
    $pass = "111111";
    if($name == $_POST['name'] and $pass == $_POST['pass']){
        $_SESSION['admin'] = true;
        header("location:index.php");//注意前面不可以有輸出
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