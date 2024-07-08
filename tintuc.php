<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Tin tức</title>
    <link rel="stylesheet" href="css/pagetintuc.css">
</head>

<body>
    <?php include('model/menu-user.php'); ?>
    <?php include('model/baiviet.php'); ?>
    <div id='nz-div'>
        <h3 class="tde">
            <span class="null">Tin tức</span>
        </h3>
    </div>
    <?php include('model/bv_tintuc.php'); ?>
    <div style="margin-top: 5%"><?php include('model/footer.php'); ?></div>
    <?php include('model/social.php'); ?>

</body>

</html>