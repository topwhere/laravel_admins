/*
 Navicat Premium Data Transfer

 Source Server         : q1
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : laravel

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 25/01/2018 01:07:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '//分类名称',
  `article_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '//分类标题',
  `article_description` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '//关键词',
  `article_see` int(11) DEFAULT 0 COMMENT '//点击次数',
  `article_or` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '//发布状态',
  `article_order` tinyint(11) DEFAULT 0 COMMENT '//排序',
  `article_fid` int(11) DEFAULT 0 COMMENT '//父级ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '//文章列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_article
-- ----------------------------
INSERT INTO `blog_article` VALUES (1, '新闻', 'win问资讯', '新闻', 0, '取消', 0, 1);
INSERT INTO `blog_article` VALUES (2, '军事新闻1', '军事新闻', '军事新闻', 0, '取消', 1, 1);
INSERT INTO `blog_article` VALUES (8, '新闻', '新闻列表1', '新闻资讯', 0, '发布', 1, 0);
INSERT INTO `blog_article` VALUES (4, 'qqq', 'qq', 'qq', 0, '取消', 1, 1);
INSERT INTO `blog_article` VALUES (5, '1', '1', '1', 0, '隐藏', 1, 1);
INSERT INTO `blog_article` VALUES (6, '2123123', '3123', '312312', 0, '发布', 127, 1);
INSERT INTO `blog_article` VALUES (7, '132', '31', '132', 0, '发布', 0, 1);
INSERT INTO `blog_article` VALUES (9, '11', '11', '1', 0, '发布', 0, 0);

-- ----------------------------
-- Table structure for blog_picture
-- ----------------------------
DROP TABLE IF EXISTS `blog_picture`;
CREATE TABLE `blog_picture`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//',
  `pic_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '//归属导航',
  `pic_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '//图片名称',
  `pic_src` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '//图片上传名称',
  `pic_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '//图片附带链接',
  `pic_orders` int(11) DEFAULT 0 COMMENT '//图片排序',
  `pic_or` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '//图片状态',
  `fid` int(11) DEFAULT 0 COMMENT '//图片外键',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_picture
-- ----------------------------
INSERT INTO `blog_picture` VALUES (20, '新闻', '11', '20171208080717433.JPG', '11', 0, '待审核...', 0);
INSERT INTO `blog_picture` VALUES (19, '新闻', '', '20171208074438102.JPG', '', 0, '待审核...', 0);
INSERT INTO `blog_picture` VALUES (21, '新闻', '111', '20171208084848972.jpg', '11', 1, '待审核...', 0);
INSERT INTO `blog_picture` VALUES (16, '新闻', '12312', '20171208074036324.JPG', '11', 0, '待审核...', 0);

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//用户名',
  `userpwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//密码',
  `mumber` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//登陆次数',
  `old_time` datetime DEFAULT NULL COMMENT '//上次登录时间',
  `old_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//上次登录ip',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '//管理员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES (1, 'admin', 'eyJpdiI6IkpXOUNabExnODdJVHB1cGVtajh4alE9PSIsInZhbHVlIjoiSW1jZFcwMUt1K3B2amJyaVRGRWsxeHdKZXNTWFRXMVFpTk9sS2FrNVVoST0iLCJtYWMiOiJmOWJhMjI1MzYwOWNmNjVmNmM5ODEwNDk0NzA3ZDMxNWMxNjEwOWRhMmY1ZWU5NTNkZDM3ODRhNGE2MDk1ZWFjIn0=', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for blog_writing
-- ----------------------------
DROP TABLE IF EXISTS `blog_writing`;
CREATE TABLE `blog_writing`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//归属导航',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//文章标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '//文章内容',
  `tal` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//关键词',
  `see` int(11) DEFAULT 0 COMMENT '//浏览量',
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//文章作者',
  `orders` int(11) DEFAULT 0 COMMENT '//排序值',
  `writing_or` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '//发布状态',
  `fid` int(11) DEFAULT 0 COMMENT '//外键',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_writing
-- ----------------------------
INSERT INTO `blog_writing` VALUES (2, '军事新闻1', '亚马逊军事新闻', '<p>军事热搜军事热搜军事热搜军事热搜军事热搜<img src=\"/ueditor/php/upload/image/20171204/1512381321.png\" title=\"1512381321.png\" alt=\"手机端title修改.png\"/></p>', '军事热搜', 0, '王哲', 3, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (5, '新闻', '123', '&nbsp;&nbsp;&nbsp;&nbsp;<p>123</p>', '13123', 0, '1', 3, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (4, '新闻', '123', '<p>12312312</p>', '12', 0, '312', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (6, '新闻', '123', '<p>123</p>', '123', 0, '32123', 23, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (7, '新闻', '123', '<p>123</p>', '3', 0, '13123', 131, '发布', 0);
INSERT INTO `blog_writing` VALUES (8, '新闻', '1231', '&nbsp;&nbsp;&nbsp;&nbsp;<p>231312312</p>', '23', 0, '123123', 31, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (9, '新闻', '1231', '&nbsp;&nbsp;&nbsp;&nbsp;<p>231312312</p>', '23', 0, '123123', 31, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (10, '新闻', '1231', '&nbsp;&nbsp;&nbsp;&nbsp;<p>231312312</p>', '23', 0, '123123', 31, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (11, '新闻', '123', '<p>1&nbsp;&nbsp;&nbsp;&nbsp;3123123123</p>', '123', 0, '12313123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (12, '新闻', '123', '<p>1&nbsp;&nbsp;&nbsp;&nbsp;3123123123</p>', '123', 0, '12313123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (13, '新闻', '123', '<p>1&nbsp;&nbsp;&nbsp;&nbsp;3123123123</p>', '123', 0, '12313123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (14, '新闻', '123', '<p>1&nbsp;&nbsp;&nbsp;&nbsp;3123123123</p>', '123', 0, '12313123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (15, '新闻', '123', '<p>1&nbsp;&nbsp;&nbsp;&nbsp;3123123123</p>', '123', 0, '12313123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (16, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (17, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (18, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (19, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (20, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (21, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (22, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (23, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (24, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (25, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);
INSERT INTO `blog_writing` VALUES (26, '新闻', '3', '<p>1231231</p>', '1231', 0, '23123123', 123, '待审核...', 0);

SET FOREIGN_KEY_CHECKS = 1;
