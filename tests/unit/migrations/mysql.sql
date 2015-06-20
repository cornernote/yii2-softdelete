/**
 * MySQL
 */

DROP TABLE IF EXISTS `post_a`;

CREATE TABLE `post_a` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `deleted_at` INT(11)
);

DROP TABLE IF EXISTS `post_b`;

CREATE TABLE `post_b` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `deleted_at` DATETIME
);
