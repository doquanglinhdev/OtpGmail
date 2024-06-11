<?php
  require("../../config/config.php");
  require("../../config/function.php");
  require("../../templates/client/Header.php");
  require("../../templates/client/Nav.php");
?>
<?php
if(isset($_GET['token']))
{
    $row = $LINH->get_row(" SELECT * FROM `users` WHERE `token` = '".check_string($_GET['token'])."'  ");
    if(!$row)
    {
        msg_error_link('Người dùng này không tồn tại',URL(''), 2000);
    }
}
else
{
    msg_error_link('Liên kết không tồn tại',URL(''), 2000);
}
?>
<div class="container py-5" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2 style="color: #7e30e1">Đặt lại mật khẩu</h2>
                        <p>Vui lòng nhập thông tin khôi phục</p>
                    </div>
                    <div class="user-form-group">        
                        <form class="user-form">
                            <div class="form-group">
                                <input type="password" id="password_new" class="form-control" placeholder="Vui lòng nhập mật khẩu mới" >
                            </div>
                            <div class="form-group">
                                <input type="password" id="password_new_repeat" class="form-control" placeholder="Vui lòng nhập lại mật khẩu">
                            </div>
                            <div class="form-button">
                            <button type="button" id="btnKhoiPhuc">Đặt lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#btnKhoiPhuc").on("click", function() {
            $('#btnKhoiPhuc').html('Đang xử lý...').prop('disabled',
                true);
            let password_new = $("#password_new").val();
            let password_new_repeat = $("#password_new_repeat").val();
            const urlString = window.location.href;
            const url = new URL(urlString);
            const token = url.searchParams.get('token');
            $.ajax({
                url: "<?=URL("ajaxs/client/reset-password.php");?>",
                method: "POST",
                data: {
                    type: 'reset',
                    password_new: password_new,
                    password_new_repeat: password_new_repeat,
                    token: token
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('#btnKhoiPhuc').html(
                            'Đặt lại')
                        .prop('disabled', false);
                }
            });
        });
    </script>
<?php
  require("../../templates/client/Footer.php");
?>