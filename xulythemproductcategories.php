<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    $query = "INSERT INTO product_categories ( product_id, category_id )
              VALUES ('$product_id', '$category_id')";
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