<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm Danh Muc:</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="css/themdanhmuc.css">
</head>

<body>
    <?php include("model/menu-admin.php"); ?>
    <div id="form-container">
        <h1><u>Thêm Danh Mục:</u></h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <b>Tên Danh Mục:</b><br>
            <input type="text" name="tendanhmuc" placeholder="Nhập tên danh mục" required>
            <br><br>
            <label for="hinhanh"><b>Hình Ảnh:</b></label>
            <input type="file" id="hinhanh" name="hinhanh" required>
            <br>
            <input type="submit" value="Thêm Danh Mục" style="width: 250px; height: 35px;">
        </form>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $tendanhmuc = $_POST['tendanhmuc'];
    

    if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] == 0) {
        $target_dir = "uploads/";  

        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["hinhanh"]["name"]);
        if (getimagesize($_FILES["hinhanh"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                echo "Hình ảnh đã được tải lên thành công.";

                $conn = mysqli_connect("localhost", "root", "", "mypham");

                $sql = "INSERT INTO danhmuc(tendanhmuc, hinhanh) VALUES ('$tendanhmuc', '$target_file')";
                $kq = mysqli_query($conn, $sql);

                if ($kq) {
                    echo "Sản phẩm đã được thêm thành công.";
                    echo '<script>window.location.href = "danhsachdanhmuc.php";</script>';
                } else {
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