<{if $op == "op_list"}> <{*判斷是否為op_list再決定要不要跑表格*}>
<table class="table table-striped table-bordered table-hover table-sm">
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
        <{foreach $rows as $row}>
            <tr>
                <td><{$row.uname}></td>
                <td><{$row.name}></td>
                <td><{$row.tel}></td>
                <td><{$row.email}></td>
                <td><{$row.kind}></td>
                <td></td>
            </tr>
        <{foreachelse}>
            <tr>
                <td colspan="20">目前沒有資料</td> <!--colspan="?" ?為要顯示幾筆表單資料-->
            </tr>
        <{/foreach}>        
    </tbody>
</table>
<{/if}>