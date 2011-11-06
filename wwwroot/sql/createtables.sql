DROP TABLE IF EXISTS `app_users`;
CREATE TABLE `app_users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
);