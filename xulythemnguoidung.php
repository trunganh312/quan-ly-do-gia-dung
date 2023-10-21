<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];


    $query = "INSERT INTO customers ( first_name, last_name , email , phone, password)
              VALUES ('$first_name', '$last_name',  '$email', '$phone', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: admin.php");
    } else {
        // Xảy ra lỗi khi thêm sản phẩm
        echo "Error adding product: " . mysqli_error($conn);
    }
}
