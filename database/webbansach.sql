-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2024 at 12:27 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbansach`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adusername` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adpassword` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adusername`, `adpassword`) VALUES
(1, 'admin1', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `machitiet` int NOT NULL AUTO_INCREMENT,
  `madonhang` int NOT NULL,
  `masach` int NOT NULL,
  `soluongdat` int NOT NULL,
  `tonggia` decimal(10,0) NOT NULL,
  PRIMARY KEY (`machitiet`),
  KEY `fk_chitiet_sach` (`masach`),
  KEY `fk_chitiet_donhang` (`madonhang`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`machitiet`, `madonhang`, `masach`, `soluongdat`, `tonggia`) VALUES
(1, 1, 2, 3, 300000),
(2, 1, 4, 2, 200000),
(3, 2, 9, 4, 400000),
(4, 2, 3, 8, 800000),
(5, 3, 7, 14, 1400000),
(6, 4, 4, 1, 100000),
(7, 4, 2, 1, 100000),
(11, 8, 16, 1, 299000),
(12, 8, 7, 1, 100000),
(13, 8, 18, 1, 150000),
(14, 8, 17, 1, 200000),
(15, 8, 19, 1, 50000),
(16, 9, 5, 1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `madonhang` int NOT NULL AUTO_INCREMENT,
  `tennguoinhan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diachinhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdtnguoinhan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailnguoinhan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuongthucthanhtoan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Thanh toán khi nhận hàng (COD)',
  `trangthai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Đang xử lý',
  PRIMARY KEY (`madonhang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madonhang`, `tennguoinhan`, `diachinhan`, `sdtnguoinhan`, `emailnguoinhan`, `phuongthucthanhtoan`, `trangthai`) VALUES
(1, 'lê chinh', 'quận tân bình', '0898671245', 'lechinhhh3107@gmail.com', 'Thanh toán khi nhận hàng (COD)', 'Đang xử lý'),
(2, 'lưu ánh phương', 'quận thủ đức', '0123456789', 'lechinhhh3107@gmail.com', 'Chuyển khoản ngân hàng', 'Đang vận chuyển'),
(3, 'phú khang', 'quận thủ đức', '0111111111', 'junjun123clone@gmail.com', 'Thanh toán khi nhận hàng (COD)', 'Đang xử lý'),
(4, 'hoàng hữu lê chinh', 'quận thủ đức', '123456789', 'lechinhhh3107@gmail.com', 'Chuyển khoản ngân hàng', 'Đã xử lý'),
(5, 'lê chinh', 'quận thủ đức', '0898671245', 'lechinhhh3107@gmail.com', 'Thanh toán khi nhận hàng (COD)', 'Đang vận chuyển'),
(8, 'lê chinh', 'quận 1', '0898671245', 'lechinhhh3107@gmail.com', 'Thanh toán khi nhận hàng (COD)', 'Đã giao'),
(9, 'thai hung', 'quận 1', '0898671245', 'lechinhhh3107@gmail.com', 'Chuyển khoản ngân hàng', 'Đang xử lý');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `makhachhang` int NOT NULL AUTO_INCREMENT,
  `tenkhachhang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`makhachhang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makhachhang`, `tenkhachhang`, `username`, `password`) VALUES
(1, 'lê chinh', 'lechinh3107', '123456'),
(2, 'lê chinh', 'lechinh123456', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

DROP TABLE IF EXISTS `sach`;
CREATE TABLE IF NOT EXISTS `sach` (
  `masach` int NOT NULL,
  `matheloai` int NOT NULL,
  `matacgia` int NOT NULL,
  `tensach` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,0) NOT NULL,
  `soluong` int NOT NULL,
  PRIMARY KEY (`masach`),
  KEY `fk_sach_theloai` (`matheloai`),
  KEY `fk_sach_tacgia` (`matacgia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`masach`, `matheloai`, `matacgia`, `tensach`, `image`, `mota`, `gia`, `soluong`) VALUES
(1, 1, 1, 'Lolita', '/image/lolita.jpg', 'Lolita là một tiểu thuyết của Vladimir Vladimirovich Nabokov. Tiểu thuyết được viết bằng tiếng Anh và được xuất bản vào năm 1955 ở Paris, sau đó được chính tác giả dịch ra tiếng Nga và được xuất bản vào năm 1967 ở New York. Tiểu thuyết nổi tiếng cả ở phong cách mới lạ lẫn nội dung gây ra các tranh cãi do nhân vật chính của tiểu thuyết tên Humbert Humbert, một người khá lớn tuổi luôn mang trong mình ham muốn tình dục với một cô gái 12 tuổi tên Dolores Haze.', 100000, 10),
(2, 1, 2, 'Rừng Na-Uy', '/image/nauy.jpg', 'Rừng Na-Uy là tiểu thuyết của nhà văn Nhật Bản Murakami Haruki, được xuất bản lần đầu năm 1987. Với thủ pháp dòng ý thức, cốt truyện diễn tiến trong dòng hồi tưởng của nhân vật chính là chàng sinh viên bình thường Watanabe Tōru. Cậu ta đã trải qua nhiều cuộc tình chớp nhoáng với nhiều cô gái trẻ ưa tự do. Nhưng cậu ta cũng có những mối tình sâu nặng với Naoko, người yêu của người bạn thân nhất của cậu, một cô gái không ổn định về cảm xúc, và với Midori, một cô gái thẳng thắn và hoạt bát. Các nhân vật trong truyện hầu hết là những con người cô đơn móc nối với nhau. Có những nhân vật đã phải tìm đến cái chết để mãi mãi giải thoát khỏi nỗi đau đớn ấy. Tác phẩm này đã đưa Murakami lên thành một trong những nhà văn hàng đầu của Nhật Bản.', 100000, 10),
(3, 1, 2, 'Kafka bên bờ biển', '/image/kafka.jpg', 'Kafka bên bờ biển là tiểu thuyết tiếng Nhật phát hành năm 2002 của nhà văn Murakami Haruki. Bản dịch tiếng Anh của tác phẩm được vinh danh trong danh sách \"10 cuốn sách hay nhất năm 2005\" của tờ The New York Times và nhận giải thưởng World Fantasy Award năm 2006. Sự xuất sắc của tác phẩm này đã giúp ông được trao giải thưởng văn học Franz Kafka năm 2006. Bản dịch tiếng Việt của Dương Tường được hoàn tất và đưa ra công chúng trong năm 2007.\r\nTiểu thuyết kể về câu chuyện của cậu bé Kafka Tamura, một đứa trẻ mọt sách 15 tuổi bỏ nhà ra đi vì phức cảm Oedipus, và Satoru Nakata, một ông già khuyết tật biết nói chuyện với mèo. Cuốn sách thể hiện âm nhạc như một liên kết giao tiếp, một thực thể siêu hình, giấc mơ, số phận và tiềm thức.', 100000, 20),
(4, 1, 3, 'Hỏa ngục', '/image/hoa-nguc.jpg', 'Hỏa ngục là một tiểu thuyết của tác giả người Mỹ Dan Brown, cuốn sách thứ tư trong loạt tiểu thuyết Robert Langdon của ông, sau Thiên thần và ác quỷ, Mật mã Da Vinci và Biểu tượng thất truyền. Cuốn sách được xuất bản vào ngày 14 tháng 5 năm 2013 bởi nhà xuất bản Doubleday và đã trở thành ấn phẩm bán chạy nhất trên danh sách New York Times Best Seller đối với tiểu thuyết bìa cứng và tiểu thuyết e-book, lần lượt trong vòng 11 và 17 tuần kể từ khi ra mắt.', 100000, 15),
(5, 1, 4, 'Pet Sematary', '/image/pet.jpg', 'Hai lần được chuyển thể thành phim (1989 và 2019). Pet Sematary bản 1989 được đánh giá là một trong những phim kinh dị \"Cult Culture\" (những bộ phim không được giới phê bình đánh giá cao, không có doanh thu lớn, không được công chúng yêu thích, nhưng được một nhóm nhỏ yêu thích cuồng nhiệt). Nhận được tận 6,6 điểm trên IMDb, có số lượng DVD bán ra rất chạy, và được nhắc đến nhiều trong các bộ phim khác. Đây là một trong những tiểu thuyết kinh dị xuất sắc và mang tính biểu tượng nhất của Stephen King.\r\n“Hoang dại, rùng rợn và gây bấn loạn” là những tính từ mà tờ The Washington Post Book World đã dùng để miêu tả về cuốn sách bán chạy số 1 theo bình chọn của New York Times này.', 100000, 8),
(6, 1, 2, 'Giết chỉ huy đội kỵ sĩ', '/image/gchdks.jpg', 'Giết chỉ huy đội kỵ sỹ là tiểu thuyết ra mắt năm 2017 của tác giả người Nhật Bản Haruki Murakami. Tiểu thuyết được phát hành lần đầu dưới dạng 2 phần riêng biệt gồm –Ý tưởng xuất hiện và Ẩn dụ dịch chuyển bởi đơn vị phát hành Shinchosha tại Nhật Bản ngày 24 tháng 02 năm 2017. Bản dịch tiếng Anh do Philip Gabriel và Ted Goossen được phát hành dưới dạng một cuốn tiểu thuyết hoàn chỉnh dài 704 trang vào ngày 9 tháng 10 năm 2018 bởi đơn vị phát hành Alfred A. Knopf tại Hoa Kỳ và Harvill Secker tại Anh Quốc.\r\nBên phát hành sách cho biết 1.3 triệu bản in được lên kế hoạch cho lần in đầu tiên tại Nhật.', 100000, 22),
(7, 1, 3, 'Mật mã Da Vinci', '/image/da-vinci.jpg', 'Mật mã Da Vinci là một tiểu thuyết của nhà văn người Mỹ Dan Brown được xuất bản năm 2003 bởi nhà xuất bản Doubleday Fiction. Đây là một trong số các quyển sách bán chạy nhất thế giới với trên 40 triệu quyển được bán ra (tính đến tháng 3 năm 2006), và đã được dịch ra 44 ngôn ngữ.\r\nCốt truyện của tiểu thuyết kể về âm mưu của Giáo hội Công giáo nhằm che giấu sự thật về Chúa Giê-su. Truyện ám chỉ rằng Tòa thánh Roma biết rõ âm mưu này từ hai ngàn năm qua, nhưng vẫn giấu kín để giữ vững quyền lực của mình. Sau khi vừa xuất bản, cuốn tiểu thuyết đã khơi dậy mạnh mẽ sự tò mò khắp thế giới đi tìm hiểu sự thật về Sự tích Chén Thánh, và vai trò của Mary Magdalene trong lịch sử Giáo hội Công giáo.', 100000, 19),
(8, 1, 3, 'Thiên thần và Ác quỷ', '/image/tt-va-aq.jpg', 'Thiên thần và ác quỷ là tiểu thuyết khoa học giả tưởng được xuất bản lần đầu năm 2000 do nhà văn Mỹ Dan Brown, tác giả của Mật mã Da Vinci, Pháo đài số, Điểm dối lừa sáng tác. Câu chuyện xoay quanh nhân vật chính Robert Langdon - nhân vật chính trong các tiểu thuyết của Dan Brown trong đó có Mật mã Da Vinci. Giống như các tác phẩm khác của mình, Dan Brown đã thể hiện trong tiểu thuyết Thiên thần và ác quỷ sự kết hợp giữa truyện trinh thám, các tình huống giải mã bất ngờ và sự lôi cuốn trong vấn đề tôn giáo - đặc biệt là về Công giáo Rôma và Hội kín Illuminati.', 100000, 7),
(9, 1, 5, 'Và rồi chẳng còn ai', '/image/agatha1.jpg', 'Là một tiểu thuyết trinh thám của nhà văn người Anh Agatha Christie. Lần đầu tiên tác phẩm được xuất bản tại Vương quốc Anh bởi Collins Crime Club vào ngày 6 tháng 11 năm 1939, với tên gọi Ten Little Niggers, theo tên một bài hát của một nghệ sĩ hát rong năm 1869 đóng vai trò là yếu tố chính của cốt truyện. Phiên bản Hoa Kỳ được phát hành vào tháng 1 năm 1940 với tựa đề And Then There Were None, lấy từ năm từ cuối của bài hát.\r\nCuốn sách là tiểu thuyết bí ẩn bán chạy nhất thế giới và với hơn 100 triệu bản được bán ra, đây là một trong những cuốn sách bán chạy nhất mọi thời đại. Cuốn tiểu thuyết này được liệt kê là tựa sách bán chạy thứ bảy (bất kỳ ngôn ngữ nào, bao gồm cả các tác phẩm tham khảo) mọi thời đại.', 100000, 12),
(10, 1, 5, 'Vụ án trên chuyến tàu tốc hành phương đông', '/image/agatha2.jpg', 'Án mạng trên chuyến tàu tốc hành Phương Đông là một tiểu thuyết hình sự của nhà văn Agatha Christie được nhà xuất bản Collins Crime Club phát hành lần đầu tại Anh ngày 1 tháng 1 năm 1934. Tại Hoa Kỳ cuốn này được nhà xuất bản Dodd, Mead and Company phát hành lần đầu cũng vào năm 1934 dưới tựa đề Murder in the Calais Coach (Án mạng trên toa xe Calais). Tác phẩm nói về vụ án mạng kỳ lạ xảy ra trên chuyến tàu tốc hành Phương Đông chạy từ Istanbul về Calais mà thám tử Hercule Poirot tình cờ có mặt. Đây được coi là một trong những tiểu thuyết nổi tiếng nhất của Agatha Christie và nó đã hai lần được chuyển thể thành phim và một video game.', 100000, 10),
(11, 3, 7, '1 Thắng 9 Bại', '/image/1thang9bai.jpg', 'Nêu bật triết lý kinh doanh của Uniqlo, Uniqlo xem trọng điều gì để có thể phát triển từ một công ty may nhỏ lẻ thành tập đoàn sản xuất bán lẻ sánh ngang các doanh nghiệp lớn khác trên thế giới như hiện nay.\r\nCuốn sách cũng chỉ ra điểm yếu của các doanh nghiệp Nhật Bản thua trên thương trường thế giới vì đã không phân tích những nguyên nhân dẫn đến thất bại nhỏ. Ông Tadashi Yanai nhấn mạnh sự quan trọng của việc phân tích nguyên nhân thất bại, từ đó suy nghĩ thấu đáo cho chiến lược tiếp theo.\r\nÔng cũng đề cập đến tỷ lệ 1 thắng 9 bại. Vấn đề quan trọng là phát hiện ra những nguy cơ thất bại ngay từ giai đoạn trứng nước để mau chóng loại bỏ hoặc điều chỉnh.\r\n', 50000, 5),
(12, 3, 8, 'Cách những công ty lớn nhất thế giới sinh tồn', '/image/congty.jpg', 'Cuốn sách xoay quanh cách những công ty - cụ thể là những CEO của những công ty hàng đầu thế giới - đưa ra những quyết định và hành động để lèo lái doanh nghiệp vượt qua một nền kinh tế liên tục biến động, từ khi COVID-19 chỉ là một tin tức phong thanh cho đến lúc khủng hoảng cao trào rồi chuyển sang giai đoạn hồi phục.\r\nLiz Hoffman là phóng viên kinh tế cấp cao của The Wall Street Journal từ năm 2013, chuyên tìm kiếm đưa tin về các thương vụ sáp nhập và mua bán lớn trên thị trường. Bà còn có loạt bài trang nhất về đầu tư ngân hàng, tài chính, và gần đây là ảnh hưởng của đại dịch lên thị trường và nền kinh tế', 85000, 8),
(13, 2, 6, 'Tiệm sách của nàng', '/image/tiemsachcuanang.jpg', 'Bối cảnh là một tiệm sách tại thành phố hiện đại. Nhân vật “anh” xuất hiện trong câu chuyện tình cảm lãng mạn, ở đó có nắng ấm êm, có mưa thành dòng để thả thuyền giấy, những câu thoại vu vơ chỉ hai người mới hiểu, với “một chút hân hoan, một chút dỗi hờn…”\r\nNhưng tràn ngập gần 300 trang sách là ký ức về tuổi trưởng thành ngày ấy ở vùng quê miền Trung. Quá khứ và hiện tại mang màu sắc vui buồn trái ngược, khiến cuốn sách có một hấp dẫn khác biệt.\r\nSự vô tình của con người nhiều khi mang tính ác, nhất là khi dưới vỏ những câu chọc ghẹo trêu đùa dai dẳng. Có những chuyện khốc liệt, vô trách nhiệm, ích kỷ của chính người lớn đã bắt trẻ con phải gánh chịu. Có những đứa trẻ đã trở nên ưa gây gổ, ương bướng, bất cần khi cuộc đời chúng sa vào bi thương, bất hạnh.\r\n…Câu chuyện chất chứa nhiều cảm xúc, đặc biệt bất ngờ qua những nỗi niềm chưa thể gửi trao của cậu thiếu niên từng nổi tiếng ngang ngược và hung hãn dành cho người bạn gái cậu yêu. Tuổi thơ bị đánh cắp, bị “tra tấn tinh thần”, cuộc sống trở nên bấp bênh, nhưng may thay, sự tử tế và tình yêu thương kỳ diệu đã hóa giải lòng hận khô cứng, cuốn trôi đi sự ngạo ngược, chỉ còn lại sự mạnh mẽ với tâm hồn trong sạch, lòng tin vào nhân ái và sự bao dung dịu dàng.\r\n', 99000, 3),
(14, 2, 9, 'Chúng ta sống để bước tiếp', '/image/song.jpg', 'Chúng ta sống để bước tiếp là hành trình tiếp nối Chúng ta sống để lắng nghe. Nghe để hiểu mình, hiểu người, hiểu những hữu hạn và vô định, hiểu những được và mất… Và để bước tiếp.\r\nVì rằng ai trong chúng ta rồi cũng đi đến điểm cuối hành trình – mà ở điểm cuối đó, theo Phong Việt, mọi vui buồn hờn giận, mọi mất mát đau thương, mọi vui cười hạnh phúc, đều chẳng còn ý nghĩa gì nữa. Vậy chúng ta cứ sống, và bước tiếp, bằng mọi nỗ lực hôm nay của mình, để mỗi ngày trôi qua đều thật tròn vẹn – dù chỉ là với chính mình.\r\nMột tập tản văn nhẹ nhàng, nhắc nhở chúng ta hãy trân trọng mỗi thời khắc còn hiện diện, và trân trọng chính sự hiện diện của mình ở đời này\r\n“Vì chúng ta được làm người và vì chúng ta đã đến…\r\nChúng ta sẽ bước tiếp!”\r\n', 72000, 17),
(15, 2, 10, 'Cái chết của bầy ong', '/image/ong.jpg', 'Văn của Hữu Vi nhẹ nhàng, tươi mới, tạo ấn tượng núi non đủ độ, không cố tình uốn giọng ngọng nghịu cho ra vẻ “miền núi”. Một tập hợp truyện ngắn ở đây chạm đến các vấn đề phong tục và thời cuộc, giữa nếp cũ và những đổi thay hiện đại, giữa miền ngược và miền xuôi, giữa cảnh bình yên và sự xáo trộn khi núi non cũng chịu ảnh hưởng của đại dịch... Không có gì gay cấn, mọi nút thắt đều được gỡ ra từ tốn, có khi hơi đơn giản. Những điều đơn giản ấy có thể lại làm cho người ta vương vấn.\r\n\"Một tâm hồn trong trẻo chân thật in đậm trong những bài thơ trang sách của Hữu Vi. Một giọng trầm của người Thái cất lên giữa núi rừng miền tây Nghệ An.\" - Nhà văn Hồ Anh Thái\r\n', 85000, 5),
(16, 3, 11, 'Tại sao các quốc gia thất bại', '/image/quocgia.jpg', 'Sử dụng lịch sử Đông-Tây kim-cổ đã diễn ra trên tất cả các châu lục của trái đất này, hai tác giả lập luận rằng những quốc gia thất bại là những đất nước bị cai trị bởi một nhóm quyền thế tập trung, và những nhóm này đã tổ chức xã hội để phục vụ cho quyền lợi riêng của họ trong khi đại đa số quần chúng nhân dân phải trả giá. Thế lực chính trị bị tập trung trong một nhóm nhỏ, được sử dụng để tạo ra tài sản khổng lồ cho những người nắm giữ quyền lực.\r\nTrong khi đó, những nước trở nên giàu có là vì người dân nước đó lật đổ giới quyền thế, những người kiểm soát quyền lực, và tạo ra một xã hội trong đó các quyền chính trị được phân phối rộng rãi, trong đó chính phủ có trách nhiệm giải trình và phải đáp ứng trước công dân, và trong đó đại đa số quần chúng có thể tranh thủ các cơ hội kinh tế.\r\n\r\n', 299000, 15),
(17, 3, 12, 'Kệ hàng trống', '/image/kehang.jpg', 'Khủng hoảng chuỗi cung ứng đang đến hồi khốc liệt. Những sản phẩm bạn yêu thích không còn xuất hiện trên kệ hàng nữa: nó còn đang mắc kẹt đâu đó giữa Thái Bình Dương. Tình trạng gián đoạn chuỗi cung ứng này sẽ thế nào trong sáu tháng, hay thậm chí là ba năm nữa? Chúng ta vẫn kỳ vọng rằng các hành động phục hồi kinh tế và đời sống sau dịch bệnh sẽ giúp tháo gỡ các vấn đề này, nhưng thực tế là tiền số và mạng xã hội sẽ chẳng thể giải quyết được các vấn đề muôn thuở trong việc vận chuyển hàng hóa xuyên đại dương từ châu lục này đến châu lục khác. Theo James Rickards, sự bất mãn của người tiêu dùng trước tình trạng thiếu thốn hàng hóa chỉ là phần chóp của một tảng băng vô cùng lớn đang đe dọa nền kinh tế toàn cầu.\r\nTrong Kệ hàng trống, Rickards chia sẻ những dự đoán của bản thân ông về một nền kinh tế mới sau dịch bệnh, đồng thời chỉ cách cho người tiêu dùng và chủ doanh nghiệp đón đầu những khủng hoảng sắp tới. ', 200000, 15),
(18, 3, 13, 'Quản trị Inamori', '/image/inamori.jpg', 'Quản trị Inamori là hệ thống quản trị  tạo ra lợi nhuận cao trong suốt nửa thế kỷ bất kể biến động thị trường. Được ông Inamori sáng tạo từ những kinh nghiệm quản trị thực tiễn của mình là quản trị công ty theo hình thức đồng quản trị, trong đó chia tổ chức lớn thành các tập thể nhỏ để vận hành thu chi độc lập, phân cấp trách nhiệm điều hành cho tổ chức đó. Trong quản trị amoeba, việc quản trị được giao cho từng lãnh đạo của công ty con. Lãnh đạo công ty con có trách nhiệm lên kế hoạch và thực hiện kế hoạch của mình. Do vậy, trong quản trị amoeba, công ty mẹ có thể nuôi dưỡng một nhà lãnh đạo trẻ tràn đầy sức sáng tạo dù kinh nghiệm của họ còn ít ỏi. Nhà quản lý là trung tâm, nhưng các thành viên góp phần tạo nên amoeba tự lập mục tiêu của chính mình và nỗ lực tối đa để đạt được mục tiêu ở từng cương vị. Kết quả là tất cả đều tập trung sức lực hướng đến mục tiêu của cá nhân nói riêng và mục tiêu của tập thể nói chung, từ đó hiện thực hóa phương cách “quản trị mà mọi người đều tham gia”, tạo thêm tính năng động cho doanh nghiệp, nhất là doanh nghiệp lớn. ', 150000, 6),
(19, 3, 14, 'Tâm lý học tích cực trong bán hàng', '/image/banhang.jpg', 'Sợ hãi khiến hầu hết nhân viên bán hàng không thích nhấc điện thoại gọi cho khách hàng.\r\nSợ hãi là lý do chúng ta không đề nghị làm ăn nhiều hơn, không chào thêm các sản phẩm và dịch vụ khác, mặc dù khách hàng muốn mua của chúng ta.\r\nCuốn sách này đề cập đến những nỗi sợ hãi đó.\r\nBạn sẽ học được đúng cách vượt qua nỗi sợ hãi — sát thủ “diệt” doanh số — và thay bằng sự tự tin, lạc quan, lòng biết ơn, niềm vui và chủ động trong công việc bán hàng. Đây là cuốn sách đầu tiên vận dụng tâm lý học tích cực để biến đổi cách chúng ta làm việc giúp bạn bán được nhiều hơn.\r\n', 50000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

DROP TABLE IF EXISTS `tacgia`;
CREATE TABLE IF NOT EXISTS `tacgia` (
  `matacgia` int NOT NULL,
  `tentacgia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`matacgia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`matacgia`, `tentacgia`) VALUES
(1, 'Vladimir Vladimirovich Nabokov'),
(2, 'Haruki Murakami'),
(3, 'Dan Brown'),
(4, 'Stephen King'),
(5, 'Agatha Christie'),
(6, 'Nguyễn Nhật Ánh'),
(7, 'Tadashi Yanai'),
(8, 'Liz Hoffman'),
(9, 'Nguyễn Phong Việt'),
(10, 'Hữu Vi'),
(11, 'Daron Acemoglu'),
(12, 'James Rickards'),
(13, 'Amoeba Keiei'),
(14, 'Alex Goldfayn');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

DROP TABLE IF EXISTS `theloai`;
CREATE TABLE IF NOT EXISTS `theloai` (
  `matheloai` int NOT NULL,
  `tentheloai` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`matheloai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`matheloai`, `tentheloai`) VALUES
(1, 'Tiểu thuyết'),
(2, 'Văn học'),
(3, 'Kinh tế');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `fk_chitiet_donhang` FOREIGN KEY (`madonhang`) REFERENCES `donhang` (`madonhang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_chitiet_sach` FOREIGN KEY (`masach`) REFERENCES `sach` (`masach`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `fk_sach_tacgia` FOREIGN KEY (`matacgia`) REFERENCES `tacgia` (`matacgia`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_sach_theloai` FOREIGN KEY (`matheloai`) REFERENCES `theloai` (`matheloai`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
