<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["customer_id"])) {
    // Lấy dữ liệu từ form
    $customer_id =  $_SESSION['customer_id'];
    $product_id =  $_POST['product_id'];
    $report_content = $_POST['report_content'];

    $query = "INSERT INTO reports ( customer_id, report_content, product_id)
              VALUES ('$customer_id', '$report_content', '$product_id')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Gửi báo cáo thành công.");</script>';
echo '<script>window.location.href = "report.php";</script>';
    } else {
        // Xảy ra lỗi khi thêm sản phẩm
        echo "Error adding product: " . mysqli_error($conn);
    }
} else {
    echo '<script>alert("Bạn phải đăng nhập để gửi báo cáo.");</script>';
    echo '<script>window.history.back();</script>'; // Quay lại trang trước đó
    exit;

}