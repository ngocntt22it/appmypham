<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="css/pagegiohang.css">
    <style>
    .formkh {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .formkh .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .formkh .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .formkh .col {
        flex-grow: 1;
        min-width: 0;
    }

    .formkh select,
    .formkh input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .formkh label {
        margin-left: -50px;
        color: #B2001F;
    }

    .formkh .address-section {
        display: flex;
        gap: 10px;
        flex-grow: 1;
    }

    .formkh .address-section select {
        flex-grow: 1;
    }

    .formkh button {
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .formkh button:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <?php
    session_start();
    include('model/menu.php');
    ?>

    <div class="giohang">
        <h1>ĐƠN ĐẶT HÀNG</h1>

        <?php
        if (isset($_SESSION['tendangnhap'])) {
            $tendangnhap = $_SESSION['tendangnhap'];
            $conn = mysqli_connect("localhost", "root", "", "mypham");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "SELECT * FROM giohangg WHERE tendangnhap='$tendangnhap'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='pro'>";
                    echo '<p><img src="' . $row["hinhanh"] . '" alt="Hình ảnh sản phẩm" width="100"></p>';
                    echo "<div class='pro-info'>";
                    echo "<h3>" . $row['tensanpham'] . "</h3>";
                    echo "<p>Số Lượng: " . $row['soluong'] . "</p>";
                    echo "<p>Đơn Giá: " . number_format($row['dongia'], 3) . " VND</p>";
                    echo "<p>Tổng Tiền: " . number_format($row['tongtien'], 3) . " VND</p>";
                    echo "</div>";
                    echo "</div>";
                }

                $totalPriceAllProducts = mysqli_query($conn, "SELECT SUM(tongtien) AS total FROM giohangg WHERE tendangnhap='$tendangnhap'");
                $totalPrice = mysqli_fetch_assoc($totalPriceAllProducts)['total'];

                ?>
        <div class="formkh">
            <div class="container">
                <form method="post" action="processdathang.php">
                    <div class="row">
                        <div class="col">
                            <!-- <label for="name">Họ và tên:</label> -->
                            <input type="text" id="name" name="name" placeholder="Họ và tên" required><br><br>
                        </div>
                        <div class="col">
                            <!-- <label for="phone">Số điện thoại:</label> -->
                            <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" required>
                        </div>
                    </div>
                    <!-- <label for="name">Địa chỉ:</label> -->
                    <div class="row">
                        <div class="col address-section">
                            <select id="province" name="province" onchange="loadDistricts()">
                                <option value="">Chọn tỉnh/thành phố</option>
                                <option value="hanoi">Hà Nội</option>
                                <option value="hochiminh">Hồ Chí Minh</option>
                                <!-- Thêm các tỉnh/thành phố khác -->
                            </select>

                            <select id="district" name="district" onchange="loadWards()">
                                <option value="">Chọn quận/huyện</option>
                                <!-- Các quận/huyện sẽ được tải bằng JavaScript -->
                            </select>

                            <select id="ward" name="ward">
                                <option value="">Chọn phường/xã</option>
                            </select>
                        </div>
                        <div class="col">
                            <!-- <label for="address">Địa chỉ cụ thể:</label> -->
                            <input type="text" id="address" name="address" placeholder="Địa chỉ cụ thể">
                        </div>

                        <div class="col">
                            <!-- <label for="payment">Phương thức thanh toán:</label> -->
                            <select id="payment" name="payment" required>
                                <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                <option value="Thẻ tín dụng">Thẻ tín dụng</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                    </div>

                    <div class="total-payment">
                        <h2>Tổng Thanh Toán:</h2>
                        <span><?php echo number_format($totalPrice, 3); ?> VND</span>
                    </div>

                    <input type="submit" value="Đặt hàng ngay">
                </form>
            </div>

            <script>
            const districtsData = {
                hanoi: ["Ba Đình", "Hoàn Kiếm", "Hai Bà Trưng"],
                hochiminh: ["Quận 1", "Quận 2", "Quận 3"]
                // Thêm dữ liệu cho các tỉnh/thành phố khác nếu cần
            };

            const wardsData = {
                hanoi: {
                    "Ba Đình": ["Phường 1", "Phường 2", "Phường 3"],
                    "Hoàn Kiếm": ["Phường 4", "Phường 5", "Phường 6"],
                    "Hai Bà Trưng": ["Phường 7", "Phường 8", "Phường 9"]
                },
                hochiminh: {
                    "Quận 1": ["Phường 10", "Phường 11", "Phường 12"],
                    "Quận 2": ["Phường 13", "Phường 14", "Phường 15"],
                    "Quận 3": ["Phường 16", "Phường 17", "Phường 18"]
                    // Thêm dữ liệu cho các quận/huyện khác nếu cần
                }
            };

            function loadDistricts() {
                const provinceSelect = document.getElementById("province");
                const districtSelect = document.getElementById("district");
                const selectedProvince = provinceSelect.value;

                // Xóa các option cũ
                districtSelect.innerHTML = "<option value=''>Chọn quận/huyện</option>";

                if (selectedProvince in districtsData) {
                    // Thêm các option mới dựa trên dữ liệu mẫu
                    districtsData[selectedProvince].forEach((district) => {
                        const option = document.createElement("option");
                        option.value = district;
                        option.text = district;
                        districtSelect.add(option);
                    });
                }
            }

            function loadWards() {
                const districtSelect = document.getElementById("district");
                const wardSelect = document.getElementById("ward");
                const selectedProvince = document.getElementById("province").value;
                const selectedDistrict = districtSelect.value;

                // Xóa các option cũ
                wardSelect.innerHTML = "<option value=''>Chọn phường/xã</option>";

                if (selectedProvince in wardsData && selectedDistrict in wardsData[selectedProvince]) {
                    // Thêm các option mới dựa trên dữ liệu mẫu
                    wardsData[selectedProvince][selectedDistrict].forEach((ward) => {
                        const option = document.createElement("option");
                        option.value = ward;
                        option.text = ward;
                        wardSelect.add(option);
                    });
                }
            }
            </script>
        </div>
        <?php
            } else {
                echo "Giỏ hàng trống.";
            }

            $conn->close();
        } else {
            echo "<p>Vui lòng <a href='login.php'>đăng nhập</a> hoặc <a href='register.php'>đăng ký</a> để xem giỏ hàng.</p>";
        }
        ?>
        <p><a href="giohang.php">Quay lại giỏ hàng</a></p>
    </div>
    <?php include('model/footer.php'); ?>

</body>

</html>