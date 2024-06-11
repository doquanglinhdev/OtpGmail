<?php
require("../config/config.php");
require("../config/function.php");
?>
<?php
if ($LINH->site('status_napbank') === 'ON') {
  $token = $LINH->site('token_bank');
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sieuthicode.net/historyapimbbank/' . $token,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $data = json_decode($response, true);
  $transactionHistoryList = $data['TranList'];
  foreach ($transactionHistoryList as $transaction) {
    $description_check = strtolower($transaction['description']);
    $searchString = $LINH->site('noidung_naptien');
    $position = strpos($description_check, $searchString);
    if ($position !== false) {
      $pattern = '/' . $searchString . '[\w\d]+/';
      preg_match($pattern, $description_check, $matches);
      if (!empty($matches)) {
        $description = $matches[0];
        if (strpos($description, $searchString) !== false) {
          $id_user = substr($description, strlen($searchString));
        }
      }
      $refNo = strstr($transaction['refNo'], '\\', true);
      if ($refNo === false) {
        $refNo = $transaction['refNo'];
      }
      $creditAmount = $transaction['creditAmount'];
      $real_amount = $creditAmount + $creditAmount * $LINH->site('ck_bank') / 100;
      if ($id_user) {
        $row = $LINH->get_row(" SELECT * FROM `users` WHERE `id` = '$id_user' ");
        if ($row) {
          if ($LINH->num_rows(" SELECT * FROM `bank_auto` WHERE `refNo` = '$refNo' ") == 0) {
            if ($creditAmount >= 20000) {
              $create = $LINH->insert("bank_auto", array(
                'refNo'         => $refNo,
                'description' => $description,
                'creditAmount'      => $creditAmount,
                'transactionDate'        => gettime(),
                'user_id' => $row['id'],
                'money_real' => $real_amount,
                'status	' => 'thanhcong',
              ));
              if ($create) {
                $isCheckMoney = $LINH->cong("users", "money", $real_amount, " `id` = '" . $row['id'] . "' ");
                if ($isCheckMoney) {
                  $LINH->cong("users", "money_total", $real_amount, " `id` = '" . $row['id'] . "' ");
                  /* GHI LOG DÒNG TIỀN */
                  $LINH->insert("cash_flow", array(
                    'cash_old' => $row['money'],
                    'cash_change' => $real_amount,
                    'cash_new' => $row['money'] + $real_amount,
                    'cash_time' => gettime(),
                    'cash_note' => 'Nạp tiền tự động ngân hàng (VCB | ' . $refNo . ')',
                    'user_id' => $row['id']
                  ));
                  $content = templateTele("$id_user - ĐÃ NẠP: " . number_format($real_amount) . " đ");
                  sendTele($content);
                }
              }
            } else {
              $create = $LINH->insert("bank_auto", array(
                'refNo'         => $refNo,
                'description' => $description,
                'creditAmount'      => $creditAmount,
                'transactionDate'        => gettime(),
                'user_id' => $row['id'],
                'money_real' => $real_amount,
                'status	' => 'thanhcong',
              ));
              if ($create) {
                $isCheckMoney = $LINH->cong("users", "money", $real_amount, " `id` = '" . $row['id'] . "' ");
                if ($isCheckMoney) {
                  $LINH->cong("users", "money_total", $real_amount, " `id` = '" . $row['id'] . "' ");
                  /* GHI LOG DÒNG TIỀN */
                  $LINH->insert("cash_flow", array(
                    'cash_old' => $row['money'],
                    'cash_change' => $real_amount,
                    'cash_new' => $row['money'] + $real_amount,
                    'cash_time' => gettime(),
                    'cash_note' => 'Nạp tiền tự động ngân hàng (MB | ' . $refNo . ')',
                    'user_id' => $row['id']
                  ));
                  $content = templateTele("$id_user - ĐÃ NẠP: " . number_format($real_amount) . " đ");
                  sendTele($content);
                }
              }
            }
          }
        }
      }
    }
  }
}
?>