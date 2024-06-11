<?php
// Tải cấu hình và các hàm cần thiết
require("../config/config.php");
require("../config/function.php");

$user = $LINH->num_rows("SELECT DISTINCT username FROM rentals");

if ($user > 0) {
   foreach($LINH->get_list("SELECT DISTINCT username FROM rentals") as $row_user){
        $user_to_check = $row_user['username'];

        $now = gettime();
        $fifteen_minutes_ago = date('Y-m-d H:i:s', strtotime('-15 minutes'));

        $total_cancelled  = $LINH->get_row("
        SELECT COUNT(*) AS total_cancelled 
        FROM rentals 
        WHERE status = 'cancel' 
        AND username = '$user_to_check'
       AND created_at BETWEEN '$fifteen_minutes_ago' AND '$now'
        ");

        $total_records =  $LINH->get_row("
        SELECT COUNT(*) AS total 
        FROM rentals 
        WHERE username = '$user_to_check'
        AND created_at BETWEEN '$fifteen_minutes_ago' AND '$now'
        ");
        
        // var_dump($total_records);
        if ($total_records['total'] > 30) {
            echo $user_to_check." - ". $total_cancelled['total_cancelled']." - ".$total_records['total']."</br>";
            $percentage_cancelled = ($total_cancelled['total_cancelled'] / $total_records['total']) * 100;
            if ($percentage_cancelled > 70) {
                $token_new = random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789', 40);
                 $LINH->update("users", array(
                        'token'     => $token_new,
                    ), " `username` = '" . $user_to_check . "' ");
            } 
        } 
    }
}
