-- Baza danych: przewozy
CREATE DATABASE IF NOT EXISTS `przewozy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `przewozy`;


CREATE TABLE IF NOT EXISTS `osoby` (
`id_osoba` INT(11) NOT NULL AUTO_INCREMENT,
`imie` VARCHAR(100) NOT NULL,
`nazwisko` VARCHAR(100) NOT NULL,
`telefon` VARCHAR(20) DEFAULT NULL,
PRIMARY KEY (`id_osoba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `zadania` (
`id_zadania` INT(11) NOT NULL AUTO_INCREMENT,
`zadanie` TEXT NOT NULL,
`data` DATE DEFAULT NULL,
`osoba_id` INT(11) NOT NULL,
PRIMARY KEY (`id_zadania`),
KEY `osoba_id` (`osoba_id`),
CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`osoba_id`) REFERENCES `osoby` (`id_osoba`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Przykładowe dane
INSERT INTO `osoby` (`imie`, `nazwisko`, `telefon`) VALUES
('Jan', 'Kowalski', '600111222'),
('Anna', 'Nowak', '600333444');


INSERT INTO `zadania` (`zadanie`, `data`, `osoba_id`) VALUES
('Przewóz mebli z ul. Nowa 13 na ul. Długa 8', '2019-11-06', 1),
('Odbiór listów firmowych', '2019-11-18', 1),
('Przegląd samochodu dostawczego w serwisie', '2020-11-20', 1),
('Przewóz pudeł z osiedla Nowe Sady do firmy', '2020-11-22', 1);