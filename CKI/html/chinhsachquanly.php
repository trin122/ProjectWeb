<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính sách quản lý</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>
    <script src="/project/LTWEB/CKI/js/header.js"></script>
    <!-- <script src="/project/LTWEB/CKI/js/add_book.js"></script> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h1 {
            width: 80%;
            padding: 20px;
            margin: auto;
            font-size: 14px;
            /* Kích thước chữ */
            color: #555;
            /* Màu chữ */
            background-color: #e9ecef;
            /* Màu nền */
            padding: 10px 20px;
            /* Khoảng cách bên trong, bao gồm khoảng cách hai bên bằng với nội dung */
            font-weight: normal;
            /* Định dạng chữ không in đậm */
        }

        .payment-policy h2 {
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }

        .payment-policy p {
            margin: 10px 0;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>
<?php
include ("form/header.php");
?>

<body>
    <div class="container">
        <div class="payment-policy">
            <h2>1/ Thanh toán bằng tiền mặt khi nhận hàng (COD)</h2>
            <p>
                Sau khi khách hàng đặt hàng thành công trên website sẽ có email của shop gửi về email quý khách để thông
                báo lại thông tin đơn hàng quý khách vừa đặt.
                Các yêu cầu giao hàng cần có thông tin chính xác về người nhận, địa chỉ, số điện thoại.
                Quý khách vui lòng kiểm tra đúng tên và thông tin nhận hàng kèm theo gói hàng, trước khi thanh toán.
                Shop không chịu trách nhiệm phần quý khách thanh toán dư cho người giao hàng nếu có.
            </p>
            <h2>2/ Chuyển khoản qua tài khoản ngân hàng:</h2>
            <p>
                Đối với các đơn hàng chọn phương thức thanh toán bằng: Chuyển Khoản Ngân Hàng:
                Sau khi đặt hàng thành công, quý khách hàng vui lòng chuyển khoản 100% giá trị đơn hàng (bao gồm cả phí
                ship, nếu có) vào tài khoản ngân hàng dưới đây:
            </p>
            <p><strong>Ngân hàng TECHCOMBANK</strong></p>
            <p><strong>Chủ TK: CÔNG TY CỔ PHẦN XUẤT BẢN VÀ THƯƠNG MẠI HTFAT</strong></p>
            <p>Số TK: xxxxxx</p>
            <p>
                Khi chuyển khoản, quý khách vui lòng ghi lại Mã số đơn hàng được thanh toán vào phần nội dung thanh toán
                của lệnh chuyển khoản. (VD: Tên – Mã Đơn hàng)
                Sau khi chuyển khoản, trong vòng 24h, hệ thống sẽ gửi đến bạn 1 email xác nhận đơn hàng thành toán thành
                công.
                Shop chỉ tiến hành giao hàng khi đã nhận được xác nhận đơn hàng thành toán thành công.
                Nếu cần hỗ trợ thêm, vui lòng gọi đến số hotline 0909982873 để được hỗ trợ kịp thời.
            </p>
            <h2>3/ Thanh toán trực tiếp tại cửa hàng</h2>
            <p>Địa chỉ: 186 Xuân Diệu, phường Trần Phú, Tp Quy Nhơn</p>
        </div>
    </div>
    <?php
    include ("form/footer.php");
    ?>
</body>

</html>