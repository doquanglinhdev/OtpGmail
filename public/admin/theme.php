<?php
  require_once("../../config/config.php");
  require_once("../../config/function.php");
  require_once("../../templates/admin/Header.php");
  require_once("../../templates/admin/Sidebar.php");
?>
<?php
// $LINH = new LINH();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SaveSettings'])) {
    $uploadDirectory = '../../assets/img/theme/';
    $uploadedFiles = [];
    $errors = [];
    foreach ($_FILES as $inputName => $file) {
        $fileName = $_FILES[$inputName]['name'];
        $fileTmpName = $_FILES[$inputName]['tmp_name'];
        if (!empty($fileName)) {
            $targetFilePath = $uploadDirectory . basename($fileName);
            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                // Lưu tên file vào mảng $uploadedFiles
                $uploadedFiles[$inputName] = basename($fileName);
            } else {
                $errors[] = "Có lỗi xảy ra khi tải lên file $fileName";
            }
        }
    }
    if (!empty($uploadedFiles)) {
        foreach ($uploadedFiles as $inputName => $fileName) {
            $key = $inputName;
            $value = $fileName;
            // Thực hiện truy vấn chèn hoặc cập nhật dữ liệu vào CSDL
            $check_query = "SELECT COUNT(*) as count FROM options WHERE `key`='$key'";
            $result = $LINH->query($check_query);
            $data = $result->fetch_assoc();
            if ($data['count'] > 0) {
                // Nếu key đã tồn tại, thực hiện truy vấn UPDATE
                $update_query = "UPDATE options SET `value`='$value' WHERE `key`='$key'";
                $update_result = $LINH->query($update_query);
                if (!$update_result) {
                    $errors[] = "Lỗi khi cập nhật dữ liệu";
                }
            } else {
                // Nếu key chưa tồn tại, thực hiện truy vấn INSERT
                $insert_query = "INSERT INTO options (`key`, `value`) VALUES ('$key', '$value')";
                $insert_result = $LINH->query($insert_query);
                if (!$insert_result) {
                    $errors[] = "Lỗi khi chèn dữ liệu vào CSDL";
                }
            }
        }
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            msg_error_not_link($error, 5000);
        }
    } else {
        msg_success_link('Cập nhật thành công', "", 500);
    }
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
                        <h3 class="card-title">
                            <i class="fas fa-image mr-1"></i>
                            THAY ĐỔI GIAO DIỆN WEBSITE
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="200px" src="<?=URL('assets/img/theme/')?><?=$LINH->site('logo');?>"/>
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Favicon</label>
                                            <input type="file" class="form-control" name="favicon">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="50px" src="<?=URL('assets/img/theme/')?><?=$LINH->site('favicon');?>" />
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Ảnh mô tả website</label>
                                            <input type="file" class="form-control" name="anhmota">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="300px" src="<?=URL('assets/img/theme/')?><?=$LINH->site('anhmota');?>" />
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
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