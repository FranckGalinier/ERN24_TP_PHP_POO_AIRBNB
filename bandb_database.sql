

CREATE TABLE IF NOT EXISTS `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
  );
-- table user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(255),
  `firstname` varchar(255),
  `is_active` BOOLEAN NOT NULL DEFAULT 1,
  `is_verified` BOOLEAN NOT NULL DEFAULT 0,
  `information_id` int(11) NOT NULL,
   
  FOREIGN KEY (`information_id`) REFERENCES `information`(`id`)
);

-- table typeLogement
CREATE TABLE IF NOT EXISTS `typeLogement`(
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `label` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_active` BOOLEAN NOT NULL DEFAULT 1
);

  -- table logement
CREATE TABLE IF NOT EXISTS `logement` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float(11) NOT NULL,
  `nb_rooms`int(11) NOT NULL,
  `nb_traveler`int(11) NOT NULL,
  `size`int(11) NOT NULL,
  `information_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_logement_id` int(11) NOT NULL,
  FOREIGN KEY (`information_id`) REFERENCES `information`(`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
  FOREIGN KEY (`type_logement_id`) REFERENCES `typeLogement`(`id`)
);




-- table equipement
CREATE TABLE IF NOT EXISTS `equipement` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `label` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_active` BOOLEAN NOT NULL DEFAULT 1
);

-- table logement_equipement
CREATE TABLE IF NOT EXISTS `logement_equipement` (
  `logement_id` int(11) NOT NULL,
  `equipement_id` int(11) NOT NULL,
  FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`),
  FOREIGN KEY (`equipement_id`) REFERENCES `equipement`(`id`)
  );


-- table reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order_number` varchar(255) NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(255) NOT NULL,
  `nb_adults` int(11) NOT NULL,
  `nb_child` int(11) NOT NULL,
  `price_total` float NOT NULL,
  `logement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
  );


CREATE TABLE IF NOT EXISTS `media` (
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `label` VARCHAR(255),
    `image_path` VARCHAR(255),
    `is_active` BOOLEAN,
    `logement_id` INT,
    FOREIGN KEY (`logement_id`) REFERENCES `logement`(`id`)
    );