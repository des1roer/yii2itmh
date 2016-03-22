--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.3.358.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 21.03.2016 14:24:20
-- Версия сервера: 5.6.26
-- Версия клиента: 4.1
--


-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE itmh;

--
-- Описание для таблицы migration
--
DROP TABLE IF EXISTS migration;
CREATE TABLE migration (
  version VARCHAR(180) NOT NULL,
  apply_time INT(11) DEFAULT NULL,
  PRIMARY KEY (version)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 1170
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы postman_letter
--
DROP TABLE IF EXISTS postman_letter;
CREATE TABLE postman_letter (
  id INT(11) NOT NULL AUTO_INCREMENT,
  date_create DATETIME DEFAULT NULL,
  date_send DATETIME DEFAULT NULL,
  subject VARCHAR(255) DEFAULT NULL,
  body TEXT DEFAULT NULL,
  recipients TEXT DEFAULT NULL,
  attachments TEXT DEFAULT NULL,
  code VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы user
--
DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password_hash VARCHAR(60) NOT NULL,
  auth_key VARCHAR(32) NOT NULL,
  confirmed_at INT(11) DEFAULT NULL,
  unconfirmed_email VARCHAR(255) DEFAULT NULL,
  blocked_at INT(11) DEFAULT NULL,
  registration_ip VARCHAR(45) DEFAULT NULL,
  created_at INT(11) NOT NULL,
  updated_at INT(11) NOT NULL,
  flags INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE INDEX user_unique_email (email),
  UNIQUE INDEX user_unique_username (username)
)
ENGINE = INNODB
AUTO_INCREMENT = 9
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы profile
--
DROP TABLE IF EXISTS profile;
CREATE TABLE profile (
  user_id INT(11) NOT NULL,
  name VARCHAR(255) DEFAULT NULL,
  public_email VARCHAR(255) DEFAULT NULL,
  gravatar_email VARCHAR(255) DEFAULT NULL,
  gravatar_id VARCHAR(32) DEFAULT NULL,
  location VARCHAR(255) DEFAULT NULL,
  website VARCHAR(255) DEFAULT NULL,
  bio TEXT DEFAULT NULL,
  PRIMARY KEY (user_id),
  CONSTRAINT fk_user_profile FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы social_account
--
DROP TABLE IF EXISTS social_account;
CREATE TABLE social_account (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) DEFAULT NULL,
  provider VARCHAR(255) NOT NULL,
  client_id VARCHAR(255) NOT NULL,
  data TEXT DEFAULT NULL,
  code VARCHAR(32) DEFAULT NULL,
  created_at INT(11) DEFAULT NULL,
  email VARCHAR(255) DEFAULT NULL,
  username VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX account_unique (provider, client_id),
  UNIQUE INDEX account_unique_code (code),
  CONSTRAINT fk_user_account FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы token
--
DROP TABLE IF EXISTS token;
CREATE TABLE token (
  user_id INT(11) NOT NULL,
  code VARCHAR(32) NOT NULL,
  created_at INT(11) NOT NULL,
  type SMALLINT(6) NOT NULL,
  UNIQUE INDEX token_unique (user_id, code, type),
  CONSTRAINT fk_user_token FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

-- 
-- Вывод данных для таблицы migration
--
INSERT INTO migration VALUES
('', NULL),
('m000000_000000_base', 1458289550),
('m140209_132017_init', 1458289554),
('m140403_174025_create_account_table', 1458289555),
('m140504_113157_update_tables', 1458289558),
('m140504_130429_create_token_table', 1458289563),
('m140830_171933_fix_ip_field', 1458289563),
('m140830_172703_change_account_table_name', 1458289564),
('m141125_084520_postman_init', 1458294092),
('m141222_110026_update_ip_field', 1458289564),
('m141222_135246_alter_username_length', 1458289564),
('m150513_152730_postman_update', 1458294092),
('m150614_103145_update_social_account_table', 1458289566),
('m150623_212711_fix_username_notnull', 1458289567);

-- 
-- Вывод данных для таблицы postman_letter
--

-- Таблица itmh.postman_letter не содержит данных

-- 
-- Вывод данных для таблицы user
--
INSERT INTO user VALUES
(2, 'des1roer', 'des@mail.ru', '$2y$10$cviBT2NeHaX5v2KpXrxyM.i8GwL1NO9a51082v4PYCNty9fEcU68q', '9MCGi-D-lChCJEXPiGiw2ZyH9IOyLw7p', 1458291361, NULL, NULL, '127.0.0.1', 1458290288, 1458290288, 0),
(5, 'admin', 'des2@mail.ru', '$2y$10$EtRcc0t8iG02pU3t3ckGQe52WKjlTPfcf1Gdmhyntyqu61IbRU.52', 'AC6o0DeI1rESApIgL6aLspD8Apyb2oj-', NULL, NULL, NULL, '127.0.0.1', 1458535992, 1458535992, 0),
(6, 'qwerty', 'des1roer@gmail.com', '$2y$10$V6BDrjguJooemBm1f6tJ9utA2Xz6l3ncieYLEaCtiTTMropUzse/G', 'GBH1BoSTa3Ftqfdw8IgqxSsy5-TpUugN', NULL, NULL, NULL, '127.0.0.1', 1458540185, 1458540185, 0),
(7, '123456', 'des1roer@gail.com', '$2y$10$Ex/PxxfUH.diwd3zUUgy9u3CtFOGGshtxV7sqPLmYe2DS9queNCYm', 'dbhaWxWDbFFJ9XegHOXFasPibpZ8quOz', NULL, NULL, NULL, '127.0.0.1', 1458545657, 1458545657, 0),
(8, '6543', 'des1sdf@mail.ru', '$2y$10$MFgEZCWosr4L.IJ/1T1VFOI6cqA3gzX0d5RQCLHSVwtCwk2wgS9eO', 'I3hkZhawkkRtDkwoOP2DApuJ4YqxYPm2', NULL, NULL, NULL, '127.0.0.1', 1458546641, 1458546641, 0);

-- 
-- Вывод данных для таблицы profile
--
INSERT INTO profile VALUES
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- 
-- Вывод данных для таблицы social_account
--

-- Таблица itmh.social_account не содержит данных

-- 
-- Вывод данных для таблицы token
--
INSERT INTO token VALUES
(2, 'ZOWAa8JNJik3wdCFEDXA8O0r9nbQwEHJ', 1458290288, 0),
(5, '9mcjk-FcUgq8M87uR4iCxOH4oup2TM_t', 1458535992, 0),
(6, 'KVaQT23pm2OJWBqrTiWsEgEaH-HXGd7j', 1458540185, 0),
(7, '4pnofle5eW8U9Jrh4LPDYx0_2bkfmoOW', 1458545657, 0),
(8, 'sBv3VK1okBTw5GdJOtp47Gbs9XDb_08L', 1458546641, 0);

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;