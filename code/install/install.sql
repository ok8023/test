SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE TABLE IF NOT EXISTS `config` (
  `k` varchar(255) NOT NULL,
  `v` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `config` (`k`, `v`) VALUES
('domain', ''),
('uid', '10001'),
('admin_user', 'admin'),
('admin_pwd', '123456'),
('web_qq', '1807139605'),
('web_name', '短网址生成-搏天短网址'),
('keywords', '新浪短网址生成,短网址生成网站,百度短网址生成,腾讯短网址生成,tcn短网址生成,urlcn短网址生成,带后台的短网址,后台短网址生成'),
('description', '搏天短网址-新浪短网址生成,短网址生成网站,百度短网址生成,腾讯短网址生成,tcn短网址生成,urlcn短网址生成,带后台的短网址,后台短网址生成'),
('submit', '保存修改'),
('jump_1', 'https://www.baidu.com'),
('jump_2', 'https://www.baidu.com'),
('jump_3', 'https://www.baidu.com'),
('web_cc', '0'),
('version', '2005'),
('is_reg', '1'),
('gg1', '网址管理界面因网址过长，影响美观，所有不显示长网址，只显示一个新浪短网址，点击ID按钮可以查看该网址的详细信息'),
('gg2', '发现bug，有好意见的，都可以加群反馈交流，群号：654012421 <a href="https://jq.qq.com/?_wv=1027&k=5no0SE9" class="btn btn-success" target=_blank>点击加群</a>'),
('gg3', '公告3'),
('is_https', '0'),
('template', 'blum'),
('index_bg', '1'),
('mail_smtp', 'smtp.qq.com'),
('mail_port', '465'),
('mail_name', ''),
('mail_pwd', ''),
('cronkey', '');
CREATE TABLE IF NOT EXISTS `log_list` (
  `id` int(11) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `param` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `url_list` (
  `id` varchar(20) NOT NULL,
  `uid` int(20) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `tcn` varchar(255) DEFAULT NULL,
  `urlcn` varchar(255) DEFAULT NULL,
  `url` mediumtext,
  `qqjump` mediumtext,
  `wxjump` mediumtext,
  `alijump` mediumtext,
  `setip` varchar(255) DEFAULT NULL,
  `state` int(1) DEFAULT '1' COMMENT '状态',
  `remarks` mediumtext COMMENT '描述',
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `url_safe` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `safe` int(1) DEFAULT '1',
  `remarks` mediumtext,
  `notice` int(1) DEFAULT '1',
  `setip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `user_list` (
  `id` int(255) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `power` int(1) DEFAULT '0',
  `qq` varchar(255) DEFAULT NULL,
  `state` int(255) DEFAULT '1',
  `mail` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `lasttime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8;
INSERT INTO `user_list` (`id`, `user`, `pwd`, `addtime`, `power`, `qq`, `state`, `mail`, `token`, `lasttime`) VALUES
(10001, '1807139605', '123456', '2019-10-17 09:51:08', 0, '123456', 1, '1807139605@qq.com', NULL, NULL);
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `urlid` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `froms` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `system` varchar(255) DEFAULT NULL,
  `pageview` varchar(500) DEFAULT NULL,
  `source_link` varchar(500) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `config`
  ADD PRIMARY KEY (`k`);
ALTER TABLE `log_list`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `url_list`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `url_safe`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `log_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `url_safe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10002;
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;