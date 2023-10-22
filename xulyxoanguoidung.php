<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include 'connection.php';

// Lấy customer_id từ form
$customer_id = $_GET['customer_id'];

// Thực hiện truy vấn DELETE để xóa sản phẩm khỏi cơ sở dữ liệu
$query = "DELETE FROM customers WHERE customer_id = '$customer_id'";
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
