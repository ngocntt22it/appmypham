<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bài Viết</title>
    <link rel="stylesheet" href="swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/baiviet.css">
</head>

<body>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">GÓC LÀM ĐẸP</span>
        </h3>
    </div>
    <div class="baiviet">
        <div class="container swiper">
            <div class="slide-container">
                <div class="card-wrapper swiper-wrapper">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "mypham");
                    if (!$conn) {
                        die("Kết nối không thành công: " . mysqli_connect_error());
                    }
                    $sql = "SELECT id, tenbaiviet, cauchude, hinhanh FROM baiviett";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="card swiper-slide" data-article-id="' . $row['id'] . '">';
                            echo '<div class="image-box">';
                            echo '<img src="' . $row["hinhanh"] . '" alt="" />';
                            echo '</div>';
                            echo '<div class="profile-details">';
                            echo '<div class="name-job">';
                            echo '<h3 class="name article-link" data-article-id="' . $row['id'] . '">' . $row["tenbaiviet"] . '</h3>
                            ';
                            echo '<h4 class="job">' . $row["cauchude"] . '</h4>';
                            echo '</div>';
                            echo '</div>';

                            echo '</div>';
                        }
                    } else {
                        echo "Không có bài viết nào.";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <script src="swiper-bundle.min.js"></script>
    <script src="js/baiviet.js"></script>

</body>

</html>