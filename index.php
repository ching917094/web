<?php
require_once 'head.php';

$smarty->assign("a0", "關於我們");
$smarty->assign("a1", "服務項目");
$smarty->assign("a2", "產品目錄");
$smarty->assign("a3", "聯絡我們");

/*---- 程式結尾-----*/
$smarty->display('theme.tpl');

/* ctrl+h取代 ctrl+f搜尋 */