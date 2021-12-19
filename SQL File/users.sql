/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-12-19 10:27:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `created_on` varchar(255) DEFAULT NULL,
  `updated_on` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Nags', 'nagendrakommireddi@gmail.com', 'test!@#$%', '0', '1678095753', null);
INSERT INTO `users` VALUES ('2', 'syam', 'syam_s@gmail.com', 'syam123', '0', '1678095753', null);
INSERT INTO `users` VALUES ('3', 'Aravind', 'nagaravind@gmail.com', 'test#@!123', '0', '1678095753', null);
INSERT INTO `users` VALUES ('4', 'changed_test1', 'test@gmail.com', 'testing!@#', '1', null, '1639884747');
INSERT INTO `users` VALUES ('5', 'Nagendra', 'nagendrakommireddi@gmail.com', 'Nags123!@#', '0', null, null);
