<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 03:43:33
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\redirect.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e4609554cb597_44629902',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72b51c9e75194b903a04f10eba3c042331987385' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\redirect.tpl',
      1 => 1581648208,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e4609554cb597_44629902 (Smarty_Internal_Template $_smarty_tpl) {
?>        <?php if ($_smarty_tpl->tpl_vars['redirect']->value) {?> <!--如果有傳送值才啟用這個效果-->
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.css">
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        window.onload = function() {
            Swal.fire({
            // position: 'top-end', 顯示在右上
            icon: 'success',
            title: "<?php echo $_smarty_tpl->tpl_vars['message']->value;?>
",
            showConfirmButton: false, // 不顯示確認按鈕
            timer: '<?php echo $_smarty_tpl->tpl_vars['time']->value;?>
' // 秒數到了自動消失
            })
        }
    <?php echo '</script'; ?>
>
    <?php }
}
}
