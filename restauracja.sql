-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 02:12 PM
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
-- Database: `restauracja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id` int(11) NOT NULL,
  `Imie` varchar(20) NOT NULL,
  `Nazwisko` varchar(30) NOT NULL,
  `Telefon` varchar(11) NOT NULL,
  `Miasto` varchar(30) NOT NULL,
  `Ulica` varchar(30) NOT NULL,
  `Nr_bud` int(11) NOT NULL,
  `Nr_miesz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowanie`
--

CREATE TABLE `logowanie` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `haslo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logowanie`
--

INSERT INTO `logowanie` (`id`, `login`, `haslo`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `skladniki` varchar(150) NOT NULL,
  `cena_30` int(11) NOT NULL,
  `cena_40` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nazwa`, `skladniki`, `cena_30`, `cena_40`) VALUES
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
-- Struktura tabeli dla tabeli `miasta`
--

CREATE TABLE `miasta` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `miasta`
--

INSERT INTO `miasta` (`id`, `nazwa`) VALUES
(1, 'Krapkowice'),
(2, 'Gogolin'),
(3, 'Odrowąż'),
(4, 'Malnia'),
(5, 'Gwoździce');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `id_pizzy` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `rozmiar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logowanie`
--
ALTER TABLE `logowanie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `miasta`
--
ALTER TABLE `miasta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `id_pizzy` (`id_pizzy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logowanie`
--
ALTER TABLE `logowanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `miasta`
--
ALTER TABLE `miasta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_pizzy`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`id_klienta`) REFERENCES `klient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
