<?php
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    $currentDate = date('Y-m-d');

    $truyvan = "SELECT * FROM danhsachtruyen WHERE ten = '$ten' AND taptruyen ='$taptruyen'";
    $thuchien = mysqli_query($conn, $truyvan);

    if ($thuchien) {
        if (mysqli_num_rows($thuchien) > 0) {
            echo "Sản phẩm đã tồn tại";
        } else {
            $sql = "INSERT INTO danhsachtruyen (ten, taptruyen, hinhanh, theloai, gia, ngay, soluongtonkho, tentacgia, dichgia, hoasi, xuatsu, series, mota)
            VALUES ('$ten', '$taptruyen', 'img/truyen/$hinhanh', '$theloai', '$gia', '$currentDate', '$soluongtonkho', '$tentacgia', '$dichgia','$hoasi','$xuatxu','$series','$mota')";

            if ($conn->query($sql) === TRUE) {
                // Đường dẫn tuyệt đối trên hệ thống tệp
                $target_dir = "D:/xampp/htdocs/project/LTWEB/CKI/img/truyen/";
                $target_file = $target_dir . $hinhanh;

                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    header("Location: QLSP.php?tbao=them_ok");
                } else {
                    header("Location: QLSP.php?tbao=them_ko");
                }
            } else {
                header("Location: QLSP.php?tbao=them_ko");
            }
        }
    } else {
        header("Location: QLSP.php?tbao=them_ko");
    }

    echo "<br><button onclick='window.history.back()'>Quay lại</button>";

    $conn->close();
}
exit();
?>