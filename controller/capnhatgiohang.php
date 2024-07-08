<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['tendangnhap'])) {
    // Người dùng chưa đăng nhập, xử lý theo yêu cầu của bạn (ví dụ: chuyển hướng đến trang đăng nhập)
    header("Location: ../login.php");
    exit();
}

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "mypham");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Lấy thông tin từ form
$itemId = $_GET['item'];
$newQuantity = $_POST['quantity'];
$tendangnhap = $_SESSION['tendangnhap'];
// Truy vấn số lượng hiện tại của sản phẩm trong bảng sanpham
$quantityQuery = "SELECT soluong FROM sanpham WHERE id=$itemId";
$quantityResult = mysqli_query($conn, $quantityQuery);

if ($quantityResult) {
    $productQuantity = mysqli_fetch_assoc($quantityResult)['soluong'];

    // Kiểm tra nếu số lượng muốn mua lớn hơn số lượng trong bảng sanpham
    if ($newQuantity > $productQuantity) {
        // Hiển thị thông báo và chuyển hướng người dùng
        echo '<script language="javascript">alert("Số lượng của bạn vượt quá số lượng sản phẩm của chúng tôi.!"); window.location="../giohang.php";</script>';
        exit();
    }
} else {
    echo "Lỗi truy vấn số lượng sản phẩm.";
    exit();
}

// Cập nhật số lượng và tổng tiền trong mảng $_SESSION['cart']
foreach ($_SESSION['cart'] as &$item) {
    if ($item['idsanpham'] == $itemId) {
        $item['soluong'] = $newQuantity;
        $item['tongtien'] = $newQuantity * $item['dongia'];
    }
}

$updateQuery = "UPDATE giohangg SET soluong=$newQuantity, tongtien=($newQuantity * dongia) WHERE idsanpham=$itemId AND tendangnhap='$tendangnhap'";
mysqli_query($conn, $updateQuery);

mysqli_close($conn);
header("Location: ../giohang.php");
exit();

?>