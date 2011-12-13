DROP TABLE IF EXISTS `app_users`;
DROP TABLE IF EXISTS `app_priemones`;
DROP TABLE IF EXISTS `app_padaliniai`;
DROP TABLE IF EXISTS `app_is`;
DROP TABLE IF EXISTS `app_ispadaliniai`;
DROP TABLE IF EXISTS `app_priemonepadaliniai`;
DROP TABLE IF EXISTS `app_history`;

CREATE TABLE `app_users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `app_priemones` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kodas` varchar(10) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `app_padaliniai` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kodas` varchar(10) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `app_is` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kodas` varchar(10) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `app_ispadaliniai` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `iskodas` varchar(10) NOT NULL,
  `padaliniokodas` varchar(19) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `app_priemonepadaliniai` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `padaliniokodas` varchar(10) NOT NULL,
  `priemoneskodas` varchar(10) NOT NULL,
  `valandos` float NOT NULL DEFAULT 1
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `app_history` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `priemoneskodas` varchar(10) NOT NULL,
  `nuo` DATE NOT NULL,
  `iki` DATE NOT NULL,
  `kiekis` INT NOT NULL,
  `prognoze` BOOLEAN NOT NULL DEFAULT 0
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;