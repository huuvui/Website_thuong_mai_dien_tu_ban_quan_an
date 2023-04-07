<?php
    session_start();
    include "function.php";
    if(isset($_POST['dathang'])&&($_POST['dathang'])){
        //lấy thông tin kh từ form để tạo đơn hàng
        $username=$_POST['username'];
        $name=$_POST['hoten'];
        $address=$_POST['diachi'];
        $phone=$_POST['dienthoai'];
        $email=$_POST['email'];
        $total=tongdonhang();
        $pttt=$_POST['pttt'];;

        //insert đơn hàng - tạo đơn hàng mới
        $idbill=taodonhang($username,$name,$address,$phone,$email,$total,$pttt);

        
        //lấy thông tin giỏ hàng từ session + id đơn hàng vừa tạo
        //insert vào bảng giỏ hàng

        for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) { 
            $tensp=$_SESSION['giohang'][$i][1];
            $hinhsp=$_SESSION['giohang'][$i][0];
            $cost=$_SESSION['giohang'][$i][2];
            $soluong=$_SESSION['giohang'][$i][3];
            $size=$_SESSION['giohang'][$i][4];
            $color=$_SESSION['giohang'][$i][5];
            $thanhtien=$cost*$soluong;
            taogiohang($tensp,$hinhsp,$cost,$soluong,$size,$color,$thanhtien,$idbill);
        }

        //show confirm đơn hàng

        $ttkh='Vui lòng đợi xác nhận đơn hàng từ hệ thống!<br><h1>Mã đơn hàng: '.$idbill.'</h1>
                <h2>THÔNG TIN NHẬN HÀNG</h2>
                <table class="thongtinnhanhang">
                <tr>
                    <td width="20%">Tài khoản</td>
                    <td>'.$username.'</td>
                </tr>
                <tr>
                    <td width="20%">Họ tên</td>
                    <td>'.$name.'</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>'.$address.'</td>
                </tr>
                <tr>
                    <td>Điện thoại</td>
                    <td>'.$phone.'</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>'.$email.'</td>
                </tr>
                <tr>
                <tr>
                <td>Phương thức thanh toán</td>
                <td>'.$pttt.'</td>
            </tr>
            </table>';
            $ttgh=showgiohang();


        //unset giỏ hàng session

        unset($_SESSION['giohang']);

    }
    
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
            <div class="boxtrai mr" id="bill">
                <div class="row" >
                   <?php echo $ttkh;?> 
                </div>
                <div class="row mb">
                    <h2>GIỎ HÀNG</h2>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Hình</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá(VNĐ)</th>
                            <th>Số lượng</th>
                            <th>Size</th>
                            <th>Màu sắc</th>
                            <th>Thành tiền(VNĐ)</th>
                        </tr>
                        <?php echo $ttgh; ?>
                        
                    </table>
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
