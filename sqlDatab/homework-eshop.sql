-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 09. bře 2023, 12:41
-- Verze serveru: 10.1.29-MariaDB
-- Verze PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `homework-eshop`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE `products` (
  `products_id` int(11) NOT NULL,
  `products_img_path` varchar(255) NOT NULL,
  `products_name` varchar(255) NOT NULL,
  `products_prize` varchar(255) NOT NULL,
  `products_descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`products_id`, `products_img_path`, `products_name`, `products_prize`, `products_descr`) VALUES
(22, 'img/gallery/photo-WirelessBluetoothsluchÃ¡tka-6409c538d0dd2.jpg', 'Wireless Bluetooth sluchÃ¡tka', '3 500,-', 'Tyto sluchÃ¡tka jsou dokonalÃ½m Å™eÅ¡enÃ­m pro vÅ¡echny, kdo chtÄ›jÃ­ poslouchat hudbu a nechtÄ›jÃ­ bÃ½t ruÅ¡eni okolnÃ­m hlukem. SluchÃ¡tka jsou vybavena technologiÃ­ aktivnÃ­ho potlaÄenÃ­ hluku, kterÃ¡ vÃ¡m umoÅ¾nÃ­ vychutnat si hudbu bez ruÅ¡enÃ­ okol');

-- --------------------------------------------------------

--
-- Struktura tabulky `profiles`
--

CREATE TABLE `profiles` (
  `users_id` varchar(255) NOT NULL,
  `profiles_img` varchar(255) NOT NULL,
  `profiles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `profiles`
--

INSERT INTO `profiles` (`users_id`, `profiles_img`, `profiles_id`) VALUES
('6', 'img/profiles/profiledefault.jpg', 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_firstName` varchar(255) NOT NULL,
  `users_secondName` varchar(255) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `users_dateOfBirth` date NOT NULL,
  `users_pwd` varchar(255) NOT NULL,
  `users_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`users_id`, `users_firstName`, `users_secondName`, `users_email`, `users_dateOfBirth`, `users_pwd`, `users_admin`) VALUES
(6, 'Test', 'Admin', 'testadmin@test.cz', '2002-06-15', '$2y$10$rNUmdYv2xLAfpNPo/AvbpeuMNJcMdkJ03ElYu3OpkirPc3Oz3Jutu', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`);

--
-- Indexy pro tabulku `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profiles_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pro tabulku `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profiles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
