<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['duyetdon'])) {
    $idDonHang = $_POST['duyetdon'];

    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "mypham");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Cập nhật trạng thái của đơn hàng
    $updateQuery = "UPDATE dondathang SET trangthai='Đã duyệt' WHERE iddondathang='$idDonHang'";
    mysqli_query($conn, $updateQuery);

    // Đóng kết nối
    $conn->close();

    // Redirect hoặc thông báo thành công
    header("Location: quanlydonhang.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dsdanhmuc.css">
    <style>
    .danhmuc input {
        background: #00AE72;
        color: white;
    }
    </style>

</head>

<body>
    <?php include('model/menu-admin.php'); ?>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">DANH SÁCH ĐƠN ĐẶT HÀNG</span>
        </h3>
    </div>
    <div class="danhmuc">
        <form method="post" action="#">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên TK</th>
                        <th>Tên KH</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Phương thức thanh toán</th>
                        <th>Ngày đặt hàng</th>
                        <th>Duyệt đơn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
$conn = mysqli_connect("localhost", "root", "", "mypham");
$sql = "SELECT * FROM dondathang";
$kq = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($kq)) {
    echo '<tr>';
    echo '<td>' . '<a href="chitietdonhang.php?idddh=' . $row['iddondathang'] . '">' . $row["iddondathang"] . '</a>' . '</td>';
    echo '<td>' . $row["tendangnhap"] . '</td>';
    echo '<td>' . $row['tenkhachhang'] . '</td>';
    echo '<td>' . $row["sodienthoai"] . '</td>';
    echo '<td>' . $row['diachi'] . '</td>';
    echo '<td>' . $row['phuongthucthanhtoan'] . '</td>';
    echo '<td>' . $row['ngaydathang'] . '</td>';

    // Kiểm tra trạng thái và hiển thị nút tương ứng
    if ($row['trangthai'] == 'Đã duyệt') {
        echo '<td>Đã duyệt</td>';
    } else {
        echo '<td><form method="post" action="#">
            <input type="hidden" name="duyetdon" value="' . $row['iddondathang'] . '">
            <input type="submit" value="Duyệt đơn">
          </form></td>';
    }

    echo '</tr>';
}
?>

                </tbody>
            </table>
        </form>
    </div>
</body>

</html>