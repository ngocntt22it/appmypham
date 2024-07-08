<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="css/sanphamiddm.css">

</head>

<body>
    <?php include('model/menu-user.php'); ?>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">SẢN PHẨM</span>
        </h3>
    </div>

    <div class="product-container">
        <?php
    $conn=mysqli_connect("localhost", "root", "", "mypham");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=".$_GET['iddm'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<a href="#"><img src="' . $row['hinhanh'] . '" alt="' . $row['tensanpham'] . '"></a>';
            echo '<div class="product-details">';
            echo '<h3>' . $row['tensanpham'] .'</h3>';
            echo '<p>' . $row['dongia'] .'.000 '.'<u>đ</u>'. '</p>';
            echo '<div class="buy-options">';
            echo '<a href="controller/muasanpham.php?item='.$row['id'].'" class="buy-button">Mua ngay</a>';
            echo '<a href="#" class="cart-button"><img src="uploads/bt_giohang.jpg" alt="Giỏ hàng" class="cart-icon"></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
    ?>
    </div>
    <div class="link_container">
        <div class="link_xemthem"><a href="#"><i>Xem thêm</i></a></div>
        <div class="link_line"></div>
    </div>
    <?php include('model/footer.php'); ?>
</body>

</html>