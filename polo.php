<?php
session_start();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
            crossorigin="anonymous" 
            referrerpolicy="no-referrer"
    ></script>
   <!-- Thư viện jquery đã nén phục vụ cho bootstrap.min.js  -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <!-- Thư viện popper đã nén phục vụ cho bootstrap.min.js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
   <!-- Bản js đã nén của bootstrap 4, đặt dưới cùng trước thẻ đóng body-->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>
    </div>
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
                <div class="row">
                </div>
                <div class="row">
                <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_quanao";
// tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm kết nối
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT tensp,hinhsp,cost,ban FROM sanpham where iddm=2";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// Load dữ liệu lên website
while($row = $result->fetch_assoc()) {
    echo'
    <div class="boxsp mr">
    <form action="cart.php" method="post">
    <div class="row img"><img src="./images/'.$row['hinhsp'].'" alt=""></div>
    <p>'.$row['tensp'].'</p>
    <label>Đã bán '.$row['ban'].' sản phẩm.</label>
    <p><span>'.$row['cost'].'</span>VNĐ</p>
        <input type="number" name="soluong" min="1" max="100" value="1">
        </br>
        <label>Color:</label>
                                <select name="color">
                                     <option value="Trắng">Trắng</option>
                                     <option value="Đen">Đen</option>
                                     <option value="Xanh">Xanh</option>
                                     <option value="Đỏ">Đỏ</option>
                                </select>
        <label>Size:</label>
            <select name="size">
                 <option value="S">S</option>
                 <option value="M">M</option>
                 <option value="L">L</option>
                 <option value="XL">XL</option>
            </select>
        <input type="submit" name="addcart" value="Đặt hàng">
        <input type="hidden" name="tensp" value="'.$row['tensp'].'">
        <input type="hidden" name="cost" value="'.$row['cost'].'">
        <input type="hidden" name="hinhsp" value="'.$row['hinhsp'].'">
       
    </form>
</div>';
}
} else {
echo "0 results";
}
$conn->close();
?>
                   
                   
                </div>
            </div>
            <div class="boxphai">
                <div class="row mb">
                    <div class="boxtitle">DANH MỤC NỔI BẬT<Table></Table></div>
                    <div class="boxcontent2 menudoc">
                        <ul>

                        <li>
                                <a href="somi.php">Áo Sơ Mi </a>
                            </li>
                            <li>
                                <a href="polo.php">Polo</a>
                            </li>
                            <li>
                                <a href="quantay.php">Quần Tây Âu </a>
                            </li>
                            <li>
                                <a href="aokhoac.php">Áo Khoác</a>
                            </li>
                            <li>
                                <a href="vest.php">Vest</a>
                            </li>
                        </ul>
                    </div>
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