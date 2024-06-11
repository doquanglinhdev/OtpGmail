<?php
require("../../config/config.php");
require("../../config/function.php");
    if (!isset($_POST['action']) || $_POST['action'] !== 'totalPayment_Spin') {
        echo json_encode(array('status' => 'error', 'message' => 'Không đủ dữ liệu.'));
        exit;
    }
    if(isset($_POST['action']) && $_POST['action'] === 'totalPayment_Spin'){
        $amount = $_POST['amount'];
        $type = $_POST['type'];
        $row = $LINH->get_row("SELECT * FROM `services` WHERE `type` = '$type'");
        if (!$row) {
            echo json_encode(array('status' => 'error', 'message' => 'Không tìm thấy dịch vụ.'));
            exit;
        }
        $price = $row['rate'] +  $LINH->site('price_plus');
        $pay = $amount * $price;
        $pay_format = format_cash($pay);
        echo json_encode(array('status' => 'success', 'pay' => $pay_format));
        exit;
    }
?>
