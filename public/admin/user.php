<?php
  require_once("../../config/config.php");
  require_once("../../config/function.php");
  require_once("../../templates/admin/Header.php");
  require_once("../../templates/admin/Sidebar.php");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH THÀNH VIÊN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>USERNAME</th>
                                        <th>SỐ DƯ</th>
                                        <th>TỔNG NẠP</th>
                                        <th>NGÀY TẠO</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                    foreach($LINH->get_list(" SELECT * FROM `users` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$row['id'];;?></td>
                                        <td><?=$row['username'];?></td>
                                        <td><?=format_cash($row['money']);?> VNĐ</td>
                                        <td><?=format_cash($row['money_total']);?> VNĐ</td>
                                        <td><span class="badge badge-success"><?=$row['created_at'];?></span></td>
                                        <td>
                                            <a type="button" href="<?=URL('public/admin/edit-user.php?edit=');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>EDIT</span></a>
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
    </section>
</div>
<?php
  require_once("../../templates/admin/Footer.php");
?>
