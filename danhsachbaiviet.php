<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dsbaiviet.css">
    <style>

    </style>
</head>

<body>
    <?php include('model/menu-admin.php'); ?>
    <!-- <?php session_start(); ?> -->
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">DANH SÁCH BÀI VIẾT</span>
        </h3>
        <div class="sub-cat">
            <a href="them-baiviet.php"><span>Thêm bài viết</span></a>
        </div>
    </div>
    <div class="baiviet">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên BV</th>
                    <th>Hình ảnh</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $conn = mysqli_connect("localhost","root","","mypham");
                $sql = "SELECT * FROM baiviett" ;
                $kq = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_array($kq)){
                    echo '<tr>';
                    echo '<td>' .$row["id"] . '</td>';
                    echo '<td>'.'<a class="name article-link" data-article-id="' . $row['id'] . '">'. $row["tenbaiviet"] . '</a>' .'</td>';
                    echo '<td><img src="' .$row["hinhanh"].'" alt="Hình ảnh sản phẩm" width="100"></td>';
                    echo '<td><a href="xoa-baiviet.php?idbv='.$row['id'].'">Xóa</a></td>';
                    echo '<td><a href="sua-baiviet.php?idbv='.$row['id'].'">Sửa</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/dsbaiviet.js"></script>

</body>

</html>