<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="css/pagegiohang.css">
</head>

<body>
    <?php
    session_start();
    include('model/menu.php');
    ?>

    <div class="giohang">
        <h1>Giỏ Hàng</h1>

        <?php
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['tendangnhap'])) {
            $tendangnhap = $_SESSION['tendangnhap'];
            // Truy vấn giỏ hàng của người dùng từ cơ sở dữ liệu
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "SELECT * FROM giohangg WHERE tendangnhap='$tendangnhap'";
            $result = mysqli_query($conn, $query);
            
    

            if (mysqli_num_rows($result) > 0) {
                // Hiển thị sản phẩm trong giỏ hàng của người dùng
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='pro'>";
                    echo '<p><img src="' . $row["hinhanh"] . '" alt="Hình ảnh sản phẩm" width="100"></p>';
                    echo "<div class='pro-info'>";
                    echo "<h3>" . $row['tensanpham'] . "</h3>";
                    echo "<p>Số Lượng: <form method='post' action='controller/capnhatgiohang.php?item=" . $row['idsanpham'] . "'><input type='number' name='quantity' value='{$row['soluong']}' min='1' />";
                    echo "<input type='submit' value='Cập nhật'></form></p>";
                    echo "<p>Đơn Giá: " . number_format($row['dongia'], 3) . " VND</p>";
                    echo "<p>Tổng Tiền: " . number_format($row['tongtien'], 3) . " VND</p>";
                    echo "<p align='right'><a href='controller/xoa.php?item=" . $row['idsanpham'] . "'>Xóa khỏi giỏ hàng</a></p>";
                    echo "</div>";
                    echo "</div>";
                }

                // Tính tổng thanh toán của giỏ hàng
                $totalPriceAllProducts = mysqli_query($conn, "SELECT SUM(tongtien) AS total FROM giohangg WHERE tendangnhap='$tendangnhap'");
                $totalPrice = mysqli_fetch_assoc($totalPriceAllProducts)['total'];

                echo "<div class='total-payment'><h2>Tổng Thanh Toán:</h2><span>" . number_format($totalPrice, 3) . " VND</span></div>";
                echo "<form action='dathang.php' method='post'>";
                echo "<input type='submit' value='Mua Ngay'>";
                echo "</form>";
            } else {
                echo "Giỏ hàng trống.";
            }
            // Đóng kết nối đến cơ sở dữ liệu
            $conn->close();
        } else {
            // Nếu chưa đăng nhập, thông báo người dùng đăng nhập hoặc đăng ký
            echo "<p>Vui lòng <a href='login.php'>đăng nhập</a> hoặc <a href='register.php'>đăng ký</a> để xem giỏ hàng.</p>";
        }
        // Use the same session variable name 'cart' for storing cart items
        ?>
        <a href="lichsudonhang.php">
            <u>
                <h1 style="color: #00AE72;">Đơn Mua</h1>
            </u>
        </a>

        <p><a href="trang-sanpham.php">Quay lại cửa hàng</a></p>
    </div>
    <?php include('model/sanpham.php'); ?>
    <?php include('model/footer.php'); ?>

</body>

</html>