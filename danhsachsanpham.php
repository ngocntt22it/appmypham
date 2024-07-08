<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dssanpham.css">
    <title>Danh sách sản phẩm</title>
</head>

<body>
    <?php include('model/menu-admin.php'); ?>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">DANH SÁCH SẢN PHẨM</span>
        </h3>
        <div class="sub-cat">
            <a href="them-sanpham.php"><span>Thêm sản phẩm</span></a>
            &nbsp;<span>|</span>&nbsp;
            <a href="them-danhmuc.php"><span>Thêm danh mục</span></a>
        </div>
    </div>
    <div class="sanpham">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên SP </th>
                    <th>Hình ảnh</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Xoá</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "mypham");
                    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=" . $_GET['iddm'];
                    $kq = mysqli_query($conn, $sql);
                    
                    while ($row = mysqli_fetch_array($kq)) {
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td><a href="detail.php?idsp=' . $row['id'] . '">' . $row['tensanpham'] . '</a></td>';
                        echo '<td><img src="' . $row["hinhanh"] . '" alt="Hình ảnh sản phẩm" width="100"></td>';
                        echo '<td>' . $row["soluong"] . '</td>';
                        echo '<td>' . $row["dongia"] . '</td>';
                        echo '<td><a href="xoa-sanpham.php?idsp=' . $row['id'] . '">Xoá</a></td>';
                        echo '<td><a href="sua-sanpham.php?idsp=' . $row['id'] . '">Sửa</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>