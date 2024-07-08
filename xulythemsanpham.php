<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý thêm sản phẩm</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $tensanpham = $_POST['tensanpham'];
    $soluong = $_POST['soluong'];
    $dongia = $_POST['dongia'];
    $iddanhmuc = $_POST['iddanhmuc'];
    $mota = $_POST['mota'];

    if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] == 0) {
        $target_dir = "uploads/";  

        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["hinhanh"]["name"]);
        if (getimagesize($_FILES["hinhanh"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                $conn = mysqli_connect("localhost", "root", "", "mypham");

                $sql = "INSERT INTO sanpham(tensanpham, soluong, dongia, iddanhmuc, hinhanh, mota) VALUES ('$tensanpham', $soluong, $dongia, $iddanhmuc, '$target_file', '$mota')";
                $kq = mysqli_query($conn, $sql);
                
                if ($kq) {
                    // Lấy ID của sản phẩm vừa thêm
                    $idSanPham = mysqli_insert_id($conn);

                    // Lấy iddanhmuc của sản phẩm để chuyển hướng đúng danh mục
                    $sql_get_iddm = "SELECT iddanhmuc FROM sanpham WHERE id = $idSanPham";
                    $result_get_iddm = mysqli_query($conn, $sql_get_iddm);
                    $row_get_iddm = mysqli_fetch_assoc($result_get_iddm);
                    $iddm_after_insert = $row_get_iddm['iddanhmuc'];

                    // Chuyển hướng đến trang sản phẩm theo danh mục
                    header("Location: danhsachsanpham.php?iddm=$iddm_after_insert");
                    exit();
                } else {
                    // In thông báo lỗi nếu cần
                    echo "Lỗi khi thêm sản phẩm: " . mysqli_error($conn);
                }
            } else {
                echo "Xin lỗi, có lỗi khi tải tệp lên.";
            }
        } else {
            echo "Tệp không phải là hình ảnh hợp lệ.";
        }
    } else {
        echo "Không có tệp hình ảnh được tải lên.";
    }
}
?>

</body>

</html>