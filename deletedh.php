<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"
    </head>
    <body>
    <?php
                    $conn =mysqli_connect('localhost', 'root', '','db_quanao');
                    $id = $_GET['id'];
                    $sql = "DELETE FROM bill WHERE id = $id"; 
                    mysqli_query($conn, $sql);
                    header('Location: danhsachdon.php')
    ?>
    </body>
</html>