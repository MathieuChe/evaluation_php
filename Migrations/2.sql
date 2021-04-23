CREATE TABLE `product` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `price` VARCHAR(255) NOT NULL,
    `user_id` INT(11)UNSIGNED NOT NULL,
    UNIQUE `product_id_unique`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES user(`id`)
    ON DELETE CASCADE

) ENGINE = InnoDB;
