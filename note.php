<?php
require_once "config.php";
$name = $phone = $email= $note = "";
$name_err = $phone_err= $email_err= $note_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["name"]))) {
        $name_err = "Điền họ và tên của bạn.";
    } elseif (strlen(trim($_POST["name"])) < 3) {
        $name_err = "Họ và tên phải trên 3 ký tự";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Điền số điện thoại của bạn.";
    } elseif (strlen(trim($_POST["phone"])) < 10) {
        $phone_err = "Số điện thoại phải có 10 số.";
    } else {
        $phone = trim($_POST["phone"]);
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Điền địa chỉ email của bạn.";
    } elseif (strlen(trim($_POST["email"])) < 3) {
        $email_err = "Họ và tên phải trên 3 ký tự";
    } else {
        $email = trim($_POST["email"]);
    }
    if (empty(trim($_POST["note"]))) {
        $note_err = "Nhập nội cần giải đáp của bạn.";
    } elseif (strlen(trim($_POST["note"])) < 3) {
        $note_err = "Nội dung phải trên 3 ký tự";
    } else {
        $note = trim($_POST["note"]);
    }

    if (empty($name_err) && empty($phone_err) && empty($email_err) && empty($note_err)){

        $sql = "INSERT INTO lienhe (name,phone,email,note) VALUES (:name, :phone, :email, :note)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":note", $param_note, PDO::PARAM_STR);
            $param_name = $name;
            $param_phone = $phone;
            $param_email = $email;
            $param_note = $note;
            if ($stmt->execute()) {
                header("location: index.php");
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
        <body>
        <div class="container"> 
                  <table>
                        <h2 class="u-text u-text-default u-text-1">Liên hệ với chúng tôi</h2>
                        <p class="u-align-center u-text u-text-black-50 u-text-2">Điền thông tin cần thiết.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="phone" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                            <textarea rows="4" cols="50" id="note" name="note" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Gửi">
                                <input type="reset" class="btn btn-secondary ml-2" value="Xóa">
                            </div>
                        
                        </form>
                </table>
                </div>
</body>

</html>
