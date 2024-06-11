<?php
require("../../config/config.php");
require("../../config/function.php");
$data = [];
$key = isset($_GET['key']) ? check_string($_GET['key']) : "";
$row = $LINH->num_rows("SELECT * FROM `rentals` WHERE `status` = 'pending' AND `pc_type` = '$key'");
if ($row > 0) {
    foreach ($LINH->get_list("SELECT * FROM `rentals` WHERE `status` = 'pending' AND `pc_type` = '$key' ORDER BY id DESC") as $services) {
        unset($services['username']);
        unset($services['price_sell']);
        $data[] = $services;
    }
}
echo json_encode($data);
