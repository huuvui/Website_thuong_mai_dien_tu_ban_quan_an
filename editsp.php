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
                        $id = $_SESSION['idsp'];
                        $sql = "SELECT * from sanpham where idsp='" . $id . "'";
                        $result = mysqli_query($conn, $sql);

                        // Associative array
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <?php
                        $status = "";
                        if (isset($_POST['new']) && $_POST['new'] == 1) {
                            $id = $_REQUEST['idsp'];
                            $tensp = $_REQUEST['tensp'];
                            $hinhsp = $_REQUEST['hinhsp'];
                            $cost = $_REQUEST['cost'];
                            $soluong = $_REQUEST['soluong'];
                            $daban = $_REQUEST['daban'];
                            $iddm = $_REQUEST['iddm'];
                            $update = "UPDATE sanpham set 
                            tensp='" . $tensp . "',hinhsp='" . $hinhsp . "',cost='" . $cost . "',soluong='" . $soluong . "' ,daban='" . $daban . "' ,iddm='" . $iddm. "' where idsp='" . $id . "'";
                            mysqli_query($conn, $update);
                            $status = "Cập nhật thành công </br></br>
                            <a href='dssanpham.php'>Xem trang san pham</a>";
                            echo '<p style="color:#FF0000;">' . $status . '</p>';
                        } else {
                        ?>
                            <div>
                                <form name="form" method="post" action="">
                                    <input type="hidden" name="new" value="1" />
                                    <input name="idsp" type="hidden" value="<?php echo $row['idsp']; ?>" />
                                    <p><input type="text" name="tensp" class="form-control " placeholder="Nhập tên san pham" required value="<?php echo $row['tensp']; ?>" /></p>
                                    <p><input type="file" name="hinhsp" placeholder="Nhập hinh san pham" required value="<?php echo $row['hinhsp']; ?>" /></p>
                                    <p><input type="text" name="cost" placeholder="Nhập gia" required value="<?php echo $row['cost']; ?>" /></p>
                                    <p><input type="text" name="soluong" placeholder="Nhập email của bạn" required value="<?php echo $row['soluong']; ?>" /></p>
                                    <p><input type="text" name="daban" placeholder="Nhập SĐT cần chỉnh sửa" required value="<?php echo $row['daban']; ?>" /></p>
                                    <p><input type="text" name="iddm" placeholder="Nhập SĐT cần chỉnh sửa" required value="<?php echo $row['iddm']; ?>" /></p>
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
    