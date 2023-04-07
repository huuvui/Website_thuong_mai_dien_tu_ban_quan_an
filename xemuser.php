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
                    <h1>Danh sách người dùng đăng ký</h1>
                    <?php
                echo "<table style='border:solid 4px black;'>";
                echo "<tr><th>STT</th><th>Tài khoản</th><th>Họ tên</th><th>Địa chỉ</th><th>SĐT</th><th>Email</th><th>Thời gian</th></tr>";
                class TableRows extends RecursiveIteratorIterator {
                    function __construct($it) {
                      parent::__construct($it, self::LEAVES_ONLY);
                    }
                    function current() {
                      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
                    }
                    function beginChildren() {
                      echo "<tr>";
                    }
                    function endChildren() {
                      echo "</tr>" . "\n";
                    }
                  }
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "db_quanao";
 
                    try {
                         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                         $stmt = $conn->prepare("SELECT  user_id, username,name,address, phone, email, created_at FROM users"); 
                         $stmt->execute();
 
                         // thiết lập mảng kết quả thành mảng kết hợp
                         $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                         echo $v;
                         }
                        } catch(PDOException $e) {
                      echo "Error: " . $e->getMessage();
                        }
                    $conn = null;
                echo "</table>";
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
