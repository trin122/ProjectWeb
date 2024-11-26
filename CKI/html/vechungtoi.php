<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi</title>

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
        .image-container {
            margin-top: 3%;
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
            height: 40%;
            display: flex;
            justify-content: center;
        }

        .image-container img {
            max-width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .content {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
        }

        .content h2 {
            color: #ff6600;
            font-size: 24px;
        }

        .content p {
            margin-bottom: 10px;
            text-align: center;
        }

        .highlight {
            color: #ff6600;
            font-weight: bold;
        }
    </style>
</head>
<?php
include ("form/header.php");
?>

<body>
    <div class="image-container">
        <img src="/project/LTWEB/CKI/img/logo/anh_trangchu.webp" alt="Hikaru">
    </div>

    <div class="content">
        <p><span class="highlight">Htfat</span> là Đại Lý phân phối, cung cấp sĩ lẻ sản phẩm của các nhà xuất bản trên
            toàn quốc.</p>
        <p><span class="highlight">Htfat</span> với các sản phẩm chủ lực của là Truyện Tranh, Light Novel, Truyện Thiếu
            Nhi, Sách, Báo, Tạp Chí và các vật phẩm - quà tặng liên quan.</p>
        <p><span class="highlight">Htfat</span> cam kết chỉ bán ra các sản phẩm có xuất xứ rõ ràng, minh bạch và phù
            hợp theo luật pháp Việt Nam.</p>
    </div>
    <?php
    include ("form/footer.php");
    ?>
</body>

</html>