-- MySQL dump 10.13  Distrib 8.0.19, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: hifpt_admin_local
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_configs`
--

DROP TABLE IF EXISTS `admin_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_configs` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_section` varchar(50) NOT NULL,
  `config_key` varchar(100) NOT NULL,
  `config_code` int(11) DEFAULT NULL,
  `config_value` text,
  `description_vi` text,
  `description_en` text,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `config_key` (`config_key`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_configs`
--

LOCK TABLES `admin_configs` WRITE;
/*!40000 ALTER TABLE `admin_configs` DISABLE KEYS */;
INSERT INTO `admin_configs` VALUES (1,'message','RESPONSE_INVALID_INPUT',5,NULL,'Dữ liệu đầu vào không đúng. Vui lòng kiểm tra và nhập lại. Xin cảm ơn','Input Param is not valid. Please check and try again. Thank you',0,'2021-08-09 17:42:11'),(2,'message','RESPONSE_INVALID_ACCESSTOKEN',10,NULL,'Phiên làm việc đã hết','Session is expire',0,'2021-08-09 17:42:11'),(3,'message','RESPONSE_SUCCESS',0,NULL,'Thành công','Success',0,'2021-08-09 17:42:11'),(5,'message','RESPONSE_ERROR_ACCESSTOKEN',3,NULL,'Phiên làm việc bị lỗi','Session is error',0,'2021-08-09 17:42:11'),(6,'information','XE_MAY',98000,NULL,'{\"title\":\"Bảo hiểm trách nhiệm dân sự cho xe máy\",\"subTitle\":\"Công ty TNHH Bảo hiểm HD\",\"price\":66000,\"unit\":\"đ\",\"generalInfo\":{\"top\":[{\"title\":\"Bồi thường về tải sản cho nạn nhân\",\"description\":\"50 triệu đồng/vụ \",\"code\":\"boi-thuong\"},{\"title\":\"Bồi thường về chi phí y tế, tử vong cho nạn nhân\",\"description\":\"150 triệu đồng/người \",\"code\":\"boi-thuong\"}],\"down\":[{\"title\":\"Mua dễ dàng & nhận chứng nhận tức thì\",\"description\":\"\",\"code\":\"loi-ich-1\"},{\"title\":\"Hiển thị đầy đủ thông tin & qui trình bồi thường\",\"description\":\"\",\"code\":\"loi-ich-2\"},{\"title\":\"Có giá trị sử dụng & hiệu lực tương đương bản cứng\",\"description\":\"\",\"code\":\"loi-ich-3\"},{\"title\":\"Tự động nhắc gia hạn khi bảo hiểm gần hết hiệu lực\",\"description\":\"\",\"code\":\"loi-ich-4\"}]},\"detailInfo\":[{\"title\":\"Bảo hiểm Bắt buộc Trách nhiệm dân sự của chủ xe là gì?\",\"description\":[\"Bảo hiểm Bắt buộc Trách nhiệm dân sự (TNDS) là bảo hiểm bắt buộc chủ xe máy, xe mô tô phải có khi tham gia giao thông theo quy định tại Nghị định số 03/2021/NĐ-CP của Thủ tướng Chính phủ ban hành.\"],\"code\":\"bao-hiem-lg\"},{\"title\":\"Quyền lợi của chủ xe khi mua bảo hiểm TNDS bắt buộc là gì?\",\"description\":[\"Công ty Bảo hiểm sẽ thay mặt Người được bảo hiểm (bạn) chi trả đền bù thiệt hại cho bên thứ ba trong trường hợp xảy ra tai nạn với mức trách nhiệm tối đa.\",\"Xe máy:\",\"• 150,000,000 VNĐ người/vụ tai nạn đối với các thiệt hại về tính mạng, sức khỏe con người.\",\"• 50,000,000 VNĐ /vụ tai nạn đối với các thiệt hại về tài sản.\",\"Xe ô tô:\",\"• 150,000,000 VNĐ người/vụ tai nạn đối với các thiệt hại về tính mạng, sức khỏe con người.\",\"• 100,000,000 VNĐ /vụ tai nạn đối với các thiệt hại về tài sản.\"],\"code\":\"quyen-loi-bh\"},{\"title\":\"Tính pháp lý của Giấy chứng nhận bảo hiểm điện tử?\",\"description\":[\"Giấy chứng nhận điện tử có hiệu lực theo Nghị định 03/2021/NĐ-CP ngày 15 tháng 01 năm 2021 của Chính phủ và Thông tư 04/2021/TT-BTC ngày 15 tháng 01 của Bộ Tài chính.\"],\"code\":\"phap-ly-gcn\"},{\"title\":\"Giấy chứng nhận cứng (giấy) của tôi đang có hiệu lực thì làm thế nào?\",\"description\":[\"Bạn có thể tiếp tục sử dụng giấy chứng nhận này khi tham gia giao thông cho đến khi hết thời gian hiệu lực.\",\"Nếu bạn cần thêm thông tin, vui lòng liên hệ với hotline 1900 06 88 98 của Bảo hiểm HD để nhận được sự hỗ trợ.\"],\"code\":\"gcn-bh\"},{\"title\":\"Tôi cần làm gì khi xảy ra tai nạn để được hỗ trợ bồi thường?\",\"description\":[\"1. Gọi cấp cứu, cơ quan Công an.\",\"2. Bảo vệ hiện trường và không tự ý di chuyển phương tiện trừ khi được chỉ dẫn của Công An hoặc gây cản trở giao thông.\",\"3. Gọi đến số hotline HDI: 1900 06 88 98 để được hướng dẫn.\",\"4. Chụp ảnh hiện trường, phương tiện liên quan đến vụ tai nạn.\",\"5. Thu thập các thông tin như: Biển số xe, chủng loại xe. Thông tin của Lái xe, Chủ xe, thông tin về Bảo hiểm của phương tiện liên quan đến vụ tai nạn. Thông tin liên lạc của người làm chứng.\",\"6. Không tự thỏa thuận bồi thường khi chưa có ý kiến, hướng dẫn từ HDI.\",\"7. Gửi hồ sơ yêu cầu bồi thường theo hướng dẫn về HDI.\"],\"code\":\"can-lg-boi-thuong\"},{\"title\":\"Thời hạn bảo hiểm của hợp đồng khi mua trên Hi FPT\",\"description\":[\"Thời hạn 1 năm kể từ ngày bắt đầu hiệu lực của đơn bảo hiểm (Ngày hiệu lực của đơn bảo hiểm phụ thuộc vào ngày bắt đầu bạn chọn khi mua bảo hiểm trên Hi FPT, ngày bắt đầu bảo hiểm tối thiểu phải sau ngày hiện tại 2 ngày)\"],\"code\":\"thoi-han-bh\"},{\"title\":\"Tôi có thể xem hoặc xuất trình giấy chứng nhận điện tử với cán bộ kiếm soát giao thông như thế nào?\",\"description\":[\"Bước 1: Bạn vào Trang chủ ứng dụng Hi FPT, nhấp vào chức năng Hợp đồng.\",\"Bước 2: Tại màn hình Hợp đồng, bạn chọn vào mục Bảo hiểm.\",\"Bước 3: Nhấp chọn vào Giấy chứng nhận tương ứng với thông tin xe đã mua bảo hiểm mà bạn cần xem.\",\"Ngoài ra, bạn có thể tải Giấy chứng nhận điện tử về máy bằng cách nhấp vào nút Tải về ở cuối  màn hình.\"],\"code\":\"xuat-trinh-gcn\"},{\"title\":\"Tôi có thể mua bảo hiểm cho người thân hay bạn bè được không?\",\"description\":[\"Bạn có thể mua bảo hiểm cho người thân/bạn bè với thông tin xe của người đó.\"],\"code\":\"bh-nt-bb\"},{\"title\":\"Các bước tối thiểu cần làm khi tai nạn xảy ra\",\"description\":[\"1. Kiểm tra tình hình: gọi cấp cứu, trợ giúp, và sơ cứu nạn nhân nếu cần thiết.\",\"2. Liên hệ nhà bảo hiểm để được hỗ trợ và hướng dẫn kịp thời\",\"3. Hoàn thiện hồ sơ: thu thập chứng từ, tài liệu chứng minh thiệt hại.\",\"4. Thống nhất phương án với nhà bảo hiểm về việc bồi thường thiệt hại cho nạn nhân nếu có.\"],\"code\":\"buoc-tt-tn\"},{\"title\":\"Tài sản của chủ xe hay nạn nhân mới được hưởng bảo hiểm?\",\"description\":[\"Tài sản của nạn nhân (bên thứ 3) mới được đền bù theo quyền lợi của Bảo hiểm TNDS bắt buộc\"],\"code\":\"tai-san-bh\"},{\"title\":\"Nếu bị thương khi gây ra tai nạn, chủ xe có được bảo hiểm?\",\"description\":[\"Thương tật, tử vong của người bạn đã gây ra thiệt hại (bên thứ 3) mới được bảo hiểm.\",\"Để được bảo hiểm hỗ trợ bồi thường cho chủ xe, bạn cần mua bảo hiểm tai nạn cho người ngồi trên xe để đảm bào quyền lợi cho mình.\",\"Để nâng mức bồi thường cho người bạn đã gây ra tai nạn hơn so với mức bồi thường của TNDS bắt buộc hiện có, bạn có thể mua thêm bảo hiểm TNDS tự nguyện.\",\"Đối với xe ô tô là loại xe chở hàng, bạn có thể mua bảo hiểm cho hàng hóa của mình.\",\"Hiện tại, Hi FPT đã hỗ trợ cho bạn có thể mua kèm được tất cả các loại bảo hiểm trên, khi bạn mua bảo hiểm TNDS bắt buộc trên ứng dụng.\"],\"code\":\"bi-thuong-bh\"},{\"title\":\"Thông tin liên hệ\",\"description\":[\"Trong quá trình thanh toán phí bảo hiểm qua Hi FPT, các yêu cầu của Khách hàng sẽ được hỗ trợ ngay qua hotline của Bảo hiểm HD số 1900 06 88 98.\"],\"code\":\"thong-tin-lh\"}]}','{\"title\":\"Bảo hiểm trách nhiệm dân sự cho xe máy\",\"subTitle\":\"Công ty TNHH Bảo hiểm HD\",\"price\":66000,\"unit\":\"đ\",\"generalInfo\":{\"top\":[{\"title\":\"Bồi thường về tải sản cho nạn nhân\",\"description\":\"50 triệu đồng/vụ \",\"code\":\"boi-thuong\"},{\"title\":\"Bồi thường về chi phí y tế, tử vong cho nạn nhân\",\"description\":\"150 triệu đồng/người \",\"code\":\"boi-thuong\"}],\"down\":[{\"title\":\"Mua dễ dàng & nhận chứng nhận tức thì\",\"description\":\"\",\"code\":\"loi-ich-1\"},{\"title\":\"Hiển thị đầy đủ thông tin & qui trình bồi thường\",\"description\":\"\",\"code\":\"loi-ich-2\"},{\"title\":\"Có giá trị sử dụng & hiệu lực tương đương bản cứng\",\"description\":\"\",\"code\":\"loi-ich-3\"},{\"title\":\"Tự động nhắc gia hạn khi bảo hiểm gần hết hiệu lực\",\"description\":\"\",\"code\":\"loi-ich-4\"}]},\"detailInfo\":[{\"title\":\"What is a car owner\'s compulsory civil liability insurance?\",\"description\":[\"Compulsory Civil Liability Insurance is a compulsory insurance for motorbike and motorbike owners when participating in traffic according to the provisions of Decree No. 03/2021/ND-CP issued by the Prime Minister.\"],\"code\":\"bao-hiem-lg\"},{\"title\":\"What are the benefits of car owners when buying compulsory civil liability insurance?\",\"description\":[\"The Insurer will pay damages to a third party on behalf of the Insured (you) in the event of an accident with the maximum liability.\",\"Motorbike:\",\"• 150,000,000 VND person/accident for loss of life and human health.\",\"• VND 50,000,000/accident for property damage.\",\"Car:\",\"• 150,000,000 VND person/accident for loss of life and human health.\",\"• 100,000,000 VND/accident for property damage.\"],\"code\":\"quyen-loi-bh\"},{\"title\":\"What is the legality of the Electronic Certificate of Insurance?\",\"description\":[\"The electronic certificate is valid according to Decree No. 03/2021/ND-CP dated January 15, 2021 of the Government and Circular No. 04/2021/TT-BTC dated January 15 of the Ministry of Finance.\"],\"code\":\"phap-ly-gcn\"},{\"title\":\"What if my hard certificate (paper) is valid?\",\"description\":[\"You can continue to use this certificate when participating in traffic until the validity period expires.\",\"If you need more information, please contact HD Insurance\'s hotline 1900 06 88 98 for assistance.\"],\"code\":\"gcn-bh\"},{\"title\":\"What do I need to do in the event of an accident to get compensation?\",\"description\":[\"1. Call for emergency, the police agency.\",\"2. Protect the scene and do not arbitrarily move vehicles unless instructed by the Police or obstruct traffic.\",\"3. Call the HDI hotline: 1900 06 88 98 for instructions.\",\"4. Take photos of the scene and vehicles involved in the accident.\",\"5. Collect information such as: license plate, vehicle type. information of driver, owner, insurance information of the vehicle related to the accident. Contact information of witness.\",\"6. Do not negotiate compensation by yourself without consulting and guidance from HDI.\",\"7. File a claim according to HDI guidelines.\"],\"code\":\"can-lg-boi-thuong\"},{\"title\":\"Insurance period of the contract when buying on Hi FPT\",\"description\":[\"Period of 1 year from the effective date of the policy (The effective date of the policy depends on the start date you choose when buying insurance on Hi FPT, the insurance start date must be after the current date at least 2 day.)\"],\"code\":\"thoi-han-bh\"},{\"title\":\"How can I view or present an electronic certificate to a traffic controller?\",\"description\":[\"Step 1: You go to Hi FPT application homepage, click on Contract function\",\"Step 2: At the Contract screen, select Insurance\",\"Step 3: Click on the Certificate corresponding to the insured vehicle information you need to see.\",\"Alternatively, you can download the electronic certificate to your device by clicking the Download button at the bottom of the screen.\"],\"code\":\"xuat-trinh-gcn\"},{\"title\":\"Can I buy insurance for my family or friends?\",\"description\":[\"You can buy insurance for a relative/friend with his or her car information.\"],\"code\":\"bh-nt-bb\"},{\"title\":\"Minimum steps to take when an accident occurs\",\"description\":[\"1. Check the situation: call emergency, help, and give first aid to the victim if necessary.\",\"2. Contact the insurer for timely support and guidance\",\"3. Completing the dossier: collecting vouchers and documents proving the damage.\",\"4. Agree on a plan with the insurer on compensation for damage to the victim, if any.\"],\"code\":\"buoc-tt-tn\"},{\"title\":\"Is the property of the owner or the victim insured?\",\"description\":[\"The property of the victim (3rd party) is only compensated according to the benefits of compulsory civil liability insurance\"],\"code\":\"tai-san-bh\"},{\"title\":\"If injured in an accident, is the car owner insured?\",\"description\":[\"Injury, only death of the victim (3rd party) is covered.\",\"In order to receive insurance support to compensate for car owners, you need to buy accident insurance for the occupants of the car to ensure your benefits\",\"To increase the compensation for the victim more than the existing compulsory civil liability insurance compensation, you can buy more voluntary civil liability insurance.\",\"For cargo vehicles, you can buy insurance for your goods.\",\"Currently, Hi FPT has supported you to buy all the above insurances when you buy compulsory civil liability insurance on the app.\"],\"code\":\"bi-thuong-bh\"},{\"title\":\"Contact information\",\"description\":[\"During the premium payment process via Hi FPT, your requests will be immediately supported via HD Insurance hotline at 1900 06 88 98.\"],\"code\":\"thong-tin-lh\"}]}',0,'2021-09-03 17:53:00'),(7,'information','XE_OTO',98000,NULL,'{\"title\":\"Bảo hiểm trách nhiệm dân sự cho xe ô tô\",\"subTitle\":\"Công ty TNHH Bảo hiểm HD\",\"price\":480000,\"unit\":\"đ\",\"generalInfo\":{\"top\":[{\"title\":\"Bồi thường về tải sản cho nạn nhân\",\"description\":\"100 triệu đồng/vụ \",\"code\":\"boi-thuong\"},{\"title\":\"Bồi thường về chi phí y tế, tử vong cho nạn nhân\",\"description\":\"150 triệu đồng/người \",\"code\":\"boi-thuong\"}],\"down\":[{\"title\":\"Mua dễ dàng & nhận giấy chứng nhận tức thì\",\"description\":\"\",\"code\":\"loi-ich-1\"},{\"title\":\"Hiển thị đầy đủ thông tin & qui trình bồi thường\",\"description\":\"\",\"code\":\"loi-ich-2\"},{\"title\":\"Có giá trị sử dụng & hiệu lực tương đương bản cứng\",\"description\":\"\",\"code\":\"loi-ich-3\"},{\"title\":\"Tự động nhắc gia hạn khi bảo hiểm gần hết hiệu lực\",\"description\":\"\",\"code\":\"loi-ich-4\"}]},\"detailInfo\":[{\"title\":\"Bảo hiểm Bắt buộc Trách nhiệm dân sự của chủ xe là gì?\",\"description\":[\"Bảo hiểm Bắt buộc Trách nhiệm dân sự (TNDS) là bảo hiểm bắt buộc chủ xe máy, xe mô tô phải có khi tham gia giao thông theo quy định tại Nghị định số 03/2021/NĐ-CP của Thủ tướng Chính phủ ban hành.\"],\"code\":\"bao-hiem-lg\"},{\"title\":\"Quyền lợi của chủ xe khi mua bảo hiểm TNDS bắt buộc là gì?\",\"description\":[\"Công ty Bảo hiểm sẽ thay mặt Người được bảo hiểm (bạn) chi trả đền bù thiệt hại cho bên thứ ba trong trường hợp xảy ra tai nạn với mức trách nhiệm tối đa.\",\"Xe máy:\",\"• 150,000,000 VNĐ người/vụ tai nạn đối với các thiệt hại về tính mạng, sức khỏe con người.\",\"• 50,000,000 VNĐ /vụ tai nạn đối với các thiệt hại về tài sản.\",\"Xe ô tô:\",\"• 150,000,000 VNĐ người/vụ tai nạn đối với các thiệt hại về tính mạng, sức khỏe con người.\",\"• 100,000,000 VNĐ /vụ tai nạn đối với các thiệt hại về tài sản.\"],\"code\":\"quyen-loi-bh\"},{\"title\":\"Tính pháp lý của Giấy chứng nhận bảo hiểm điện tử?\",\"description\":[\"Giấy chứng nhận điện tử có hiệu lực theo Nghị định 03/2021/NĐ-CP ngày 15 tháng 01 năm 2021 của Chính phủ và Thông tư 04/2021/TT-BTC ngày 15 tháng 01 của Bộ Tài chính.\"],\"code\":\"phap-ly-gcn\"},{\"title\":\"Giấy chứng nhận cứng (giấy) của tôi đang có hiệu lực thì làm thế nào?\",\"description\":[\"Bạn có thể tiếp tục sử dụng giấy chứng nhận này khi tham gia giao thông cho đến khi hết thời gian hiệu lực.\",\"Nếu bạn cần thêm thông tin, vui lòng liên hệ với hotline 1900 06 88 98 của Bảo hiểm HD để nhận được sự hỗ trợ.\"],\"code\":\"gcn-bh\"},{\"title\":\"Tôi cần làm gì khi xảy ra tai nạn để được hỗ trợ bồi thường?\",\"description\":[\"1. Gọi cấp cứu, cơ quan Công an.\",\"2. Bảo vệ hiện trường và không tự ý di chuyển phương tiện trừ khi được chỉ dẫn của Công An hoặc gây cản trở giao thông.\",\"3. Gọi đến số hotline HDI: 1900 06 88 98 để được hướng dẫn.\",\"4. Chụp ảnh hiện trường, phương tiện liên quan đến vụ tai nạn.\",\"5. Thu thập các thông tin như: Biển số xe, chủng loại xe. Thông tin của Lái xe, Chủ xe, thông tin về Bảo hiểm của phương tiện liên quan đến vụ tai nạn. Thông tin liên lạc của người làm chứng.\",\"6. Không tự thỏa thuận bồi thường khi chưa có ý kiến, hướng dẫn từ HDI.\",\"7. Gửi hồ sơ yêu cầu bồi thường theo hướng dẫn về HDI.\"],\"code\":\"can-lg-boi-thuong\"},{\"title\":\"Thời hạn bảo hiểm của hợp đồng khi mua trên Hi FPT\",\"description\":[\"Thời hạn 1 năm kể từ ngày bắt đầu hiệu lực của đơn bảo hiểm (Ngày hiệu lực của đơn bảo hiểm phụ thuộc vào ngày bắt đầu bạn chọn khi mua bảo hiểm trên Hi FPT, ngày bắt đầu bảo hiểm tối thiểu phải sau ngày hiện tại 2 ngày)\"],\"code\":\"thoi-han-bh\"},{\"title\":\"Tôi có thể xem hoặc xuất trình giấy chứng nhận điện tử với cán bộ kiếm soát giao thông như thế nào?\",\"description\":[\"Bước 1: Bạn vào Trang chủ ứng dụng Hi FPT, nhấp vào chức năng Hợp đồng.\",\"Bước 2: Tại màn hình Hợp đồng, bạn chọn vào mục Bảo hiểm.\",\"Bước 3: Nhấp chọn vào Giấy chứng nhận tương ứng với thông tin xe đã mua bảo hiểm mà bạn cần xem.\",\"Ngoài ra, bạn có thể tải Giấy chứng nhận điện tử về máy bằng cách nhấp vào nút Tải về ở cuối  màn hình.\"],\"code\":\"xuat-trinh-gcn\"},{\"title\":\"Tôi có thể mua bảo hiểm cho người thân hay bạn bè được không?\",\"description\":[\"Bạn có thể mua bảo hiểm cho người thân/bạn bè với thông tin xe của người đó.\"],\"code\":\"bh-nt-bb\"},{\"title\":\"Các bước tối thiểu cần làm khi tai nạn xảy ra\",\"description\":[\"1. Kiểm tra tình hình: gọi cấp cứu, trợ giúp, và sơ cứu nạn nhân nếu cần thiết.\",\"2. Liên hệ nhà bảo hiểm để được hỗ trợ và hướng dẫn kịp thời\",\"3. Hoàn thiện hồ sơ: thu thập chứng từ, tài liệu chứng minh thiệt hại.\",\"4. Thống nhất phương án với nhà bảo hiểm về việc bồi thường thiệt hại cho nạn nhân nếu có.\"],\"code\":\"buoc-tt-tn\"},{\"title\":\"Tài sản của chủ xe hay nạn nhân mới được hưởng bảo hiểm?\",\"description\":[\"Tài sản của nạn nhân (bên thứ 3) mới được đền bù theo quyền lợi của Bảo hiểm TNDS bắt buộc\"],\"code\":\"tai-san-bh\"},{\"title\":\"Nếu bị thương khi gây ra tai nạn, chủ xe có được bảo hiểm?\",\"description\":[\"Thương tật, tử vong của người bạn đã gây ra thiệt hại (bên thứ 3) mới được bảo hiểm.\",\"Để được bảo hiểm hỗ trợ bồi thường cho chủ xe, bạn cần mua bảo hiểm tai nạn cho người ngồi trên xe để đảm bào quyền lợi cho mình.\",\"Để nâng mức bồi thường cho người bạn đã gây ra tai nạn hơn so với mức bồi thường của TNDS bắt buộc hiện có, bạn có thể mua thêm bảo hiểm TNDS tự nguyện.\",\"Đối với xe ô tô là loại xe chở hàng, bạn có thể mua bảo hiểm cho hàng hóa của mình.\",\"Hiện tại, Hi FPT đã hỗ trợ cho bạn có thể mua kèm được tất cả các loại bảo hiểm trên, khi bạn mua bảo hiểm TNDS bắt buộc trên ứng dụng.\"],\"code\":\"bi-thuong-bh\"},{\"title\":\"Thông tin liên hệ\",\"description\":[\"Trong quá trình thanh toán phí bảo hiểm qua Hi FPT, các yêu cầu của Khách hàng sẽ được hỗ trợ ngay qua hotline của Bảo hiểm HD số 1900 06 88 98.\"],\"code\":\"thong-tin-lh\"}]}','{\"title\":\"Bảo hiểm trách nhiệm dân sự cho xe ô tô\",\"subTitle\":\"Công ty TNHH Bảo hiểm HD\",\"price\":480000,\"unit\":\"đ\",\"generalInfo\":{\"top\":[{\"title\":\"Bồi thường về tải sản cho nạn nhân\",\"description\":\"100 triệu đồng/vụ \",\"code\":\"boi-thuong\"},{\"title\":\"Bồi thường về chi phí y tế, tử vong cho nạn nhân\",\"description\":\"150 triệu đồng/người \",\"code\":\"boi-thuong\"}],\"down\":[{\"title\":\"Mua dễ dàng & nhận giấy chứng nhận tức thì\",\"description\":\"\",\"code\":\"loi-ich-1\"},{\"title\":\"Hiển thị đầy đủ thông tin & qui trình bồi thường\",\"description\":\"\",\"code\":\"loi-ich-2\"},{\"title\":\"Có giá trị sử dụng & hiệu lực tương đương bản cứng\",\"description\":\"\",\"code\":\"loi-ich-3\"},{\"title\":\"Tự động nhắc gia hạn khi bảo hiểm gần hết hiệu lực\",\"description\":\"\",\"code\":\"loi-ich-4\"}]},\"detailInfo\":[{\"title\":\"What is a car owner\'s compulsory civil liability insurance?\",\"description\":[\"Compulsory Civil Liability Insurance is a compulsory insurance for motorbike and motorbike owners when participating in traffic according to the provisions of Decree No. 03/2021/ND-CP issued by the Prime Minister.\"],\"code\":\"bao-hiem-lg\"},{\"title\":\"What are the benefits of car owners when buying compulsory civil liability insurance?\",\"description\":[\"The Insurer will pay damages to a third party on behalf of the Insured (you) in the event of an accident with the maximum liability.\",\"Motorbike:\",\"• 150,000,000 VND person/accident for loss of life and human health.\",\"• VND 50,000,000/accident for property damage.\",\"Car:\",\"• 150,000,000 VND person/accident for loss of life and human health.\",\"• 100,000,000 VND/accident for property damage.\"],\"code\":\"quyen-loi-bh\"},{\"title\":\"What is the legality of the Electronic Certificate of Insurance?\",\"description\":[\"The electronic certificate is valid according to Decree No. 03/2021/ND-CP dated January 15, 2021 of the Government and Circular No. 04/2021/TT-BTC dated January 15 of the Ministry of Finance.\"],\"code\":\"phap-ly-gcn\"},{\"title\":\"What if my hard certificate (paper) is valid?\",\"description\":[\"You can continue to use this certificate when participating in traffic until the validity period expires.\",\"If you need more information, please contact HD Insurance\'s hotline 1900 06 88 98 for assistance.\"],\"code\":\"gcn-bh\"},{\"title\":\"What do I need to do in the event of an accident to get compensation?\",\"description\":[\"1. Call for emergency, the police agency.\",\"2. Protect the scene and do not arbitrarily move vehicles unless instructed by the Police or obstruct traffic.\",\"3. Call the HDI hotline: 1900 06 88 98 for instructions.\",\"4. Take photos of the scene and vehicles involved in the accident.\",\"5. Collect information such as: license plate, vehicle type. information of driver, owner, insurance information of the vehicle related to the accident. Contact information of witness.\",\"6. Do not negotiate compensation by yourself without consulting and guidance from HDI.\",\"7. File a claim according to HDI guidelines.\"],\"code\":\"can-lg-boi-thuong\"},{\"title\":\"Insurance period of the contract when buying on Hi FPT\",\"description\":[\"Period of 1 year from the effective date of the policy (The effective date of the policy depends on the start date you choose when buying insurance on Hi FPT, the insurance start date must be after the current date at least 2 day.)\"],\"code\":\"thoi-han-bh\"},{\"title\":\"How can I view or present an electronic certificate to a traffic controller?\",\"description\":[\"Step 1: You go to Hi FPT application homepage, click on Contract function\",\"Step 2: At the Contract screen, select Insurance\",\"Step 3: Click on the Certificate corresponding to the insured vehicle information you need to see.\",\"Alternatively, you can download the electronic certificate to your device by clicking the Download button at the bottom of the screen.\"],\"code\":\"xuat-trinh-gcn\"},{\"title\":\"Can I buy insurance for my family or friends?\",\"description\":[\"You can buy insurance for a relative/friend with his or her car information.\"],\"code\":\"bh-nt-bb\"},{\"title\":\"Minimum steps to take when an accident occurs\",\"description\":[\"1. Check the situation: call emergency, help, and give first aid to the victim if necessary.\",\"2. Contact the insurer for timely support and guidance\",\"3. Completing the dossier: collecting vouchers and documents proving the damage.\",\"4. Agree on a plan with the insurer on compensation for damage to the victim, if any.\"],\"code\":\"buoc-tt-tn\"},{\"title\":\"Is the property of the owner or the victim insured?\",\"description\":[\"The property of the victim (3rd party) is only compensated according to the benefits of compulsory civil liability insurance\"],\"code\":\"tai-san-bh\"},{\"title\":\"If injured in an accident, is the car owner insured?\",\"description\":[\"Injury, only death of the victim (3rd party) is covered.\",\"In order to receive insurance support to compensate for car owners, you need to buy accident insurance for the occupants of the car to ensure your benefits\",\"To increase the compensation for the victim more than the existing compulsory civil liability insurance compensation, you can buy more voluntary civil liability insurance.\",\"For cargo vehicles, you can buy insurance for your goods.\",\"Currently, Hi FPT has supported you to buy all the above insurances when you buy compulsory civil liability insurance on the app.\"],\"code\":\"bi-thuong-bh\"},{\"title\":\"Contact information\",\"description\":[\"During the premium payment process via Hi FPT, your requests will be immediately supported via HD Insurance hotline at 1900 06 88 98.\"],\"code\":\"thong-tin-lh\"}]}',0,'2021-09-03 17:51:32'),(8,'information','URL_HDI',98000,NULL,'https://hdimedia.hdinsurance.com.vn/f/343c788ba31cbdc59c6e604f8b064a3c','https://hdimedia.hdinsurance.com.vn/f/343c788ba31cbdc59c6e604f8b064a3c',0,'2021-08-19 16:01:33'),(9,'message','RESPONSE_ERROR',5,NULL,'Có lỗi trong quá trình xử lý.  Vui lòng kiểm tra và nhập lại. Xin cảm ơn','There is an error in the process. Please check and try again. Thank you	',0,'2021-08-09 17:42:11'),(10,'message','RESPONSE_WARNING',98011,NULL,'Cảnh báo!','Warning!',0,'2021-08-11 11:14:14'),(11,'information','RESPONSE_TITLE_INSURANCE_TN',98000,NULL,'Phí bảo hiểm tự nguyện','Voluntary premium',0,'2021-09-01 20:03:56'),(12,'information','RESPONSE_TITLE_INSURANCE_BB',98000,NULL,'Phí bảo hiểm bắt buộc','Compulsory premium',0,'2021-09-01 20:03:46'),(13,'information','RESPONSE_TITLE_PAYMENT',98000,NULL,'Thanh toán bảo hiểm HD','HD Insurance Payment',0,'2021-09-01 20:08:55'),(14,'message','RESPONSE_REMIND',98012,NULL,'Nhắc nhở!','Remind!',0,'2021-09-06 11:46:16'),(15,'information','WARNING_ORDER_PROCESSING',98000,NULL,'Thông báo','Inform',0,'2021-08-27 15:45:57'),(16,'information','REMIND_EXIST_INSURANCE',98000,NULL,'Thông báo','Inform',0,'2021-08-27 15:45:57'),(17,'information','REMIND_PRICE_CHANGE',98000,NULL,'Tổng chi phí hiện tại đã thay đổi!','Total amount is changing!',0,'2021-08-14 16:07:57'),(18,'information','RESPONSE_EFFECTIVE_DATE_INVALID',98000,NULL,'Thời gian bắt đầu hiệu lực phải lớn hơn 2 ngày so với ngày hiện tại!','Effective date must be greater than 2 days from today!',0,'2021-08-14 16:16:19'),(19,'information','RESPONSE_VALIDATED_TIME_INVALID',98000,NULL,'Thời gian hiệu lực không được nhỏ hơn 365 ngày!','Validated time must be greater than 365 days!',0,'2021-08-14 16:16:19'),(20,'information','VOLUNTARY_INSURANCE',98000,NULL,'[{\"key\":\"BH_HH\",\"data\":[\"XE_OTO_CHOHANG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[\"XE_CH1\",\"XE_CH2\",\"XE_CH3\",\"XE_CH4\",\"XE_CH7\"]},{\"key\":\"BH_NTX\",\"data\":[\"XE_MAY\",\"XE_MAYCD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_CHONGUOI_KKD\",\"XE_OTO_CDUNG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CHONGUOI_KD\",\"XE_OTO_CHOHANG_KD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[]},{\"key\":\"TH_HK\",\"data\":[\"XE_OTO_CHONGUOI_KD\"],\"exception\":[]},{\"key\":\"TH_N3\",\"data\":[\"XE_MAY\",\"XE_MAYCD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_CHONGUOI_KKD\",\"XE_OTO_CDUNG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CHONGUOI_KD\",\"XE_OTO_CHOHANG_KD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[\"XE_MDIEN\",\"XE_3BANH_1\"]},{\"key\":\"TH_TSN3\",\"data\":[\"XE_MAY\",\"XE_MAYCD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_CHONGUOI_KKD\",\"XE_OTO_CDUNG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CHONGUOI_KD\",\"XE_OTO_CHOHANG_KD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[\"XE_MDIEN\",\"XE_3BANH_1\"]}]','[{\"key\":\"BH_HH\",\"data\":[\"XE_OTO_CHOHANG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[\"XE_CH1\",\"XE_CH2\",\"XE_CH3\",\"XE_CH4\",\"XE_CH7\"]},{\"key\":\"BH_NTX\",\"data\":[\"XE_MAY\",\"XE_MAYCD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_CHONGUOI_KKD\",\"XE_OTO_CDUNG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CHONGUOI_KD\",\"XE_OTO_CHOHANG_KD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[]},{\"key\":\"TH_HK\",\"data\":[\"XE_OTO_CHONGUOI_KD\"],\"exception\":[]},{\"key\":\"TH_N3\",\"data\":[\"XE_MAY\",\"XE_MAYCD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_CHONGUOI_KKD\",\"XE_OTO_CDUNG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CHONGUOI_KD\",\"XE_OTO_CHOHANG_KD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[\"XE_MDIEN\",\"XE_3BANH_1\"]},{\"key\":\"TH_TSN3\",\"data\":[\"XE_MAY\",\"XE_MAYCD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_CHONGUOI_KKD\",\"XE_OTO_CDUNG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CHONGUOI_KD\",\"XE_OTO_CHOHANG_KD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_NGUOIHANG_KD\"],\"exception\":[\"XE_MDIEN\",\"XE_3BANH_1\"]}]',0,'2021-08-25 12:27:11'),(21,'information','VEHICLE_WEIGHT',98000,NULL,'{\"key\":\"vhWeight\",\"data\":[\"XE_OTO_CHOHANG_KD\",\"XE_OTO_NGUOIHANG_KD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_CDUNG_KKD\"],\"exception\":[\"XE_CD1\",\"XE_CD2\"]}','{\"key\":\"vhWeight\",\"data\":[\"XE_OTO_CHOHANG_KD\",\"XE_OTO_NGUOIHANG_KD\",\"XE_OTO_CHOHANG_KKD\",\"XE_OTO_NGUOIHANG_KKD\",\"XE_OTO_CDUNG_KD\",\"XE_OTO_CDUNG_KKD\"],\"exception\":[\"XE_CD1\",\"XE_CD2\"]}',0,'2021-08-26 14:01:32'),(22,'data','PHONE_TEST',NULL,'[]',NULL,NULL,0,'2021-09-23 15:49:25'),(23,'data','FAKE_CERTIFICATE',NULL,'{\"Success\":true,\"Error\":null,\"ErrorMessage\":null,\"Data\":[{\"ORDER_CODE\":null,\"CONTRACT_CODE\":\"CA6D98403D4D445FE0530100007F6E2D\",\"CONTRACT_NO\":\"S21V01HZEDB0\",\"CONTRACT_MODE\":\"TRUC_TIEP\",\"STATUS\":\"PAID\",\"STATUS_NAME\":null,\"AMOUNT\":429545.0,\"TOTAL_DISCOUNT\":0.0,\"VAT\":42955.0,\"TOTAL_AMOUNT\":472500.0,\"INSURED\":[{\"DETAIL_CODE\":\"CA6D98403D4F445FE0530100007F6E2D\",\"CONTRACT_CODE\":\"CA6D98403D4D445FE0530100007F6E2D\",\"CERTIFICATE_NO\":\"S21V01HZSXB8\",\"CATEGORY\":\"XE\",\"PRODUCT_CODE\":\"XCG_TNDSBB\",\"PACK_CODE\":\"TNDSBB\",\"RELATIONSHIP\":\"BAN_THAN\",\"BENEFICIARY\":null,\"REGION\":\"VN\",\"EFFECTIVE_DATE\":\"30/08/2021 00:00:00\",\"EXPIRATION_DATE\":\"30/08/2022 00:00:00\",\"ADDITIONAL\":null,\"ADDITIONAL_FEES\":0.0,\"AMOUNT\":429545.0,\"TOTAL_DISCOUNT\":0.0,\"VAT\":42955.0,\"TOTAL_AMOUNT\":472500.0,\"URL_GCN\":\"https://dev-hyperservices.hdinsurance.com.vn/f/2eff6b62974248f997d82cfbdd1ca23c\",\"CUS_ID\":null,\"STAFF_CODE\":null,\"STAFF_REF\":null,\"TYPE\":\"CN\",\"FAX\":null,\"TAXCODE\":null,\"ORG_CUS\":null,\"ADDRESS_FORM\":null,\"NATIONALITY\":null,\"NAME\":\"thanh\",\"DOB\":null,\"GENDER\":null,\"PROV\":null,\"DIST\":null,\"WARDS\":null,\"ADDRESS\":null,\"IDCARD\":null,\"IDCARD_D\":null,\"IDCARD_P\":null,\"EMAIL\":null,\"PHONE\":\"0987685006\"}],\"TYPE_VAT\":null,\"CUS_ID\":null,\"STAFF_CODE\":null,\"STAFF_REF\":null,\"TYPE\":\"CN\",\"FAX\":null,\"TAXCODE\":null,\"ORG_CUS\":null,\"ADDRESS_FORM\":null,\"NATIONALITY\":null,\"NAME\":\"thanh\",\"DOB\":null,\"GENDER\":null,\"PROV\":null,\"DIST\":null,\"WARDS\":null,\"ADDRESS\":null,\"IDCARD\":\"1234567890\",\"IDCARD_D\":null,\"IDCARD_P\":null,\"EMAIL\":null,\"PHONE\":\"0987685006\"}],\"Signature\":\"7B7276B9440F4BE53FDB1838F80F53F570AEEC26D1D66BDCA31D1D121DB755C3\"}',NULL,NULL,0,'2021-08-26 15:26:00'),(24,'information','MESSAGE_ORDER_PROCESSING',98000,NULL,'Phương tiện này đã được Quý khách đăng ký mua bảo hiểm với thời hạn bảo hiểm từ <b>%fromDate%</b> đến <b>%toDate%</b> và đang trong quá trình chờ xử lý. Quý khách vui lòng chờ phản hồi về kết quả từ Hi FPT hoặc tiếp tục thực hiện quy trình mua bảo hiểm.','Phương tiện này đã được Quý khách đăng ký mua bảo hiểm với thời hạn bảo hiểm từ <b>%fromDate%</b> đến <b>%toDate%</b> và đang trong quá trình chờ xử lý. Quý khách vui lòng chờ phản hồi về kết quả từ Hi FPT hoặc tiếp tục thực hiện quy trình mua bảo hiểm.',0,'2021-08-30 17:31:09'),(25,'information','MESSAGE_EXIST_INSURANCE',98000,NULL,'Phương tiện của Quý khách đã mua Bảo hiểm TNDS bắt buộc có hiệu lực đến ngày <b>%toDate%</b><br>Quý khách có muốn tiếp tục thực hiện giao dịch?','Phương tiện của Quý khách đã mua Bảo hiểm TNDS bắt buộc có hiệu lực đến ngày <b>%toDate%</b><br>Quý khách có muốn tiếp tục thực hiện giao dịch?',0,'2021-08-28 10:07:35'),(26,'data','PHONE_TEST_CERTIFICATE',NULL,'[]',NULL,NULL,0,'2021-08-27 10:31:10'),(27,'data','RECIPIENTS',NULL,'khangnt9@fpt.com.vn',NULL,'2',0,'2021-09-13 15:38:37'),(28,'data','CARBON_COPYS',NULL,'khangnt9@fpt.com.vn',NULL,NULL,0,'2021-09-14 09:19:21'),(29,'information','RESPONSE_TITLE_DISCOUNT',98000,NULL,'Ưu đãi','Ưu đãi',0,'2021-09-28 11:15:50');
/*!40000 ALTER TABLE `admin_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_09_16_040558_permission',1),(5,'2021_09_16_085011_create_permission_category_table',1),(6,'2021_09_16_085053_create_users_group_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `permission_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permitted` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Complete Support Request','REPORT_COMPLETE','Hi Report','HI_REPORT',1,'2021-10-08 08:46:00','2021-10-08 08:46:00'),(7,'HDI Analysis','HDI_ANALYZE','Hi HDI','HI_HDI',1,'2021-10-08 08:46:00','2021-10-08 08:46:00'),(10,'OTP Lookup','OTP','Hi Authen','HI_AUTHEN',1,'2021-10-08 08:46:00','2021-10-08 08:46:00'),(12,'Customer Growth Report','CUSTOMER_REPORT','Hi Customer','HI_CUSTOMER',1,'2021-10-08 08:46:00','2021-10-08 08:46:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions_group`
--

DROP TABLE IF EXISTS `permissions_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions_group` (
  `role_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_create` tinyint(1) NOT NULL DEFAULT '0',
  `permission_read` tinyint(1) NOT NULL DEFAULT '0',
  `permission_update` tinyint(1) NOT NULL DEFAULT '0',
  `permission_del` tinyint(1) NOT NULL DEFAULT '0',
  `permission_code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions_group`
--

LOCK TABLES `permissions_group` WRITE;
/*!40000 ALTER TABLE `permissions_group` DISABLE KEYS */;
INSERT INTO `permissions_group` VALUES (1,0,1,1,0,'OTP','HI_CUSTOMER','DEVELOPER','2021-10-08 08:46:00','2021-10-01 03:57:28'),(2,0,1,1,0,'HDI_ANALYZE','HI_HDI','DEVELOPER','2021-10-08 08:46:00','2021-10-01 03:57:28'),(5,0,1,1,0,'HDI_ANALYZE','HI_HDI','ANALYSIS','2021-10-08 08:46:00','0000-00-00 00:00:00'),(15,0,0,0,0,'CUSTOMER_REPORT','HI_CUSTOMER','SUPPORT',NULL,'0000-00-00 00:00:00'),(16,0,0,0,0,'CUSTOMER_REPORT','HI_CUSTOMER','ADMIN',NULL,'0000-00-00 00:00:00'),(17,0,0,0,0,'CUSTOMER_REPORT','HI_CUSTOMER','ANALYSIS',NULL,'0000-00-00 00:00:00'),(18,0,0,0,0,'REPORT_COMPLETE','HI_REPORT','SUPPORT',NULL,'0000-00-00 00:00:00'),(19,0,0,0,0,'REPORT_COMPLETE','HI_REPORT','ADMIN',NULL,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permissions_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,4,'User','khang2312','user@gmail.com',NULL,'$2y$10$Cu/LojMPmxqsI9zvFQausuDYM0cI1n99XYrW5gON4U8gBrbU3GMsW',1,NULL,'2021-09-20 03:35:36','2021-09-20 03:35:36'),(2,2,'Admin','khang2312','admin@gmail.com',NULL,'$2y$10$LwK/SW6S4fS5ioYbx.3Dgu/BhXlrWgXVQ54ufPxFfVOARrxqhR1hG',1,NULL,'2021-09-20 03:35:36','2021-09-20 03:35:36'),(5,3,'Khang  Nguyen Tien 12','khang2312','khangnguyen24298@gmail.com',NULL,'$2y$10$bICXMysBxYXeuEbyCEu31.gK09ywcjVtyeUx2Bk7MZ1WWf7qdnwdy',1,NULL,'2021-09-20 03:35:36','2021-09-20 03:35:36'),(6,4,'Nguyen Khang','khang2312','khang24298@gmail.com',NULL,'$2y$10$C/54aUdqaETjp3qGiaqOSur3Hw/RIrSQXFi.ISiWwa.kQsCfxdXhO',1,NULL,'2021-09-28 00:43:09','2021-09-28 00:43:09'),(7,4,'Emma Smith','khang2312','khang1998@gmail.com',NULL,'$2y$10$meCiRbBiZIx..WiFKM6ipOprnbBq7bWOG6Xai23dBAfB3DSiIfMO2',1,NULL,'2021-09-29 04:58:06','2021-09-29 04:58:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_group`
--

DROP TABLE IF EXISTS `users_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_group` (
  `group_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_group`
--

LOCK TABLES `users_group` WRITE;
/*!40000 ALTER TABLE `users_group` DISABLE KEYS */;
INSERT INTO `users_group` VALUES (1,'Group Support','SUPPORT',NULL,NULL),(2,'Group Admin','ADMIN',NULL,NULL),(3,'Group Analysis','ANALYSIS',NULL,NULL),(4,'Group Developer','DEVELOPER',NULL,'2021-10-08 08:46:00');
/*!40000 ALTER TABLE `users_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-12 14:34:25
