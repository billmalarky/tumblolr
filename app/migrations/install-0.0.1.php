<?php
/**
 * This is a simple PHP script that runs the database schema installation.
 */

$db = new PDO('mysql:host=127.0.0.1;dbname=tumblrtest', 'root', 'root');

$result = $db->query("CREATE TABLE IF NOT EXISTS `tumblrtest`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(255) NOT NULL,
  `post_data` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `TAG` (`tag`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;");

