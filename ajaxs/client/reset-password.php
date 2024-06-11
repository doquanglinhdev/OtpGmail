<?php
    require("../../config/config.php");
    require("../../config/function.php");
    if(isset($_POST['type']) && $_POST['type'] == 'reset'){
        $password_new = check_string($_POST['password_new']);
        $password_new_repeat = check_string($_POST['password_new_repeat']);
        $token = $_POST['token'];
        if(empty($password_new))
        {
          msg_error_not_link("Vui lòng nhập mật khẩu mới !", 3000);
        }
        if(empty($password_new_repeat))
        {
          msg_error_not_link("Vui lòng nhập lại mật khẩu !", 3000);
        }
        if($password_new !== $password_new_repeat){
          msg_error_not_link("Mật khẩu nhập lại chưa trùng mật khẩu mới !", 3000);
        }
        $update = $LINH->update("users", array(
          'password'      => md5($password_new),
        ), " `token` = '".$token."' ");
        if($update){
          msg_success_link('Đặt lại mật khẩu thành công !', URL('public/client/login.php'), 2000);
        }
        
    }
?>