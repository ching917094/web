<{if $op == "contact_form"}> <{*<!--判斷是否要去聯絡我們-->*}>
    <{include file="tpl/contact_form.tpl"}> <{*<!--是就顯示聯絡我們-->*}>

    <{elseif $op == "ok"}>
    <{include file="tpl/ok.tpl"}><{*<!--輸入聯絡事項後是就顯示OK頁-->*}>

    <{elseif $op == "login_form"}> 
    <{include file="tpl/login_form.tpl"}><{*<!--是就顯示登入表單-->*}>

    <{elseif $op == "reg_form"}> 
    <{include file="tpl/reg_form.tpl"}><{*<!--是就顯示註冊表單-->*}>

    <{else}><{*<!--否就顯示body-->*}>
    <{* 引入body.tpl中間 *}>
    <{include file="tpl/body.tpl"}>
<{/if}>