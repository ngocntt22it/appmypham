<?php
$conn = mysqli_connect("localhost", "root", "", "mypham");

session_start();
if (!isset($_SESSION['tendangnhap'])) {
    header("Location: ../login.php");
    exit();
}

$tendangnhap = $_SESSION['tendangnhap'];
$itemId = $_GET['item'];

// Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        if ($cartItem['idsanpham'] == $itemId) {
            // Sản phẩm đã tồn tại trong giỏ hàng
            // Tăng số lượng của sản phẩm và chuyển hướng đến trang giỏ hàng
            $cartItem['soluong']++;
            $_SESSION['cart'][$itemId] = $cartItem;

            // Chuyển hướng đến trang giỏ hàng
            echo '<script language="javascript">alert("Sản phẩm đã có trong giỏ hàng."); window.location="../giohang.php";</script>';
            exit();
        }
    }
}

// Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào giỏ hàng
$sql = "SELECT * FROM sanpham WHERE id=$itemId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$tensanpham = $row['tensanpham'];
$soluong = 1;
$dongia = $row['dongia'];
$tongtien = $soluong * $dongia;

$_SESSION['cart'][] = array(
    'idsanpham' => $itemId,
    'tensanpham' => $tensanpham,
    'soluong' => $soluong,
    'dongia' => $dongia,
    'tongtien' => $tongtien,
    'hinhanh' => $row['hinhanh']
);

$insertQuery = "INSERT INTO giohangg (idsanpham, tensanpham, soluong, dongia, tongtien, hinhanh, tendangnhap) 
                VALUES ($itemId, '$tensanpham', $soluong, $dongia, $tongtien, '$row[hinhanh]', '$tendangnhap')";
mysqli_query($conn, $insertQuery);

// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);

// Chuyển hướng đến trang giỏ hàng
header("Location: ../giohang.php");
exit();
?>