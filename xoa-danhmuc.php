<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa danh mục</title>
</head>

<body>
    <h1>Xóa danh mục</h1>
    <?php 
    $conn = mysqli_connect("localhost","root","","mypham");

    $id_to_delete = $_GET['iddm'];
    $sql = "DELETE FROM danhmuc WHERE id = " . $id_to_delete;
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        header("Location: danhsachdanhmuc.php");
        exit(); 
    } else {
        echo "Lỗi xóa danh mục: " . mysqli_error($conn);
    }
    ?>
</body>

</html>