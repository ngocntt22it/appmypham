<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa khách hàng</title>
</head>

<body>
    <h1>Xóa khách hàng</h1>
    <?php 
    $conn = mysqli_connect("localhost","root","","mypham");
    $id_to_delete = $_GET['idkh'];
    $sql = "DELETE FROM taikhoan WHERE id = " . $id_to_delete;
    $kq = mysqli_query($conn, $sql);
    if ($kq) {
        // Nếu xóa thành công, chuyển hướng đến trang mình muốn
        header("Location: danhsachkhachhang.php");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thêm vào trang sau lệnh chuyển hướng
    } else {
        echo "Lỗi xóa danh mục: " . mysqli_error($conn);
    }
    ?>
</body>

</html>