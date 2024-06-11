<?php
    require("../../config/config.php");
    require("../../config/function.php");
    if(isset($_POST['type']) && $_POST['type'] == 'ChangePassword'){
        $password   = check_string($_POST['password']);
        $password_check   = check_string(md5($_POST['password']));
        $password_new = check_string($_POST['password_new']);
        $password_new_check = check_string(md5($_POST['password_new']));
        $password_new_confirm = check_string($_POST['password_new_confirm']);
        if(empty($password))
        {
          msg_error_not_link("Bạn chưa nhập mật khẩu cũ",3000);
        }
        if(!$LINH->get_row(" SELECT * FROM `users` WHERE `password` = '$password_check' "))
        {
          msg_error_not_link('Mật khẩu cũ chưa chính xác', 3000);
        }
        if(empty($password_new))
        {
          msg_error_not_link("Bạn chưa nhập mật khẩu mới",3000);
        }
        if(empty($password_new_confirm))
        {
          msg_error_not_link("Vui lòng xác minh lại mật khẩu",3000);
        }
        if($password_new != $password_new_confirm)
        {
          msg_error_not_link("Nhập lại mật khẩu không đúng",3000);
        }
        if(strlen($password_new) < 5)
        {
          msg_error_not_link('Vui lòng nhập mật khẩu có ít nhất 5 ký tự',3000);
        }
        $row = $LINH->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ");
        if(!$row)
        {
          msg_error_link("Vui lòng đăng nhập!", URL('public/client/login.php'), 2000);
        }
        $LINH->update("users", [
            'password' => $password_new_check,
            'token'         => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 64)
        ], " `id` = '".$row['id']."' ");
        msg_success_link('Đổi mật khẩu thành công', URL(''), 2000);
    }
?>