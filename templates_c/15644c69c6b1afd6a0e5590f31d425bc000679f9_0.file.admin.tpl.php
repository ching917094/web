<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-15 06:58:00
  from 'D:\PHP\xampp\htdocs\web\templates\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e478868629290_90333020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15644c69c6b1afd6a0e5590f31d425bc000679f9' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\admin.tpl',
      1 => 1581746146,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/redirect.tpl' => 1,
    'file:tpl/user.tpl' => 1,
  ),
),false)) {
function content_5e478868629290_90333020 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <title>會員管理</title>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"><?php echo '</script'; ?>
>

</head>
<body>
        <?php $_smarty_tpl->_subTemplateRender("file:tpl/redirect.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <h2 class="text-center mt-2">管理員後台</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <?php if ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "user.php") {?>
                        <?php $_smarty_tpl->_subTemplateRender("file:tpl/user.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>                     <?php }?>
                </div>
                <div class="col-sm-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header">
                                管理員
                            </div>
                            <ul class="list-group list-group-flush">                                                 
                                <li class="list-group-item"> 
                                    <a href="index.php" class="btn-block">首頁</a>   
                                </li>
                                <a href="index.php?op=logout" class="list-group-item">
                                    <li style="list-style-type:none">登出</li>
                                </a>
                                <a href="http://localhost/adminer/adminer.php" class="list-group-item" target="_blank">
                                    <li style="list-style-type:none">資料庫管理</li> <!--target="_blank"開新視窗-->
                                </a>
                                <!-- 首頁/登出 全區域可點的兩種寫法 -->
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    
</body>
    
</html><?php }
}
