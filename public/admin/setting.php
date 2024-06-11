<?php
  require_once("../../config/config.php");
  require_once("../../config/function.php");
  require_once("../../templates/admin/Header.php");
  require_once("../../templates/admin/Sidebar.php");
?>
<?php
if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin')
{
    foreach ($_POST as $key => $value)
    {
        $LINH->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success_link('Lưu thành công',"", 500);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH THÔNG TIN WEBSITE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                    <input type="text" name="tenweb" class="form-control"
                                            value="<?=$LINH->site('tenweb');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                    <input type="text" name="mota" class="form-control"
                                            value="<?=$LINH->site('mota');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Từ khóa tìm kiếm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                    <input type="text" name="tukhoa" class="form-control"
                                            value="<?=$LINH->site('tukhoa');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hotline</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                    <input type="text" name="hotline" class="form-control"
                                            value="<?=$LINH->site('hotline');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Facebook</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                    <input type="text" name="facebook" class="form-control"
                                            value="<?=$LINH->site('facebook');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Zalo Admin</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="zalo_admin" class="form-control"
                                            placeholder="Nhập Zalo Admin" value="<?=$LINH->site('zalo_admin');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SMTP Gmail [<a href="#" target="_blank">HƯỚNG
                                        DẪN</a>]</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Nhập địa chỉ Gmail" value="<?=$LINH->site('email');?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="pass_email" class="form-control"
                                            placeholder="Nhập mật khẩu Gmail" value="<?=$LINH->site('pass_email');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Website</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="baotri" required>
                                        <option <?=$LINH->site('baotri') == "ON" ? 'selected' : '';?> value="ON">ON
                                        </option>
                                        <option <?=$LINH->site('baotri') == "OFF" ? 'selected' : '';?> value="OFF">
                                            OFF
                                        </option>
                                    </select>
                                    <i>Nếu bạn OFF, website sẽ bật chế độ bảo trì.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông báo</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="thongbao"
                                            rows="6"><?=$LINH->site('thongbao');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông báo ở trang chủ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="thongbao_index"
                                            rows="6"><?=$LINH->site('thongbao_index');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">HTML-JS Footer</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" rows="10"
                                            style="background-color: #000;color:#00d230;" name="html_footer"
                                            placeholder="Chèn code js hoặc đoạn code bất kỳ"
                                            rows="6"><?=$LINH->site('html_footer');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
  require_once("../../templates/admin/Footer.php");
?>
