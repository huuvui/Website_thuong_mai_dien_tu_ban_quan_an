<?php
$conn = mysqli_connect("localhost", "root", "","db_quanao");

if (isset($_POST["btnSave"]))
{
    $tt=$_POST["txt_tt"];
    $tensanpham=$_POST["txt_tensanpham"];
    $hinhsanpham=$_POST["txt_hinhsanpham"];
    $gia=$_POST["txt_gia"];
    $sl=$_POST["txt_sl"];
    $db=$_POST["txt_db"];
    $dm=$_POST["txt_dm"];
}
$sql = "UPDATE sanpham SET tensp= '$tensanpham', hinhsp= '$hinhsanpham', cost= '$gia', soluong= '$sl', daban= '$db', iddm= '$dm' WHERE idsp = '$tt'";
if (mysqli_query($conn,$sql))
{
    header('location: dssanpham.php');
}
else{
    $result = "Cập nhật chưa thành công" . mysqli_error($conn);
}
?>