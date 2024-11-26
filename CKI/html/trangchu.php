<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/doanhthu.css">

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
    <div id="container_img">
        <img src="../img/logo/anhnen_trangchu.jpg" alt="">
    </div>

    <div id="container_introduce">
        <div>
            <div>
                <p><i class="fa fa-book"></i></p>
                <p>Những bản manga mới nhất</p>
                <p>3000+</p>
            </div>
        </div>
        <div>
            <div>
                <p><i class="fa fa-user"></i></p>
                <p>Khách hàng thân thiết</p>
                <p>999+</p>
            </div>
        </div>
        <div>
            <div>
                <p><i class="fa fa-heart"></i></p>
                <p>Thế giới truyện tranh</p>
                <p>300+</p>
            </div>
        </div>
    </div>

    <div class="container_newbook">
        <div>
            <h2>Mới nhất trong tuần</h2>
            <img src="../img/logo/header_title.png" alt="">
            <p><i>Cùng tìm hiểu truyện mới nhất của chúng tôi</i></p>
        </div>

        <!-- Hiển thị dữ liệu ảnh đăng mới nhất -->
        <div id="books"></div>
    </div>

    <div class="container_newbook">
        <div>
            <h2>Sắp phát hành</h2>
            <img src="../img/logo/header_title.png" alt="">
            <p><i>Truyện dự kiến được phát hành trong thời gian tới</i></p>
        </div>

        <!-- Hiển thị dữ liệu ảnh săp phát hàng -->
        <div id="books_sph"></div>
    </div>

    <!-- Số lượng member, product -->
    <div class="container_img_members_books">
        <img src="http://file.hstatic.net/1000266609/file/bgparallax-04.jpg" alt="">
        <div class="container_members_books">
            <div class="container_members">
                <div>
                    <i class="fa fa-user"></i>
                </div>
                <div>
                    <div>
                        <p>Thành Viên</p>
                    </div>
                    <div>
                        <p id="tvien">
                            0
                        </p>
                    </div>
                </div>
            </div>
            <div class="container_quantity_books">
                <div>
                    <i class="fa fa-book"></i>
                </div>
                <div>
                    <div>
                        <p>Sản Phẩm</p>
                    </div>
                    <div>
                        <p id="spham">
                            0
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Đối tác vận chuyển -->
    <div class="container_dtvc">
        <div>
            <h2>Đối tác vận chuyển</h2>
            <img src="../img/logo/header_title.png" alt="">
            <div class="intro_dtvc">
                <div>
                    <div class="intro_img_dtvc"><img src="../img/logo/logo_vnp.webp" alt=""></div>
                    <div class="content_dtvc">
                        <p>Giao hàng đến 63 tỉnh thành trên toàn quốc. Đối tác vận chuyển chính của shop Tổng công ty
                            Bưu điện Việt Nam được hình thành trên cơ sở triển khai Đề án thí điểm hình thành Tập đoàn
                            Bưu chính Viễn thông Việt Nam (Tập đoàn VNPT) do Thủ tướng Chính phủ phê duyệt tại Quyết
                            định số 58/2005/QĐ-TTg ngày 23/3/2005.</p>
                        <span>VNPOST</span>
                    </div>
                </div>
                <div>
                    <div class="intro_img_dtvc"><img src="../img/logo/logo_grab.webp" alt=""></div>
                    <div class="content_dtvc">
                        <p>Giao hàng trong ngày tại Tp Quy Nhơn. Đối tác vận chuyển tin cậy của shop. Công ty TNHH
                            Grab. Địa chỉ: Thành phố Quy Nhơn, Việt Nam.</p>
                        <span>GRAB</span>
                    </div>
                </div>
                <div>
                    <div class="intro_img_dtvc"><img src="../img/logo/logo_ghn.webp" alt=""></div>
                    <div class="content_dtvc">
                        <p>Công ty giao nhận đầu tiên tại Việt Nam được thành lập với sứ mệnh phục vụ nhu cầu vận chuyển
                            chuyên nghiệp của các đối tác Thương mại điện tử trên toàn quốc.</p>
                        <span>GIAO HÀNG NHANH</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Châm ngôn -->
    <div class="container_maxim">
        <div>
            <i class="fa fa-rocket"></i>
            <h4>GIAO HÀNG TẬN NƠI</h4>
            <p>Dù Bạn Ở Bất Cứ Nơi Đâu</p>
        </div>
        <div>
            <i class="fa fa-tag"></i>
            <h4>PHỤC VỤ TẬN TÌNH</h4>
            <p>Niềm Vui Của Bạn Là Hạnh Phúc Của Chúng Tôi</p>
        </div>
        <div>
            <i class="fa-brands fa-envira"></i>
            <h4>SẢN PHẨM CHẤT LƯỢNG</h4>
            <p>Hàng Hóa Chính Hãng 100%</p>
        </div>
        <div>
            <i class="fa fa-heart"></i>
            <h4>BÁN HÀNG VÌ ĐAM MÊ</h4>
            <p>Bán Hàng Bằng Cả Trái Tim</p>
        </div>
    </div>

    <!-- Các nhà xuất bản -->
    <div class="container_slide">
        <div class="image">
            <img src="../img/logo/amak.webp" alt="">
        </div>
        <div class="image">
            <img src="../img/logo/hikari.webp" alt="">
        </div>
        <div class="image">
            <img src="../img/logo/kimdong.webp" alt="">
        </div>
        <div class="image">
            <img src="../img/logo/nhanam.webp" alt="">
        </div>
        <div class="image">
            <img src="../img/logo/nxbtre.webp" alt="">
        </div>
    </div>

    <!-- Footer -->
    <?php
    include ("form/footer.php");
    ?>
</body>

</html>