<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_bv.css">
    <title>Bài Viết</title>
</head>

<body>
    <div class="nd-baiviet">
        <?php include('model/menu-admin.php'); ?>
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
    </div>
</body>

</html>