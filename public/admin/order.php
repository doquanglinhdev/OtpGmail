<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/admin/Header.php");
require_once("../../templates/admin/Sidebar.php");
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 2000;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$customers = $LINH->get_list("SELECT * FROM `rentals` ORDER BY `created_at` DESC LIMIT $start, $limit");
$custCount = $LINH->get_list("SELECT count(id) AS id FROM rentals");

$total = $custCount[0]['id'];
$pages = ceil($total / $limit);

$Previous = $page - 1;
$Next = $page + 1;

?>
<style>
    .hidden-full-text {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 150px;
    }
    .hidden-full-text-acc {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 200px;
    }
    .dataTables_wrapper .dataTables_length select {
        padding-right: 2.5rem;
        font-size: 15px;
    }
</style>

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
                        <h3 class="card-title">DANH SÁCH ĐƠN HÀNG</h3>
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
                            <table id="example2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TYPE</th>
                                        <th>ACCOUNT</th>
                                        <th>CODE</th>
                                        <th>FULL TEXT</th>
                                        <th>GIÁ BÁN</th>
                                        <th>TIME CREATE</th>
                                        <th>TIME DONE</th>
                                        <th>STATUS</th>
                                        <th>USERNAME</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($customers as $otp) {
                                    ?>
                                        <tr>
                                            <td><?= $otp['id']; ?></td>
                                            <td><?= $otp['service_type']; ?></td>
                                            <td><div class="hidden-full-text-acc"><?= $otp['account']; ?></div></td>
                                            <td><?= $otp['code']; ?></td>
                                            <td class="hidden-full-text"><?= $otp['full_text']; ?></td>
                                            <td><?= $otp['price_sell']; ?></td>
                                            <td><span class="badge badge-dark"><?= $otp['created_at'] ?></span></td>
                                            <td><span class="badge badge-dark"><?= isset($otp['done_at']) == 0 ? "" : $otp['done_at'] ?></span></td>
                                            <td><?= status_otp($otp['status']); ?></td>
                                            <td><?= $otp['username']; ?></td>
                                            <td><?php if ($otp['status'] == 'pending') {
                                                    echo "<button class='btn btn-danger' onclick='Linh(" . $otp['id'] . ")'><i class='fas fa-edit'></i></button>";
                                                } ?></td>
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
    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [4], // Cột chứa full text, vị trí bắt đầu từ 0
                    "render": function(data, type, row, meta) {
                        // Ẩn nội dung bằng cách thêm class hidden-full-text
                        return '<div class="hidden-full-text">' + data + '</div>';
                    }
                }]

            });
            $('#example2 tbody').on('mouseenter', 'td div.hidden-full-text', function() {
                $(this).css('overflow', 'visible');
                $(this).css('white-space', 'normal');
                $(this).css('text-overflow', 'inherit');
            });

            // Bắt sự kiện khi di chuột ra khỏi cột
            $('#example2 tbody').on('mouseleave', 'td div.hidden-full-text', function() {
                $(this).css('overflow', 'hidden');
                $(this).css('white-space', 'nowrap');
                $(this).css('text-overflow', 'ellipsis');
            });
            
            $('#example2 tbody').on('mouseenter', 'td div.hidden-full-text-acc', function() {
                $(this).css('overflow', 'visible');
                $(this).css('white-space', 'normal');
                $(this).css('text-overflow', 'inherit');
            });

            // Bắt sự kiện khi di chuột ra khỏi cột
            $('#example2 tbody').on('mouseleave', 'td div.hidden-full-text-acc', function() {
                $(this).css('overflow', 'hidden');
                $(this).css('white-space', 'nowrap');
                $(this).css('text-overflow', 'ellipsis');
            });
        });

        function Linh(id) {
            if (id !== "") {
                $.ajax({
                    url: '<?= URL('ajaxs/client/cancel-otp.php'); ?>',
                    method: 'POST',
                    data: {
                        action: 'cancel_otp',
                        id: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            new Notify({
                                status: "success",
                                title: "Thành công",
                                text: response.msg,
                                effect: "slide",
                                speed: 100,
                                customClass: "",
                                customIcon: "",
                                showIcon: true,
                                showCloseButton: true,
                                autoclose: true,
                                autotimeout: 1000,
                                notificationsGap: null,
                                notificationsPadding: null,
                                type: "outline",
                                position: "right top",
                                customWrapper: ""
                            });
                            fetchDataAndInitializeTable(); // Gọi lại để cập nhật bảng
                        } else {
                            new Notify({
                                status: "error",
                                title: "Thất bại",
                                text: response.msg,
                                effect: "slide",
                                speed: 100,
                                customClass: "",
                                customIcon: "",
                                showIcon: true,
                                showCloseButton: true,
                                autoclose: true,
                                autotimeout: 1000,
                                notificationsGap: null,
                                notificationsPadding: null,
                                type: "outline",
                                position: "right top",
                                customWrapper: ""
                            });
                        }
                    },
                });
            }
        }
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