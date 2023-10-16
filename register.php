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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="favico" rel="icon" type="image/png" href="https://bizweb.dktcdn.net/100/327/577/files/2.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="./js/app.js"></script>
    <title>Register | F8 Shop</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper" style="overflow: hidden;">
        <!-- Header -->

        <div style="display: flex; justify-content: center; padding: 20px; background-color: lightsalmon;">
            <div class="auth-form">
                <form class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng kí</h3>
                        <a href="login.php" class="auth-form__switch-btn"><span class="auth-form__switch-btn">Đăng
                                nhập</span></a>
                    </div>
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Email của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Mật khẩu của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu của bạn">
                        </div>
                    </div>

                    <div class="auth-form__aside">
                        <p class="auth-form__policy-text">
                            Bằng việc đăng kí, bạn đã đồng ý với F8 Shop về
                            <a href="#" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="#" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>

                    <div class="auth-form__controls">
                        <button class="btn btn--normal auth-form__controls-back">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÍ</button>
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