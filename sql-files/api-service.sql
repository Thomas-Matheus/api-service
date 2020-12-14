-- MySQL Workbench Synchronization
-- Generated: 2020-12-13 14:58
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Vinicius

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER SCHEMA `api`  DEFAULT COLLATE utf8mb4_unicode_ci ;

CREATE TABLE IF NOT EXISTS `api`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `active` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `api`.`person` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `api`.`phone` (
  `idphone` INT(11) NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(100) NOT NULL,
  `person_id` INT(11) NOT NULL,
  PRIMARY KEY (`idphone`, `person_id`),
  INDEX `fk_phone_person_idx` (`person_id` ASC) VISIBLE,
  CONSTRAINT `fk_phone_person`
    FOREIGN KEY (`person_id`)
    REFERENCES `api`.`person` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `api`.`ship_destination` (
  `idship_destination` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idship_destination`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `api`.`item` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `note` VARCHAR(45) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `price` FLOAT(11) NOT NULL,
  `ship_order_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `ship_order_id`),
  INDEX `fk_item_ship_order1_idx` (`ship_order_id` ASC) VISIBLE,
  CONSTRAINT `fk_item_ship_order1`
    FOREIGN KEY (`ship_order_id`)
    REFERENCES `api`.`ship_order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `api`.`ship_order` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `person_id` INT(11) NOT NULL,
  `ship_destination_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ship_order_person1_idx` (`person_id` ASC) VISIBLE,
  INDEX `fk_ship_order_ship_destination1_idx` (`ship_destination_id` ASC) VISIBLE,
  CONSTRAINT `fk_ship_order_person1`
    FOREIGN KEY (`person_id`)
    REFERENCES `api`.`person` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ship_order_ship_destination1`
    FOREIGN KEY (`ship_destination_id`)
    REFERENCES `api`.`ship_destination` (`idship_destination`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
