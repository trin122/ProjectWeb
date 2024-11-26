<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truyện Tranh</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        #wrapper {
            display: flex;
            width: 100%;
            /* margin: 10px; */
        }

        #sidebar {
            width: 18%;
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 0px;
        }

        #sidebar h3, #sidebar h4 {
            margin-bottom: 5px;
            color: #333;
            margin-top: 0;
            background-color: #5d8650;
            color: white;
            padding: 5px;
            font-size: 1em;

        }

        #sidebar ul {
            list-style: none;
            margin-bottom: 10px;
        }

        #sidebar ul li {
            margin-bottom: 10px;
            color: #007BFF;
            cursor: pointer;
        }

        #sidebar form div {
            margin-bottom: 10px;
        }

        #sidebar button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }


</style>
</head>
<body>
    <div id="wrapper">
        <div id="sidebar">
            <h3>Danh Mục Sản Phẩm</h3>
            <ul>
                <li>Truyện Tranh</li>
            </ul>
            <h3>Thể loại</h3>
            <form id="filterForm" method="GET" action="">
                <?php
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'webbansach');
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch brands (thể loại) from the database
                $brand_result = $conn->query("SELECT DISTINCT theloai FROM theloai");
                
                if ($brand_result->num_rows > 0) {
                    while ($brand_row = $brand_result->fetch_assoc()) {
                        echo '<div><label><input type="checkbox" name="brand[]" value="' . $brand_row['theloai'] . '"> ' . $brand_row['theloai'] . '</label></div>';
                    }
                } else {
                    echo '<div>Không có thương hiệu nào</div>';
                }
                $conn->close();
                ?>
            <h3>Giá</h3>
            <form id="priceFilterForm" method="GET" action="">
                <div>
                    <label><input type="checkbox" name="price[]" value="0-50000"> Nhỏ hơn 50,000đ</label>
                </div>
                <div>
                    <label><input type="checkbox" name="price[]" value="50000-100000"> Từ 50,000đ - 100,000đ</label>
                </div>
                <div>
                    <label><input type="checkbox" name="price[]" value="100000-200000"> Từ 100,000đ - 200,000đ</label>
                </div>
                <div>
                    <label><input type="checkbox" name="price[]" value="200000-300000"> Từ 200,000đ - 300,000đ</label>
                </div>
                <div>
                    <label><input type="checkbox" name="price[]" value="300000-"> Lớn hơn 300,000đ</label>
                </div>
            </form>
        </div>
</body>
</html>