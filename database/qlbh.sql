-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2023 lúc 11:15 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlbh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Dụng cụ nhà bếp'),
(2, 'Ngoài trời & sân vườn'),
(3, 'Đồ dùng phòng ăn'),
(4, 'Dụng cụ vệ sinh'),
(5, 'Thiết bị điện tử'),
(6, 'Sửa chữa nhà cửa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `role`) VALUES
(3, 'Michael', 'Johnson', 'michaeljohnson@example.com', '5555555555', 'anhtrung', 2),
(4, 'Emily', 'Davis', 'emilydavis@example.com', '1111111111', 'anhtrung', 2),
(5, 'Samuel', 'Wilson', 'samuelwilson@example.com', '9999999999', 'anhtrung123', 2),
(12, 'trung', 'hoàng', 'admin@gmail.com', '2', '1', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_name`) VALUES
(1, 'Công ty của Trung\r\n'),
(2, 'Công ty Mạnh\r\n'),
(3, 'Công ty Quốc Anh\r\n'),
(4, 'Công ty Anh Trung'),
(5, 'Công ty Anh Mạnh'),
(6, 'Công ty Trung Mạnh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`payment_id`, `customer_id`, `product_id`, `cart_id`, `amount`, `status`, `quantity`) VALUES
(49, 11, 11, NULL, 2000.00, 'Thành công', 2),
(50, 11, 11, NULL, 6000.00, 'Thành công', 6),
(51, 11, 12, NULL, 3000.00, 'Thành công', 3),
(52, 11, 10, NULL, 2000000.00, 'Thành công', 2),
(53, 11, 15, NULL, 99999999.99, 'Thành công', 3),
(54, 12, 23, NULL, 3000.00, 'Thành công', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `manufacturer_id`, `image_url`) VALUES
(25, 'Bộ dao nhà bếp cao cấp nhật bản 5 món có kèm giá đựng dao', 'Bộ dao inox 5 món Nhật Bản', 235000.00, 1, 'https://salt.tikicdn.com/cache/525x525/ts/product/c3/d3/0a/68154b413838199fd24203a9a7a6a8e9.jpg'),
(26, 'Ấm đun nước Inox 304 Elmich 3L EL3373 dùng bếp từ', 'ẤM ĐUN NƯỚC INOX 304 ELMICH 3L EL3373 DÙNG BẾP TỪ  Mã sản phẩm: EL-3373 Elmich Cộng Hoà Séc Chất liệu: Inox 304, Tay cầm silicon cách nhiệt Màu sắc: Bạc Kích thước hộp: 21 x 21 x 23 (cm) Trọng lượng: 1kg Dung tích: 3 Lít', 639000.00, 1, 'https://salt.tikicdn.com/cache/525x525/ts/product/17/54/88/5f9103ba3301957221a1d44e2c1bab70.jpg'),
(27, 'Hộp Thuỷ Tinh Lock And Lock Loại Lớn 1000 Ml/1400 Ml. Hộp Thuỷ Tinh Chịu Nhiệt Lock And Lock 1000Ml/', 'MÔ TẢ SẢN PHẨM  Hộp thuỷ tinh 1 ngăn Lock and Lock 1000ml/1400ml  - Hàng Lock and lock.  - Dung tích: Chữ nhật 1000ml, Vuông 1400ml  - Kích thước: Chữ nhật 1000ml: 19cm x 14.5cm x 7cm, Vuông 1400ml:  - Các cạnh có quai gài và ron cao su đậy kín thực phẩm và hạn chế tối đa tràn nước.  - Hộp được làm từ thuỷ tinh cao cấp, chịu nhiệt được tối đa 400• nên hộp có thể sử dụng được tốt trong lò vi sóng và lò nướng.', 129000.00, 1, 'https://sg-live-01.slatic.net/p/60531b524e13a6fabdd863246b45c414.jpg_525x525q80.jpg'),
(28, 'KÉO CẮT THỰC PHẨM TƯƠI SỐNG ĐA NẰNG NỘI ĐỊA NHẬT', 'Kéo Cắt Cành Cộng Lực Lưỡi Thép SK5 được nhập khẩu từ Nhật Bản với lưỡi thép SK5 đúc nguyên khối siêu bền và sắc bén, kiểu dáng thiết kế hiện đại. Là dụng cụ chuyên dụng không thể thiếu trong nhà bếp của bạn, giúp công việc bếp núc như cắt gà, cắt vịt, trở nên nhẹ nhàng và đơn giản hơn!', 28000.00, 1, 'https://salt.tikicdn.com/cache/525x525/ts/product/1b/87/f9/c54555373bb2a0ab44fb844225e05eed.jpg'),
(29, 'Bếp nướng than hoa cao cấp kèm vỉ nướng Flamme', 'Tên sản phẩm: Bếp nướng than hoa  Kích thước: 35 x 27 x 20 cm  Kích thước đóng gói: 36x26x7cm  Chất liệu: thép + inox chống gỉ  Bộ sản phẩm bao gồm:  - 01 thân bếp hình hộp vuông có quai xách  - 01 vỉ thép thanh ngang đỡ than  - 01 vỉ thép đựng đồ nướng  - 04 chân đỡ bếp có khả năng gấp lại  - Hộp đựng bếp bằng giấy bìa cứng.', 79000.00, 1, 'https://salt.tikicdn.com/cache/525x525/ts/product/52/7e/9e/98ce0db91d0f68091cabfc80610b7955.jpg'),
(30, 'Thớt Inox 304 Kháng Khuẩn Cừờng Lực', 'Thớt inox dùng để kê và thái đồ thực phẩm cho mỗi bữa ăn hoặc kê thái hoa quả, lăn bột, nhào bánh… Thớt inox Chất liệu Inox 304 kháng khuẩn, không gỉ sét, an toàn với thực phẩm Không lo ẩm mốc, dễ dàng vệ sinh, siêu bền đẹp cùng thời gian, không bị xước dăm, ăn mòn như Thớt gỗ, thớt nhựa Thớt inox nhẵn nhưng có độ bám nhất định nên dễ vệ sinh sạch sẽ, kháng khuẩn, không ra mủm như thớt gỗ, đảm bảo vệ sinh và tiệt trùng tuyệt đối Thớt inox mỏng nhưng nặng đảm bảo độ đầm Thớt inox thoải mái sử dụng không sợ bị rơi võ như thớt kính. Bề mặt inox có độ lì nhất định nên khi cắt thái không bị trơn như thớt kính. Thớt inox siêu bền ko sợ bị tưa dăm, mốc như thớt gỗ hay thớt nhựa Inox 304 tiêu chuẩn mềm dẻo hơn dao nên hạn chế được cùn dao, mẻ dao.', 78398.00, 1, 'https://salt.tikicdn.com/cache/525x525/ts/product/33/72/4c/574af9d6f3b41c3e4d85e2bd44ecd511.jpg'),
(31, 'Bộ dụng cụ cuốc xẻng làm vườn trồng cây mini ', 'Thiết kế xinh xắn, nhỏ gọn Cứng cáp, bền khỏe, cán chống trơn trượt Phù hợp làm vườn phố Giúp đất tơi xốp một cách dễ dàng,tạo môi trường thông thoáng cho cây phát triển Tha hồ đào , xới, trộn , xúc với 4 dụng cụ trọng bộ sản phẩm Sơn tĩnh điện Thiết kế xinh xắn, nhỏ gọn. Cứng cáp, bền khỏe, cán chống trơn trượt. Phù hợp làm vườn phố. Giúp đất tơi xốp một cách dễ dàng,tạo môi trường thông thoáng cho cây phát triển. Tha hồ đào , xới, trộn , xúc với 4 dụng cụ trọng bộ sản phẩm. Sơn tĩnh điện', 65000.00, 2, 'https://salt.tikicdn.com/cache/525x525/ts/product/5e/7b/1c/44d01e0816645953f1a82a1d9b173d88.JPG'),
(32, 'BÌNH TƯỚI CÂY PHUN SƯƠNG TH GARDEN DẠNG XỊT ĐỂ BÀN 400ML', '️ Dung tích: 400ml  ️ Nhựa PP bền bỉ, an toàn  ️ Điều chỉnh được dòng nước thành tia, chùm hoặc sương  ️ Tay cầm êm ái  ️ Kích thước: nặng 74gr, cao 21cm, đường kính đáy 8cm', 35000.00, 2, 'https://salt.tikicdn.com/cache/525x525/ts/product/fb/54/92/f9e9d256c05885cc62ab136c0e6b3b43.jpg'),
(33, 'ĐẾ GỖ VUÔNG LÓT CHẬU ĐA NĂNG - CÓ GẮN BÁNH XE', 'ĐẾ GỖ VUÔNG LÓT CHẬU ĐA NĂNG - MITUHOME - CÓ GẮN BÁNH XE, TẢI TRỌNG 80KG  Kích thước : 30x30x10  Trọng lượng :1.3kg  Sản xuất tại Việt Nam', 195000.00, 2, 'https://salt.tikicdn.com/cache/525x525/ts/product/99/c6/36/495bc97bb24db76e9905d10af2a5da36.jpg'),
(34, 'LƯỚI THÁI, LÀM GIÀN DÂY LEO,TRỒNG NHO,TRỒNG DƯA', 'Lưới có độ bền cao (độ bền cam kết trên 5 năm). Dùng làm giàn leo nho , bí , dưa leo . Quy cách đa dạng phù hợp với diện tích đất trồng nhỏ lẫn quy mô lớn Sản phẩm có làm viền và vị trí móc neo giàn vào khung nên rất dễ sử dụng và rất bền Làm giàn leo su su; nho leo; hoa hồng leo; hoa trang leo; giàn bầu; giàn bí; giàn mướp. Dễ dàn sử dụng; độ bền cao; thân thiện môi trường; giúp không gian sống xanh sạch; màu xanh dễ chịu; xoa tan căng thẳng. Tạo nguồn rau xanh sạch cho cả gia đình.', 85500.00, 2, 'https://salt.tikicdn.com/cache/525x525/ts/product/37/33/e3/4a69bda8b458a26dc6e83c0cff3a7ba6.jpg'),
(35, 'Vỉ gỗ nhựa lót sàn ban công', 'Vỉ gỗ nhựa là sự kết hợp vô cùng độc đáo bởi mặt trên là những thanh gỗ nhựa được bắt vít với mặt dưới là lớp đế vỉ nhựa nguyên chất tạo thành Tấm. Tấm vỉ gỗ nhựa được thiết kế sẵn các chốt kết nối, ghép lại với nhau tạo không gian tự nhiên, đẹp như mong muốn. Kích thước: 30x30 cm Chất liệu: Nhựa Composite 1 met vuông tương đương 11 vỉ', 50000.00, 2, 'https://salt.tikicdn.com/cache/525x525/ts/product/97/2c/5c/bb11b0dbba205806142a98e6ba341eda.jpg'),
(36, 'Chậu Nhựa Trồng Cây Tròn Cao - Hoa Văn Chiếc Lá', 'Chậu Nhựa Trồng Cây Tròn Cao - Hoa Văn Chiếc Lá - Rất Dày Không Sợ Mưa Nắng (Kt: 210x240) Chậu Nhựa Trắng Cực kỳ dày Giả Sứ Hoa Văn Chiếc Lá Bền Chắc, Rất Đẹp Và Trang Nhã, Phù Hợp Trồng Hoa Kiểng, Cây Ăn Trái Kích Thước Nhỏ: Đường Kính 250 x Cao 340 x Đáy 170mm', 59000.00, 2, 'https://sg-live-01.slatic.net/p/5ca8252864ed238688ed8c287a8fdcd6.jpg_525x525q80.jpg'),
(37, 'Bộ Đũa Thìa Dĩa Inox, Hộp Đựng Lúa Mạch', 'Bộ Đũa Thìa Dĩa Inox, Hộp Đựng Lúa Mạch, Nhiều Màu Lựa Chọn, Tặng Kèm Ống Hút Tre Bộ sản phẩm gồm 3 món: đũa, thìa, dĩa. Chất liệu: inox cao cấp Cán đũa, thìa, dĩa được sơn phủ lớp màu cao cấp, sang trọng, không trầy màu, lớp sơn chắc chắn, màu pastel tươi trẻ. Kiểu dáng thìa bầu tròn, dễ sử dụng khi ăn uống. Bề mặt được sơn lớp bóng, tráng gương sáng đẹp Thích hợp dùng tại nhà hoặc mang theo đi làm văn phòng, đi chơi, picnic Hộp đựng được làm bằng lúa mach, an toàn khi dùng và thân thiện với môi trường.', 89000.00, 3, 'https://salt.tikicdn.com/cache/525x525/ts/product/43/bb/ef/b3654b52d4d354bdbc50bdc5dc081158.jpg'),
(38, 'Hộp đũa nội địa Nhật', 'Bộ gồm 5 đôi đũa inox đặc ruột, cầm đầm tay và rất chắc chắn. Phần đầu có khía giúp chống trơn. Phần gắp là vuông, đầu gắp tròn, phần đầu cầm hình vuông.', 137361.00, 3, 'https://salt.tikicdn.com/cache/525x525/ts/product/3f/86/9b/c58dd5ccea6fea266afdcdf10ad3341d.jpg'),
(39, 'Bộ 4 chén sứ Spriing', 'Không có mô tả', 235000.00, 3, 'https://sg-live-01.slatic.net/p/81131d2dd51d4ddfa9c4c56d9a1ea81d.jpg_525x525q80.jpg'),
(40, 'Bộ 4 đĩa sứ Miyabi nhập khẩu Nhật Bản 16.5cm MB02/4-TM', 'Sản phẩm bát đĩa sứ từ Nhật Bản xưa nay luôn được ưa chuộng và tin dùng tại hầu hết các quốc gia trên thế giới, do có thiết kế sắc sảo,tinh tế, độ chịu lực, chịu nhiệt tốt, thân thiện với môi trường, vượt xa các loại sản phẩm khác. - Thương hiệu sứ Nhật Bản Miyabi nổi tiếng với chất liệu hoàn toàn không tạp chất (không phát hiện hàm lượng chì và cadimi trong sản phẩm), nguyên liệu được gia công dưới sự giám sát nghiêm ngặt từ các nghệ nhân. Không độc hại, kháng nhiệt tốt, khó bể vỡ với bề mặt sứ dày, được sử dụng rộng rãi trong các khách sạn và nhà hàng lớn tại Nhật Bản và Hàn Quốc .', 309000.00, 3, 'https://cf.shopee.vn/file/5f2765904f45459d86673c6b739feb77'),
(41, 'Thố sứ Minh Long cao cấp', 'Không có mô tả', 159000.00, 3, 'https://filebroker-cdn.lazada.vn/kf/S59c9ee94ec564feba21e9996e539a5c4B.jpg_525x525q80.jpg'),
(42, 'ộ 6 Ly Thủy Tinh Bầu Lùn Uống Trà', 'Sản phẩm thủy tinh gia dụng bền đẹp, sang trọng. Bộ 6 ly thủy tinh uống trà Sản phẩm này dùng cho gia đình, nhà hàng hay dùng làm quà tặng khuyến mãi Khách hàng có thể ghép bộ để làm quà tặng Bền đẹp, dễ lau chùi và tuyệt đối an toàn với sức khỏe người sử dụng. Sản phẩm giao đi được Shop bọc 2 lớp xốp giảm chấn. Bộ ly uống trà:- Gồm 6c/hộp- Kích thước: 75*80mm- Dung tích: 175ml/c- Màu sắc: Trắng, trong', 51035.00, 3, 'https://sg-live-01.slatic.net/p/8576ee05631ae09bf5ea6cbc865228e9.jpg_525x525q80.jpg'),
(43, 'Túi Li Lông Đựng Rác Tự Phân Hủy (Set 15 Túi)', 'Không có mô tả', 14300.00, 4, 'https://salt.tikicdn.com/cache/525x525/ts/product/32/bb/75/21a6ca0da5f3e0df4f99d616248d708e.jpg'),
(44, 'Bọt biển bàn chải chà cọ rửa đa năng có tay cầm vệ sinh', 'Bọt biển bàn chải chà cọ rửa đa năng có tay cầm vệ sinh nhà bếp phòng tắm bồn rửa bề mặt  – Kích thước : 9cm x 15cm x 6.5 cm – Màu sắc : ngẫu nhiên  – Trọng lượng : 150g', 18000.00, 4, 'https://salt.tikicdn.com/cache/525x525/ts/product/85/75/b9/44891746f082c8d7cef2256a1c7c79a0.jpg'),
(45, 'Thùng Đựng Rác Văn Phòng Tiện Lợi, Thông Minh Nắp Lật', 'Ưu Điểm Sản Phẩm:  + Nắp lật linh hoạt và tiện ích.  + Dễ dàng vệ sinh.  + Thiết kế tinh tế, màu sắc sang trọng.  + Có 3 size dễ dàng lựa chọn cho nhu cầu sử sụng.  + Nắp bật có lò xo nhanh chóng đưa về vị trí ban đầu.  + Phù hợp với không gian sống hiện đại.', 139000.00, 4, 'https://salt.tikicdn.com/cache/525x525/ts/product/f9/fc/9b/9c8e1772c9d566ff5ca03003be8b9c9a.jpg'),
(46, 'Cây lau nhà tự vắt thông minh, lau 360 độ, sàn nhà sạch khô nhanh Parroti Pro PR01', 'Cây lau nhà thông minh tự vắt Parroti với khả năng lau sạch sàn nhà một cách nhanh chóng và nhẹ nhàng, phù hợp với mọi loại bề mặt sàn như sàn gạch, sàn gỗ, sàn đá, tường ốp gạch và mặt kính, phù hợp với mọi không gian và diện tích nhà ở, bộ cây lau nhà Parroti được thiết kế thông minh và cực kỳ gọn gàng giúp tiết kiệm không gian bảo quản đặc biệt là nhà chung cư hoặc các căn nhà có không gian hạn chế.', 371900.00, 4, 'https://cf.shopee.vn/file/vn-11134207-7qukw-lj2aj53h3aaa95'),
(47, 'Bộ 2 cây lau nhà 360 độ, thân inox lớn, SHOME S1LMN', 'CẤU TẠO: + Thân cây lau được làm bằng inox chắc chắn, hạn chế bị ăn mòn và chống gỉ sét khi phải tiếp xúc thường xuyên với nước hay nhiệt độ, cho thời gian sử dụng lâu dài + Đầu lau được tích hợp khả năng xoay 360°, giúp bạn dễ dàng lau chùi được nhiều vị trí khác nhau như: góc tủ, chân bàn, ghế, giường ngủ + Khả năng xoay 360° của cây lau còn giúp sản phẩm có thể sử dụng chung với các thùng đựng có rổ xoay ly tâm, giúp vắt nước nhanh chóng mỗi khi lau nhà + Trục giặt với thiết kế bi ngược cải tiến, giúp xoay nhẹ nhàng hơn khi giặt. + bông lau siêu thấm hút, tĩnh điện giúp hút các vụn bụi, tóc, rác nhỏ .. sản phẩm bảo hành 3 tháng.', 159000.00, 4, 'https://cf.shopee.vn/file/85c2c7b7e1de6441f0bd73684ae172c5'),
(48, 'Khăn lau bếp đa năng lau tay bát đĩa chất liệu vải bông mềm và thấm nước', 'Thông tin sản phẩm khăn lau tay nhà bếp :  – Tên sản phẩm : Khăn lau tay nhà bếp siêu thấm nước  – Chất liệu: Cotton.  – Màu sắc: Tím, xanh, nâu,  – Kích thước: chiều dài 43cm.  – Xuất xứ: Việt Nam', 15000.00, 4, 'https://salt.tikicdn.com/cache/525x525/ts/product/74/e8/65/2613fbe489765b65cb71fc419859aded.jpg'),
(49, 'Máy giặt Aqua 8.8 KG AQW-FR88GT.BK', 'Với kháng sinh kháng khuẩn ABT, mâm giặt được phun một dung dịch đặc biệt, kháng khuẩn đến 99,99% và ngăn nấm mốc phát triển bên trong lồng giặt. Bảo vệ sức khỏe toàn diện cho người sử dụng. Sản phẩm thích hợp cho các gia đình có con nhỏ, người dễ bị kích ứng với vi khuẩn, bụi bẩn.', 4990000.00, 5, 'https://cdn.tgdd.vn/Products/Images/1944/242732/Slider/242732-1020x570.jpg'),
(50, 'Nồi chiên không dầu AVA 55K07A 5.5 lít ', 'Lưu ý khi sử dụng:  - Không cho quá nhiều nguyên liệu vào nồi chiên không dầu, quá trình chế biến có thể kéo dài, thức ăn không chín đều.  - Đặt thăng bằng trên bàn, kệ bếp, không đặt ở vị trí có độ dốc, dễ đổ, ngã.  - Làm sạch với khăn vải/miếng bọt biển mềm để tránh làm trầy xước lớp chống dính của lòng nồi.  Nồi chiên không dầu AVA 55K07A 5.5 lít của thương hiệu AVA uy tín, sản xuất tại Trung Quốc, sử dụng chiên nướng thực phẩm dễ dàng, giảm tối đa lượng dầu mỡ, ăn ngon, chống ngán, rất phù hợp cho gia đình bạn. ', 1120000.00, 5, 'https://cdn.tgdd.vn/Products/Images/9418/240291/Slider/ava-55k07a-55-lit-thumb-vid-1020x570.jpg'),
(51, 'Bếp từ đôi lắp âm Sunhouse SHB9111MT', 'Cho bạn chế biến được nhiều món ăn cùng lúc. Bạn có thể vừa nấu canh, vừa chiên xào thực phẩm một cách thoải mái và tiện lợi.', 2490000.00, 5, 'https://cdn.tgdd.vn/Products/Images/1982/237011/Slider/doi-sunhouse-shb9111mt638017768064342909.jpg'),
(52, 'Nồi cơm điện tử Sunhouse mama 1.8 lít SHD8903', 'Nồi cơm điện Sunhouse mama SHD8903 thiết kế gọn gàng, vỏ nồi bằng thép không gỉ bóng đẹp, bắt mắt, có tính thẩm mỹ cao Mang đến nét sang trọng, sáng sủa, hiện đại cho mọi không gian bếp. Đặc biệt vỏ nồi dày bền, giữ ấm thức ăn lâu, hạn chế trầy xước, ít bám bẩn, giúp bạn vệ sinh đơn giản, dễ dàng.', 1290000.00, 5, 'https://cdn.tgdd.vn/Products/Images/1922/131916/sunhouse-mama-shd8903-thumb-600x600-2.jpg'),
(53, 'Máy lọc nước RO nóng nguội lạnh Karofi KAD-X60 10 lõi', 'Máy lọc nước RO nóng nguội lạnh Karofi KAD-X60 có 2 vòi, 3 chế độ nước nóng - nguội - lạnh tiện dụng, làm nóng nước tức thời, lõi lọc thế hệ mới sử dụng công nghệ Smax Pro độc quyền cùng van chuyên dụng lấy được nước khi mất điện là sự lựa chọn hữu dụng cho gia đình bạn.   Tính năng đặc biệt  - Máy lọc nước Karofi sở hữu tính năng làm nóng tức thời siêu tiện dụng: Khi đưa nước vào máy, người dùng không cần phải đợi nước được làm nóng như những máy lọc nước khác mà có thể sử dụng được nước nóng ngay lập tức với nhiệt độ từ 85 - 95°C giúp tiết kiệm thời gian.   - Sản phẩm còn được bố trí van chuyên dụng có thể lấy được nước khi mất điện. ', 7990000.00, 5, 'https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/Products/Images/3385/281701/ro-nong-lanh-karofi-kad-x60-140223-040356-600x600.jpg'),
(54, 'Tủ lạnh LG Inverter 266 Lít GV-B262WB', 'Tổng quan thiết kế - GV-B262WB thuộc mẫu tủ lạnh ngăn đá trên 2 cánh với chất liệu cửa tủ được làm bằng thép không gỉ sáng bóng và có độ bền tốt.  - Nhờ sở hữu gam màu đen sang trọng, tủ lạnh LG này có thể phối hợp hài hòa với các nội thất khác trong khu vực gian bếp một cách dễ dàng.  - Với dung tích 266 lít, tủ lạnh LG GV-B262WB có thể đáp ứng tốt cho nhu cầu sử dụng của các hộ gia đình từ 2 - 3 người hoặc những ai đang sống 1 mình nhưng lại có nhu cầu bảo quản số lượng lớn thực phẩm để có thể dùng được cả tuần.', 6490000.00, 5, 'https://cdn.tgdd.vn/Products/Images/1943/284312/tu-lanh-lg-inverter-266-lit-gv-b262wb51.jpg'),
(55, 'Thang nhôm rút chữ A Sumika SK560D NEW - Chữ A cao 2.8m, chữ I cao 5.6m, tải trọng 300kg', 'Đặc điểm nổi bật của Thang rút nhôm đôi Sumika SK560D NEW  –  Thang rút nhôm đôi Sumika SK560D NEW được nhập khẩu 100% từ nước ngoài, và được sản xuất trên công nghệ dây chuyền hiện đại của Nhật. Sản phẩm luôn đạt các tiêu chuẩn chất lượng hàng đầu của Châu Âu.  Thang nhôm rút chữ A Sumika SK560D NEW - Chữ A cao 2.8m, chữ I cao 5.6m, tải trọng 300kg  – Chất liệu được làm bằng hợp kim nhôm rất chắc chắn và bền vững. Ngoài ra sản phẩm được sơn phủ bằng lớp sơn tĩnh điện giúp chiếc thang luôn sáng bóng như mới và không bị oxy hóa như các loại thang phổ thông hay thang sắt trước đây.  Thang nhôm rút chữ A Sumika SK560D NEW - Chữ A cao 2.8m, chữ I cao 5.6m, tải trọng 300kg  – Ống thang được bao bọc bởi các đai nhựa cứng có độ đàn hồi rất tốt ôm trọn các khớp nối của ống thang, hạn chế ống thang bị méo mó trong quá trình sử dụng.  Thang nhôm rút chữ A Sumika SK560D NEW - Chữ A cao 2.8m, chữ I cao 5.6m, tải trọng 300kg  – Thang được gia cố thêm 2 miếng cao su chống trượt màu cam được gắn ở thang ngang nhằm bảo vệ thang mỗi khi dùng có tải trọng lớn giúp thang vẫn giữ vững và thăng bằng tốt.', 2600000.00, 6, 'https://salt.tikicdn.com/cache/525x525/ts/product/d1/dc/93/ec55262d0f15c1e0253138e4bf5ffc03.jpg'),
(56, 'Bộ Dụng Cụ 46 Chi Tiết bộ Sửa Ô Tô Xe Máy 46 Chi Tiết', 'THÔNG TIN SẢN PHẨM:  - Tên sản phẩm : Bộ Tô Vít,Khẩu Đa Năng 46 Chi Tiết  - Màu sắc hộp đựng : Đỏ - Màu sắc vỏ hộp : Vàng  - Chất liệu: thép không gỉ cao cấp, chắc chắn.  - Kích thước hộp: 25 x 13 x 5cm  - Khối lượng: 1.5kg  MÔ TẢ CÔNG DỤNG  - Mở ốc từ 4-14mm  - Mở vít 2 cạnh, 4 cạnh, 6 cạnh với các loại vít thông thường  - Cờ lê đảo chiều, tay cầm tô vít, tay nối dài, dây nối dài giúp làm việc ở những góc hẹp  - 1 Cờ lê đảo chiều  - 1 tay cầm tô vít', 250000.00, 6, 'https://salt.tikicdn.com/cache/525x525/ts/product/33/72/30/8226cbd6c8a600d07334fb3b23f66eee.jpg'),
(57, 'CỜ LÊ ĐA NĂNG - LẮC LÉO RETTA - RCA0615', 'Giới thiệu CỜ LÊ ĐA NĂNG - LẮC LÉO RETTA - RCA0615 Thông số kỹ thuật :  Kích thước: 15mm  Ngoài ra cảm ứng cứng hàm chính xác.  Được làm bằng Chrome Vanadi Steel đã được xử lý nhiệt để tăng cường thông số kỹ thuật quốc tế.  Dung sai sản xuất tối thiểu hóa đảm bảo whrenches để phù hợp với bu lông hoàn hảo.', 300000.00, 6, 'https://salt.tikicdn.com/cache/525x525/ts/product/75/08/18/49465aff730ff8b6c6366ee28e871334.jpg'),
(58, 'Búa Đầu Sừng Tolsen 25028 (225g)', 'Búa Đầu Sừng Tolsen 25028 - 225 Gr được thiết kế 2 đầu: 1 đầu tròn để đóng đinh và một đầu sừng dê dùng để nhổ, tán đinh. Lưỡi búa được thiết kế cải tiến với độ cong và dài phù hợp giúp tăng hiệu quả khi nhổ đinh. Cán búa thiết kế vừa vặn với các khớp ngón tay sẽ giúp bạn thao tác dễ dàng và thuận tiện. Dùng để đóng, gõ dụng cụ, gò và tán kim loại Dùng nhiều trong công nghiệp chế tạo, sửa chữa, lắp ráp Cán chuôi và đầu búa gắn liền một khối tránh việc gãy chuôi khi sử dụng Đầu búa được làm từ thép carbon không gỉ cao cấp vô cùng cứng cáp, bền bỉ, không bị biến dạng khi chịu lực cao hay va đập mạnh, cho tuổi thọ sản phẩm rất dài để bạn yên tâm sử dụng. Tay cầm sợi thủy tinh, có độ bền cao và chống trơn hiệu quả', 105000.00, 6, 'https://salt.tikicdn.com/cache/525x525/ts/product/c6/3b/75/feeb2adc239f40113f183c179e23675b.jpg'),
(59, 'Búa Đầu Dẹp Tolsen 25001 - 200 Gr', 'Búa Đầu Dẹp Tolsen 25001 - 200 Gr  Búa Đầu Dẹp Tolsen 25001 - 200 Gr sản phẩm sửa chữa cầm tay chuyên dụng, tiện lợi nhẹ nhàng. Búa dùng để đóng, nhổ và tán đinh. Đầu búa thiết kế 2 đầu, một đầu vuông và một đầu dẹp.  Các tính năng nổi bật  - Dùng để đóng, gõ dụng cụ và nhổ đinh, tán kim loại  - Dùng nhiều trong công nghiệp chế tạo, sửa chữa, lắp ráp  - Được sản xuất với công nghệ cao và chất liệu cao cấp  Thông số kỹ thuật  - Chất liệu: thép cao cấp  - Trọng lượng: 200gr  - Xuất xứ: Trung Quốc', 97750.00, 6, 'https://salt.tikicdn.com/cache/525x525/media/catalog/product/2/5/25001.jpg'),
(60, 'Cưa Gỗ Cầm Tay 350mm có bao đeo siêu cứng', 'Từ trước đến nay, khi cần cưa 1 cây gỗ hoặc 1 vật dụng bằng gỗ, chúng ta có thể tiện tay sử dụng bất kỳ 1 loại cưa gỗ nào. Nhưng tuỳ vào từng loại cưa sẽ giúp việc hoàn thành nhanh hay chậm, bề mặt gỗ sau khi cưa có đạt yêu cầu như mong muốn hay không.  Để đáp ứng những mong muốn đó, chúng tôi xin giới thiệu đến người dùng một loại cưa chuyên cưa gỗ, cưa cây. Đó là Cưa gỗ 350mm cán nhựa đen cao cấp TOP, với thiết kế gọn, có bao nhựa đựng, thích hợp để mang theo bên mình khi phải đi ra vườn, hay leo lên cao.  Lưỡi cưa được chế tạo bằng thép Nhật SK95, đảm bảo độ sắc bén lâu dài, và khả năng đàn hồi khá cao.  Cán cưa được bọc một lớp nhựa cao cấp, giúp không bị trơn trượt tay, và hạn chế cảm giác mỏi tay khi làm việc với thời gian dài.  Có thể thay lưỡi khác khi lưỡi không còn sắc bén như ban đầu.  Sản phẩm này ngoài cách cưa truyền thống (cưa thẳng từ trên xuống), thì cũng có thể cưa theo dạng nghiêng ( cưa nghiêng phù hợp để cưa cành) một cách nhanh chóng và dễ dàng.', 57000.00, 6, 'https://salt.tikicdn.com/cache/525x525/ts/product/0d/42/77/08e4b9295bacf981c8a8abeb106ce19e.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 4),
(44, 4),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 6),
(56, 6),
(57, 6),
(58, 6),
(59, 6),
(60, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `report_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`,`product_id`),
  ADD KEY `cart_ibfk_3` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `reports_ibfk_1` (`customer_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`manufacturer_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
