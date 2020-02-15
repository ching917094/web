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
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');  // sn序號,也可用id

/* 程式流程 */
switch ($op){
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
function reg_form(){
    global $smarty;
    
}
/*
#轉向函式
function redirect_header($url = "index.php" , $message = '訊息' , $time = 3000) {
    $_SESSION['redirect'] = true; //呼叫這個函式,表示真時,要轉頁
    $_SESSION['message'] = $message;
    $_SESSION['time'] = $time;
    header("location:{$url}"); // SESSION不會因轉頁,而消除紀錄,古前面用SESSION呼叫
}*/
#連結後臺資料庫
function op_list(){ 
    global $smarty,$db; //$db呼叫資料庫
    $sql = "SELECT *
            FROM `users`"; //SQL語法取得資源
    $result = $db->query($sql) or die($db->error() . $sql);//利用 $result 的各種取得資料方法，將資料一筆一筆取回
    $rows = []; //陣列
    //用迴圈來撈後台的資料
    while($row =  $result->fetch_assoc()) { //取出的資料陣列，是以欄位順序為陣列索引,一次一筆
        $row['uname'] = htmlspecialchars($row['uname']); //過濾成字串
        $row['uid'] =  (int)$row['uid']; //過濾成整數
        $row['kind'] =  (int)$row['kind']; //過濾成整數
        $row['name'] = htmlspecialchars($row['name']); //過濾成字串
        $row['tel'] = htmlspecialchars($row['tel']); //過濾成字串
        $row['email'] = htmlspecialchars($row['email']); //過濾成字串

        $rows[] = $row; //二維陣列
    }
    // print_r($rows);die();
    $smarty->assign("rows",$rows); //將抓到的變數送到smarty樣板裡面
}


/* ctrl+h取代 ctrl+f搜尋 */