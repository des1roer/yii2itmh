--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.3.358.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 25.03.2016 15:29:06
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
-- Описание для таблицы actor
--
DROP TABLE IF EXISTS actor;
CREATE TABLE actor (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы country
--
DROP TABLE IF EXISTS country;
CREATE TABLE country (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы director
--
DROP TABLE IF EXISTS director;
CREATE TABLE director (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы genre
--
DROP TABLE IF EXISTS genre;
CREATE TABLE genre (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы role
--
DROP TABLE IF EXISTS role;
CREATE TABLE role (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  can_admin SMALLINT(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы user
--
DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  role_id INT(11) NOT NULL,
  status SMALLINT(6) NOT NULL,
  email VARCHAR(255) DEFAULT NULL,
  username VARCHAR(255) DEFAULT NULL,
  password VARCHAR(255) DEFAULT NULL,
  auth_key VARCHAR(255) DEFAULT NULL,
  access_token VARCHAR(255) DEFAULT NULL,
  logged_in_ip VARCHAR(255) DEFAULT NULL,
  logged_in_at TIMESTAMP NULL DEFAULT NULL,
  created_ip VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  banned_at TIMESTAMP NULL DEFAULT NULL,
  banned_reason VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX user_email (email),
  UNIQUE INDEX user_username (username),
  CONSTRAINT user_role_id FOREIGN KEY (role_id)
    REFERENCES role(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы video
--
DROP TABLE IF EXISTS video;
CREATE TABLE video (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  origin_name VARCHAR(255) NOT NULL,
  country_id INT(11) DEFAULT NULL,
  year_start INT(11) DEFAULT NULL,
  year_end INT(11) DEFAULT NULL,
  duration INT(11) DEFAULT NULL,
  premiere DATETIME DEFAULT NULL,
  preview VARCHAR(255) DEFAULT NULL,
  description VARCHAR(255) DEFAULT NULL,
  origin_img VARCHAR(255) DEFAULT NULL,
  small_img VARCHAR(255) DEFAULT NULL,
  big_img VARCHAR(255) DEFAULT NULL,
  uploader INT(11) DEFAULT NULL,
  trailer VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX `idx-country_id` (country_id),
  UNIQUE INDEX name (name),
  UNIQUE INDEX origin_name (origin_name),
  CONSTRAINT `fk-country_id` FOREIGN KEY (country_id)
    REFERENCES country(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы actor_has_video
--
DROP TABLE IF EXISTS actor_has_video;
CREATE TABLE actor_has_video (
  actor_id INT(11) NOT NULL DEFAULT 0,
  video_id INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (video_id, actor_id),
  INDEX `idx-actor_has_video` (video_id),
  INDEX `idx-actor_id` (actor_id),
  UNIQUE INDEX uniq_actor_has_video (actor_id, video_id),
  CONSTRAINT `fk-actor_has_video` FOREIGN KEY (video_id)
    REFERENCES video(id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-actor_id` FOREIGN KEY (actor_id)
    REFERENCES actor(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы director_has_video
--
DROP TABLE IF EXISTS director_has_video;
CREATE TABLE director_has_video (
  director_id INT(11) NOT NULL DEFAULT 0,
  video_id INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (video_id, director_id),
  INDEX `idx-director_has_video` (video_id),
  INDEX `idx-director_id` (director_id),
  UNIQUE INDEX uniq_director_has_video (director_id, video_id),
  CONSTRAINT `fk-director_has_video` FOREIGN KEY (video_id)
    REFERENCES video(id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-director_id` FOREIGN KEY (director_id)
    REFERENCES director(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы profile
--
DROP TABLE IF EXISTS profile;
CREATE TABLE profile (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  full_name VARCHAR(255) DEFAULT NULL,
  timezone VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT profile_user_id FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы user_auth
--
DROP TABLE IF EXISTS user_auth;
CREATE TABLE user_auth (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  provider VARCHAR(255) NOT NULL,
  provider_id VARCHAR(255) NOT NULL,
  provider_attributes TEXT NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX user_auth_provider_id (provider_id),
  CONSTRAINT user_auth_user_id FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы user_token
--
DROP TABLE IF EXISTS user_token;
CREATE TABLE user_token (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) DEFAULT NULL,
  type SMALLINT(6) NOT NULL,
  token VARCHAR(255) NOT NULL,
  data VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  expired_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX user_token_token (token),
  CONSTRAINT user_token_user_id FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы video_has_genre
--
DROP TABLE IF EXISTS video_has_genre;
CREATE TABLE video_has_genre (
  video_id INT(11) NOT NULL DEFAULT 0,
  genre_id INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (video_id, genre_id),
  INDEX `idx-genre_id` (genre_id),
  INDEX `idx-video_id` (video_id),
  UNIQUE INDEX uniq_video_has_genre (genre_id, video_id),
  CONSTRAINT `fk-genre_id` FOREIGN KEY (genre_id)
    REFERENCES genre(id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-video_id` FOREIGN KEY (video_id)
    REFERENCES video(id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Вывод данных для таблицы actor
--
INSERT INTO actor VALUES
(4, 'Анна Мэй Вонг'),
(3, 'Дэрил Ханна'),
(2, 'Лариса Ерёмина'),
(1, 'Эмили де Рэйвин');

-- 
-- Вывод данных для таблицы country
--
INSERT INTO country VALUES
(1, 'Австралия'),
(2, 'Австрия'),
(3, 'Азербайджан'),
(4, 'Албания');

-- 
-- Вывод данных для таблицы director
--
INSERT INTO director VALUES
(1, 'Вуди Аллен'),
(3, 'Джун-хо Бон'),
(2, 'Ричард Айоаде'),
(4, 'Френсис Форд Коппола');

-- 
-- Вывод данных для таблицы genre
--
INSERT INTO genre VALUES
(1, 'аниме'),
(2, 'биографический'),
(3, 'боевик'),
(4, 'вестерн');

-- 
-- Вывод данных для таблицы migration
--
INSERT INTO migration VALUES
('m000000_000000_base', 1458901675),
('m150214_044831_init_user', 1458901684),
('m160321_081027_create_video', 1458901694),
('m160322_045630_add_catalog_data', 1458901694),
('m160322_093527_unique_idx', 1458901694),
('m160325_082632_add_trailer_to_video', 1458901695);

-- 
-- Вывод данных для таблицы role
--
INSERT INTO role VALUES
(1, 'Admin', '2016-03-25 10:28:04', NULL, 1),
(2, 'User', '2016-03-25 10:28:04', NULL, 0);

-- 
-- Вывод данных для таблицы user
--
INSERT INTO user VALUES
(1, 1, 1, 'no@mail.ru', 'admin', '$2y$13$d1jP7AvGG9TtdSEsS3NpJO4ccn99d/6ItIiAcUbfRA5OMAszdY3A.', 'S1ZKEG_zJAEfr54-Opv7cqKwlhkO6PGH', '_xhDKQschNpV7ygE8UazpTu0etMpogn1', NULL, NULL, NULL, '2016-03-25 10:28:04', NULL, NULL, NULL),
(2, 2, 1, 'user@mail.ru', 'user', '$2y$13$dyVw4WkZGkABf2UrGWrhHO4ZmVBv.K4puhOL59Y9jQhIdj63TlV.O', 'JlD8Fr1wXWRFyPlRSUjKzoX8SZGFi-0A', 'HnY6aAWJXEWx7jTBnb0MUm6Fp7ZcKskj', NULL, NULL, NULL, '2016-03-25 10:28:04', NULL, NULL, NULL);

-- 
-- Вывод данных для таблицы video
--

-- Таблица itmh.video не содержит данных

-- 
-- Вывод данных для таблицы actor_has_video
--

-- Таблица itmh.actor_has_video не содержит данных

-- 
-- Вывод данных для таблицы director_has_video
--

-- Таблица itmh.director_has_video не содержит данных

-- 
-- Вывод данных для таблицы profile
--
INSERT INTO profile VALUES
(1, 1, '2016-03-25 10:28:04', NULL, 'the one', NULL);

-- 
-- Вывод данных для таблицы user_auth
--

-- Таблица itmh.user_auth не содержит данных

-- 
-- Вывод данных для таблицы user_token
--

-- Таблица itmh.user_token не содержит данных

-- 
-- Вывод данных для таблицы video_has_genre
--

-- Таблица itmh.video_has_genre не содержит данных

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;