<?php
// Tải cấu hình và các hàm cần thiết
require("../config/config.php");
require("../config/function.php");

$api_key = '7fd835b6bed019988e9dcfdfb1c7db9a';

// Lấy danh sách tài khoản hoạt động
$accounts = $LINH->get_list('SELECT * FROM `accounts` WHERE `active` = 1 AND `id` > 15000 ORDER BY `id` ASC LIMIT 1000');

// Chuẩn bị dữ liệu email, tránh trùng lặp
$email_set = array_unique(array_column($accounts, 'account'));
$data = [];
$original_emails = []; // Mảng để lưu email gốc

$i = 1;
foreach ($email_set as $email) {
    $mail = strtolower(explode('|', $email)[0]);
    $data[] = [
        "email" => $mail,
        "index" => $i
    ];
    $original_emails[$mail] = $email; // Lưu email gốc
    $i++;
}

$postData = json_encode([
    "api_key" => $api_key,
    "emails" => $data,
    "fastCheck" => true
]);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://checkmail.live/check/',
    CURLOPT_POST => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS => $postData
]);

$result = curl_exec($curl);
curl_close($curl);
$data = json_decode($result, true);
echo "<pre>";
echo $postData;
var_dump($data);
foreach ($response_data['data'] as $mail_check) {
    if ($mail_check['status'] !== "live") {
        $original_email = $original_emails[$mail_check['email']]; // Lấy email gốc
        foreach ($LINH->get_list('SELECT * FROM `accounts` WHERE  `account` = "' . $original_email . '"') as $account) {
            if ($account['account'] == $original_email) {
                $LINH->update("accounts", ['active' => 0], " `id` = '" . $account['id'] . "' ");
            }
        }
    }
}