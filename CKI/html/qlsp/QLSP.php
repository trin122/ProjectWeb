<?php
session_start();
include 'ketnoi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <style>
        * {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            /* border: 2px solid #000000; */
            /* Khung màu cho phần Quản lý Truyện */
        }

        h2 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #000000;
            /* Khung màu dưới tiêu đề */
            padding-bottom: 10px;
        }

        #add-button,
        #add-button-theloai {
            display: block;
            width: 200px;
            margin: 20px auto;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #add-button:hover,
        #add-button-theloai:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: rgb(215, 215, 215);
        }

        td img {
            width: 50px;
            height: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 1%;
            padding-left: 25%;
        }

        .modal-content {
            background-color: #fff;
            /* margin: 5% auto; */
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="file"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #218838;
        }

        .action-buttons a,
        .action-buttons form {
            display: inline-block;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 5px 0px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .action-buttons input[type="submit"]:hover,
        .action-buttons a:hover {
            background-color: #c82333;
        }

        form input {
            outline: none;
        }

        #modal_themtheloai {
            display: none;
            position: fixed;
            top: 0%;
            left: 0%;
            padding: 10% 35% 0 35%;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        #modal_themtheloai>div {
            width: 30%;
            height: auto;
            padding: 1%;
            border-radius: 7px;
            background-color: whitesmoke;
        }

        .container_button {
            margin-top: 2%;
            display: flex;
            justify-content: space-around;
        }

        .container_button button {
            cursor: pointer;
            padding: 1% 4%;
            font-weight: bold;
            font-size: 2.5vh;
            border-radius: 7px;
            border: none;
            color: white;
            background-color: #218838;
        }

        .container_button button:last-child {
            background-color: red;
        }

        .action-buttons a {
            color: white;
            background-color: #007bff;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 3%;
            padding: 5px 0px;
            width: 100%;
            border-radius: 5px;
        }

        #pag {
            display: flex;
            justify-content: center;
            margin-top: 2%;
        }

        #pag a {
            margin: 0 1px;
            padding: .5% .9%;
            border-radius: 50%;
            border: none;
            text-decoration: none;
            background-color: whitesmoke;
            color: black;
            font-size: 2.5vh;
        }

        .choose {
            background-color: #007bff !important;
            color: white !important;
        }

        #form_timkiem input {
            outline: none;
            padding-left: 1%;
            height: 1.5pc;
            border-radius: 5px;
            border: 1px solid black;
        }

        #form_timkiem label {
            font-size: .9pc;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>
    <script src="/project/LTWEB/CKI/js/header.js"></script>

    <script>
        function showModal() {
            document.getElementById('myModal').style.display = "block";
            hiddenScroll();
        }
        function closeModal() {
            document.getElementById('myModal').style.display = "none";
            showScroll();
        }

        function showModalTheLoai() {
            document.getElementById('modal_themtheloai').style.display = "block";
            hiddenScroll();
        }
        function closeModalTheLoai() {
            document.getElementById('modal_themtheloai').style.display = "none";
            showScroll();
        }

        function hiddenScroll() {
            document.body.style.overflow = "hidden";
            document.body.style.paddingRight = "1%";
        }
        function showScroll() {
            document.body.style.overflow = "auto";
            document.body.style.paddingRight = "0%";
        }
    </script>
</head>

<body>

    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>

    <div class="container">
        <h2>Quản lý sản phẩm</h2>

        <!-- Nút thêm để hiển thị form -->
        <div style="display: flex">
            <button id="add-button" onclick="showModal()">Thêm Sản Phẩm</button>
            <button id="add-button-theloai" onclick="showModalTheLoai()">Thêm Thể Loại</button>
        </div>

        <!-- Modal thêm thể loại -->
        <div id="modal_themtheloai">
            <div>
                <span class="close" onclick="closeModalTheLoai()">&times;</span>
                <form id="form_add_xoa_theloai">
                    <div class="form-group">
                        <label for="theloaimoi">Thể loại mới:</label>
                        <input type="text" id="theloaimoi" name="theloaimoi">
                        <div class="container_button">
                            <button type="button" id="btn_them_theloai">Thêm</button>
                            <button type="button" id="btn_xoa_theloai">Xóa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form id="addForm" action="them.php" method="post">
                    <div class="form-group">
                        <label for="ten">Tên:</label>
                        <input type="text" id="ten" name="ten" required>
                    </div>
                    <div class="form-group">
                        <label for="taptruyen">Tập truyện:</label>
                        <input type="text" id="taptruyen" name="taptruyen" required>
                    </div>
                    <div class="form-group">
                        <label for="hinhanh">Hình ảnh:</label>
                        <input type="file" id="hinhanh" name="hinhanh" required>

                    </div>
                    <div class="form-group">
                        <label for="theloai">Thể loại:</label>
                        <select id="theloai" name="theloai" required>
                            <?php
                            $truyvan = "SELECT * FROM theloai";
                            $thuchien = mysqli_query($conn, $truyvan);
                            while ($row = mysqli_fetch_array($thuchien)) {
                                ?>
                                <option value="<?php echo $row['theloai'] ?>"><?php echo $row['theloai'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gia">Giá:</label>
                        <input type="text" id="gia" name="gia" required>
                    </div>

                    <?php
                    $now = date("Y-m-d");
                    ?>

                    <div class="form-group">
                        <label for="ngay">Ngày:</label>
                        <input type="text" id="ngay" name="ngay" value="<?php echo $now ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="soluongtonkho">Số lượng tồn kho:</label>
                        <input type="text" id="soluongtonkho" name="soluongtonkho">
                    </div>
                    <div class="form-group">
                        <label for="tentacgia">Tên tác giả</label>
                        <input type="text" id="tentacgia" name="tentacgia">
                    </div>
                    <div class="form-group">
                        <label for="dichgia">Dịch giả</label>
                        <input type="text" id="dichgia" name="dichgia">
                    </div>
                    <div class="form-group">
                        <label for="hoasi">Họa sĩ</label>
                        <input type="text" id="hoasi" name="hoasi">
                    </div>
                    <div class="form-group">
                        <label for="xuatxu">Xuất xứ</label>
                        <input type="text" id="xuatxu" name="xuatxu">
                    </div>
                    <div class="form-group">
                        <label for="series">Series</label>
                        <input type="text" id="series" name="series">
                    </div>
                    <div class="form-group">
                        <label for="mota">Mô tả:</label>
                        <input type="text" id="mota" name="mota" required>
                    </div>
                    <input type="submit" value="Thêm Truyện">
                </form>
            </div>
        </div>

        <!-- form tìm kiếm -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form_timkiem">
            <label for="timkiem">Tìm kiếm
                <input type="text" name="timkiem" value="<?php echo isset($_GET['timkiem']) ? $_GET['timkiem'] : '' ?>"
                    placeholder="Từ khóa tìm kiếm..." id="timkiem">
            </label>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Tên truyện</th>
                    <th>Tập truyện</th>
                    <th>Hình ảnh</th>
                    <th>Thể loại</th>
                    <th>Giá</th>
                    <th>Ngày thêm</th>
                    <th>Tồn kho</th>
                    <th>Đã bán</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = isset($_GET['stt']) ? $_GET['stt'] : 1;

                if (isset($_GET['timkiem']) && !empty($_GET['timkiem'])) {
                    $timkiem = $_GET['timkiem'];
                    $sql = "SELECT * FROM danhsachtruyen WHERE ten like '%$timkiem%' OR taptruyen like '%$timkiem%' OR theloai like '%$timkiem%'";
                } else {
                    $pageChoose = isset($_GET['pageChoose']) ? $_GET['pageChoose'] : 1;

                    $max_show = 10;

                    $truyvan = "SELECT * FROM danhsachtruyen";
                    $thuchien = mysqli_query($conn, $truyvan);

                    $quantity = mysqli_num_rows($thuchien);

                    $page = ceil($quantity / $max_show);

                    $start = ($pageChoose - 1) * $max_show;

                    $sql = "SELECT * FROM danhsachtruyen ORDER BY ngay DESC LIMIT $start,$max_show";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td style='width:5%'>$stt</td>
                        <td style='width:15%'>" . $row['ten'] . "</td>
                        <td style='width:15%'>" . $row['taptruyen'] . "</td>
                        <td style='width:5%'><img src='/project/LTWEB/CKI/" . $row['hinhanh'] . "' alt='" . $row['ten'] . "'></td>
                        <td style='width:5%'>" . $row['theloai'] . "</td>
                        <td style='width:5%'>" . number_format($row['gia'], 0, '', '.') . "<u>đ</u></td>
                        <td style='width:10%'>" . $row['ngay'] . "</td>
                        <td style='width:7%'>" . $row['soluongtonkho'] . "</td>
                        <td style='width:7%'>" . $row['soluongdaban'] . "</td>
                        <td style='width:7%' class='action-buttons'>
                            <a class='btn_sua' href='sua.php?id=" . $row['id'] . "'>Sửa</a>
                            <form action='xoa.php' method='post'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <input type='submit' value='Xóa'>
                            </form>
                        </td>
                      </tr>";
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='10'>Không có truyện nào</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <div id="pag">
            <?php
            if (!isset($_GET['timkiem']) || empty($_GET['timkiem'])) {
                //phân trang
                echo "<a href='QLSP.php?pageChoose=1&stt=1'>First</a>";
                if ($pageChoose > 1) {
                    $pre = $pageChoose - 1;
                    echo "<a href='QLSP.php?pageChoose=$pre'><i class='fa-solid fa-angles-left'></i></a>";
                }
                if ($page > 3) {
                    $page_start = $pageChoose - 1;
                    if ($page_start < 1) {
                        $page_start = 1;
                    }
                    if ($pageChoose < 2) {
                        $page_end = $pageChoose + 2;
                    } else {
                        $page_end = $pageChoose + 1;
                    }
                    if ($page_end > $page) {
                        $page_end = $page;
                        $page_start = $pageChoose - 2;
                    }

                    for ($i = $page_start; $i <= $page_end; $i++) {
                        $stt_start = ($i * 10) - 9;
                        $class = ($i == $pageChoose) ? 'choose' : '';
                        echo "<a class='$class' href='QLSP.php?pageChoose=$i&stt=$stt_start'>$i</a>";
                    }
                } else {
                    for ($i = 1; $i <= $page; $i++) {
                        $stt_start = ($i * 10) - 9;
                        $class = ($i == $pageChoose) ? 'choose' : '';
                        echo "<a class='$class' href='QLSP.php?pageChoose=$i&stt=$stt_start'>$i</a>";
                    }
                }
                if ($pageChoose < $page) {
                    $nex = $pageChoose + 1;
                    echo "<a href='QLSP.php?pageChoose=$nex'><i class='fa-solid fa-angles-right'></i></a>";
                }
                $stt_start_la = $quantity - 2;
                echo "<a href='QLSP.php?pageChoose=$page&stt=$stt_start_la'>Last</a>";
            }
            ?>
        </div>
    </div>
    <!-- Footer -->
    <?php
    include ("../form/footer.php");
    ?>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        //ngăn chặn sự kiện submit mặc định của form thêm thể loại
        var form_add_xoa_theloai = document.getElementById('form_add_xoa_theloai');
        form_add_xoa_theloai.addEventListener('submit', function (e) {
            e.preventDefault();
        })

        var theloaimoi = document.getElementById('theloaimoi');

        //thêm thể loại
        var btn_them_theloai = document.getElementById('btn_them_theloai');
        btn_them_theloai.addEventListener('click', function () {

            if (!theloaimoi.value) {
                alert("Vui lòng nhập thể loại");
            } else {
                $.ajax({
                    url: '/project/LTWEB/CKI/html/api.php?action=theloai',
                    method: 'post',
                    data: { tentheloai: theloaimoi.value, hdong: "them" },
                    success: function (res) {
                        if (confirm(res) || !confirm(res)) {
                            theloaimoi.value = '';
                            closeModalTheLoai();
                        }
                    }
                })
            }
        })

        var btn_xoa_theloai = document.getElementById('btn_xoa_theloai');
        btn_xoa_theloai.addEventListener('click', function () {

            if (!theloaimoi.value) {
                alert("Vui lòng nhập thể loại");
            } else {
                $.ajax({
                    url: '/project/LTWEB/CKI/html/api.php?action=theloai',
                    method: 'post',
                    data: { tentheloai: theloaimoi.value, hdong: "xoa" },
                    success: function (res) {
                        if (confirm(res) || !confirm(res)) {
                            theloaimoi.value = '';
                            closeModalTheLoai();
                        }
                    }
                })
            }
        })

        var hinhanh = document.getElementById('hinhanh');

        hinhanh.addEventListener('input', function () {
            var file = this.files[0];

            //1MB = 1024 KB, 1KB = 1024 byte
            //1024: số byte  trong một kilobyte
            //1024 x 1024: số byte trong một megabyte
            var maxSize = 5 * 1024 * 1024; // 5MB

            var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'];

            //file.type là thuộc tính của đối tượng File đại diện cho loại MIME của tệp. 
            //Loại MIME (Multipurpose Internet Mail Extensions) là một tiêu chuẩn để mô tả kiểu dữ liệu của tệp.
            if (file) {
                if (!allowedTypes.includes(file.type)) {
                    confirm("Hãy chọn file hình ảnh");
                    this.value = '';
                } else {
                    if (file && file.size > maxSize) {
                        confirm("File phải nhỏ hơn 5MB");
                        this.value = '';
                    }
                }
            }
        })

        var url = new URL(window.location.href); // hoặc một URL cụ thể

        var params = new URLSearchParams(url.search);

        var tbao = params.get('tbao'); // Lấy giá trị của tham số 'tbao'

        if (tbao != null) {
            if (tbao == "them_ok") {
                confirm("Thêm sản phẩm thành công");
            } else if (tbao == "them_ko") {
                confirm("Thêm sản phẩm không thành công");
            } else if (tbao == "them_kpa") {
                confirm("Thêm sản phẩm thất bại. File upload không phải là ảnh");
            } else if (tbao == "sua_ok") {
                confirm("Sửa sản phẩm thành công");
            } else if (tbao == "sua_ko") {
                confirm("Sửa sản phẩm không thành công");
            } else if (tbao == "xoa_ok") {
                confirm("Xóa sản phẩm thành công");
            } else if (tbao == "xoa_ko") {
                confirm("Xóa sản phẩm không thành công");
            } else if (tbao == "xoa_ktxa") {
                confirm("Xóa sản phẩm thành công. Không thể xóa ảnh");
            } else if (tbao == "xoa_aktt") {
                confirm("Xóa sản phẩm thành công. Ảnh không tồn tại");
            }

            // Thay đổi URL mà không làm mới trang
            history.pushState({}, '', '/project/LTWEB/CKI/html/qlsp/QLSP.php');
        }
    })
</script>

</html>