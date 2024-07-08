<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Đặt Hàng</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <div class="formkh">
        <div class="container">
            <form method="post" action="processdathang.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <label for="name">Họ và tên:</label>
                        <input type="text" id="name" name="name" required><br><br>
                    </div>
                    <div class="col">
                        <label for="phone">Số điện thoại:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>

                <label for="name">Địa chỉ:</label>
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
                            <option value="">AA</option>

                            <!-- Các phường/xã sẽ được tải bằng JavaScript -->
                        </select>
                    </div>
                    <div class="col">
                        <label for="address">Địa chỉ cụ thể:</label>
                        <input type="text" id="address" name="address">
                    </div>

                    <div class="col">
                        <label for="payment">Phương thức thanh toán:</label>
                        <select id="payment" name="payment" required>
                            <option value="cash">Thanh toán khi nhận hàng</option>
                            <option value="credit">Thẻ tín dụng</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <script>
        // Dữ liệu mẫu về quận/huyện và phường/xã
        const districtsData = {
            hanoi: ["Ba Đình", "Hoàn Kiếm", "Hai Bà Trưng"],
            hochiminh: ["Quận 1", "Quận 2", "Quận 3"]
            // Thêm dữ liệu cho các tỉnh/thành phố khác nếu cần
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
            // Tương tự như hàm loadDistricts, bạn có thể xây dựng hàm này để tải danh sách phường/xã
        }
        </script>
    </div>
</body>

</html>