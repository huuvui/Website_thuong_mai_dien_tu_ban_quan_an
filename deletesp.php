<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"
    </head>
    <body>
    <?php
                    $conn =mysqli_connect('localhost', 'root', '','db_quanao');
                    $id = $_GET['id'];
                    $sql = "DELETE FROM sanpham WHERE id = $id"; 
                    mysqli_query($conn, $sql);
                    header('Location: dssanpham.php')
    ?>
    </body>
</html>