<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combo</title>
    <style>

    </style>
</head>

<body>
    <div class="cb-container2">
        <h2>Combo trang điểm</h2>
    </div>
    <div class="cb-product-container">
        <?php
    $conn=mysqli_connect("localhost", "root", "", "banhang");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM combotrangdiem LIMIT 4";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display products
        while ($row = $result->fetch_assoc()) {
            echo '<div class="cb-product">';
            echo '<a href="#"><img src="' . $row['imagecombo'] . '" alt="' . $row['tencombo'] . '"></a>';
            echo '<div class="cb-product-details">';
            echo '<h3>' . $row['tencombo'] .'</h3>';
            echo '<p>' . $row['giacombo'] .'.000 '.'<u>đ</u>'. '</p>';
            echo '<div class="cb-buy-options">';
            echo '<a href="#" class="cb-buy-button">Mua ngay</a>';
            echo '<a href="#" class="cb-cart-button"><img src="uploads/bt_giohang.jpg" alt="Giỏ hàng" class="cb-cart-icon"></a>';
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
    <div class="cb-link_container">
        <div class="cb-link_xemthem"><a href="#"><i>Xem thêm</i></a></div>
        <div class="cb-link_line"></div>
    </div>
</body>

</html>