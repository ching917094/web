<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-05 16:04:43
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\contact_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e60b29b437817_03180522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '18a9dd963fee63d77bc65e3407c774bab0dc87bd' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\contact_form.tpl',
      1 => 1583395479,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e60b29b437817_03180522 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container mt-5" style="padding-top:50px">
        <h3 class="text-center">聯絡我們</h3>
        <form role="form" action="index.php" method="post" id="myForm" >
            <div class="row">
                <!--姓名-->              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><span class="title">姓名</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="">
                        <!--type="number"限制他只能輸入數字 min=0限制數量不能小於0-->
                    </div>
                </div>          
                <!--電話-->              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><span class="title">電話</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tel" id="tel" value="">
                        <!--type="number"限制他只能輸入數字 min=0限制數量不能小於0-->
                    </div>
                </div>          
                <!--email-->              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><span class="title">email</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" value="">
                        <!--type="number"限制他只能輸入數字 min=0限制數量不能小於0-->
                    </div>
                </div>          
            </div>                 
            <div class="row">
                <div class="col-sm-12">  
                    <!-- 聯絡事項 -->
                    <div class="form-group">
                        <label class="control-label">聯絡事項</label>
                        <textarea class="form-control" rows="5" id="content" name="content"></textarea>
                        <!--textarea表單元件,form-control拉到最寬+框線-->
                    </div>
                </div>
            </div>        
            <div class="text-center pb-3">
                <input type="hidden" name="op" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['op'];?>
">
                <button type="submit" class="btn btn-primary">送出</button>
            </div>
        </form>
</div>
<!-- 表單驗證 -->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"><?php echo '</script'; ?>
>
<style>
    .error{
        color: red;
    }
</style>
<!-- 調用函式 -->
<?php echo '<script'; ?>
>
    //`uname`, `pass`, `name`, `tel`, `email`
    $(function(){

    });

    $(function(){
        $("#myForm").validate({ //表單名
            submitHandler: function(form) {
                form.submit(); //form的物件,驗證後送出
            },
            rules: { //←屬性,↓物件,可以驗證很多東西
                'name' : { //欄位名
                    required: true
                },
                'tel' : { //欄位名
                    required: true
                },                
                'email' : { //欄位名
                    required: true,
                    email: true
                },
            },
            messages: {
                'name' : {
                    required: "必填"
                },
                'tel' : {
                    required: "必填"
                },               
                'email' : {
                    required: "必填",
                    email : "email格式不正確"
                },
            }
        });
    });
<?php echo '</script'; ?>
>
<?php }
}
