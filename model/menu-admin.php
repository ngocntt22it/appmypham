<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu Admin</title>
    <link rel="stylesheet" href="css/menuadmin.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <span class="logo-name">Admin</span>
        </div>
        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Admin</span>
            </div>

            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a href="admin.php" class="nav-link">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Bảng điều khiển</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="danhsachkhachhang.php" class="nav-link">
                            <i class="bx bx-user icon"></i>
                            <span class="link">Quản lý khách hàng</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="danhsachdanhmuc.php" class="nav-link">
                            <i class="bx bx-folder-open icon"></i>
                            <span class="link">Quản lý danh mục</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="quanlysanpham.php" class="nav-link">
                            <i class="bx bx-list-ul icon"></i>
                            <span class="link">Quản lý sản phẩm</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="quanlycombo.php" class="nav-link">
                            <i class="bx bx-cube icon"></i>
                            <span class="link">Quản lý Combo</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="danhsachbaiviet.php" class="nav-link">
                            <i class="bx bx-book-open icon"></i>
                            <span class="link">Quản lý bài viết</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="quanlydonhang.php" class="nav-link">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="link">Quản lý đơn hàng</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#" class="nav-link">
                            <i class="bx bx-bell icon"></i>
                            <span class="link">Thông báo</span>
                        </a>
                    </li>



                </ul>

                <div class="bottom-cotent">
                    <li class="list">
                        <a href="#" class="nav-link">
                            <i class="bx bx-cog icon"></i>
                            <span class="link">Cài đặt</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="logout.php" class="nav-link">
                            <i class="bx bx-log-out icon"></i>
                            <span class="link">Đăng xuất</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <section class="overlay"></section>

    <script>
    const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon"),
        overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    });
    </script>
</body>

</html>