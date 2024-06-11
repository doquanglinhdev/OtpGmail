<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 2000;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$customers = $LINH->get_list("SELECT * FROM `accounts` ORDER BY `created_at` DESC LIMIT $start, $limit");
$custCount = $LINH->get_list("SELECT count(id) AS id FROM accounts");

$total = $custCount[0]['id'];
$pages = ceil($total / $limit);

$Previous = $page - 1;
$Next = $page + 1;
if (isset($_POST['LuuChuyenMuc']) && $getUser['level'] == 'admin') {

    $LINH->update("accounts", array(
        'account'     => check_string($_POST['account']),
        'service_type'   => check_string($_POST['service_type']),
        'active'   => check_string($_POST['active']),
    ), " `id` = '" . check_string($_POST['id']) . "' ");
    msg_success_link('Sửa thành công', "", 1000);
}

if (isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin') {
    $id = rand(123456789, 999999999);
    $LINH->insert("accounts", array(
        'id_order'     => $id,
        'account'     => check_string($_POST['account']),
        'service_type'   => check_string($_POST['service_type']),
        'active'   => 1,
    ));
    msg_success_link('Lưu thành công', "", 500);
}

if (isset($_GET['d_id']) && $getUser['level'] == 'admin') {
    $id     = $_GET['d_id'];
    $delete = "DELETE FROM `accounts` WHERE id = '$id'";
    $result = $LINH->query($delete);
    if ($result) {
        msg_success_link('Xóa thành công', URL("public/admin/accounts.php"), 1000);
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM GMAIL</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">ACCOUNTS</label>
                                    <div class="col-sm-8">
                                        <div class="form-line">
                                            <input type="text" name="account" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">SERVICES TYPE</label>
                                    <div class="col-sm-8">
                                        <div class="form-line">
                                            <select name="service_type" class="form-control" required>
                                                <?php foreach ($LINH->get_list("SELECT * FROM `services`") as $serviestype) : ?>
                                                    <option value="<?= $serviestype['service_type'] ?>"><?= $serviestype['service_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">ACTIVE</label>
                                    <div class="col-sm-8">
                                        <select class="form-control show-tick" name="active" required>
                                            <option value="1">SELL</option>
                                            <option value="0">NOT SELL</option>
                                        </select>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH TÀI KHOẢN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10" class="text-center" style="margin-top: 20px; margin-left: 20px;">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li>
                                        <a class="page-link" href="order.php?page=<?= $Previous; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo; Previous</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li><a class="page-link" href="order.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php endfor; ?>
                                    <li>
                                        <a class="page-link" href="order.php?page=<?= $Next; ?>" aria-label="Next">
                                            <span aria-hidden="true">Next &raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="text-center" style="margin-top: 20px; " class="col-md-2">
                            <form method="post" action="#">
                                <select class="custom-select" name="limit-records" id="limit-records">
                                    <option disabled="disabled" selected="selected">---Limit Records---</option>
                                    <?php foreach ([1000, 3000, 5000] as $limit) : ?>
                                        <option <?php if (isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID ORDER</th>
                                        <th>ACCOUNT</th>
                                        <th>SERVICES TYPE</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>TIME CREATE</th>
                                        <th>HÀNH ĐỘNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($customers as $otp) {
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $otp['id_order']; ?></td>
                                            <td><?= $otp['account']; ?></td>
                                            <td><?= $otp['service_type']; ?></td>
                                            <td><?= $otp['active'] == 1 ? "<span class='badge badge-success'>Sell</span>" : "<span class='badge badge-danger'>Not Sell</span>" ?></td>
                                            <td><span class="badge badge-dark"><?= $otp['created_at'] ?></span></td>
                                            <td>
                                                <button class="btn btn-primary btnEdit" data-service_type="<?= $otp['service_type']; ?>" data-active="<?= $otp['active']; ?>" data-account="<?= $otp['account']; ?>" data-id_order="<?= $otp['id_order']; ?>" data-id="<?= $otp['id']; ?>"><i class="fas fa-edit"></i>
                                                    <span>EDIT</span>
                                                </button>
                                                <a type="button" href="<?= URL('public/admin/accounts.php?delete=&d_id='); ?><?= $otp['id']; ?>" class="btn btn-warning">
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
                            <label class="col-sm-4 col-form-label">ID ORDER</label>
                            <div class="col-sm-8">
                                <div class="form-line">
                                    <input type="hidden" name="id" id="id" class="form-control" readonly>
                                    <input type="text" name="id_order" id="id_order" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ACCOUNTS</label>
                            <div class="col-sm-8">
                                <div class="form-line">
                                    <input type="text" name="account" id="account" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">SERVICES TYPE</label>
                            <div class="col-sm-8">
                                <select name="service_type" id="service_type" class="form-control" required>
                                    <?php foreach ($LINH->get_list("SELECT * FROM `services`") as $serviestype) : ?>
                                        <option value="<?= $serviestype['service_type'] ?>"><?= $serviestype['service_name'] ?></option>
                                    <?php endforeach ?>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ACTIVE</label>
                            <div class="col-sm-8">
                                <select class="form-control show-tick" id="active" name="active" required>
                                    <option value="1">SELL</option>
                                    <option value="0">NOT SELL</option>
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
    <script type="text/javascript">
        $('.btnEdit').on('click', function(e) {
            var btn = $(this);
            $("#id").val(btn.attr("data-id"));
            $("#id_order").val(btn.attr("data-id_order"));
            $("#account").val(btn.attr("data-account"));
            $("#service_type").val(btn.attr("data-service_type"));
            $("#active").val(btn.attr("data-active"));
            $("#staticBackdrop").modal();
            return false;
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#limit-records").change(function() {
                $('form').submit();
            })
        })
    </script>
    <!-- /.content -->
</div>
<?php
require_once("../../templates/admin/Footer.php");
?>