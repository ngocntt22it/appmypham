<?php
session_start();

if (!isset($_SESSION['tendangnhap'])) {
    // Người dùng chưa đăng nhập, chuyển hướng hoặc thực hiện hành động khác
    header("Location: login.php");
    exit();
}

$tendangnhap = $_SESSION['tendangnhap'];

$conn = mysqli_connect("localhost","root","","mypham");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ cơ sở dữ liệu
$query = "SELECT sodienthoai, email FROM taikhoan WHERE tendangnhap = '$tendangnhap'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $sodienthoai = $row['sodienthoai'];
    $email = $row['email'];
} else {
    $sodienthoai = '';
    $email = '';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin</title>
    <link rel="stylesheet" href="css/ttuser.css">
    <style>
    body {
        background: #000;
    }

    body::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0.5;
        width: 100%;
        height: 100%;
        background: url("uploads/biatt.jpg");
        background-position: center;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-gBbHRFH4Meb1RvBc5ajLooxji0Zw0SbuAgc5RiZi9G5RRQ4p1QaJbS/J9nFVIZdn" crossorigin="anonymous">

</head>

<body>
    <nav>
        <a href="index.php" style="text-decoration: none; color: #fff; font-size: 2.5rem; font-weight: bold"><span
                style="color: #F5A89A">C</span>omestic</a>
    </nav>
    <div class="form-wrapper">
        <h2>Tài Khoản Của Tôi</h2>
        <form action='logout.php' class="dangnhap" method='POST'>
            <div class="form-control">
                <label>Tên đăng nhập: <?php echo $tendangnhap; ?></label>
            </div>
            <div class="form-control">
                <label>Điện thoại: <?php echo $sodienthoai; ?></label>
            </div>
            <div class="form-control">
                <label>Email: <?php echo $email; ?></label>
            </div>
            <button type="submit">Đăng xuất</button>
        </form>

        <p>Cập nhật thông tin ? <a href="#"> Tại đây</a></p>
    </div>
</body>

</html>