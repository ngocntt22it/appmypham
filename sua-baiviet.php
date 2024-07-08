<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa Sản Phẩm:</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="css/suabaiviet.css">
</head>

<body>
    <?php include("model/menu-admin.php"); ?>
    <div id="form-container">
        <h1><u>Sửa Sản Phẩm:</u></h1>
        <?php
        $idbv = $_GET['idbv'];
        $conn2 = mysqli_connect("localhost", "root", "", "mypham");
        if (!$conn2) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $sql2 = "SELECT * FROM baiviett WHERE id = ?";
        $stmt2 = mysqli_prepare($conn2, $sql2);

        if ($stmt2) {
            mysqli_stmt_bind_param($stmt2, "i", $idbv);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            $thongtinbv = mysqli_fetch_array($result2);
            mysqli_stmt_close($stmt2);
        } else {
            echo "Lỗi trong việc chuẩn bị câu lệnh SQL: " . mysqli_error($conn2);
        }
        mysqli_close($conn2);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <b>Tên Bài Viết:</b><br>
            <input type="text" name="tenbaiviet" value="<?php echo $thongtinbv['tenbaiviet']; ?>"><br>
            <b>Câu Chủ Đề:</b><br>
            <input type="text" name="chude" value="<?php echo $thongtinbv['cauchude']; ?>"><br>
            <br><br>
            <label for="hinh_anh"><b>Hình Ảnh:</b></label>
            <input type="file" id="hinhanh" name="hinhanh" required>
            <br><br>
            <textarea id="editor" name="noidung" placeholder="Nội dung bài viết">
            <p><?php echo $thongtinbv['noidung']; ?></p>
            </textarea>
            <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
            </script>
            <br><br>
            <input type="submit" value="Cập Nhật Bài Viết" style="width: 300px; height: 35px">
        </form>
    </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "mypham");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    // Get form data
    $tenbaiviet = $_POST['tenbaiviet'];
    $cauchude = $_POST['cauchude'];
    $noidung = $_POST['noidung'];
    $idbv = $_GET['idbv'];
    // File upload
    if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["hinhanh"]["name"]); 
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            // Update product data
            $sql = "UPDATE baiviett SET tenbaiviet = ?, cauchude = ?, hinhanh = ?, noidung = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sdsis", $tenbaiviet, $chude, $target_file, $noidung, $idbv);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "Sản phẩm đã được cập nhật thành công.";
                } else {
                    echo "Lỗi khi cập nhật sản phẩm: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Lỗi trong việc chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
            }
        } else {
            echo "Xin lỗi, có lỗi khi tải tệp lên.";
        }
    } else {
        echo "Không có tệp hình ảnh được tải lên.";
    }
    // Close database connection
    mysqli_close($conn);
}
?>