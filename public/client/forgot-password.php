<?php
  require_once("../../config/config.php");
  require_once("../../config/function.php");
  require_once("../../templates/client/Header.php");
  require_once("../../templates/client/Nav.php");
?>
<div class="container py-5" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2 style="color: #7e30e1">Bạn quên mật khẩu?</h2>
                        <p>Vui lòng nhập thông tin vào ô dưới đây để xác minh</p>
                    </div>
                    <div class="user-form-group">        
                        <form class="user-form" method="POST">
                            <div class="form-group">
                              <input type="email" id="email" class="form-control" placeholder="Vui lòng nhập địa chỉ Email">
                            </div>
                            <div class="form-button"><button type="button" id="btnForgotPassword">Xác minh</button></div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>Bạn đã có tài khoản ? <a href="<?=URL('public/client/login.php'); ?>">Đăng Nhập Ngay</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btnForgotPassword").on("click", function() {
        $('#btnForgotPassword').html('ĐANG XỬ LÝ').prop('disabled',true);
            $.ajax({
                url: "<?=URL("ajaxs/client/forgot-password.php");?>",
                method: "POST",
                data: {
                    type: 'forgot',
                    email: $("#email").val(),
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('#btnForgotPassword').html(
                            'Xác minh')
                        .prop('disabled', false);
                }
            });
        });
    </script>
<?php
  require_once("../../templates/client/Footer.php");
?>