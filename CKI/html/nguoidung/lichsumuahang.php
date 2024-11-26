<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "webbansach");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>

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
        #container_his {
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 1% 0;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            margin: .5% 0;
        }

        #container_his>div {
            width: 80%;
        }

        table {
            width: 100%;
            height: auto;
            border: 1px solid black;
            border-collapse: collapse;
        }

        tr {
            text-align: center;
        }

        thead tr {
            background-color: rgb(215, 215, 215);
        }

        thead tr td {
            font-weight: bold;
            text-transform: capitalize;
        }

        td {
            padding: 1% 0;
        }

        td a {
            text-decoration: none;
            color: black;
            transition: .1s ease;
        }

        td a:hover {
            color: red;
        }

        td button {
            cursor: pointer;
            background-color: transparent;
            font-size: 2.5vh;
            padding: .5% 2%;
            border: 1px solid black;
            border-radius: 7px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>

    <!-- Body -->
    <div id="container_his">
        <div>
            <h2>Lịch sử mua hàng</h2>
            <table>
                <thead>
                    <tr>
                        <td>Mã hóa đơn</td>
                        <td>Thành tiền</td>
                        <td>Ngày mua</td>
                        <td>Tình trạng</td>
                        <td>Chức năng</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $truyvan = "SELECT * FROM doanhthu WHERE taikhoan = '$_SESSION[taikhoan]' ORDER BY ngaymua DESC";
                    $thuchien = mysqli_query($conn, $truyvan);
                    if ($thuchien) {
                        if (mysqli_num_rows($thuchien) > 0) {
                            while ($row = mysqli_fetch_array($thuchien)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['mahoadon'] ?></td>
                                    <td><?php echo number_format($row['thanhtien'], 0, '', '.') . "<u>đ</u>" ?></td>
                                    <td><?php echo $row['ngaymua'] ?></td>

                                    <?php
                                    if ($row['danhan'] == 2) {
                                        echo "<td style='color:green'>Thành công</td>";
                                    } else if ($row['danhan'] == 3) {
                                        echo "<td style='color:red'>Thất bại</td>";
                                    } else if ($row['danhan'] == 1) {
                                        ?>
                                                <td>
                                                    <a
                                                        href="/project/LTWEB/CKI/html/api.php?action=xacnhan&hdong=xacnhan&mahoadon=<?php echo $row['mahoadon'] ?>">Đã
                                                        nhận được hàng</a>
                                                    |
                                                    <a
                                                        href="/project/LTWEB/CKI/html/api.php?action=xacnhan&hdong=chuanh&mahoadon=<?php echo $row['mahoadon'] ?>">Chưa
                                                        nhận hàng</a>
                                                </td>
                                        <?php
                                    } else if ($row['danhan'] == 0 && $row['trangthai'] == 0) {
                                        ?>
                                                    <td>Đang chờ duyệt | <button class="btn_huydon" data-id="<?php echo $row['mahoadon'] ?>">Hủy
                                                            đơn</b></td>
                                        <?php
                                    } else if ($row['danhan'] == 0 && $row['trangthai'] == 2) {
                                        ?>
                                                        <td style="color:red">Đơn bị hủy</td>
                                        <?php
                                    }
                                    ?>
                                    <?php

                                    $truyvan_getinfo = "SELECT * FROM chitiethoadon WHERE mahoadon = '$row[mahoadon]'";
                                    $thuchien_getinfo = mysqli_query($conn, $truyvan_getinfo);

                                    if ($thuchien_getinfo) {
                                        while ($row_getinfo = mysqli_fetch_array($thuchien_getinfo)) {

                                            $truyvan_mualai = "SELECT * FROM danhsachtruyen WHERE ten = '$row_getinfo[tentruyen]' AND taptruyen = '$row_getinfo[taptruyen]'";
                                            $thuchien_mualai = mysqli_query($conn, $truyvan_mualai);
                                            if ($thuchien_mualai) {
                                                if (mysqli_num_rows($thuchien_mualai) > 0) {
                                                    while ($row_mualai = mysqli_fetch_array($thuchien_mualai)) {
                                                        ?>
                                                        <td><a
                                                                href="/project/LTWEB/CKI/html/doanhthu/xemchitiet.php?mahoadon=<?php echo $row['mahoadon'] ?>">Chi
                                                                tiết</a>
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            ?>
                            <?php
                        } else {
                            ?>
                            <td colspan='8'>Bạn chưa mua sản phẩm tại cửa hàng</td>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include ("../form/footer.php");
    ?>
</body>

<script>
    var btn_huydon = document.querySelectorAll('.btn_huydon');

    btn_huydon.forEach(btn => {
        btn.addEventListener('click', function () {
            if (confirm("Bạn muốn hủy đơn?")) {
                var mahd = this.getAttribute('data-id');

                $.ajax({
                    url: '/project/LTWEB/CKI/html/api.php?action=user_huydon',
                    method: 'post',
                    data: { mahd_user: mahd },
                    success: function (res) {
                        if (confirm(res) || !confirm(res)) {
                            window.location.reload();
                        }
                    }
                })
            }
        })
    })

</script>

</html>