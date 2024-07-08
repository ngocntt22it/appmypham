<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combo</title>
    <link rel="stylesheet" href="css/combo.css">
</head>

<body>
    <div class="cb-container2">
        <h2>Combo trang điểm</h2>
    </div>
    <div class="cb-product-container">
        <?php
$conn = mysqli_connect("localhost", "root", "", "mypham");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM sanpham WHERE tensanpham LIKE '%Combo%' LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="cb-product">';
        echo '<a href="#"><img src="' . $row['hinhanh'] . '" alt="' . $row['tensanpham'] . '"></a>';
        echo '<div class="cb-product-details">';
        echo '<h3>' . $row['tensanpham'] .'</h3>';
        echo '<p>' . $row['dongia'] .'.000 '.'<u>đ</u>'. '</p>';
        echo '<div class="cb-buy-options">';
        echo '<a href="controller/muasanpham.php?item='.$row['id'].'" class="buy-button">Mua ngay</a>';
        echo '<a href="#" class="cb-cart-button"><img src="uploads/bt_giohang.jpg" alt="Giỏ hàng" class="cb-cart-icon"></a>';
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
    <div class="cb-link_container">
        <div class="cb-link_xemthem"><a href="#"><i>Xem thêm</i></a></div>
        <div class="cb-link_line"></div>
    </div>
</body>

</html>