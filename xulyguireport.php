<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $customer_id =  $_SESSION['customer_id'];
    $report_content = $_POST['report_content'];

    $query = "INSERT INTO reports ( customer_id, report_content)
              VALUES ('$customer_id', '$report_content')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Gửi phản hồi thành công!');</script>";
        header("Location: report.php");
    } else {
        // Xảy ra lỗi khi thêm sản phẩm
        echo "Error adding product: " . mysqli_error($conn);
    }
}
