<?php
session_start();
include_once ('connect.php');

// Xử lý thêm vào giỏ hàng
if (isset($_GET['id']) && !isset($_GET['action'])) {
    $id = $_GET['id'];
    // $ten = $_POST['ten'];
    // $gia = $_POST['gia'];
    $soluong = 1;
    $taikhoan = $_SESSION['taikhoan'];
    // $thanhtien = $gia * $soluong;
    //Đặt múi giờ là 'Asia/Ho_Chi_Minh' cho Việt Nam
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    //ngày hiện tại
    $ngaythem = date('Y-m-d H:i:s');

    //lấy sp theo id trong bảng danhsachtruyen
    $sql_getproduct = "SELECT * FROM danhsachtruyen WHERE id = '$id'";
    $thuchien_getporduct = mysqli_query($conn, $sql_getproduct);

    if ($thuchien_getporduct) {
        while ($row_getproduct = mysqli_fetch_array($thuchien_getporduct)) {

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $sql_check = "SELECT * FROM giohang WHERE taikhoan = ? AND tentruyen = ? AND taptruyen = ?";
            $stmt_check = mysqli_prepare($conn, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "sss", $taikhoan, $row_getproduct['ten'], $row_getproduct['taptruyen']);
            mysqli_stmt_execute($stmt_check);
            $result_check = mysqli_stmt_get_result($stmt_check);

            if (mysqli_num_rows($result_check) > 0) {
                // Nếu sản phẩm đã tồn tại, cập nhật số lượng
                $sql_update = "UPDATE giohang SET soluong = soluong + ?, thanhtien = (gia * soluong) WHERE taikhoan = ? AND tentruyen = ? AND taptruyen = ?";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "isss", $soluong, $taikhoan, $row_getproduct['ten'], $row_getproduct['taptruyen']);
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
                $sql_insert = "INSERT INTO giohang (taikhoan, hinhanh , tentruyen, taptruyen, soluong, gia, thanhtien, ngaythem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $sql_insert);
                mysqli_stmt_bind_param($stmt_insert, "ssssiiis", $taikhoan, $row_getproduct['hinhanh'], $row_getproduct['ten'], $row_getproduct['taptruyen'], $soluong, $row_getproduct['gia'], $row_getproduct['gia'], $ngaythem);
                mysqli_stmt_execute($stmt_insert);
                mysqli_stmt_close($stmt_insert);
            }
        }
    } else {
        echo " " . $conn->error;
    }

    header('Location: /project/LTWEB/CKI/html/nguoidung/giohang.php');
    exit();
}

// Xử lý cập nhật giỏ hàng
if (isset($_POST['soluong'])) {
    foreach ($_POST['soluong'] as $id => $soluong) {
        $soluong = intval($soluong);

        if ($soluong <= 0) {
            continue;
        }

        // Cập nhật số lượng trong giỏ hàng
        $sql_update = "UPDATE giohang SET soluong = ?, thanhtien = gia * ? WHERE taikhoan = ? AND id = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "iisi", $soluong, $soluong, $_SESSION['taikhoan'], $id);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);
    }

    header('Location: giohang.php');
    exit();
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql_delete = "DELETE FROM giohang WHERE id = ? AND taikhoan = ?";
        $stmt_delete = mysqli_prepare($conn, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "is", $id, $_SESSION['taikhoan']);
        mysqli_stmt_execute($stmt_delete);
        mysqli_stmt_close($stmt_delete);
    }

    header('Location: giohang.php');
    exit();
}

// Lấy thông tin giỏ hàng
$taikhoan = isset($_SESSION['taikhoan']) ? $_SESSION['taikhoan'] : '';
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Lấy danh sách các truyện trong giỏ hàng với tìm kiếm
$sql = "SELECT * FROM giohang WHERE taikhoan = ? AND (tentruyen LIKE ? OR taptruyen LIKE ?)";
$stmt = mysqli_prepare($conn, $sql);
$search_param = "%$search%";
mysqli_stmt_bind_param($stmt, "sss", $taikhoan, $search_param, $search_param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Tính tổng thành tiền
$totalAmount = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>
    <script src="/project/LTWEB/CKI/js/header.js"></script>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        .cart-image {
            width: 50px;
            /* Kích thước của hình ảnh */
            height: auto;
        }

        .chucnang a {
            color: black;
            text-decoration: none;
            padding: 1%;
            transition: .1s ease;
        }

        .chucnang a:hover {
            color: red;
        }

        #form_giohang {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 2%;
        }

        thead tr {
            background-color: rgb(215, 215, 215);
        }

        #form_search {
            padding: 1% 0 1% 2.5%;
            width: 97.5%;
        }

        #form_search h2 {
            text-align: center;
            text-transform: uppercase;
        }

        #form_search form>input {
            outline: none;
            border: 1px solid black;
            border-top-left-radius: 7px;
            border-bottom-left-radius: 7px;
            padding: .5%;
            border-right: none;
        }

        #form_search form>button {
            cursor: pointer;
            position: absolute;
            border: none;
            padding: .5%;
            border: 1px solid black;
            border-left: none;
            font-weight: bold;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
        }

        #form_show_update_total {
            margin-top: 1%;
            width: 95%;
            display: flex;
            justify-content: space-between;
        }

        #form_show_update_total>input {
            cursor: pointer;
            padding: .3% .5%;
            text-transform: uppercase;
        }

        ul {
            padding: 1% 2.5%;
        }

        ul li {
            list-style: none;
            padding: .25% 0;
        }

        ul li a {
            text-decoration: none;
            color: black;
            transition: .1s ease;
        }

        ul li a:hover {
            color: red;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include ("../form/header.php"); ?>

    <!-- Body -->

    <!-- Context -->
    <div id="form_search">
        <h2>Giỏ hàng của bạn</h2>
        <form action="" method="post">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                placeholder="Tìm kiếm theo tên truyện" />
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    <ul>
        <li>
            <a href="/project/LTWEB/CKI/html/trangchu.php">Tiếp tục mua sắm</a> | <a
                href="/project/LTWEB/CKI/html/danhmuc/buy.php">Thanh toán tất cả</a>
        </li>
    </ul>
    <form action="giohang.php" method="post" id="form_giohang">
        <table>
            <thead>
                <tr>
                    <th style="text-align: center">Hình ảnh</th>
                    <th style="text-align: center">Tên truyện</th>
                    <th style="text-align: center">Tập truyện</th>
                    <th style="text-align: center">Số lượng</th>
                    <th style="text-align: center">Giá</th>
                    <th style="text-align: center">Thành tiền</th>
                    <th style="text-align: center">Ngày thêm</th>
                    <th style="text-align: center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_SESSION['taikhoan'])) {
                    echo "<tr><td colspan='8'>Đăng nhập để xem giỏ hàng</td></tr>";
                } else
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row["id"];
                            $tentruyen = $row["tentruyen"];
                            $taptruyen = $row["taptruyen"];
                            $soluong = $row["soluong"];
                            $gia = $row["gia"];
                            $amount = $gia * $soluong;
                            $totalAmount += $amount; // Cộng dồn thành tiền
                
                            // Lấy hình ảnh của truyện từ bảng danh sách truyện
                            // $sql_image = "SELECT hinhanh FROM danhsachtruyen WHERE id = ?";
                            // $stmt_image = mysqli_prepare($conn, $sql_image);
                            // mysqli_stmt_bind_param($stmt_image, "s", $id);
                            // mysqli_stmt_execute($stmt_image);
                            // $result_image = mysqli_stmt_get_result($stmt_image);
                            // $image_row = mysqli_fetch_assoc($result_image);
                            // $hinhanh = $image_row ? $image_row['hinhanh'] : 'default_image.jpg';
                
                            echo "<tr>";
                            echo "<td><img src='/project/LTWEB/CKI/" . htmlspecialchars($row["hinhanh"]) . "' class='cart-image' alt='Hình ảnh truyện' /></td>";
                            echo "<td style='width: 30%; text-align: center'>" . htmlspecialchars($tentruyen) . "</td>";
                            echo "<td style='width: 30%; text-align: center'>" . htmlspecialchars($taptruyen) . "</td>";
                            echo "<td style='text-align: center'><input style='text-align: center' type='number' name='soluong[" . htmlspecialchars($row["id"]) . "]' value='" . htmlspecialchars($soluong) . "' min='1' /></td>";
                            echo "<td style='width: 10%; text-align: center'>" . number_format(htmlspecialchars($gia), 0, '', ',') . "đ</td>";
                            echo "<td style='width: 10%; text-align: center'>" . number_format(htmlspecialchars($amount), 0, '', ',') . "đ</td>";
                            echo "<td style='width: 20%; text-align: center'>" . htmlspecialchars($row["ngaythem"]) . "</td>";

                            //nếu số lượng trong giỏ hàng lớn hơn số lượng tồn kho thì không thể mua và ngược lại
                            $truyvan_sltk = "SELECT * FROM danhsachtruyen WHERE ten = '$tentruyen' AND taptruyen = '$taptruyen'";
                            $thuchien_sltk = mysqli_query($conn, $truyvan_sltk);

                            if ($thuchien_sltk) {
                                $row_sltk = mysqli_fetch_array($thuchien_sltk);
                                if ($row_sltk['soluongtonkho'] < $soluong) {
                                    if ($row_sltk['soluongtonkho'] > 0) {
                                        echo "<td class='chucnang' style='text-align: center; text-wrap: nowrap'><a href='/project/LTWEB/CKI/html/danhmuc/chitietsanpham.php?id=$row_sltk[id]'>Chi tiết</a> | <a href='giohang.php?action=delete&id=" . htmlspecialchars($row["id"]) . "'>Xóa</a> | <a>Kho không đủ</a></td>";
                                    } else {
                                        echo "<td class='chucnang' style='text-align: center; text-wrap: nowrap'><a href='/project/LTWEB/CKI/html/danhmuc/chitietsanpham.php?id=$row_sltk[id]'>Chi tiết</a> | <a href='giohang.php?action=delete&id=" . htmlspecialchars($row["id"]) . "'>Xóa</a> | <a>Đợi phát hành</a></td>";
                                    }
                                } else {
                                    echo "<td class='chucnang' style='text-align: center; text-wrap: nowrap'><a href='/project/LTWEB/CKI/html/danhmuc/chitietsanpham.php?id=$row_sltk[id]'>Chi tiết</a> | <a href='giohang.php?action=delete&id=" . htmlspecialchars($row["id"]) . "'>Xóa</a> | <a href='/project/LTWEB/CKI/html/danhmuc/buy.php?id=" . htmlspecialchars($row["id"]) . "'>Mua</a></td>";
                                }
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Giỏ hàng trống</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <div id="form_show_update_total">
            <input type="submit" value="Cập nhật giỏ hàng" />
            <h3>Tổng thành tiền: <?php echo htmlspecialchars(number_format($totalAmount, 0, '', ',')); ?> VND</h3>
        </div>
    </form>

    <?php mysqli_close($conn); ?>

    <!-- Footer -->
    <?php include ("../form/footer.php"); ?>
</body>

</html>