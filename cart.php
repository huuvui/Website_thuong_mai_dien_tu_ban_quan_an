<?php
    session_start();
    if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];
    //làm rỗng giỏ hàng
    if(isset($_GET['delcart'])&&($_GET['delcart']==1)) unset($_SESSION['giohang']);
    //xóa sp trong giỏ hàng
    if(isset($_GET['delid'])&&($_GET['delid']>=0)){
       array_splice($_SESSION['giohang'],$_GET['delid'],1);
    }
    //lấy dữ liệu từ form
    if(isset($_POST['addcart'])&&($_POST['addcart'])){
        $hinhsp=$_POST['hinhsp'];
        $tensp=$_POST['tensp'];
        $cost=$_POST['cost'];
        $soluong=$_POST['soluong'];
        $size=$_POST['size'];
        $color=$_POST['color'];
        //kiem tra sp co trong gio hang hay khong

        $fl=0; //kiem tra sp co trung trong gio hang khong

        for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) { 
            
            if($_SESSION['giohang'][$i][1]==$tensp){
                $fl=1;
                $soluongnew=$soluong+$_SESSION['giohang'][$i][3];
                $_SESSION['giohang'][$i][3]=$soluongnew;
                break;

            }
        }
        if($fl==0){
            //them moi sp vao gio hang
            $sp=[$hinhsp,$tensp,$cost,$soluong,$size,$color];
            $_SESSION['giohang'][]=$sp;
        }
    }

    function showgiohang(){
        if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
            if(sizeof($_SESSION['giohang'])>0){
                $tong=0;
                for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) { 
                    $t=($_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3]);  
                    $tt = sprintf('%.3f', $t);  
                    $tong+=$tt;
                    $tong = sprintf('%.3f', $tong); 
                    echo '<tr>
                            <td>'.($i+1).'</td>
                            <td><img src="./images/'.$_SESSION['giohang'][$i][0].'" alt=""></td>
                            <td>'.$_SESSION['giohang'][$i][1].'</td>
                            <td>'.$_SESSION['giohang'][$i][2].'</td>
                            <td>'.$_SESSION['giohang'][$i][3].'</td>
                            <td>'.$_SESSION['giohang'][$i][4].'</td>
                            <td>'.$_SESSION['giohang'][$i][5].'</td>
                            <td>
                                <div>'.$tt.'</div>
                            </td>
                            <td>
                                <a href="cart.php?delid='.$i.'">Xóa</a>
                            </td>
                        </tr>';
                }
            echo '<tr>
                        <th colspan="5">Tổng đơn hàng</th>
                        <th>
                            <div>'.$tong.'</div>
                        </th>
    
                    </tr>';
            }
    }    
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
$sql ="SELECT users.user_id, users.username, users.name, users.phone, users.address, users.email FROM users WHERE user_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo'
    <div class="row mb ">
    <div class="boxtrai mr" id="bill">
                <form action="bill.php" method="post">
                
                <div class="row" >
                    <h1>THÔNG TIN NHẬN HÀNG</h1>
                    <table class="thongtinnhanhang">
                    <tr>
                            <td width="20%">Tài khoản</td>
                            <td><input type="text" name="username" value="'.$row['username'].'" required></td>
                        </tr>
                        <tr>
                            <td width="20%">Họ tên</td>
                            <td><input type="text" name="hoten" value="'.$row['name'].'" required></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td><input type="text" name="diachi" value="'.$row['address'].'" required></td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td><input type="text" name="dienthoai" value="'.$row['phone'].'"required></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" value="'.$row['email'].'" required></td>
                        </tr>
                        <tr>
                       <td>Phương thức thanh toán</td>
                        <td><label for="pttt">Chọn phương thức:</label>
                        <select name="pttt">
                         <option value="Thanh toán qua thẻ">Thanh toán qua thẻ</option>
                         <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                        </select></td>
                        </tr>
                    </table>
    </form>
';
}
} else {
echo "0 results";
}
$conn->close();
?>
                
                <div class="row mb">
                    <h1>GIỎ HÀNG</h1>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Hình</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá(VND)</th>
                            <th>Số lượng</th>
                            <th>Size</th>
                            <th>Màu sắc</th>
                            <th>Thành tiền(VND)</th>
                            <th>Xóa</th>
                        </tr>
                        <?php showgiohang(); ?>
                    </table>
                </div>
                <div class="center-parent">
                <div class="row mb">
                    <input type="submit" value="ĐẶT HÀNG" name="dathang">
                    <a href="cart.php?delcart=1"><input type="button" value="XÓA GIỎ HÀNG"></a>
                    <a href="index.php"><input type="button" value="TIẾP TỤC ĐẶT HÀNG"></a>
                </div>
                </div>
            </form>
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

