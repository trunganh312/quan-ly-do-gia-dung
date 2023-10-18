<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include_once "connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $product_id = $_GET['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $manufacturer_id = $_POST['manufacturer_id'];

    // Thực hiện truy vấn UPDATE để cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $query = "UPDATE Products
            SET product_name = '$product_name', description = '$description', price = '$price', manufacturer_id = '$manufacturer_id'
            WHERE product_id = '$product_id'";
    mysqli_query($conn, $query);
    header("Location: admin.php");
}
