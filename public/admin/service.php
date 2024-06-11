<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
?>
<?php
if (isset($_POST['ThemChuyenMuc']) && $getUser['level'] == 'admin') {
    $LINH->insert("services", array(
        'service_name'     => check_string($_POST['service_name']),
        'service_type'   => check_string($_POST['service_type']),
        'price'   => check_string($_POST['price']),
        'display' => check_string($_POST['display'])
    ));
    msg_success_link('Thêm thành công', "", 1000);
}
if (isset($_POST['LuuChuyenMuc']) && $getUser['level'] == 'admin') {

    $LINH->update("services", array(
        'service_name'     => check_string($_POST['service_name']),
        'service_type'   => check_string($_POST['service_type']),
        'price'   => check_string($_POST['price']),
        'display' => check_string($_POST['display'])
    ), " `id` = '" . check_string($_POST['id']) . "' ");
    msg_success_link('Sửa thành công', "", 1000);
}
if (isset($_GET['d_id']) && $getUser['level'] == 'admin') {
    $id     = $_GET['d_id'];
    $delete = "DELETE FROM `services` WHERE id = '$id'";
    $result = $LINH->query($delete);
    if ($result) {
        msg_success_link('Xóa thành công', URL("public/admin/service.php"), 1000);
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DANH MỤC DỊCH VỤ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="service_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">API</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="service_type" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="price" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="display" required>
                                        <option value="SHOW">SHOW</option>
                                        <option value="HIDE">HIDE</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="ThemChuyenMuc" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" id="crawler-data" class="btn btn-success">
                                <span>Lấy dữ liệu API</span>
                            </button>
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
                                        <th>TÊN</th>
                                        <th>API</th>
                                        <th>GIÁ BÁN</th>
                                        <th>DISPLAY</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($LINH->get_list(" SELECT * FROM `services` ORDER BY id ASC ") as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['service_name']; ?></td>
                                            <td><?= $row['service_type']; ?></td>
                                            <td><?= format_cash($row['price']); ?> VNĐ</td>
                                            <td><?= $row['display'] == "SHOW"? "<span class='badge badge-success'>HIỂN THỊ</span>" : "<span class='badge badge-dark'>ẨN</span>" ?></td>
                                            <td>
                                                <button class="btn btn-primary btnEdit" data-display="<?= $row['display']; ?>" data-type="<?= $row['service_type']; ?>" data-rate="<?= $row['price']; ?>" data-name="<?= $row['service_name']; ?>" data-id="<?= $row['id']; ?>"><i class="fas fa-edit"></i>
                                                    <span>EDIT</span>
                                                </button>
                                                <a type="button" href="<?= URL('public/admin/service.php?delete=&d_id='); ?><?= $row['id']; ?>" class="btn btn-warning">
                                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                                    <span>DELETE</span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT DỊCH VỤ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tên dịch vụ</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="hidden" name="id" id="id" class="form-control" required>
                                <input type="text" name="service_name" id="service_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">API</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="service_type" id="service_type" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Giá dịch vụ</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="number" name="price" id="price" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Hiển thị</label>
                        <div class="col-sm-8">
                            <select class="form-control show-tick" id="display" name="display" required>
                                <option value="SHOW">SHOW</option>
                                <option value="HIDE">HIDE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="LuuChuyenMuc" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#crawler-data").on("click", function() {
        $('#crawler-data').html('Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "<?= URL("ajaxs/admin/get_data.php"); ?>",
            method: "POST",
            data: {
                type: 'craw',
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#crawler-data').html(
                        'Lấy dữ liệu API')
                    .prop('disabled', false);
            }
        });
    });
</script>
<!-- Modal -->
<script type="text/javascript">
    $('.btnEdit').on('click', function(e) {
        var btn = $(this);
        $("#service_name").val(btn.attr("data-name"));
        $("#service_type").val(btn.attr("data-type"));
        $("#price").val(btn.attr("data-rate"));
        $("#display").val(btn.attr("data-display"));
        $("#id").val(btn.attr("data-id"));
        $("#staticBackdrop").modal();
        return false;
    });
</script>
<?php
require_once("../../templates/admin/Footer.php");
?>