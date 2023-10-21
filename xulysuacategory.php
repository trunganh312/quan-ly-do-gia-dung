<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $category_id = $_GET['category_id'];
    $category_name = $_POST['category_name'];
    // Thực hiện truy vấn UPDATE để cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $query = "UPDATE categories
            SET category_name = '$category_name'
            WHERE category_id = '$category_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Sản phẩm đã được cập nhật thành công
        header("Location: admin.php");
    } else {
        // Xảy ra lỗi khi cập nhật sản phẩm
        echo "Error updating product: " . mysqli_error($conn);
    }
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);