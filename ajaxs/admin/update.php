<?php
require("../../config/config.php");
require("../../config/function.php");
require __DIR__ . '/../../vendor/autoload.php';

// Read JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Check if necessary fields are set
if (isset($data['id']) && isset($data['code']) && isset($data['status']) && isset($data['full_text'])) {

    $id = check_string($data['id']);
    $code = check_string($data['code']);
    $status = check_string($data['status']);
    $full_text = isset($data['full_text']) ? check_string($data['full_text']) : '';

    $getRentals = $LINH->get_row("SELECT * FROM `rentals` WHERE `id` = '$id'");
    if ($getRentals) {
        if ($status !== 'pending') {
            $LINH->update("rentals", array(
                'status'     => $status,
                'code'   => $code,
                'full_text'   => $full_text,
                'done_at'   => gettime(),
            ), " `id` = '" . $id . "' ");

            if ($status == 'cancel' || $status == 'die') {
                $price_refund = $getRentals['price_sell'];

                $getusers = $getRentals['username'];
                $checkuser = $LINH->get_row("SELECT * FROM `users` WHERE `username` = '$getusers'");

                $LINH->cong("users", "money", $price_refund, " `id` = '" . $checkuser['id'] . "' ");
                $LINH->insert("cash_flow", array(
                    'cash_old' => $checkuser['money'],
                    'cash_change' => $price_refund,
                    'cash_new' => $checkuser['money'] + $price_refund,
                    'cash_time' => gettime(),
                    'cash_note' => 'Hoàn tiền mail (' . strtolower(explode('|', $getRentals['account'])[0]) . ')',
                    'user_id' => $checkuser['id']
                ));
                if($status == 'cancel'){
                    $LINH->update("accounts", array(
                        'active'     => 1,
                    ), " `service_type` = '" . $getRentals['service_type'] . "' AND `account` = '" . $getRentals['account'] . "' ");
                }

            }
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '3f445aa654bdfac71f01',
                '19877d2f05b0775108ff',
                '1693867',
                $options
            );
            $data['message'] = 'Thành công!';
            $pusher->trigger('my-otpgmail', 'rent-gmail', $data);
            echo json_encode(['status' => 'success', 'msg' => 'Update thành công']);
            die;
        }
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Không tìm thấy ID']);
        die;
    }
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Thiếu dữ liệu']);
    die;
}
