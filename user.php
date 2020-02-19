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
/* 管理員判斷式,不是管理員一律直接轉走 */ 
if(!$_SESSION['admin'])redirect_header ("index.php" , '您沒有權限' , 3000); 

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); //REQUEST 包含全部請求碼
$uid = system_CleanVars($_REQUEST, 'uid', '', 'int');  // sn為序號,也可用id

/* 程式流程 */
switch ($op){
    case "op_update" :
        $msg = op_update($uid);    
        redirect_header("user.php", $msg, 3000);
        exit;

    case "op_form" :
        $msg = op_form($uid); //因要編輯故要填入要編輯的參數
        break;

    default: //網址後面亂輸入的人會跑這,用來防止惡意攻擊
        $op = "op_list";
        op_list();
        break;  //離開
}

/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);

/*---- 程式結尾-----*/
$smarty->display('admin.tpl');

/*---- 函數區-----*/
function op_update($uid=""){ 
    global $db;
    // ↓過濾變數
    $_POST['uname'] = db_filter($_POST['uname'], '帳號');
    $_POST['pass'] = db_filter($_POST['pass'], '');
    $_POST['name'] = db_filter($_POST['name'], '姓名');
    $_POST['tel'] = db_filter($_POST['tel'], '電話');
    $_POST['email'] = db_filter($_POST['email'], 'email',FILTER_SANITIZE_EMAIL);
    $_POST['kind'] = db_filter($_POST['kind'], '會員狀態');

    $and_col = "";
    if($_POST['pass']) {
        $_POST['pass']  = password_hash($_POST['pass'], PASSWORD_DEFAULT); //加密
        // 更新密碼
        $and_col = "`pass` = '{$_POST['pass']}',";        
    }
    $sql = "UPDATE `users` SET
            `uname` = '{$_POST['uname']}',
            {$and_col}
            `name` = '{$_POST['name']}',
            `tel` = '{$_POST['tel']}',
            `email` = '{$_POST['email']}',
            `kind` = '{$_POST['kind']}'
            WHERE `uid` = '{$uid}';
            ";    
    $db->query($sql) or die($db->error() . $sql);//執行上面的語法,如有錯誤將印出
    return "會員資料更新成功";
}

function op_form($uid=""){ //參數打$uid=""代表可以不傳值,不傳為空,是新增一筆
    global $smarty,$db;

    if($uid){  //勞資料出來,因是要編輯,故不可以經過過濾,沒有值就是新增
      $sql="SELECT *
            FROM `users`
            WHERE `uid` = '{$uid}'
        ";//die($sql);
        
        $result = $db->query($sql) or die($db->error() . $sql);//利用 $result 的各種取得資料方法，將資料一筆一筆取回
        $row = $result->fetch_assoc(); 
    }
    $row['uid'] = isset($row['uid']) ? $row['uid'] : "";
    $row['uname'] = isset($row['uname']) ? $row['uname'] : "";
    $row['name'] = isset($row['name']) ? $row['name'] : "";
    $row['tel'] = isset($row['tel']) ? $row['tel'] : "";
    $row['email'] = isset($row['email']) ? $row['email'] : "";
    $row['kind'] = isset($row['kind']) ? $row['kind'] : "0";

    $smarty->assign("row",$row);//將抓到的變數送到smarty樣板裡面
}
#連結後臺資料庫
function op_list(){ 
    global $smarty,$db; //$db呼叫資料庫
    $sql = "SELECT *
            FROM `users`"; //SQL語法取得資源
    $result = $db->query($sql) or die($db->error() . $sql);//利用 $result 的各種取得資料方法，將資料一筆一筆取回
    $rows = []; //陣列
    //用迴圈來撈後台的資料
    while($row =  $result->fetch_assoc()) { //取出的資料陣列，是以欄位順序為陣列索引,一次一筆
        $row['uname'] = htmlspecialchars($row['uname']); //文字過濾成字串
        $row['uid'] =  (int)$row['uid']; //數字過濾成整數
        $row['kind'] =  (int)$row['kind']; //數字過濾成整數
        $row['name'] = htmlspecialchars($row['name']); //文字過濾成字串
        $row['tel'] = htmlspecialchars($row['tel']); //文字過濾成字串
        $row['email'] = htmlspecialchars($row['email']); //文字過濾成字串

        $rows[] = $row; //二維陣列
    }
    // print_r($rows);die();
    $smarty->assign("rows",$rows); //將抓到的變數送到smarty樣板裡面
}


/* ctrl+h取代 ctrl+f搜尋 */