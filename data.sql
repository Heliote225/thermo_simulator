DROP USER 'root'@'localhost';

CREATE USER 'root'@'localhost' IDENTIFIED BY '';

GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;

CREATE DATABASE measure_db;

USE measure_db;

CREATE TABLE measures (
        id_measure INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        val_measure DECIMAL(4,2) UNSIGNED NOT NULL,
	alt_val_measure INT(2) UNSIGNED, 
        type_measure VARCHAR(2) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );

CREATE TABLE utilisateurs (
        id_user INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom_utilisateur VARCHAR(20) NOT NULL,
	mot_de_passe VARCHAR(20) NOT NULL, 
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );
