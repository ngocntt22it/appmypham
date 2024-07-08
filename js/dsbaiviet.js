 // Bắt sự kiện click vào phần tử có class "article-link"
 document.addEventListener('DOMContentLoaded', function() {
    var articleLinks = document.querySelectorAll('.article-link');
    articleLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Lấy id bài viết từ thuộc tính data
            var articleId = this.getAttribute("data-article-id");
            // Chuyển hướng đến trang Exx và truyền id bài viết
            window.location.href = "admin_bv.php?id=" + articleId;
        });
    });
});