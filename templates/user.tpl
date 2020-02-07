<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        
        <title>會員管理</title>
    </head>
    <body>
    <{if $smarty.session.admin}> <!-- $smarty.session(smarty變數).admin(連結到自己取的變數名稱) -->
        <!--是管理員時顯示-->    
        <{include file="tpl/admin.tpl"}>
    <{else}> 
        <!--不是管理員時顯示-->
        <{if $op=="login_form"}> <!--跑登入畫面-->
            <{include file="tpl/login_form.tpl"}> <!--include file引入檔案,將登入畫面檔案login.tpl引入-->
        <{elseif $op=="reg_form"}> <!--如果未註冊,去註冊畫面-->
            <{include file="tpl/reg_form.tpl"}>
        <{/if}>
    <{/if}>
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<{$xoImgUrl}>bootstrap/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="<{$xoImgUrl}>bootstrap/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="<{$xoImgUrl}>bootstrap/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
    
</html>