<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">

    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>
    <script src="/project/LTWEB/CKI/js/header.js"></script>

    <style>
        .product-wrapper {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .breadcrumb {
            color: #6B8E23;
            margin: 10px 0;
            font-size: 1.1em;
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: flex-start;
            padding-left: 9%;
        }

        .breadcrumb a {
            color: #6B8E23;
            text-decoration: none;
            margin-right: 5px;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb a::after {
            content: ">";
            margin-left: 7px;
        }

        .breadcrumb a:last-child::after {
            content: "";
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            display: flex;
            gap: 20px;
        }

        .left-column {
            width: 40%;
        }

        .product-image {
            width: 100%;
            height: auto;
        }

        .small-images {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .small-images img {
            width: 60px;
            height: 60px;
            cursor: pointer;
        }

        .right-column {
            width: 60%;
            display: flex;
            flex-direction: column;
        }

        .product-details {
            display: flex;
            flex-direction: column;
        }

        h1 {
            color: #007BFF;
            margin-bottom: 10px;
        }

        .price {
            color: red;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 20px;
        }

        .details-grid p {
            color: #555;
        }

        .summary {
            margin: 20px 0;
        }

        .quantity {
            display: flex;
            align-items: center;
            margin-left: 20px;
            padding-left: 255px;
        }

        .quantity button {
            width: 30px;
            height: 20px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .quantity input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .btn.add-to-cart {
            background-color: #28a745;
        }

        .btn.add-to-cart:hover {
            background-color: #218838;
        }

        .tags {
            margin: 20px 0;
        }

        .p {
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        .product-details p strong {
            color: #000;
        }
    </style>
</head>

<body>
    <div>
        <?php include ("../form/header.php"); ?>
        <div class="breadcrumb">
            <a href="#">TRANG CHỦ</a>
            <a href="#">DANH MỤC</a>
            <a href="#">CHI TIẾT SẢN PHẨM</a>
        </div>
        <div class="product-wrapper">
            <div class="container">
                <?php
                // Kết nối cơ sở dữ liệu
                $conn = new mysqli('localhost', 'root', '', 'webbansach');

                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // Lấy ID sản phẩm từ URL
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                // Lấy thông tin sản phẩm
                $query = "SELECT * FROM danhsachtruyen WHERE id = $id";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="left-column">';
                    echo '<img class="product-image" src="/project/LTWEB/CKI/' . $row['hinhanh'] . '" alt="' . htmlspecialchars($row['ten']) . '">';
                    echo '</div>';
                    echo '<div class="right-column">';
                    echo '<div class="product-details">';
                    echo '<h1>' . htmlspecialchars($row['ten']) . ' - ' . htmlspecialchars($row["taptruyen"]) . '</h1>';
                    echo '<div style="display: flex; align-items: center;">';
                    echo '<p class="price">' . number_format($row['gia'], 0, ',', '.') . 'đ</p>';
                    // echo '<div class="quantity">';
                    // echo '<button onclick="decreaseQuantity()">-</button>';
                    // echo '<input type="number" value="1" min="1" max="' . htmlspecialchars($row['soluongtonkho']) . '">';
                    // echo '<button onclick="increaseQuantity()">+</button>';
                    // echo '</div>';
                    echo '</div>';
                    echo '<div class="details-grid">';
                    echo '<p class="p"><strong>Thể loại:</strong> ' . htmlspecialchars($row['theloai']) . '</p>';
                    echo '<p class="p"><strong>Tác giả:</strong> ' . htmlspecialchars($row['tentacgia']) . '</p>';
                    echo '<p class="p"><strong>Dịch giả:</strong> ' . htmlspecialchars($row['dichgia']) . '</p>';
                    echo '<p class="p"><strong>Họa sĩ:</strong> ' . htmlspecialchars($row['hoasi']) . '</p>';
                    echo '<p class="p"><strong>Xuất xứ:</strong> ' . htmlspecialchars($row['xuatsu']) . '</p>';
                    echo '<p class="p"><strong>Series:</strong> ' . htmlspecialchars($row['series']) . '</p>';
                    echo '</div>';
                    echo '<div class="summary">';
                    echo '<p class="p"><strong>Tóm tắt nội dung:</strong> ' . htmlspecialchars($row['mota']) . '</p>';
                    echo '</div>';

                    $buy_button_disabled = $row["soluongtonkho"] <= 0 ? ' disabled' : '';
                    $buy_button_class = $row["soluongtonkho"] <= 0 ? 'btn disabled' : 'btn';
                    $add_to_cart_button_class = $row["soluongtonkho"] <= 0 ? 'btn disabled add-to-cart' : 'btn add-to-cart';

                    echo '<div class="btn-container">';
                    if (isset($_SESSION['taikhoan'])) {
                        if ($_SESSION['loai'] != 0) {
                            echo '<a href="/project/LTWEB/CKI/html/nguoidung/giohang.php?id=' . $row['id'] . '" class="' . $add_to_cart_button_class . '"' . $buy_button_disabled . '>Thêm vào giỏ</a>';
                            echo '<a href="/project/LTWEB/CKI/html/api.php?action=buy&id=' . $row['id'] . '" class="' . $buy_button_class . '"' . $buy_button_disabled . '>Mua ngay</a>';
                        }
                    } else {
                        echo '<a href="/project/LTWEB/CKI/html/nguoidung/giohang.php?id=' . $row['id'] . '" class="' . $add_to_cart_button_class . '"' . $buy_button_disabled . '>Thêm vào giỏ</a>';
                        echo '<a href="/project/LTWEB/CKI/html/api.php?action=buy&id=' . $row['id'] . '" class="' . $buy_button_class . '"' . $buy_button_disabled . '>Mua ngay</a>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo "<p>Không tìm thấy sản phẩm.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <?php include ("../form/footer.php"); ?>

    <!-- <script>
        function decreaseQuantity() {
            let quantityInput = document.querySelector('.quantity input');
            if (quantityInput.value > 1) {
                quantityInput.value--;
            }
        }

        function increaseQuantity() {
            let quantityInput = document.querySelector('.quantity input');
            quantityInput.value++;
        }
    </script> -->

</body>

</html>