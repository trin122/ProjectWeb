<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "webbansach");

//biến tìm kiếm
$search = isset($_GET["header_search"]) ? $_GET["header_search"] : "";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>
    <script src="/project/LTWEB/CKI/js/header.js"></script>
</head>

<body>
    <!-- Header -->
    <?php
    include ("form/header.php");
    ?>

    <!-- Body -->
    <div id="container_find">
        <div id="title_find">
            <a href="/project/LTWEB/CKI/html/trangchu.php">Trang chủ</a><i class="fa-solid fa-angle-right"></i>Tìm kiếm
        </div>
        <div id="container_result">
            <?php
            $truyvan = "SELECT * FROM danhsachtruyen WHERE ten like '%$search%' OR taptruyen like '%$search%' OR theloai like '%$search%'";
            $thuchien = mysqli_query($conn, $truyvan);

            if ($thuchien) {
                if (mysqli_num_rows($thuchien) > 0) {
                    while ($row = mysqli_fetch_array($thuchien)) {
                        $ten = $row['ten'];
                        $taptruyen = $row['taptruyen'];
                        $hinhanh = $row['hinhanh'];
                        $gia = number_format($row['gia'], 0, '', ',') . "<u>đ</u>";

                        echo "<div id-product='$row[id]' class='item_book'>";
                        echo "<div class='name_book'>";
                        echo "<a href='/project/LTWEB/CKI/html/danhmuc/chitietsanpham.php?id=" . $row['id'] . "'><p>$ten $taptruyen</p></a>";
                        echo "<p>$gia</p>";
                        echo "</div>";
                        echo "<div class='img_book'>";
                        echo "<img src='../$hinhanh'>";
                        echo "</div>";
                        echo "<div class='add_book'>";
                        echo "<button class='btn_themgiohang' data-id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "Không có sản phẩm theo yêu cầu";
                }
            } else {
                echo " " . $conn->error;
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include ("form/footer.php");
    ?>
</body>

</html>