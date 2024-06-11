<?php
    require("../../config/config.php");
    require("../../config/function.php");
    if(isset($_POST['type']) && $_POST['type'] == 'register'){
        $username   = check_string($_POST['username']);
        $pass   = check_string($_POST['password']);
        $email      = check_string($_POST['email']);
        $password = md5($pass);
        if(empty($username))
        {
            msg_error_not_link("Vui lòng nhập tên tài khoản !",3000);
        }
        if(check_username($username) != True)
        {
            msg_error_not_link('Vui lòng nhập định dạng tài khoản hợp lệ',3000);
        }
        if(strlen($username) < 5 || strlen($username) > 64)
        {
            msg_error_not_link("Tài khoản phải từ 5 đến 64 ký tự",3000);
        }
        if($LINH->get_row(" SELECT * FROM `users` WHERE `username` = '$username'"))
        {
            msg_error_not_link("Tên đăng nhập đã tồn tại!",3000);
        }
        if(empty($password))
        {
            msg_error_not_link("Vui lòng nhập mật khẩu !",3000);
        }
        if(strlen($password) < 3)
        {
            msg_error_not_link("Vui lòng đặt mật khẩu trên 3 ký tự",3000);
        }
        if(empty($email))
        {
            msg_error_not_link("Vui lòng nhập email !",3000);
        }
        if(check_email($email) != true)
        {
            msg_error_not_link("Vui lòng nhập đúng định dạng email !",3000);
        }
        $create = $LINH->insert("users", [
            'username'      => $username,
            'password'      => $password,
            'token'         => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789', 40),  
            'money'         => 0,
            'level'         => 'user',
            'email'         => $email,
            'money_total'    => 0,
            'money_used'    => 0,
            
        ]);
        if ($create)
        {   
            msg_success_link("Tạo tài khoản thành công",URL('public/client/login.php'), 2000);
        }
        else
        {
            msg_error_not_link("Đăng ký thất bại vui lòng liên hệ admin",3000);
        }
        
    }
?>