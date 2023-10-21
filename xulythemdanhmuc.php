<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $category_name = $_POST['category_name'];


    // Thực hiện truy vấn INSERT để thêm sản phẩm vào cơ sở dữ liệu

    $query = "INSERT INTO categories ( category_name)
              VALUES ('$category_name')";
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