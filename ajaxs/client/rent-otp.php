<?php
require("../../config/config.php");
require("../../config/function.php");
require __DIR__ . '/../../vendor/autoload.php';

// Kiểm tra yêu cầu POST
if (!isset($_POST['action']) || $_POST['action'] !== 'rent_otp') {
    echo json_encode(['status' => 'error', 'msg' => 'Không đủ dữ liệu.']);
    exit;
}

// Kiểm tra phiên người dùng
if (isset($_POST['action']) && $_POST['action'] === 'rent_otp' && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $money_user = $getUser['money'];
    $apikey = $LINH->site('api_otp');
    $service_id = $LINH->site('service_id');

    $type = $_POST['service'];
    $row = $LINH->get_row("SELECT * FROM `services` WHERE `service_type` = '$type'");

    if (!$row) {
        echo json_encode(['status' => 'error', 'msg' => 'Không tìm thấy dịch vụ.']);
        exit;
    }

    $title_name = $row['service_name'];
    $price = $row['price'];

    if ($money_user < $price) {
        echo json_encode(['status' => 'error_sodu_user', 'msg' => 'Tài khoản của bạn không đủ, vui lòng nạp thêm!']);
        exit;
    }

    // Kiểm tra nếu có tài khoản phù hợp trong cơ sở dữ liệu
    $getAccount = $LINH->get_row("SELECT * FROM `accounts` WHERE `service_type` = '$type' AND active = 1");

    if ($getAccount) {
        $linhdeptry = checkLiveGmail($getAccount['account']);
        if (!$linhdeptry) {
            $LINH->update("accounts", ['active' => 0], " `id` = '" . $getAccount['id'] . "' ");
            echo json_encode(['status' => 'mail', 'msg' => 'Mail die, vui lòng lấy lại']);
            exit;
        }
        rentAccount($LINH, $getUser, $getAccount, $row, $price, $username);
    } else {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://tmpcloud.shop/user/api/order.php',
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => http_build_query(array(
                'act' => 'paid',
                'api_key' => $apikey,
                'amount' => 1,
                'service_id' => $service_id
            ))
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        if ($result === false) {
            echo json_encode(['status' => 'curl', 'msg' => 'Thao tác thất bại, vui lòng thử lại!']);
            exit;
        }

        $data = json_decode($result, true);
        if (!$data['success']) {
            echo json_encode(['status' => 'error', 'msg' => 'Hệ thống đang lọc mail. Vui lòng thử lại']);
            exit;
        }

        $id_order = $data['timespan'];
        $account = $data['data'][0];
        $update_sodu = $LINH->site('sodu_api') + $LINH->site('rate');
        $linhdeptry = checkLiveGmail($account);

        if (!$linhdeptry) {
            echo json_encode(['status' => 'mail', 'msg' => 'Mail die, vui lòng lấy lại']);
            exit;
        }
        if($getUser['level'] == "user"){
            $LINH->update("options", array(
                'value' => $update_sodu
            ), " `key` = 'sodu_api' ");
        }

        foreach ($LINH->get_list("SELECT * FROM `services`") as $service) {
            $create = $LINH->insert("accounts", [
                'id_order' => $id_order,
                'account' => $account,
                'service_type' => $service['service_type'],
                'active' => 1,
            ]);
        }

        if ($create) {
            $getAccount = $LINH->get_row("SELECT * FROM `accounts` WHERE `service_type` = '$type' AND active = 1");
            if (!$getAccount['account'] == "") {
                rentAccount($LINH, $getUser, $getAccount, $row, $price, $username);
            } else {
                echo json_encode(['status' => 'error', 'msg' => 'Vui lòng thử lại.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Không thể tạo tài khoản, vui lòng thử lại.']);
            exit;
        }
    }
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Phiên làm việc đã hết hạn, vui lòng đăng nhập lại']);
    exit;
}

// Hàm để xử lý thuê tài khoản
function rentAccount($LINH, $getUser, $getAccount, $row, $price, $username)
{
    // Kiểm tra lại tiền người dùng trước khi thuê
    $money_user = $getUser['money'];
    if ($money_user < $price) {
        echo json_encode(['status' => 'error', 'msg' => 'Tài khoản của bạn không đủ, vui lòng nạp thêm!']);
        exit;
    }
    // Lấy thông tin key_devices
    $devices = $LINH->get_list("SELECT * FROM `key_devices`");

    // Lặp qua các loại thiết bị để thêm vào rentals
    foreach ($devices as $device) {
        $deviceType = $device['type'];
        $deviceFlow = $device['flow'];

        if ($LINH->num_rows("SELECT * FROM `rentals` WHERE `status` = 'pending' AND `pc_type` = '$deviceType' ") < $deviceFlow) {
            $create = $LINH->insert("rentals", [
                'account' => $getAccount['account'],
                'service_type' => $getAccount['service_type'],
                'services_name' => $row['service_name'],
                'price_sell' => $price,
                'code' => "",
                'full_text' => "",
                'created_at' => gettime(),
                'status' => "pending",
                'done_at' => "0",
                'username' => $username,
                'pc_type' => $deviceType // Thêm loại thiết bị vào rentals
            ]);
            $LINH->update("accounts", ['active' => 0], " `id` = '" . $getAccount['id'] . "' ");
            if ($create) {

                // Cập nhật tiền và ghi nhật ký
                $LINH->cong("users", "money_used", $price, " `id` = '" . $getUser['id'] . "' ");
                $LINH->tru("users", "money", $price, " `id` = '" . $getUser['id'] . "' ");
                $LINH->insert("cash_flow", [
                    'cash_old' => $getUser['money'],
                    'cash_change' => $price,
                    'cash_new' => $getUser['money'] - $price,
                    'cash_time' => gettime(),
                    'cash_note' => 'Thuê ' . $getAccount['service_type'] . '(' . strtolower(explode('|', $getAccount['account'])[0]) . ')',
                    'user_id' => $getUser['id']
                ]);


                // Kiểm tra trạng thái tài khoản
                if ($getUser['money'] < 0) {
                    $LINH->update("users", ['banned' => 1], " `username` = '" . $getUser['username'] . "' ");
                    session_start();
                    session_destroy();
                    echo '<script type="text/javascript">setTimeout(function(){ location.href = "" },0);</script>';
                    die();
                }

                // Gửi thông báo thành công qua Pusher
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
                echo json_encode(['status' => 'success', 'msg' => 'Thành công!']);
                exit;
            } else {
                // Trả về lỗi nếu không thành công
                echo json_encode(['status' => 'error', 'msg' => 'Thao tác thất bại, vui lòng thử lại!']);
                exit;
            }
        }
        // else {
        //     // $key = $LINH->num_rows("SELECT * FROM `rentals` WHERE `status` = 'pending' AND `pc_type` = '$deviceType' ")
        // }
    }
    echo json_encode(['status' => 'error', 'msg' => 'Hệ thống quá tải, vui lòng thử lại!']);
    exit;
}

function checkLiveGmail($account)
{

    $url = 'https://clone365.net/linh.php?email='. $account;
     
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
     
    $response = curl_exec($crl);
    if(!$response){
        return false;
    } else {
        $data = json_decode($response, true);
        if (isset($data['status']) && $data['status'] == "Live") {
            return $data;
        }
    }
     
    curl_close($crl);
    
    return false;
}

