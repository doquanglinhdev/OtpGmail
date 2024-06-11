<?php
$LINH = new LINH;
function extractStringAfterTilde($url)
{
    $position = strpos($url, '~');

    if ($position !== false) {
        return substr($url, $position + 1);
    } else {
        return "Không tìm thấy dấu '~' trong chuỗi.";
    }
}
function parse_order_id($des, $MEMO_PREFIX)
{
    $re = '/' . $MEMO_PREFIX . '\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0) {
        return null;
    }
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength));
    return $orderId;
}
function parse_order_id1($des, $MEMO_PREFIX)
{
    $re = '/' . $MEMO_PREFIX . '\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0) {
        return null;
    }
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength));
    return $orderId;
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    curl_close($ch);
    return $data;
}
function loaithe($data)
{
    if ($data == 'Viettel' || $data == 'VIETTEL' || $data == 'viettel') {
        $show = 'https://i.imgur.com/xFePMtd.png';
    } else if ($data == 'Vinaphone' || $data == 'vinaphone' || $data == 'VINAPHONE') {
        $show = 'https://i.imgur.com/s9Qq3Fz.png';
    } else if ($data == 'Mobifone' || $data == 'mobifone' || $data == 'MOBIFONE') {
        $show = 'https://i.imgur.com/qQtcWJW.png';
    } else if ($data == 'Vietnamobile' || $data == 'vietnamobile' || $data == 'VIETNAMMOBILE') {
        $show = 'https://i.imgur.com/IHm28mq.png';
    } else if ($data == 'Zing' || $data == 'zing' | $data == 'ZING') {
        $show = 'https://i.imgur.com/xkd7kQ0.png';
    } else if ($data == 'Garena' || $data == 'garena') {
        $show = 'https://i.imgur.com/BLkY5qm.png';
    }
    return '<img style="text-align: center;" src="' . $show . '" width="70px" />';
}
function status_otp($data)
{
    if ($data == 'pending') {
        $show = '<span class="badge badge-info">Chờ OTP</span>';
    }
    if ($data == 'success') {
        $show = '<span class="badge badge-success">Thành công</span>';
    }
    if ($data == 'cancel') {
        $show = '<span class="badge badge-danger">Hủy</span>';
    }
    if ($data == 'die') {
        $show = '<span class="badge badge-danger">Mail Die</span>';
    }
    return $show;
}
function status($data)
{
    if ($data == 'xuly') {
        $show = '<span class="badge badge-info">Đang xử lý</span>';
    }
    if ($data == 'pending') {
        $show = '<span class="badge badge-info">Đang xử lý</span>';
    } else if ($data == 'hoantat') {
        $show = '<span class="badge badge-success">Hoàn tất</span>';
    } else if ($data == 'thanhcong') {
        $show = '<span class="badge badge-success">Thành công</span>';
    } else if ($data == 'completed') {
        $show = '<span class="badge badge-success">Hoàn thành</span>';
    } else if ($data == 'success') {
        $show = '<span class="badge badge-success">Success</span>';
    } else if ($data == 'thatbai') {
        $show = '<span class="badge badge-danger">Thất bại</span>';
    } else if ($data == 'error') {
        $show = '<span class="badge badge-danger">Error</span>';
    } else if ($data == 'loi') {
        $show = '<span class="badge badge-danger">Lỗi</span>';
    } else if ($data == 'huy') {
        $show = '<span class="badge badge-danger">Hủy</span>';
    } else if ($data == 'dangnap') {
        $show = '<span class="badge badge-warning">Đang đợi nạp</span>';
    } else if ($data == 2) {
        $show = '<span class="badge badge-success">Hoàn tất</span>';
    } else if ($data == 1) {
        $show = '<span class="badge badge-info">Đang xử lý</span>';
    } else {
        $show = '<span class="badge badge-warning">Khác</span>';
    }
    return $show;
}
function URL($link)
{
    global $url;
    return $url . $link;
}
function format_date($time)
{
    return date("H:i:s d/m/Y", $time);
}
function formatTime($datetime)
{
    $currentDate = new DateTime();
    $givenDate = new DateTime($datetime);
    $interval = $givenDate->diff($currentDate);

    if ($interval->y > 0) {
        return $interval->format('%y năm trước');
    } elseif ($interval->m > 0) {
        return $interval->format('%m tháng trước');
    } elseif ($interval->d > 1) {
        return $interval->format('%d ngày trước');
    } elseif ($interval->d == 1) {
        return 'Hôm qua';
    } elseif ($interval->h > 0) {
        return $interval->format('%h giờ trước');
    } elseif ($interval->i > 0) {
        return $interval->format('%i phút trước');
    } else {
        return $interval->format('%s giây trước');
    }
}
function format_cash($price)
{
    return str_replace(",", ".", number_format($price));
}
function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches)) {
        return True;
    } else {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches)) {
        return True;
    } else {
        return False;
    }
}
function check_phone($data)
{
    if (preg_match('/^\+?(\d.*){3,}$/', $data, $matches)) {
        return True;
    } else {
        return False;
    }
}
function check_url($url)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, 1);
    curl_setopt($c, CURLOPT_NOBODY, 1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, 1);
    if (!curl_exec($c)) {
        return false;
    } else {
        return true;
    }
}
function check_zip($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("zip", "ZIP");
    if (in_array($ext, $valid_ext)) {
        return true;
    }
}
function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png", "jpeg", "jpg", "PNG", "JPEG", "JPG", "gif", "GIF");
    if (in_array($ext, $valid_ext)) {
        return true;
    }
}
function check_string1($data)
{
    return trim(htmlspecialchars(addslashes($data)));
    //return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
}
function checkFormatCard($type, $seri, $pin)
{
    $seri = strlen($seri);
    $pin  = strlen($pin);
    $data = [];
    if ($type == 'Viettel' || $type == "viettel" || $type == "VT" || $type == "VIETTEL") {
        if ($seri != 11 && $seri != 14) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 13 && $pin != 15) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Mobifone' || $type == "mobifone" || $type == "Mobi" || $type == "MOBIFONE") {
        if ($seri != 15) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'VNMB' || $type == "Vnmb" || $type == "VNM" || $type == "VIETNAMMOBILE") {
        if ($seri != 16) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Vinaphone' || $type == "vinaphone" || $type == "Vina" || $type == "VINAPHONE") {
        if ($seri != 14) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 14) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Garena' || $type == "garena" || $type == "GARENA") {
        if ($seri != 9) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 16) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Zing' || $type == "zing" || $type == "ZING") {
        if ($seri != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 9) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Vcoin' || $type == "VTC" || $type == "VCOIN") {
        if ($seri != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    $data = [
        'status'    => true,
        'msg'       => 'Jss'
    ];
    return $data;
}
function random($string, $int)
{
    return substr(str_shuffle($string), 0, $int);
}
function myip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}
function gettime()
{
    return date('Y/m/d H:i:s', time());
}
function msg_success_link($text, $url, $time)
{
    echo '<script type="text/javascript">

    new Notify ({
        status: "success",
        title: "Thành công",
        text: "' . $text . '",
        effect: "slide",
        speed: 300,
        customClass: "",
        customIcon: "",
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        notificationsGap: null,
        notificationsPadding: null,
        type: "outline",
        position: "right top",
        customWrapper: ""
    })
    setTimeout(function(){ 
            window.location.href = "' . $url . '"; 
        }, ' . $time . ');
    </script>';
    die();
}

function msg_success_not_link($text, $time)
{
    echo '<script type="text/javascript">
    new Notify ({
        status: "success",
        title: "Thành công",
        text: "' . $text . '",
        effect: "slide",
        speed: 300,
        customClass: "",
        customIcon: "",
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: ' . $time . ',
        notificationsGap: null,
        notificationsPadding: null,
        type: "outline",
        position: "right top",
        customWrapper: ""
    })
    </script>';
    die();
}
function msg_error_link($text, $url, $time)
{
    echo '<script type="text/javascript">

    new Notify ({
        status: "error",
        title: "Thất bại",
        text: "' . $text . '",
        effect: "slide",
        speed: 300,
        customClass: "",
        customIcon: "",
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: ' . $time . ',
        notificationsGap: null,
        notificationsPadding: null,
        type: "outline",
        position: "right top",
        customWrapper: ""
    })
        setTimeout(function(){ 
            window.location.href = "' . $url . '"; 
        }, ' . $time . ');
    </script>';
    die();
}

function msg_error_not_link($text, $time)
{
    echo '<script type="text/javascript">

    new Notify ({
        status: "error",
        title: "Thất bại",
        text: "' . $text . '",
        effect: "slide",
        speed: 300,
        customClass: "",
        customIcon: "",
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: ' . $time . ',
        notificationsGap: null,
        notificationsPadding: null,
        type: "outline",
        position: "right top",
        customWrapper: ""
    })
    </script>';
    die();
}
function msg_warning_link($text, $url, $time)
{
    echo '<script type="text/javascript">

    new Notify ({
        status: "warning",
        title: "Cảnh báo",
        text: "' . $text . '",
        effect: "slide",
        speed: 300,
        customClass: "",
        customIcon: "",
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: ' . $time . ',
        notificationsGap: null,
        notificationsPadding: null,
        type: "outline",
        position: "right top",
        customWrapper: ""
    })
        setTimeout(function(){ 
            window.location.href = "' . $url . '"; 
        }, ' . $time . ');
    </script>';
    die();
}

function msg_warning_not_link($text, $time)
{
    echo '<script type="text/javascript">

    new Notify ({
        status: "warning",
        title: "Cảnh báo",
        text: "' . $text . '",
        effect: "slide",
        speed: 300,
        customClass: "",
        customIcon: "",
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: ' . $time . ',
        notificationsGap: null,
        notificationsPadding: null,
        type: "outline",
        position: "right top",
        customWrapper: ""
    })
    </script>';
    die();
}
function display_banned($data)
{
    if ($data == 1) {
        $show = '<span class="badge badge-danger">Banned</span>';
    } else if ($data == 0) {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}
function display($data)
{
    if ($data == 'HIDE') {
        $show = '<span class="badge badge-danger">ẨN</span>';
    } else if ($data == 'SHOW') {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    }
    return $show;
}
function status_account($data)
{
    if ($data != NUll) {
        $show = '<span class="badge badge-success">ĐÃ BÁN</span>';
    } else {
        $show = '<span class="badge badge-warning">ĐANG BÁN</span>';;
    }
    return $show;
}
function phantrang($url, $start, $total, $kmess)
{
    $out[] = ' <nav class="relative z-0 inline-flex v-pagination mx-auto v-text-1 v-light-theme">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li><a class="mx-1 border border-gray-400 bg-white relative v-page-no w-8 md:w-10 h-8 md:h-10 text-md md:text-lg rounded font-bold inline-flex items-center justify-center px-2 py-2 leading-5 font-medium focus:outline-none transition ease-in-out duration-150 text-gray-800 v-pagination-text disabled" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '<svg viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
    <path fill-rule="evenodd"
        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
        clip-rule="evenodd"></path>
</svg>');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="border mx-1 w-8 md:w-10 h-8 md:h-10 text-md md:text-lg select-none rounded inline-flex justify-center items-center px-4 py-2 focus:outline-none text-white border-red-600 text-white bg-red-600"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '<svg viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
        <path fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd"></path>
    </svg>
        ');
    }
    $out[] = '</ul></nav>';
    return implode('', $out);
}
function dirToArray($dir)
{

    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            } else {
                $result[] = $value;
            }
        }
    }

    return $result;
}
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach ($arBytes as $arItem) {
        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
            break;
        }
    }

    return $result;
}
function realFileSize($path)
{
    if (!file_exists($path))
        return false;

    $size = filesize($path);

    if (!($file = fopen($path, 'rb')))
        return false;

    if ($size >= 0) { //Check if it really is a small file (< 2 GB)
        if (fseek($file, 0, SEEK_END) === 0) { //It really is a small file
            fclose($file);
            return $size;
        }
    }

    //Quickly jump the first 2 GB with fseek. After that fseek is not working on 32 bit php (it uses int internally)
    $size = PHP_INT_MAX - 1;
    if (fseek($file, PHP_INT_MAX - 1) !== 0) {
        fclose($file);
        return false;
    }

    $length = 1024 * 1024;
    while (!feof($file)) { //Read the file until end
        $read = fread($file, $length);
        $size = bcadd($size, $length);
    }
    $size = bcsub($size, $length);
    $size = bcadd($size, strlen($read));

    fclose($file);
    return $size;
}
function timeAgo($time_ago)
{
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($time_elapsed / 60);
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400);
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640);
    $years      = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "$seconds giây trước";
    }
    //Minutes
    else if ($minutes <= 60) {
        return "$minutes phút trước";
    }
    //Hours
    else if ($hours <= 24) {
        return "$hours tiếng trước";
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "Hôm qua";
        } else {
            return "$days ngày trước";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        return "$weeks tuần trước";
    }
    //Months
    else if ($months <= 12) {
        return "$months tháng trước";
    }
    //Years
    else {
        return "$years năm trước";
    }
}
function GetCorrectMTime($filePath)
{

    $time = filemtime($filePath);

    $isDST = (date('I', $time) == 1);
    $systemDST = (date('I') == 1);

    $adjustment = 0;

    if ($isDST == false && $systemDST == true)
        $adjustment = 3600;

    else if ($isDST == true && $systemDST == false)
        $adjustment = -3600;

    else
        $adjustment = 0;

    return ($time + $adjustment);
}
function CheckLogin()
{
    global $my_username;
    if ($my_username != True) {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "' . URL('login.php') . '" }, 0);</script>');
    }
}
function CheckAdmin()
{
    global $my_level;
    if ($my_level != 'admin') {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "' . URL('') . '" }, 0);</script>');
    }
}
function templateTele($content)
{
    return "🔔 THÔNG BÁO
📝 Nội dung: " .
        $content .
        "
🕒 Thời gian: " .
        date('d/m/Y H:i:s');
}
function sendTele($message)
{
    global $LINH;

    $tele_token = $LINH->site('tele_token');
    $tele_chatid = $LINH->site('tele_chatid ');

    $data = http_build_query([
        'chat_id' => $tele_chatid,
        'text' => $message,
    ]);

    $url = 'https://api.telegram.org/bot' . $tele_token . '/sendMessage';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Win) AppleWebKit/1000.0 (KHTML, like Gecko) Chrome/65.663 Safari/1000.01');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if ($data) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function RemoveCredits($user_id, $amount, $reason)
{
    global $LINH;
    $LINH->insert("cash_flow", array(
        'cash_old' => getUser($user_id, 'money'),
        'cash_change' => $amount,
        'cash_new' => getUser($user_id, 'money') - $amount,
        'cash_time' => gettime(),
        'cash_note' => $reason,
        'user_id' => $user_id
    ));
    $isRemove = $LINH->tru("users", "money", $amount, " `id` = '$user_id' ");
    if ($isRemove) {
        return true;
    } else {
        return false;
    }
}
function PlusCredits($user_id, $amount, $reason)
{
    global $LINH;
    $LINH->insert("cash_flow", array(
        'cash_old' => getUser($user_id, 'money'),
        'cash_change' => $amount,
        'cash_new' => getUser($user_id, 'money') + $amount,
        'cash_time' => gettime(),
        'cash_note' => $reason,
        'user_id' => $user_id
    ));
    $isRemove = $LINH->cong("users", "money", $amount, " `id` = '$user_id' ");
    $LINH->cong("users", "money_total", $amount, " `id` = '$user_id' ");
    if ($isRemove) {
        return true;
    } else {
        return false;
    }
}
