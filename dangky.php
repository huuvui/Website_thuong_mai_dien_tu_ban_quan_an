<?php
require_once "config.php";
$username = $password = $confirm_password= $name= $address= $email= $phone = "";
$username_err = $password_err = $confirm_password_err = $name_err= $address_err = $email_err= $phone_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        $sql = "SELECT username FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "Tài khoản này đã tồn tại.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Mật khẩu phải nhiều hơn 6 ký tự.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Hãy nhập lại mật khẩu.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Mật khẩu không khớp.";
        }
    }
    if (empty(trim($_POST["name"]))) {
        $name_err = "Điền họ và tên của bạn.";
    } elseif (strlen(trim($_POST["name"])) < 3) {
        $name_err = "Họ và tên phải trên 3 ký tự";
    } else {
        $name = trim($_POST["name"]);
    }
    if (empty(trim($_POST["address"]))) {
        $address_err = "Điền địa chỉ của bạn.";
    } elseif (strlen(trim($_POST["address"])) < 3) {
        $address_err = "Địa chỉ phải trên 3 ký tự";
    } else {
        $address = trim($_POST["address"]);
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Điền email của bạn.";
    } elseif (strlen(trim($_POST["email"])) < 3) {
        $email_err = "Email phải trên 3 ký tự";
    } else {
        $email = trim($_POST["email"]);
    }
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Điền số điện thoại của bạn.";
    } elseif (strlen(trim($_POST["phone"])) < 10) {
        $phone_err = "Số điện thoại phải có 10 số.";
    } else {
        $phone = trim($_POST["phone"]);
    }
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err)&& empty($address_err) && empty($email_err) && empty($phone_err)){

        $sql = "INSERT INTO users (username, password, name, address, email,phone) VALUES (:username, :password, :name, :address,:email, :phone)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_name = $name;
            $param_address = $address;
            $param_email = $email;
            $param_phone = $phone;
            if ($stmt->execute()) {
                header("location: dangnhap.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
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
                        <h2 class="u-text u-text-default u-text-1">ĐĂNG KÝ THÀNH VIÊN</h2>
                        <p class="u-align-center u-text u-text-black-50 u-text-2">Điền thông tin cần thiết.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Tài khoản</label>
                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="address" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                                <span class="invalid-feedback"><?php echo $address_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="phone" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Đăng ký">
                                <input type="reset" class="btn btn-secondary ml-2" value="Xóa">
                            </div>
                            <p>Đã có tài khoản? <a href="dangnhap.php">Đăng nhập tại đây</a>.</p>
                        </form>
                    </table>
                </div>
</div>
</body>

</html>