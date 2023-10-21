<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include 'connection.php';

// Lấy category_id từ form
$category_id = $_GET['category_id'];

// Thực hiện truy vấn DELETE để xóa sản phẩm khỏi cơ sở dữ liệu
$query = "DELETE FROM categories WHERE category_id = '$category_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Sản phẩm đã được xóa thành công
    header("Location: admin.php");
} else {
    // Xảy ra lỗi khi xóa sản phẩm
    echo "Error deleting product: " . mysqli_error($conn);
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
