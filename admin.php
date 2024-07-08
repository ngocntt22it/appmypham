<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link rel="stylesheet" href="css/quanlysanpham.css">

    <style>
    #myChart {
        max-width: 100%;
        height: 450px;
    }

    @media (max-width: 320px) {
        #myChart {
            max-width: 100%;
            height: 400px;
        }

    }
    </style>
</head>

<body>
    <?php include('model/menu-admin.php'); ?>

    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">THỐNG KÊ</span>
        </h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy dữ liệu thống kê từ PHP
        var categoriesCount = <?php echo getCategoryCount(); ?>;
        var productsCount = <?php echo getProductCount(); ?>;
        var articlesCount = <?php echo getArticleCount(); ?>;
        var accountsCount = <?php echo getAccountCount(); ?>;
        var combosCount = <?php echo getComboCount(); ?>;

        // Điều chỉnh chiều cao của biểu đồ dựa trên kích thước màn hình
        var chartHeight = window.innerHeight * 0.5; // Điều chỉnh giá trị này nếu cần thiết

        // Vẽ biểu đồ cột
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Danh mục', 'Sản phẩm', 'Bài viết', 'Tài khoản', 'Combo'],
                datasets: [{
                    label: 'Số lượng',
                    data: [categoriesCount, productsCount, articlesCount, accountsCount,
                        combosCount
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255, 0.3)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                aspectRatio: 3, // Adjust this value to set the aspect ratio
                responsive: true,
                maintainAspectRatio: false, // Disable the default aspect ratio behavior
                height: chartHeight // Set the height dynamically
            }
        });
    });
    <?php
        function getCategoryCount() {
            // Thực hiện truy vấn để lấy số lượng danh mục từ CSDL
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            $sql = "SELECT COUNT(*) as count FROM danhmuc";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['count'];
        }

        function getProductCount() {
            // Thực hiện truy vấn để lấy số lượng sản phẩm từ CSDL
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            $sql = "SELECT COUNT(*) as count FROM sanpham";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['count'];
        }

        function getArticleCount() {
            // Thực hiện truy vấn để lấy số lượng bài viết từ CSDL
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            $sql = "SELECT COUNT(*) as count FROM baiviett";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['count'];
        }

        function getAccountCount() {
            // Thực hiện truy vấn để lấy số lượng tài khoản từ CSDL
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            $sql = "SELECT COUNT(*) as count FROM taikhoan";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['count'];
        }

        function getComboCount() {
            // Thực hiện truy vấn để lấy số lượng combo từ CSDL
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            $sql = "SELECT COUNT(*) as count FROM sanpham WHERE tensanpham LIKE '%Combo%'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['count'];
        }
        ?>
    </script>
    <?php include('model/dstaikhoan.php'); ?>
    <?php include('model/dsdanhmuc.php'); ?>
    <?php include('model/qlsanpham.php'); ?>
    <?php include('model/qlcombo.php'); ?>
    <?php include('model/dsbaiviet.php'); ?>

</body>

</html>