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
                    <h1>Thông tin cá nhân</h1>
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
          $sql = "SELECT user_id,username,name,address, email,phone,created_at FROM users WHERE user_id = $id";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<table>  
                <ul>
                <tr><td> Tài khoản &nbsp</td> <td> ' . $row["username"] . ' </td></tr>
                <tr><td> Họ tên &nbsp</td> <td> ' . $row["name"] . ' </td></tr>
                <tr><td> Địa chỉ &nbsp</td> <td> ' . $row["address"] . ' </td></tr>
                <tr><td> Email &nbsp</td> <td> ' . $row["email"] . ' </td></tr>
                <tr><td> Số điện thoại &nbsp</td><td>  ' . $row["phone"] . ' </td><tr>
                <tr><td> Thời gian tạo</td><td> ' . $row["created_at"] . '</td></tr>
                </ul>
                </table>';
              echo '<table>  
                <ul>
                <tr><td><a href="edit.php?id=' . $row["user_id"] . '; ?>">Chỉnh sửa</a></td><td><a href="resetpassword.php?id=' . $row["user_id"] . '">Đổi mật khẩu</a></td><td><a href="delete.php?id=' . $row["user_id"] . '">Xóa tài khoản</a><br></td></tr>
                </ul>
                </table>';
            }

          } else {
            echo "0 results";
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
