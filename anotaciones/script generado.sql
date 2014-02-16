SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `blog` ;
CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET latin1 ;
USE `blog` ;

-- -----------------------------------------------------
-- Table `groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groups` ;

CREATE  TABLE IF NOT EXISTS `groups` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(20) NOT NULL ,
  `description` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `login_attempts` ;

CREATE  TABLE IF NOT EXISTS `login_attempts` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `ip_address` VARBINARY(16) NOT NULL ,
  `login` VARCHAR(100) NOT NULL ,
  `time` INT(11) UNSIGNED NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `ip_address` VARBINARY(16) NOT NULL ,
  `username` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(80) NOT NULL ,
  `salt` VARCHAR(40) NULL DEFAULT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `activation_code` VARCHAR(40) NULL DEFAULT NULL ,
  `forgotten_password_code` VARCHAR(40) NULL DEFAULT NULL ,
  `forgotten_password_time` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `remember_code` VARCHAR(40) NULL DEFAULT NULL ,
  `created_on` INT(11) UNSIGNED NOT NULL ,
  `last_login` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `active` TINYINT(1) UNSIGNED NULL DEFAULT NULL ,
  `first_name` VARCHAR(50) NULL DEFAULT NULL ,
  `last_name` VARCHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `users_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_groups` ;

CREATE  TABLE IF NOT EXISTS `users_groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) UNSIGNED NOT NULL ,
  `group_id` MEDIUMINT(8) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `uc_users_groups` (`user_id` ASC, `group_id` ASC) ,
  INDEX `fk_users_groups_users1_idx` (`user_id` ASC) ,
  INDEX `fk_users_groups_groups1_idx` (`group_id` ASC) ,
  CONSTRAINT `fk_users_groups_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `groups` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `post` ;

CREATE  TABLE IF NOT EXISTS `post` (
  `idPost` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idUsuario` INT(11) UNSIGNED NOT NULL ,
  `titulo` VARCHAR(250) NOT NULL ,
  `contenido` TEXT NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `activo` ENUM('Si','No') NOT NULL ,
  PRIMARY KEY (`idPost`) ,
  INDEX `fk_post_users1_idx` (`idUsuario` ASC) ,
  CONSTRAINT `fk_post_users1`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comentario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comentario` ;

CREATE  TABLE IF NOT EXISTS `comentario` (
  `idComentario` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idPost` INT UNSIGNED NOT NULL ,
  `idUsuario` INT(11) UNSIGNED NOT NULL ,
  `contenido` VARCHAR(200) NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  PRIMARY KEY (`idComentario`, `idPost`) ,
  INDEX `fk_comentario_post1_idx` (`idPost` ASC) ,
  INDEX `fk_comentario_users1_idx` (`idUsuario` ASC) ,
  CONSTRAINT `fk_comentario_post1`
    FOREIGN KEY (`idPost` )
    REFERENCES `post` (`idPost` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_users1`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `captcha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `captcha` ;

CREATE  TABLE IF NOT EXISTS `captcha` (
  `captcha_id` BIGINT(13) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `captcha_time` INT(10) UNSIGNED NOT NULL ,
  `ip_address` VARCHAR(16) NOT NULL ,
  `word` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`captcha_id`) ,
  INDEX `word` (`word` ASC) )
ENGINE = InnoDB;

USE `blog` ;

-- -----------------------------------------------------
-- procedure inicializarDB
-- -----------------------------------------------------

USE `blog`;
DROP procedure IF EXISTS `inicializarDB`;

DELIMITER $$
USE `blog`$$
CREATE PROCEDURE `inicializarDB` ()
BEGIN
	INSERT INTO `groups` (`id`, `name`, `description`) VALUES
     (1,'admin','Administrator'),
     (2,'members','General User');
	INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
     ('1',0x7f000001,'administrator','59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4','9462e8eee0','admin@admin.com','',NULL,'1268889823','1268889823','1', 'Admin','istrator');
	INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
     (1,1,1),
     (2,1,2);
END$$


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
