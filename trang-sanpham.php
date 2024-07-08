<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>SAN PHAM</title>
    <link rel="stylesheet" href="css/pagesanpham.css">
</head>

<body>
    <?php include('model/menu.php'); ?>
    <?php include('model/danhmuc.php'); ?>
    <div class="container2">
        <h2>Tất cả sản phẩm</h2>
    </div>
    <div class="product-container">
        <?php
    $conn=mysqli_connect("localhost", "root", "", "mypham");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $count_query = "SELECT COUNT(*) as total FROM sanpham";
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_items = $count_row['total'];

    $items_per_page = 15;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $items_per_page;

    $sql = "SELECT * FROM sanpham WHERE tensanpham NOT LIKE '%Combo%' LIMIT $items_per_page OFFSET $offset";
    $result=mysqli_query($conn, $sql);

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
    $total_pages = ceil($total_items / $items_per_page);
    ?>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo '<div class="page-item ' . $active . '"><a href="?page=' . $i . '">' . $i . '</a></div>';
            }
            ?>
        </div>
    </div>
    <div style="margin-top: 3%"><?php include('model/footer.php'); ?></div>
    <?php include('model/social.php'); ?>

</body>

</html>