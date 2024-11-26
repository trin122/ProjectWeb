<?php
session_start();
include '../QLSP/ketnoi.php';

$search = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
}

//phân trang

$pageChoose = isset($_GET['pageChoose']) ? $_GET['pageChoose'] : 1;

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $sql = "SELECT * FROM taikhoan WHERE ho LIKE '%$search%' OR ten LIKE '%$search%' OR taikhoan LIKE '%$search%' ";
} else {
    $max_show = 10;
    $truyvan = "SELECT * FROM taikhoan";
    $thuchien = mysqli_query($conn, $truyvan);
    $quantity = mysqli_num_rows($thuchien);

    $page = ceil($quantity / $max_show);

    $start = ($pageChoose - 1) * $max_show;

    $sql = "SELECT * FROM taikhoan LIMIT $start,$max_show";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Danh sách tài khoản</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/doanhthu.css">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/trangchu.js"></script>
    <script src="/project/LTWEB/CKI/js/header.js"></script>

    <style>
        .container {
            padding: 1% 3%;
            width: 94%;
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            color: #333;
            padding: 1% 0;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-size: 18px;
            color: #555;
        }

        #form_search input[type="text"] {
            padding: 10px;
            width: 35%;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            outline: none;
        }

        .container button {
            padding: 10px 20px;
            background-color: #5d8650;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .container button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border: 1px solid #ddd;
        }

        table,
        td {
            /* border: 1px solid #ddd; */
        }

        td {
            padding: 15px;
            text-align: left;
            word-wrap: break-word;
        }

        thead td {
            background-color: #5d8650;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .diachi {
            text-transform: capitalize;
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
    </style>
</head>

<body>
    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>
    <div class="container">
        <h2>Danh sách tài khoản</h2>

        <form id="form_search" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="search">Tìm kiếm</label>
            <input type="text" id="search" name="search" value="<?php echo $search; ?>"
                placeholder="Từ khóa tìm kiếm...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Họ</td>
                    <td>Tên</td>
                    <td>Tài khoản</td>
                    <td>Mật khẩu</td>
                    <td>Địa chỉ</td>
                    <td>Loại</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["ho"] . "</td>";
                        echo "<td>" . $row["ten"] . "</td>";
                        echo "<td>" . $row["ho"] . "</td>";
                        echo "<td>" . $row["matkhau"] . "</td>";
                        echo "<td class='diachi'>" . $row["diachi"] . " - " . $row["xa"] . " - " . $row["huyen"] . " - " . $row["tinh"] . "</td>";
                        $loai = ($row["loai"] == 0) ? "Quản lý" : "Khách hàng";
                        echo "<td>" . $loai . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có tài khoản nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        //phân trang
        echo "<div id='pag'>";

        if (!isset($_POST['search']) || empty($_POST['search'])) {
            if ($page > 3) {

                echo "<a href='QLTK.php?pageChoose=1'>First</a>";

                if ($pageChoose > 1) {
                    $pre = $pageChoose - 1;
                    echo "<a href='QLTK.php?pageChoose=$pre'><i class='fa-solid fa-angles-left'></i></a>";
                }
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
                    $class = ($i == $pageChoose) ? 'choose' : '';
                    echo "<a class='$class' href='QLSP.php?pageChoose=$i'>$i</a>";
                }

                if ($pageChoose < $page) {
                    $nex = $pageChoose + 1;
                    echo "<a href='QLTK.php?pageChoose=$nex'><i class='fa-solid fa-angles-right'></i></a>";
                }

                echo "<a href='QLTK.php?pageChoose=$page'>Last</a>";
            } else if ($page > 1 && $page <= 3) {

                echo "<a href='QLTK.php?pageChoose=1'>First</a>";

                if ($pageChoose > 1) {
                    $pre = $pageChoose - 1;
                    echo "<a href='QLTK.php?pageChoose=$pre'><i class='fa-solid fa-angles-left'></i></a>";
                }

                for ($i = 1; $i <= $page; $i++) {
                    $class = ($i == $pageChoose) ? 'choose' : '';
                    echo "<a class='$class' href='QLTK.php?pageChoose=$i'>$i</a>";
                }

                if ($pageChoose < $page) {
                    $nex = $pageChoose + 1;
                    echo "<a href='QLTK.php?pageChoose=$nex'><i class='fa-solid fa-angles-right'></i></a>";
                }

                echo "<a href='QLTK.php?pageChoose=$page'>Last</a>";
            }
        }
        echo "</div>";

        $conn->close();
        ?>
    </div>

    <?php
    include ("../form/footer.php");
    ?>

</body>

</html>