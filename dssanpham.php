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
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'db_quanao');
                    if(isset($_GET["search"]) && !empty($_GET["search"])){
                        $key =$_GET["search"];
                        $sql = "SELECT * FROM sanpham WHERE id LIKE '%$key%' OR tensp LIKE '%$key%' OR hinhsp LIKE '%$key%'
                        OR cost LIKE '%$key%' OR soluong LIKE '%$key%' OR daban LIKE '%$key%' OR iddm LIKE '%$key%' ";
                    } else{
                        $sql = "select * from sanpham";
                    }
                    $result = mysqli_query($conn, $sql);

                    ?>
                    <h1>Danh sách sản phẩm</h1>
                    <table class="search-form" align="center" cellpadding="5">
                        <tr>
                            <td>
                                <form action="" method="get">
                                    <input type="text" name="search" placeholder="Nhập sản phẩm cần tìm" value="<?php if(isset($_GET["search"])) { echo $_GET["search"]; } ?>" >
                                    <input type="submit" value="Tìm">
                                </form>
                            </td>
                        </tr>
                    </table>
    
                    <table border="1" cellspacing="5" cellpadding="5" width="100%" height="100%">
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Ảnh Sản Phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng Ban Đầu</th>
                            <th>Tồn Kho</th>
                            <th>Danh Mục Sản Phẩm</th>
                            <th>Xóa</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['tensp']; ?>
                                </td>
                                <td>
                                    <?php echo '<img src="./images/' . $row['hinhsp'] . '" alt="">'; ?>
                                </td>
                                <td>
                                    <?php echo $row['cost']; ?>
                                </td>
                                <td>
                                    <?php echo $row['soluong']; ?>
                                </td>
                                <td>
                                    <?php echo $row['daban']; ?>
                                </td>
                                <td>
                                    <?php echo $row['iddm']; ?>
                                </td>

                                <td><a href="deletesp.php?id=<?php echo $row['id']; ?>"
                                        onClick="return confirm('Bạn có thực sự muốn xóa sản phẩm này?');">Xóa</a></td>

                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                    mysqli_close($conn);
                    ?>
                </div>
                <div class="row mb">

                    <li>
                        <a href="addsanpham.php">Thêm sản phẩm +</a>
                    </li>
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


