<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include('model/menu-user.php'); ?>
    <?php include('model/hieuung.php'); ?>

    <div class="luachon">
        <div class="container">
            <div class="left-panel">
                <img src="uploads/thuonghieu.png" alt="Ảnh mô tả">
            </div>
            <div class="right-panel">
                <div class="right-panel-item">
                    <img src="uploads/icon.webp" alt="Ảnh mô tả">
                    <div>
                        <b>Thanh toán</b>
                        <p>Khách hàng có thể lựa chọn một hoặc nhiều hình thức thanh toán</p>
                    </div>
                </div>
                <div class="right-panel-item">
                    <img src="uploads/icon1.png" alt="Ảnh mô tả">
                    <div>
                        <b>Cam kết chính hãng</b><br>
                        <p>Chúng tôi cam kết hàng chính hãng và đảm bảo về chất lượng sản phẩm</p>
                    </div>
                </div>
                <div class="right-panel-item">
                    <img src="uploads/icon2.webp" alt="Ảnh mô tả">
                    <div>
                        <b>Siêu tốc 2h</b><br>
                        <p>Dịch vụ giao hàng nhanh 2h trong nội thành Đà Nẵng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <?php include('model/danhmuc.php'); ?>
    <span id="section1"><?php include('model/sanpham.php'); ?> </span>
    <?php include('model/combo.php'); ?>
    <?php include('model/baiviet.php'); ?>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">Tin tức</span>
        </h3>
    </div>
    <?php include('model/bv_tintuc.php'); ?><br><br><br>
    <?php include('model/footer.php'); ?>
    <?php include('model/social.php'); ?>

</body>

</html>