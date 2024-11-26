<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbansach";

// Kết nối đến MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo " " . $conn->error;
}

//biến để quyết định thực hiện hàm
$action = isset($_GET['action']) ? $_GET['action'] : '';

//biến login(tk,mk)
$inputAcc = isset($_POST['inputAcc']) ? $_POST['inputAcc'] : '';
$inputPas = isset($_POST['inputPas']) ? $_POST['inputPas'] : '';
$inputHo = isset($_POST['inputHo']) ? $_POST['inputHo'] : '';
$inputTen = isset($_POST['inputTen']) ? $_POST['inputTen'] : '';

//biến tìm kiếm từ khóa trong doanh thu
$input_search = isset($_POST['input_search']) ? $_POST['input_search'] : '';
$date_from = isset($_POST['date_from']) ? $_POST['date_from'] : '';
$date_to = isset($_POST['date_to']) ? $_POST['date_to'] : '';

//trang được chọn
$pageChoose = isset($_POST['pageChoose']) ? $_POST['pageChoose'] : 1;
$pageChoose_iw = isset($_POST['pageChoose_iw']) ? $_POST['pageChoose_iw'] : 1;
$pageChoose_sph = isset($_POST['pageChoose_sph']) ? $_POST['pageChoose_sph'] : 1;

//biến thông tin chuyển trạng thái
$pbiet = isset($_POST['pbiet']) ? $_POST['pbiet'] : '';
$idOfPro = isset($_POST['idOfPro']) ? $_POST['idOfPro'] : '';
$accOfPro = isset($_POST['accOfPro']) ? $_POST['accOfPro'] : '';

//biến nhận được khi mua ngay
$id_product = isset($_GET['id']) ? $_GET['id'] : '';

//thông tin mua ngay
$selectedText_City = isset($_POST['selectedText_City']) ? $_POST['selectedText_City'] : '';
$selectedText_Districts = isset($_POST['selectedText_Districts']) ? $_POST['selectedText_Districts'] : '';
$selectedText_Ward = isset($_POST['selectedText_Ward']) ? $_POST['selectedText_Ward'] : '';
$diachicuthe = isset($_POST['diachicuthe']) ? $_POST['diachicuthe'] : '';
$sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';
$radioValue = isset($_POST['radioValue']) ? $_POST['radioValue'] : '';
$tongcong = isset($_POST['tongcong']) ? $_POST['tongcong'] : '';
$id_thanhtoan = isset($_POST['id_thanhtoan']) ? $_POST['id_thanhtoan'] : '';

//biến xác nhận
$hdong = isset($_GET['hdong']) ? $_GET['hdong'] : '';
$mahoadon = isset($_GET['mahoadon']) ? $_GET['mahoadon'] : '';

//biến mã hóa đơn khi ng dùng hủy đơn
$mahd_user = isset($_POST['mahd_user']) ? $_POST['mahd_user'] : '';

//tên thể loại để thêm/xóa
$tentheloai = isset($_POST['tentheloai']) ? $_POST['tentheloai'] : '';
$hdong_add_del = isset($_POST['hdong']) ? $_POST['hdong'] : '';

switch ($action) {
    case 'login':
        login($conn, $inputAcc, $inputPas);
        break;
    case 'logout':
        logout($conn);
        break;
    case 'reg':
        reg($conn, $inputHo, $inputTen, $inputAcc, $inputPas);
        break;
    case 'loadlistinweek':
        loadlistinweek($conn, $pageChoose_iw);
        break;
    case 'loadlistSPH':
        loadlistSPH($conn, $pageChoose_sph);
        break;
    case 'listRevenu':
        listRevenu($conn, $input_search, $date_from, $date_to, $pageChoose);
        break;
    case 'getInforFromDT':
        getInforFromDT($conn);
        break;
    case 'spdoiduyet':
        spdoiduyet($conn);
        break;
    case 'changeStatusProduct':
        changeStatusProduct($conn, $idOfPro, $accOfPro, $pbiet);
        break;
    case 'quantity_tb':
        quantity_tb($conn);
        break;
    case 'quant_mem_pro':
        quant_mem_pro($conn);
        break;
    case 'totalAmount_giohang':
        totalAmount_giohang($conn);
        break;
    case 'buy':
        buy($conn, $id_product);
        break;
    case 'thanhtoan':
        thanhtoan($conn, $id_thanhtoan, $selectedText_City, $selectedText_Districts, $selectedText_Ward, $diachicuthe, $sdt, $radioValue, $tongcong);
        break;
    case 'xacnhan':
        xacnhan($conn, $hdong, $mahoadon);
        break;
    case 'user_huydon':
        user_huydon($conn, $mahd_user);
        break;
    case 'theloai':
        theloai($conn, $tentheloai, $hdong_add_del);
        break;
    default:
        echo "Yêu cầu không đúng";
        break;
}
function logout($conn)
{
    unset($_SESSION['taikhoan']);
    session_destroy();
    header('Location: /project/LTWEB/CKI/html/trangchu.php');
}

function totalAmount_giohang($conn)
{
    $data = [];

    //đếm số lượng sản phẩm trong giỏ hàng của người dùng
    $truyvan_giohang = "SELECT COUNT(*) AS quantity_product FROM giohang WHERE BINARY taikhoan = '$_SESSION[taikhoan]'";
    $thuchien_giohang = mysqli_query($conn, $truyvan_giohang);

    //đếm số tiền của giỏ hàng
    $truyvan_totalAmount = "SELECT SUM(thanhtien) AS totalAmount FROM giohang WHERE BINARY taikhoan = '$_SESSION[taikhoan]'";
    $thuchien_totalAmount = mysqli_query($conn, $truyvan_totalAmount);

    //kiểm tra truy vấn thành công hay không
    if ($thuchien_giohang && $thuchien_totalAmount) {
        //đếm số hàng trả về của sản phẩm trong giỏ hàng
        $data['quantity_product'] = mysqli_fetch_array($thuchien_giohang)['quantity_product'];

        //nếu tổng tiền > 0 thì lấy tổng trả về, ngược lại < 0 => totalAmount = 0;
        if (mysqli_num_rows($thuchien_totalAmount) > 0) {
            $row_totalAmount = mysqli_fetch_assoc($thuchien_totalAmount);
            $data['totalAmount'] = $row_totalAmount['totalAmount'];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo " " . $conn->error;
    }
}

function login($conn, $inputAcc, $inputPas)
{
    //tìm kiếm tài khoản
    $truyvan_check = "SELECT * FROM taikhoan WHERE BINARY taikhoan = '$inputAcc' AND BINARY matkhau = '$inputPas'";
    $thuchien_check = mysqli_query($conn, $truyvan_check);

    //kiểm tra truy vấn thành công hay không
    if ($thuchien_check) {
        //kiểm tra có dữ liệu cần tìm không || nếu có thì số dòng trả về sẽ lớn hơn 1
        if (mysqli_num_rows($thuchien_check) > 0) {

            //lấy một hàng từ kết quả trả về dưới dạng mảng
            $row_check = mysqli_fetch_assoc($thuchien_check);

            //gắn biến toàn cục
            $_SESSION['taikhoan'] = $row_check['taikhoan'];
            $_SESSION['ten'] = $row_check['ten'];
            $_SESSION['ho'] = $row_check['ho'];
            $_SESSION['loai'] = $row_check['loai'];
            $_SESSION['email'] = $row_check['email'];

            echo "ok";
        } else {
            echo "Không";
        }
    } else {
        echo " " . $conn->error;
    }
}

function reg($conn, $inputHo, $inputTen, $inputAcc, $inputPas)
{
    $truyvan = "SELECT * FROM taikhoan WHERE BINARY taikhoan = '$inputAcc' AND BINARY matkhau = '$inputPas'";
    $thuchien = mysqli_query($conn, $truyvan);

    //kiểm tra truy vấn thành công hay không
    if ($thuchien) {
        //kiểm tra có dữ liệu cần tìm không || nếu có thì số dòng trả về sẽ lớn hơn 1
        if (mysqli_num_rows($thuchien) > 0) {
            echo "Không";
        } else {
            //thêm tài khoản mới vào sql
            $add = "INSERT INTO taikhoan (ho, ten, taikhoan, matkhau, loai) VALUES ('$inputHo', '$inputTen','$inputAcc', '$inputPas', 1)";
            $thuchien_add = mysqli_query($conn, $add);

            if ($thuchien_add) {
                //gắn biến
                $_SESSION['taikhoan'] = $inputAcc;
                $_SESSION['ten'] = $inputTen;
                $_SESSION['loai'] = 1;
            }

            echo "ok";
        }
    }
}

function loadlistinweek($conn, $pageChoose_iw)
{
    $max_show = 5;

    //DATE_SUB(CURDATE(), INTERVAL 20 DAY): Hàm này trừ 20 ngày khỏi ngày hiện tại, tức là tính ngày cách đây 20 ngày từ hôm nay.
    //DATE_SUB - INTERVAL: trừ; DATE_ADD - INTERVAL: cộng  
    $truyvan_start = "SELECT * FROM danhsachtruyen WHERE ngay >= DATE_SUB(CURDATE(), INTERVAL 14 DAY) ORDER BY ngay DESC";

    //tổng trang
    $total = mysqli_num_rows(mysqli_query($conn, $truyvan_start));

    //số trang cần để hiện dữ liệu
    $page = ceil($total / $max_show);

    $start = ($pageChoose_iw - 1) * $max_show;

    $truyvan = $truyvan_start . " LIMIT $start,$max_show";
    $thuchien = mysqli_query($conn, $truyvan);

    if ($thuchien) {
        if (mysqli_num_rows($thuchien) > 0) {
            while ($row = mysqli_fetch_array($thuchien)) {
                $ten = $row['ten'];
                $taptruyen = $row['taptruyen'];
                $hinhanh = $row['hinhanh'];
                $gia = number_format($row['gia'], 0, '', ',') . "<u>đ</u>";

                echo "<div class='item_book'>";
                echo "<div class='name_book'>";
                echo "<a href='/project/LTWEB/CKI/html/danhmuc/chitietsanpham.php?id=" . $row['id'] . "'><p>$ten $taptruyen</p></a>";
                echo "<p>$gia</p>";
                echo "</div>";
                echo "<div class='img_book'>";
                echo "<img src='../$hinhanh'>";
                echo "</div>";
                if (isset($_SESSION['taikhoan'])) {
                    if ($_SESSION['loai'] != 0) {
                        echo "<div class='add_book'>";
                        echo "<button class='btn_themgiohang' data-id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='add_book'>";
                    echo "<button class='btn_themgiohang' data-id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                    echo "</div>";
                }
                echo "</div>";
            }

            echo "<div class='container_btn_loadlistinweek'>";
            if ($page >= 4) {
                $begin = $pageChoose_iw - 1;
                if ($begin < 1) {
                    $begin = 1;
                }
                if ($pageChoose_iw < 2) {
                    $end = $pageChoose_iw + 2;
                } else {
                    $end = $pageChoose_iw + 1;
                }
                if ($end > $page) {
                    $end = $page;
                    $begin = $page - 2;
                }

                //pre
                if ($pageChoose_iw > 1) {
                    echo "<button class='btn_pages_iw' num_page='" . ($pageChoose_iw - 1) . "'><i class='fa-solid fa-angles-left'></i></button>";
                }

                for ($i = $begin; $i <= $end; $i++) {
                    echo "<button class='btn_pages_iw " . ($i == $pageChoose_iw ? 'change' : '') . "' num_page='$i'>$i</button>";
                }

                //next
                if ($pageChoose_iw < $end) {
                    echo "<button class='btn_pages_iw' num_page='" . ($pageChoose_iw + 1) . "'><i class='fa-solid fa-angles-right'></i></button>";
                }
            } else if ($page > 1 && $page <= 3) {
                for ($i = 1; $i <= $page; $i++) {
                    echo "<button class='btn_pages_iw " . ($i == $pageChoose_iw ? 'change' : '') . "' num_page='$i'>$i</button>";
                }
            }
            echo "</div>";
        } else {
            echo "Không có dữ liệu";
        }
    } else {
        echo " " . $conn->error;
    }
}

function loadlistSPH($conn, $pageChoose_sph)
{
    $max_show = 5;

    $truyvan_start = "SELECT * FROM danhsachtruyen WHERE soluongtonkho = 0 AND soluongdaban = 0";
    $thuchien_start = mysqli_query($conn, $truyvan_start);
    $count = mysqli_num_rows($thuchien_start);

    $page = ceil($count / $max_show);

    $start = ($pageChoose_sph - 1) * $max_show;

    $truyvan = $truyvan_start . " ORDER BY ngay DESC LIMIT $start,$max_show";
    $thuchien = mysqli_query($conn, $truyvan);

    if ($thuchien) {
        if (mysqli_num_rows($thuchien) > 0) {
            while ($row = mysqli_fetch_array($thuchien)) {
                $ten = $row['ten'];
                $taptruyen = $row['taptruyen'];
                $hinhanh = $row['hinhanh'];
                $gia = number_format($row['gia'], 0, '', ',') . "<u>đ</u>";

                echo "<div class='item_book'>";
                echo "<div class='name_book'>";
                echo "<a href='/project/LTWEB/CKI/html/danhmuc/chitietsanpham.php?id=" . $row['id'] . "'><p>$ten $taptruyen</p></a>";
                echo "<p>$gia</p>";
                echo "</div>";
                echo "<div class='img_book'>";
                echo "<img src='../$hinhanh'>";
                echo "</div>";
                if (isset($_SESSION['taikhoan'])) {
                    if ($_SESSION['loai'] != 0) {
                        echo "<div class='add_book'>";
                        echo "<button class='btn_themgiohang' data-id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='add_book'>";
                    echo "<button class='btn_themgiohang' data-id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                    echo "</div>";
                }
                echo "</div>";
            }

            echo "<div class='container_btn_loadlistsph'>";
            if ($page >= 4) {
                $begin = $pageChoose_sph - 1;
                if ($begin < 1) {
                    $begin = 1;
                }
                if ($pageChoose_sph < 2) {
                    $end = $pageChoose_sph + 2;
                } else {
                    $end = $pageChoose_sph + 1;
                }
                if ($end > $page) {
                    $end = $page;
                    $begin = $page - 2;
                }

                //pre
                if ($pageChoose_sph > 1) {
                    echo "<button class='btn_pages_sph' num_page='" . ($pageChoose_sph - 1) . "'><i class='fa-solid fa-angles-left'></i></button>";
                }

                for ($i = $begin; $i <= $end; $i++) {
                    echo "<button class='btn_pages_sph " . ($i == $pageChoose_sph ? 'change' : '') . "' num_page='$i'>$i</button>";
                }

                //next
                if ($pageChoose_sph < $end) {
                    echo "<button class='btn_pages_sph' num_page='" . ($pageChoose_sph + 1) . "'><i class='fa-solid fa-angles-right'></i></button>";
                }
            } else if ($page > 1 && $page <= 3) {
                for ($i = 1; $i <= $page; $i++) {
                    echo "<button class='btn_pages_sph " . ($i == $pageChoose_sph ? 'change' : '') . "' num_page='$i'>$i</button>";
                }
            }
            echo "</div>";
        } else {
            echo "Không có dữ liệu";
        }
    }
}

function quant_mem_pro($conn)
{
    $data = [];

    $truyvan_member = "SELECT * FROM taikhoan";
    $thuchien_member = mysqli_query($conn, $truyvan_member);
    $quantity_member = mysqli_num_rows($thuchien_member);
    $data['quantity_member'] = $quantity_member;

    $truyvan_product = "SELECT * FROM danhsachtruyen";
    $thuchien_product = mysqli_query($conn, $truyvan_product);
    $quantity_product = mysqli_num_rows($thuchien_product);
    $data['quantity_product'] = $quantity_product;

    header('Content-Type: application/json');
    echo json_encode($data);
}

//doanh thu
function listRevenu($conn, $input_search, $date_from, $date_to, $pageChoose)
{
    $truyvan = "SELECT * FROM doanhthu";

    //tổng số sản phẩm
    $total_record = "SELECT * FROM doanhthu";
    $thuchien_total_record = mysqli_query($conn, $total_record);

    //tính số trang cần hiển thị đủ product
    $total = mysqli_num_rows($thuchien_total_record);

    //tổng product hủy
    $total_hanghuy = $total_record . " WHERE trangthai = 2";
    $thuchien_hanghuy = mysqli_query($conn, $total_hanghuy);
    $total_hanghuy = mysqli_num_rows($thuchien_hanghuy);

    //tổng product chờ duyệt
    $total_duyet = $total_record . " WHERE trangthai = 0";
    $thuchien_duyet = mysqli_query($conn, $total_duyet);
    $total_duyet = mysqli_num_rows($thuchien_duyet);

    if ($input_search || $date_from || $date_to) {

        $truyvan_end = " WHERE (taikhoan like '%$input_search%' OR mahoadon = '$input_search' OR '$input_search' = '') AND (ngaymua >= '$date_from' OR '$date_from' = '') AND (ngaymua <= '$date_to' OR '$date_to' = '')";

        $truyvan = $truyvan . $truyvan_end;
        $truyvan_totalAmount = "SELECT SUM(thanhtien) AS thanhtien FROM doanhthu" . $truyvan_end;
        $thuchien_totalAmount = mysqli_query($conn, $truyvan_totalAmount);

        if ($thuchien_totalAmount) {
            $row = mysqli_fetch_assoc($thuchien_totalAmount);
            $totalAmount = number_format($row['thanhtien'], 0, '', '.') . " vnd";
        } else {
            echo " " . $conn->error;
        }

    } else if (!$input_search && !$date_from && !$date_to) {
        //phân trang
        //số product tối đa mỗi trang
        $max_show = 5;

        $page = ceil($total / $max_show);

        $start = ((int) $pageChoose - 1) * $max_show;

        $truyvan = $truyvan . " ORDER BY ngaymua DESC LIMIT $start,$max_show";
    }

    $thuchien = mysqli_query($conn, $truyvan);

    if ($thuchien) {

        if (!isset($totalAmount)) {
            $totalAmount = "";
        }
        echo "<div class='container_input_totalAmount'>";
        echo "Tổng đơn hàng hoàn thành: $total | Tổng đơn hàng chờ duyệt: $total_duyet | Tổng đơn hàng đã hủy: $total_hanghuy";
        echo "<input type='text' value='$totalAmount' readonly placeholder='Tổng tiền'>";
        echo "</div>";

        if (mysqli_num_rows($thuchien) > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Mã hóa đơn</th>";
            echo "<th>Tài khoản</th>";
            echo "<th>Thành tiền</th>";
            echo "<th>Thời gian</th>";
            echo "<th>Phương thức thanh toán</th>";
            echo "<th>Chi tiết</th>";
            echo "<th>Trạng thái</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_array($thuchien)) {
                $thanhtien = number_format($row['thanhtien'], 0, '', '.') . "vnd";
                echo "<tr>";
                echo "<td>" . $row['mahoadon'] . "</td>";
                echo "<td>" . $row['taikhoan'] . "</td>";
                echo "<td>" . $thanhtien . "</td>";
                echo "<td>" . $row['ngaymua'] . "</td>";
                echo "<td>" . $row['phuongthucthanhtoan'] . "</td>";
                echo "<td><a href='xemchitiet.php?mahoadon=" . $row['mahoadon'] . "'>Xem chi tiết</a></td>";
                if ($row['trangthai'] == 1) {
                    echo "<td><i style='color: white; background-color: green; padding: 2% 2.5%; border-radius: 50%' class='fa-solid fa-check'></i></td>";
                } else if ($row['trangthai'] == 2) {
                    echo "<td><i style='color: white; background-color: red; padding: 2% 4%; border-radius: 50%' <i class='fa-solid fa-x'></i></i></td>";
                } else {
                    echo "<td><i style='color: black; background-color: transparent; font-size: 1.3pc; border-radius: 50%' class='fa-solid fa-clock-rotate-left'></i></td>";
                }
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            echo "<div class='pag'>";
            if (!$input_search && !$date_from && !$date_to) {
                if ($page > 3) {

                    $begin = $pageChoose - 1;
                    if ($begin < 1) {
                        $begin = 1;
                    }
                    if ($pageChoose < 2) {
                        $end = $pageChoose + 2;
                    } else {
                        $end = $pageChoose + 1;
                    }
                    if ($end > $page) {
                        $end = $page;
                        $begin = $page - 2;
                    }
                    echo "<button class='btn_pages' num_page='1'>First</button>";

                    //pre
                    if ($pageChoose > 1) {
                        echo "<button class='btn_pages' num_page='" . ($pageChoose - 1) . "'><i class='fa-solid fa-angles-left'></i></button>";
                    }

                    for ($i = $begin; $i <= $end; $i++) {
                        echo "<button class='btn_pages " . ($i == $pageChoose ? 'change' : '') . "' num_page='$i'>$i</button>";
                    }

                    //next
                    if ($pageChoose < $end) {
                        echo "<button class='btn_pages' num_page='" . ($pageChoose + 1) . "'><i class='fa-solid fa-angles-right'></i></button>";
                    }

                    echo "<button class='btn_pages' num_page='$page'>Last</button>";

                } else if (1 < $page && $page <= 5) {

                    echo "<button class='btn_pages' num_page='1'>First</button>";

                    if ($pageChoose > 1) {
                        echo "<button class='btn_pages' num_page='" . ($pageChoose - 1) . "'><i class='fa-solid fa-angles-left'></i></button>";
                    }

                    for ($i = 1; $i <= $page; $i++) {
                        echo "<button class='btn_pages " . ($i == $pageChoose ? 'change' : '') . "' num_page='$i'>$i</button>";
                    }

                    //next
                    if ($pageChoose < $page) {
                        echo "<button class='btn_pages' num_page='" . ($pageChoose + 1) . "'><i class='fa-solid fa-angles-right'></i></button>";
                    }

                    echo "<button class='btn_pages' num_page='$page'>Last</button>";
                }
            }
            echo "</div>";
        } else {
            echo "Không có dữ liệu";
        }
    } else {
        die("Lỗi truy vấn: " . $conn->error);
    }
}

function getInforFromDT($conn)
{
    header('Content-Type: application/json');
    $data = [];
    //ngày tháng năm hiện tại
    $currentDate = date('Y-m-d');

    $truyvan_time = "SELECT DATE_FORMAT(ngaymua, '%H') AS hour, SUM(thanhtien) AS thanhtien 
                     FROM doanhthu 
                     WHERE DATE(ngaymua) = '$currentDate' AND trangthai = 1
                     GROUP BY DATE_FORMAT(ngaymua, '%H') 
                     ORDER BY DATE_FORMAT(ngaymua, '%H') ASC";
    $thuchien_time = mysqli_query($conn, $truyvan_time);

    //tháng năm hiện tại
    $currentYM = date('Y-m');

    //truy vấn lấy tháng năm
    $truyvan_date = "SELECT DATE_FORMAT(ngaymua, '%d') AS day, SUM(thanhtien) AS tien_ngay 
                     FROM doanhthu 
                     WHERE DATE_FORMAT(ngaymua, '%Y-%m') = '$currentYM' AND trangthai = 1
                     GROUP BY DATE_FORMAT(ngaymua, '%d') 
                     ORDER BY DATE_FORMAT(ngaymua, '%d') ASC";
    $thuchien_date = mysqli_query($conn, $truyvan_date);

    //năm hiện tại
    $currentY = date('Y');

    //truy vấn lấy năm
    $truyvan_month = "SELECT DATE_FORMAT(ngaymua, '%m') AS month, SUM(thanhtien) AS tien_thang 
                     FROM doanhthu 
                     WHERE DATE_FORMAT(ngaymua, '%Y') = '$currentY' AND trangthai = 1
                     GROUP BY DATE_FORMAT(ngaymua, '%m') 
                     ORDER BY DATE_FORMAT(ngaymua, '%m') ASC";
    $thuchien_month = mysqli_query($conn, $truyvan_month);

    //lấy số lượng bán được của truyện
    $truyvan_bestsell = "SELECT ten, taptruyen, soluongdaban
                         FROM danhsachtruyen
                         WHERE soluongdaban > 0
                         ORDER BY soluongdaban DESC
                         LIMIT 10";
    $thuchien_bestsell = mysqli_query($conn, $truyvan_bestsell);

    if ($thuchien_time && mysqli_num_rows($thuchien_time) > 0) {
        while ($row = mysqli_fetch_assoc($thuchien_time)) {
            $data['time'][] = $row;
        }
    }

    if ($thuchien_date && mysqli_num_rows($thuchien_date) > 0) {
        while ($row = mysqli_fetch_assoc($thuchien_date)) {
            $data['date'][] = $row;
        }
    }

    if ($thuchien_month && mysqli_num_rows($thuchien_month) > 0) {
        while ($row = mysqli_fetch_assoc($thuchien_month)) {
            $data['month'][] = $row;
        }
    }

    if ($thuchien_bestsell && mysqli_num_rows($thuchien_bestsell) > 0) {
        while ($row = mysqli_fetch_assoc($thuchien_bestsell)) {
            $data['quantity_product'][] = $row;
        }
    } else {
        // Nếu không có kết quả, hãy kiểm tra
        $data['quantity_product'] = 'Không có dữ liệu';
    }

    echo json_encode($data);
}

function quantity_tb($conn)
{
    $truyvan = "SELECT * FROM doanhthu WHERE trangthai = 0 ORDER BY ngaymua DESC";
    $thuchien = mysqli_query($conn, $truyvan);
    $count = mysqli_num_rows($thuchien);

    echo $count;
}

function spdoiduyet($conn)
{
    $truyvan = "SELECT * FROM doanhthu WHERE trangthai = 0 ORDER BY ngaymua DESC";
    $thuchien = mysqli_query($conn, $truyvan);
    $count = mysqli_num_rows($thuchien);

    echo "Tổng đơn hàng chờ duyệt: $count";

    if ($thuchien && $count > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>STT</th>";
        echo "<th>Mã hóa đơn</th>";
        echo "<th>Tài khoản</th>";
        echo "<th>Thành tiền</th>";
        echo "<th>Thời gian</th>";
        echo "<th>Trạng thái</th>";
        echo "<th>Chức năng</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $i = 1;

        while ($row = mysqli_fetch_array($thuchien)) {
            $stt = $i++;
            $thanhtien = number_format($row['thanhtien'], 0, '', '.') . "vnd";
            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>" . $row['mahoadon'] . "</td>";
            echo "<td>" . $row['taikhoan'] . "</td>";
            echo "<td>" . $thanhtien . "</td>";
            echo "<td>" . $row['ngaymua'] . "</td>";
            echo "<td>Chờ duyệt</td>";
            echo "<td>
            <a href='/project/LTWEB/CKI/html/doanhthu/xemchitiet.php?mahoadon=" . $row['mahoadon'] . "'><button>Xem chi tiết</button></a>
            |
            <button class='btn_choduyet' data-mahd='$row[mahoadon]' taikhoan='$row[taikhoan]'>Duyệt</button>
            |
            <button class='btn_huydon' data-mahd='$row[mahoadon]' taikhoan='$row[taikhoan]'>Xóa</button>
            </td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<br>";
        echo "Không có sản phẩm chờ duyệt";
    }
}

function changeStatusProduct($conn, $idOfPro, $accOfPro, $pbiet)
{
    $dem = 1;
    if ($pbiet == "duyet") {
        $truyvan = "UPDATE doanhthu SET trangthai = 1, danhan = 1 WHERE mahoadon = '$idOfPro' AND taikhoan = '$accOfPro'";
        $thuchien = mysqli_query($conn, $truyvan);

        if ($thuchien) {

            //lấy các sp trong chitiethoadon cùng mahoadon với hóa đơn trong doanhthu để update sl tồn kho và đã bán trong danhsachtruyen
            $truyvan_select_flo_mahd = "SELECT * FROM chitiethoadon WHERE mahoadon = '$idOfPro' AND taikhoan = '$accOfPro'";
            $thuchien_select_flo_mahd = mysqli_query($conn, $truyvan_select_flo_mahd);

            if ($thuchien_select_flo_mahd) {
                while ($row_select_flo_mahd = mysqli_fetch_array($thuchien_select_flo_mahd)) {

                    //giảm số lượng tồn kho của sp trong danhsachtruyen
                    $truyvan_giamsltk = "UPDATE danhsachtruyen 
                                         SET soluongtonkho = (soluongtonkho - $row_select_flo_mahd[soluong]) 
                                         WHERE ten = '$row_select_flo_mahd[tentruyen]' AND taptruyen = '$row_select_flo_mahd[taptruyen]'";
                    $thuchien_giamsltk = mysqli_query($conn, $truyvan_giamsltk);

                    //tăng số lượng đã bán của sp trong danhsachtruyen
                    $truyvan_tangsltk = "UPDATE danhsachtruyen 
                                         SET soluongdaban = (soluongdaban + $row_select_flo_mahd[soluong]) 
                                         WHERE ten = '$row_select_flo_mahd[tentruyen]' AND taptruyen = '$row_select_flo_mahd[taptruyen]'";
                    $thuchien_tangsltk = mysqli_query($conn, $truyvan_tangsltk);

                    if (!$thuchien_giamsltk || !$thuchien_tangsltk) {
                        $dem++;
                    }
                }
                if ($dem == 1) {
                    echo "ok";
                } else {
                    echo "Lỗi";
                }
            }
        } else {
            echo " " . $conn->error;
        }
    } else if ($pbiet == "huy") {
        $truyvan = "UPDATE doanhthu SET trangthai = 2 WHERE mahoadon = '$idOfPro' AND taikhoan = '$accOfPro'";
        $thuchien = mysqli_query($conn, $truyvan);

        if ($thuchien) {
            echo "ok";
        } else {
            echo " " . $conn->error;
        }
    }
}

function buy($conn, $id_product)
{
    $truyvan = "SELECT * FROM danhsachtruyen WHERE id = $id_product";
    $thuchien = mysqli_query($conn, $truyvan);

    if ($thuchien && isset($_SESSION['taikhoan'])) {
        if (mysqli_num_rows($thuchien) > 0) {
            while ($row = mysqli_fetch_array($thuchien)) {

                $truyvan_checkgio = "SELECT * FROM giohang WHERE taikhoan = '$_SESSION[taikhoan]' AND tentruyen = '$row[ten]' AND taptruyen = '$row[taptruyen]'";
                $thuchien_checkgio = mysqli_query($conn, $truyvan_checkgio);

                if ($thuchien_checkgio) {
                    if (mysqli_num_rows($thuchien_checkgio) > 0) {
                        while ($row_update = mysqli_fetch_array($thuchien_checkgio)) {

                            $update = "UPDATE giohang SET soluong = ($row_update[soluong] + 1) WHERE taikhoan = '$_SESSION[taikhoan]' AND tentruyen = '$row[ten]' AND taptruyen = '$row[taptruyen]'";
                            $thuchien_update = mysqli_query($conn, $update);

                            if ($thuchien_update) {
                                header("Location: /project/LTWEB/CKI/html/danhmuc/buy.php?id=" . $row_update['id']);
                            } else {
                                echo "Không thể mua ngay";
                            }
                        }
                    } else {
                        // Đặt múi giờ là 'Asia/Ho_Chi_Minh' cho Việt Nam
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        // Lấy ngày giờ hiện tại
                        $currentDateTime = date('Y-m-d H:i:s');

                        $add = "INSERT INTO giohang(taikhoan, tentruyen, taptruyen, hinhanh, soluong, gia, thanhtien, ngaythem) VALUES ('$_SESSION[taikhoan]', '$row[ten]', '$row[taptruyen]', '$row[hinhanh]', '1', '$row[gia]', '$row[gia]', '$currentDateTime')";
                        $thuchien_add = mysqli_query($conn, $add);

                        if ($thuchien_add) {

                            $truyvan_getid = "SELECT * FROM giohang WHERE taikhoan = '$_SESSION[taikhoan]' AND tentruyen = '$row[ten]' AND taptruyen = '$row[taptruyen]'";
                            $thuchien_getid = mysqli_query($conn, $truyvan_getid);

                            if ($thuchien_getid) {
                                while ($row_add = mysqli_fetch_array($thuchien_getid)) {
                                    if ($row_add['tentruyen'] == $row['ten'] && $row_add['taptruyen'] == $row['taptruyen'] && $row_add['taikhoan'] == $_SESSION['taikhoan']) {
                                        header("Location: /project/LTWEB/CKI/html/danhmuc/buy.php?id=" . $row_add['id']);
                                    }
                                }
                            }
                        } else {
                            echo " " . $conn->error;
                        }
                    }
                }
            }
        } else {
            echo " " . $conn->error;
        }
    } else {
        header("Location: /project/LTWEB/CKI/html/danhmuc/buy.php");
    }
}

function thanhtoan($conn, $id_thanhtoan, $selectedText_City, $selectedText_Districts, $selectedText_Ward, $diachicuthe, $sdt, $radioValue, $tongcong)
{
    //Đặt múi giờ là 'Asia/Ho_Chi_Minh' cho Việt Nam
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    //ngày hiện tại
    $now = date('Y-m-d H:i:s');

    //cập nhật lại thông tin trong taikhoan
    $truyvan_update_user = "UPDATE taikhoan 
                            SET sdt = '$sdt', diachi = '$diachicuthe',tinh = '$selectedText_City',huyen = '$selectedText_Districts',xa = '$selectedText_Ward'
                            WHERE taikhoan = '$_SESSION[taikhoan]'";
    $thuchien_update_user = mysqli_query($conn, $truyvan_update_user);

    //kiểm tra cập nhật thông tin khách hàng thành công chưa
    if ($thuchien_update_user) {

        //kiểm tra đã có hóa đơn nào trong doanhthu chưa
        $truyvan_select_max_idhd = "SELECT * FROM doanhthu ORDER BY ngaymua DESC LIMIT 1";
        $thuchien_select_max_idhd = mysqli_query($conn, $truyvan_select_max_idhd);
        if ($thuchien_select_max_idhd) {

            $truyvan_insert = "INSERT INTO doanhthu(mahoadon, taikhoan, thanhtien, ngaymua, trangthai, danhan, phuongthucthanhtoan)";

            if (mysqli_num_rows($thuchien_select_max_idhd) > 0) {
                while ($row_select_max_idhd = mysqli_fetch_array($thuchien_select_max_idhd)) {
                    $id_max = substr($row_select_max_idhd['mahoadon'], 2, null);

                    $mahd = "hd" . ($id_max + 1);

                    $truyvan_insert = $truyvan_insert . " VALUES('$mahd','$_SESSION[taikhoan]', '$tongcong', '$now', 0, 0, '$radioValue')";
                }
            } else {
                $mahd = "hd1";
                $truyvan_insert = $truyvan_insert . " VALUES('$mahd','$_SESSION[taikhoan]', '$tongcong', '$now', 0, 0, '$radioValue')";
            }

            $thuchien_insert = mysqli_query($conn, $truyvan_insert);

            //thực hiện thêm hd mới vào doanhthu thành công thì thêm các sản phẩm được mua vào chitiethoadon
            if ($thuchien_insert) {

                $truyvan_insert_product_chitiethd = "SELECT * FROM giohang";

                //kiếm tra nếu có id nghĩa là chỉ mua 1 sp
                if ($id_thanhtoan) {
                    //lấy thông tin từ dstruyen
                    $truyvan_insert_product_chitiethd = $truyvan_insert_product_chitiethd . " WHERE taikhoan = '$_SESSION[taikhoan]' AND id = '$id_thanhtoan'";
                } else {
                    //không có id nên sẽ lấy toàn bộ truyện trong giỏ hàng
                    $truyvan_insert_product_chitiethd = $truyvan_insert_product_chitiethd . " WHERE taikhoan = '$_SESSION[taikhoan]'";
                }

                $thuchien_insert_product_chitiethd = mysqli_query($conn, $truyvan_insert_product_chitiethd);

                if ($thuchien_insert_product_chitiethd) {
                    while ($row_insert_product_chitiethd = mysqli_fetch_array($thuchien_insert_product_chitiethd)) {

                        //chỉ lấy các sản phẩm có sluong tồn kho > 0
                        $truyvan_check = "SELECT * FROM danhsachtruyen WHERE ten = '$row_insert_product_chitiethd[tentruyen]' AND taptruyen = '$row_insert_product_chitiethd[taptruyen]'";
                        $thuchien_check = mysqli_query($conn, $truyvan_check);

                        if ($thuchien_check) {
                            while ($row_check = mysqli_fetch_array($thuchien_check)) {
                                if ($row_check['soluongtonkho'] > 0) {

                                    //thêm sp vào trong chitiethoadon
                                    $tongtien = $row_insert_product_chitiethd['soluong'] * $row_insert_product_chitiethd['gia'];

                                    $truyvan_insert_chitiethoadon = "INSERT INTO chitiethoadon(mahoadon, taikhoan, tentruyen, taptruyen, soluong, gia, tongtien, ngay) 
                                                                         VALUES('$mahd','$_SESSION[taikhoan]','$row_insert_product_chitiethd[tentruyen]','$row_insert_product_chitiethd[taptruyen]','$row_insert_product_chitiethd[soluong]','$row_insert_product_chitiethd[gia]','$tongtien','$now')";
                                    $thuchien_insert_chitiethoadon = mysqli_query($conn, $truyvan_insert_chitiethoadon);

                                    if ($thuchien_insert_chitiethoadon) {

                                        //xóa khỏi giỏ hàng
                                        $truyvan_xoasp_gio = "DELETE FROM giohang";
                                        if ($id_thanhtoan) {
                                            $truyvan_xoasp_gio = $truyvan_xoasp_gio . " WHERE id = '$id_thanhtoan' AND tentruyen = '$row_insert_product_chitiethd[tentruyen]' AND taptruyen = '$row_insert_product_chitiethd[taptruyen]' AND taikhoan = '$_SESSION[taikhoan]'";
                                        } else {
                                            $truyvan_xoasp_gio = $truyvan_xoasp_gio . " WHERE tentruyen = '$row_insert_product_chitiethd[tentruyen]' AND taptruyen = '$row_insert_product_chitiethd[taptruyen]' AND taikhoan = '$_SESSION[taikhoan]'";
                                        }
                                        $thuchien_xoasp_gio = mysqli_query($conn, $truyvan_xoasp_gio);

                                        if ($thuchien_xoasp_gio) {
                                            $tb = "1";
                                        } else {
                                            $tb = "2";
                                        }
                                    } else {
                                        $tb = "2";
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $tb = "2";
            }
        }
    } else {
        $tb = "2";
    }

    if ($tb == "1") {
        echo "Đặt hàng thành công. Đơn hàng của bạn đang được chuẩn bị!";
    } else {
        echo "Mua hàng thất bại!";
    }
}

//xác nhận từ khách hàng
function xacnhan($conn, $hdong, $mahoadon)
{

    if ($hdong == "xacnhan") {
        $update = "UPDATE doanhthu SET danhan = 2 WHERE taikhoan = '$_SESSION[taikhoan]' AND mahoadon = '$mahoadon'";
    } else {
        $update = "UPDATE doanhthu SET danhan = 3 WHERE taikhoan = '$_SESSION[taikhoan]' AND mahoadon = '$mahoadon'";
    }
    $thuchien = mysqli_query($conn, $update);
    if ($thuchien) {
        header("Location: /project/LTWEB/CKI/html/nguoidung/lichsumuahang.php");
    } else {
        echo "Không thể xác nhận";
    }
}

function user_huydon($conn, $mahd_user)
{
    $truyvan_xoa_chitiethoadon = "DELETE FROM chitiethoadon WHERE taikhoan = '$_SESSION[taikhoan]' AND mahoadon='$mahd_user'";
    $thuchien_xoa_chitiethoadon = mysqli_query($conn, $truyvan_xoa_chitiethoadon);

    if ($thuchien_xoa_chitiethoadon) {
        $truyvan_xoa_doanhthu = "DELETE FROM doanhthu WHERE taikhoan = '$_SESSION[taikhoan]' AND mahoadon='$mahd_user'";
        $thuchien_xoa_doanhthu = mysqli_query($conn, $truyvan_xoa_doanhthu);
        if ($thuchien_xoa_doanhthu) {
            echo "Hủy đơn thành công";
        } else {
            echo "Hủy đơn không thành công";
        }
    } else {
        echo "Hủy đơn không thành công";
    }
}

function theloai($conn, $tentheloai, $hdong)
{
    if ($hdong == "them") {
        $truyvan = "INSERT INTO theloai(theloai) VALUES('$tentheloai')";
    } else if ($hdong == "xoa") {
        $truyvan = "DELETE FROM theloai WHERE theloai = '$tentheloai'";
    }

    $thuchien = mysqli_query($conn, $truyvan);
    if ($thuchien) {
        if ($hdong == "them") {
            echo "Thêm thể loại mới thành công";
        } else if ($hdong == "xoa") {
            echo "Xóa thể loại thành công";
        }
    } else {
        if ($hdong == "them") {
            echo "Thêm thể loại mới thất bại";
        } else if ($hdong == "xoa") {
            echo "Xóa thể loại thất bại";
        }
    }
}

// Sau khi kết thúc công việc, đóng kết nối
mysqli_close($conn);
?>