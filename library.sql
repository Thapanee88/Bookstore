Create schema library;
use library;

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `author` (`author_id`, `author_name`, `author_contact`) VALUES
(1, 'Yim-Chang-ho', ''),
(2, 'จูหงจื้อ', ''),
(3, 'Yangchigi-jari', ''),
(4, 'สุพจน์ สง่ากอง', ''),
(5, 'ดอนธนะ โค้วศิริกุลกิจ', ''),
(6, 'ธัญธัช นันท์ชนก', 'https://www.facebook.com/Thanyathach.N '),
(7, 'ชญาน์ทัต วงศ์มณี', 'https://www.facebook.com/toffybradshawwriter '),
(8, 'นาน สินธูสวัสดิ์', '');


CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `detail` varchar(500) DEFAULT NULL,
  `publisher_years` varchar(5) NOT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `book` (`book_id`, `title`, `image`, `category`, `detail`, `publisher_years`, `author_id`, `publisher_id`, `location_id`) VALUES
(1, 'ครอบครัวตึ๋งหนืด เล่ม 29 : ตอน ไอดอลตึ๋งหนืดตืดหลุดโลก', 'https://imageopac.tkpark.or.th/bookcover/141655/141655-fc-a.jpg', 'การ์ตูนความรู้', 'โทรุ กลายเป็นไอดอลและมีแฟนคลับเสียด้วย แต่คนอื่นๆ ต่างคัดค้าน โทรุจึงต้องพิสูจน์ตัวเองให้ได้ว่าเขาเหมาะสมกับตำแหน่งไอดอลตึ๋งหนืดอย่างไร ระหว่างนั้นโทรุต้องปฏิบัติภารกิจต่างๆ ที่ทั้งฮาทั้งป่วน เช่น การแข่งหาวิธีดับร้อนของครอบครัวตึ๋งหนืด ภารกิจฝึกเด็กๆ ให้เป็นไอดอลตึ๋งหนืดแบบโทรุ เทคนิคทำความสะอาดบ้านขั้นเทพ กลเม็ดใช้พัดลมแสนประหยัด รวมทั้งการเผชิญหน้ากับตังเม เด็กชายไอดอลตึ๋งหนืดรุ่นแรก งานนี้โทรุหรือตังเม ใครกันแน่ที่จะเป็นไอดอลตัวจริง', '2560', 1, 1, 1),
(2, 'กระบี่เหินพิชิตฟ้า', 'https://imageopac.tkpark.or.th/bookcover/175965/777542/777542-fc-a.jpg', 'นิยาย', 'ตำนานการสัประยุทธ์และแสวงหาความเป็นเซียนของ ฉินอวิ๋น คุณชายรองสกุลฉินผู้สืบทอดวิชาเซียนกระบี่ลี้ลับนับพันปี เขาผู้หล่อหลอมกระบี่เหิน พิชิตจอมปีศาจทั่วแดนดิน ประกาศศักดาสี่ทิศแปดทาง แม้เขาจะมีเจตกระบี่อันร้ายกาจเกินกว่าระดับพลังฝีมือตัวเองแต่ไม่สามารถนำมาใช้ในที่แจ้งได้เพราะอาจเป็นเป้าหมายให้เหล่าปีศาจรุมสังหาร', '2564', 2, 2, 2),
(3, 'ยอดเชฟเทพนักปรุง', 'https://imageopac.tkpark.or.th/bookcover/175781/776737/776737-fc-a.jpg', 'นิยาย', 'หน้าต่างสถานะเด้งขึ้นมาทำให้มินจุนรู้สึกเหมือนตัวเองกำลังอยู่ในเกมทำอาหาร ถ้านี่คือเกมมันก็คงจะเป็นเกมชีวิตแถมเป็นชีวิตครั้งที่สองอีกต่างหาก มินจุนได้ย้อนเวลากลับไปเมื่อเจ็ดปีที่แล้วพร้อมด้วยความทรงจำเดิม ประสบการณ์ทั้งหมด และพรสวรรค์ในการวิเคราะห์อาหารซึ่งติดตัวมาด้วย ชีวิตครั้งที่สองของเขาจะมุ่งสู่หนทางแห่งการเป็นเชฟตามความใฝ่ฝัน', '2564', 3, 3, 2),
(4, 'การเขียนโปรแกรมด้วยภาษา C++', 'https://imageopac.tkpark.or.th/bookcover/191667/191667-fc-a.jpg', 'คอมพิวเตอร์', 'เรียนรู้หลักการเขียนโปรแกรมด้วยภาษา C++ ที่คอมไพล์โปรแกรมเป็นภาษาเครื่องจึงทำงานกับฮาร์ดแวร์ได้อย่างรวดเร็ว สามารถทำงานข้ามแพลตฟอร์ม ได้รับความนิยมจากนักพัฒนาโปรแกรมจึงมีไลบราลีโอเพนซอร์สให้ใช้มากมายเหมาะสำหรับก้าวสู่การเป็นนักพัฒนาโปรแกรมมืออาชีพ', '2564', 4, 4, 3),
(5, 'Database design basic', 'https://imageopac.tkpark.or.th/bookcover/141719/141719-fc-a.jpg', 'คอมพิวเตอร์', 'เริ่มต้นเรียนรู้หลักการออกแบบฐานข้อมูลด้วยตัวเอง Database design basic', '2555', 5, 5, 3),
(6, 'สูตรลับสร้างรายได้ออนไลน์แค่ใช้ Word', 'https://imageopac.tkpark.or.th/bookcover/192858/192858-fc-a.jpg', 'คอมพิวเตอร์', 'หนังสือ \"สูตรลับสร้างรายได้ออนไลน์แค่ใช้ Word\" เล่มนี้ จะพลิกมุมมองที่คุณมีต่อ Microsoft Word ซึ่งทุกคนรู้จักคุ้นเคยกันดี จะช่วยให้คุณรู้ว่า Word มีความสามารถดี ๆ ที่คุณไม่เคยรู้มาก่อนซ่อนอยู่อีกมากมาย อ่านหนังสือเล่มจบ คุณจะอัปสกิลการใช้งาน Word ของตัวเองขึ้นมาอีกขั้น และที่สำคัญที่สุด คุณจะได้เรียนรู้วิธีใช้ Word เป็นเครื่องมือในการหารายได้ออนไลน์รูปแบบต่าง ๆ ซึ่งทำได้จริง ถ้าคุณอยากเอาตัวรอดให้ได้ในยุคนี้ อยากหารายได้เข้ากระเป๋าให้มากขึ้น.', '2560', 6, 6, 3),
(7, 'More Than Words คำบันดาลใจ', 'https://imageopac.tkpark.or.th/bookcover/190883/190883-fc-a.jpg ', 'จิตวิทยา', '', '2564', 7, 7, 4),
(8, 'ครอบครัวตึ๋งหนืด เล่ม 28 : ตอน ตำนานบ้านตึ๋งหนืด', 'https://imageopac.tkpark.or.th/bookcover/132374/132374-fc-a.jpg', 'การ์ตูนความรู้', 'ยุคดิจิทัลเช่นนี้ทุกสิ่งล้วนสะดวกสะบาย แค่มีเงินก็ซื้อได้ทุกอย่าง อ๊ะ! ไม่จริงหรอก! ครอบครัวตึ๋งหนืดขอค้านหัวชนฝา ของที่ทำด้วยมือและมอบด้วยใจยังมีอยู่ และมีคุณค่ามากเสียด้วย ครอบครัวตึ๋งหนืดจะมาเผยจิตวิญญาณตึ๋งหนืดที่สั่งสมมาตั้งแต่บรรพบุรุษ วิถีแห่งความประหยัดที่ทั้งฮาทั้งทรงคุณค่า ไม่ว่าจะเป็น ตำนานรักหวานเปรี้ยวเค็มของโรสและโกโร่ เซียนของเก่าเปลี่ยนขยะให้เป็นของมีค่า เคล็ดลับหาซื้อเครื่องเขียนแบบประหยัด และอีกหลากหลายเคล็ดลับ', '2559', 1, 1, 1),
(9, 'ซึมสุข', 'https://imageopac.tkpark.or.th/bookcover/182468/182468-fc-a.jpg', 'จิตวิทยา', 'เพราะความสุขของเราถูกขโมยไปน่ะสิ มัมมีมือที่เรามองไม่เห็นได้ทำการหยิบเอาความสุขของเราไปอย่างช้าๆ แต่ก็กอบโกยไปจนแทบจะหมดหน้าตักของเราเลยทีเดียว มือที่เรามองไม่เห็น แต่รู้เอาไว้เถอะว่า เรานั่นแหละเปิดประตูให้มือที่มองไม่เห็นเข้ามาในชีวิตของเรา ซ้ำร้ายมันยังกล้าที่จะขโมยความสุขของเราไปอย่างต่อหน้าต่อตา', '2558', 8, 8, 4),
(10, 'ชญาน์ทัต วงศ์มณี', 'https://imageopac.tkpark.or.th/bookcover/113780/113780-fc-a.jpg ', 'นิยาย', NULL, '2558', 7, 9, 2);


CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `floor` varchar(100) NOT NULL,
  `bookshelf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `location` (`location_id`, `floor`, `bookshelf`) VALUES
(1, '1', 'A'),
(2, '1', 'B'),
(3, '1', 'C'),
(4, '2', 'A'),
(5, '2', 'B'),
(6, '2', 'C');



CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `publisher_name` varchar(100) NOT NULL,
  `publisher_contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `publisher` (`publisher_id`, `publisher_name`, `publisher_contact`) VALUES
(1, 'นานมีบุ๊คส์พับลิเคชั่นส์', '0-2662-3000'),
(2, 'สยามอินเตอร์บุ๊ค', '090-667-2782'),
(3, 'เอ็นเธอร์บุ๊คส์', NULL),
(4, 'รีไวว่า', '0-2711-5855'),
(5, 'ซัคเซส มีเดีย', '02-782-2782'),
(6, 'อินเทรนด์', NULL),
(7, 'อะไรเอ่ย', '094-939-2954'),
(8, 'Dดี', '02-736-1337'),
(9, 'Her Publishing ', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);
COMMIT;
