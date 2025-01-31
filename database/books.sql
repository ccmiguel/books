-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 03-07-2024 a las 15:43:03
-- Versión del servidor: 11.5.0-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `books`
--

-- --------------------------------------------------------
-- Creación de la tabla books
CREATE TABLE books (
  book_id INT(11) NOT NULL,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  genre VARCHAR(100) NOT NULL,
  publication_date DATE NOT NULL,
  page_count INT NOT NULL,
  publisher VARCHAR(255)  NOT NULL,
  isbn VARCHAR(20)  NOT NULL,
  original_language_book VARCHAR(50)  NOT NULL,
  bestseller ENUM('true', 'false')  DEFAULT 'false',
  book_edition VARCHAR(20)  NOT NULL,
  translated_book_language VARCHAR(50)  NOT NULL,
  legal_deposit_number VARCHAR(20)  NOT NULL
);

-- Inserción de datos en la tabla books (Sus datos existentes)
-- Inserción de datos en la tabla books
INSERT INTO books (book_id, title, author, genre, publication_date, page_count, publisher, isbn, original_language_book, bestseller, book_edition, translated_book_language, legal_deposit_number) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 'fiction', '1960-07-11', 281, 'J.B. Lippincott & Co.', '9780060935467', 'English', 'true', '1st', 'Spanish', 'BN1234567'),
(2, '1984', 'George Orwell', 'dystopian', '1949-06-08', 328, 'Secker & Warburg', '9780451524935', 'English', 'true', '2nd', 'Spanish', 'BN2345678'),
(3, 'Pride and Prejudice', 'Jane Austen', 'romance', '1813-01-28', 279, 'T. Egerton', '9781503290563', 'English', 'true', '3rd', 'French', 'BN3456789'),
(4, 'The Great Gatsby', 'F. Scott Fitzgerald', 'fiction', '1925-04-10', 180, 'Charles Scribners Sons', '9780743273565', 'English', 'false', '1st', 'Spanish', 'BN4567890'),
(5, 'One Hundred Years of Solitude', 'Gabriel Garcia Marquez', 'magical realism', '1967-05-30', 417, 'Harper & Row', '9780060883287', 'Spanish', 'true', '2nd', 'English', 'BN5678901'),
(6, 'The Lord of the Rings', 'J.R.R. Tolkien', 'fantasy', '1954-07-29', 1216, 'George Allen & Unwin', '9780544003415', 'English', 'true', '3rd', 'Spanish', 'BN6789012'),
(7, 'The Catcher in the Rye', 'J.D. Salinger', 'fiction', '1951-07-16', 234, 'Little, Brown and Company', '9780316769488', 'English', 'true', '1st', 'Spanish', 'BN7890123'),
(8, 'The Hobbit', 'J.R.R. Tolkien', 'fantasy', '1937-09-21', 310, 'George Allen & Unwin', '9780547928227', 'English', 'true', '2nd', 'Spanish', 'BN8901234'),
(9, 'Fahrenheit 451', 'Ray Bradbury', 'dystopian', '1953-10-19', 158, 'Ballantine Books', '9781451673319', 'English', 'true', '3rd', 'Spanish', 'BN9012345'),
(10, 'Moby-Dick', 'Herman Melville', 'adventure', '1851-10-18', 635, 'Harper & Brothers', '9781503280786', 'English', 'true', '1st', 'Spanish', 'BN0123456'),
(11, 'Madame Bovary', 'Gustave Flaubert', 'fiction', '1856-12-01', 328, 'Revue de Paris', '9780140449129', 'French', 'true', '2nd', 'English', 'BN1234567'),
(12, 'War and Peace', 'Leo Tolstoy', 'historical', '1869-01-01', 1225, 'The Russian Messenger', '9780199232765', 'Russian', 'true', '3rd', 'English', 'BN2345678'),
(13, 'Don Quixote', 'Miguel de Cervantes', 'adventure', '1605-01-16', 1072, 'Francisco de Robles', '9780060934347', 'Spanish', 'true', '1st', 'English', 'BN3456789'),
(14, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'philosophical', '1880-01-01', 824, 'The Russian Messenger', '9780374528379', 'Russian', 'true', '2nd', 'English', 'BN4567890'),
(15, 'The Metamorphosis', 'Franz Kafka', 'fiction', '1915-01-01', 201, 'Kurt Wolff Verlag', '9780486290300', 'German', 'false', '3rd', 'English', 'BN5678901'),
(16, 'The Picture of Dorian Gray', 'Oscar Wilde', 'philosophical', '1890-06-20', 254, 'Ward, Lock & Co.', '9780141439570', 'English', 'true', '1st', 'Spanish', 'BN6789012'),
(17, 'Lord of the Flies', 'William Golding', 'fiction', '1954-09-17', 224, 'Faber and Faber', '9780399501487', 'English', 'false', '2nd', 'Spanish', 'BN7890123'),
(18, 'Lolita', 'Vladimir Nabokov', 'fiction', '1955-09-01', 336, 'Olympia Press', '9780679723165', 'English', 'true', '3rd', 'Spanish', 'BN8901234'),
(19, 'Heart of Darkness', 'Joseph Conrad', 'novella', '1899-01-01', 96, 'Blackwoods Magazine', '9780140186528', 'English', 'true', '1st', 'Spanish', 'BN9012345'),
(20, 'Frankenstein', 'Mary Shelley', 'horror', '1818-01-01', 280, 'Lackington, Hughes, Harding, Mavor & Jones', '9780141439471', 'English', 'true', '2nd', 'Spanish', 'BN0123456'),
(21, 'The Shining', 'Stephen King', 'horror', '1977-01-28', 447, 'Doubleday', '9780307743657', 'English', 'true', '3rd', 'Spanish', 'BN1234567'),
(22, 'The Road', 'Cormac McCarthy', 'post-apocalyptic', '2006-09-26', 287, 'Alfred A. Knopf', '9780307387899', 'English', 'true', '1st', 'Spanish', 'BN2345678'),
(23, 'Harry Potter and the Philosophers Stone', 'J.K. Rowling', 'fantasy', '1997-06-26', 223, 'Bloomsbury', '9780747532699', 'English', 'true', '2nd', 'Spanish', 'BN3456789'),
(24, 'The Kite Runner', 'Khaled Hosseini', 'fiction', '2003-05-29', 371, 'Riverhead Books', '9781594631931', 'English', 'false', '3rd', 'Spanish', 'BN4567890'),
(25, 'Life of Pi', 'Yann Martel', 'adventure', '2001-09-11', 319, 'Knopf Canada', '9780156027328', 'English', 'true', '1st', 'Spanish', 'BN5678901'),
(26, 'The Book Thief', 'Markus Zusak', 'historical', '2005-09-01', 552, 'Picador', '9780375842207', 'English', 'true', '2nd', 'Spanish', 'BN6789012'),
(27, 'The Giver', 'Lois Lowry', 'dystopian', '1993-04-26', 240, 'Houghton Mifflin', '9780544336261', 'English', 'true', '3rd', 'Spanish', 'BN7890123'),
(28, 'The Handmaids Tale', 'Margaret Atwood', 'dystopian', '1985-09-01', 311, 'McClelland and Stewart', '9780385490818', 'English', 'true', '1st', 'Spanish', 'BN8901234'),
(29, 'Twilight', 'Stephenie Meyer', 'fantasy', '2005-10-05', 498, 'Little, Brown and Company', '9780316015844', 'English', 'true', '2nd', 'Spanish', 'BN9012345'),
(30, 'The Hunger Games', 'Suzanne Collins', 'dystopian', '2008-09-14', 374, 'Scholastic Press', '9780439023481', 'English', 'true', '3rd', 'Spanish', 'BN0123456');

-- Creación de la tabla reservations
CREATE TABLE reservations (
  reservation_id INT(11) NOT NULL,
  reservation_date DATE NOT NULL,
  pickup_date DATE NOT NULL,
  return_date DATE NOT NULL,
  reservation_status VARCHAR(50) NOT NULL,
  customer_name VARCHAR(50) NOT NULL,
  customer_email VARCHAR(50) NOT NULL,
  library_branch VARCHAR(50) NOT NULL
);

-- Inserción de datos en la tabla reservations (Sus datos existentes)
-- Inserción de datos en la tabla reservations
INSERT INTO reservations (reservation_id, reservation_date, pickup_date, return_date, reservation_status, customer_name, customer_email, library_branch)
VALUES
(1, '2022-03-05', '2022-10-11', '2022-09-27', 'pending', 'Danya MacCleod', 'dmaccleod0@unc.edu', 'Mycat'),
(2, '2022-06-04', '2022-11-30', '2022-01-19', 'cancelled', 'Daniele Lambole', 'dlambole1@reddit.com', 'Realmix'),
(3, '2022-12-18', '2022-04-28', '2022-12-28', 'pending', 'Candy Larvent', 'clarvent2@reddit.com', 'Dynabox'),
(4, '2022-01-09', '2022-09-22', '2022-12-23', 'confirmed', 'Dana Nilges', 'dnilges3@weather.com', 'Skinder'),
(5, '2022-01-09', '2022-07-01', '2022-01-12', 'cancelled', 'Johan Lascell', 'jlascell4@sbwire.com', 'Rhycero'),
(6, '2022-10-19', '2022-09-13', '2022-07-28', 'pending', 'Ebba Madgett', 'emadgett5@4shared.com', 'Centidel'),
(7, '2022-01-05', '2022-09-17', '2022-03-26', 'confirmed', 'Sofia Matevushev', 'smatevushev6@example.com', 'Yambee'),
(8, '2022-04-15', '2022-12-29', '2022-08-10', 'pending', 'Pavlov Bernaciak', 'pbernaciak7@eepurl.com', 'Jaxbean'),
(9, '2022-12-27', '2022-07-16', '2022-04-08', 'cancelled', 'Becca Joney', 'bjoney8@twitpic.com', 'Oyoyo'),
(10, '2022-10-15', '2022-01-07', '2022-03-07', 'cancelled', 'Chandler Collcott', 'ccollcott9@devhub.com', 'LiveZ'),
(11, '2022-12-08', '2022-07-23', '2022-03-04', 'confirmed', 'D''arcy Rizzardi', 'drizzardia@buzzfeed.com', 'Podcat'),
(12, '2022-01-13', '2022-07-09', '2022-11-27', 'cancelled', 'Sherie Hamnet', 'shamnetb@ted.com', 'Eimbee'),
(13, '2022-07-29', '2022-12-02', '2022-09-13', 'cancelled', 'Creight Dorant', 'cdorantc@miibeian.gov.cn', 'Fivechat'),
(14, '2022-04-13', '2022-10-26', '2022-10-24', 'cancelled', 'Giffer De Simoni', 'gded@webnode.com', 'Topiczoom'),
(15, '2022-06-15', '2022-07-26', '2022-11-11', 'cancelled', 'Tony Tschirschky', 'ttschirschkye@epa.gov', 'Oyoyo'),
(16, '2022-04-05', '2022-04-02', '2022-04-24', 'confirmed', 'Bev Ogilby', 'bogilbyf@mail.ru', 'Eire'),
(17, '2022-01-27', '2022-05-02', '2022-09-17', 'cancelled', 'Rodolphe Gould', 'rgouldg@wired.com', 'Voonix'),
(18, '2022-03-08', '2022-06-19', '2022-11-05', 'pending', 'Rina Fantini', 'rfantinih@clickbank.net', 'DabZ'),
(19, '2022-12-18', '2022-10-09', '2022-02-15', 'pending', 'Beatrice Doll', 'bdolli@ustream.tv', 'Jabbersphere'),
(20, '2022-08-15', '2022-12-18', '2022-08-02', 'confirmed', 'Carmelle Gerrit', 'cgerritj@omniture.com', 'Voonix'),
(21, '2022-03-14', '2022-06-22', '2022-11-26', 'pending', 'Murdock De Giovanni', 'mdek@aboutads.info', 'Skinix'),
(22, '2022-10-12', '2022-02-24', '2022-09-05', 'pending', 'Ellette Dubbin', 'edubbinl@timesonline.co.uk', 'Agimba'),
(23, '2022-09-17', '2022-11-11', '2022-10-11', 'confirmed', 'Corabel Sivior', 'csiviorm@merriam-webster.com', 'Blogspan'),
(24, '2022-01-19', '2022-09-20', '2022-07-02', 'cancelled', 'Tybie Cornelisse', 'tcornelissen@rambler.ru', 'Brainsphere'),
(25, '2022-11-20', '2022-06-28', '2022-01-27', 'pending', 'Mort Bosenworth', 'mbosenwortho@tripod.com', 'Yamia'),
(26, '2022-05-22', '2022-11-14', '2022-11-20', 'cancelled', 'Grover Hintze', 'ghintzep@google.fr', 'Flipopia'),
(27, '2022-03-12', '2022-09-08', '2022-06-24', 'cancelled', 'Feliza Dealtry', 'fdealtryq@about.me', 'Realcube'),
(28, '2022-10-09', '2022-03-16', '2022-03-13', 'pending', 'Finley Martinets', 'fmartinetsr@exblog.jp', 'Zoozzy'),
(29, '2022-03-26', '2022-01-24', '2022-01-10', 'pending', 'Leeland Lemme', 'llemmes@google.pl', 'Skyba'),
(30, '2022-03-10', '2022-12-15', '2022-05-16', 'cancelled', 'Jaymie Woosnam', 'jwoosnamt@time.com', 'Skalith');

-- Creación de la tabla reservation_books
CREATE TABLE reservation_books (
  reservation_id INT(11) NOT NULL,
  book_id INT(11) NOT NULL
);


-- Inserción de datos en la tabla reservation_books
INSERT INTO reservation_books (reservation_id, book_id)
VALUES
(1, 1),
(1, 2), -- Ejemplo de reservación con más de un libro
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(1, 3),  -- Otro ejemplo de reservación con más de un libro
(2, 4),
(3, 5),
(4, 6),
(5, 7),
(6, 8),
(7, 9),
(8, 10),
(9, 11),
(10, 12);



CREATE TABLE users(
	email VARCHAR(255) NOT NULL,
	username VARCHAR(255) NOT NULL,
	user_password VARCHAR(255) NOT NULL
);


-- Índices para tablas volcadas
--
--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

-- Agregar índices y claves externas para la tabla intermedia `reservation_books`
/*ALTER TABLE `reservation_books`
  ADD PRIMARY KEY (`reservation_id`, `book_id`),
  ADD KEY `book_id` (`book_id`),
  ADD CONSTRAINT `reservation_books_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`),
  ADD CONSTRAINT `reservation_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);*/

-- Indices de la tabla `usuarios`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `book_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservations`
--
-- No se necesita clave externa para book_id en reservations
-- (remover esta línea ya que no se necesita)
-- ALTER TABLE `reservations`
--   ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

