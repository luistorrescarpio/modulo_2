/*
 Navicat MySQL Data Transfer

 Source Server         : mariadb_7.2.9
 Source Server Type    : MariaDB
 Source Server Version : 100135
 Source Host           : localhost:3306
 Source Schema         : how_easy_v3

 Target Server Type    : MariaDB
 Target Server Version : 100135
 File Encoding         : 65001

 Date: 21/01/2020 20:30:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for system
-- ----------------------------
DROP TABLE IF EXISTS `system`;
CREATE TABLE `system`  (
  `id_system` int(255) NOT NULL AUTO_INCREMENT,
  `sysa` int(1) NULL DEFAULT NULL,
  `sysb` int(1) NULL DEFAULT NULL,
  `sysc` int(1) NULL DEFAULT NULL,
  `more_info` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `con_mod_rmt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `con_mod_lc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `serial` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `state` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_system`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of system
-- ----------------------------
INSERT INTO `system` VALUES (1, 6, 3, 5, 'http://www.solsitecinnova.com', 'client@ping', 'con@setst', 'DAXQWD2312', 0);

-- ----------------------------
-- Procedure structure for MYSQL
-- ----------------------------
DROP PROCEDURE IF EXISTS `MYSQL`;
delimiter ;;
CREATE PROCEDURE `MYSQL`()
BEGIN
	#Routine body goes here...
	SELECT * FROM system WHERE sysa=6 AND sysb=3 AND sysc=5;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
