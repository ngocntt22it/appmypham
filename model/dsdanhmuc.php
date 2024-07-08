<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách danh mục</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dsdanhmuc.css">

</head>

<body>
    <!-- <?php session_start(); ?> -->
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">DANH SÁCH DANH MỤC</span>
        </h3>
    </div>
    <div class="danhmuc">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên DM</th>
                    <th>Hình ảnh</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $conn = mysqli_connect("localhost","root","","mypham");
                $sql = "SELECT * FROM danhmuc" ;
                $kq = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_array($kq)){
                    echo '<tr>';
                    echo '<td>' .$row["id"] . '</td>';
                    echo '<td>'.'<a href="danhsachsanpham.php?iddm=' .$row['id'] .'">'. $row["tendanhmuc"] . '</a>' .'</td>';
                    echo '<td><img src="' .$row["hinhanh"].'" alt="Hình ảnh sản phẩm" width="100"></td>';
                    echo '<td><a href="xoa-danhmuc.php?iddm='.$row['id'].'">Xóa</a></td>';
                    echo '<td><a href="sua-danhmuc.php?iddm='.$row['id'].'">Sửa</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>