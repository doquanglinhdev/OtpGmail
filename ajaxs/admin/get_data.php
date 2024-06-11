<?php
  require("../../config/config.php");
  require("../../config/function.php");
?>
<?php
if(isset($_POST['type']) && $_POST['type'] == 'craw'){
  $token = $LINH->site('api_otp');
  $url = 'https://api.usotp.xyz/services?apikey='.$token;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($curl);
  if (curl_errno($curl)) {
    $error_message = curl_error($curl);
    msg_error_not_link('Lỗi khi thực hiện yêu cầu', 3000);
    exit;
  }
  $serviceData = json_decode($data, true);
  if ($serviceData) {
    foreach ($serviceData as $service) {
      $name_api = $service['name'];
      $display = 'SHOW';
      $price_order = $service['price'];
      $price_plus = $LINH->site('price_plus');
      $price = $price_order + $price_plus;
      $title = $service['title'];
      // Kiểm tra dữ liệu đã có trong CSDL hay chưa
      $check_query = "SELECT * FROM services WHERE name_api = '$name_api'";
      $result = $LINH->query($check_query);
      $num_rows = $LINH->num_rows($check_query);
      if ($num_rows > 0) {
        if($name_api == "facebook5" && $price_order >= '400'){
          $price = $price_order + 5;
        }
          // Nếu đã có dữ liệu, thực hiện cập nhật
          $update_query = "UPDATE services SET display = '$display', price_order = '$price_order', price = '$price', title_name = '$title' WHERE name_api = '$name_api'";
          $LINH->query($update_query);
      } else {
          // Nếu chưa có dữ liệu, thực hiện thêm mới
          $insert_query = "INSERT INTO services (title_name, display, price_order, price, name_api) VALUES ('$title', '$display', '$price_order', '$price', '$name_api')";
          $LINH->query($insert_query);
      }
    }
    msg_success_link('Lấy dữ liệu thành công', "", 2000);
  }else{
    msg_error_not_link('Không thể lấy dữ liệu từ api', 3000);
  }
}
?>