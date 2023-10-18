<?php
// Kết nối đến CSDL

// Kiểm tra kết nối

include_once "connection.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Bắt đầu giao dịch
mysqli_begin_transaction($conn);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $customer_id = $_SESSION['customer_id'];
        $product_id = $_GET['product_id'];
        $amount = $_GET['amount'];
        $cart_id = $_GET['cart_id'];
        $quantity = $_GET['quantity'];

        $query = "INSERT INTO Payments (customer_id, product_id,  amount, status, quantity)  values('$customer_id', '$product_id', '$amount', 'Thành công', $quantity)";
        mysqli_query($conn, $query);
        $deleteSql = "DELETE FROM cart WHERE cart_id = $cart_id";
        mysqli_query($conn, $deleteSql);

        // Xác nhận giao dịch
        mysqli_commit($conn);
        echo "<script>alert('Thanh toán thành công!!')</script>";
        header("Location: thanhtoan.php");
    }
} catch (Exception $e) {
    // Rollback giao dịch nếu có lỗi xảy ra
    mysqli_rollback($conn);

    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối CSDL
mysqli_close($conn);
