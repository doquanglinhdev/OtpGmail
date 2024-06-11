<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
?>
<?php
if (isset($_POST['ThemChuyenMuc']) && $getUser['level'] == 'admin') {
    $LINH->insert("key_devices", array(
        'name_pc'     => check_string($_POST['name_pc']),
        'type'   => check_string($_POST['type']),
        'flow'   => check_string($_POST['flow']),
    ));
    msg_success_link('Thêm thành công', "", 1000);
}
if (isset($_POST['LuuChuyenMuc']) && $getUser['level'] == 'admin') {

    $LINH->update("key_devices", array(
        'name_pc'     => check_string($_POST['name_pc']),
        'type'   => check_string($_POST['type']),
        'flow'   => check_string($_POST['flow']),
    ), " `id` = '" . check_string($_POST['id']) . "' ");
    msg_success_link('Sửa thành công', "", 1000);
}
if (isset($_GET['d_id']) && $getUser['level'] == 'admin') {
    $id     = $_GET['d_id'];
    $delete = "DELETE FROM `key_devices` WHERE id = '$id'";
    $result = $LINH->query($delete);
    if ($result) {
        msg_success_link('Xóa thành công', URL("public/admin/devices.php"), 1000);
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DANH MỤC DEVICES</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DEVICES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NAME DEVICES</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name_pc" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">KEY API</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="type" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">LUỒNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="flow" class="form-control" required>
                                    </div>
                                    <small>Nếu đã đủ full luồng mọi máy thì hệ thống tự phân thêm luồng</small>

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

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>NAME DEVICES</th>
                                        <th>KEY API</th>
                                        <th>LUỒNG</th>
                                        <th>ĐANG CHẠY</th>
                                        <th>TIME CREATE</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($LINH->get_list(" SELECT * FROM `key_devices` ORDER BY id ASC ") as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['name_pc']; ?></td>
                                            <td><?= $row['type']; ?></td>
                                            <td><?= $row['flow']; ?></td>
                                            <td><?= $LINH->num_rows("SELECT * FROM `rentals` WHERE `status` ='pending' AND `pc_type` = '".$row['type']."' ") ?></td>
                                            <td><?= $row['created_at']; ?></td>
                                            <td>
                                                <button class="btn btn-primary btnEdit" data-type="<?= $row['type']; ?>" data-flow="<?= $row['flow']; ?>" data-name="<?= $row['name_pc']; ?>" data-id="<?= $row['id']; ?>"><i class="fas fa-edit"></i>
                                                    <span>EDIT</span>
                                                </button>
                                                <a type="button" href="<?= URL('public/admin/devices.php?delete=&d_id='); ?><?= $row['id']; ?>" class="btn btn-warning">
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
                        <label class="col-sm-4 col-form-label">NAME DEVICE</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="hidden" name="id" id="id" class="form-control" required>
                                <input type="text" name="name_pc" id="name_pc" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">API</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="type" id="type" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">LUỒNG</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="number" name="flow" id="flow" class="form-control" required>
                            </div>
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
<!-- Modal -->
<script type="text/javascript">
    $('.btnEdit').on('click', function(e) {
        var btn = $(this);
        $("#name_pc").val(btn.attr("data-name"));
        $("#type").val(btn.attr("data-type"));
        $("#flow").val(btn.attr("data-flow"));
        $("#id").val(btn.attr("data-id"));
        $("#staticBackdrop").modal();
        return false;
    });
</script>
<?php
require_once("../../templates/admin/Footer.php");
?>