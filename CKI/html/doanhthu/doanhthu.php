<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doanh thu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/doanhthu.css">

    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="/project/LTWEB/CKI/js/doanhthu.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>

</head>

<body>
    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>

    <div id="container_revenu">
        <div id="title_revenu">
            <a href="/project/LTWEB/CKI/html/trangchu.php">Trang chủ</a><i class="fa-solid fa-angle-right"></i><a href="doanhthu.php">Quản lý
                doanh thu</a>
        </div>
        <div class="funct_revenu">
            <div id="form_search_revenu">
                <label for="date_from">Từ
                    <input type="date" id="date_from">
                </label>
                <label for="date_to">đến
                    <input type="date" id="date_to">
                </label>
                <hr>
                <label for="input_search">
                    <input type="text" id="input_search" placeholder="Nhập từ khóa...">
                </label>
            </div>
        </div>
        <div id="content_revenu">
        </div>
    </div>

    <div class="container_chart">
        <div id="chart_time">
            <canvas id="myChart_time"></canvas>
        </div>
        <div id="chart_date">
            <canvas id="myChart_date"></canvas>
        </div>
    </div>

    <div class="container_chart">
        <div id="chart_month">
            <canvas id="myChart_month"></canvas>
        </div>
        <div id="barChart_product">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include ("../form/footer.php");
    ?>
</body>

</html>