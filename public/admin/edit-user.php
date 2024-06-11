<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
?>
<?php
if (isset($_GET['edit']) && $getUser['level'] == 'admin') {
  $row = $LINH->get_row(" SELECT * FROM `users` WHERE `id` = '" . check_string($_GET['edit']) . "'  ");
  $otp = $LINH->get_list(" SELECT * FROM `rentals` WHERE `username` = '" . check_string($row['username']) . "'  ");
  $otpSUCCESS = $LINH->num_rows(" SELECT * FROM `rentals` WHERE `status` = 'success' AND `username` = '" . check_string($row['username']) . "'  ");
  $otpERROR = $LINH->num_rows(" SELECT * FROM `rentals` WHERE `status` = 'canceled' AND `username` = '" . check_string($row['username']) . "'  ");

  if (!$row) {
    msg_error_link('Người dùng này không tồn tại', URL('public/admin/user.php'), 2000);
  }
} else {
  msg_error_link('Liên kết không tồn tại', URL(''), 2000);
}
if (isset($_POST['btnSaveUser']) && isset($_GET['edit']) && $getUser['level'] == 'admin') {
  $token    = check_string($_POST['token']);
  $money    = check_string($_POST['money']);
  $level    = check_string($_POST['level']);
  $banned    = check_string($_POST['banned']);
  if ($row['money'] != $money) {
    $LINH->insert("cash_flow", array(
      'cash_old'   => $row['money'],
      'cash_change' => $money,
      'cash_new'     => $money,
      'cash_time'      => gettime(),
      'cash_note'       => 'ADMIN thay đổi số dư',
      'user_id'      => $_GET['edit']
    ));
  }
  $LINH->update("users", array(
    'token'         => $token,
    'money'         => $money,
    'level'         => $level,
    'banned'         => $banned,
  ), " `id` = '" . $row['id'] . "' ");
  msg_success_link('Thay thông tin người dùng thành công', "", 1000);
}
if (isset($_POST['btnCongTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin') {
  $value  = check_string($_POST['value']);
  $ghichu = check_string($_POST['ghichu']);
  if ($value <= 0) {
    msg_error_link("Vui lòng nhập số tiền hợp lệ", "", 2000);
  }
  $create = $LINH->insert("cash_flow", [
    'cash_old'   => $row['money'],
    'cash_change' => $value,
    'cash_new'     => $row['money'] + $value,
    'cash_time'      => gettime(),
    'cash_note'       => 'Admin cộng tiền (' . $ghichu . ')',
    'user_id'      => $_GET['edit']
  ]);
  if ($create) {
    $LINH->cong("users", "money", $value, " `username` = '" . $row['username'] . "' ");
    msg_success_link('Cộng tiền thành công!', "", 1500);
  } else {
    msg_error_link("Vui lòng liên hệ Linh", "", 1200);
  }
}

if (isset($_POST['btnTruTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin') {
  $value  = check_string($_POST['value']);
  $ghichu = check_string($_POST['ghichu']);
  if ($value <= 0) {
    msg_error_link("Vui lòng nhập số tiền hợp lệ", "", 2000);
  }
  $create = $LINH->insert("cash_flow", [
    'cash_old'   => $row['money'],
    'cash_change' => $value,
    'cash_new'     => $row['money'] - $value,
    'cash_time'      => gettime(),
    'cash_note'       => 'Admin trừ tiền (' . $ghichu . ')',
    'user_id'      => $_GET['edit']
  ]);
  if ($create) {
    $LINH->tru("users", "money", $value, " `username` = '" . $row['username'] . "' ");
    msg_success_link('Trừ tiền thành công!', "", 1500);
  } else {
    msg_error_link("Vui lòng liên hệ Linh", "", 1200);
  }
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chỉnh sửa thành viên</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">CHỈNH SỬA THÀNH VIÊN</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" id="inputEmail3" value="<?= $row['username']; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" name="password" value="<?= $row['password']; ?>" readonly>
                  </div>
                </div>
              </div>
              <input type="hidden" class="form-control" id="inputEmail3" value="<?= $row['username']; ?>" name="username" required>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Token</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" name="token" readonly value="<?= $row['token']; ?>">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Số dư</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="number" class="form-control" id="inputPassword3" name="money" value="<?= $row['money']; ?>" required>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Cấp độ</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" name="level" value="<?= $row['level']; ?>" placeholder="Cấp quyền admin thì ghi: admin">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">BANNED</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" name="banned" value="<?= $row['banned']; ?>">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày đăng ký</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" id="inputEmail3" value="<?= $row['create_date']; ?>" disabled>
                  </div>
                </div>
              </div>
              <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                <span>LƯU</span>
              </button>
              <a type="button" href="<?= URL('public/admin/user.php'); ?>" class="btn btn-danger btn-block waves-effect">
                <span>TRỞ LẠI</span>
              </a>
            </form>
          </div>
        </div>
      </div>


      <div class="col-md-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">THỐNG KÊ</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">TỔNG OPT THUÊ</label>
              <div class="col-sm-10">
                <div class="form-line">
                  <input type="text" class="form-control" id="inputEmail3" value="<?= count($otp) ?>" disabled>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">TỔNG OTP HOÀN THÀNH</label>
              <div class="col-sm-10">
                <div class="form-line">
                  <input type="text" class="form-control" name="password" value="<?= $otpSUCCESS ?>" readonly>
                </div>
              </div>
            </div>
            <input type="hidden" class="form-control" id="inputEmail3" value="<?= $row['username']; ?>" name="username" required>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">TỔNG OTP THẤT BẠI</label>
              <div class="col-sm-10">
                <div class="form-line">
                  <input type="text" class="form-control" name="token" readonly value="<?= $otpERROR ?>">
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h3 class="card-title">CỘNG TIỀN</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền cộng</label>
                <div class="col-sm-8">
                  <div class="form-line">
                    <input type="number" class="form-control" name="value" required>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                <div class="col-sm-8">
                  <div class="form-line">
                    <textarea class="form-control" name="ghichu" rows="3" placeholder="Nhập ghi chú cộng tiền nếu có"></textarea>
                  </div>
                </div>
              </div>
              <button type="submit" name="btnCongTien" class="btn btn-primary btn-block waves-effect">
                <span>XÁC NHẬN</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-outline card-danger">
          <div class="card-header">
            <h3 class="card-title">TRỪ TIỀN</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền trừ</label>
                <div class="col-sm-8">
                  <div class="form-line">
                    <input type="number" class="form-control" name="value" required>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                <div class="col-sm-8">
                  <div class="form-line">
                    <textarea class="form-control" name="ghichu" rows="3" placeholder="Nhập ghi chú trừ tiền nếu có"></textarea>
                  </div>
                </div>
              </div>
              <button type="submit" name="btnTruTien" class="btn btn-primary btn-block waves-effect">
                <span>XÁC NHẬN</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">DÒNG TIỀN</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>SỐ TIỀN TRƯỚC</th>
                    <th>SỐ TIỀN THAY ĐỔI</th>
                    <th>SỐ TIỀN HIỆN TẠI</th>
                    <th>THỜI GIAN</th>
                    <th>NỘI DUNG</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($LINH->get_list(" SELECT * FROM `cash_flow` WHERE `user_id` = '" . $_GET['edit'] . "' ORDER BY id ASC ") as $row) {
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= format_cash($row['cash_old']); ?></td>
                      <td><?= format_cash($row['cash_change']); ?></td>
                      <td><?= format_cash($row['cash_new']); ?></td>
                      <td><span class="badge badge-success px-3"><?= $row['cash_time']; ?></span></td>
                      <td><?= $row['cash_note']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>SỐ TIỀN TRƯỚC</th>
                    <th>SỐ TIỀN THAY ĐỔI</th>
                    <th>SỐ TIỀN HIỆN TẠI</th>
                    <th>THỜI GIAN</th>
                    <th>NỘI DUNG</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
require_once("../../templates/admin/Footer.php");
?>