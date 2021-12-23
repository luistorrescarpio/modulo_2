/*
 Navicat Premium Data Transfer

 Source Server         : mariadb-local
 Source Server Type    : MariaDB
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : mcl_proyecto_5

 Target Server Type    : MariaDB
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 23/12/2021 10:40:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agente
-- ----------------------------
DROP TABLE IF EXISTS `agente`;
CREATE TABLE `agente`  (
  `id_agente` bigint(255) NOT NULL AUTO_INCREMENT,
  `age_fullname` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `age_cell` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `age_datetime` datetime(0) NOT NULL,
  `age_password` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `age_tipo` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Tipo de agente',
  PRIMARY KEY (`id_agente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1003 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of agente
-- ----------------------------
INSERT INTO `agente` VALUES (1000, 'Pedro Gamero', '956878547', '2021-12-18 16:52:35', '1234', 'recolector');
INSERT INTO `agente` VALUES (1001, 'Jose Tapia', '221458785', '2021-12-18 17:55:56', '12345', 'recolector');
INSERT INTO `agente` VALUES (1002, 'supervisor', '', '2021-12-19 20:36:11', '123456', 'supervisor');

-- ----------------------------
-- Table structure for contribuyente
-- ----------------------------
DROP TABLE IF EXISTS `contribuyente`;
CREATE TABLE `contribuyente`  (
  `id_contribuyente` bigint(255) NOT NULL AUTO_INCREMENT COMMENT 'Numero de Identificación Unico',
  `con_dni` char(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `con_fullname` char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `con_latlng` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `con_password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `con_datetime` datetime(0) NULL DEFAULT NULL,
  `con_cell` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Nro de celular para contacto directo',
  PRIMARY KEY (`id_contribuyente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of contribuyente
-- ----------------------------
INSERT INTO `contribuyente` VALUES (2, '70894521', 'Luis Perez', '-71.14545,-48.1234', '1234', '2021-12-17 21:55:44', '555');
INSERT INTO `contribuyente` VALUES (5, 'Dss', 'Cfd', 'Frs', 'Ffe', '2021-12-17 22:21:38', '666');
INSERT INTO `contribuyente` VALUES (6, '704653', 'Joel chambi', '-71.727384,-43.5424', '12345', '2021-12-17 22:22:32', '777');
INSERT INTO `contribuyente` VALUES (7, '62533462', 'José manrrique', '717372', '546', '2021-12-17 22:23:26', '888');
INSERT INTO `contribuyente` VALUES (8, 'Hdhf', '', '-17.660217,-71.35255', '', '2021-12-17 22:31:55', '999');
INSERT INTO `contribuyente` VALUES (9, '', 'Udje', '-17.66022,-71.35255', 'hehe', '2021-12-17 22:34:11', '111');
INSERT INTO `contribuyente` VALUES (10, '', 'Udje', '-17.660217,-71.35255', 'hehe', '2021-12-17 22:34:18', '222');
INSERT INTO `contribuyente` VALUES (11, '62534263', 'Luis Torres', '-17.660288,-71.352776', '6163', '2021-12-17 22:35:33', '333');
INSERT INTO `contribuyente` VALUES (12, 'Hshdh', 'Hdhdh', '-17.65256,-71.348175', 'dhdhe', '2021-12-20 20:48:50', NULL);
INSERT INTO `contribuyente` VALUES (13, '53645374', 'Marco tapia', '-17.660206,-71.352554', '5555', '2021-12-20 20:51:37', NULL);
INSERT INTO `contribuyente` VALUES (14, '62384754', 'Juana marquez', '-17.660215,-71.352554', '654', '2021-12-20 20:56:53', NULL);
INSERT INTO `contribuyente` VALUES (15, '85746534', 'Juana de Arco', '-17.66026,-71.35275', '54321', '2021-12-23 08:19:13', NULL);

-- ----------------------------
-- Table structure for recoleccion
-- ----------------------------
DROP TABLE IF EXISTS `recoleccion`;
CREATE TABLE `recoleccion`  (
  `id_recoleccion` bigint(255) NOT NULL AUTO_INCREMENT,
  `rec_codigo_agente` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Esto contiene el encriptado del Id del agente',
  `id_contribuyente` bigint(255) NOT NULL,
  `rec_datetime` datetime(0) NOT NULL COMMENT 'Registro de fecha y hora del reciclaje',
  `rec_peso` float NOT NULL COMMENT 'Peso del reciclaje',
  PRIMARY KEY (`id_recoleccion`) USING BTREE,
  INDEX `id_agente`(`rec_codigo_agente`) USING BTREE,
  INDEX `id_contribuyente`(`id_contribuyente`) USING BTREE,
  CONSTRAINT `recoleccion_ibfk_2` FOREIGN KEY (`id_contribuyente`) REFERENCES `contribuyente` (`id_contribuyente`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recoleccion
-- ----------------------------
INSERT INTO `recoleccion` VALUES (3, 'a9b7ba70783b617e9998dc4dd82eb3c5', 2, '2021-12-20 20:18:22', 0);
INSERT INTO `recoleccion` VALUES (4, 'a9b7ba70783b617e9998dc4dd82eb3c5', 11, '2021-12-20 20:23:43', 0);
INSERT INTO `recoleccion` VALUES (5, 'a9b7ba70783b617e9998dc4dd82eb3c5', 6, '2021-12-20 20:24:04', 0);
INSERT INTO `recoleccion` VALUES (6, 'a9b7ba70783b617e9998dc4dd82eb3c5', 11, '2021-12-20 20:25:01', 0);
INSERT INTO `recoleccion` VALUES (7, 'a9b7ba70783b617e9998dc4dd82eb3c5', 2, '2021-12-22 10:24:38', 0);
INSERT INTO `recoleccion` VALUES (8, 'a9b7ba70783b617e9998dc4dd82eb3c5', 15, '2021-12-23 08:20:32', 0);
INSERT INTO `recoleccion` VALUES (9, 'a9b7ba70783b617e9998dc4dd82eb3c5', 15, '2021-12-23 08:22:32', 0);
INSERT INTO `recoleccion` VALUES (10, 'a9b7ba70783b617e9998dc4dd82eb3c5', 15, '2021-12-23 08:22:39', 0);
INSERT INTO `recoleccion` VALUES (11, 'a9b7ba70783b617e9998dc4dd82eb3c5', 15, '2021-12-23 08:22:41', 0);
INSERT INTO `recoleccion` VALUES (12, 'a9b7ba70783b617e9998dc4dd82eb3c5', 15, '2021-12-23 08:22:43', 0);

SET FOREIGN_KEY_CHECKS = 1;
