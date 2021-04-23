CREATE TABLE `user` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `encryptedPassword` VARCHAR(255) NOT NULL,
    UNIQUE `user_id_unique` (`id`)
) ENGINE = InnoDB;