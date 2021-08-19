-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-08-19 05:34:09
-- 服务器版本： 5.7.28
-- PHP 版本： 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `source`
--

-- --------------------------------------------------------

--
-- 表的结构 `xs_admin`
--

CREATE TABLE `xs_admin` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `username` varchar(50) DEFAULT NULL COMMENT '管理员账号',
  `password` varchar(52) DEFAULT NULL COMMENT '管理员密码',
  `QQ` varchar(20) NOT NULL COMMENT '管理员QQ',
  `email` varchar(20) NOT NULL COMMENT '管理员邮箱',
  `creat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最近修改时间',
  `status` varchar(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `token` varchar(255) NOT NULL COMMENT 'token值',
  `login_location` varchar(255) NOT NULL COMMENT '最近登陆地点',
  `login_ip` varchar(255) NOT NULL COMMENT '登陆ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `xs_admin`
--

INSERT INTO `xs_admin` (`id`, `username`, `password`, `QQ`, `email`, `creat_time`, `status`, `token`, `login_location`, `login_ip`) VALUES
(1, 'admin', 'xskj', '1829134124', '1829134124@qq.com', '2021-08-18 21:20:30', '1', 'YWRtaW43YWU3ODA2ZjMxY2VmYjJjOTY4NTc0MmZhZWVhODRkOHhza2o4NjgzOA==', '内网IP 内网IP', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `xs_answer_source`
--

CREATE TABLE `xs_answer_source` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL COMMENT '这是问答题目',
  `answer` varchar(255) NOT NULL COMMENT '这是问答答案',
  `category` varchar(255) NOT NULL COMMENT '这是问答分类',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交时间',
  `user` varchar(255) NOT NULL COMMENT '提交用户',
  `jx` text NOT NULL COMMENT '题目解析',
  `type` varchar(255) NOT NULL COMMENT '题类型(1选择题, 2问答题， )',
  `select` text NOT NULL COMMENT '选择题选项',
  `status` int(1) NOT NULL COMMENT '状态（1-通过，0-禁用）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是公共资源题库（主要以大学网课为主）';

-- --------------------------------------------------------

--
-- 表的结构 `xs_category`
--

CREATE TABLE `xs_category` (
  `id` int(11) NOT NULL COMMENT '分类id值',
  `category` varchar(255) NOT NULL COMMENT '所属分类类别',
  `name` varchar(255) NOT NULL COMMENT '分类名',
  `category_id` int(255) NOT NULL COMMENT '所属分类类别id值(唯一)',
  `status` int(2) NOT NULL COMMENT '分类状态(1为可用，0为冻结该类别)',
  `category_name` varchar(255) NOT NULL COMMENT '所属分类类别中文名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是全部分类表';

--
-- 转存表中的数据 `xs_category`
--

INSERT INTO `xs_category` (`id`, `category`, `name`, `category_id`, `status`, `category_name`) VALUES
(1, 'news', '新闻', 0, 1, '文章'),
(2, 'news', '热点', 0, 1, '文章'),
(3, 'news', '军事', 0, 1, '文章'),
(4, 'news', '娱乐', 0, 1, '文章'),
(5, 'news', '社会', 0, 1, '文章'),
(6, 'news', '国际', 0, 1, '文章'),
(7, 'doc', '国际', 1, 1, '文档');

-- --------------------------------------------------------

--
-- 表的结构 `xs_community`
--

CREATE TABLE `xs_community` (
  `id` int(11) NOT NULL COMMENT '社区动态唯一id值',
  `title` varchar(255) NOT NULL COMMENT '社区动态标题',
  `user_id` int(255) NOT NULL COMMENT '社区动态发布者用户id(唯一)',
  `content` varchar(255) NOT NULL COMMENT '社区动态内容',
  `user_name` varchar(255) NOT NULL COMMENT '社区动态发布者昵称',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '社区动态发布时间',
  `user_Head` varchar(255) NOT NULL COMMENT '社区动态发布者头像',
  `comments` int(255) NOT NULL COMMENT '社区动态评论数',
  `forwarding` int(255) NOT NULL COMMENT '社区动态转发数',
  `love` int(255) NOT NULL COMMENT '社区动态点赞数',
  `status` int(1) NOT NULL COMMENT '社区动态审核状态',
  `head_portrait` varchar(255) NOT NULL COMMENT '头像url',
  `read_counter` bigint(20) NOT NULL COMMENT '阅读次数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是社区动态信息表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_community_comments`
--

CREATE TABLE `xs_community_comments` (
  `id` int(11) NOT NULL COMMENT '社区动态评论唯一id值',
  `comments_id` int(255) NOT NULL COMMENT '社区动态拥有者动态唯一id值，用于动态索引',
  `user_id` int(255) NOT NULL COMMENT '社区动态评论者唯一id值',
  `content` varchar(255) NOT NULL COMMENT '社区动态评论内容',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '社区动态评论时间',
  `status` int(1) NOT NULL COMMENT '社区动态评论审核状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是社区动态评论信息表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_driving_bank`
--

CREATE TABLE `xs_driving_bank` (
  `id` int(5) NOT NULL,
  `question` varchar(255) DEFAULT NULL COMMENT '考题',
  `answer` varchar(255) DEFAULT NULL COMMENT '答案',
  `item1` varchar(255) DEFAULT NULL,
  `item2` varchar(255) DEFAULT NULL,
  `item3` varchar(255) DEFAULT NULL,
  `item4` varchar(255) DEFAULT NULL,
  `explains` varchar(1024) DEFAULT NULL COMMENT '解释',
  `url` varchar(255) DEFAULT NULL COMMENT '原图',
  `subject` int(1) DEFAULT NULL COMMENT '驾考类型 1：a1b1科目一(相同)，2：a2b2科目一(相同)，3：c1c2科目一(相同)，4：科目四',
  `qtype` varchar(255) DEFAULT NULL COMMENT '题目类型：单选题、判断题',
  `content` varchar(1024) DEFAULT NULL,
  `solution` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='驾校题库资源' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `xs_email`
--

CREATE TABLE `xs_email` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `smtp` varchar(20) NOT NULL COMMENT '邮箱服务器地址',
  `smtp_port` int(6) NOT NULL COMMENT '邮箱服务器端口',
  `smtp_password` varchar(48) NOT NULL COMMENT '邮箱授权码',
  `email_receive` varchar(100) NOT NULL COMMENT '接收邮箱账号',
  `email` varchar(255) NOT NULL COMMENT '邮箱账号',
  `name` varchar(255) NOT NULL COMMENT '发件人昵称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮箱设置';

--
-- 转存表中的数据 `xs_email`
--

INSERT INTO `xs_email` (`id`, `smtp`, `smtp_port`, `smtp_password`, `email_receive`, `email`, `name`) VALUES
(1, 'smtp.qq.com', 465, 'cdmctdxzwhqhehgb1', '1829134124@qq.com', '1829134124@qq.com', '小松科技');

-- --------------------------------------------------------

--
-- 表的结构 `xs_friend`
--

CREATE TABLE `xs_friend` (
  `id` int(255) NOT NULL COMMENT 'id值',
  `name` varchar(255) NOT NULL COMMENT '网站名称',
  `url` varchar(255) NOT NULL COMMENT '网站url',
  `description` text NOT NULL COMMENT '网站描述',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间',
  `email` varchar(255) NOT NULL COMMENT '站长联系方式',
  `status` int(1) NOT NULL COMMENT '状态（1-启用，0-关闭）',
  `level` varchar(255) NOT NULL COMMENT '级别'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友链表';

--
-- 转存表中的数据 `xs_friend`
--

INSERT INTO `xs_friend` (`id`, `name`, `url`, `description`, `time`, `email`, `status`, `level`) VALUES
(1, '小松科技', 'http://www.xskj.store', '致力于资源分享和资源交流', '2021-08-08 20:29:18', '1829134124@qq.com', 1, '重要'),
(15, '百度', 'http://www.baidu.com', '全球最大的中文搜索引擎', '2021-08-09 13:49:49', '1234@www.baidu.com', 1, '重要');

-- --------------------------------------------------------

--
-- 表的结构 `xs_middleschool_bank`
--

CREATE TABLE `xs_middleschool_bank` (
  `id` int(10) NOT NULL,
  `question` text COMMENT '试题-题干',
  `option_A` text COMMENT '选项A',
  `option_B` text COMMENT '选项B',
  `option_C` text COMMENT '选项C',
  `option_D` text COMMENT '选项D',
  `option_E` text COMMENT '选项E',
  `answer1` text,
  `answer2` text COMMENT '非标准格式答案或含部分过程说明的答案',
  `parse` text COMMENT '试题解析',
  `qtpye` varchar(80) DEFAULT NULL COMMENT '试题题型',
  `diff` float(3,2) DEFAULT NULL COMMENT '试题难度，难度从0-5，越大越难',
  `md5` varchar(50) DEFAULT NULL COMMENT '试题题干的md5值',
  `subjectId` tinyint(2) DEFAULT NULL COMMENT '学科Id',
  `gradeId` int(5) DEFAULT NULL COMMENT '年级ID',
  `knowledges` varchar(225) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL COMMENT '试题区域',
  `year` int(4) DEFAULT NULL COMMENT '试题年份',
  `paperTpye` varchar(50) DEFAULT NULL COMMENT '试题类型：1，月考；2，模拟考；3，中考；4，高考；5，学业考试；6，其他',
  `source` varchar(200) DEFAULT NULL COMMENT '试题来源(试卷)',
  `isSub` tinyint(1) DEFAULT NULL COMMENT '是否有子题',
  `isNormal` tinyint(1) DEFAULT NULL COMMENT '是否常规题，如果选择题无法正常提取标准答案或者选项，有小题的答题无法正常提取小题，则isNormal为0，否则为1',
  `isKonw` tinyint(1) DEFAULT NULL COMMENT '是否匹配章节知识点，1匹配，0不匹配'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='这是中学资源题库';

-- --------------------------------------------------------

--
-- 表的结构 `xs_news`
--

CREATE TABLE `xs_news` (
  `id` int(11) NOT NULL COMMENT '资讯id',
  `title` varchar(255) NOT NULL COMMENT '资讯标题',
  `content` longtext NOT NULL COMMENT '资讯内容',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  `author` varchar(255) NOT NULL COMMENT '发布作者',
  `hits` int(255) NOT NULL COMMENT '阅读次数',
  `star` int(255) NOT NULL COMMENT '文章star星数',
  `status` int(2) NOT NULL COMMENT '文章审核状态',
  `label` varchar(255) NOT NULL COMMENT '文章标签',
  `category` varchar(255) NOT NULL COMMENT '文章类别',
  `image_url` varchar(255) NOT NULL COMMENT '封面图url'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是最新资讯表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_news_comments`
--

CREATE TABLE `xs_news_comments` (
  `id` int(11) NOT NULL COMMENT '文章评论唯一id',
  `news_id` int(255) NOT NULL COMMENT '评论所属文章的唯一id',
  `user_id` int(255) NOT NULL COMMENT '文章评论者用户id',
  `content` varchar(255) NOT NULL COMMENT '文章评论内容',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `status` int(1) NOT NULL COMMENT '评论审核状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是文章动态评论信息表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_order`
--

CREATE TABLE `xs_order` (
  `id` int(11) NOT NULL COMMENT '订单id',
  `user` varchar(255) NOT NULL COMMENT '订单所属用户名',
  `out_trade_no` varchar(255) NOT NULL COMMENT '订单编号',
  `total_amount` float NOT NULL COMMENT '订单金额',
  `subject` varchar(255) NOT NULL COMMENT '商品名',
  `description` varchar(255) NOT NULL COMMENT '商品描述',
  `remark` varchar(255) NOT NULL COMMENT '商品备注',
  `status` int(1) NOT NULL COMMENT '商品状态(0:未支付,1:完成，3:拦截)',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(255) NOT NULL COMMENT '商品分类'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是用户订单详情表';

--
-- 转存表中的数据 `xs_order`
--

INSERT INTO `xs_order` (`id`, `user`, `out_trade_no`, `total_amount`, `subject`, `description`, `remark`, `status`, `time`, `category`) VALUES
(1, 'admin123', '2021811458143383', 520, '购买松币', '这是购买松币', '测试', 0, '2021-08-10 20:58:14', '购买松币'),
(2, 'admin123', '2021811458268520', 520, '购买松币', '这是购买松币', '', 0, '2021-08-10 20:58:26', '购买松币'),
(3, 'admin123', '2021811458315395', 520, '购买松币', '这是购买松币', '', 0, '2021-08-10 20:58:31', '购买松币');

-- --------------------------------------------------------

--
-- 表的结构 `xs_pay`
--

CREATE TABLE `xs_pay` (
  `ID` int(11) NOT NULL COMMENT 'ID',
  `alipay_id` varchar(30) DEFAULT NULL COMMENT '支付宝ID',
  `alipay_private_key` longtext NOT NULL COMMENT '应用私钥',
  `alipay_public_key` text NOT NULL COMMENT '支付宝公钥',
  `wx_id` varchar(19) NOT NULL COMMENT '微信APPID',
  `wx_mchid` varchar(100) NOT NULL COMMENT '微信MCHID',
  `wx_secret` varchar(100) NOT NULL COMMENT '微信SECRET',
  `wx_key` varchar(100) NOT NULL COMMENT '微信秘钥KEY',
  `qq_mchid` varchar(400) NOT NULL COMMENT 'QQMCHID',
  `qq_mchkey` varchar(500) NOT NULL COMMENT 'QQMCHKEY',
  `epay_id` varchar(28) NOT NULL COMMENT '易支付商户ID',
  `epay_key` varchar(200) NOT NULL COMMENT '易支付商户秘钥KEY',
  `codepay_id` varchar(20) NOT NULL COMMENT '码支付商户id',
  `codepay_key` varchar(30) NOT NULL COMMENT '码支付商户秘钥key',
  `pay_opt` varchar(39) NOT NULL COMMENT '支付方式选择',
  `epay_site` varchar(39) NOT NULL COMMENT '易支付接口',
  `codepay_site` varchar(39) NOT NULL COMMENT '码支付接口'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `xs_pay`
--

INSERT INTO `xs_pay` (`ID`, `alipay_id`, `alipay_private_key`, `alipay_public_key`, `wx_id`, `wx_mchid`, `wx_secret`, `wx_key`, `qq_mchid`, `qq_mchkey`, `epay_id`, `epay_key`, `codepay_id`, `codepay_key`, `pay_opt`, `epay_site`, `codepay_site`) VALUES
(0, '2021000117611362', 'MIIEpAIBAAKCAQEAhTHJnoFq/CsR80/mbjK3QrQ/Am789dEWwBDmu9LE3yLS8TV8YJ27nlZRJYmyBEkcMRchRt9PVyVfm7QOxFT2IwsGIpiDfcxFwxuetpEZklD7PEitVzuM40b8w8aW3uAN3KQkaTxT3vnnmAKPNyhM0EsKILuQqIt2TwmGb9VBT96cgv8SjxHcDRH5ZXP80I1G445Tmap3BxtOEfqvCVcA+SHaW8wzAObr9QWLyeKiw7QntEEHiZCpqBC+osmdb2TY5l/fdG4xFKD83pcHpPcbFUGRkwZv8bjf3Ig6paMIvWdU1POSWSWyKzSoSCQfoDcy3fpuB5/943v8bkABr3R14QIDAQABAoIBADwlxpGAieqEHKAOldVvq5hAwy97JVpwaGClgTySKntFQ5LPf3I16JLREeXsr2oGBegZNNrHXxHQe8NZZU29vEUI5mVbEA4P3/UClQKGtdCAJ2QKwdRhvPapiN1z4Y+WCEx6B0NKjelkWvQnO7tBxKZPLKypZuLlz7BTcdUwrUS+bLGWGxpoCzjJJ8BvFFKgl7Z61qzSr9q21sglCGEMYTsiKjiODksqDamc6oDEibTzVpilM8ckEN42/kFXnEYHzactnJ8Bjx2eKlCGPmUkkv1PjIMgmvAlQueHaHmHfgPtfxvCPRlSaFAofmoeUiSF04qX8Pf+JOYEyuucJCk05h0CgYEA5QLX0AZ0coNbft6hzS0buTEasGDg8p8y88n9wemE1om2CuBVMAcUxp4Oa+Fymgso7IqnKe2yMyOafdJDa/lxtD1MMbsQjR9HNzuEmfQQP7wa8X2dFhCtp26B79Ink5oSSjwOgGgAhQtrEO+H3R3xrE6Uu8tjt4pl3BhwF57rR/MCgYEAlOQzx3+rXjvVJbLVkgTIs06f6olILv3BkebMBc1noOuFVXmTp0hlPhLBE+eC/+kspWUHbtUkiZRwm/dsxht6RPFdEWBsfdyeGY3tIUFb39axpIzF/At6w16iIfRyt1wQV4d0A66GvneSCQVE1LSq2jqhckJ4oKda9KyztVJls9sCgYEA34dG3uVuA9fzFoJ3q6y7wqcLRd1Js4dwVER0SzGDV2RTK4qLm7VNsg/UQ7hqA7Gg4ED1qRc5OHEn+mehJ2LyeNrb5C6SmSxOdrrBUwPGWG9iXRQen8rntOVILq0RtCBOeebkwLDC0Rm0B3PFSS5RFb4drq93RU7w3UN9JZEYVcECgYBS4weAVC6OczihmAEVHNyuFWMpKeupXVLZambCBCtghjzf7KKqSb8y4zXhYsymsqRMHwYYSUfh32UhLoi7cKiMoOFyvv8mwh6xkzUjgkMnRVn3hPbi7XEWOiSASpliQjpGv/1x30Lb3azKoMhEsZ87hdBCz4ZfyUr1Uv9oPcqoaQKBgQCVfQet7L3Ml5JypoXmdkfIjNU6ILayhE9H8k9LePnp+ZJJCF71ysFYbcmDVmcr8ogdUBjy9F/YxuZ02rU0m9TJE/wFU4q63YPp6D81EvnGbcEacDrrKqw5hbxEya+k7h+S8CDWBD2+nHNGJk9pSGKVIE6BK+GQtP5o1VRKdwuvrw==', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0NwgbVSYAR9bIUpad+F3k54X4xgY+3Z+7rpr30TrKxvrxsDUqiBdp/LhMxqExcp2M+TO9m7fima3Opfi7AJzuse+oaUXSzCQAu1WqytZgxlCnQZJ/tuFjHKThbA3mIyYQNq32DpOYow4LZs8Md4iJ0E69wj6zo2Hmu4zE4fWky7yJ55ikZuAeChZ7joW+MJMuE3Nkkq/fuhNRlfVFdC41kRURVqs8j7rsenRrEg8jPY5S0668QoltKt00XhBEUVuhMoTTZgkZJinmRLmRfxrxEfpZdoTQCCqVvUdvuudHgMSM8PAdDxw+Ge1tXtV7C4n6btgfJm4IlIUnEZAiHIGwwIDAQAB', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `xs_single_source`
--

CREATE TABLE `xs_single_source` (
  `id` int(11) NOT NULL COMMENT '单一资源id',
  `source` text NOT NULL COMMENT '资源文本',
  `category` varchar(255) NOT NULL COMMENT '资源分类',
  `user` varchar(255) NOT NULL COMMENT '提交资源用户',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '资源提交时间',
  `status` int(1) DEFAULT NULL COMMENT '状态（1-通过， 0-禁用）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是单一资源提交表单些事';

-- --------------------------------------------------------

--
-- 表的结构 `xs_source`
--

CREATE TABLE `xs_source` (
  `id` int(11) NOT NULL COMMENT 'id索引',
  `user_name` varchar(255) NOT NULL COMMENT '上传者昵称',
  `user_id` varchar(255) NOT NULL COMMENT '上传者id值',
  `category` varchar(255) NOT NULL COMMENT '资源分类',
  `download_url` varchar(255) NOT NULL COMMENT '下载链接',
  `label` varchar(255) NOT NULL COMMENT '用户自定义标签',
  `passwd` varchar(255) NOT NULL COMMENT '下载密码',
  `title` varchar(255) NOT NULL COMMENT '资源标题',
  `description` text NOT NULL COMMENT '资源描述',
  `use_description` text NOT NULL COMMENT '资源使用说明',
  `image_url` varchar(255) NOT NULL COMMENT '封面图片链接',
  `status` int(1) NOT NULL COMMENT '状态(0-禁用，1-正常)\r\n',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '耿欣时间\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是资源下载库';

-- --------------------------------------------------------

--
-- 表的结构 `xs_upload_doc_source`
--

CREATE TABLE `xs_upload_doc_source` (
  `id` bigint(20) NOT NULL COMMENT '这是上传文件的id',
  `file_path` varchar(255) NOT NULL COMMENT '这是上传文件的网站目录',
  `classify` varchar(255) NOT NULL COMMENT '这是上传文件的分类',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '这是文件上传的时间',
  `file_type` varchar(255) NOT NULL COMMENT '这是文件上传的类型',
  `status` int(1) NOT NULL COMMENT '这是文件上传的审核状态',
  `user` varchar(255) NOT NULL COMMENT '这是文件上传用户',
  `file_size` bigint(20) NOT NULL COMMENT '这是上传文件的大小',
  `description` text NOT NULL COMMENT '这是上传文件的描述',
  `user_defined_label` varchar(255) NOT NULL COMMENT '用户自定义标签(便于管理文件)',
  `doc_id` bigint(20) NOT NULL COMMENT '文档归类唯一id值',
  `passwd` varchar(255) NOT NULL COMMENT '文档下载秘钥'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是文档文件上传库表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_upload_file_source`
--

CREATE TABLE `xs_upload_file_source` (
  `id` bigint(20) NOT NULL COMMENT '这是上传文件的id',
  `file_path` varchar(255) NOT NULL COMMENT '这是上传文件的网站目录',
  `classify` varchar(255) NOT NULL COMMENT '这是上传文件的分类',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '这是文件上传的时间',
  `file_type` varchar(255) NOT NULL COMMENT '这是文件上传的类型',
  `status` int(1) NOT NULL COMMENT '这是文件上传的审核状态',
  `user` varchar(255) NOT NULL COMMENT '这是文件上传用户',
  `file_size` bigint(20) NOT NULL COMMENT '这是上传文件的大小',
  `description` text NOT NULL COMMENT '这是上传文件的描述',
  `user_defined_label` varchar(255) NOT NULL COMMENT '用户自定义标签(便于管理文件)',
  `doc_id` bigint(20) NOT NULL COMMENT '文档归类唯一id值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是资源提交-----文件上传文件信息表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_user`
--

CREATE TABLE `xs_user` (
  `id` int(11) NOT NULL COMMENT '用户id值',
  `username` varchar(30) NOT NULL COMMENT '用户账号',
  `password` varchar(100) NOT NULL COMMENT '用户密码',
  `level` int(1) NOT NULL COMMENT '用户级别(0:超级管理员;1:中级用户;2:普通用户)',
  `QQ` varchar(255) NOT NULL COMMENT 'QQ账号',
  `email` varchar(30) NOT NULL COMMENT '用户注册邮箱',
  `status` int(11) NOT NULL COMMENT '用户状态',
  `cores` int(11) NOT NULL COMMENT '用户积分',
  `ip` varchar(20) NOT NULL COMMENT '用户登录ip',
  `number` int(11) NOT NULL COMMENT '用户登录次数',
  `weixin_token` varchar(30) NOT NULL COMMENT '用户微信公众号调用token',
  `weixin_key` varchar(30) NOT NULL COMMENT '用户微信公众号调用安全秘钥',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `token` varchar(255) NOT NULL COMMENT '用户token'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户信息表';


-- --------------------------------------------------------

--
-- 表的结构 `xs_websystem`
--

CREATE TABLE `xs_websystem` (
  `ID` int(11) NOT NULL COMMENT 'ID',
  `web_title` varchar(32) NOT NULL COMMENT '网站标题',
  `web_keyword` varchar(60) NOT NULL COMMENT '网站关键词',
  `web_beian` varchar(20) NOT NULL COMMENT '网站备案号',
  `web_description` text NOT NULL COMMENT '网站描述',
  `web_copyright` varchar(40) NOT NULL COMMENT '网站版权信息',
  `web_beian_url` varchar(255) NOT NULL COMMENT '备案号跳转url',
  `web_logo` varchar(255) NOT NULL COMMENT '网站图标log',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '站点状态[boolean类型]',
  `user_id` int(2) NOT NULL COMMENT '用户唯一id',
  `wechat_token` varchar(255) NOT NULL COMMENT '微信对接token',
  `subscribe` text NOT NULL COMMENT '微信公众号关注回复',
  `wechat_public_switch` tinyint(1) NOT NULL COMMENT '微信公众号接口开关(false:关闭，true:开启)',
  `upload_audit_switch` int(1) NOT NULL COMMENT '用户文件上传审核开关控制（1-开启审核，0-关闭审核）',
  `template` varchar(255) NOT NULL COMMENT 'template前端模版名称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `xs_websystem`
--

INSERT INTO `xs_websystem` (`ID`, `web_title`, `web_keyword`, `web_beian`, `web_description`, `web_copyright`, `web_beian_url`, `web_logo`, `status`, `user_id`, `wechat_token`, `subscribe`, `wechat_public_switch`, `upload_audit_switch`, `template`) VALUES
(2, '小松题库系统', '关键词', '黔备ICP1314001', '网站描述', '2020小松科技版权©️所有，仿冒必究', 'http://www.xskj.store', 'http://localhost/upload/logo/slide20210819010154.jpg', 1, 0, 'wechat', '欢迎使用小松科技微信公众号', 1, 0, 'm1');

-- --------------------------------------------------------

--
-- 表的结构 `xs_web_slide`
--

CREATE TABLE `xs_web_slide` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL COMMENT '幻灯片路径',
  `tip_word` varchar(255) NOT NULL COMMENT '提示语',
  `description` text NOT NULL COMMENT '描述',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是网站幻灯片表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_wechat`
--

CREATE TABLE `xs_wechat` (
  `id` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL COMMENT '微信公众号对接开关控制',
  `abutment_url` varchar(1000) NOT NULL COMMENT '微信公众号对接域名url',
  `abutment_token` varchar(1000) NOT NULL COMMENT '微信公众号token',
  `focus_reply` varchar(1000) NOT NULL COMMENT '微信公众号关注回复',
  `noResource_reply` varchar(1000) NOT NULL COMMENT '微信公众号无资源回复',
  `defined_keyword1` varchar(1000) NOT NULL COMMENT '微信公众号自定义关键词回复1',
  `defined_keyword2` varchar(1000) NOT NULL COMMENT '微信公众号自定义关键词回复2',
  `defined_keyword3` varchar(1000) NOT NULL COMMENT '微信公众号自定义关键词回复3'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信公众号设置';

--
-- 转存表中的数据 `xs_wechat`
--

INSERT INTO `xs_wechat` (`id`, `status`, `abutment_url`, `abutment_token`, `focus_reply`, `noResource_reply`, `defined_keyword1`, `defined_keyword2`, `defined_keyword3`) VALUES
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3'),
(1, 1, 'http://localhost:8080/wechat', 'Wechat2020', '欢迎关注小松题库系统微信公众号', '亲！没能搜到！', '自定义1', '自定义2', '自定义3');

-- --------------------------------------------------------

--
-- 表的结构 `xs_wechat_public`
--

CREATE TABLE `xs_wechat_public` (
  `id` int(11) NOT NULL COMMENT 'id值',
  `keywords` varchar(255) NOT NULL COMMENT '事件类型',
  `reply_word` text NOT NULL COMMENT '自动回复词',
  `descriptions` varchar(255) NOT NULL COMMENT '关键词描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='这是微信公众号自动回复表';

--
-- 转存表中的数据 `xs_wechat_public`
--

INSERT INTO `xs_wechat_public` (`id`, `keywords`, `reply_word`, `descriptions`) VALUES
(1, '关键词', '欢迎关注小松科技官方公众号1', '这是用户关注公众号自动回复词'),
(2, '关键词111', '欢迎关注小松科技官方公众号2', '这是用户公众号自动回复词'),
(3, '关键词2111', '欢迎关注小松科技官方公众号3', '这是用户公众号自动回复词'),
(4, '关键词2', '欢迎关注小松科技官方公众号31111', '这是用户公众号自动回复词'),
(5, '关键词2', '欢迎关注小松科技官方公众号3', '这是用户公众号自动回复词');

--
-- 转储表的索引
--

--
-- 表的索引 `xs_admin`
--
ALTER TABLE `xs_admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_answer_source`
--
ALTER TABLE `xs_answer_source`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_category`
--
ALTER TABLE `xs_category`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_community`
--
ALTER TABLE `xs_community`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_community_comments`
--
ALTER TABLE `xs_community_comments`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_driving_bank`
--
ALTER TABLE `xs_driving_bank`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `xs_email`
--
ALTER TABLE `xs_email`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_friend`
--
ALTER TABLE `xs_friend`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_middleschool_bank`
--
ALTER TABLE `xs_middleschool_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_qtypes` (`qtpye`),
  ADD KEY `index_knowedges` (`knowledges`),
  ADD KEY `index_year` (`year`),
  ADD KEY `index_subject_fromsite` (`subjectId`,`isKonw`);

--
-- 表的索引 `xs_news`
--
ALTER TABLE `xs_news`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_news_comments`
--
ALTER TABLE `xs_news_comments`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_order`
--
ALTER TABLE `xs_order`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_pay`
--
ALTER TABLE `xs_pay`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `xs_single_source`
--
ALTER TABLE `xs_single_source`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_source`
--
ALTER TABLE `xs_source`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_upload_doc_source`
--
ALTER TABLE `xs_upload_doc_source`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_upload_file_source`
--
ALTER TABLE `xs_upload_file_source`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_websystem`
--
ALTER TABLE `xs_websystem`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `xs_web_slide`
--
ALTER TABLE `xs_web_slide`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_wechat_public`
--
ALTER TABLE `xs_wechat_public`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `xs_answer_source`
--
ALTER TABLE `xs_answer_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `xs_category`
--
ALTER TABLE `xs_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id值', AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `xs_community`
--
ALTER TABLE `xs_community`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '社区动态唯一id值', AUTO_INCREMENT=38;

--
-- 使用表AUTO_INCREMENT `xs_community_comments`
--
ALTER TABLE `xs_community_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '社区动态评论唯一id值';

--
-- 使用表AUTO_INCREMENT `xs_driving_bank`
--
ALTER TABLE `xs_driving_bank`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `xs_friend`
--
ALTER TABLE `xs_friend`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'id值', AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `xs_middleschool_bank`
--
ALTER TABLE `xs_middleschool_bank`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `xs_news`
--
ALTER TABLE `xs_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '资讯id', AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `xs_news_comments`
--
ALTER TABLE `xs_news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章评论唯一id';

--
-- 使用表AUTO_INCREMENT `xs_order`
--
ALTER TABLE `xs_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `xs_single_source`
--
ALTER TABLE `xs_single_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '单一资源id', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `xs_source`
--
ALTER TABLE `xs_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id索引', AUTO_INCREMENT=32;

--
-- 使用表AUTO_INCREMENT `xs_upload_doc_source`
--
ALTER TABLE `xs_upload_doc_source`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '这是上传文件的id', AUTO_INCREMENT=39;

--
-- 使用表AUTO_INCREMENT `xs_upload_file_source`
--
ALTER TABLE `xs_upload_file_source`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '这是上传文件的id', AUTO_INCREMENT=34;

--
-- 使用表AUTO_INCREMENT `xs_web_slide`
--
ALTER TABLE `xs_web_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `xs_wechat_public`
--
ALTER TABLE `xs_wechat_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id值', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
