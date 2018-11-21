/*
Navicat MySQL Data Transfer

Source Server         : me
Source Server Version : 100116
Source Host           : localhost:3306
Source Database       : pos

Target Server Type    : MYSQL
Target Server Version : 100116
File Encoding         : 65001

Date: 2018-08-08 06:35:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api_access
-- ----------------------------
DROP TABLE IF EXISTS `api_access`;
CREATE TABLE `api_access` (
  `id` bigint(20) NOT NULL,
  `key` varchar(40) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `date_created` datetime(6) DEFAULT NULL,
  `date_modified` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api_access
-- ----------------------------
INSERT INTO `api_access` VALUES ('1', 'f6eed6446c15978f9e4021b99b928851', 'authentication/do_login_get', '2018-07-31 16:32:36.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `api_access` VALUES ('2', 'f6eed6446c15978f9e4021b99b928851', 'authentication/do_login_post', '2018-07-31 16:32:36.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `api_access` VALUES ('3', 'f6eed6446c15978f9e4021b99b928851', 'authentication/init_token_get', '2018-07-31 16:32:36.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `api_access` VALUES ('4', 'f6eed6446c15978f9e4021b99b928851', 'authentication/logout_get', '2018-07-31 16:32:36.000000', '0000-00-00 00:00:00.000000');

-- ----------------------------
-- Table structure for api_key
-- ----------------------------
DROP TABLE IF EXISTS `api_key`;
CREATE TABLE `api_key` (
  `key` varchar(56) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` int(11) NOT NULL,
  `is_private_key` int(11) NOT NULL,
  `ip_addresses` varchar(0) DEFAULT NULL,
  `date_created` int(11) NOT NULL,
  `id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api_key
-- ----------------------------
INSERT INTO `api_key` VALUES ('f6eed6446c15978f9e4021b99b928851', '2', '0', '0', null, '31072018', '1');

-- ----------------------------
-- Table structure for api_logs
-- ----------------------------
DROP TABLE IF EXISTS `api_logs`;
CREATE TABLE `api_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` varchar(0) DEFAULT NULL,
  `api_key` varchar(56) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` double DEFAULT NULL,
  `authorized` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api_logs
-- ----------------------------
INSERT INTO `api_logs` VALUES ('1', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030712', null, '1');
INSERT INTO `api_logs` VALUES ('2', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030754', null, '1');
INSERT INTO `api_logs` VALUES ('3', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030775', null, '1');
INSERT INTO `api_logs` VALUES ('4', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030800', null, '1');
INSERT INTO `api_logs` VALUES ('5', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030814', null, '1');
INSERT INTO `api_logs` VALUES ('6', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030837', null, '1');
INSERT INTO `api_logs` VALUES ('7', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030857', '0.37400603294373', '1');
INSERT INTO `api_logs` VALUES ('8', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030887', null, '1');
INSERT INTO `api_logs` VALUES ('9', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030909', '0.72144079208374', '1');
INSERT INTO `api_logs` VALUES ('10', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030929', '0.23149681091309', '1');
INSERT INTO `api_logs` VALUES ('11', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533030941', '0.25264120101929', '1');
INSERT INTO `api_logs` VALUES ('12', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031599', '0.3915319442749', '1');
INSERT INTO `api_logs` VALUES ('13', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031726', '3.3054871559143', '1');
INSERT INTO `api_logs` VALUES ('14', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031762', null, '1');
INSERT INTO `api_logs` VALUES ('15', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031798', null, '1');
INSERT INTO `api_logs` VALUES ('16', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031809', null, '1');
INSERT INTO `api_logs` VALUES ('17', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031815', null, '1');
INSERT INTO `api_logs` VALUES ('18', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031836', null, '1');
INSERT INTO `api_logs` VALUES ('19', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031853', '0.25273489952087', '1');
INSERT INTO `api_logs` VALUES ('20', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031876', null, '1');
INSERT INTO `api_logs` VALUES ('21', 'authentication/login', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031900', '0.1881160736084', '1');
INSERT INTO `api_logs` VALUES ('22', 'authentication/test', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533031925', '0.25034999847412', '1');
INSERT INTO `api_logs` VALUES ('23', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533032482', '0.92406511306763', '1');
INSERT INTO `api_logs` VALUES ('24', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533086363', '2.7461631298065', '1');
INSERT INTO `api_logs` VALUES ('25', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533086518', '0.27616691589355', '1');
INSERT INTO `api_logs` VALUES ('26', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533087211', '3.1781558990479', '1');
INSERT INTO `api_logs` VALUES ('27', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533087261', '0.33969521522522', '1');
INSERT INTO `api_logs` VALUES ('28', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533087300', '0.17399787902832', '1');
INSERT INTO `api_logs` VALUES ('29', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533087356', '0.33632302284241', '1');
INSERT INTO `api_logs` VALUES ('30', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533088867', '3.5539140701294', '1');
INSERT INTO `api_logs` VALUES ('31', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533088878', '0.3019700050354', '1');
INSERT INTO `api_logs` VALUES ('32', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533088966', '0.21602392196655', '1');
INSERT INTO `api_logs` VALUES ('33', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533088984', '0.29717111587524', '1');
INSERT INTO `api_logs` VALUES ('34', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533088985', '0.13789916038513', '1');
INSERT INTO `api_logs` VALUES ('35', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089013', '0.19676113128662', '1');
INSERT INTO `api_logs` VALUES ('36', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089022', '0.19649481773376', '1');
INSERT INTO `api_logs` VALUES ('37', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089037', '0.11518907546997', '1');
INSERT INTO `api_logs` VALUES ('38', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089846', '0.51343202590942', '1');
INSERT INTO `api_logs` VALUES ('39', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089847', '0.130450963974', '1');
INSERT INTO `api_logs` VALUES ('40', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089863', '0.32502198219299', '1');
INSERT INTO `api_logs` VALUES ('41', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089864', '0.12541890144348', '1');
INSERT INTO `api_logs` VALUES ('42', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089890', '0.18964910507202', '1');
INSERT INTO `api_logs` VALUES ('43', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089891', '0.11646699905396', '1');
INSERT INTO `api_logs` VALUES ('44', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089919', '0.37140703201294', '1');
INSERT INTO `api_logs` VALUES ('45', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533089920', '0.1009361743927', '1');
INSERT INTO `api_logs` VALUES ('46', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090505', '0.37360310554504', '1');
INSERT INTO `api_logs` VALUES ('47', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090573', '0.36764788627625', '1');
INSERT INTO `api_logs` VALUES ('48', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090611', '0.27358794212341', '1');
INSERT INTO `api_logs` VALUES ('49', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090618', '0.20019793510437', '1');
INSERT INTO `api_logs` VALUES ('50', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090641', '0.20302605628967', '1');
INSERT INTO `api_logs` VALUES ('51', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090650', '0.20149397850037', '1');
INSERT INTO `api_logs` VALUES ('52', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090668', '0.24520182609558', '1');
INSERT INTO `api_logs` VALUES ('53', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090682', '0.22651505470276', '1');
INSERT INTO `api_logs` VALUES ('54', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090683', '0.12018394470215', '1');
INSERT INTO `api_logs` VALUES ('55', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090967', '3.2315728664398', '1');
INSERT INTO `api_logs` VALUES ('56', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090974', '0.25722694396973', '1');
INSERT INTO `api_logs` VALUES ('57', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533090975', '0.092988014221191', '1');
INSERT INTO `api_logs` VALUES ('58', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533091640', '3.4074580669403', '1');
INSERT INTO `api_logs` VALUES ('59', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533091640', '0.14306902885437', '1');
INSERT INTO `api_logs` VALUES ('60', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533091657', '0.25939917564392', '1');
INSERT INTO `api_logs` VALUES ('61', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533091658', '0.12789988517761', '1');
INSERT INTO `api_logs` VALUES ('62', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092183', '1.4184160232544', '1');
INSERT INTO `api_logs` VALUES ('63', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092189', '0.2326078414917', '1');
INSERT INTO `api_logs` VALUES ('64', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092190', '0.13238096237183', '1');
INSERT INTO `api_logs` VALUES ('65', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092345', '3.2656819820404', '1');
INSERT INTO `api_logs` VALUES ('66', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092345', '0.090721845626831', '1');
INSERT INTO `api_logs` VALUES ('67', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092509', '3.2154388427734', '1');
INSERT INTO `api_logs` VALUES ('68', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533092509', '0.13379597663879', '1');
INSERT INTO `api_logs` VALUES ('69', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533093770', '0.4917619228363', '1');
INSERT INTO `api_logs` VALUES ('70', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533093771', '0.18054604530334', '1');
INSERT INTO `api_logs` VALUES ('71', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533181270', '5.6572120189667', '1');
INSERT INTO `api_logs` VALUES ('72', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533181271', '0.097193956375122', '1');
INSERT INTO `api_logs` VALUES ('73', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533267826', '4.6940929889679', '1');
INSERT INTO `api_logs` VALUES ('74', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533267826', '0.09582781791687', '1');
INSERT INTO `api_logs` VALUES ('75', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533564931', '0.54035496711731', '1');
INSERT INTO `api_logs` VALUES ('76', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533564948', '0.23651814460754', '1');
INSERT INTO `api_logs` VALUES ('77', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533564964', '0.20190191268921', '1');
INSERT INTO `api_logs` VALUES ('78', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533564974', '0.10404396057129', '1');
INSERT INTO `api_logs` VALUES ('79', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533564983', '0.216383934021', '1');
INSERT INTO `api_logs` VALUES ('80', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533564998', '0.21744799613953', '1');
INSERT INTO `api_logs` VALUES ('81', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565045', '0.16558289527893', '1');
INSERT INTO `api_logs` VALUES ('82', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565245', '0.11146211624146', '1');
INSERT INTO `api_logs` VALUES ('83', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565246', '0.097831010818481', '1');
INSERT INTO `api_logs` VALUES ('84', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565359', '0.20360589027405', '1');
INSERT INTO `api_logs` VALUES ('85', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565387', '0.14188098907471', '1');
INSERT INTO `api_logs` VALUES ('86', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565394', '0.15622591972351', '1');
INSERT INTO `api_logs` VALUES ('87', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533565394', '0.20895099639893', '1');
INSERT INTO `api_logs` VALUES ('88', 'authentication/do_login', 'post', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533653250', '1.2876811027527', '1');
INSERT INTO `api_logs` VALUES ('89', 'authentication/init_token', 'get', '', 'f6eed6446c15978f9e4021b99b928851', '::1', '1533653251', '0.14420485496521', '1');

-- ----------------------------
-- Table structure for buy_item
-- ----------------------------
DROP TABLE IF EXISTS `buy_item`;
CREATE TABLE `buy_item` (
  `buying_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buy_item_price` int(11) NOT NULL,
  `buy_item_qty` int(11) NOT NULL,
  `buy_item_flag` int(11) NOT NULL,
  `buy_item_diskon` int(11) NOT NULL,
  PRIMARY KEY (`buying_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of buy_item
-- ----------------------------

-- ----------------------------
-- Table structure for document
-- ----------------------------
DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
  `doc_parentid` int(11) NOT NULL,
  `doc_name` varchar(45) NOT NULL,
  `doc_type` varchar(45) NOT NULL,
  `doc_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of document
-- ----------------------------

-- ----------------------------
-- Table structure for fitur
-- ----------------------------
DROP TABLE IF EXISTS `fitur`;
CREATE TABLE `fitur` (
  `fitur_id` varchar(255) NOT NULL,
  `fitur_name` varchar(100) NOT NULL,
  PRIMARY KEY (`fitur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fitur
-- ----------------------------

-- ----------------------------
-- Table structure for log_activity
-- ----------------------------
DROP TABLE IF EXISTS `log_activity`;
CREATE TABLE `log_activity` (
  `log_id` varchar(45) NOT NULL,
  `log_caption` varchar(45) DEFAULT NULL,
  `log_created` date NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_activity
-- ----------------------------

-- ----------------------------
-- Table structure for m_category
-- ----------------------------
DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category` (
  `category_id` varchar(45) NOT NULL,
  `category_name` varchar(45) DEFAULT NULL,
  `category_flag` varchar(45) DEFAULT NULL,
  `category_datecreated` date NOT NULL,
  `category_dateupdated` date NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_category
-- ----------------------------

-- ----------------------------
-- Table structure for m_courier
-- ----------------------------
DROP TABLE IF EXISTS `m_courier`;
CREATE TABLE `m_courier` (
  `courier_id` varchar(45) NOT NULL,
  `courier_name` varchar(45) DEFAULT NULL,
  `courier_flag` varchar(45) DEFAULT NULL,
  `courier_dateupdated` date NOT NULL,
  `courier_datecreated` date NOT NULL,
  PRIMARY KEY (`courier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_courier
-- ----------------------------
INSERT INTO `m_courier` VALUES ('1', 'JNE', null, '2018-08-07', '0000-00-00');
INSERT INTO `m_courier` VALUES ('2', 'JNT', null, '2018-08-05', '0000-00-00');
INSERT INTO `m_courier` VALUES ('28e81184-9a51-11e8-a1d1-c86000b7040e', '121212', null, '2018-08-07', '2018-08-07');
INSERT INTO `m_courier` VALUES ('31fbd9e2-98b7-11e8-8f62-c86000b7040e', '222', null, '2018-08-05', '2018-08-05');
INSERT INTO `m_courier` VALUES ('640cd415-9a56-11e8-a1d1-c86000b7040e', 'a', null, '0000-00-00', '2018-08-07');
INSERT INTO `m_courier` VALUES ('66ddf920-9a56-11e8-a1d1-c86000b7040e', 'c', null, '0000-00-00', '2018-08-07');
INSERT INTO `m_courier` VALUES ('699cc1bb-9a56-11e8-a1d1-c86000b7040e', 'd', null, '0000-00-00', '2018-08-07');
INSERT INTO `m_courier` VALUES ('72818b0c-9a56-11e8-a1d1-c86000b7040e', 'b', null, '2018-08-08', '2018-08-07');
INSERT INTO `m_courier` VALUES ('7505cd5c-9a56-11e8-a1d1-c86000b7040e', 'qwqw', null, '0000-00-00', '2018-08-07');

-- ----------------------------
-- Table structure for m_mediasale
-- ----------------------------
DROP TABLE IF EXISTS `m_mediasale`;
CREATE TABLE `m_mediasale` (
  `mos_id` varchar(255) NOT NULL,
  `mos_name` varchar(100) NOT NULL,
  `mos_code` varchar(30) NOT NULL,
  `mos_dateupdated` date NOT NULL,
  `mos_datecreated` date NOT NULL,
  PRIMARY KEY (`mos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_mediasale
-- ----------------------------

-- ----------------------------
-- Table structure for m_region
-- ----------------------------
DROP TABLE IF EXISTS `m_region`;
CREATE TABLE `m_region` (
  `reg_id` varchar(45) NOT NULL,
  `reg_name` varchar(255) NOT NULL,
  `parent_reg_id` varchar(45) NOT NULL,
  `reg__datecreated` date NOT NULL,
  `reg_dateupdated` date NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_region
-- ----------------------------

-- ----------------------------
-- Table structure for m_state_trx
-- ----------------------------
DROP TABLE IF EXISTS `m_state_trx`;
CREATE TABLE `m_state_trx` (
  `trx_state_id` int(11) NOT NULL,
  `trx_state_caption` varchar(255) NOT NULL,
  `trx_state_flag` varchar(5) NOT NULL,
  PRIMARY KEY (`trx_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_state_trx
-- ----------------------------

-- ----------------------------
-- Table structure for m_suplier
-- ----------------------------
DROP TABLE IF EXISTS `m_suplier`;
CREATE TABLE `m_suplier` (
  `suplier_name` varchar(50) NOT NULL,
  `supiler_address` varchar(45) DEFAULT NULL,
  `suplier_phone` varchar(15) NOT NULL,
  `suplier_id` varchar(255) NOT NULL,
  `suplier_dateupdated` date NOT NULL,
  `suplier_datecreated` date NOT NULL,
  PRIMARY KEY (`suplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_suplier
-- ----------------------------

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_userid` varchar(255) NOT NULL,
  `user_datecreated` date NOT NULL,
  `user_dateupdated` date NOT NULL,
  PRIMARY KEY (`user_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('admin', '0cc175b9c0f1b6a831c399e269772661', '1', '0000-00-00', '0000-00-00');

-- ----------------------------
-- Table structure for m_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `m_usergroup`;
CREATE TABLE `m_usergroup` (
  `urg_id` varchar(255) NOT NULL,
  `urg_name` varchar(45) NOT NULL,
  `urg_dateupdated` date NOT NULL,
  `urg_datecreated` date NOT NULL,
  PRIMARY KEY (`urg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_usergroup
-- ----------------------------
INSERT INTO `m_usergroup` VALUES ('1', 'admin', '0000-00-00', '0000-00-00');

-- ----------------------------
-- Table structure for m_warehouse
-- ----------------------------
DROP TABLE IF EXISTS `m_warehouse`;
CREATE TABLE `m_warehouse` (
  `wr_id` varchar(255) NOT NULL,
  `wr_name` varchar(50) NOT NULL,
  `wr_address` varchar(45) DEFAULT NULL,
  `wr_dateupdated` date NOT NULL,
  `wr_datecreated` date NOT NULL,
  PRIMARY KEY (`wr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_warehouse
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `prod_name` varchar(50) NOT NULL,
  `prod_code` varchar(30) NOT NULL,
  `prod_id` varchar(45) NOT NULL,
  `prod_desc` varchar(255) DEFAULT NULL,
  `prod_kind` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `prod_barcode` varchar(45) NOT NULL,
  `prod_stock_minimal` int(11) NOT NULL,
  `prod_piece` int(11) NOT NULL,
  `prod_width` int(11) NOT NULL,
  `prod_height` int(11) NOT NULL,
  `prod_weight` int(11) NOT NULL,
  `prod_state` int(11) NOT NULL,
  `prod_created_by` varchar(45) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for product_buy
-- ----------------------------
DROP TABLE IF EXISTS `product_buy`;
CREATE TABLE `product_buy` (
  `wr_id` varchar(45) DEFAULT NULL,
  `suplier_id` varchar(45) DEFAULT NULL,
  `buy_id` int(11) NOT NULL,
  `buy_datecreated` date NOT NULL,
  `user_userid` int(11) NOT NULL,
  `buy_state` int(11) NOT NULL,
  `buy_payment_term` int(11) NOT NULL,
  `buy_payment_method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_buy
-- ----------------------------

-- ----------------------------
-- Table structure for product_stock
-- ----------------------------
DROP TABLE IF EXISTS `product_stock`;
CREATE TABLE `product_stock` (
  `prod_id` int(11) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `buy_id` varchar(45) NOT NULL,
  `wr_id` varchar(45) NOT NULL,
  `prod_flag_source` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_stock
-- ----------------------------

-- ----------------------------
-- Table structure for retur
-- ----------------------------
DROP TABLE IF EXISTS `retur`;
CREATE TABLE `retur` (
  `retur_id` varchar(45) NOT NULL,
  `retur_date` date NOT NULL,
  `retur_desc` varchar(45) DEFAULT NULL,
  `user_userid` varchar(45) NOT NULL,
  `trx_id` varchar(45) NOT NULL,
  PRIMARY KEY (`retur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of retur
-- ----------------------------

-- ----------------------------
-- Table structure for retur_item
-- ----------------------------
DROP TABLE IF EXISTS `retur_item`;
CREATE TABLE `retur_item` (
  `item_id` varchar(45) NOT NULL,
  `prod_id` varchar(45) NOT NULL,
  `retur_item_flag` varchar(45) NOT NULL,
  `retur_item_description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of retur_item
-- ----------------------------

-- ----------------------------
-- Table structure for shiping_pricing
-- ----------------------------
DROP TABLE IF EXISTS `shiping_pricing`;
CREATE TABLE `shiping_pricing` (
  `courier_id` varchar(45) NOT NULL,
  `shiping_start` varchar(45) NOT NULL,
  `shiping_end` varchar(45) NOT NULL,
  `shiping_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shiping_pricing
-- ----------------------------

-- ----------------------------
-- Table structure for simplelist
-- ----------------------------
DROP TABLE IF EXISTS `simplelist`;
CREATE TABLE `simplelist` (
  `list_id` varchar(45) NOT NULL,
  `list_caption` varchar(255) NOT NULL,
  `list_flag` varchar(255) NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of simplelist
-- ----------------------------

-- ----------------------------
-- Table structure for trx
-- ----------------------------
DROP TABLE IF EXISTS `trx`;
CREATE TABLE `trx` (
  `trx_id` varchar(45) NOT NULL,
  `trx_date` date NOT NULL,
  `trx_type` varchar(45) NOT NULL,
  `trx_payment_term` varchar(45) DEFAULT NULL,
  `trx_invoice_mos` varchar(45) NOT NULL,
  `trx_invoice` varchar(45) NOT NULL,
  `trx_payment_method` varchar(45) NOT NULL,
  `trx_courier` varchar(45) NOT NULL,
  `trx_customer` varchar(45) NOT NULL,
  `trx_state_id` varchar(45) NOT NULL,
  `user_userid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trx
-- ----------------------------

-- ----------------------------
-- Table structure for trx_cost
-- ----------------------------
DROP TABLE IF EXISTS `trx_cost`;
CREATE TABLE `trx_cost` (
  `trx_id` varchar(45) DEFAULT NULL,
  `trx_cost_id` varchar(45) NOT NULL,
  `trx_cost_estimation_price` decimal(10,0) NOT NULL,
  `trx_cost_price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`trx_cost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trx_cost
-- ----------------------------

-- ----------------------------
-- Table structure for trx_item
-- ----------------------------
DROP TABLE IF EXISTS `trx_item`;
CREATE TABLE `trx_item` (
  `item_id` varchar(45) DEFAULT NULL,
  `prod_code` varchar(45) DEFAULT NULL,
  `prod_price` decimal(10,0) NOT NULL,
  `item_qty` decimal(10,0) NOT NULL,
  `item_created` date NOT NULL,
  `item_isflashsale` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_width` int(11) NOT NULL,
  `prod_height` int(11) NOT NULL,
  `prod_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trx_item
-- ----------------------------

-- ----------------------------
-- Table structure for trx_log
-- ----------------------------
DROP TABLE IF EXISTS `trx_log`;
CREATE TABLE `trx_log` (
  `trx_log_id` varchar(45) NOT NULL,
  `trx_log_catpion` varchar(255) NOT NULL,
  `trx_id` varchar(45) NOT NULL,
  PRIMARY KEY (`trx_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trx_log
-- ----------------------------

-- ----------------------------
-- Table structure for user_fitur
-- ----------------------------
DROP TABLE IF EXISTS `user_fitur`;
CREATE TABLE `user_fitur` (
  `user_id` varchar(255) NOT NULL,
  `fitur_id` varchar(255) NOT NULL,
  `user_fitur_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_fitur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_fitur
-- ----------------------------

-- ----------------------------
-- Table structure for user_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `user_usergroup`;
CREATE TABLE `user_usergroup` (
  `user_userid` varchar(255) NOT NULL,
  `user_usergroup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_usergroup
-- ----------------------------
INSERT INTO `user_usergroup` VALUES ('1', '1');
