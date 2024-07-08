<?php
// Bắt đầu hoặc tiếp tục phiên
session_start();

// Hủy toàn bộ phiên bằng cách xóa các biến phiên
session_unset();

// Hủy phiên hiện tại
session_destroy();

header("Location: login.php"); 
exit();
?>