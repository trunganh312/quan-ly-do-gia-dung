<?php
include_once "./connection.php";

// Lấy thông tin đăng nhập từ biểu mẫu
$emailInput = isset($_POST['email']) ? $_POST['email'] : "";
$passwordInput = isset($_POST['password']) ? $_POST['password'] : "";

// Kết nối cơ sở dữ liệu

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $conn->connect_error);
}

// Xây dựng câu truy vấn
$sql = "SELECT * FROM customers WHERE email = '$emailInput' AND password = '$passwordInput'";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Đăng nhập thành công
    session_start();
    $_SESSION['email'] = $emailInput;
    $_SESSION['first_name'] = $row["first_name"];
    $_SESSION['last_name'] = $row["last_name"];
    $_SESSION['customer_id'] = $row["customer_id"];
    header("Location: index.php");
} else {
    // Đăng nhập thất bại
    echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!');</script>";
}

// Đóng kết nối
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/grid.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="favico" rel="icon" type="image/png" href="https://bizweb.dktcdn.net/100/327/577/files/2.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="./js/app.js"></script>
    <title>Login | F8 Shop </title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Header -->

        <div style="display: flex; justify-content: center; padding: 20px; background-color: lightsalmon;">
            <div class="auth-form ">
                <form class="auth-form__container" method="post" action="">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng nhập</h3>
                        <a href="register.php"> <span class="auth-form__switch-btn">Đăng kí</span></a>
                    </div>
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $emailInput : "" ?>" class="auth-form__input" placeholder="Email của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" name="password" class="auth-form__input" placeholder="Mật khẩu của bạn">
                        </div>
                    </div>

                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <a href="#" class="auth-form__help-link auth-form__help-forgot">
                                Quên mật khẩu
                            </a>
                            <span class="auth-form__help-separate"></span>
                            <a href="#" class="auth-form__help-link">
                                Cần trợ giúp?
                            </a>
                        </div>
                    </div>

                    <div class="auth-form__controls">
                        <button class="btn btn--normal auth-form__controls-back">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG NHẬP</button>
                    </div>
                </form>

                <div class="auth-form__socials">
                    <a href="#" class="auth-form__socials--facebook btn btn--size-s btn--width-icon">
                        <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                        <span class="auth-form__social-title">
                            Kết nối với facebook
                        </span>
                    </a>
                    <a href="#" class="auth-form__socials--google btn btn--size-s btn--width-icon">
                        <i class="auth-form__socials-icon fab fa-google auth-form__socials-icon--google-color"></i>
                        <span class="auth-form__social-title">
                            Kết nối với google
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>
    </div>



</body>

</html>