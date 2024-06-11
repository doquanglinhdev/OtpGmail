<?php
    require("../../config/config.php");
    require("../../config/function.php");
    if(isset($_POST['type']) && $_POST['type'] == 'login'){
        $username = check_string($_POST['username']);
        $password = md5($_POST['password']);
        if(empty($username))
        {
          msg_error_not_link("Vui lòng nhập tên đăng nhập !", 3000);
        }
        if(!$LINH->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
          msg_error_not_link('Tên đăng nhập không tồn tại', 3000);
        }
        if(empty($password))
        {
          msg_error_not_link("Vui lòng nhập mật khẩu !",3000);
        }
        if(!$LINH->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' "))
        {
          msg_error_not_link('Mật khẩu đăng nhập không chính xác',3000);
        }
        $_SESSION['username'] = $username;
        msg_success_link('Đăng nhập thành công', URL(''), 2000);
    }
?>