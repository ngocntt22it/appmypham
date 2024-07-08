<?php
session_start();
include('model/menu-admin.php');
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
    </style>
</head>

<body>
    <br><br>
    <div class="chitietdathang">
        <?php
        if (isset($_SESSION['tendangnhap'])) {
            $tendangnhap = $_SESSION['tendangnhap'];
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['idddh'])) {
                $idDonHang = $_GET['idddh'];

                // Lấy thông tin đơn hàng
                $queryDonHang = "SELECT * FROM dondathang WHERE iddondathang='$idDonHang'";
                $resultDonHang = mysqli_query($conn, $queryDonHang);

                if (mysqli_num_rows($resultDonHang) > 0) {
                    $rowDonHang = mysqli_fetch_assoc($resultDonHang);
                    echo "<h1>ĐƠN HÀNG #" . $rowDonHang['iddondathang'] . "</h1>";
                    echo "<h2>Thông tin đơn hàng</h2>";
                    echo "<p>Họ và tên: " . $rowDonHang['tenkhachhang'] . "</p>";
                    echo "<p>Ngày đặt hàng: " . $rowDonHang['ngaydathang'] . "</p>";

                    // Lấy thông tin chi tiết đơn hàng
                    $queryChiTiet = "SELECT chitietdathang.*, sanpham.tensanpham FROM chitietdathang
                                    INNER JOIN sanpham ON chitietdathang.idsanpham = sanpham.id
                                    WHERE iddondathang='$idDonHang'";
                    $resultChiTiet = mysqli_query($conn, $queryChiTiet);
                    $tongThanhToanDonHang = 0;
                    if (mysqli_num_rows($resultChiTiet) > 0) {
                        echo "<h2>Chi tiết đơn hàng</h2>";
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

                    // Hiển thị tổng thanh toán
                    // echo "<p><strong>Tổng thanh toán:</strong> " . number_format($rowDonHang['tongthanhtoan'], 3) . " VND</p>";
                } else {
                    echo "<p>Không tìm thấy đơn hàng.</p>";
                }
            } else {
                echo "<p>Thiếu thông tin đơn hàng.</p>";
            }

            $conn->close();
        } else {
            echo "<p>Vui lòng đăng nhập để xem chi tiết đơn hàng.</p>";
        }
        ?>

        <p><a href="quanlydonhang.php">Quay lại</a></p>
    </div>

</body>

</html>