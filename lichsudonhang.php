<?php
session_start();
include('model/menu.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
    .chitietdathang {
        font-family: 'Arial', sans-serif;
        margin: 5%;
        padding: 0;
        box-sizing: border-box;
        background-color: #f4f4f4;
    }

    .chitietdathang {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .chitietdathang h1 {
        color: #B2001F;
        text-align: center;
    }

    .chitietdathang h2 {
        color: #EE6363;
    }

    .chitietdathang table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .chitietdathang th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .chitietdathang th {
        background-color: #f2f2f2;
    }

    .chitietdathang tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .chitietdathang p,
    a {
        color: #333;
        margin-bottom: 10px;
    }

    .chitietdathang a {
        text-decoration: none;
    }

    .chitietdathang a:hover {
        text-decoration: underline;
    }

    @media only screen and (max-width: 600px) {
        .chitietdathang {
            padding: 10px;
        }

        .chitietdathang table,
        th,
        td {
            font-size: 14px;
        }
    }

    .status-box {
        background-color: #00AE72;
        color: white;
        padding: 8px 15px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .status-box p {
        font-weight: bold;
        margin: 0;
        color: white;

    }
    </style>
</head>

<body>
    <br><br>
    <div class="chitietdathang">
        <h1>ĐƠN MUA</h1>
        <?php
        if (isset($_SESSION['tendangnhap'])) {
            $tendangnhap = $_SESSION['tendangnhap'];
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Lấy thông tin tất cả đơn hàng của người dùng
            $queryDonHang = "SELECT * FROM dondathang WHERE tendangnhap='$tendangnhap' ORDER BY ngaydathang DESC";
            $resultDonHang = mysqli_query($conn, $queryDonHang);

            if (mysqli_num_rows($resultDonHang) > 0) {
                while ($rowDonHang = mysqli_fetch_assoc($resultDonHang)) {
                    $idDonHang = $rowDonHang['iddondathang'];

                    // Lấy thông tin chi tiết đơn hàng từ cơ sở dữ liệu
                    $queryChiTiet = "SELECT chitietdathang.*, sanpham.tensanpham FROM chitietdathang
                                    INNER JOIN sanpham ON chitietdathang.idsanpham = sanpham.id
                                    WHERE iddondathang='$idDonHang'";
                    $resultChiTiet = mysqli_query($conn, $queryChiTiet);
                    
                    echo "<div class='status-box'>";
                    echo "<p><strong>TRẠNG THÁI: </strong>{$rowDonHang['trangthai']}</p>";
                    echo "</div>";

                    echo "<p><strong>Mã Đơn Hàng:</strong> $idDonHang</p>";
                    echo "<p><strong>Ngày Đặt Hàng:</strong> {$rowDonHang['ngaydathang']}</p>";
                    echo "<p><strong>Tên Khách Hàng:</strong> {$rowDonHang['tenkhachhang']}</p>";
                    echo "<p><strong>Số Điện Thoại:</strong> {$rowDonHang['sodienthoai']}</p>";
                    echo "<p><strong>Địa Chỉ Giao Hàng:</strong> {$rowDonHang['diachi']}</p>";
                    echo "<p><strong>Phương Thức Thanh Toán:</strong> {$rowDonHang['phuongthucthanhtoan']}</p>";

                    echo "<h2>CHI TIẾT ĐƠN HÀNG</h2>";

                    $tongThanhToanDonHang = 0; // Biến để tính tổng thanh toán của đơn hàng

                    if (mysqli_num_rows($resultChiTiet) > 0) {
                        echo "<table border='1'>";
                        echo "<tr><th>Tên Sản Phẩm</th><th>Số Lượng</th><th>Đơn Giá</th></tr>";

                    while ($rowChiTiet = mysqli_fetch_assoc($resultChiTiet)) {
                    echo "<tr>";
                    echo "<td>{$rowChiTiet['tensanpham']}</td>";
                    echo "<td>{$rowChiTiet['soluong']}</td>";
                    echo "<td>{$rowChiTiet['dongia']}</td>";
                    echo "</tr>";

                    $tongThanhToanDonHang += $rowChiTiet['soluong'] * $rowChiTiet['dongia'];
                    }

                    echo "<tr><td colspan='2'><strong>Tổng Thanh Toán Đơn Hàng:</strong></td><td>" . number_format($tongThanhToanDonHang, 3) . " VND</td></tr>";

                    echo "</table>";

                    } else {
                        echo "<p>Không có sản phẩm nào trong đơn hàng này.</p>";
                    }

                    echo "<hr><hr>";
                    echo ""; 
                    echo "<br><br>";                 }
            } else {
                echo "<p>Bạn không có đơn hàng nào.</p>";
            }

            $conn->close();
        } else {
            echo "<p>Vui lòng đăng nhập để xem chi tiết đơn hàng.</p>";
        }
        ?>

        <p><a href="trang-sanpham.php">Quay lại cửa hàng</a></p>
    </div>
    <?php include('model/footer.php'); ?>

</body>

</html>