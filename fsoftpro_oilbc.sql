/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3307
 Source Schema         : fsoftpro_oilbc

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 16/03/2020 13:27:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for oil_date
-- ----------------------------
DROP TABLE IF EXISTS `oil_date`;
CREATE TABLE `oil_date` (
  `id_oil` int(255) NOT NULL AUTO_INCREMENT,
  `update_date` datetime DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_oil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for oil_detail
-- ----------------------------
DROP TABLE IF EXISTS `oil_detail`;
CREATE TABLE `oil_detail` (
  `id_detail` int(255) NOT NULL AUTO_INCREMENT,
  `id_oil` int(255) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `today` text COLLATE utf8_unicode_ci,
  `tomorrow` text COLLATE utf8_unicode_ci,
  `yesterday` text COLLATE utf8_unicode_ci,
  `unit_th` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
