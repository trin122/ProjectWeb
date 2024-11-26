<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm chờ duyệt</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/spdoiduyet.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/spdoiduyet.js"></script>
    <!-- <script src="../js/trangchu.js"></script> -->

</head>

<body>
    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>

    <!-- Body -->
    <div id="container_spdoiduyet">
        <div id="title_spdoiduyet">
            <a href="trangchu.php">Trang chủ</a><i class="fa-solid fa-angle-right"></i><a href="spdoiduyet.php">Sản phẩm chờ duyệt</a>
        </div>
        <div id="container_content">
        </div>
    </div>

    <!-- Footer -->
    <?php
    include ("../form/footer.php");
    ?>

    <div id="dialog_spdoiduyet">
        <div id="dialog" class="dialog">
            <div id="title_dialog_spdoiduyet"></div>
            <div id="btn_dialog_spdoiduyet">
                <button id="btn_accept_spdoiduyet">Xác nhận duyệt</button>
                <button id="btn_huydon_spdoiduyet">Xác nhận hủy</button>
                <button id="btn_exit_spdoiduyet">Hủy</button>
            </div>
        </div>
    </div>

</body>

</html>