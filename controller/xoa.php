<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "mypham");

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['tendangnhap'])) {
    // Người dùng chưa đăng nhập, xử lý theo yêu cầu của bạn (ví dụ: chuyển hướng đến trang đăng nhập)
    header("Location: ../login.php");
    exit();
}

// Lấy thông tin người dùng và sản phẩm cần xóa
$tendangnhap = $_SESSION['tendangnhap'];
$itemId = $_GET['item'];

// Kiểm tra xem sản phẩm cần xóa có thuộc về người dùng hiện tại hay không
$checkOwnershipQuery = "SELECT * FROM giohangg WHERE idsanpham = $itemId AND tendangnhap = '$tendangnhap'";
$result = mysqli_query($conn, $checkOwnershipQuery);

if (mysqli_num_rows($result) > 0) {
    // Sản phẩm thuộc về người dùng, tiến hành xóa
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['idsanpham'] == $itemId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Thực hiện xóa trong cơ sở dữ liệu
    $deleteQuery = "DELETE FROM giohangg WHERE idsanpham = $itemId AND tendangnhap = '$tendangnhap'";
    mysqli_query($conn, $deleteQuery);

    mysqli_close($conn);

    // Chuyển hướng về trang giỏ hàng
    header("Location: ../giohang.php");
    exit();
} else {
    // Nếu sản phẩm không thuộc về người dùng, có thể xử lý theo ý của bạn, ví dụ: thông báo lỗi
    echo "Lỗi: Bạn không có quyền xóa sản phẩm này.";
    exit();
}
?>