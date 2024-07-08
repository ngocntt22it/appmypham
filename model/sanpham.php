<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="css/sanpham.css">

</head>

<body>
    <div class="container2">
        <h2>Tất cả sản phẩm</h2>
    </div>
    <div class="product-container">
        <?php
    $conn=mysqli_connect("localhost", "root", "", "mypham");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM sanpham LIMIT 15";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<a href="#"><img src="' . $row['hinhanh'] . '" alt="' . $row['tensanpham'] . '"></a>';
            echo '<div class="product-details">';
            echo '<h3><a href="product-detail.php?idsp=' . $row['id'] . '">' . $row['tensanpham'] .'</a></h3>';
            echo '<p>' . $row['dongia'] .'.000 '.'<u>đ</u>'. '</p>';
            echo '<div class="buy-options">';
            echo '<a href="controller/muasanpham.php?item='.$row['id'].'" class="buy-button">Mua ngay</a>';
            echo '<a href="controller/muasanpham.php?item='.$row['id'].'" class="cart-button"><img src="uploads/bt_giohang.jpg" alt="Giỏ hàng" class="cart-icon"></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
    </div>
    <div class="link_container">
        <div class="link_xemthem"><a href="trang-sanpham.php"><i>Xem thêm</i></a></div>
        <div class="link_line"></div>
    </div>
</body>

</html>