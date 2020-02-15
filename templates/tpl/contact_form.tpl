<div class="container mt-5" style="padding-top:50px">
        <h3 class="text-center">聯絡我們</h3>
        <!-- 表單返回頁，記得在表單加「 target='returnWin' 」 -->
        <iframe name="returnWin" style="display: none;" onload="this.onload=function(){window.location='index.php?op=ok'}"></iframe>
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
</div>
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
                'entry.2038120686' : { //欄位名
                    required: true
                },
                'entry.984365608' : { //欄位名
                    required: true
                },                
                'entry.168253913' : { //欄位名
                    required: true,
                    email: true
                },
            },
            messages: {
                'entry.2038120686' : {
                    required: "必填"
                },
                'entry.984365608' : {
                    required: "必填"
                },               
                'entry.168253913' : {
                    required: "必填",
                    email : "email格式不正確"
                },
            }
        });
    });
    </script>
