<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include 'connection.php';

// Lấy product_id từ form
$product_id = $_GET['product_id'];

// Thực hiện truy vấn DELETE để xóa sản phẩm khỏi cơ sở dữ liệu
$query = "DELETE FROM Products WHERE product_id = '$product_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Sản phẩm đã được xóa thành công
    echo "Product deleted successfully.";
    header("Location: admin.php");
} else {
    // Xảy ra lỗi khi xóa sản phẩm
    echo "Error deleting product: " . mysqli_error($conn);
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
