<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include_once "connection.php";
// Kiểm tra xem người dùng đã đăng nhập chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$quantity = isset($_POST['quantity']) ? $_GET['quantity'] : 0;
if (isset($_SESSION['customer_id']) && isset($_GET['product_id'])) {
    $customerId = $_SESSION['customer_id']; // Lấy customer_id từ session hoặc từ thông tin đăng nhập

    // Lấy product_id và quantity từ yêu cầu hoặc từ ô văn bản
    $productId = $_GET['product_id']; // Đảm bảo bạn có tên ô văn bản chứa product_id
    // Đảm bảo bạn có tên ô văn bản chứa quantity
    $quantity = isset($_POST['quantity']) ? $_GET['quantity'] : 0;
    $query = "SELECT * FROM cart WHERE customer_id = '$customerId' AND product_id = '$productId'";
    $result = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $row = mysqli_fetch_assoc($result);
        $existingQuantity = $row['quantity'];
        $newQuantity = $existingQuantity + $quantity;

        $updateQuery = "UPDATE cart SET quantity = '$newQuantity' WHERE customer_id = '$customerId' AND product_id = '$productId'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "";
        } else {
            echo "Lỗi khi cập nhật giỏ hàng: " . mysqli_error($conn);
        }
    } else {
        // Sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
        $insertQuery = "INSERT INTO cart (customer_id, product_id, quantity) VALUES ('$customerId', '$productId', '$quantity')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "";
        } else {
            echo "Lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($conn);
        }
    }
}
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

    <title><?php
            include_once "connection.php";
            $product_id = $_GET['product_id'];
            $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Tìm thấy sản phẩm, render kết quả ra view
                $product = $result->fetch_assoc();
                echo $product['product_name'];
            ?>

        <?php
            }
        ?> | Shop đồ gia dụng</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include 'header.php' ?>

        <div class="product__container product__container-detail">
            <div class="grid wide fix-wide-on-tablet product__container--padding">

                <?php include "productDetails.php" ?>

                <?php include "productDesc.php" ?>


            </div>
        </div>

        <?php include 'footer.php'  ?>
    </div>
</body>

</html>