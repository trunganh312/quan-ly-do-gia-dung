<?php
// Xóa thông tin phiên và đăng xuất người dùng
session_start();

// Xóa tất cả thông tin phiên
session_unset();

// Hủy phiên
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
header("Location: index.php");
exit();
