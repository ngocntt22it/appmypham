<?php
session_start();

if (isset($_SESSION['tendangnhap'])) {
    $tendangnhap = $_SESSION['tendangnhap'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        if (isset($_POST['name'], $_POST['phone'], $_POST['province'], $_POST['district'], $_POST['ward'], $_POST['address'], $_POST['payment'])) {
    // Lấy thông tin khách hàng từ biểu mẫu
    $tenkhachhang = $_POST['name'];
    $sodienthoai = $_POST['phone'];
    $diachi = $_POST['province'] . ', ' . $_POST['district'] . ', ' . $_POST['ward'] . ', ' . $_POST['address'];
    $phuongthucthanhtoan = $_POST['payment'];

    // Lấy thông tin đơn hàng từ giỏ hàng
    $conn = mysqli_connect("localhost", "root", "", "mypham");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM giohangg WHERE tendangnhap='$tendangnhap'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Tạo bản ghi mới trong bảng dondathang
        $insertQuery = "INSERT INTO dondathang (tendangnhap, tenkhachhang, sodienthoai, diachi, phuongthucthanhtoan, ngaydathang) VALUES ('$tendangnhap', '$tenkhachhang', '$sodienthoai', '$diachi', '$phuongthucthanhtoan', NOW())";
        mysqli_query($conn, $insertQuery);

        // Lấy ID đơn hàng vừa được tạo
        $idDonHang = mysqli_insert_id($conn);

        // Duyệt qua các sản phẩm trong giỏ hàng và thêm chúng vào bảng chitietdathang
        while ($row = mysqli_fetch_assoc($result)) {
            $idSanPham = $row['idsanpham'];
            $soLuong = $row['soluong'];
            $donGia = $row['dongia'];

            // Thêm vào bảng chitietdathang
            $insertChiTietQuery = "INSERT INTO chitietdathang (iddondathang, idsanpham, soluong, dongia) VALUES ('$idDonHang', '$idSanPham', '$soLuong', '$donGia')";
            mysqli_query($conn, $insertChiTietQuery);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đặt hàng
        $deleteQuery = "DELETE FROM giohangg WHERE tendangnhap='$tendangnhap'";
        mysqli_query($conn, $deleteQuery);
        $updateTrangThaiQuery = "UPDATE dondathang SET trangthai='Chờ duyệt' WHERE iddondathang='$idDonHang'";
        mysqli_query($conn, $updateTrangThaiQuery);
        
        echo '<script language="javascript">alert("Đặt hàng thành công!"); window.location="lichsudonhang.php";</script>';
    } else {
        echo "Giỏ hàng trống.";
    }

    $conn->close();
} else {
    echo "Một số trường biểu mẫu bị thiếu.";
}
} else {
    echo "Vui lòng đăng nhập để đặt hàng.";
}
}
?>