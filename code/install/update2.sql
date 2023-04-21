INSERT INTO `config`(`k`, `v`) VALUES ('is_reg', '1');
UPDATE `config` SET `v` = '2005' WHERE `k` = 'version';
INSERT INTO `config`(`k`, `v`) VALUES ('gg1','公告1');
INSERT INTO `config`(`k`, `v`) VALUES ('gg2','公告2');
INSERT INTO `config`(`k`, `v`) VALUES ('gg3','公告3');

CREATE TABLE `url_safe` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `safe` int(1) DEFAULT '1',
  `remarks` mediumtext,
  `notice` int(1) DEFAULT '1',
  `setip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `url_safe` ADD PRIMARY KEY (`id`);
ALTER TABLE `url_safe` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `log_list` (
  `id` int(11) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `param` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `log_list` ADD PRIMARY KEY (`id`);
ALTER TABLE `log_list` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
ALTER TABLE `visitors` ADD PRIMARY KEY (`id`);
ALTER TABLE `visitors` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_list` ADD COLUMN `mail` varchar(255) DEFAULT NULL;

INSERT INTO `config`(`k`, `v`) VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `config`(`k`, `v`) VALUES ('mail_port', '465');
INSERT INTO `config`(`k`, `v`) VALUES ('mail_name', '');
INSERT INTO `config`(`k`, `v`) VALUES ('mail_pwd', '');
INSERT INTO `config`(`k`, `v`) VALUES ('cronkey', '');
INSERT INTO `config`(`k`, `v`) VALUES ('template', 'blum');
INSERT INTO `config`(`k`, `v`) VALUES ('is_https', '0');