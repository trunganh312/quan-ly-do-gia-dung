<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include 'connection.php';

// Lấy cart_id từ form
$cart_id = $_GET['cart_id'];

// Thực hiện truy vấn DELETE để xóa sản phẩm khỏi cơ sở dữ liệu
$query = "DELETE FROM cart WHERE cart_id = '$cart_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: index.php");
} else {
    // Xảy ra lỗi khi xóa sản phẩm
    echo "Error deleting product: " . mysqli_error($conn);
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);