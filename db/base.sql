/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80013
 Source Host           : localhost:3306
 Source Schema         : base

 Target Server Type    : MySQL
 Target Server Version : 80013
 File Encoding         : 65001

 Date: 28/12/2018 16:46:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bs_menu
-- ----------------------------
DROP TABLE IF EXISTS `bs_menu`;
CREATE TABLE `bs_menu`  (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `leaf` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bs_menu
-- ----------------------------
INSERT INTO `bs_menu` VALUES (1, -1, '主页', '/Index/index', 1);
INSERT INTO `bs_menu` VALUES (2, -1, '系统管理', '/#', 0);
INSERT INTO `bs_menu` VALUES (210, 2, '用户管理', '/User/index', 1);
INSERT INTO `bs_menu` VALUES (220, 2, '菜单管理', '/Menu/index', 1);

SET FOREIGN_KEY_CHECKS = 1;
