<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 03:43:33
  from 'D:\PHP\xampp\htdocs\web\templates\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e460955392111_98429685',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc9985d4bb488142f1a312e108dbac6e9dd57a36' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\user.tpl',
      1 => 1581648185,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/redirect.tpl' => 1,
    'file:tpl/admin.tpl' => 1,
    'file:tpl/login_form.tpl' => 1,
    'file:tpl/reg_form.tpl' => 1,
  ),
),false)) {
function content_5e460955392111_98429685 (Smarty_Internal_Template $_smarty_tpl) {
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

        <?php if ($_SESSION['admin']) {?> <!-- $smarty.session(smarty變數).admin(連結到自己取的變數名稱) -->
            <!--是管理員時顯示-->    
            <?php $_smarty_tpl->_subTemplateRender("file:tpl/admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <!--引入語法-->
        <?php } else { ?> 
            <!--不是管理員時顯示-->
            <?php if ($_smarty_tpl->tpl_vars['op']->value == "login_form") {?> <!--跑登入畫面-->
                <?php $_smarty_tpl->_subTemplateRender("file:tpl/login_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <!--include file引入檔案,將登入畫面檔案login.tpl引入-->
            <?php } elseif ($_smarty_tpl->tpl_vars['op']->value == "reg_form") {?> <!--如果未註冊,去註冊畫面-->
                <?php $_smarty_tpl->_subTemplateRender("file:tpl/reg_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php }?>
        <?php }?>
        
        
        
    </body>
    
</html><?php }
}
