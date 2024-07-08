<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "mypham");

// Kiểm tra đăng nhập
session_start();
if (!isset($_SESSION['tendangnhap'])) {
    // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit(); // Đảm bảo chuyển hướng được thực hiện và dừng kịch bản tiếp theo
} else {
    // Người dùng đã đăng nhập, chuyển hướng đến trang thông tin người dùng
    header("Location: thongtin-user.php");
    exit(); // Đảm bảo chuyển hướng được thực hiện và dừng kịch bản tiếp theo
}
?>