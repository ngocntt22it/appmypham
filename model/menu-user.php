<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Menu User </title>
    <link rel="stylesheet" href="css/menu.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="menu-user">
        <nav>
            <div class="navbar">
                <i class='bx bx-menu'></i>
                <div class="logo"><a href="#"><span style="color: #F5A89A">C</span>omestic</a></div>
                <div class="nav-links">
                    <div class="sidebar-logo">
                        <span class="logo-name"><span style="color: #F5A89A">C</span>omestic</span>
                        <i class='bx bx-x'></i>
                    </div>
                    <ul class="links">
                        <li><a href="index.php">TRANG CHỦ</a></li>
                        <li>
                            <a href="trang-sanpham.php">SẢN PHẨM</a>
                            <!-- <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i> -->
                            <ul class="htmlCss-sub-menu sub-menu">
                                <li><a href="#">Danh mục</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="gioithieu.php">GIỚI THIỆU</a>
                            <!-- <i class='bx bxs-chevron-down js-arrow arrow '></i> -->
                        </li>
                        <li><a href="lienhe.php">LIÊN HỆ</a></li>
                        <li><a href="tintuc.php">TIN TỨC</a></li>
                        <li class="tai-khoan"><a href="trang-user.php">TÀI KHOẢN</a></li>
                    </ul>
                </div>
                <div class="search-box">
                    <i class='bx bx-search'></i>
                    <div class="input-box">
                        <form action="timkiem.php" method="GET">
                            <input type="text" name="search" placeholder="Search...">
                        </form>
                    </div>
                    <a href="giohang.php"><i class='bx bx-cart cart-icon'></i></a>
                    <a href="trang-user.php"><i class='bx bx-user user-icon'></i></a>
                </div>
            </div>
        </nav>
        <script>
        let navbar = document.querySelector(".navbar");
        let searchBox = document.querySelector(".search-box .bx-search");

        searchBox.addEventListener("click", () => {
            navbar.classList.toggle("showInput");
            if (navbar.classList.contains("showInput")) {
                searchBox.classList.replace("bx-search", "bx-x");
            } else {
                searchBox.classList.replace("bx-x", "bx-search");
            }
        });

        // sidebar open close js code
        let navLinks = document.querySelector(".nav-links");
        let menuOpenBtn = document.querySelector(".navbar .bx-menu");
        let menuCloseBtn = document.querySelector(".nav-links .bx-x");
        menuOpenBtn.onclick = function() {
            navLinks.style.left = "0";
        }
        menuCloseBtn.onclick = function() {
            navLinks.style.left = "-100%";
        }


        // sidebar submenu open close js code
        let htmlcssArrow = document.querySelector(".htmlcss-arrow");
        htmlcssArrow.onclick = function() {
            navLinks.classList.toggle("show1");
        }
        let moreArrow = document.querySelector(".more-arrow");
        moreArrow.onclick = function() {
            navLinks.classList.toggle("show2");
        }
        let jsArrow = document.querySelector(".js-arrow");
        jsArrow.onclick = function() {
            navLinks.classList.toggle("show3");
        }
        </script>
    </div>
    <div class="header">
        <div class="wrapper">
            <input type="radio" name="slide" id="one" checked>
            <input type="radio" name="slide" id="two">
            <input type="radio" name="slide" id="three">
            <input type="radio" name="slide" id="four">
            <input type="radio" name="slide" id="five">
            <div class="img img-1">
                <img src="uploads/bia1.jpg" alt="">
            </div>
            <div class="img img-2">
                <img src="uploads/bia.png" alt="">
            </div>
            <div class="img img-3">
                <img src="uploads/bia2.webp" alt="">
            </div>
            <div class="img img-4">
                <img src="uploads/bia3.jpg" alt="">
            </div>
            <div class="img img-5">
                <img src="uploads/bia4.webp" alt="">
            </div>
            <div class="sliders">
                <label for="one" class="one"></label>
                <label for="two" class="two"></label>
                <label for="three" class="three"></label>
                <label for="four" class="four"></label>
                <label for="five" class="five"></label>
            </div>
        </div>
    </div>
</body>

</html>