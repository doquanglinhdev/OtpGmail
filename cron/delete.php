<?php
// Tải cấu hình và các hàm cần thiết
require("../config/config.php");
require("../config/function.php");

// Lấy danh sách tài khoản hoạt động
$delete = "DELETE FROM `accounts` WHERE active = 0";
$result = $LINH->query($delete);

echo "xóa thành công";