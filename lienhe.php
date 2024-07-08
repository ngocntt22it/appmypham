<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Lien He</title>
    <link rel="stylesheet" href="css/pagelienhe.css">
</head>

<body>
    <?php include('model/menu-user.php'); ?>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">LIÊN HỆ</span>
        </h3>
    </div>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7332975515756!2d108.24978007377474!3d15.975298241948362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1684405670655!5m2!1svi!2s"
            frameborder="0" style="border: 0; width: 100%; height: 330px" allowfullscreen></iframe>
    </div>
    <div class="lien-he">
        <div class="lh-container">
            <div class="text">Liên Hệ Với Chúng Tôi</div>
            <form action="#">
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Họ</label>
                    </div>
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Tên</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Địa chỉ Email</label>
                    </div>
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Website</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <textarea rows="8" cols="80" required></textarea>
                        <br />
                        <div class="underline"></div>
                        <label for="">Thông tin liên hệ</label>
                        <br />
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="submit" value="Gửi liên hệ">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include('model/footer.php'); ?>
    <?php include('model/social.php'); ?>

</body>

</html>