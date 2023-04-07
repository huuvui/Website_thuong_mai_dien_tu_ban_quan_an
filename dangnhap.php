<?php
// Khởi tạo session
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu có thì chuyển hướng người đó đến trang index
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $user_type ="";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT user_id, username, user_type, password FROM users WHERE username = :username";

    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

      // Set parameters
      $param_username = trim($_POST["username"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Check if username exists, if yes then verify password
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
            $id = $row["user_id"];
            $username = $row["username"];
            $hashed_password = $row["password"];
            $user_type = $row["user_type"];
            if (password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["user_id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["user_type"] = $user_type;

              // Redirect user to welcome page
              header("location: index.php");
            } 
            else {
                  $login_err = "Invalid username or password.";
            }
          }

        } 
        
      } 

      // Close statement
      unset($stmt);
    }
  }

  // Close connection
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
   <style>

  
  /* style inputs and link buttons */
  
  /* add appropriate colors to fb, twitter and google buttons */
  .fb {
    background-color: #3B5998;
    color: white;
  }
  
  
  .google {
    background-color: #dd4b39;
    color: white;
  }

  </style>
</head>

<body>
<div class="boxcenter">
                <div class="container"> 
                  <table>
                        <h2 class="u-text u-text-default u-text-1"></h2>
                        <p class="u-align-center u-text u-text-black-50 u-text-2"></p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="container">
                      <form action="/action_page.php">
                         <div class="row">
                           <h2 style="text-align:center">Login with</h2>
                           <div class="vl">
                              <div class="col">
                                <a href="https://vi-vn.facebook.com/" class="fb btn">
                                     <i class="fa fa-facebook fa-fw"></i>Facebook
                                         </a>
                  
                                                     <a href="https://www.google.com.vn/?hl=vi" class="google btn"><i class="fa fa-google fa-fw">
                                                        </i>Google+
                                                           </a>
                                                              </div>

                                                           <div class="col">
                                                            <div class="hide-md-lg">
                                                        <h2>Điền Thông Tin Đăng Nhập:</h2>
                                                             </div>
                            <div class="form-group">
                                <label>Tài khoản</label>
                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
</br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Đăng nhập">
                                <input type="reset" class="btn btn-secondary ml-2" value="Xóa">
                            </div>
                            <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a>.</p>
                        </form>
                        <table>
                    </div>
</div>
</body>

</html>

