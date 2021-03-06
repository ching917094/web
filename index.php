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

    case "checkUname" :
        echo json_encode(checkUname());
        exit;
        
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

    case "contact_insert" :
        $msg = contact_insert();
        redirect_header("index.php", $msg , 5000);
        exit;

    default: //網址後面亂輸入的人會跑這,用來防止惡意攻擊
        $op = "op_list";
        $_SESSION['returnUrl'] = getCurrentUrl();
        $mainSlides = getMenus("mainSlide",true);
        $smarty->assign("mainSlides", $mainSlides);
        op_list();
        # 取得商品資料(含圖)
        break;  //離開
}

/*---- 將變數送至樣版----*/
$mainMenus = getMenus("mainMenu");
$smarty->assign("mainMenus", $mainMenus);
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

/* ctrl+h取代 ctrl+f搜尋 */
// print_r ($_COOKIE);die(); 用來檢查記住我的登入資料有沒有記錄到


/*---- 程式結尾-----*/
$smarty->display('theme.tpl');

/*------函數區-----*/
/*####################################################
AJAX 檢查帳號是否重覆
驗證不過 => false ， 驗證通過 => true
####################################################*/
function checkUname() {
    global $db;
    $uname = system_CleanVars($_REQUEST, 'uname', '', 'string');

    if(check_uname($uname)){
        return false;//帳號有人使用，驗證不過
    }
    return true;
}

/*=======================
檢查帳號是否有人使用
有人使用 傳回 true
無人使用 傳回 false
=======================*/
function check_uname($uname){
    global $db;
    $sql="SELECT count(*) as count
        FROM `users`
        WHERE `uname`='{$uname}'
    ";    
    $result = $db->query($sql) or die($db->error() . $sql);
    $row = $result->fetch_assoc();

    if($row['count'])return true;
    return false;  
}

function op_list(){
    global $db,$smarty;
    
    $sql = "SELECT a.*,b.title as kinds_title
            FROM `prods` as a
            LEFT JOIN `kinds` as b on a.kind_sn=b.sn
            WHERE a.`enable`='1'
            ORDER BY a.`date` desc
            LIMIT 6;
    ";//die($sql);

    $result = $db->query($sql) or die($db->error() . $sql);
    $rows=[];//array();
    while($row = $result->fetch_assoc()){    
        $row['sn'] = (int)$row['sn'];//分類
        $row['title'] = htmlspecialchars($row['title']);//標題 
        $row['prod'] = getFilesByKindColsnSort("prod",$row['sn']);
        $row['kinds_title'] = htmlspecialchars($row['kinds_title']);//標題
        $rows[] = $row;
    }
    $smarty->assign("prods",$rows); 
}

function contact_insert() {
    global $db;
    $_POST['name'] = db_filter($_POST['name'], 'name');
    $_POST['tel'] = db_filter($_POST['tel'], 'tel');
    $_POST['email'] = db_filter($_POST['email'], 'email');
    $_POST['content'] = db_filter($_POST['content'], 'content');
    $_POST['date'] = strtotime("now");
    
    $sql="INSERT INTO `contacts` 
                        (`name`, `tel`, `email`, `content`, `date`)
                        VALUES 
                        ('{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['content']}', '{$_POST['date']}')  
    ";
    $result = $db->query($sql) or die($db->error() . $sql);
    return "我們已收到您的聯絡事項，將儘快與您聯絡！";
}

function contact_form() {
    global $smarty;
    $row['op'] = "contact_insert";
    $smarty->assign("row", $row);
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
    #檢查帳號是否重覆
    if(check_uname($_POST['uname'])){
        redirect_header("index.php?op=reg_form","帳號已有人使用");
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
    global $db;
    $_POST['uname'] = db_filter($_POST['uname'], '帳號');// 過濾變數
    $_POST['pass'] = db_filter($_POST['pass'], '密碼');

    $sql = "SELECT *
            FROM `users`
            WHERE `uname` = '{$_POST['uname']}'
    ";
    $result = $db->query($sql) or die($db->error() . $sql); //送資料出去執行
    $row = $result->fetch_assoc() or redirect_header ("index.php?op=login_form" , '帳號輸入錯誤' , 3000);
    
     //取出的資料陣列，是以欄位順序為陣列索引,一次一筆
    $row['uname'] = htmlspecialchars($row['uname']);//字串
    $row['uid'] = (int)$row['uid'];//整數
    $row['kind'] = (int)$row['kind'];//整數
    $row['name'] = htmlspecialchars($row['name']);//字串
    $row['tel'] = htmlspecialchars($row['tel']);//字串
    $row['email'] = htmlspecialchars($row['email']);//字串 
    $row['pass'] = htmlspecialchars($row['pass']);//字串 
    $row['token'] = htmlspecialchars($row['token']);//字串
    
    if(password_verify($_POST['pass'], $row['pass'])){ //$_POST['pass']外傳得值, $row['pass']資料庫的值
        //登入成功,↓將資料寫進會員資料中
        $_SESSION['user']['uid'] = $row['uid'];
        $_SESSION['user']['uname'] = $row['uname'];
        $_SESSION['user']['name'] = $row['name'];
        $_SESSION['user']['tel'] = $row['tel'];
        $_SESSION['user']['email'] = $row['email'];
        $_SESSION['user']['kind'] = $row['kind']; //$_SESSION['user']['kind'] 等於smarty的 $smarty.session.admin
        
        $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : ""; //是否記住密碼的判斷式
        if($_POST['remember']){//如果選要記住
            setcookie("uname",$row['uname'], time()+ 3600 * 24 * 365); //time()+3600 * 24 * 365 記住多久,此為一年
            setcookie("token", $row['token'], time()+ 3600 * 24 * 365); 
        }
        redirect_header ("index.php" , '登入成功' , 3000);         
    } else{    //↓抓取資料失敗,值一律清空
        $_SESSION['user']['uid'] = "";
        $_SESSION['user']['uname'] = "";
        $_SESSION['user']['name'] = "";
        $_SESSION['user']['tel'] = "";
        $_SESSION['user']['email'] = "";
        $_SESSION['user']['kind'] = "";
        redirect_header ("index.php?op=login_form" , '登入失敗' , 3000); 
    }
    //print_r($_POST);die();  陣列也可用var_dump(內容顯示的比較多),但不能用echo
}
function logout() {
    $_SESSION['user']['uid'] = "";
    $_SESSION['user']['uname'] = "";
    $_SESSION['user']['name'] = "";
    $_SESSION['user']['tel'] = "";
    $_SESSION['user']['email'] = "";
    $_SESSION['user']['kind'] = "";
    setcookie("uname", "", time()- 3600 * 24 * 365); //登出後清除COOKIE
    setcookie("token", "", time()- 3600 * 24 * 365);//登出後清除COOKIE
    // print_r($_SESSION); die();
}