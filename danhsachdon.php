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
                    <h1>Danh Sách Đơn Hàng</h1>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'db_quanao');
                    $sql = "SELECT distinct   bill.id,bill.username,cart.idbill,bill.name,cart.tensp,cart.hinhsp,cart.soluong,cart.dongia,cart.size,cart.color,cart.thanhtien,bill.address, bill.phone, bill.email,bill.total,bill.pttt, bill.created_at, bill.xacnhan FROM bill, cart where bill.id=cart.idbill";

                    $recordset = mysqli_query($conn, $sql);

                    ?>
                    <table border="0">
                        <tr>
                            <th>ID Đơn Hàng</th>
                            <th>Tên Tài Khoản</th>
                            <th>Tên Khách Hàng</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Size/Màu Sắc</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                            <th>SĐT</th>
                            <th>Địa Chỉ</th>
                            <th>Phương Thức Thanh Toán</th>
                            <th>Tổng Thanh Toán</th>
                            <th>Thời Gian Đặt Hàng</th>
                            <th>Trạng Thái Đơn Hàng</th>
                            <th>Xóa Đơn Hàng</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($recordset)) {
                            ?>
                            <tr>
        `                       <td>
                                    <?php echo $row['idbill']; ?>
                                </td>
                                <td>
                                    <?php echo $row['username']; ?>
                                </td>
                                <td>
                                    <?php echo $row['name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['tensp']; ?>
                                </td>
                                <td> <?php echo '<img src="./images/'.$row['hinhsp'].'" width="100" height="120" alt="">';?></td>
                                <td>
                                    <?php echo $row['soluong']; ?>
                                </td>
                                <td> <?php echo $row['size'].'/'.$row['color'];?></td>
                                <td>
                                    <?php echo $row['dongia']; ?>
                                </td>
                                <td>
                                    <?php echo $row['thanhtien']; ?>
                                </td>
                                <td>
                                    <?php echo $row['phone']; ?>
                                </td>
                                <td>
                                    <?php echo $row['address']; ?>
                                </td>
                                <td>
                                    <?php echo $row['pttt']; ?>
                                </td>
                                <td>
                                    <?php echo $row['total']; ?>
                                </td>
                                <td>
                                    <?php echo $row['created_at']; ?>
                                </td>
                                <td>
                                    <?php echo $row['xacnhan']; ?>
                                </td>
                                <td><a href="deletedh.php?id=<?php echo $row['id']; ?>"
                                        onClick="return confirm('Xác nhận xóa đơn hàng này?');">Xóa</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                    mysqli_close($conn);
                    ?>
                </div>

            </div>

            <div class="boxtrai mr">

                <div class="row mb">
                    <h1>Số Lượng Bán Ra</h1>

                    <?php
                    echo "<table style='border:solid 4px black;'>";
                    echo "<tr><th>Tổng Sản Phẩm Bán Được</th></tr>";
                    class TableRows extends RecursiveIteratorIterator
                    {
                        function __construct($it)
                        {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }
                        function current()
                        {
                            return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
                        }
                        function beginChildren()
                        {
                            echo "<tr>";
                        }
                        function endChildren()
                        {
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
                        $stmt = $conn->prepare("SELECT sum(cart.soluong) FROM bill,cart where bill.id=cart.idbill");
                        $stmt->execute();

                        // thiết lập mảng kết quả thành mảng kết hợp
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                            echo $v;
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                    ?>
                </div>

            </div>
            <div class="boxtrai mr">

                <div class="row mb">
                    <h1>Doanh Thu Bán Hàng</h1>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'db_quanao');
                    $sql = "select distinct sum(total) from bill";

                    $recordset = mysqli_query($conn, $sql);

                    ?>
                    <table border="1" cellspacing="5" cellpadding="5" width="100%" height="100%">
                        <tr>
                            <th>Doanh Thu</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($recordset)) {
                            ?>
                            <tr>
                                <td>
                                <?php
                                $num =$row['sum(total)'];
                                $formattedNum = number_format($num,0 , ',','.');
                                $formatted= sprintf($formattedNum.'.000'); 
                                echo $formatted;
                                ?>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                    mysqli_close($conn);
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