<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sản phẩm</title>
</head>

<body>
    <h1>Xóa sản phẩm</h1>
    <?php 
    $conn = mysqli_connect("localhost","root","","mypham");
    $id_to_delete = $_GET['idsp'];
    // Lấy iddanhmuc của sản phẩm trước khi xóa
    $sql_get_iddm_before_delete = "SELECT iddanhmuc FROM sanpham WHERE id = " . $id_to_delete;
    $result_before_delete = mysqli_query($conn, $sql_get_iddm_before_delete);
    $row_before_delete = mysqli_fetch_assoc($result_before_delete);
    $iddm_before_delete = $row_before_delete['iddanhmuc'];

    $sql = "DELETE FROM sanpham WHERE id = " . $id_to_delete;
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        // Nếu xóa thành công, chuyển hướng đến trang sản phẩm theo danh mục
        header("Location: danhsachsanpham.php?iddm=$iddm_before_delete");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thêm vào trang sau lệnh chuyển hướng
    } else {
        echo "Lỗi xóa sản phẩm: " . mysqli_error($conn);
    }
    ?>
</body>

</html>