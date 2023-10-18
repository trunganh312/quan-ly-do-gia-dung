<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include_once "connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $customer_id = $_GET['customer_id'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Thực hiện truy vấn UPDATE để cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $query = "UPDATE customers
            SET phone = '$phone', password = '$password', first_name = '$first_name', last_name = '$last_name', email = '$email'
            WHERE customer_id = '$customer_id'";
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
