<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_quanao";

$connect = new mysqli($servername, $username, $password, $dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($connect->connect_error) {
    die("Không kết nối :" . $conn->connect_error);
    exit();
}


$tensp = "";
$hinhsp = "";
$cost = "";
$soluong = "";
$daban = "";
$iddm = "";

//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["tensp"])) { $tensp = $_POST['tensp']; }
    if(isset($_POST["hinhsp"])) { $hinhsp = $_POST['hinhsp']; }
    if(isset($_POST["cost"]))   { $cost = $_POST['cost']; }
    if(isset($_POST["soluong"])) { $soluong = $_POST['soluong']; }
    if(isset($_POST["daban"])) { $daban = $_POST['daban']; }
    if(isset($_POST["iddm"])) { $iddm = $_POST['iddm']; }

    //Code xử lý, insert dữ liệu vào table
    $sql = "INSERT INTO sanpham (tensp, hinhsp, cost, soluong, daban, iddm)
    VALUES ('$tensp', '$hinhsp', '$cost', '$soluong', '$daban','$iddm')";

    if ($connect->query($sql) === TRUE) {
        echo "Sửa sản phẩm thành công";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}
//Đóng database
$connect->close();
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome!">
    <meta name="description" content="">
    <title>HUI Fashion</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="images/0.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.21.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link rel="stylesheet" href="register.css" media="screen">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<link rel="stylesheet" href="css/style.css">

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
<body>
<div class="boxcenter">
                <div class="container"> 
                    <table>
                        <h2 class="u-text u-text-default u-text-1">Thêm sản phẩm mới</h2>
                        <p class="u-align-center u-text u-text-black-50 u-text-2"><a href="dssanpham.php">Xem danh sách sản phẩm</a></p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="tensp" class="form-control " value="<?php echo $tensp; ?>">
                               
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh sản phẩm</label>
                                <input type="file" name="hinhsp" class="form-control " value="<?php echo $hinhsp; ?>">
                
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" name="cost" class="form-control " value="<?php echo $cost; ?>">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="text" name="soluong" class="form-control" value="<?php echo $soluong; ?>">
                            </div>
                            <div class="form-group">
                                <label>Số lượng trong kho</label>
                                <input type="text" name="daban" class="form-control" value="<?php echo $daban; ?>">
                            </div>
                            <div class="form-group">
                                <label>Danh Mục Sản Phẩm</label>
                                <input type="text" name="iddm" class="form-control" value="<?php echo $iddm; ?>">
                            </div>
                            <div class="form-group">
                            <button type="submit">Thêm sản phẩm</button>
                            </div>
                        </form>
                    </table>
                </div>
</div>
<div >
<li>
                                
                            </li>
        </div>
</body>

</html>