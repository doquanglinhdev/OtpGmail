<?php
require("../../config/config.php");
require("../../config/function.php");
require __DIR__ . '/../../vendor/autoload.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $getRentals = $LINH->get_row("SELECT * FROM `rentals` WHERE `id` = '$id' AND `status` = 'pending'");
    if ($getRentals) {

        $canceled = $LINH->update("rentals", array(
            'status'     => 'cancel',
            'done_at'   => gettime(),
        ), " `id` = '" . $id . "' ");

        if ($canceled) {
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

            $LINH->update("accounts", array(
                'active'     => 1,
            ), " `service_type` = '" . $getRentals['service_type'] . "' AND `account` = '" . $getRentals['account'] . "' ");

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
            echo json_encode(['status' => 'success', 'msg' => 'Hủy thành công']);
            die;
        }
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Không tìm thấy ID']);
        die;
    }
} else {
    echo "Thiếu dữ liệu rồi";
}
