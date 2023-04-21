UPDATE `config` SET `v` = '2005' WHERE `k` = 'version';

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

INSERT INTO `config`(`k`, `v`) VALUES ('template', 'blum');
INSERT INTO `config`(`k`, `v`) VALUES ('is_https', '0');