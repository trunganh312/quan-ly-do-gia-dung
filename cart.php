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
    <title>Cart | F8 Shop</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <h1 style="font-size: 30px; font-weight: bold; text-align: center;">Giỏ hàng của bạn</h1>
        <ul class="header__cart-list-item">
            <?php
            // Kết nối đến cơ sở dữ liệu
            include_once "connection.php";
            session_start();
            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }

            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if (isset($_SESSION["customer_id"])) {
                $customer_id =  $_SESSION['customer_id'];

                // Truy vấn thông tin sản phẩm từ bảng "cart"
                $sql = "SELECT product_id, quantity FROM cart WHERE customer_id = '$customer_id'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Duyệt qua các hàng kết quả
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row["product_id"];
                        $quantity = $row["quantity"];

                        // Lấy thông tin sản phẩm từ bảng "product" dựa trên product_id
                        $product_sql = "SELECT * FROM products WHERE product_id = '$product_id'";
                        $product_result = $conn->query($product_sql);

                        if ($product_result->num_rows > 0) {
                            // Duyệt qua các hàng kết quả
                            while ($product_row = $product_result->fetch_assoc()) {
            ?>
                                <li class="header__cart-item">
                                    <img src="https://cf.shopee.vn/file/4b7af8582e7b284216da68e982785141" alt="Bộ kem sáng da mềm mịn" class="header__cart-img">
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name"><?php $product_row["product_name"] ?>
                                            </h5>
                                            <div class="header__cart-item-price-wrap">
                                                <span class="header__cart-item-price"><?php $product_row["price"] ?></span>
                                                <span class="header__cart-item-multiply">x</span>
                                                <span class="header__cart-item-qnt"><?php $quantity ?></span>
                                            </div>
                                        </div>

                                        <div class="header__cart-item-body">
                                            <span class="header__cart-item-description">
                                                <?php $product_row["description"] ?>
                                            </span>
                                            <span class="header__cart-item-del">
                                                Xóa
                                            </span>
                                        </div>
                                    </div>
                                </li>
            <?php
                            }
                        }
                    }
                } else {
                    echo "Không có sản phẩm trong giỏ hàng";
                }
            } else {
                echo "Người dùng chưa đăng nhập";
            }
            ?>


        </ul>
        <?php include "./footer.php"; ?>
    </div>
</body>

</html>