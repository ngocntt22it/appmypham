<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nd_baiviet.css">
    <title>Bài Viết</title>
</head>

<body>
    <div class="nd-baiviet">
        <?php include('model/menu.php'); ?>
        <?php
    $conn = mysqli_connect("localhost", "root", "", "mypham");
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
    // Lấy id bài viết từ tham số truyền vào
    $articleId = $_GET['id'];
    // Truy vấn cơ sở dữ liệu để lấy thông tin bài viết
    $sql = "SELECT tenbaiviet, cauchude, hinhanh, noidung FROM baiviett WHERE id = $articleId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo '<header>';
        echo '<h1>' . $row['tenbaiviet'] . '</h1>';
        echo '</header>';
        echo '<article>';
        echo '<img src="' . $row['hinhanh'] . '" alt="Article Image">';
        echo '<h2>' . $row['cauchude'] . '</h2>';
        echo '<p>' . $row['noidung'] . '</p>';
        echo '</article>';
    } else {
        echo "Không tìm thấy bài viết.";
    }

    mysqli_close($conn);
    ?>
        <div class="cb-link_container">
            <div class="cb-link_xemthem"><a href="#"><i>Các bài viết khác</i></a></div>
            <div class="cb-link_line"></div>
        </div>
    </div>
    <?php include('model/baiviet.php'); ?>
    <?php include('model/footer.php'); ?>

</body>

</html>