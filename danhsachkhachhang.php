<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dsbaiviet.css">

    </style>
</head>

<body>
    <?php include('model/menu-admin.php'); ?>
    <!-- <?php session_start(); ?> -->
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">DANH SÁCH TÀI KHOẢN</span>
        </h3>
    </div>
    <div class="baiviet">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên đăng nhập</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Xóa</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                $conn = mysqli_connect("localhost","root","","mypham");
                $sql = "SELECT * FROM taikhoan" ;
                $kq = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_array($kq)){
                    echo '<tr>';
                    echo '<td>' .$row["id"] . '</td>';
                    echo '<td>'. $row["tendangnhap"] . '</td>';
                    echo '<td>' . $row["sodienthoai"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td><a href="xoa-khachhang.php?idkh='.$row['id'].'">Xóa</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>