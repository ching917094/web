<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-15 07:22:59
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e478e43293a92_14360651',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b100a52dce4b33a6fe39fb167049862d19ce0db' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\user.tpl',
      1 => 1581747415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e478e43293a92_14360651 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['op']->value == "op_list") {?> <table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th scope="col">帳號</th>
            <th scope="col">姓名</th>
            <th scope="col">電話</th>
            <th scope="col">EMAIL</th>
            <th scope="col">狀態</th>
            <th scope="col">功能</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['uname'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['tel'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['kind'];?>
</td>
                <td></td>
            </tr>
        <?php
}
} else {
?>
            <tr>
                <td colspan="20">目前沒有資料</td> <!--colspan="?" ?為要顯示幾筆表單資料-->
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>        
    </tbody>
</table>
<?php }
}
}
