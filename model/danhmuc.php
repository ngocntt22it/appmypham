<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục</title>
    <link rel="stylesheet" href="css/danhmuc.css">
</head>

<body>
    <div class="container1">
        <h2>Danh mục</h2>
    </div>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "mypham");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    <div class="circle-container" id="circleContainer">
        <?php
        $sql = "SELECT * FROM danhmuc";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="circle-wrapper">';
                echo "<div class='circle'>";
                echo '<a href="#"><img src="' . $row['hinhanh'] . '" alt="' . $row['tendanhmuc'] . '"></a>';
                echo '</div>';
                echo '<b>'.'<a href="sanphamtheodanhmuc.php?iddm=' .$row['id'] .'">'. $row["tendanhmuc"] . '</a>' .'</b>';
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
    <div class="arrows-container">
        <div class="arrow-frame prev-btn" onclick="scrollContainer('prev')">&lt;</div>
        <div class="arrow-frame next-btn" onclick="scrollContainer('next')">&gt;</div>
    </div>
    <script src="js/danhmuc.js"></script>
</body>

</html>