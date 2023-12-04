<?php
include_once "./connection.php";

// Lấy thông tin đăng nhập từ biểu mẫu
$emailInput = isset($_POST['email']) ? $_POST['email'] : "";
$passwordInput = isset($_POST['password']) ? $_POST['password'] : "";

// Kết nối cơ sở dữ liệu

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $conn->connect_error);
}

// Xây dựng câu truy vấn
$sql = "SELECT * FROM customers WHERE email = '$emailInput' AND password = '$passwordInput'";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($passwordInput === $row["password"]) {
        // Successful login
        session_start();
        $_SESSION['email'] = $emailInput;
        $_SESSION['first_name'] = $row["first_name"];
        $_SESSION['last_name'] = $row["last_name"];
        $_SESSION['customer_id'] = $row["customer_id"];
        $_SESSION['role'] = $row["role"];
        header("Location: index.php");
    } else {
        // Incorrect password
        echo "<script>alert('Mật khẩu không chính xác!')</script>";
        echo '<script>window.history.back();</script>';
    }
} else {
    // Login failed
    echo "<script>alert('Đăng nhập không thành công!')</script>";
    echo '<script>window.history.back();</script>';
}

// Đóng kết nối
$conn->close();
?>