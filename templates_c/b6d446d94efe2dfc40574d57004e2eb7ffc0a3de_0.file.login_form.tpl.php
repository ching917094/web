<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-13 09:39:24
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e450b3ce85773_87015475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6d446d94efe2dfc40574d57004e2eb7ffc0a3de' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\login_form.tpl',
      1 => 1581583158,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e450b3ce85773_87015475 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: 0 auto;
        }      
    </style>
    <div class="container mt-5">
        <form class="form-signin" action="user.php" method="post"><!--POST表單收訊息時隱藏訊息,GET為明碼顯示在網址後傳送-->
            <h1 class="h3 mb-3 font-weight-normal">會員登入</h1>
            <div class="mb-3">
                <label for="name" class="sr-only">帳號</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="請輸入帳號"  required>
            </div>
            <div class="mb-3">
                <label for="pass" class="sr-only">密碼</label>
                <input type="password" name="pass" id="pass" class="form-control" placeholder="請輸入密碼" required>
            </div>
            
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" id="remember"> 記住我
                </label>
                
            </div>
            <input type="hidden" name="op" id="op" value="login">
            <button class="btn btn-lg btn-primary btn-block" type="submit">會員登入</button>
            <div>
                您還沒還沒註冊嗎？請 <a href="user.php?op=reg_form">點選此處註冊您的新帳號</a>。
            </div>
        </form>
        <!-- <h2><?php echo $_smarty_tpl->tpl_vars['op']->value;?>
</h2> 用來檢視防止惡意攻擊有沒有成功,成功後不管打甚麼都是出現login_form -->
    </div>
    <div class="container mt-5">
        <h1 class="text-center">聯絡我們</h1>
        <!-- 表單返回頁，記得在表單加「 target='returnWin' 」 -->
        <iframe name="returnWin" style="display: none;" onload="this.onload=function(){window.location='<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
../googleform/ok.html'}"></iframe>
        <form target='returnWin' role="form" action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSfuu4A1egIRx7JBnv8Lh8VrqWXBVUeOanxxcdT59aWbwtdP4g/formResponse" method="post" id="myForm" >
            <div class="row">
                <!--姓名-->              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><span class="title">姓名</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="entry.2038120686" id="name" value="">
                        <!--type="number"限制他只能輸入數字 min=0限制數量不能小於0-->
                    </div>
                </div>          
                <!--電話-->              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><span class="title">電話</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="entry.984365608" id="tel" value="">
                        <!--type="number"限制他只能輸入數字 min=0限制數量不能小於0-->
                    </div>
                </div>          
                <!--email-->              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><span class="title">email</span><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="entry.168253913" id="email" value="">
                        <!--type="number"限制他只能輸入數字 min=0限制數量不能小於0-->
                    </div>
                </div>          
            </div>                 
            <div class="row">
                <div class="col-sm-12">  
                    <!-- 聯絡事項 -->
                    <div class="form-group">
                        <label class="control-label">聯絡事項</label>
                        <textarea class="form-control" rows="5" id="contact" name="entry.1599838118"></textarea>
                        <!--textarea表單元件,form-control拉到最寬+框線-->
                    </div>
                </div>
            </div>        
            <div class="text-center pb-3">
                <button type="submit" class="btn btn-primary">送出</button>
            </div>
        </form>
    </div><?php }
}
