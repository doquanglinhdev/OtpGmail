<?php
require("../../config/config.php");
require("../../config/function.php");
$username = $getUser['username']; // Sanitize input
$data = [];
if (isset($_GET['action']) && $_GET['action'] == "username") {
  $lastUpdate = isset($_GET['last_update']) ? $_GET['last_update'] : '0000-00-00 00:00:00'; // Mặc định là từ rất lâu

  foreach ($LINH->get_list("SELECT * FROM `rentals` WHERE `username` = '$username' AND `status` = 'pending' ORDER BY id DESC") as $services) {
    $services['account'] = strtolower(explode('|', $services['account'])[0]);
    $data[] = $services;
  }

  // Lấy các bản ghi có trạng thái khác "pending" và được cập nhật sau $lastUpdate
  foreach ($LINH->get_list("SELECT * FROM `rentals` WHERE `username` = '$username' AND `status` != 'pending' AND `done_at` > '$lastUpdate' ORDER BY id DESC") as $services) {
    $services['account'] = strtolower(explode('|', $services['account'])[0]);
    $data[] = $services;
  }
  echo json_encode($data);
}


if (isset($_GET['action']) && $_GET['action'] == "histori") {
  $row = $LINH->num_rows("SELECT * FROM `rentals` WHERE `username` = '$username' ");
  if ($row > 0) {
    foreach ($LINH->get_list("SELECT * FROM `rentals` WHERE `username` = '$username' ORDER BY id DESC LIMIT 2000") as $services) {
      $services['account'] = strtolower(explode('|', $services['account'])[0]);
      $data[] = $services;
    }
  }
  echo json_encode($data);
}
