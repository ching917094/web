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
if($_SESSION['user']['kind'] !== 1)redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); //REQUEST 包含全部請求碼
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');  // sn為序號,也可用id

/* 程式流程 */
switch ($op){
    case "op_insert" :
        $msg = op_insert();    
        redirect_header("prod.php", $msg, 3000);
        exit;

    case "op_delete" :
        $msg = op_delete($sn);
        redirect_header("prod.php", $msg, 3000);
        exit;

    case "op_update" :
        $msg = op_insert($sn);
        redirect_header("prod.php", $msg, 3000);
        exit;

    case "op_form" :
        $msg = op_form($sn); //因要編輯故要填入要編輯的參數
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
function op_insert($sn=""){
    global $db;						 

    $_POST['sn'] = db_filter($_POST['sn'], '');//流水號
    $_POST['kind_sn'] = db_filter($_POST['kind_sn'], '');//類別
    $_POST['title'] = db_filter($_POST['title'], '標題');//標題
    $_POST['content'] = db_filter($_POST['content'], '');
    $_POST['price'] = db_filter($_POST['price'], '');
    $_POST['enable'] = db_filter($_POST['enable'], '');

    $_POST['date'] = db_filter($_POST['date'], '');
    $_POST['date'] = strtotime($_POST['date']);

    $_POST['sort'] = db_filter($_POST['sort'], '');  
    $_POST['counter'] = db_filter($_POST['counter'], '');

    if($sn){
        $sql="UPDATE  `prods` SET
                    `kind_sn` = '{$_POST['kind_sn']}',
                    `title` = '{$_POST['title']}',
                    `content` = '{$_POST['content']}',
                    `price` = '{$_POST['price']}',
                    `enable` = '{$_POST['enable']}',
                    `date` = '{$_POST['date']}',
                    `sort` = '{$_POST['sort']}',
                    `counter` = '{$_POST['counter']}'
                    WHERE `sn` = '{$_POST['sn']}'    
        ";
        $db->query($sql) or die($db->error() . $sql);
        $msg = "商品資料更新成功";
    }else{
        $sql="INSERT INTO `prods` 
        (`kind_sn`, `title`, `content`, `price`, `enable`, `date`, `sort`, `counter`)
        VALUES 
        ('{$_POST['kind_sn']}', '{$_POST['title']}', '{$_POST['content']}', '{$_POST['price']}', '{$_POST['enable']}', '{$_POST['date']}', '{$_POST['sort']}', '{$_POST['counter']}')    
        "; //die($sql);
        $db->query($sql) or die($db->error() . $sql);
        $sn = $db->insert_id;
        $msg = "商品資料新增成功";    

    }

    if($_FILES['prod']['name']){
        $kind = "prod";
        #刪除舊圖
        # 1.刪除實體檔案
        # 2.刪除files資料表
        delFilesByKindColsnSort($kind,$sn,1);
        
        if ($_FILES['prod']['error'] === UPLOAD_ERR_OK){
            
            $sub_dir = "/".$kind;
            $sort = 1;
            #過濾變數
            $_FILES['prod']['name'] = db_filter($_FILES['prod']['name'], '');
            $_FILES['prod']['type'] = db_filter($_FILES['prod']['type'], '');
            $_FILES['prod']['size'] = db_filter($_FILES['prod']['size'], '');
            #檢查資料目錄
            mk_dir(_WEB_PATH . "/uploads");
            mk_dir(_WEB_PATH . "/uploads" . $sub_dir);
            $path = _WEB_PATH . "/uploads" . $sub_dir . "/";
            #圖片名稱
            $rand = substr(md5(uniqid(mt_rand(), 1)), 0, 5);//取得一個5碼亂數
            
            #//取得上傳檔案的副檔名
            $ext = pathinfo($_FILES["prod"]["name"], PATHINFO_EXTENSION); 
            $ext = strtolower($ext);//轉小寫
            
            //判斷檔案種類
            if ($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "gif") {
                $file_kind = "img";
            } else {
                $file_kind = "file";
            }     

            $file_name = $rand . "_" . $sn . "." . $ext; 
            #圖片目錄

            # 將檔案移至指定位置
            if(move_uploaded_file($_FILES['prod']['tmp_name'], $path . $file_name)){
                $sql="INSERT INTO `files` 
                                (`kind`, `col_sn`, `sort`, `file_kind`, `file_name`, `file_type`, `file_size`, `description`, `counter`, `name`, `download_name`, `sub_dir`) 
                                VALUES 
                                ('{$kind}', '{$sn}', '{$sort}', '{$file_kind}', '{$_FILES['prod']['name']}', '{$_FILES['prod']['type']}', '{$_FILES['prod']['size']}', NULL, '0', '{$file_name}', '', '{$sub_dir}')
                
                ";
                $db->query($sql) or die($db->error() . $sql);

            }


        } else {
            die("圖片上傳失敗");
        }
    }

        return $msg;

}

function op_delete($sn){
    global $db; 
    #刪除舊圖
    # 1.刪除實體檔案
    # 2.刪除files資料表
    delFilesByKindColsnSort("prod",$sn,1);

    #刪除商品資料表
    $sql="DELETE FROM `prods`
        WHERE `sn` = '{$sn}'
    ";
    $db->query($sql) or die($db->error() . $sql);
    return "商品資料刪除成功";
}

/*================================
取得商品數量的最大值
================================*/
function getProdsMaxSort(){
    global $db;
    $sql = "SELECT count(*)+1 as count
            FROM `prods`
    ";//die($sql);

    $result = $db->query($sql) or die($db->error() . $sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

function op_form($sn=""){//參數打$sn=""代表可以不傳值,不傳為空,是新增一筆
    global $smarty,$db;

    if($sn){//勞資料出來,因是要編輯,故不可以經過過濾,沒有值就是新增
        $row = getProdsBySn($sn);
        $row['op'] = "op_update";
    }else{
        $row['op'] = "op_insert";
    }
    /* sn kind_sn title content	price enable date sort counter */
    $row['sn'] = isset($row['sn']) ? $row['sn'] : "";
    $row['kind_sn'] = isset($row['kind_sn']) ? $row['kind_sn'] : "1";//類別值
    $row['kind_sn_options'] = getProdsOptions("prod");

    $row['title'] = isset($row['title']) ? $row['title'] : "";
    $row['content'] = isset($row['content']) ? $row['content'] : "";
    $row['price'] = isset($row['price']) ? $row['price'] : "";
    $row['enable'] = isset($row['enable']) ? $row['enable'] : "1"; // 狀態預設給1,先啟用

    $row['date'] = isset($row['date']) ? $row['date'] : strtotime("now");// 日期
    $row['date'] = date("Y-m-d H:i:s",$row['date']);

    $row['sort'] = isset($row['sort']) ? $row['sort'] : getProdsMaxSort();// 排序
    $row['counter'] = isset($row['counter']) ? $row['counter'] : "";// 計數器,可以客戶要求先填入初始值
    
    $row['prod'] = isset($row['prod']) ? $row['prod'] : ""; //圖片預設值

    $smarty->assign("row",$row);//將抓到的變數送到smarty樣板裡面
}

#連結後臺資料庫
function op_list(){ 
    global $smarty,$db; //$db呼叫資料庫
    $sql = "SELECT a.*,b.title as kinds_title
            FROM `prods` as a 
            LEFT JOIN `kinds` as b on a.kind_sn=b.sn
            ORDER BY a.date desc
            "; //SQL語法取得資源,as取名為

    #---分頁套件(原始$sql 不要設 limit)
    include_once _WEB_PATH."/class/PageBar/PageBar.php";
    $pageCount = 5; //一頁幾筆
    $PageBar = getPageBar($db, $sql, $pageCount , 10);// ($db, $sql, $pageCount , 10→最多幾頁後面為...)
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total']; // 抓出來的總筆數
    $bar     = ($total > $pageCount) ? $PageBar['bar'] : ""; 
    $smarty->assign("bar",$bar);  
    #---分頁套件(end)

    $result = $db->query($sql) or die($db->error() . $sql);//利用 $result 的各種取得資料方法，將資料一筆一筆取回
    $rows = []; //陣列
    //用迴圈來撈後台的資料
    while($row =  $result->fetch_assoc()) { //取出的資料陣列，是以欄位順序為陣列索引,一次一筆
        $row['sn'] = (int)$row['sn'];//分類
        $row['title'] = htmlspecialchars($row['title']); //文字過濾成字串 標題
        $row['kind_sn'] =  (int)$row['kind_sn']; //數字過濾成整數 分類
        $row['price'] =  (int)$row['price']; //數字過濾成整數 價格
        $row['enable'] =  (int)$row['enable']; //數字過濾成整數 狀態
        $row['counter'] =  (int)$row['counter']; //數字過濾成整數 計數
        $row['prod'] = getFilesByKindColsnSort("prod",$row['sn']); //顯示圖片
        $row['kinds_title'] = htmlspecialchars($row['kinds_title']); //文字過濾成字串 標題
        
        $rows[] = $row; //二維陣列
    }
    // print_r($rows);die();
    $smarty->assign("rows",$rows); //將抓到的變數送到smarty樣板裡面
}
/* ctrl+h取代 ctrl+f搜尋 */