/*
 Navicat Premium Dump SQL

 Source Server         : Ebilling linux
 Source Server Type    : MySQL
 Source Server Version : 80045 (8.0.45-0ubuntu0.24.04.1)
 Source Host           : 160.19.144.6:285
 Source Schema         : db_billing

 Target Server Type    : MySQL
 Target Server Version : 80045 (8.0.45-0ubuntu0.24.04.1)
 File Encoding         : 65001

 Date: 02/03/2026 19:26:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_db_billing_account
-- ----------------------------
DROP TABLE IF EXISTS `tb_db_billing_account`;
CREATE TABLE `tb_db_billing_account`  (
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_db` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `account` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_server` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_account`(`account` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 107 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_db_billing_account
-- ----------------------------
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '39511', 'eBilling2', 'koneksi_billing2.php', 1);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8039', 'eBilling2', 'koneksi_billing2.php', 2);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4935', 'eBilling2', 'koneksi_billing2.php', 3);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3707', 'eBilling2', 'koneksi_billing2.php', 4);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4891', 'eBilling2', 'koneksi_billing2.php', 5);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4871', 'eBilling2', 'koneksi_billing2.php', 6);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7695', 'eBilling2', 'koneksi_billing2.php', 7);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4657', 'eBilling2', 'koneksi_billing2.php', 8);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '6764', 'eBilling2', 'koneksi_billing2.php', 9);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4292', 'eBilling2', 'koneksi_billing2.php', 10);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2596', 'eBilling2', 'koneksi_billing2.php', 11);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '6521', 'eBilling2', 'koneksi_billing2.php', 12);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4203', 'eBilling2', 'koneksi_billing2.php', 13);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9433', 'eBilling2', 'koneksi_billing2.php', 14);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4108', 'eBilling2', 'koneksi_billing2.php', 15);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3359', 'eBilling2', 'koneksi_billing2.php', 16);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9589', 'eBilling2', 'koneksi_billing2.php', 17);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3833', 'eBilling2', 'koneksi_billing2.php', 18);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9095', 'eBilling2', 'koneksi_billing2.php', 19);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3315', 'eBilling2', 'koneksi_billing2.php', 20);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1123', 'eBilling2', 'koneksi_billing2.php', 21);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3206', 'eBilling2', 'koneksi_billing2.php', 22);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3176', 'eBilling2', 'koneksi_billing2.php', 23);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1228', 'eBilling2', 'koneksi_billing2.php', 24);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2996', 'eBilling2', 'koneksi_billing2.php', 25);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '6668', 'eBilling2', 'koneksi_billing2.php', 26);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3544', 'eBilling2', 'koneksi_billing2.php', 28);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2829', 'eBilling2', 'koneksi_billing2.php', 29);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2682', 'eBilling2', 'koneksi_billing2.php', 30);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1005', 'eBilling2', 'koneksi_billing2.php', 31);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3792', 'eBilling2', 'koneksi_billing2.php', 32);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2399', 'eBilling2', 'koneksi_billing2.php', 33);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2410', 'eBilling2', 'koneksi_billing2.php', 34);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1934', 'eBilling2', 'koneksi_billing2.php', 35);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9694', 'eBilling2', 'koneksi_billing2.php', 36);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1743', 'eBilling2', 'koneksi_billing2.php', 37);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1439', 'eBilling2', 'koneksi_billing2.php', 38);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1144', 'eBilling2', 'koneksi_billing2.php', 39);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3992', 'eBilling2', 'koneksi_billing2.php', 40);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1901', 'eBilling2', 'koneksi_billing2.php', 41);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8498', 'eBilling2', 'koneksi_billing2.php', 42);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8759', 'eBilling2', 'koneksi_billing2.php', 43);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2400', 'eBilling2', 'koneksi_billing2.php', 44);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2375', 'eBilling2', 'koneksi_billing2.php', 45);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7004', 'eBilling2', 'koneksi_billing2.php', 46);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3620', 'eBilling2', 'koneksi_billing2.php', 47);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8161', 'eBilling2', 'koneksi_billing2.php', 48);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7271', 'eBilling2', 'koneksi_billing2.php', 49);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8772', 'eBilling2', 'koneksi_billing2.php', 50);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4467', 'eBilling2', 'koneksi_billing2.php', 51);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1500', 'eBilling2', 'koneksi_billing2.php', 52);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2025', 'eBilling2', 'koneksi_billing2.php', 53);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8523', 'eBilling2', 'koneksi_billing2.php', 54);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7705', 'eBilling2', 'koneksi_billing2.php', 55);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '5327', 'eBilling2', 'koneksi_billing2.php', 56);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7479', 'eBilling2', 'koneksi_billing2.php', 57);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7665', 'eBilling2', 'koneksi_billing2.php', 58);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3956', 'eBilling2', 'koneksi_billing2.php', 59);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8130', 'eBilling2', 'koneksi_billing2.php', 60);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3252', 'eBilling2', 'koneksi_billing2.php', 61);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8188', 'eBilling2', 'koneksi_billing2.php', 62);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4010', 'eBilling2', 'koneksi_billing2.php', 63);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2426', 'eBilling2', 'koneksi_billing2.php', 64);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2894', 'eBilling2', 'koneksi_billing2.php', 65);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2847', 'eBilling2', 'koneksi_billing2.php', 66);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9374', 'eBilling2', 'koneksi_billing2.php', 67);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9042', 'eBilling2', 'koneksi_billing2.php', 68);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4791', 'eBilling2', 'koneksi_billing2.php', 69);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3335', 'eBilling2', 'koneksi_billing2.php', 70);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2021', 'eBilling2', 'koneksi_billing2.php', 71);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4502', 'eBilling2', 'koneksi_billing2.php', 72);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8535', 'eBilling2', 'koneksi_billing2.php', 73);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7417', 'eBilling2', 'koneksi_billing2.php', 74);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8203', 'eBilling2', 'koneksi_billing2.php', 75);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4513', 'eBilling2', 'koneksi_billing2.php', 76);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1566', 'eBilling2', 'koneksi_billing2.php', 77);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3411', 'eBilling2', 'koneksi_billing2.php', 78);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9565', 'eBilling2', 'koneksi_billing2.php', 79);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2788', 'eBilling2', 'koneksi_billing2.php', 80);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4041', 'eBilling2', 'koneksi_billing2.php', 81);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3108', 'eBilling2', 'koneksi_billing2.php', 82);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9368', 'eBilling2', 'koneksi_billing2.php', 83);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1169', 'eBilling2', 'koneksi_billing2.php', 84);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '5910', 'eBilling2', 'koneksi_billing2.php', 85);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3928', 'eBilling2', 'koneksi_billing2.php', 86);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1234', 'eBilling2', 'koneksi_billing2.php', 87);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '5669', 'eBilling2', 'koneksi_billing2.php', 88);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7223', 'eBilling2', 'koneksi_billing2.php', 89);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '6000', 'eBilling2', 'koneksi_billing2.php', 90);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '2867', 'eBilling2', 'koneksi_billing2.php', 91);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '9286', 'eBilling2', 'koneksi_billing2.php', 92);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7306', 'eBilling2', 'koneksi_billing2.php', 93);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3041', 'eBilling2', 'koneksi_billing2.php', 94);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '6552', 'eBilling2', 'koneksi_billing2.php', 95);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '8746', 'eBilling2', 'koneksi_billing2.php', 96);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '5025', 'eBilling2', 'koneksi_billing2.php', 97);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1859', 'eBilling2', 'koneksi_billing2.php', 98);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '5388', 'eBilling2', 'koneksi_billing2.php', 99);
INSERT INTO `tb_db_billing_account` VALUES ('172.16.4.110:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '7286', 'eBilling Custom', 'koneksi_custom_billing2.php', 100);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '4615', 'eBilling2', 'koneksi_billing2.php', 101);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '3904', 'eBilling2', 'koneksi_billing2.php', 102);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1523', 'eBilling2', 'koneksi_billing2.php', 103);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '1283', 'eBilling2', 'koneksi_billing2.php', 104);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.14:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', '5185', 'eBilling2', 'koneksi_billing2.php', 105);
INSERT INTO `tb_db_billing_account` VALUES ('10.40.30.11:1991', 'db_billing', 'jawa', '123J0mb4ng123$%^&*', NULL, NULL, NULL, 106);

SET FOREIGN_KEY_CHECKS = 1;
