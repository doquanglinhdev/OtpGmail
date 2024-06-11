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
                    <h1>Ngân hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH BANK AUTO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Nạp tiền qua bank</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_napbank" required>
                                        <option <?=$LINH->site('status_napbank') == "ON" ? 'selected' : '';?> value="ON">ON
                                        </option>
                                        <option <?=$LINH->site('status_napbank') == "OFF" ? 'selected' : '';?> value="OFF">
                                            OFF
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TOKEN API.SIEUTHICODE.NET</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="token_bank" value="<?=$LINH->site('token_bank');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">STK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="stk" value="<?=$LINH->site('stk');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CHỦ TK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name_bank" value="<?= $LINH->site('name_bank'); ?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NGÂN HÀNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="bank" value="<?=  $LINH->site('bank') ;?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <p>Hướng dẫn kết nối: <a href="https://api.dichvudark.vn/Auth/faq" target="_blank">Xem Ngay</a></p>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nội dung nạp tiền</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="noidung_naptien"
                                            value="<?=$LINH->site('noidung_naptien');?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lưu ý nạp ngân hàng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="luuy_napbank" rows="6">
                                        <?=$LINH->site('luuy_napbank');?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chiết khấu khuyến mãi</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ck_bank"
                                            placeholder="Khuyến mãi thêm bao nhiêu % khi nạp tiền qua ngân hàng"
                                            value="<?=$LINH->site('ck_bank');?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LỊCH SỬ NẠP BANK AUTO</h3>
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
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>MÃ GD</th>
                                        <th>MONEY</th>
                                        <th>NỘI DUNG</th>
                                        <th>THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($LINH->get_list("SELECT * FROM `bank_auto` ORDER BY id DESC") as $banks) { 
                                        $row = $LINH->get_row("SELECT * FROM `users` WHERE id = '".$banks['user_id']."'");
                                    ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><a href="<?=URL('public/admin/edit-user.php?edit=')?><?=$row['id'];?>"><?=$row['username'];?></a></td>
                                        <td><?=$banks['refNo'];?></td>
                                        <td><?=format_cash($banks['money_real']);?></td>
                                        <td><?=$banks['description'];?></td>
                                        <td><?=$banks['transactionDate'];?></td>
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
