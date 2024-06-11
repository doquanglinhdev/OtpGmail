<?php
// Tải cấu hình và các hàm cần thiết
require("../config/config.php");
require("../config/function.php");

// Lấy danh sách tài khoản hoạt động
$accounts = $LINH->get_list('SELECT * FROM `accounts` WHERE `active` = 1 ORDER BY `id` ASC LIMIT 1000');

// Chuẩn bị dữ liệu email, tránh trùng lặp
$email_set = array_unique(array_column($accounts, 'account'));
foreach ($email_set as $email) {
    $mail = $email;
    
    $url = 'https://clone365.net/linh.php?email='. $mail;
     
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
     
    $response = curl_exec($crl);
    if(!$response){
       die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
    } else {
        $data = json_decode($response, true);
        if ($data['status'] == "Die") {
            var_dump($data);
            foreach ($LINH->get_list('SELECT * FROM `accounts` WHERE  `account` = "' . $mail . '"') as $account) {
                $LINH->update("accounts", ['active' => 0], " `id` = '" . $account['id'] . "' ");
            }
        }
    }
     
    curl_close($crl);
}


    // $curl = curl_init();
    // curl_setopt_array($curl, array(
    //     CURLOPT_RETURNTRANSFER => 0,
    //     CURLOPT_URL => 'https://clone365.net/linh.php?email=' . $mail,
    //     CURLOPT_SSL_VERIFYPEER => false
    // ));
    
    // $resp = curl_exec($curl);
    
    // $data = json_decode($resp, true);
    // if ($data['status'] == "Die") {
    //     foreach ($LINH->get_list('SELECT * FROM `accounts` WHERE  `account` = "' . $mail . '"') as $account) {
    //         $LINH->update("accounts", ['active' => 0], " `id` = '" . $account['id'] . "' ");
    //     }
    // }
    
    // curl_close($curl);
    
    // $curl = curl_init();
    // curl_setopt_array($curl, array(
    //     CURLOPT_RETURNTRANSFER => 0,
    //     CURLOPT_URL => 'https://clone365.net/linh.php?email=' . $mail,
    //     CURLOPT_SSL_VERIFYPEER => false
    // ));
    // $result = curl_exec($curl);
    // curl_close($curl);
    // $data = json_decode($result, true);
    // if ($data['status'] == "Die") {
        
    //     foreach ($LINH->get_list('SELECT * FROM `accounts` WHERE  `account` = "' . $mail . '"') as $account) {
    //         $LINH->update("accounts", ['active' => 0], " `id` = '" . $account['id'] . "' ");
    //     }
    // }

