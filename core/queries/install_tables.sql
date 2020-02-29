SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- База данных: `wchat`
--

CREATE DATABASE IF NOT EXISTS `wchat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wchat`;

-- --------------------------------------------------------

--
-- Пользователь БД.
--

CREATE USER IF NOT EXISTS 'wchat_user'@'%' IDENTIFIED BY 'password';
GRANT USAGE ON *.* TO 'wchat_user'@'%' IDENTIFIED BY 'password'
    REQUIRE NONE WITH
        MAX_QUERIES_PER_HOUR 0
        MAX_CONNECTIONS_PER_HOUR 0
        MAX_UPDATES_PER_HOUR 0
        MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `wchat`.* TO 'wchat_user'@'%';

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс пользователя',
    `username` varchar(64) NOT NULL DEFAULT '' COMMENT 'Логин пользователя',
    `email` varchar(64) NOT NULL DEFAULT '' COMMENT 'Почта пользователя',
    `password` varchar(256) NOT NULL DEFAULT '' COMMENT 'Пароль пользователя',
    `phone` varchar(64) NOT NULL DEFAULT '' COMMENT 'Телефон пользователя',
    `icon` varchar(64) NOT NULL DEFAULT '' COMMENT 'Иконка пользователя',
    `created` int unsigned  NOT NULL DEFAULT 0 COMMENT 'Дата создания пользователя',
    `last_activity` int unsigned  NOT NULL DEFAULT 0 COMMENT 'Дата последней активности',
    `updated` int unsigned  NOT NULL DEFAULT 0 COMMENT 'Дата обновления пользователя',
    `cid` varchar(37) NOT NULL DEFAULT '' COMMENT 'GUID клиента пользователя',
    `sid` varchar(37) NOT NULL DEFAULT '' COMMENT 'GUID сессии пользователя',

    PRIMARY KEY (`id`),
    UNIQUE KEY (`email`),
    KEY (`username`),
    KEY (`cid`),
    KEY (`sid`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8
COMMENT = 'Первичная информация о пользователе'
AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages`
(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс пользователя',
    `from_id` bigint(20) unsigned NOT NULL COMMENT 'Индекс пользователя отправителя',
    `to_id` bigint(20) unsigned NOT NULL COMMENT 'Индекс пользователя получателя',
    `message` text NOT NULL COMMENT 'Сообщение пользователя',
    `created` int unsigned  NOT NULL DEFAULT 0 COMMENT 'Дата создания сообщения',

    PRIMARY KEY (`id`),
    KEY (`from_id`),
    KEY (`to_id`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8
COMMENT = 'Сообщения пользователей.'
AUTO_INCREMENT = 1;

-- --------------------------------------------------------
