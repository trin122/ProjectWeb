<?php
session_start();
?>
<!DOCTYPE html>
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

    <style>
        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 2% 0;
        }

        .context {
            max-width: 50%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 50px;
        }

        .context h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .context p,
        {
        font-size: 16px;
        margin-bottom: 10px;
        }

        .context a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            text-decoration: none;
            background-color: green;
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
        }

        .context a:hover {
            background-color: #5d8650;
        }

        .context>li {
            margin: 5% 0;
            list-style: none;
        }

        .context>li i {
            width: 10%;
            padding-right: 4%;
        }

        .context>li span {
            font-size: 2.5vh;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include ("../form/header.php"); ?>

    <!-- Body -->

    <div class="container">
        <div class="context">
            <?php
            include_once ('connect.php');

            $user = $_SESSION['taikhoan'];
            $query = "SELECT * FROM taikhoan WHERE taikhoan = '$user'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $userData = mysqli_fetch_assoc($result);
                ?>
                <h1>Thông tin người dùng</h1>
                <p>Họ: <?php echo htmlspecialchars($userData['ho']); ?></p>
                <p>Tên: <?php echo htmlspecialchars($userData['ten']); ?></p>
                <p>Tài khoản: <?php echo htmlspecialchars($userData['taikhoan']); ?></p>
                <p>Loại: <?php echo $userData['loai'] == 0 ? 'Quản trị viên' : 'Người dùng'; ?></p>
                <p>Địa chỉ: <?php echo htmlspecialchars($userData['diachi']." - ".$userData['xa']." - ".$userData['huyen']." - ".$userData['tinh']); ?></p>
                <p>Email: <?php echo htmlspecialchars($userData['email']); ?></p>
                <p>Số điện thoại: <?php echo htmlspecialchars($userData['sdt']); ?></p>
                <a href="capnhatnguoidung.php">Cập nhật thông tin</a>
                <a href="lichsumuahang.php">Lịch sử mua hàng</a>
                <?php
            } else {
                echo "Không thể lấy thông tin người dùng";
                exit();
            }
            ?>
        </div>
        <div class="context">
            <?php
            $truyvan_danhan = "SELECT * FROM doanhthu WHERE taikhoan = '$_SESSION[taikhoan]' AND trangthai = 0";
            $thuchien_danhan = mysqli_query($conn, $truyvan_danhan);

            $truyvan_giaohang_layhang = "SELECT * FROM doanhthu WHERE taikhoan = '$_SESSION[taikhoan]' AND danhan = 1";
            $thuchien_giaohang_layhang = mysqli_query($conn, $truyvan_giaohang_layhang);

            if ($thuchien_danhan && $thuchien_giaohang_layhang) {
                ?>
                <h1>Thông tin đơn hàng</h1>
                <li><i class="fa-solid fa-wallet"></i><span>Chờ xác nhận
                        (<?php echo mysqli_num_rows($thuchien_danhan) ?>)</span></li>
                <!-- <li><i class="fa-solid fa-box"></i><span>Đang lấy hàng
                        (<?php echo mysqli_num_rows($thuchien_giaohang_layhang) ?>)</span></li> -->
                <li><i class="fa-solid fa-truck"></i><span>Chờ giao hàng
                        (<?php echo mysqli_num_rows($thuchien_giaohang_layhang) ?>)</span></li>
                <?php
            } else {
                echo "Không thể lấy thông tin các đơn hàng";
                exit();
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include ("../form/footer.php"); ?>
</body>

</html>