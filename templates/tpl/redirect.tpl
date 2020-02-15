    <{*轉向樣板sweetalert2*}>
    <{if $redirect}> <!--如果有傳送值才啟用這個效果-->
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<{$xoAppUrl}>class/sweetalert2/sweetalert2.min.css">
    <script src="<{$xoAppUrl}>class/sweetalert2/sweetalert2.min.js"></script>
    <script>
        window.onload = function() {
            Swal.fire({
            // position: 'top-end', 顯示在右上
            icon: 'success',
            title: "<{$message}>",
            showConfirmButton: false, // 不顯示確認按鈕
            timer: '<{$time}>' // 秒數到了自動消失
            })
        }
    </script>
    <{/if}>