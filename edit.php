<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Bookstore</title>
    <link href="images/logo.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="boxcenter">
    <div class="row mb header">  
         <div class="row mb menu">
         <ul>
         <li><a href="index.php">Trang chủ</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="lienhe.php">Liên Hệ</a></li>
                <li><a href="dangky.php">Đăng Ký</a></li>
            </ul>
        </div>
        </div>
        <div class="row mb ">
            <div class="boxtrai mr">
                
                <div class="row mb">
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "db_quanao";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        $id = $_SESSION['user_id'];
                        $query = "SELECT * from users where user_id='" . $id . "'";
                        $result = mysqli_query($conn, $query) or die(mysqli_error());
                        $row = mysqli_fetch_assoc($result);
                        ?>

                        <?php
                        $status = "";
                        if (isset($_POST['new']) && $_POST['new'] == 1) {
                            $id = $_REQUEST['user_id'];
                            $username = $_REQUEST['username'];
                            $name = $_REQUEST['name'];
                            $address = $_REQUEST['address'];
                            $email = $_REQUEST['email'];
                            $phone = $_REQUEST['phone'];
                            $update = "update users set 
                            username='" . $username . "',name='" . $name . "',address='" . $address . "',email='" . $email . "' ,phone='" . $phone . "' where user_id='" . $id . "'";
                            mysqli_query($conn, $update) or die(mysqli_error());
                            $status = "Cập nhật thành công </br></br>
                            <a href='info.php'>Xem lại trang cá nhân</a>";
                            echo '<p style="color:#FF0000;">' . $status . '</p>';
                        } else {
                        ?>
                            <div>
                                <form name="form" method="post" action="">
                                    <input type="hidden" name="new" value="1" />
                                    <input name="user_id" type="hidden" value="<?php echo $row['user_id']; ?>" />
                                    <p><input type="text" name="username" placeholder="Nhập tên tài khoản của bạn" required value="<?php echo $row['username']; ?>" /></p>
                                    <p><input type="text" name="name" placeholder="Nhập tên của bạn" required value="<?php echo $row['name']; ?>" /></p>
                                    <p><input type="text" name="address" placeholder="Nhập địa chỉ của bạn" required value="<?php echo $row['address']; ?>" /></p>
                                    <p><input type="text" name="email" placeholder="Nhập email của bạn" required value="<?php echo $row['email']; ?>" /></p>
                                    <p><input type="text" name="phone" placeholder="Nhập SĐT cần chỉnh sửa" required value="<?php echo $row['phone']; ?>" /></p>
                                    <p><input name="submit" type="submit" value="Lưu thay đổi" /></p>
                                </form>
                            <?php } ?>
                            </div>
                
                </div>
                
                <div class="row mb footer">
                <p>© 2022 Bản quyền thuộc về happybookstore.VN:
                    <a href="https://vi-vn.facebook.com/">Facebook</a>
                    <a href="https://www.instagram.com//">Instagram</a>
                    <a href="https://twitter.com/i/flow/login">Twitter</a>
                    <a href="https://www.pinterest.com/">Printerest</a>
                </p>
            </div>
        </div>
    
    
    </body>
    
    </html>
    