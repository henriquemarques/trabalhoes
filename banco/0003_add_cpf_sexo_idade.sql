ALTER TABLE `users`  ADD `sexo` CHAR(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,  ADD `idade` INT(2) NOT NULL,  ADD `cpf` VARCHAR(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_new_table_1_idx` (`order_id`),
  CONSTRAINT `fk_new_table_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

