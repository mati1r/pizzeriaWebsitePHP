-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 02:53 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Krapkowice'),
(2, 'Gogolin'),
(3, 'Odrowąż'),
(4, 'Malnia'),
(5, 'Gwoździce');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(70) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `building_number` int(11) NOT NULL,
  `apartment_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `surname`, `phone_number`, `city`, `street`, `building_number`, `apartment_number`) VALUES
(1, 'Adam', 'Nowak', '222-222-222', 'Gogolin', 'Szybka', 5, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ingredients` varchar(300) NOT NULL,
  `price_30` int(11) NOT NULL,
  `price_40` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `ingredients`, `price_30`, `price_40`) VALUES
(1, 'Margherita', 'sos pomidorowy, ser, oregano', 24, 34),
(2, 'Funghi', 'sos pomidorowy, ser, oregano, pieczarki', 25, 40),
(3, 'Salami', 'sos pomidorowy, ser, oregano, salami', 26, 43),
(4, 'Prosciutto', 'sos pomidorowy, ser, oregano, szynka', 26, 44),
(5, 'Contodino', 'sos pomidorowy, ser, oregano, pieczarki, szynka', 27, 45),
(6, 'Forno', 'sos pomidorowy, ser, oregano, pieczarki, salami', 27, 45),
(7, 'Hawaii', 'sos pomidorowy, ser, oregano, ananas, szynka', 27, 46),
(8, 'Tonno', 'sos pomidorowy, ser, oregano, tuńczyk, cebula', 27, 45),
(9, 'Napoli', 'sos pomidorowy, ser, oregano, salami, szynka', 28, 47),
(10, 'Torino', 'sos pomidorowy, ser, oregano, boczek, cebula, pieczarki', 28, 47),
(11, 'Sergio', 'sos pomidorowy, ser, oregano, salami, papryka, oliwki, kukurydza', 28, 47),
(12, 'Wiejska', 'sos pomidorowy, ser, oregano, kabanos, ogórek konserwowy, boczek, cebula', 28, 47),
(13, 'Kebab pizza', 'sos śmietankowy, ser, mięso kebab, pieczarki, cebula', 28, 47),
(14, 'Siciliana', 'sos pomidorowy, ser, oregano, salami, pieczarki, papryka', 28, 46),
(15, 'Verona', 'sos pomidorowy, ser, oregano, kurczak, kukurydza', 28, 47),
(16, 'Porcini e piccante', 'włoski sos pomidorowy, mozzarella julienne, gorgonzola, borowiki, pikantne salami Spianata', 33, 50),
(17, 'Milano', 'sos pomidorowy, ser, oregano, boczek, szynka, cebula, jajko, kiełbasa', 28, 48),
(18, 'Mista', 'sos pomidorowy, ser, oregano, mięso gyros, kiełbasa, boczek', 29, 49),
(19, 'Venecja', 'sos pomidorowy, ser, oregano, brokuły, pieczarki, czosnek', 26, 41),
(20, 'Diabolo', 'sos pomidorowy, ser, oregano, papryka, ostre pepperoni, szynka, tabasco', 27, 46),
(21, 'Gyros', 'sos pomidorowy, ser, oregano, mięso gyros, kukurydza', 28, 47),
(22, 'Verde', 'sos pomidorowy, ser, oregano, kurczak, kukurydza, papryka, cebula 	', 26, 45),
(23, 'Spinaci', 'sos pomidorowy, ser, oregano, szynka, szpinak, czosnek', 27, 45),
(24, 'Parma', 'włoski sos pomidorowy, mozzarella julienne, szynka parmeńska,\r\nrucola, parmezan Grana Padano, pomidorki koktajlowe, oliwa', 33, 51),
(25, 'Quattro Formaggi', 'włoski sos pomidorowy, mozzarella julienne, gorgonzola, parmezan Grana Padano, ser wędzony', 32, 50),
(26, 'Fruti di Mare', 'sos pomidorowy, ser, oregano, owoce morza, czosnek, szpinak', 29, 45),
(27, 'Pizza Biała', 'sos biały, ser, oregano, szynka, pieczarki, kukurydza', 27, 46),
(28, 'Pollo Bianca', 'sos biały, ser, oregano, kurczak, brokuły, kukurydza, pieczarki, papryka', 29, 48),
(29, 'Rucola', 'włoski sos pomidorowy, pikantne salami Spianata lub salami łagodne, mozzarella julienne, serek mascarpone, rucola', 33, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu_orders`
--

CREATE TABLE `menu_orders` (
  `orders_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_orders`
--

INSERT INTO `menu_orders` (`orders_id`, `menu_id`, `quantity`, `size`) VALUES
(1, 1, 1, 30),
(1, 1, 1, 40),
(1, 2, 2, 40),
(1, 4, 1, 30),
(1, 5, 1, 40),
(1, 6, 1, 30),
(1, 7, 1, 30),
(1, 11, 1, 30);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `total_price`) VALUES
(1, 1, 291);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `menu_orders`
--
ALTER TABLE `menu_orders`
  ADD PRIMARY KEY (`orders_id`,`menu_id`,`size`),
  ADD KEY `menu_orders_menu_fk` (`menu_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_fk` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_orders`
--
ALTER TABLE `menu_orders`
  ADD CONSTRAINT `menu_orders_menu_fk` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_orders_orders_fk` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_fk` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
