<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>SAN PHAM</title>
    <link rel="stylesheet" href="css/pagesanpham.css">
    <style>
    a {
        text-decoration: none;
        color: black;
    }

    div#nz-div {
        border-bottom: 2px solid #CD5C5C;
        display: block;
        margin: 3% 9%;
    }

    #nz-div h3.tde {
        margin: 0;
        font-size: 16px;
        line-height: 20px;
        display: inline-block;
        text-transform: uppercase;
    }

    #nz-div h3.tde :after {
        content: "";
        width: 0;
        height: 0;
        border-top: 40px solid transparent;
        border-left: 20px solid #CD5C5C;
        border-bottom: 0px solid transparent;
        border-right: 0 solid transparent;
        position: absolute;
        top: 0px;
        right: -20px;
    }

    #nz-div h3.tde span {
        background: #CD5C5C;
        padding: 10px 20px 8px 20px;
        color: white;
        position: relative;
        display: inline-block;
        margin: 0;
    }
    </style>
</head>

<body>
    <?php include('model/menu.php'); ?>
    <div style="margin-top: 100px;">
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
    $count_query = "SELECT COUNT(*) as total FROM sanpham";
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_items = $count_row['total'];

    $items_per_page = 15;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $items_per_page;

    $search_condition = isset($_GET['search']) ? "AND tensanpham LIKE '%" . $_GET['search'] . "%'" : "";

    $sql = "SELECT * FROM sanpham WHERE 1 $search_condition LIMIT $items_per_page OFFSET $offset";
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
            echo '<a href="#" class="cart-button"><img src="uploads/bt_giohang.jpg" alt="Giỏ hàng" class="cart-icon"></a>';
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
        <div style="margin-top: 3%"><?php include('model/footer.php'); ?></div>
        <?php include('model/social.php'); ?>
    </div>
</body>

</html>