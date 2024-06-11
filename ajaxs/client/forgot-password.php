<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;     
    require("../../class/PHPMailer/src/Exception.php");
    require("../../class/PHPMailer/src/PHPMailer.php");
    require("../../class/PHPMailer/src/SMTP.php");  
    require("../../config/config.php");
    require("../../config/function.php");  
    $mail = new PHPMailer(true);      
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();
    $mail->Mailer = "smtp";
    $mail->Host = 'smtp.gmail.com';               // HOST CỦA GMAIL
    $mail->SMTPAuth = true; 
    $mail->Username = $LINH->site("email");      // EMAIL
    $mail->Password = $LINH->site("pass_email"); // PASS MAIL
    $mail->SMTPSecure = 'tls';                    // CỔNG MÃ HÓA
    $mail->Port = 587;  // Port gửi mail 
    $LINH = new LINH;
    if(isset($_POST['type']) && $_POST['type'] == 'forgot')
    {
        $email = $_POST['email'];
        if(empty($email))
        {
          msg_error_not_link("Vui lòng nhập địa chỉ email vào ô trống", 2500);
        }
        if(check_email($email) != True) 
        {
          msg_error_not_link('Vui lòng nhập địa chỉ email hợp lệ',2500);
        }
        $row = $LINH->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ");
        $token = $row['token']; // Giá trị của token
        $reset_link = URL('public/client/reset-password.php?token='.$token);
        if(!$row)
        {
          msg_error_not_link('Địa chỉ email không tồn tại trong hệ thống',2500);
          exit;
        }
        $mail->setFrom($LINH->site('email'), 'KHÔI PHỤC LẠI MẬT KHẨU');
        $mail->addAddress($email); 
        $mail->isHTML(true);
        $mail->Subject = 'KHÔI PHỤC LẠI MẬT KHẨU';
        $mail->Body    = '<h3>Chúng tôi nhận được yêu cầu khôi phục mật khẩu.</h3>
        <table>
        <tbody>
        <tr>
        <td>Vui lòng truy cập liên kết này để đặt lại mật khẩu: '.$reset_link.'</td>
        </tr>
        </tbody>
        </table>';
        $mail->AltBody = 'Đây là tin nhắn tự động,bạn không thể trả lời thư này!';
        if(!$mail->send()) 
        {
          msg_error_not_link('Gửi Email thất bại, vui lòng thử lại !', 3000);
        }
        else 
        {
          msg_success_not_link('Yêu cầu đã được gửi đi, vui lòng kiểm tra email !', 4000);
        }
  }
?>