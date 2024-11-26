<?php
include_once('connect.php');

$sql = "SELECT * FROM danhsachtruyen";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='truyen'>";
        echo "<img src='../" . htmlspecialchars($row['hinhanh']) . "' alt='" . htmlspecialchars($row['ten']) . "' />";
        echo "<h3>" . htmlspecialchars($row['ten']) . "</h3>";
        echo "<p>Tập: " . htmlspecialchars($row['taptruyen']) . "</p>";
        echo "<p>Thể loại: " . htmlspecialchars($row['theloai']) . "</p>";
        echo "<p>Giá: " . htmlspecialchars($row['gia']) . " VND</p>";
        echo "<p>Ngày: " . htmlspecialchars($row['ngay']) . "</p>";
        echo "<p>Số lượng tồn kho: " . htmlspecialchars($row['soluongtonkho']) . "</p>";
        echo "<p>Số lượng đã bán: " . htmlspecialchars($row['soluongdaban']) . "</p>";
        // echo "<form action='giohang.php' method='post'>";
        // echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "' />";
        // echo "<input type='hidden' name='ten' value='" . htmlspecialchars($row['ten']) . "' />";
        // echo "<input type='hidden' name='gia' value='" . htmlspecialchars($row['gia']) . "' />";
        // Thay thế ô nhập số lượng bằng giá trị cố định (1)
        // echo "<input type='hidden' name='soluong' value='1' />";
        echo "<a href='giohang.php?id=".$row['id']."'><button type='submit'>Thêm vào giỏ hàng</button></a>";
        // echo "</form>";
        echo "</div>";
    }
} else {
    echo "Không có truyện nào.";
}

mysqli_close($conn);
?>
