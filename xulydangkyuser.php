<?php
include_once "connection.php";
// ...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];
    $pattern = '/^\d{10}$/';
    // Kiểm tra nếu có các trường rỗng
    if(strlen(trim($retypePassword)) <= 0 || strlen(trim($password)) <= 0 || strlen(trim($first_name)) <= 0 || strlen(trim($last_name)) <= 0 || strlen(trim($email)) <= 0 || strlen(trim($phone)) <= 0){
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
        echo '<script>window.history.back();</script>'; 
    } elseif(strlen(trim($retypePassword)) < 6 && strlen(trim($password)) < 6) {
        echo "<script>alert('Password phải trên 6 kí tự!')</script>";
        echo '<script>window.history.back();</script>'; 
    } elseif(!preg_match($pattern, $phone)) {
        echo "<script>alert('Số điện thoại không hợp lệ')</script>";
        echo '<script>window.history.back();</script>'; 
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Địa chỉ email không hợp lệ')</script>";
        echo '<script>window.history.back();</script>';
    }  else {
        // Kiểm tra xem địa chỉ email đã tồn tại trong cơ sở dữ liệu hay chưa
        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Địa chỉ email đã tồn tại trong cơ sở dữ liệu
            echo "<script>alert('Địa chỉ email đã tồn tại!')</script>";
            echo '<script>window.history.back();</script>';
        }  else {
            // Địa chỉ email là duy nhất
            if ($retypePassword === $password) {
                $query = "INSERT INTO customers (first_name, last_name, email, phone, password, role)
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$password', 2)";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    header("Location: login.php");
                } else {
                    // Xảy ra lỗi khi thêm khách hàng
                    echo "Error adding customer: " . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Password và RetypePassword phải giống nhau!')</script>";
                echo '<script>window.history.back();</script>';
            }
        }
    }
}
// ...