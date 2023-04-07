<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HUI Fashion</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="images/0.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
</head>

<body>
<div class="boxcenter">
        
        <div class="row mb header">  
       
         <div class="row mb menu">
            <div class="center-parent">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="sanpham.php">Sản Phẩm</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="lienhe.php">Liên Hệ</a></li>
                <li><a href="dangky.php">Đăng Ký</a></li>

            </ul>
            
        </div>
         </div>
        </div>
        <div class="row mb ">
            <div class="boxtrai mr">
                
                <div class="row mb">
                    <h1>Lịch Sử Đơn Hàng</h1>
                    <?php

          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "db_quanao";
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $id = $_SESSION['user_id'];
          $sql = "SELECT users.user_id,users.username,bill.name,bill.address,bill.id,cart.tensp,cart.hinhsp ,cart.dongia,cart.size,cart.color,cart.soluong,cart.thanhtien, users.phone, users.created_at,bill.xacnhan FROM users,cart,bill WHERE users.user_id = $id and cart.idbill=bill.id and users.username=bill.username";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<table>  
              <tr><th> Đơn hàng&nbsp</th><th> Tài khoản &nbsp</th><th> Họ tên &nbsp</th><th> Tên sản phẩm &nbsp</th><th> Hình ảnh sản phẩm &nbsp</th><th> Đơn giá&nbsp</th><th> Số lượng &nbsp</th><th> Màu sắc &nbsp</th><th> Size &nbsp</th><th> Thành tiền &nbsp</th><th> Địa chỉ &nbsp</th><th> Số điện thoại &nbsp</th><th> Thời gian đặt hàng</th><th> Chờ xác nhận</th></td>
                <ul>

                <tr><th> ' . $row["id"] . ' </th><th> ' . $row["username"] . ' </th><th> ' . $row["name"] . ' </th><th> ' . $row["tensp"] . ' </th><th> ' .'<img src="./images/'.$row['hinhsp'].'" width="100" height="120" alt="">'. ' </th><th> ' . $row["dongia"] . ' </th><th> ' . $row["soluong"] . ' </th><th> ' . $row["color"] . ' </th><th> ' . $row["size"] . ' </th><th> ' . $row["thanhtien"] . ' </th><th> ' . $row["address"] . ' </th><th> ' . $row["phone"] . ' </th><th> ' . $row["created_at"] . ' </th><th> ' . $row["xacnhan"] . ' </th></tr>
                
                </ul>
                </table>';
            }

          } else {
            echo "Bạn chưa đặt hàng!";
          }
          ?>
                </div>
                
            </div>
            
            <div class="row mb footer">
            <p>© 2022 Bản quyền thuộc về HUIFashion.com.vn:
                <a href="https://vi-vn.facebook.com/">Facebook</a>
                <a href="https://www.instagram.com//">Instagram</a>
                <a href="https://twitter.com/i/flow/login">Twitter</a>
                <a href="https://www.pinterest.com/">Printerest</a>
            </p>
        </div>
    </div>


</body>

</html>
