<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-06 08:00:04
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e3bb97492db67_52015179',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7143c6296ce98e6f942fbdbc92a580961854cece' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\admin.tpl',
      1 => 1580968572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e3bb97492db67_52015179 (Smarty_Internal_Template $_smarty_tpl) {
?><h2 class="text-center mt-2">管理員後台</h2>
<div class="container">
    <div class="row">
        <div class="col-sm-9"></div>
        <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        管理員
                    </div>
                    <ul class="list-group list-group-flush">                                                 
                        <li class="list-group-item"> 
                            <a href="index.php" class="btn-block">首頁</a>   
                        </li>
                        <a href="user.php?op=logout" class="list-group-item">
                            <li style="list-style-type:none">登出</li>
                        </a>
                        <!-- 首頁/登出 全區域可點的兩種寫法 -->
                    </ul>
                </div>
        </div>
    </div>
</div><?php }
}
