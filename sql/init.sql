CREATE DATABASE `tabelog_clone`;

use tabelog_clone

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `shops` ADD PRIMARY KEY (`id`);
ALTER TABLE `shops` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ファイルアップロードに必要なカラムの追加
alter table shops add photo varchar(255) DEFAULT NULL;
alter table shops add photo_dir varchar(255) DEFAULT NULL;

--usersテーブル作成
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `users` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


-- reviewsテーブルの作成
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `score` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `reviews` ADD PRIMARY KEY (`id`);
ALTER TABLE `reviews` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reviews` ADD KEY `user_id` (`user_id`), ADD KEY `shop_id` (`shop_id`);
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);


-- テストレコード挿入
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ0", "000-999-9999", "東京都新宿区0丁目", "http://www0.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ1", "111-999-9999", "東京都新宿区1丁目", "http://www1.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ2", "222-999-9999", "東京都新宿区2丁目", "http://www2.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ3", "333-999-9999", "東京都新宿区3丁目", "http://www3.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ4", "444-999-9999", "東京都新宿区4丁目", "http://www4.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ5", "555-999-9999", "東京都新宿区5丁目", "http://www5.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ6", "666-999-9999", "東京都新宿区6丁目", "http://www6.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ7", "777-999-9999", "東京都新宿区7丁目", "http://www7.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ8", "888-999-9999", "東京都新宿区8丁目", "http://www8.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ9", "999-999-9999", "東京都新宿区9丁目", "http://www9.shop.co.jp", now(), now());

INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ10", "000-999-9999", "東京都新宿区0丁目", "http://www0.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ11", "111-999-9999", "東京都新宿区1丁目", "http://www1.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ12", "222-999-9999", "東京都新宿区2丁目", "http://www2.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ13", "333-999-9999", "東京都新宿区3丁目", "http://www3.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ14", "444-999-9999", "東京都新宿区4丁目", "http://www4.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ15", "555-999-9999", "東京都新宿区5丁目", "http://www5.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ16", "666-999-9999", "東京都新宿区6丁目", "http://www6.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ17", "777-999-9999", "東京都新宿区7丁目", "http://www7.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ18", "888-999-9999", "東京都新宿区8丁目", "http://www8.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ19", "999-999-9999", "東京都新宿区9丁目", "http://www9.shop.co.jp", now(), now());

INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ20", "000-999-9999", "東京都新宿区0丁目", "http://www0.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ21", "111-999-9999", "東京都新宿区1丁目", "http://www1.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ22", "222-999-9999", "東京都新宿区2丁目", "http://www2.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ23", "333-999-9999", "東京都新宿区3丁目", "http://www3.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ24", "444-999-9999", "東京都新宿区4丁目", "http://www4.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ25", "555-999-9999", "東京都新宿区5丁目", "http://www5.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ26", "666-999-9999", "東京都新宿区6丁目", "http://www6.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ27", "777-999-9999", "東京都新宿区7丁目", "http://www7.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ28", "888-999-9999", "東京都新宿区8丁目", "http://www8.shop.co.jp", now(), now());
INSERT INTO `shops` (`name`, `tel`, `addr`, `url`, `created`, `updated`) VALUES ("ショップ29", "999-999-9999", "東京都新宿区9丁目", "http://www9.shop.co.jp", now(), now());s


