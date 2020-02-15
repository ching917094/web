<div class="container mt-5" style="padding-top:50px">
    <h3 class="text-center">註冊表單</h3>
    
    <form action="index.php" method="post" id="myForm" class="mb-2" enctype="multipart/form-data"> <!--enctype傳檔案必用-->
    
    <div class="row">         
        <!--帳號-->              
        <div class="col-sm-6">
            <div class="form-group">
                <label>帳號<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="uname" id="uname" value="">
            </div>
        </div>         
        <!--密碼-->              
        <div class="col-sm-6">
            <div class="form-group">
                <label>密碼<span class="text-danger">*</span class="text-danger"></label>
                <input type="password" class="form-control" name="pass" id="pass" value="">
            </div>
        </div>         
        <!--確認密碼-->              
        <div class="col-sm-6">
            <div class="form-group">
                <label>確認密碼<span class="text-danger">*</span class="text-danger"></label>
                <input type="password" class="form-control" name="chk_pass" id="chk_pass" value="">
            </div>
        </div>         
        <!--姓名-->              
        <div class="col-sm-6">
            <div class="form-group">
                <label>姓名<span class="text-danger">*</span class="text-danger"></label>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
        </div>         
        <!--電話-->              
        <div class="col-sm-5">
            <div class="form-group">
                <label>電話<span class="text-danger">*</span class="text-danger"></label>
                <input type="text" class="form-control" name="tel" id="tel" value="">
            </div>
        </div>             
        <!--信箱-->              
        <div class="col-sm-7">
            <div class="form-group">
                <label>信箱<span class="text-danger">*</span class="text-danger"></label>
                <input type="text" class="form-control" name="email" id="email" value="">
            </div>
        </div> 
    </div>
        <div class="text-center pb-20">
            <input type="hidden" name="op" value="reg"> <!--代表送出表單了-->
            <button type="submit" class="btn btn-primary">送出</button>
        </div>
    </form>

<!-- 表單驗證 -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<style>
    .error{
        color: red;
    }
</style>
<!-- 調用函式 -->
<script>
    //`uname`, `pass`, `name`, `tel`, `email`
    $(function(){

    });

    $(function(){
        $("#myForm").validate({ //表單名
            submitHandler: function(form) {
                form.submit(); //form的物件,驗證後送出
            },
            rules: { //←屬性,↓物件,可以驗證很多東西
                'uname' : { //欄位名
                    required: true
                },
                'pass' : { //欄位名
                    required: true
                },
                'chk_pass' : {
                    equalTo:"#pass"
                },
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
                'uname' : {
                    required: "必填"
                },
                'pass' : {
                    required: "必填"
                },
                'chk_pass' : {
                    equalTo:"密碼不一致"
                },
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
    </script>

</div>