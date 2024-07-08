<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm Sản Phẩm:</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="css/themsanpham.css">
</head>

<body>
    <?php include("model/menu-admin.php"); ?>
    <div id="form-container">
        <h1><u>Thêm Sản Phẩm:</u></h1>
        <form action="xulythemsanpham.php" method="POST" enctype="multipart/form-data">
            <b>Tên Sản Phẩm:</b><br>
            <input type="text" name="tensanpham" placeholder="Nhập tên sản phẩm"><br>
            <b>Số Lượng:</b><br>
            <input type="text" name="soluong" placeholder="Nhập số lượng"><br>
            <b>Đơn Giá:</b><br>
            <input type="text" name="dongia" placeholder="Nhập giá bán"><br>
            <b>Danh Mục:</b><br>
            <select name="iddanhmuc">
                <?php
                $conn1 = mysqli_connect("localhost", "root", "", "mypham");
                $sql1 = "SELECT * FROM danhmuc";
                $kq = mysqli_query($conn1, $sql1);
                while ($row = mysqli_fetch_array($kq)) {
                    echo '<option value="' . $row["id"] . '">' . $row['tendanhmuc'] . '</option>';
                }
                ?>
            </select>
            <br><br>
            <label for="hinhanh"><b>Hình Ảnh:</b></label>
            <input type="file" id="hinhanh" name="hinhanh" required>
            <br><br>
            <textarea id="editor" name="mota" placeholder="Mô tả sản phẩm"></textarea>
            <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
            </script>
            <br><br>
            <input type="submit" value="Thêm Sản Phẩm" style="width: 250px; height: 35px">
        </form>
    </div>
</body>

</html>