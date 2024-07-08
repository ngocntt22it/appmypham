<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/product_detail.css">

</head>

<body>
    <section>
        <div class="container flex">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            if (isset($_GET['idsp'])) {
                $idsp = $_GET['idsp'];
                $sql = "SELECT * FROM sanpham WHERE id = $idsp";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="left">
                <div class="main_image">
                    <?php echo '<img src="' . $row['hinhanh'] . '" class="slide">'; ?>
                </div>
                <div class="option flex">
                    <!-- <img src="#" onclick="img('#')">
                    <img src="#" onclick="img('#')">
                    <img src="#" onclick="img('#')">
                    <img src="#" onclick="img('#')"> -->

                </div>
            </div>
            <div class="right">
                <h3><?php echo $row['tensanpham']; ?></h3>
                <h4> <small><b><u>đ</u></b></small>&nbsp;<?php echo $row['dongia']; ?>.000</h4>
                <p><?php echo $row['mota']; ?></p>
                <h5>Số lượng</h5>
                <div class="add flex1">
                    <span>-</span>
                    <label>1</label>
                    <span>+</span>
                </div>

                <button><a href="controller/muasanpham.php?item='.$row['id'].'">THÊM VÀO GIỎ HÀNG</a></button>
            </div>
            <?php
                } else {
                    echo 'Product not found.';
                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </section>
    <script>
    function img(anything) {
        document.querySelector('.slide').src = anything;
    }

    function change(change) {
        const line = document.querySelector('.home');
        line.style.background = change;
    }
    </script>
</body>

</html>