<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

$connect = mysqli_connect('localhost', 'root', '', 'mypham');
if (!$connect) {
    die('Không thể kết nối tới database: ' . mysqli_connect_error());
}
mysqli_set_charset($connect, 'UTF8');

if (isset($_POST['dangnhap'])) {
    $tendangnhap = addslashes($_POST['tendangnhap']);
    $matkhau = addslashes($_POST['matkhau']);

    if (!$tendangnhap || !$matkhau) {
        echo '<script language="javascript">alert("Vui lòng nhập đầy đủ tên và mật khẩu!"); window.location="login.php";</script>';
    } else {
        // Check if admin credentials
        if ($tendangnhap === 'admin5124' && $matkhau === '0501200451Ni') {
            $_SESSION['tendangnhap'] = $tendangnhap;
            header('Location: admin.php'); // Redirect to admin.php
            exit();
        }

        // For regular users
        $query = "SELECT tendangnhap, matkhau FROM taikhoan WHERE tendangnhap=?";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "s", $tendangnhap);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);

            if (password_verify(trim($matkhau), trim($row['matkhau']))) {
                $_SESSION['tendangnhap'] = $tendangnhap;
                echo '<script language="javascript">alert("Đăng nhập thành công!"); window.location="index.php";</script>';
            } else {
                echo '<script language="javascript">alert("Mật khẩu không đúng. Vui lòng nhập lại.!"); window.location="login.php";</script>';
            }
        } else {
            echo '<script language="javascript">alert("Tên đăng nhập hoặc mật khẩu không đúng!"); window.location="login.php";</script>';
        }
    }

    $connect->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        background: url("uploads/bia.png");
        background-position: center;
    }
    </style>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-gBbHRFH4Meb1RvBc5ajLooxji0Zw0SbuAgc5RiZi9G5RRQ4p1QaJbS/J9nFVIZdn" crossorigin="anonymous">
</head>

<body>
    <nav>
        <a href="index.php" style="text-decoration: none; color: #fff; font-size: 2.5rem; font-weight: bold;"><span
                style="color: #F5A89A">C</span>omestic</a>
    </nav>
    <div class="form-wrapper">
        <h2>Đăng Nhập</h2>
        <form action='login.php' class="dangnhap" method='POST'>
            <div class="form-control">
                <input type="text" name='tendangnhap' required>
                <label>Tên đăng nhập</label>
            </div>
            <div class="form-control">
                <input type="password" name='matkhau' required>
                <label>Mật khẩu</label>
            </div>
            <button type="submit" name="dangnhap">Đăng nhập</button>
            <div class="form-help">
                <div class="remember-me">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <a href="#">Trợ giúp?</a>
            </div>
        </form>
        <p>Bạn chưa có tài khoản ?<a href="register.php">Đăng ký ngay</a></p>
        <small>

        </small>
    </div>

</body>

</html>