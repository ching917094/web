<?php
/*
檔案名稱：password_hash.php
*/
$pwd = "123456"; //變數的值
$hash = password_hash($pwd, PASSWORD_DEFAULT);//變數加密
$md5 = md5($pwd); //加密方式

echo "------------------ hash -----------------";
echo "<br>";
echo $hash;
echo "<br>";
if (password_verify($pwd, $hash)) { //用加密後的值判斷密碼,每次加密出來的值都不同,用來驗證
    echo "密碼正確(hash)";
}
echo "<br>";
echo "------------------ md5 -----------------";
echo "<br>";
echo $md5;