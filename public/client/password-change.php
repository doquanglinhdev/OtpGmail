<?php
  require_once("../../config/config.php");
  require_once("../../config/function.php");
  require_once("../../templates/client/Header.php");
  require_once("../../templates/client/Nav.php");
  CheckLogin();
?>
<?php
  require_once("../../templates/client/Sidebar.php");
?>
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="LINH-card">
                <h4 class="account-title">Thay đổi mật khẩu</h4>
                <div class="account-content">
                  <p class="mb-3 text-muted">
                    Thay đổi mật khẩu đăng nhập của bạn là một cách dễ dàng để giữ an toàn cho tài khoản của bạn. </p>
                  <div class="row">
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password"
                          name="dm-profile-edit-password">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password-new"
                          name="dm-profile-edit-password-new">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group"><label class="form-label">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password-new-confirm"
                          name="dm-profile-edit-password-new-confirm">
                      </div>
                    </div>
                    <center>
                      <button class="form-btn" id="btnChangePasswordProfile" type="button">Cập Nhật</button>
                    </center>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <script>
        $("#btnChangePasswordProfile").on("click", function() {
            $('#btnChangePasswordProfile').html('Đang xử lý...').prop('disabled',
                true);
            let password = $("#dm-profile-edit-password").val();
            let password_new = $("#dm-profile-edit-password-new").val();
            let password_new_confirm = $("#dm-profile-edit-password-new-confirm").val();
            $.ajax({
                url: "<?=URL("ajaxs/client/password-change.php");?>",
                method: "POST",
                data: {
                    type: 'ChangePassword',
                    password: password,
                    password_new: password_new,
                    password_new_confirm: password_new_confirm
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('#btnChangePasswordProfile').html(
                            'Cập Nhật')
                        .prop('disabled', false);
                }
            });
        });
    </script>
</section>
<?php
  require_once("../../templates/client/Footer.php");
?>