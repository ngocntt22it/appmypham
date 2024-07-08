
    // Bắt sự kiện click vào phần tử có class "article-link"
    document.addEventListener('DOMContentLoaded', function() {
        var articleLinks = document.querySelectorAll('.article-link');

        articleLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Lấy id bài viết từ thuộc tính data
                var articleId = this.getAttribute("data-article-id");

                // Chuyển hướng đến trang Exx và truyền id bài viết
                window.location.href = "nd-baiviet.php?id=" + articleId;
            });
        });
    });
    
    var swiper = new Swiper(".slide-container", {
        slidesPerView: 4,
        spaceBetween: 20,
        sliderPerGroup: 4,
        loop: true,
        centerSlide: "true",
        fade: "true",
        grabCursor: "true",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
        },
    });

