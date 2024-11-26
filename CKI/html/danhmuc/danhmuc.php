<?php
session_start();
?>
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        #main-content {
            width: 75%;
            margin-left: 20px;
        }

        #main-content h2 {
            /* margin-bottom: 10px; */
            color: #333;
            text-decoration: none;
            margin-top: 10px;
            margin-left: 10px;
        }

        .sort-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-right: 30px;
            margin-bottom: 0px;
        }

        .comic {
            display: flex;
            background-color: white;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 10px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .comic img {
            width: 200px;
            height: auto;
            margin-right: 20px;
        }

        .comic h3 {
            margin-bottom: 8px;
            color: #333;
            font-size: 1.1em;
        }

        .comic p {
            margin-bottom: 3px;
            color: #555;
        }

        .comic button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .comic button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* CSS cho khoảng cách giữa hai nút */
        .comic button.buy-button {
            margin-right: 30px;
            background-color: #007BFF;
        }

        .comic button.buy-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .comic button.cart-button {
            background-color: #28a745;
        }

        .comic button.cart-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        a {
            text-decoration: none;
        }

        .breadcrumb {
            padding: .5% 0 .5% 1%;
            margin-top: 1%;
            margin-left: 1%;
            background-color: whitesmoke;
        }

        .breadcrumb a,
        .breadcrumb i {
            color: black;
            text-decoration: none;
        }

        /* .breadcrumb a:last-child::after {
            content: "";
        } */

        .load-more-container {
            text-align: center;
            margin: 20px 0;
        }

        #load-more {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: none;

        }

        #load-more:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<div>

    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>
    <div class="breadcrumb">
        <a href="/project/LTWEB/CKI/html/trangchu.php">TRANG CHỦ</a>
        <i class='fa-solid fa-angle-right'></i>
        <a href="#">DANH MỤC</a>
        <i class='fa-solid fa-angle-right'></i>
        <a>TRUYỆN TRANH</a>
    </div>
    <!-- Body -->
    <!-- Menu left -->
    <?php
    include ("../form/menuLeft.php");
    ?>
    <div id="main-content">
        <h2>Truyện Tranh</h2>
        <div class="sort-container">
            <label for="sort">Sắp xếp theo:</label>
            <select id="sort">
                <option value="moinhat">Mới nhất</option>
                <option value="banchay">Bán chạy nhất</option>
                <option value="noibat">Sản phẩm nổi bật</option>
                <option value="giatang">Giá tăng dần</option>
                <option value="giagiam">Giá giảm dần</option>
                <option value="az">Từ A-Z</option>
                <option value="za">Từ Z-A</option>
            </select>
        </div>
        <div id="comics-list">
            <?php
            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'webbansach');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch comics from the database
            function fetch_comics($conn, $brands_filter = null, $sort = 'moinhat')
            {
                $query = "SELECT * FROM danhsachtruyen";
                if ($brands_filter) {
                    $query .= " WHERE theloai IN ('$brands_filter')";
                }
                $result = $conn->query($query);
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
                // if ($result->num_rows > 0) {
                //     // while ($row = $result->fetch_assoc()) {
                //     //     $buy_button_label = '';
                //     //     $buy_button_disabled = '';
                //     //     if ($row["soluongtonkho"] == 0) {
                //     //         if ($row["soluongdaban"] > 0) {
                //     //             $buy_button_label = 'Hết hàng';
                //     //             $buy_button_disabled = ' disabled';
                //     //         } else {
                //     //             $buy_button_label = 'Chưa cập nhật';
                //     //             $buy_button_disabled = ' disabled';
                //     //         }
                //     //     } else {
                //     //         $buy_button_label = 'Mua hàng';
                //     //     }
            
                //     //     echo "<a href='chitietsanpham.php?id=" . $row["id"] . "'>";
                //     //     echo '<div class="comic">';
                //     //     echo "<img src='../$row[hinhanh]'>";
                //     //     echo '<div>';
                //     //     echo '<h3>' . htmlspecialchars($row["ten"]) . htmlspecialchars($row["taptruyen"]) . '</h3>';
                //     //     // echo '<h3>' . htmlspecialchars($row["taptruyen"]) . '</h3>';
                //     //     echo '<p>Thể loại: ' . htmlspecialchars($row["theloai"]) . '</p>';
                //     //     echo '<p>Giá: ' . number_format($row["gia"], 0, ',', '.') . ' VND</p>';
                //     //     echo '<p>Ngày phát hành: ' . htmlspecialchars($row["ngay"]) . '</p>';
                //     //     echo '<p>Số lượng: ' . htmlspecialchars($row["soluongtonkho"]) . '</p>';
                //     //     echo '<p>Lượt mua: ' . htmlspecialchars($row["soluongdaban"]) . '</p>';
                //     //     echo '<p>Tóm tắt nội dung: ' . htmlspecialchars($row['mota']) . '</p>';
                //     //     echo '</a>'; // Đóng thẻ <a>
                //     //     echo '<button class="buy-button"' . $buy_button_disabled . '>' . $buy_button_label . '</button>'; // Nút "Mua hàng"
                //     //     echo '<button class="cart-button">Thêm vào giỏ</button>'; // Nút "Thêm vào giỏ"
                //     //     echo '</div>';
                //     //     echo '</div>';
                //     // }
                // } else {
                //     echo "Không có truyện tranh nào được tìm thấy.";
                // }
            }

            fetch_comics($conn);

            $conn->close();
            ?>
        </div>
    </div>
</div>
<div class="load-more-container">
    <button id="load-more">Xem thêm</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var limit = 5; // Số lượng truyện hiển thị mỗi lần
        var offset = 0; // Vị trí bắt đầu lấy truyện

        function fetchComics(loadMore = false) {
            var selectedBrands = [];
            $('input[name="brand[]"]:checked').each(function () {
                selectedBrands.push($(this).val());
            });

            var selectedPrices = [];
            $('input[name="price[]"]:checked').each(function () {
                selectedPrices.push($(this).val());
            });

            var sortOption = $('#sort').val() || 'moinhat'; // Giá trị mặc định là 'moinhat'

            $.ajax({
                url: 'fetch_comics.php',
                method: 'GET',
                data: {
                    brand: selectedBrands,
                    price: selectedPrices,
                    sort: sortOption,
                    limit: limit,
                    offset: offset
                },
                success: function (response) {
                    if (loadMore) {
                        $('#comics-list').append(response);
                    } else {
                        $('#comics-list').html(response);
                    }
                    offset += limit; // Tăng offset sau khi tải thêm truyện

                    // Kiểm tra nếu không còn truyện nào thì ẩn nút "Xem thêm"
                    if ($.trim(response) === '') {
                        $('#load-more').hide();
                    } else {
                        $('#load-more').show();
                    }
                }
            });
        }

        // Sự kiện thay đổi cho sắp xếp, thể loại và giá
        $('#sort').change(function () {
            offset = 0; // Reset offset khi thay đổi sắp xếp
            fetchComics();
        });

        $('input[name="brand[]"], input[name="price[]"]').change(function () {
            offset = 0; // Reset offset khi thay đổi lọc
            fetchComics();
        });

        $('#load-more').click(function () {
            fetchComics(true); // Gọi hàm fetchComics với tham số loadMore là true
        });

        // Gọi hàm fetchComics khi trang tải lần đầu
        fetchComics();
    });
</script>


<!-- Footer -->
<?php
include ("../form/footer.php");
?>
</body>

</html>