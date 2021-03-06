<?php

use yii\db\Migration;

class m170901_021803_tbprovin_district extends Migration
{
    public function safeUp()
    {
        $sql = "
            set foreign_key_checks=0;
            DROP TABLE IF EXISTS `province`;
            CREATE TABLE `province` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `province_code` varchar(20)  NOT NULL,
              `province_name` varchar(255) NOT NULL,
              `record_status` varchar(1)   NULL,
              `input_id` int(11)   DEFAULT NULL,
              `input_dt_stamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
              `deleted` int(11) NOT NULL DEFAULT '0',            
              PRIMARY KEY (`id`),
              UNIQUE KEY `name_UNIQUE` (`province_name`),
              CONSTRAINT `fk_province_user` FOREIGN KEY (`input_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
            DROP TABLE IF EXISTS `district`;
            CREATE TABLE `district` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `district_code` varchar(20) NOT NULL,            
              `district_name` varchar(255)  NOT NULL,
              `province_id` int(11) NOT NULL,
              `record_status` varchar(1)   NULL,         
              `input_id` int(11)   DEFAULT NULL,   
              `input_dt_stamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
              `deleted` int(11) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`),
              KEY `fk_district_province1_idx` (`province_id`),
              CONSTRAINT `fk_district_user` FOREIGN KEY (`input_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
              CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                       
            
                        
            INSERT INTO `province` (`id`, `province_code`, `province_name`, `record_status`, `input_id`, `input_dt_stamp`, `deleted`) VALUES
            (1, '01', 'ນະຄອນຫລວງວຽງຈັນ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (2, '02', 'ຜົ້ງສາລີ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (3, '03', 'ຫຼວງນໍ້າທາ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (4, '05', 'ອຸດົມໄຊ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (5, '04', 'ບໍ່ແກ້ວ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (6, '06', 'ຫຼວງພະບາງ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (7, '07', 'ຫົວພັນ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (8, '08', 'ໄຊຍະບູລີ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (9, '09', 'ຊຽງຂວາງ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (10, '10', 'ວຽງຈັນ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (11, '11', 'ບໍລິຄໍາໄຊ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (12, '12', 'ຄໍາມ່ວນ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (13, '13', 'ສະຫວັນນະເຂດ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (14, '14', 'ສາລະວັນ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (15, '15', 'ເຊກອງ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (16, '16', 'ຈໍາປາສັກ', NULL, NULL, '2017-09-01 09:48:56', 0),
            (17, '17', 'ອັດຕະປື', NULL, NULL, '2017-09-01 09:48:56', 0),
            (18, '18', 'ໄຊສົມບູນ', NULL, NULL, '2017-09-01 09:48:56', 0);
            
            
                    
        INSERT INTO `district` (`id`, `district_code`, `district_name`, `province_id`, `record_status`, `input_id`, `input_dt_stamp`, `deleted`) VALUES
        (1, '0101', 'ຈັນທະບູລີ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (2, '0102', 'ສີໂຄດຕະບອງ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (3, '0103', 'ສີສັດຕະນາກ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (4, '0104', 'ໄຊເສດຖາ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (5, '0105', 'ນາຊາຍທອງ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (6, '0106', 'ໄຊທານີ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (7, '0107', 'ຫາດຊາຍຟອງ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (8, '0108', 'ສັງທອງ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (9, '0109', 'ປາກງື່ມ', 1, NULL, NULL, '2017-09-01 09:48:59', 0),
        (10, '0201', 'ຜົ້ງສາລີ', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (11, '331', 'ໄຊເສດຖາ', 17, NULL, NULL, '2017-09-01 09:48:59', 0),
        (12, '2901', 'ໄກສອນພົມວິຫານ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (13, '2902', 'ອຸທຸມພອນ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (14, '201', 'ປາກຊັນ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (15, '2002', 'ສິງ', 3, NULL, NULL, '2017-09-01 09:48:59', 0),
        (16, '2503', 'ຫົງສາ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (17, '2201', 'ຫ້ວຍຊາຍ', 5, NULL, NULL, '2017-09-01 09:48:59', 0),
        (18, '1905', 'ບຸນເໜືອ', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (19, '1907', 'ບຸນໃຕ້', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (20, '2001', 'ຫລວງນໍ້າທາ', 3, NULL, NULL, '2017-09-01 09:48:59', 0),
        (21, '2003', 'ລອງ', 3, NULL, NULL, '2017-09-01 09:48:59', 0),
        (22, '2004', 'ວຽງພູຄາ', 3, NULL, NULL, '2017-09-01 09:48:59', 0),
        (23, '2005', 'ນາແລ', 3, NULL, NULL, '2017-09-01 09:48:59', 0),
        (24, '340', 'ອານຸວົງ', 18, NULL, NULL, '2017-09-01 09:48:59', 0),
        (25, '2520', 'ຊຽງຮ່ອນ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (26, '23002', 'ນານ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (27, '2225', 'ຕົ້ນເຜິ້ງ', 5, NULL, NULL, '2017-09-01 09:48:59', 0),
        (28, '262', 'ພູກູດ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (29, '2389', 'ຊຽງເງິນ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (30, '242', 'ຊໍາໃຕ້', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (31, '301', 'ສາລະວັນ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (32, '302', 'ວາປີ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (33, '2330', 'ພູຄູນ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (34, '22123', 'ປາກທາ', 5, NULL, NULL, '2017-09-01 09:48:59', 0),
        (35, '22230', 'ຜາອຸດົມ', 5, NULL, NULL, '2017-09-01 09:48:59', 0),
        (36, '293', 'ໄຊບູລີ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (37, '2904', 'ອາດສະພັງທອງ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (38, '295', 'ພະລານໄຊ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (39, '296', 'ພີນ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (40, '297', 'ເຊໂປນ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (41, '298', 'ວິລະບູລີ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (42, '299', 'ໄຊພູທອງ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (43, '2910', 'ສອງຄອນ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (44, '2911', 'ທ່າປາງທອງ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (45, '22', 'ປາກກະດິງ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (46, '23', 'ທ່າພະບາດ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (47, '24', 'ບໍລິຄັນ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (48, '25', 'ວຽງທອງ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (49, '26', 'ໄຊຈໍາພອນ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (50, '27', 'ຄໍາເກີດ', 11, NULL, NULL, '2017-09-01 09:48:59', 0),
        (51, '211', 'ໄຊ', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (52, '212', 'ແບງ', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (53, '213', 'ຮູນ', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (54, '214', 'ຫຼາ', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (55, '215', 'ນາໝໍ້', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (56, '216', 'ງາ', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (57, '217', 'ປາກແບງ', 4, NULL, NULL, '2017-09-01 09:48:59', 0),
        (58, '225', 'ເມິງ', 5, NULL, NULL, '2017-09-01 09:48:59', 0),
        (59, '231', 'ຫຼວງພຣະບາງ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (60, '233', 'ປາກອູ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (61, '234', 'ຈອມເພັດ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (62, '235', 'ງອຍ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (63, '236', 'ນໍ້າບາກ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (64, '237', 'ວຽງຄໍາ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (65, '238', 'ໂພນໄຊ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (66, '239', 'ປາກແຊງ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (67, '2310', 'ໂພນທອງ', 6, NULL, NULL, '2017-09-01 09:48:59', 0),
        (68, '241', 'ຊ້ອນ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (69, '243', 'ວຽງໄຊ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (70, '244', 'ສົບເບົາ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (71, '245', 'ຊຽງຄໍ້', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (72, '246', 'ແອດ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (73, '247', 'ຊໍາເໜືອ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (74, '248', 'ຫົວເມືອງ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (75, '251', 'ຄອບ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (76, '254', 'ເງິນ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (77, '255', 'ໄຊສະຖານ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (78, '256', 'ໄຊຍະບູລີ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (79, '257', 'ພຽງ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (80, '258', 'ທົ່ງມີໄຊ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (81, '259', 'ປາກລາຍ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (82, '2510', 'ແກ່ນທ້າວ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (83, '2511', 'ບໍ່ແຕນ', 8, NULL, NULL, '2017-09-01 09:48:59', 0),
        (84, '263', 'ຜາໄຊ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (85, '264', 'ຄໍາ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (86, '265', 'ແປກ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (87, '266', 'ໜອງແຮດ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (88, '267', 'ໝອກ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (89, '268', 'ຄູນ', 9, NULL, NULL, '2017-09-01 09:48:59', 0),
        (90, '271', 'ໂພນໂຮງ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (91, '272', 'ທຸລະຄົມ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (92, '273', 'ແກ້ວອຸດົມ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (93, '274', 'ກາສີ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (94, '275', 'ວັງວຽງ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (95, '276', 'ເຟືອງ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (96, '277', 'ຊະນະຄາມ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (97, '278', 'ແມດ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (98, '279', 'ວຽງຄໍາ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (99, '2710', 'ຫີນເຫີບ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (100, '2711', 'ໝື່ນ', 10, NULL, NULL, '2017-09-01 09:48:59', 0),
        (101, '303', 'ລະຄອນເພັງ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (102, '304', 'ເລົ່າງາມ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (103, '305', 'ຄົງເຊໂດນ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (104, '306', 'ຕຸ້ມລານ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (105, '307', 'ຕະໂອ້ຍ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (106, '308', 'ສະໝ້ວຍ', 14, NULL, NULL, '2017-09-01 09:48:59', 0),
        (107, '332', 'ຊານໄຊ', 17, NULL, NULL, '2017-09-01 09:48:59', 0),
        (108, '333', 'ສະໜາມໄຊ', 17, NULL, NULL, '2017-09-01 09:48:59', 0),
        (109, '334', 'ສາມັກຄີມີໄຊ', 17, NULL, NULL, '2017-09-01 09:48:59', 0),
        (110, '335', 'ພູວົງ', 17, NULL, NULL, '2017-09-01 09:48:59', 0),
        (111, '431', 'ທ່າແຂກ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (112, '432', 'ຫີນບູນ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (113, '433', 'ໜອງບົກ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (114, '434', 'ເຊບັ້ງໄຟ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (115, '435', 'ມະຫາໄຊ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (116, '436', 'ຍົມມະລາດ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (117, '437', 'ນາກາຍ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (118, '438', 'ໄຊບົວທອງ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (119, '439', 'ບົວລະພາ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (120, '4310', 'ຄູນຄໍາ', 12, NULL, NULL, '2017-09-01 09:48:59', 0),
        (121, '161', 'ຈໍາປາສັກ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (122, '152', 'ທ່າແຕງ', 15, NULL, NULL, '2017-09-01 09:48:59', 0),
        (123, '1521', 'ລະມາມ', 15, NULL, NULL, '2017-09-01 09:48:59', 0),
        (124, '1512', 'ກະລືມ', 15, NULL, NULL, '2017-09-01 09:48:59', 0),
        (125, '1513', 'ດາກຈຶງ', 15, NULL, NULL, '2017-09-01 09:48:59', 0),
        (126, '162', 'ບາຈຽງຈະເລີນສຸກ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (127, '163', 'ປາກຊ່ອງ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (128, '164', 'ປະທຸມພອນ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (129, '165', 'ໂພນທອງ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (130, '166', 'ສຸຂຸມາ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (131, '167', 'ມູນລະປະໂມກ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (132, '168', 'ໂຂງ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (133, '0242', 'ຍອດອູ', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (134, '20203', 'ໃຫມ່', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (135, '20204', 'ຂວາ', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (136, '20205', 'ສໍາພັນ', 2, NULL, NULL, '2017-09-01 09:48:59', 0),
        (137, '5227', 'ປາກທາ', 5, NULL, NULL, '2017-09-01 09:48:59', 0),
        (138, '7543', 'ຮ້ຽມ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (139, '7544', 'ກວັນ', 7, NULL, NULL, '2017-09-01 09:48:59', 0),
        (140, '13277', 'ຈຳພອນ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (141, '13278', 'ຊົນບູລີ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (142, '13279', 'ນອງ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (143, '13280', 'ອາດສະພອນ', 13, NULL, NULL, '2017-09-01 09:48:59', 0),
        (144, '16111', 'ຊະນະສົມບູນ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (145, '16117', 'ປາກເຊ', 16, NULL, NULL, '2017-09-01 09:48:59', 0),
        (146, '183404', 'ທ່າໂທມ', 18, NULL, NULL, '2017-09-01 09:48:59', 0),
        (147, '18333', 'ລ້ອງແຈ້ງ', 18, NULL, NULL, '2017-09-01 09:48:59', 0),
        (148, '18332', 'ຮົ່ມ', 18, NULL, NULL, '2017-09-01 09:48:59', 0),
        (149, '18366', 'ລ້ອງຊານ', 18, NULL, NULL, '2017-09-01 09:48:59', 0);
                    
                    
                        
            
            set foreign_key_checks=1;
            ";
        $this->execute($sql);
    }
    

    public function safeDown()
    {
        
        $sql = "
            set foreign_key_checks=0;
            DROP TABLE IF EXISTS `province`;          
            DROP TABLE IF EXISTS `district`;                                    
            set foreign_key_checks=1;
            
            ";
        $this->execute($sql);
       
    }
    
}
