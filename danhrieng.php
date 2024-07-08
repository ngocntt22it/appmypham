<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .danhrieng .container {
        max-width: 1200px;
    }

    .danhrieng #filter-buttons button {
        border-radius: 3px;
        background: #fff;
        border-color: transparent;
    }

    .danhrieng #filter-buttons button:hover {
        background: #ddd;
    }

    .danhrieng #filter-buttons button.active {
        color: #fff;
        background: #6c757d;
    }

    .danhrieng #filterable-cards .card {
        width: 17.5rem;
        border: 2px solid transparent;
    }

    .danhrieng #filterable-cards .card.hide {
        display: none;
    }

    @media (max-width: 600px) {
        .danhrieng #filterable-cards {
            justify-content: center;
        }

        .danhrieng #filterable-cards .card {
            width: calc(90% / 2 - 10px);
        }
    }

    .danhrieng div#nz-div {
        border-bottom: 2px solid #CD5C5C;
        display: block;
        margin: 3% 9%;
    }

    .danhrieng #nz-div h3.tde {
        margin: 0;
        font-size: 16px;
        line-height: 20px;
        display: inline-block;
        text-transform: uppercase;
    }

    .danhrieng #nz-div h3.tde :after {
        content: "";
        width: 0;
        height: 0;
        border-top: 40px solid transparent;
        border-left: 20px solid #CD5C5C;
        border-bottom: 0px solid transparent;
        border-right: 0 solid transparent;
        position: absolute;
        top: 0px;
        right: -20px;
    }

    .danhrieng #nz-div h3.tde span {
        background: #CD5C5C;
        padding: 10px 20px 8px 20px;
        color: white;
        position: relative;
        display: inline-block;
        margin: 0;
    }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="danhrieng">

        <div id='nz-div'>
            <h3 class="tde">
                <span class="null">DÀNH RIÊNG CHO BẠN</span>
            </h3>
        </div>
        <div class="container">
            <!-- Images Filter Buttons Section -->
            <div class="row mt-5" id="filter-buttons">
                <div class="col-12">
                    <button class="btn mb-2 me-1 active" data-filter="all">Tất cả</button>
                    <button class="btn mb-2 mx-1" data-filter="nature">GIẢM 20%</button>
                    <button class="btn mb-2 mx-1" data-filter="cars">GIẢM 30%</button>
                    <button class="btn mb-2 mx-1" data-filter="people">GIẢM 50%</button>
                </div>
            </div>

            <!-- Filterable Images / Cards Section -->
            <div class="row px-2 mt-4 gap-3" id="filterable-cards">
                <div class="card p-0" data-name="nature">
                    <img src="uploads/kem-body.jpg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Kem Body</h6>
                        <p class="card-text">Dưỡng sáng...</p>
                    </div>
                </div>
                <div class="card p-0" data-name="nature">
                    <img src="uploads/serum-tram.jpg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Serum Tràm</h6>
                        <p class="card-text">Cấp ẩm..</p>
                    </div>
                </div>
                <div class="card p-0" data-name="nature">
                    <img src="uploads/son-merzy.jpg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Son Merzy</h6>
                        <p class="card-text">Son tin lì..</p>
                    </div>
                </div>
                <div class="card p-0" data-name="cars">
                    <img src="uploads/sua-rua-mat-innisfree.jpeg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Sửa rửa mặt Innisfree</h6>
                        <p class="card-text">Sạch sâu..</p>
                    </div>
                </div>
                <div class="card p-0" data-name="cars">
                    <img src="uploads/bang-phan-mat-Clio.webp" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Bảng phấn mắt Clio</h6>
                        <p class="card-text">Lâu trôi lên đến 24h..</p>
                    </div>
                </div>
                <div class="card p-0" data-name="cars">
                    <img src="uploads/duong-trang-olay.jpg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Dưỡng trắng Olay</h6>
                        <p class="card-text">Trắng nhanh..</p>
                    </div>
                </div>
                <div class="card p-0" data-name="people">
                    <img src="uploads/chi-ke-mat-focallure.jpg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Chì kẻ mắt Focallure</h6>
                        <p class="card-text">Mỏng nhẹ..</p>
                    </div>
                </div>
                <div class="card p-0" data-name="people">
                    <img src="uploads/da-hadalabo.jpg" alt="img">
                    <div class="card-body">
                        <h6 class="card-title">Sửa rửa mặt Hada-Labo</h6>
                        <p class="card-text">Sạch sâu - cấp ẩm..</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Select relevant HTML elements
    const filterButtons = document.querySelectorAll("#filter-buttons button");
    const filterableCards = document.querySelectorAll("#filterable-cards .card");

    // Function to filter cards based on filter buttons
    const filterCards = (e) => {
        document.querySelector("#filter-buttons .active").classList.remove("active");
        e.target.classList.add("active");

        filterableCards.forEach(card => {
            // show the card if it matches the clicked filter or show all cards if "all" filter is clicked
            if (card.dataset.name === e.target.dataset.filter || e.target.dataset.filter === "all") {
                return card.classList.replace("hide", "show");
            }
            card.classList.add("hide");
        });
    }

    filterButtons.forEach(button => button.addEventListener("click", filterCards));
    </script>


</body>

</html>