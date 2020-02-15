<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <title>會員管理</title>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<{$xoImgUrl}>bootstrap/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</head>
<body>
    <{*引入轉向樣板sweetalert2*}>
    <{include file="tpl/redirect.tpl"}>
    <h2 class="text-center mt-2">管理員後台</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <{if $WEB.file_name == "user.php"}>
                        <{include file="tpl/user.tpl"}> <{*引入表格*}>
                    <{/if}>
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
    
</html>