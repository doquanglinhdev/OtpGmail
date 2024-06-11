<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
?>
<?php
if (isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin') {
    foreach ($_POST as $key => $value) {
        $LINH->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success_link('Lưu thành công', "", 500);
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
                        <h3 class="card-title">CẤU HÌNH API WEBSITE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">API GMAIL [<a href="" target="_blank">TẠI ĐÂY</a>]</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="api_otp" class="form-control" value="<?= $LINH->site('api_otp'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SERVIES API:</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="service_id" class="form-control" value="<?= $LINH->site('service_id'); ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TĂNG GIÁ DỊCH VỤ SO VỚI API</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="price_plus" class="form-control" value="<?= $LINH->site('price_plus'); ?>">
                                    </div>
                                </div>
                            </div> -->

                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Xem số dư website api</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="submit" id="crawler" class="btn btn-primary mb-3">
                            <span>CHECK</span>
                        </button>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SỐ DƯ CỦA BẠN</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" class="form-control" value="<?= $LINH->site('sodu_api'); ?>" id="sodu" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
</div>
<script>
    $("#crawler").on("click", function() {
        $('#crawler').html('Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "<?= URL("ajaxs/admin/get_banace.php"); ?>",
            success: function(response) {
                $("#thongbao").html(response);
                $('#crawler').html(
                        'Lấy dữ liệu API')
                    .prop('disabled', false);
            }
        });
    });
</script>
<?php
require_once("../../templates/admin/Footer.php");
?>