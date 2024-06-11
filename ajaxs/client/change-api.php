<?php
require("../../config/config.php");
require("../../config/function.php");
if (isset($_POST['api']) && isset($_SESSION['username'])) {
    $api = check_string($_POST['api']);
    $LINH->update("users", array(
        'token'     => $api,
    ), " `id` = '" . $getUser['id'] . "' ");

    $arr = array('success' => "Change thành công");
    die(json_encode($arr));

} else {
    echo "Cái quần què gì đây @@";
}
