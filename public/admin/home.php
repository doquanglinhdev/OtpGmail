<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 3000;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$customers = $LINH->get_list("SELECT * FROM `cash_flow` ORDER BY id DESC LIMIT $start, $limit");
$custCount = $LINH->get_list("SELECT count(id) AS id FROM rentals");

$total = $custCount[0]['id'];
$pages = ceil($total / $limit);

$Previous = $page - 1;
$Next = $page + 1;

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG THÀNH VIÊN</span>
                        <span class="info-box-number"><?= $LINH->num_rows("SELECT * FROM `users` "); ?></span>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa-solid fa-money-bill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG SỐ DƯ THÀNH VIÊN</span>
                        <span class="info-box-number"><?= format_cash($LINH->get_row("SELECT SUM(`money`) FROM `users` ")['SUM(`money`)']); ?>đ</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa-solid fa-money-bill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG CHI PHÍ GMAIL</span>
                        <span class="info-box-number"><?= number_format($LINH->site('sodu_api')); ?>đ</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa-solid fa-money-bill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG DEVICES HOẠT ĐỘNG</span>
                        <span class="info-box-number"><?= $LINH->num_rows('SELECT * FROM `key_devices`') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa-solid fa-money-bill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG LUỒNG CÓ THỂ CHẠY</span>
                        <span class="info-box-number"><?= number_format($LINH->get_row("SELECT SUM(`flow`) FROM `key_devices`")['SUM(`flow`)']) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa-solid fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG OTP ĐANG CHỜ CODE</span>
                        <span class="info-box-number"><?= number_format($LINH->num_rows(" SELECT * FROM `rentals` WHERE `status` = 'pending' ")) ?></span>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa-solid fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG OTP THÀNH CÔNG</span>
                        <span class="info-box-number"><?= number_format((int)$LINH->num_rows("SELECT * FROM `rentals` WHERE `status` = 'success'")); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa-solid fa-ban"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG THẤT BẠI</span>
                        <span class="info-box-number"><?= number_format($LINH->num_rows(" SELECT * FROM `rentals` WHERE `status` = 'cancel' ")) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa-solid fa-layer-group"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG OTP ĐÃ THUÊ</span>
                        <span class="info-box-number"><?= number_format($LINH->num_rows(" SELECT * FROM `rentals` ")) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa-solid fa-chart-simple"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">DOANH THU</span>
                        <span class="info-box-number"><?=  number_format($LINH->get_row("SELECT SUM(`price_sell`) FROM `rentals` WHERE `status` = 'success'")['SUM(`price_sell`)']) ?> đ</span>
                    </div>
                </div>
            </div>
                        <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa-solid fa-chart-simple"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">LỢI NHUẬN THỰC</span>
                        <span class="info-box-number"><?=  number_format($LINH->get_row("SELECT SUM(`price_sell`) FROM rentals INNER JOIN users ON rentals.username = users.username WHERE `level` = 'user' AND `status` = 'success'")['SUM(`price_sell`)'] - $LINH->site('sodu_api')) ?> đ</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa-solid fa-chart-simple"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TỔNG OTP CÒN KHO</span>
                        <span class="info-box-number"><?=  number_format($LINH->num_rows("SELECT * FROM `accounts` WHERE `active` = '1'")) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">NHẬT KÝ DÒNG TIỀN GẦN ĐÂY</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10" style="margin-top: 20px; margin-left: 20px; ">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li>
                                        <a class="page-link" href="home.php?page=<?= $Previous; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo; Previous</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li><a class="page-link" href="home.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php endfor; ?>
                                    <li>
                                        <a class="page-link" href="home.php?page=<?= $Next; ?>" aria-label="Next">
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
                                        <th>USERNAME</th>
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
                                    foreach ($customers as $row) {
                                        $username = $LINH->getIdUser($row['user_id']);
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><a href="<?= URL('public/admin/edit-user.php?edit='); ?><?= $row['user_id']; ?>"><?= $username['username']; ?></a></td>
                                            <td><?= format_cash($row['cash_old']); ?></td>
                                            <td><?= format_cash($row['cash_change']); ?></td>
                                            <td><?= format_cash($row['cash_new']); ?></td>
                                            <td><span class="badge badge-dark"><?= $row['cash_time']; ?></span></td>
                                            <td><?= $row['cash_note']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
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
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#limit-records").change(function() {
                        $('form').submit();
                    })
                })
            </script>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php
require_once("../../templates/admin/Footer.php");
?>