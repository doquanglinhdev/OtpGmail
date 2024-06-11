<?php
require("../../config/config.php");
require("../../config/function.php");
$data = [];
$apikey = $LINH->site('api_otp');
$row = $LINH->num_rows("SELECT * FROM `otp` WHERE `status` = 'active'");
if ($row > 0) {
  foreach ($LINH->get_list("SELECT * FROM `otp` WHERE `status` = 'active'") as $services) {
    $data[] = $services;
  }
} else {
  $data[] = NULL;
}

if (!empty($data) && $row > 0) {
  foreach ($data as $row) {
    $id = $row['id_order'];
    $url = "https://api.usotp.xyz/get-request?apikey=$apikey&id=$id";

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
      echo 'Error: ' . curl_error($ch);
    } else {
      // Decode the JSON response
      $response_data = json_decode($response, true);
      
      // Extract required fields from the response
      $status = $response_data['status'];
      $code = $response_data['code'];
      $full_text = $response_data['full_text'];
      $done_at = $response_data['done_at'];
      echo $status;
      // Check if the status has changed
      if ($status !== 'active') {

        $LINH->update("otp", array(
          'status'     => $status,
          'code'   => $code,
          'full_text'   => $full_text,
          'done_at'   => $done_at,
        ), " `id_order` = '" . $id . "' ");
        if ($status == 'canceled') {
          $phone = $response_data['phone'];
          $service = $response_data['service'];
          $getPrice = $LINH->get_row("SELECT * FROM `services` WHERE `name_api` = '$service'");

          $price_refund = $getPrice['price'];

          $getuser = $LINH->get_row("SELECT * FROM `otp` WHERE `id_order` = '$id'");

          $getusers = $getuser['username'];
          $checkuser = $LINH->get_row("SELECT * FROM `users` WHERE `username` = '$getusers'");


          $LINH->cong("users", "money", $price_refund, " `id` = '" . $checkuser['id'] . "' ");
          $LINH->insert("cash_flow", array(
            'cash_old' => $checkuser['money'],
            'cash_change' => $price_refund,
            'cash_new' => $checkuser['money'] + $price_refund,
            'cash_time' => gettime(),
            'cash_note' => 'Hoàn tiền phone (' . $phone . ')',
            'user_id' => $checkuser['id']
        ));
        }
      }
    }

    // Close cURL session
    curl_close($ch);
  }
}
