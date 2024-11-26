<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "webbansach");

if (isset($_SESSION['taikhoan'])) {

    $truyvan_diachi = "SELECT * FROM taikhoan WHERE taikhoan = '$_SESSION[taikhoan]'";
    $thuchien_diachi = mysqli_query($conn, $truyvan_diachi);

    while ($row = mysqli_fetch_array($thuchien_diachi)) {
        $_SESSION['diachi'] = $row['diachi'];
        $_SESSION['tinh'] = $row['tinh'];
        $_SESSION['huyen'] = $row['huyen'];
        $_SESSION['xa'] = $row['xa'];
        $_SESSION['sdt'] = $row['sdt'];
    }
}

?>

<!-- session là đối tượng dùng để giám sát quá trình làm việc của user -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua ngay</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/buy.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

</head>

<body>
    <div id="container_pay">
        <div id="container_contain_info">
            <div>
                <h3>Tên shop</h3>
                <p><a href="/project/LTWEB/CKI/html/nguoidung/giohang.php">Giỏ hàng </a><i
                        class="fa-solid fa-angle-right"></i> Thông tin giao hàng</p>
                <div>
                    <h4>Thông tin giao hàng</h4>
                    <div class="icon_name_logout">
                        <div>
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div class="name_logout">
                            <?php
                            if (isset($_SESSION['taikhoan'])) {
                                if ($_SESSION['email'] == "") {
                                    $_SESSION['email'] = "(Chưa có email)";
                                }
                            } else {
                                $_SESSION['ho'] = "Tài khoản";
                                $_SESSION['ten'] = "khách";
                                $_SESSION['email'] = "";
                                $_SESSION['sdt'] = "";
                                $_SESSION['email'] = "";
                                $_SESSION['diachi'] = "";
                            }
                            ?>
                            <p><?php echo $_SESSION['ho'] . " " . $_SESSION['ten'] . " " . $_SESSION['email'] . "" ?>
                            </p>
                            <?php

                            if (!isset($_SESSION['taikhoan'])) {
                                echo "<a href='/project/LTWEB/CKI/html/login_reg/login_reg.php'>Đăng nhập</a>";
                            } else {
                                echo "<a href='/project/LTWEB/CKI/html/api.php?action=logout'>Đăng xuất</a>";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <form>
                <span id="thong_bao" style="color: red; font-size: 2.5vh; padding-left: 1%"></span>
                <select name="city" id="city">
                    <option value="" selected>Chọn tỉnh thành</option>
                </select>
                <select name="district" id="district">
                    <option value="" selected>Chọn quận huyện</option>
                </select>
                <select name="ward" id="ward">
                    <option value="" selected>Chọn phường xã</option>
                </select>
                <label for="diachicuthe">
                    <input type="text" value="<?php echo $_SESSION['diachi'] ?>" name="diachicuthe" id="diachicuthe"
                        placeholder="Địa chỉ cụ thể" required>
                </label>
                <label for="hoten">
                    <input type="text" value="<?php echo $_SESSION['ho'] . " " . $_SESSION['ten'] ?>" name="hoten"
                        id="hoten" placeholder="Họ và tên" disabled>
                </label>
                <label for="sdt">
                    <input type="number" name="sdt" value="<?php echo $_SESSION['sdt'] ?>" id="sdt"
                        placeholder="Số điện thoại" required>
                </label>
                <div class="pthuc_thanhtoan">
                    <p>Phương thức thanh toán</p>
                    <div>
                        <label for="pay1">
                            <input type="radio" name="pay" id="pay1" value="Thanh toán khi nhận hàng"
                                checked><span>Thanh toán khi nhận hàng</span>
                        </label>
                        <!-- <label for="pay2">
                            <input type="radio" name="pay" id="pay2" value="Chuyển khoản qua ngân hàng"><span>Chuyển
                                khoản qua ngân hàng</span>
                        </label> -->
                    </div>
                </div>
                <div>
                    <a href="/project/LTWEB/CKI/html/danhmuc/danhmuc.php">Tiếp tục mua sắm</a>
                    <?php if (isset($_SESSION['taikhoan'])) { ?>
                        <button id="btn_pay" type="button">Thanh toán</button>
                    <?php } ?>
                </div>
            </form>
            <div>
                <span>Powered by HTFAT</span>
            </div>
        </div>
        <div id="container_containt_product">
            <div>
                <?php
                $truyvan = "SELECT * FROM giohang";
                echo "<table style='width: 100%'>";
                echo "<tbody>";

                if (!isset($_SESSION['taikhoan'])) {
                    echo "<tr>";
                    echo "<td colspan='8'>Đăng nhập để mua ngay</td>";
                    echo "</tr>";
                } else {
                    if (isset($_GET['id'])) {
                        $truyvan = $truyvan . " WHERE id = '$_GET[id]' AND taikhoan = '$_SESSION[taikhoan]'";
                    } else {
                        $truyvan = $truyvan . " WHERE taikhoan = '$_SESSION[taikhoan]'";
                    }

                    $thuchien = mysqli_query($conn, $truyvan);

                    $tamtinh = 0;

                    if ($thuchien) {
                        while ($row = mysqli_fetch_array($thuchien)) {

                            //chỉ lấy những sản phẩm có số lượng tồn kho > 0
                            $truyvan_check = "SELECT * FROM danhsachtruyen WHERE ten = '$row[tentruyen]' AND taptruyen = '$row[taptruyen]'";
                            $thuchien_check = mysqli_query($conn, $truyvan_check);

                            if ($thuchien_check) {
                                $row_check = mysqli_fetch_array($thuchien_check);
                                if ($row_check['soluongtonkho'] > 0) {
                                    echo "<tr>";
                                    echo "<td style='width:0%;'><img class='item_img_pay' src='/project/LTWEB/CKI/$row[hinhanh]'></td>";
                                    echo "<td style='width:50%; text-align: left; font-size: 2.5vh'>" . $row['tentruyen'] . " " . $row['taptruyen'] . "</td>";
                                    echo "<td style='width:5%; text-align: center; font-size: 2.5vh'>" . $row['soluong'] . "</td>";
                                    echo "<td style='width:20%; text-align: center; font-size: 2.5vh'>" . number_format($row['gia'], 0, '', ',') . "đ</td>";
                                    echo "<td style='width:25%%; text-align: center; font-size: 2.5vh'>" . number_format(($row['soluong'] * $row['gia']), 0, '', ',') . "đ</td>";
                                    echo "</tr>";

                                    $tamtinh += $row['soluong'] * $row['gia'];
                                }

                            } else {
                                echo " " . $conn->error;
                            }
                        }
                    } else {
                        echo " " . $conn->error;
                    }
                }
                echo "</tbody>";
                echo "</table>";
                ?>
            </div>
            <div id="show_money_pay">
                <div>
                    <p>Tạm tính</p>
                    <p id="tam_tinh"></p>
                </div>
                <div>
                    <p>Phí vận chuyển</p>
                    <p id="phi_van_chuyen"></p>
                </div>
                <div>
                    <p>Tổng cộng</p>
                    <p id="tong_cong"></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Xác nhận thanh toán -->
    <div id="dialog_thanhtoan">
        <div id="form_xacnhan">
            <h4>Xác nhận thanh toán?</h4>
            <button type="button" id="xacnhan">Xác nhận</button>
            <button type="button" id="huybo">Hủy bỏ</button>
        </div>
    </div>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('tam_tinh').innerHTML = (<?php echo $tamtinh ?>).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

        $.ajax({
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            dataType: "json", // Đảm bảo jQuery xử lý dữ liệu JSON
            success: function (res) {
                var citys = res;

                var citySelect = $('#city');
                var districtsSelect = $('#district');
                var wardsSelect = $('#ward');

                //thêm các city vào select city
                citys.forEach(city => {
                    citySelect.append(new Option(city.Name, city.Id));
                });

                //nếu select city có sự thay đổi giá trị thì thêm giá trị huyện vào select dis
                citySelect.change(function () {
                    var id_city = $(this).val();
                    $('#ward').empty();

                    wardsSelect.append(new Option("Chọn phường xã", ''));

                    citys.forEach(city => {
                        if (city.Id == id_city) {
                            $('#district').empty();

                            districtsSelect.append(new Option("Chọn quận huyện", ''));

                            city.Districts.forEach(district => {
                                districtsSelect.append(new Option(district.Name, district.Id));
                            });


                            //tổng tiền ship
                            if (city.Name == "Tỉnh Bình Định") {
                                $("#phi_van_chuyen").html((15500).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                                $("#tong_cong").html((<?php echo $tamtinh ?> + 15500).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

                                tongcong = <?php echo $tamtinh ?> + 15500;
                            } else {
                                $("#phi_van_chuyen").html((21000).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                                $("#tong_cong").html((<?php echo $tamtinh ?> + 21000).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

                                tongcong = <?php echo $tamtinh ?> + 21000;
                            }
                        }
                    });
                })

                //nếu select dis có sự thay đổi giá trị thì thêm giá trị xã vào select ward
                districtsSelect.change(function () {
                    var id_dis = $(this).val();
                    citys.forEach(city => {
                        for (var j = 0; j < city.Districts.length; j++) {
                            if (city.Districts[j].Id == id_dis) {
                                $('#ward').empty();

                                wardsSelect.append(new Option("Chọn phường xã", ''));

                                city.Districts[j].Wards.forEach(ward => {
                                    wardsSelect.append(new Option(ward.Name, ward.Id));
                                });
                            }
                        }
                    })
                })

                //nếu người dùng có địa chỉ cũ thì tự động điền địa chỉ cũ
                if ("<?php echo $_SESSION['tinh'] ?>" != "") {

                    //option của tỉnh
                    var optionCity = document.querySelectorAll('#city option');

                    optionCity.forEach(city => {
                        if (city.text == "<?php echo $_SESSION['tinh'] ?>") {
                            city.selected = true; // Đánh dấu tùy chọn này là được chọn
                        }
                    })

                    //tổng tiền ship
                    if ("<?php echo $_SESSION['tinh'] ?>" == "Tỉnh Bình Định") {
                        $("#phi_van_chuyen").html((15500).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                        $("#tong_cong").html((<?php echo $tamtinh ?> + 15500).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

                        tongcong = <?php echo $tamtinh ?> + 15500;

                    } else {
                        $("#phi_van_chuyen").html((21000).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                        $("#tong_cong").html((<?php echo $tamtinh ?> + 21000).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

                        tongcong = <?php echo $tamtinh ?> + 21000;
                    }

                    //duyệt từng tỉnh
                    citys.forEach(city => {
                        //nếu có tỉnh giống với tỉnh của người dùng thì thêm dis của tỉnh đó vào select dis
                        if (city.Name == "<?php echo $_SESSION['tinh'] ?>") {
                            $('#district').empty();

                            var districtsSelect = $('#district');

                            districtsSelect.append(new Option("Chọn quận huyện", ''));

                            city.Districts.forEach(district => {
                                districtsSelect.append(new Option(district.Name, district.Id));
                            });

                            //option của huyện
                            var optionDistricts = document.querySelectorAll('#district option');

                            //duyệt từng option của huyện để kiểm tra huyện nào giống huyện của người dùng
                            optionDistricts.forEach(dis => {
                                if (dis.text == "<?php echo $_SESSION['huyen'] ?>") {
                                    dis.selected = true; // Đánh dấu tùy chọn này là được chọn
                                }
                            })
                        }

                        //duyệt từng huyện để kiểm tra huyện giống với huyện của ng dùng để thêm các xã của huyện đó vào select ward
                        for (var j = 0; j < city.Districts.length; j++) {
                            if (city.Districts[j].Name == "<?php echo $_SESSION['huyen'] ?>") {
                                $('#ward').empty();

                                var wardsSelect = $('#ward');

                                wardsSelect.append(new Option("Chọn phường xã", ''));

                                city.Districts[j].Wards.forEach(ward => {
                                    wardsSelect.append(new Option(ward.Name, ward.Id));
                                });

                                //option của xã
                                var optionWards = document.querySelectorAll('#ward option');

                                //duyệt từng option của xã để kiểm tra xã nào giống xã của người dùng
                                optionWards.forEach(war => {
                                    if (war.text == "<?php echo $_SESSION['xa'] ?>") {
                                        war.selected = true // Đánh dấu tùy chọn này là được chọn
                                    }
                                })
                            }
                        }
                    });
                }
            },
        })
    })

    var btn_pay = document.getElementById('btn_pay');
    var dialog_thanhtoan = document.getElementById('dialog_thanhtoan');
    var form_xacnhan = document.getElementById('form_xacnhan');

    var huybo = document.getElementById('huybo');
    var xacnhan = document.getElementById('xacnhan');

    huybo.addEventListener('click', function () {
        dialog_thanhtoan.classList.remove('show');
        showScrollDocument();
    })

    dialog_thanhtoan.addEventListener('click', function () {
        dialog_thanhtoan.classList.remove('show');
        showScrollDocument();
    })

    form_xacnhan.addEventListener('click', function (e) {
        e.stopPropagation();
    })

    function hiddenScrollDocument() {
        document.body.style.overflow = "hidden";
    }

    function showScrollDocument() {
        document.body.style.overflow = "auto";
    }

    btn_pay.addEventListener('click', function () {

        var tongcong = 0;

        var diachicuthe = document.getElementById('diachicuthe').value;
        var sdt = document.getElementById('sdt').value;

        // Lấy văn bản của tùy chọn được chọn
        var selectedText_City = $("#city").find('option:selected').text();

        var selectedText_Districts = $("#district").find('option:selected').text();

        var selectedText_Ward = $("#ward").find('option:selected').text();

        var radios = document.querySelectorAll('input[name="pay"]');

        var radioValue = "";

        for (const radio of radios) {
            if (radio.checked) {
                radioValue = radio.value;
            }
        }

        if (selectedText_City == "Tỉnh Bình Định") {
            tongcong = (<?php echo $tamtinh ?> + 15500);
        } else {
            tongcong = (<?php echo $tamtinh ?> + 21000);
        }

        if (diachicuthe && sdt && selectedText_City != "Chọn quận huyện" && selectedText_Districts != "Chọn quận huyện" && selectedText_Ward != "Chọn phường xã") {
            $("#thong_bao").html("");

            dialog_thanhtoan.classList.add('show');

            hiddenScrollDocument();

            xacnhan.addEventListener('click', function () {
                dialog_thanhtoan.classList.remove('show');
                showScrollDocument();

                var url = new URL(window.location.href); // hoặc một URL cụ thể

                //tạo một đối tượng URLSearchParams từ chuỗi truy vấn của một đối tượng URL
                //Chuỗi truy vấn là phần của URL bắt đầu sau dấu hỏi chấm (?) và chứa các tham số.
                //.search của đối tượng URL hoặc location luôn đại diện cho phần chuỗi truy vấn của URL
                var params = new URLSearchParams(url.search);

                var id = params.get('id'); // Lấy giá trị của tham số 'id'

                $.ajax({
                    url: '/project/LTWEB/CKI/html/api.php?action=thanhtoan',
                    method: 'post',
                    data: {
                        selectedText_City: selectedText_City,
                        selectedText_Districts: selectedText_Districts,
                        selectedText_Ward: selectedText_Ward,
                        diachicuthe: diachicuthe,
                        sdt: sdt,
                        radioValue: radioValue,
                        tongcong: tongcong,
                        id_thanhtoan: id,
                    },
                    success: function (res) {
                        if (confirm(res)) {
                            window.location.href = "/project/LTWEB/CKI/html/trangchu.php";
                        }
                    }
                })
            })
        } else {
            $("#thong_bao").html("Vui lòng nhập đầy đủ thông tin");
        }
    })

</script>

</html>