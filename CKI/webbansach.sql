-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 08, 2024 lúc 04:41 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbansach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id` int(11) NOT NULL,
  `mahoadon` text NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `tentruyen` varchar(255) NOT NULL,
  `taptruyen` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` float NOT NULL,
  `tongtien` int(11) NOT NULL,
  `ngay` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`id`, `mahoadon`, `taikhoan`, `tentruyen`, `taptruyen`, `soluong`, `gia`, `tongtien`, `ngay`) VALUES
(1, 'hd1', 'b', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 1, 10000, 10000, '2024-08-07 00:50:41'),
(2, 'hd2', 'b', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 1, 10000, 10000, '2024-08-07 00:51:09'),
(3, 'hd3', 'b', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 5, 10000, 50000, '2024-08-07 01:45:47'),
(4, 'hd4', 'b', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 2, 10000, 20000, '2024-08-07 13:50:47'),
(5, 'hd5', 'b', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 2, 10000, 20000, '2024-08-07 14:34:04'),
(8, 'hd6', 'c', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 2, 10000, 20000, '2024-08-07 20:30:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachtruyen`
--

CREATE TABLE `danhsachtruyen` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `taptruyen` varchar(255) NOT NULL,
  `hinhanh` text NOT NULL,
  `theloai` varchar(255) NOT NULL,
  `tentacgia` varchar(255) NOT NULL,
  `dichgia` varchar(255) NOT NULL,
  `hoasi` varchar(255) NOT NULL,
  `xuatsu` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `gia` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `soluongtonkho` int(11) NOT NULL,
  `soluongdaban` int(11) NOT NULL,
  `mota` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachtruyen`
--

INSERT INTO `danhsachtruyen` (`id`, `ten`, `taptruyen`, `hinhanh`, `theloai`, `tentacgia`, `dichgia`, `hoasi`, `xuatsu`, `series`, `gia`, `ngay`, `soluongtonkho`, `soluongdaban`, `mota`) VALUES
(1, 'Thanh Gươm Diệt Quỷ', 'Tập 11 - Hỗn Chiến', 'img/truyen/kimetsutap11.webp', 'Action', 'Koyoharu Gotouge', 'Hồng Trang', 'Abec', 'Việt Nam', 'Thanh Gươm Diệt Quỷ', 30800, '2024-08-07', 0, 0, 'Trận chiến với anh em quỷ Thượng huyền lục - Gyutaro và Daki - đã đến hồi cực kì gay cấn. Âm trụ và nhóm Tanjiro cùng phối hợp tấn công, nhưng Uzui, Inosuke và Zenitsu đã bị lưỡi liềm tàn độc của quỷ hạ gục. Giờ chỉ còn lại Tanjiro, liệu cậu có thể đánh bại 2 con quỷ hay không!?'),
(2, 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 'img/truyen/chuthuathoichientap11.webp', 'Action', 'Tác giả 1', 'Dịch giả 1', 'Họa sĩ 1', 'Nhật Bản', 'Series 1', 10000, '2024-08-06', 73, 99, 'Mô tả chi tiết cho sản phẩm 1'),
(3, 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 12: BIẾN CỐ SHIBUYA - GIÁNG LINH', 'img/truyen/chuthuathoichientap12.jpg', 'Action', 'Tác giả 2', 'Dịch giả 2', 'Họa sĩ 2', 'Nhật Bản', 'Series 2', 25000, '2024-08-06', 0, 0, 'Mô tả chi tiết cho sản phẩm 2'),
(4, 'Doraemon', 'Tập 9 - Nobita Và Nước Nhật Thời Nguyên Thủy (Tái Bản 2023)', 'img/truyen/doraemontap9.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 50800, '2024-08-07', 0, 0, 'NOBITA VÀ NƯỚC NHẬT THỜI NGUYÊN THỦY là tác phẩm đánh dấu 10 năm ra đời của xêri Doraemon truyện dài. Mỗi tác phẩm truyện dài là một câu chuyện phiêu lưu thần kì vô cùng lôi cuốn.\r\n\r\n'),
(5, 'DRAGON BALL SUPER', 'TẬP 1: CÁC CHIẾN BINH CỦA VŨ TRỤ THỨ 6', 'img/truyen/dragonballsupertap1.webp', 'Action', 'Tác giả 3', 'Dịch giả 3', 'Họa sĩ 3', 'Nhật Bản', 'Series 3', 25000, '2024-08-06', 0, 59, 'Mô tả chi tiết cho sản phẩm 3'),
(6, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 10: LỄ HỘI ĐÊM', 'img/truyen/chuthuathoichientap10.jpg', 'Action', 'Tác giả 4', 'Dịch giả 4', 'Họa sĩ 4', 'Nhật Bản', 'Series 4', 25000, '2024-08-06', 0, 0, 'Mô tả chi tiết cho sản phẩm 4'),
(7, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 17: NGẬM NGỌN CỎ LAU', 'img/truyen/chuthuathoichientap17.jpg', 'Manhwa', 'Tác giả 5', 'Dịch giả 5', 'Họa sĩ 5', 'Nhật Bản', 'Series 5', 50000, '2024-08-06', 12, 2, 'Mô tả chi tiết cho sản phẩm 5'),
(8, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 3: CÁ CON VÀ TRỪNG PHẠT NGƯỢC', 'img/truyen/chuthuathoichientap3.jpg', 'Action', 'Tác giả 6', 'Dịch giả 6', 'Họa sĩ 6', 'Nhật Bản', 'Series 6', 40000, '2024-08-06', 21, 69, 'Mô tả chi tiết cho sản phẩm 6'),
(9, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 14 - BIẾN CỐ SHIBUYA – ĐÚNG SAI', 'img/truyen/chuthuathoichientap14.jpg', 'Action', 'Tác giả 7', 'Dịch giả 7', 'Họa sĩ 7', 'Nhật Bản', 'Series 7', 19000, '2024-08-06', 0, 0, 'Mô tả chi tiết cho sản phẩm 7'),
(10, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 15: BIẾN CỐ SHIBUYA -BIẾN THÂN', 'img/truyen/chuthuathoichientap15.jpg', 'Action', 'Tác giả 8', 'Dịch giả 8', 'Họa sĩ 8', 'Nhật Bản', 'Series 8', 2000, '2024-08-06', 0, 0, 'Mô tả chi tiết cho sản phẩm 8'),
(11, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 16: BIẾN CỐ SHIBUYA -BẾ MÔN', 'img/truyen/chuthuathoichientap16.webp', 'Action', 'Tác giả 9', 'Dịch giả 9', 'Họa sĩ 9', 'Nhật Bản', 'Series 9', 20000, '2024-08-06', 9, 126, 'Mô tả chi tiết cho sản phẩm 9'),
(12, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 6: HẮC THIỂM', 'img/truyen/chuthuathoichientap6.jpg', 'Action', 'Tác giả 10', 'Dịch giả 10', 'Họa sĩ 10', 'Nhật Bản', 'Series 10', 25000, '2024-08-06', 12, 5, 'Mô tả chi tiết cho sản phẩm 10'),
(13, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 19: KẾT GIỚI TOKYO SỐ 1 -NGƯỜI ĐÀN ÔNG GIẬN DỮ', 'img/truyen/chuthuathoichientap19.webp', 'Action', 'Tác giả 11', 'Dịch giả 11', 'Họa sĩ 11', 'Nhật Bản', 'Series 11', 250000, '2024-08-06', 24, 6, 'Mô tả chi tiết cho sản phẩm 11'),
(14, 'SWORD ART ONLINE', 'Tập 7 PROGRESSIVE', 'img/truyen/saotap7.png', 'Action', 'Reki Kawahara', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 60800, '2024-08-07', 0, 0, 'Câu chuyện hiện đã đến tầng 7, vẫn là tầng từng trải nghiệm trong giai đoạn chạy thử của SAO, nói cách khác, cho đến đây, Kirito vẫn biết nhiều hiểu rộng hơn Asuna. Thành ra theo thói quen, vừa tới nơi Asuna đã lập tức hỏi cậu xem chỗ ăn chỗ chơi nào ngon. So với các lần trước, lần này Kirito tỏ ra ngần ngừ rõ rệt.'),
(15, 'SWORD ART ONLINE', 'Tập 8 PROGRESSIVE', 'img/truyen/saotap8.png', 'Action', 'Reki Kawahara', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 60800, '2024-08-07', 0, 0, 'Kirito, Asuna cùng nhóm công phá đã tới tầng 7. Theo dự tính lạc quan của Kirito thì với tốc độ hiện thời, cứ bảy ngày họ sẽ công phá được một tầng. Còn 93 tầng, theo lý thuyết là tầm mùa thu năm 2024 họ sẽ lên tới chóp Aincrad, đối mặt với trùm cuối chưa biết tên tuổi hình dáng đòn thế thế nào.'),
(16, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 18: NHIỆT', 'img/truyen/chuthuathoichientap18.webp', 'Action', 'Tác giả 12', 'Dịch giả 12', 'Họa sĩ 12', 'Nhật Bản', 'Series 12', 250000, '2024-08-06', 123, 12, 'Mô tả chi tiết cho sản phẩm 12'),
(17, 'Naruto', 'Naruto - Tập 53 - Naruto Ra Đời', 'img/truyen/Narutotap53.jpg', 'Action', 'Masashi Kishimoto', 'Hitokiri', 'Abec', 'Việt Nam', 'NARUTO', 19800, '2024-08-08', 0, 0, 'Để có được sức mạnh cửu vĩ, Naruto bắt đầu tập luyện trên hoang đảo thuộc làng Mây. Với sự hỗ trợ của B, Naruto đã giải trừ phong ấn nhưng lại bị chi phối bởi dã tâm ngập tràn của cửu vĩ. Tại cuộc đấu tranh trong tâm thức, cậu đã có cuộc gặp gỡ bất ngờ!!'),
(18, 'SWORD ART ONLINE', 'Tập 5 PROGRESSIVE', 'img/truyen/saotap5.png', 'Action', 'Reki Kawahara', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 50800, '2024-08-07', 0, 0, 'Sau cuộc chạm trán đầy hung hiểm với Người áo choàng đen, Kirito và Asuna đã công phá được tầng 5 Aincrad! “Phải luôn luôn có mặt ở nơi tôi nhìn thấy được, rõ chưa!” Do số phận đưa đẩy, hai người suốt ngày cặp kè bên nhau, và tiếp theo họ sẽ đối mặt với những thách thức phải huy động đến trí tuệ ở tầng 6. Ngoài ra còn phải giành lấy The Flag of Valor, một item có khả năng phá vỡ thế cân bằng cũng như mang tính uy hiếp với cả hai guild lớn. Dù gặp bao nhiêu vấn đề như vậy, hai người vẫn tiếp tục quest Lời nguyền Stachion ở tầng 6 mà không biết nguy h'),
(19, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 9: NGỌC CHIẾT', 'img/truyen/chuthuahoichientap9.jpg', 'Action', 'Tác giả 13', 'Dịch giả 13', 'Họa sĩ 13', 'Nhật Bản', 'Series 13', 19800, '2024-08-06', 0, 0, 'Mô tả chi tiết cho sản phẩm 13'),
(20, 'NARUTO', 'Naruto - Tập 68 - Lối Mòn', 'img/truyen/Narutotap68.jpg', 'Action', 'Masashi Kishimoto', 'Hitokiri', 'Abec', 'Việt Nam', 'NARUTO', 50800, '2024-08-08', 0, 0, 'Trước sức mạnh khủng khiếp của Obito, ý chí của Naruto đã liên kết và chặn đứng sự dao động trong lòng các binh sĩ Ninja!\r\nTrên mặt trận, Ngũ Kage và toàn quân cùng đoàn kết đương đầu với Thần thụ! Mặt khác, để ngăn cản “Tsukuyomi vô hạn” của Obito, Naruto và Sasuke đã quyết định bắt tay liên thủ!?'),
(21, 'NARUTO', 'Naruto - Tập 70 - Naruto & Lục Đạo Tiên Nhân', 'img/truyen/Narutotap70.jpg', 'Action', 'Masashi Kishimoto', 'Hitokiri', 'Abec', 'Việt Nam', 'NARUTO', 50800, '2024-08-07', 0, 0, 'Madara đã thâu tóm toàn bộ sức mạnh vĩ thú và có được năng lực Lục Đạo. Để đối đầu hắn, Guy triển khai “Tử Môn” cuối cùng trong Bát Môn Độn Giáp!\r\nTuyệt chiêu quyết tử theo nhẫn đạo của Guy có hiệu quả với Madara không!? Và trong lúc cận kề cái chết, Naruto đã có cuộc gặp gỡ với Lục Đạo Tiên Nhân ở thế giới trong tiềm thức của cậu!?'),
(22, 'NARUTO', 'Tập 28', 'img/truyen/NARUTOtap28.png', 'Action', 'Masashi Kishimoto', 'Hitokiri', 'Abec', 'Việt Nam', 'NARUTO', 40800, '2024-08-07', 0, 0, 'Naruto Uzumaki cùng thầy của mình, Jiraiya, trở về Làng Lá sau hai năm rưỡi huấn luyện khắc nghiệt.với Lục Đạo Tiên Nhân ở thế giới trong tiềm thức của cậu!?'),
(23, 'NARUTO', 'Tập 72', 'img/truyen/narutotap72.jpg', 'Action', 'Masashi Kishimoto', 'Hitokiri', 'Abec', 'Việt Nam', 'NARUTO', 49800, '2024-08-05', 0, 0, 'Trong lúc tất cả hân hoan vì phong ấn Kaguya thành công, tưởng chừng mọi sự đã kết thúc, Sasuke đột ngột gây náo loạn! Nhằm tháo bỏ mâu thuẫn dai dẳng bấy lâu, Naruto và Sasuke buộc phải quyết đấu! Trận thư hùng định đoạt mọi thứ giữa hai Ninja kiệt xuất chính thức bắt đầu!!'),
(24, 'SWORD ART ONLINE', 'Tập 15 ALICIZATION INVADING', 'img/truyen/saotap15.png', 'Romance', 'Reki Kawahara', 'Mỹ Trinh', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 60800, '2024-08-05', 0, 0, 'Alice đưa Kirito về lại làng Rulid. Bấy giờ cậu đã không còn ý chí gì nữa, vẻ mặt thì trống rỗng, người lại ngồi trên xe lăn.'),
(25, 'SWORD ART ONLINE', 'Tập 10 ALICIZATION RUNNING', 'img/truyen/saotap10.png', 'Action', 'Reki Kawahara', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 60800, '2024-08-07', 0, 0, 'Vào ngày phá đảo, có một người chưa kịp đi ra đã bị vợt vào trò chơi thực tế ảo của người thứ hai, nơi hàng trăm người khác bị đẩy vào một thí nghiệm vô nhân đạo về não bộ. Chuyện này xảy ra vào sáu năm nữa. May lần này không có ai chết.'),
(26, 'SWORD ART ONLINE', 'Tập 11 ALICIZATION TURNING', 'img/truyen/saotap11.png', 'Action', 'Reki Kawahara', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 60800, '2024-08-07', 0, 0, 'Kirito và Eugeo đã trở thành kiếm sinh ưu tú ở Học viện Kiếm thuật Đế quốc Bắc Centoria, hằng ngày chăm chỉ luyện tập để trở thành Hiệp sĩ Chỉnh hợp, gia nhập lực lượng giữ gìn trật tự mạnh nhất Nhân giới'),
(27, 'SWORD ART ONLINE', 'Tập 4 PROGRESSIVE', 'img/truyen/saotap4.png', 'Action', 'Reki Kawahara', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'SWORD ART ONLINE', 60800, '2024-08-07', 0, 0, 'Ở tập 4 này, với tiêu đề “Khúc Scherzo dưới hoàng hôn ảm đạm”, tác giả mang đến một bản nhạc lung linh vui vẻ (phản ánh quan hệ phát triển của hai nhân vật chính) nhưng lại vang lên vào thời khắc nhập nhoạng khó lường, vì guild PK hung tàn của PoH đã bắt đầu lộ diện cùng tà áo choàng poncho bí hiểm.'),
(28, 'Thám Tử Lừng Danh Conan', 'Tập 16 (Tái Bản 2023)', 'img/truyen/saotap4.png', 'Action', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Vụ án lần này đã khiến tớ thực sự gặp khó khăn...\r\nCó lẽ các bạn sẽ rất thích thú nhưng với tớ, hắn quả là một đối thủ đáng gờm...\r\nCuộc chiến phân thắng thua giữa một bên là siêu trộm và một bên là thám tử lừng danh đã bắt đầu!\r\nĐừng bỏ lỡ bất cứ tình huống nào trong truyện, các bạn nhé!!'),
(29, 'Thám Tử Lừng Danh Conan', 'Tập 97', 'img/truyen/conantap20.webp', 'Action', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan, Mori Kogoro, Amuro Toru, và Wakita Kanenori. Bộ tứ kì lạ ấy cùng nhau đi tới một nhà thờ bỏ hoang ẩn mình trong núi sâu ở Nagano.\r\n\r\nPhải chăng chờ đợi họ ở đó là án mạng và những mật mã bí ẩn!? Giữa lúc ấy, Conan cố gắng tìm kiếm gợi ý quan trọng liên quan tới chân tướng của “RUM” từ Amuro…!'),
(30, 'Thám Tử Lừng Danh Conan', 'Tập 20 (Tái Bản 2023)', 'img/truyen/conantap20.webp', 'Action', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Tòa nhà kiến trúc châu Âu đó làm chúng tớ dựng hết cả tóc gáy. Bất giác từ đằng sau, hình như là...!? Đừng nói là phá án, ngay cả đến tính mạng không biết tớ còn có thể giữ nổi không nữa đấy! Thế nhưng vào những lúc như thế này, người có thể tin tưởng được vẫn luôn là bạn bè thân thiết của tớ!!!'),
(31, 'Thám Tử Lừng Danh Conan', 'Tập 102 (Tái Bản 2023)', 'img/truyen/conantap102.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Jugo Yokomizo tình cờ gặp Chihaya Hagiwara tại bữa tiệc mai mối!\r\n\r\nĐiều gì hiện lên trong tâm trí Chihaya khi cô chăm chú nhìn Wataru Takagi!?\r\n\r\nChí nguyện “hoa anh đào” được tiếp nối qua bao thế hệ...\r\n\r\nVà...\r\n\r\nChẳng hề báo trước, tập truyện này sẽ mở ra những diễn biến đầy bất ngờ.'),
(32, 'Thám Tử Lừng Danh Conan', 'Tập 101 (Tái Bản 2023)', 'img/truyen/conantap11.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Jugo Yokomizo tình cờ gặp Chihaya Hagiwara tại bữa tiệc mai mối!\r\n\r\nĐiều gì hiện lên trong tâm trí Chihaya khi cô chăm chú nhìn Wataru Takagi!?\r\n\r\nChí nguyện “hoa anh đào” được tiếp nối qua bao thế hệ...\r\n\r\nVà...\r\n\r\nChẳng hề báo trước, tập truyện này sẽ mở ra những diễn biến đầy bất ngờ.'),
(33, 'Thám Tử Lừng Danh Conan', 'Tập 97 (Tái Bản 2023)', 'img/truyen/conantap977.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan, Mori Kogoro, Amuro Toru, và Wakita Kanenori. Bộ tứ kì lạ ấy cùng nhau đi tới một nhà thờ bỏ hoang ẩn mình trong núi sâu ở Nagano.\r\n\r\nPhải chăng chờ đợi họ ở đó là án mạng và những mật mã bí ẩn!? Giữa lúc ấy, Conan cố gắng tìm kiếm gợi ý quan trọng liên quan tới chân tướng của “RUM” từ Amuro…!'),
(34, 'Thám Tử Lừng Danh Conan', 'Tập 98 ', 'img/truyen/conantap98.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan, Mori Kogoro, Amuro Toru, và Wakita Kanenori. Bộ tứ kì lạ ấy cùng nhau đi tới một nhà thờ bỏ hoang ẩn mình trong núi sâu ở Nagano.\r\n\r\nPhải chăng chờ đợi họ ở đó là án mạng và những mật mã bí ẩn!? Giữa lúc ấy, Conan cố gắng tìm kiếm gợi ý quan trọng liên quan tới chân tướng của “RUM” từ Amuro…!'),
(35, 'Thám Tử Lừng Danh Conan', 'Tập 99', 'img/truyen/conantap99.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan, Mori Kogoro, Amuro Toru, và Wakita Kanenori. Bộ tứ kì lạ ấy cùng nhau đi tới một nhà thờ bỏ hoang ẩn mình trong núi sâu ở Nagano.\r\n\r\nPhải chăng chờ đợi họ ở đó là án mạng và những mật mã bí ẩn!? Giữa lúc ấy, Conan cố gắng tìm kiếm gợi ý quan trọng liên quan tới chân tướng của “RUM” từ Amuro…!'),
(36, 'Thám Tử Lừng Danh Conan', 'Tập 96', 'img/truyen/conantap96.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan, Mori Kogoro, Amuro Toru, và Wakita Kanenori. Bộ tứ kì lạ ấy cùng nhau đi tới một nhà thờ bỏ hoang ẩn mình trong núi sâu ở Nagano.\r\n\r\nPhải chăng chờ đợi họ ở đó là án mạng và những mật mã bí ẩn!? Giữa lúc ấy, Conan cố gắng tìm kiếm gợi ý quan trọng liên quan tới chân tướng của “RUM” từ Amuro…!'),
(37, 'Thám Tử Lừng Danh Conan', 'Tập 93', 'img/truyen/conantap93.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan và Heiji tình cờ gặp án mạng ở tiệm cà phê Poirot!!\r\n\r\nHọ cùng Amuro bắt tay vào điều tra vụ án, nhưng chuyện gì sẽ xảy ra…!?\r\n\r\nTrong khi đó, nhân vật gợi liên tưởng tới RUM – thân cận của “người đó” đã xuất hiện trước mặt nhóm thám tử nhí…!?'),
(38, 'Thám Tử Lừng Danh Conan', 'Tập 94', 'img/truyen/conantap94.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Conan và Heiji tình cờ gặp án mạng ở tiệm cà phê Poirot!!\r\n\r\nHọ cùng Amuro bắt tay vào điều tra vụ án, nhưng chuyện gì sẽ xảy ra…!?\r\n\r\nTrong khi đó, nhân vật gợi liên tưởng tới RUM – thân cận của “người đó” đã xuất hiện trước mặt nhóm thám tử nhí…!?'),
(39, 'Thám Tử Lừng Danh Conan', 'Tập 95', 'img/truyen/conantap95.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Tạm thời trở lại là “Shinichi”, Conan cùng Ran và các bạn tham gia chuyến du lịch ngoại khóa tới Kyoto!\r\n\r\n... Nhưng một loạt án mạng đã liên tiếp xảy ra!?\r\n\r\nVà bí ẩn lớn nhất của “Thám tử lừng danh Conan”, danh tính Boss của “Tổ chức Áo Đen” sắp được tiết lộ!?'),
(40, 'Thám Tử Lừng Danh Conan', 'Tập 89', 'img/truyen/conantap89.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 70800, '2024-08-07', 0, 0, 'Tạm thời trở lại là “Shinichi”, Conan cùng Ran và các bạn tham gia chuyến du lịch ngoại khóa tới Kyoto!\r\n\r\n... Nhưng một loạt án mạng đã liên tiếp xảy ra!?\r\n\r\nVà bí ẩn lớn nhất của “Thám tử lừng danh Conan”, danh tính Boss của “Tổ chức Áo Đen” sắp được tiết lộ!?'),
(41, 'Thám Tử Lừng Danh Conan', 'Tập 91', 'img/truyen/conantap91.webp', 'Comedy', 'Gosho Aoyama', 'Nguyệt Quế', 'Abec', 'Việt Nam', 'CONAN', 80800, '2024-08-07', 0, 0, 'Conan và Heiji vạch mặt Nue… Kid chạm trán Okiya!! Thiếu nữ Kyoto xinh đẹp đang theo đuổi Heiji, và cô giáo hậu đậu đầy góc khuất… những phụ nữ bí ẩn sẽ thay phiên nhau xuất hiện ở tập này…!?'),
(42, 'Doraemon', 'Tập 20 - Nobita Và Truyền Thuyết Vua Mặt Trời (Tái Bản 2023)', 'img/truyen/doraemontap20.webp', 'Comedy', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 80800, '2024-08-07', 0, 0, 'Mỗi tập truyện là một cuộc phưu lưu khám phá những chân trời mới lạ. Hãy để trí tưởng tượng của bạn bay bổng cùng nhóm bạn Doraemon, Nobita, Shizuka, Jaian, Suneo đến các vùng đất xa xôi, kì bí và cảm nhận những khoảnh khắc tình bạn tươi đẹp của cuộc đời!'),
(43, 'Doraemon', 'Nobita Và Chuyến Du Hành Biển Phương Nam - Tập 2 (Tái Bản 2023)', 'img/truyen/doraemontap2.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 80800, '2024-08-07', 0, 0, 'Nhóm bạn Doraemon đã lên thuyền đi tìm kho báu, giong buồm ra khơi, tiến về đảo châu báu. Tuy nhiên, biến cố bất thường ở siêu không gian đã làm họ lạc vào thế kỉ 17. Không những thế, Nobita còn bị lạc nhóm, rơi tòm xuống biển sâu. Bối cảnh của câu chuyện được diễn ra trên một hòn đảo trơ trọi ở vùng biển phương nam, với những cái bẫy đáng sợ giăng khắp nơi cũng như các loài yêu ma quỷ quái. Ngoài ra còn có sự góp mặt của rất nhiều khách mời đặc biệt như chú cá heo kì lạ và nhóm hải tặc nữa đấy.'),
(44, 'Doraemon', 'Nobita Và Cuộc Phiêu Lưu Ở Thành Phố Dây Cót - Tập 1', 'img/truyen/doraemontap1.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 80800, '2024-08-07', 0, 0, 'Là tác phẩm thứ 18 trong loạt phim hoạt hình nổi tiếng \"Doraemon\" của tác giả Fujiko.F.Fujio (được công chiếu vào mùa xuân năm 1997). Nhóm bạn Doraemon đã tạo ra thành phố của những thú nhồi bông biết cử động ở một tiểu hành tinh xanh tươi. Thành phố phát triển rất nhanh, nhưng hình như có ẩn chứa một bí mật lạ lùng. Phải chăng kẻ xấu đã xâm nhập vào thành phố...!?'),
(45, 'Doraemon', 'Tập 11 - Nobita Và Hành Tinh Muông Thú', 'img/truyen/doraemontap11.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 80800, '2024-08-07', 0, 0, 'Nobita và Hành tinh muông thú là tác phẩm thứ 11 trong loạt phim hoạt hình Doraemon rấtđược yêu thích, chuyển thể từ nguyên tác truyện tranh của tác giả FUJIKO F FUJIO (bộ phim được công chiếu vào mùa xuân năm 1990).'),
(46, 'Doraemon', 'Tập 12 - Nobita Ở Xứ Sở Nghìn Lẻ Một Đêm', 'img/truyen/doraemontap12.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 50800, '2024-08-07', 0, 0, 'Nobita Ở Xứ Sở Nghìn Lẻ Một Đêm là tác phẩm thứ 12 trong loạt phim hoạt hình Doraemon rất được yêu thích, chuyển thể từ nguyên tác truyện tranh của tác giả FUJIKO F FUJIO (Bộ phim được công chiếu vào mùa xuân năm 1991).'),
(47, 'Doraemon', ' Tập 13 - Nobita Và Vương Quốc Trên Mây', 'img/truyen/doraemontap13.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 50800, '2024-08-07', 0, 0, 'Nobita Ở Xứ Sở Nghìn Lẻ Một Đêm là tác phẩm thứ 12 trong loạt phim hoạt hình Doraemon rất được yêu thích, chuyển thể từ nguyên tác truyện tranh của tác giả FUJIKO F FUJIO (Bộ phim được công chiếu vào mùa xuân năm 1991).'),
(48, 'Doraemon', 'Tập 14 - Nobita Và Mê Cung Thiếc', 'img/truyen/doraemontap14.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 50800, '2024-08-07', 0, 0, 'Nobita và mê cung thiếc là tác phẩm thứ 14 trong loạt phim hoạt hình Doraemon rất được yêu thích, chuyển thể từ nguyên tác truyện tranh của tác giả FUJIKO F FUJIO (Bộ phim được công chiếu vào mùa xuân năm 1993).'),
(49, 'Doraemon', 'Tập 10 - Nobita Và Hành Tinh Muông Thú', 'img/truyen/doraemontap10.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 50800, '2024-08-07', 0, 0, 'Lần này, nhóm bạn Nobita đã phiêu lưu tới một hành tinh cổ tích. Những gì đang chờ đợi nhóm bạn ở thế giới kì diệu ấy?... Mời tất cả các em cùng dõi theo hành trình đầy mạo hiểm này!'),
(50, 'Doraemon', 'Tập 6 - Nobita Và Cuộc Chiến Vũ Trụ (Tái Bản 2023)', 'img/truyen/doraemontap6.webp', 'Action', 'Fujiko F Fujio', 'Hồng Trang', 'Abec', 'Việt Nam', 'Doraemon', 50800, '2024-08-07', 0, 0, 'Các em đang cầm trên tay nguyên tác của bộ phim hoạt hình NOBITA VÀ CUỘC CHIẾN VŨ TRỤ được công chiếu vào mùa xuân năm 1985, đây là tác phẩm thứ 6 trong xêri Doraemon truyện dài.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanhthu`
--

CREATE TABLE `doanhthu` (
  `id` int(11) NOT NULL,
  `mahoadon` text NOT NULL,
  `taikhoan` varchar(50) NOT NULL,
  `thanhtien` float NOT NULL,
  `ngaymua` datetime NOT NULL,
  `trangthai` int(11) NOT NULL,
  `danhan` int(11) NOT NULL,
  `phuongthucthanhtoan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `doanhthu`
--

INSERT INTO `doanhthu` (`id`, `mahoadon`, `taikhoan`, `thanhtien`, `ngaymua`, `trangthai`, `danhan`, `phuongthucthanhtoan`) VALUES
(1, 'hd1', 'b', 25500, '2024-08-07 00:50:41', 1, 2, 'Thanh toán khi nhận hàng'),
(2, 'hd2', 'b', 31000, '2024-08-07 00:51:09', 1, 2, 'Thanh toán khi nhận hàng'),
(3, 'hd3', 'b', 71000, '2024-08-07 01:45:47', 1, 3, 'Thanh toán khi nhận hàng'),
(4, 'hd4', 'b', 41000, '2024-08-07 13:50:47', 1, 2, 'Thanh toán khi nhận hàng'),
(5, 'hd5', 'b', 41000, '2024-08-07 14:34:04', 1, 2, 'Thanh toán khi nhận hàng'),
(8, 'hd6', 'c', 41000, '2024-08-07 20:30:51', 1, 1, 'Thanh toán khi nhận hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `tentruyen` text NOT NULL,
  `taptruyen` varchar(255) NOT NULL,
  `hinhanh` text NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` float NOT NULL,
  `thanhtien` float NOT NULL,
  `ngaythem` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`id`, `taikhoan`, `tentruyen`, `taptruyen`, `hinhanh`, `soluong`, `gia`, `thanhtien`, `ngaythem`) VALUES
(97, 'b', 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 'img/truyen/chuthuathoichientap11.webp', 2, 10000, 20000, '2024-08-08 08:24:31'),
(98, 'b', 'SWORD ART ONLINE', 'Tập 15 ALICIZATION INVADING', 'img/truyen/saotap15.png', 1, 60800, 60800, '2024-08-08 08:39:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `ho` varchar(255) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `matkhau` varchar(55) NOT NULL,
  `loai` int(2) NOT NULL,
  `sdt` text NOT NULL,
  `diachi` text NOT NULL,
  `tinh` varchar(255) NOT NULL,
  `huyen` varchar(255) NOT NULL,
  `xa` varchar(255) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `ho`, `ten`, `taikhoan`, `matkhau`, `loai`, `sdt`, `diachi`, `tinh`, `huyen`, `xa`, `email`) VALUES
(1, 'Huỳnh Thịnh', 'Phát', 'admin', '1', 0, '375204556', 'xóm 7 - Phú Kim', 'Tỉnh Bình Định', 'Huyện Phù Cát', 'Xã Cát Trinh', ''),
(2, 'rt', 'rt', 'rt', 'rt', 1, '', '', '', '', '', ''),
(3, 'Anh ', 'Tài', 'tai123', '123', 1, '', '', '', '', '', ''),
(4, 'Trương Thị', 'Thanh Tâm', 'tam123', 'thanhtam132', 1, '', '', '', '', '', ''),
(5, 'Quốc', 'Việt', 'vietngu', '1230897145', 1, '', '', '', '', '', ''),
(14, 'b', 'b', 'b', 'b', 1, '0375204558', 'abc', 'Tỉnh Hà Giang', 'Thành phố Hà Giang', 'Phường Quang Trung', 'b@b'),
(25, 'Tâm', 'Xinh Đẹp', 'gicungduoc', 'gicungduocluon', 1, '3132', '123', '', '', '', '12312@ga'),
(26, 'c', 'c', 'c', 'c', 1, '09', 'xóm 7 - Phú Kim', 'Tỉnh Hà Giang', 'Huyện Quản Bạ', 'Xã Thanh Vân', ''),
(27, 'cc', 'cc', 'cc', 'cc', 1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id` int(11) NOT NULL,
  `theloai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id`, `theloai`) VALUES
(1, 'Action'),
(2, 'Arts'),
(3, 'Cổ Đại'),
(4, 'Hiện Đại'),
(5, 'Historical\r\n'),
(6, 'Horror'),
(7, 'Huyền Nguyễn'),
(8, 'Kiếm Hiệp'),
(9, 'Quân Sự'),
(10, 'Romance'),
(11, 'School Life'),
(12, 'Truyện Teen'),
(13, 'Xuyên Không'),
(14, 'Comedy'),
(15, 'Manga'),
(16, 'Manhua'),
(17, 'Manhwa'),
(18, 'Hài Hước'),
(19, 'One Shot'),
(20, 'Phiêu lưu\r\n'),
(21, 'Truyện Màu');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhsachtruyen`
--
ALTER TABLE `danhsachtruyen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `doanhthu`
--
ALTER TABLE `doanhthu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `danhsachtruyen`
--
ALTER TABLE `danhsachtruyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `doanhthu`
--
ALTER TABLE `doanhthu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
