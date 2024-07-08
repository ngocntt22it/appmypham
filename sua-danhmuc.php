<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa Danh Muc:</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="css/suabaiviet.css">
</head>

<body>
    <?php include("model/menu-admin.php"); ?>
    <div id="form-container">
        <h1><u>Sửa Danh Mục:</u></h1>
        <?php
        $iddm = $_GET['iddm'];
        $conn2 = mysqli_connect("localhost", "root", "", "mypham");
        $sql2 = "SELECT * FROM danhmuc WHERE id=$iddm";
        $kq = mysqli_query($conn2, $sql2);
        $thongtindm = mysqli_fetch_array($kq);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <b>Tên Danh Mục:</b><br>
            <input type="text" name="tendanhmuc"
                value="<?php echo isset($tendanhmuc) ? $tendanhmuc : $thongtindm['tendanhmuc']; ?>">
            <br><br>
            <label for="hinhanh"><b>Hình Ảnh:</b></label>
            <input type="file" id="hinhanh" name="hinhanh" required>
            <br>
            <input type="submit" value="Sửa Danh Mục" style="width: 250px; height: 35px;">
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
    $tendanhmuc = $_POST['tendanhmuc'];
    $iddm = $_GET['iddm'];

    // File upload
    if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["hinhanh"]["name"]);
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            // Update category data
            $sql = "UPDATE danhmuc SET tendanhmuc = ?, hinhanh = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssi", $tendanhmuc, $target_file, $iddm);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "Danh mục đã được cập nhật thành công.";

                    // Reset form fields
                    $tendanhmuc = ""; // Reset the variable to empty

                    // For the image field, you might also want to clear the uploaded file if needed
                    // unset($_FILES['image']);

                } else {
                    echo "Lỗi khi cập nhật danh mục: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Lỗi trong việc chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
            }
        } else {
            echo "Xin lỗi, có lỗi khi tải tệp lên.";
        }
    } else {
        // Nếu không có tệp hình ảnh mới được chọn, chỉ cập nhật thông tin khác
        $sql = "UPDATE danhmuc SET tendanhmuc = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $tendanhmuc, $iddm);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "Danh mục đã được cập nhật thành công.";

                // Reset form fields
                $tendanhmuc = ""; // Reset the variable to empty

            } else {
                echo "Lỗi khi cập nhật danh mục: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Lỗi trong việc chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>