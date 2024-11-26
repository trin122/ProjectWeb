<?php
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $hinhanh = " ";

    if ($id) {
        $truyvan = "SELECT * FROM danhsachtruyen WHERE id = '$id'";
        $thuchien = mysqli_query($conn, $truyvan);

        if ($thuchien) {
            while ($row = mysqli_fetch_array($thuchien)) {
                $hinhanh = "D:/xampp/htdocs/project/LTWEB/CKI/$row[hinhanh]";

                $sql = "DELETE FROM danhsachtruyen WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    if (file_exists($hinhanh)) { // Kiểm tra xem file có tồn tại không
                        if (unlink($hinhanh)) {
                            header("Location: QLSP.php?tbao=xoa_ok");
                        } else {
                            header("Location: QLSP.php?tbao=xoa_ktxa");
                        }
                    } else {
                        header("Location: QLSP.php?tbao=xoa_aktt");
                    }
                } else {
                    header("Location: QLSP.php?tbao=xoa_ko");
                }
            }
        }
        $conn->close();
    }
}
exit();
?>