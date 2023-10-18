<?php
include_once "connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $manufacturer_id = $_POST['manufacturer_id'];
    $image_url = $_POST['image_url'];

    // Thực hiện truy vấn INSERT để thêm sản phẩm vào cơ sở dữ liệu

    $query = "INSERT INTO products ( product_name, description , price , manufacturer_id, image_url)
              VALUES ('$product_name', '$description',  '$price', '$manufacturer_id', '$image_url')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Sản phẩm đã được thêm thành công
        echo "Product added successfully.";
        header("Location: admin.php");
    } else {
        // Xảy ra lỗi khi thêm sản phẩm
        echo "Error adding product: " . mysqli_error($conn);
    }
}

// Đóng kết nối cơ sở dữ liệu