<?php
session_start();
// Kết nối tới cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'webbansach');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy các tham số từ URL hoặc gán giá trị mặc định
$brands_filter = isset($_GET['brand']) ? implode("','", $_GET['brand']) : null;
$price_filter = isset($_GET['price']) ? $_GET['price'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'moinhat'; // Mặc định sắp xếp theo 'moinhat'
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Giới hạn số lượng truyện hiển thị mặc định là 8
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Vị trí bắt đầu lấy truyện

function fetch_comics($conn, $brands_filter = null, $price_filter = null, $sort = 'moinhat', $limit = 8, $offset = 0)
{
    $query = "SELECT * FROM danhsachtruyen";
    $conditions = [];

    // Thêm điều kiện lọc theo thể loại
    if ($brands_filter) {
        $conditions[] = "theloai IN ('$brands_filter')";
    }

    // Thêm điều kiện lọc theo giá
    if ($price_filter) {
        $price_conditions = [];
        foreach ($price_filter as $price_range) {
            list($min_price, $max_price) = explode('-', $price_range);
            if ($max_price == '') {
                $price_conditions[] = "gia >= $min_price";
            } else {
                $price_conditions[] = "gia BETWEEN $min_price AND $max_price";
            }
        }
        $conditions[] = '(' . implode(' OR ', $price_conditions) . ')';
    }

    // Xây dựng truy vấn với các điều kiện lọc
    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Thêm điều kiện sắp xếp
    switch ($sort) {
        case 'moinhat':
            $query .= " ORDER BY ngay DESC";
            break;
        case 'banchay':
            $query .= " ORDER BY soluongdaban DESC";
            break;
        case 'noibat':
            $query .= " ORDER BY soluongdaban DESC";
            break;
        case 'giatang':
            $query .= " ORDER BY gia ASC";
            break;
        case 'giagiam':
            $query .= " ORDER BY gia DESC";
            break;
        case 'az':
            $query .= " ORDER BY ten ASC";
            break;
        case 'za':
            $query .= " ORDER BY ten DESC";
            break;
    }

    // Thêm giới hạn và vị trí bắt đầu lấy truyện
    $query .= " LIMIT $limit OFFSET $offset";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $buy_button_label = '';
            $buy_button_disabled = '';
            if ($row["soluongtonkho"] == 0) {
                if ($row["soluongdaban"] > 0) {
                    $buy_button_label = 'Hết hàng';
                    $buy_button_disabled = ' disabled';
                } else {
                    $buy_button_label = 'Chưa cập nhật';
                    $buy_button_disabled = ' disabled';
                }
            } else {
                $buy_button_label = 'Mua hàng';
            }

            // Cắt mô tả nếu dài hơn 100 ký tự
            $description = htmlspecialchars($row['mota']);
            if (strlen($description) > 200) {
                $description = substr($description, 0, 200) . '...';
            }

            echo "<a href='chitietsanpham.php?id=" . $row["id"] . "'>";
            echo '<div class="comic">';
            echo "<img src='/project/LTWEB/CKI/$row[hinhanh]'>";
            echo '<div>';
            echo '<h3>' . htmlspecialchars($row["ten"]) . '</h3>';
            echo '<h3>' . htmlspecialchars($row["taptruyen"]) . '</h3>';
            echo '<p>Thể loại: ' . htmlspecialchars($row["theloai"]) . '</p>';
            echo '<p>Giá: ' . number_format($row["gia"], 0, ',', '.') . ' VND</p>';
            echo '<p>Ngày phát hành: ' . htmlspecialchars($row["ngay"]) . '</p>';
            echo '<p>Số lượng: ' . htmlspecialchars($row["soluongtonkho"]) . '</p>';
            echo '<p>Lượt mua: ' . htmlspecialchars($row["soluongdaban"]) . '</p>';
            echo '<p>Mô tả: ' . $description . '</p>';
            echo '</a>'; // Đóng thẻ <a>
            if (isset($_SESSION['taikhoan'])) {
                if ($_SESSION['loai'] != 0) {
                    echo '<a href="/project/LTWEB/CKI/html/api.php?action=buy&id=' . $row["id"] . '"><button class="buy-button"' . $buy_button_disabled . '>' . $buy_button_label . '</button></a>'; // Nút "Mua hàng"
                    echo '<a href="/project/LTWEB/CKI/html/nguoidung/giohang.php?id=' . $row["id"] . '"><button class="cart-button">Thêm vào giỏ</button></a>'; // Nút "Thêm vào giỏ"
                }
            } else {
                echo '<a href="/project/LTWEB/CKI/html/api.php?action=buy&id=' . $row["id"] . '"><button class="buy-button"' . $buy_button_disabled . '>' . $buy_button_label . '</button></a>'; // Nút "Mua hàng"
                echo '<a href="/project/LTWEB/CKI/html/nguoidung/giohang.php?id=' . $row["id"] . '"><button class="cart-button">Thêm vào giỏ</button></a>'; // Nút "Thêm vào giỏ"
            }
            echo '</div>';
            echo '</div>';
        }
    }
}

fetch_comics($conn, $brands_filter, $price_filter, $sort, $limit, $offset);

$conn->close();
?>