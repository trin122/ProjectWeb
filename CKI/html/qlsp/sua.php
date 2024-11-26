<!DOCTYPE html>
<html>

<head>
    <title>Sửa Truyện</title>
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <style>
        * {
            font-family: arial;
        }

        h2 {
            text-align: center;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        form {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="file"],
        form input[type="number"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #000000;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }
    </style>
</head>

<body>

    <h2>Sửa Truyện</h2>

    <?php
    include 'ketnoi.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM danhsachtruyen WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            ?>

            <form action="sua.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                Tên: <input type="text" name="ten" value="<?php echo $row['ten']; ?>"><br>
                Tập truyện: <input type="text" name="taptruyen" value="<?php echo $row['taptruyen']; ?>"><br>
                Hình ảnh: <input type="file" name="hinhanh" id="hinhanh"><br>
                Thể loại:
                <select name="theloai">
                    <?php
                    $truyvan_theloai = "SELECT * FROM theloai";
                    $thuchien_theloai = mysqli_query($conn, $truyvan_theloai);

                    if ($thuchien_theloai) {
                        while ($row_theloai = mysqli_fetch_array($thuchien_theloai)) {
                            // Xác định giá trị cần được chọn
                            $selected = ($row_theloai['theloai'] == $row['theloai']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $row_theloai['theloai']; ?>" <?php echo $selected; ?>>
                                <?php echo $row_theloai['theloai']; ?>
                            </option>
                            <?php
                        }
                    } else {
                        echo " " . $conn->error;
                    }
                    ?>
                </select><br>
                Giá: <input type="text" name="gia" value="<?php echo $row['gia']; ?>"><br>
                Số lượng tồn kho: <input type="number" name="soluongtonkho" value="<?php echo $row['soluongtonkho']; ?>"><br>
                Tên tác giả: <input type="text" name="tentacgia" value="<?php echo $row['tentacgia']; ?>"><br>
                Dịch giả: <input type="text" name="dichgia" value="<?php echo $row['dichgia']; ?>"><br>
                Họa sĩ: <input type="text" name="hoasi" value="<?php echo $row['hoasi']; ?>"><br>
                Xuất xứ: <input type="text" name="xuatxu" value="<?php echo $row['xuatsu']; ?>"><br>
                Series: <input type="text" name="series" value="<?php echo $row['series']; ?>"><br>
                Mô tả: <input type="text" name="mota" value="<?php echo $row['mota']; ?>"><br>
                <input type="submit" name="sua" value="Sửa Truyện">
            </form>

            <?php
        } else {
            echo "Không tìm thấy truyện.";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sua'])) {
        $id_sua = $_POST['id'];
        $ten = $_POST['ten'];
        $taptruyen = $_POST['taptruyen'];
        $theloai = $_POST['theloai'];
        $gia = $_POST['gia'];
        $soluongtonkho = $_POST['soluongtonkho'];
        $tentacgia = $_POST['tentacgia'];
        $dichgia = $_POST['dichgia'];
        $hoasi = $_POST['hoasi'];
        $xuatxu = $_POST['xuatxu'];
        $series = $_POST['series'];
        $mota = $_POST['mota'];
        $hinhanh = basename($_FILES["hinhanh"]["name"]);

        if (!$hinhanh) {
            $sql = "UPDATE danhsachtruyen
            SET ten='$ten', 
                taptruyen='$taptruyen', 
                theloai='$theloai', 
                gia='$gia', 
                soluongtonkho='$soluongtonkho', 
                tentacgia = '$tentacgia', 
                dichgia = '$dichgia',
                hoasi = '$hoasi',
                xuatsu = '$xuatxu',
                series = '$series',
                mota = '$mota'
            WHERE id = '$id_sua'";
        } else {
            $sql = "UPDATE danhsachtruyen
            SET ten='$ten', 
                taptruyen='$taptruyen', 
                theloai='$theloai', 
                gia='$gia', 
                hinhanh='img/truyen/$hinhanh', 
                soluongtonkho='$soluongtonkho', 
                tentacgia = '$tentacgia', 
                dichgia = '$dichgia',
                hoasi = '$hoasi',
                xuatsu = '$xuatxu',
                series = '$series',
                mota = '$mota'
            WHERE id = '$id_sua'";
        }

        if ($conn->query($sql) === TRUE) {
            if ($hinhanh) {
                // Đường dẫn tuyệt đối trên hệ thống tệp
                $target_dir = "D:/xampp/htdocs/project/LTWEB/CKI/img/truyen/";
                $target_file = $target_dir . $hinhanh;

                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    header("Location: QLSP.php?tbao=sua_ok");
                } else {
                    header("Location: QLSP.php?tbao=sua_ko");
                }
            } else {
                header("Location: QLSP.php?tbao=sua_ok");
            }
        } else {
            header("Location: QLSP.php?tbao=sua_ko");
        }

        $conn->close();
        exit();
    }
    ?>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
    })
</script>

</html>