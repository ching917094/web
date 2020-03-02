<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link href="<{$xoImgUrl}>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <title><{$WEB.web_title}></title>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<{$xoImgUrl}>bootstrap/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</head>
<body>
    <{*引入轉向樣板sweetalert2*}>
    <{include file="tpl/redirect.tpl"}>
    <h2 class="text-center mt-2"><{$WEB.web_title}></h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <{if $WEB.file_name == "user.php"}>
                        <{include file="tpl/user.tpl"}> <{*引入會員管理表格*}>
                    <{elseif $WEB.file_name == "prod.php"}>
                        <{include file="tpl/prod.tpl"}> <{*引入商品管理表格*}>
                    <{elseif  $WEB.file_name == "kind.php"}>
                        <{include file="tpl/kind.tpl"}> <{*引入類別管理表格*}>
                    <{elseif  $WEB.file_name == "menu.php"}>
                        <{include file="tpl/menu.tpl"}> <{*引入選單管理表格*}>
                    <{elseif  $WEB.file_name == "slide.php"}>
                        <{include file="tpl/slide.tpl"}> <{*引入輪播圖管理表格*}>
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
                                <a href="user.php" class="list-group-item">
                                    <li style="list-style-type:none">會員管理</li>
                                </a>
                                <a href="prod.php" class="list-group-item">
                                    <li style="list-style-type:none">商品管理</li>
                                </a>
                                <a href="kind.php" class="list-group-item">
                                    <li style="list-style-type:none">類別管理</li>
                                </a>
                                <a href="menu.php" class="list-group-item">
                                    <li style="list-style-type:none">選單管理</li>
                                </a>
                                <a href="slide.php" class="list-group-item">
                                    <li style="list-style-type:none">輪播圖管理</li>
                                </a>
                                <a href="http://localhost/adminer/adminer.php" class="list-group-item" target="_blank">
                                    <li style="list-style-type:none">資料庫管理</li> <!--target="_blank"開新視窗-->
                                </a>
                                <a href="index.php?op=logout" class="list-group-item">
                                    <li style="list-style-type:none">登出</li>
                                </a>
                                <!-- 首頁/登出 全區域可點的兩種寫法 -->
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    
</body>
    
</html>