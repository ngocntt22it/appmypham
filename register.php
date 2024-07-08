<?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost","root","","mypham") or die ('Lỗi kết nối'); mysqli_set_charset($conn, "utf8");

// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
$tendangnhap = trim($_POST['tendangnhap']);
$matkhau = password_hash(trim($_POST['matkhau']), PASSWORD_DEFAULT);
$email = trim($_POST['email']);
$sodienthoai = trim($_POST['sodienthoai']);


if (empty($tendangnhap)) {
array_push($errors, "Username is required"); 
}
if (empty($email)) {
array_push($errors, "Email is required"); 
}
if (empty($sodienthoai)) {
array_push($errors, "Password is required"); 
}
if (empty($matkhau)) {
array_push($errors, "Two password do not match"); 
}

// Kiểm tra username hoặc email có bị trùng hay không
$sql = "SELECT * FROM taikhoan WHERE tendangnhap = '$tendangnhap' OR email = '$email'";

// Thực thi câu truy vấn
$result = mysqli_query($conn, $sql);

// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
if (mysqli_num_rows($result) > 0)
{
echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="register.php";</script>';

// Dừng chương trình
die ();
}
else {
$sql = "INSERT INTO taikhoan (tendangnhap, matkhau, email, sodienthoai) VALUES ('$tendangnhap','$matkhau','$email','$sodienthoai')";
echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="register.php";</script>';

if (mysqli_query($conn, $sql)){
echo "Tên đăng nhập: ".$_POST['tendangnhap']."<br/>";
echo "Mật khẩu: " .$_POST['matkhau']."<br/>";
echo "Email đăng nhập: ".$_POST['email']."<br/>";
echo "Số điện thoại: ".$_POST['sodienthoai']."<br/>";
}
else {
echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
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
    <link rel="stylesheet" href="css/register.css">

</head>

<body>
    <nav>
        <a href="index.php" style="text-decoration: none; color: #fff; font-size: 2.5rem; font-weight: bold;"><span
                style="color: #F5A89A">C</span>omestic</a>
    </nav>
    <div class="form-wrapper">
        <h2>Đăng Ký</h2>
        <form method="post" action="register.php">
            <div class="form-control">
                <input type="text" name="tendangnhap" required>
                <label>Tên đăng nhập</label>
            </div>
            <div class="form-control">
                <input type="password" name="matkhau" required>
                <label>Mật khẩu</label>
            </div>
            <div class="form-control">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="form-control">
                <input type="text" name="sodienthoai" required>
                <label>Số điện thoại</label>
            </div>
            <button type="submit" type="submit" name="dangky">Đăng ký</button>
            <div class="form-help">
                <div class="remember-me">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <a href="#">Trợ giúp?</a>
            </div>
        </form>
        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        <small>
            <!-- This page is protected by Google reCAPTCHA to ensure you're not a bot.
            <a href="#">Learn more.</a> -->
        </small>
    </div>
</body>

</html>