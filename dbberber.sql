-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Haz 2024, 16:16:34
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dbberber`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_full_name` varchar(20) NOT NULL,
  `admin_adres` varchar(50) DEFAULT NULL,
  `admin_mail` varchar(50) DEFAULT NULL,
  `admin_gender` bit(1) DEFAULT NULL,
  `admin_username` varchar(16) DEFAULT NULL,
  `admin_password` varchar(20) NOT NULL,
  `admin_telefon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_full_name`, `admin_adres`, `admin_mail`, `admin_gender`, `admin_username`, `admin_password`, `admin_telefon`) VALUES
(1, 'Admin One', '123 Admin St', 'admin1@example.com', b'1', 'adminone', 'adminpass1', '555-5671'),
(2, 'Admin Two', '456 Admin St', 'admin2@example.com', b'0', 'admintwo', 'adminpass2', '555-5672');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `barber_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `appointment_date`, `appointment_time`, `user_id`, `barber_id`) VALUES
(1, '2024-11-20', '14:40:00', 1, 2),
(2, '2025-08-23', '13:30:00', 1, 2),
(3, '2024-06-19', '14:40:00', 1, 2),
(4, '2025-12-19', '13:30:00', 1, 2),
(5, '2025-12-15', '13:30:00', 1, 2),
(6, '2024-09-12', '13:30:00', 17, 2),
(7, '2024-06-20', '13:30:00', 17, 2),
(8, '2056-02-25', '13:30:00', 17, 2),
(9, '2024-06-30', '13:30:00', 17, 2),
(10, '2025-05-30', '13:30:00', 17, 2),
(11, '2025-09-29', '13:30:00', 17, 2),
(12, '2026-09-29', '13:30:00', 19, 2),
(13, '2028-09-12', '13:30:00', 19, 2),
(14, '2024-06-22', '14:40:00', 19, 2),
(15, '2024-06-28', '13:30:00', 9, 3),
(16, '2024-06-21', '13:30:00', 19, 6),
(17, '2024-06-29', '10:00:00', 19, 7),
(18, '2024-06-30', '11:30:00', 9, 7),
(19, '2024-06-30', '17:30:00', 9, 6),
(20, '2024-06-21', '10:00:00', 9, 7),
(21, '2024-06-30', '10:00:00', 9, 7),
(22, '2024-07-07', '11:30:00', 9, 7),
(23, '2024-07-31', '12:30:00', 22, 7),
(24, '2024-07-01', '14:00:00', 22, 6),
(25, '2024-07-07', '13:30:00', 22, 7),
(26, '2024-06-21', '14:30:00', 22, 6),
(27, '2024-06-28', '06:00:00', 22, 6),
(28, '2024-06-29', '13:00:00', 22, 6),
(29, '2024-06-30', '12:00:00', 22, 7),
(30, '2024-06-23', '14:30:00', 22, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `barber`
--

CREATE TABLE `barber` (
  `berber_id` int(11) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `berber_adres` varchar(50) DEFAULT NULL,
  `berber_mail` varchar(50) DEFAULT NULL,
  `berber_gender` bit(1) DEFAULT NULL,
  `berber_username` varchar(16) DEFAULT NULL,
  `berber_password` varchar(20) NOT NULL,
  `berber_telefon` varchar(20) DEFAULT NULL,
  `working_hours` varchar(255) DEFAULT NULL,
  `working_days` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `barber`
--

INSERT INTO `barber` (`berber_id`, `full_name`, `berber_adres`, `berber_mail`, `berber_gender`, `berber_username`, `berber_password`, `berber_telefon`, `working_hours`, `working_days`, `reset_token`, `token_expiration`) VALUES
(1, 'Barber One', '123 Barber St', 'barber1@example.com', b'1', 'barberone', 'password1', '555-1231', NULL, NULL, NULL, NULL),
(2, 'Barber Two', '456 Barber St', 'barber2@example.com', b'0', 'barbertwo', 'password2', '555-1232', NULL, NULL, NULL, NULL),
(3, 'Barber Three', '789 Barber St', 'barber3@example.com', b'1', 'barberthree', 'password3', '555-1233', NULL, NULL, NULL, NULL),
(4, 'Barber Four', '101 Barber St', 'barber4@example.com', b'0', 'barberfour', 'password4', '555-1234', NULL, NULL, NULL, NULL),
(5, 'Barber Five', '202 Barber St', 'barber5@example.com', b'1', 'barberfive', 'password5', '555-1235', NULL, NULL, NULL, NULL),
(6, 'fiko38', 'Kayseri', 'fiko38@gmail.com', b'1', 'fiko38', 'fiko38', '05358924190', NULL, NULL, NULL, NULL),
(7, 'Ahmet Çakar', 'Ankara/Polatlı', 'ahmetcakar38@gmail.com', b'1', 'ahmettcakar31', 'ahmet123', '05358924190', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `berber_working_days`
--

CREATE TABLE `berber_working_days` (
  `id` int(11) NOT NULL,
  `berber_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `berber_working_days`
--

INSERT INTO `berber_working_days` (`id`, `berber_id`, `day`) VALUES
(13, 6, 'Pazartesi'),
(14, 7, 'Pazartesi'),
(15, 7, 'Salı'),
(16, 7, 'Çarşamba'),
(17, 7, 'Perşembe'),
(18, 7, 'Cuma'),
(19, 7, 'Cumartesi'),
(20, 7, 'Pazar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `berber_working_hours`
--

CREATE TABLE `berber_working_hours` (
  `id` int(11) NOT NULL,
  `berber_id` int(11) NOT NULL,
  `hour` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `berber_working_hours`
--

INSERT INTO `berber_working_hours` (`id`, `berber_id`, `hour`) VALUES
(55, 6, '06:00'),
(56, 6, '06:30'),
(57, 6, '07:00'),
(58, 6, '07:30'),
(59, 6, '08:00'),
(60, 6, '08:30'),
(61, 6, '09:00'),
(62, 6, '09:30'),
(63, 6, '10:00'),
(64, 6, '10:30'),
(65, 6, '11:00'),
(66, 6, '11:30'),
(67, 6, '12:00'),
(68, 6, '12:30'),
(69, 6, '13:00'),
(70, 6, '13:30'),
(71, 6, '14:00'),
(72, 6, '14:30'),
(73, 6, '15:00'),
(74, 6, '15:30'),
(75, 6, '16:00'),
(76, 6, '16:30'),
(77, 6, '17:00'),
(78, 6, '17:30'),
(79, 6, '18:00'),
(80, 6, '18:30'),
(81, 6, '19:00'),
(82, 7, '10:00'),
(83, 7, '10:30'),
(84, 7, '11:00'),
(85, 7, '11:30'),
(86, 7, '12:00'),
(87, 7, '12:30'),
(88, 7, '13:00'),
(89, 7, '13:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userphones`
--

CREATE TABLE `userphones` (
  `user_phone_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(20) NOT NULL,
  `user_adres` varchar(50) DEFAULT NULL,
  `user_mail` varchar(100) DEFAULT NULL,
  `user_telefon` varchar(20) DEFAULT NULL,
  `user_gender` bit(1) DEFAULT NULL,
  `user_name` varchar(16) DEFAULT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_verify` tinyint(1) DEFAULT 0,
  `google_id` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_adres`, `user_mail`, `user_telefon`, `user_gender`, `user_name`, `user_password`, `user_verify`, `google_id`, `profile_picture`, `verification_token`, `reset_token`, `token_expiration`) VALUES
(1, 'John Doe', '123 Main St', 'john@example.com', '555-1234', b'1', 'johndoe', 'password123', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Jane Smith', '456 Elm St', 'jane@example.com', '555-5678', b'0', 'janesmith', 'password456', 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Alice Johnson', '789 Oak St', 'alice@example.com', '555-9012', b'1', 'alicej', 'password789', 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Bob Brown', '101 Pine St', 'bob@example.com', '555-3456', b'0', 'bobbrown', 'password101', 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Charlie Davis', '202 Maple St', 'charlie@example.com', '555-7890', b'1', 'charlied', 'password202', 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Ursa Houston', 'Voluptatem cum corru', 'bowyg@mailinator.com', '05358924190', b'1', 'borefugyv', '$2y$10$PFKkYgaKu5QGB', 1, NULL, NULL, NULL, NULL, NULL),
(7, 'Sigourney Dennis', 'Nisi consequatur co', 'zakylavaj@mailinator.com', '05358924190', b'1', 'hybudunez', '$2y$10$THQHvGNysWHLq', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Kennedy Knapp', 'Ut aut consequuntur ', 'gyno@mailinator.com', '05358924190', b'1', 'wirypage', '$2y$10$IudGqgEaj6g93', 1, NULL, NULL, NULL, NULL, NULL),
(9, '', NULL, NULL, NULL, b'1', 'test', '$2y$10$E4vEMiqsnqSqN', 1, NULL, '../uploads/30.jpg', '360fa37818ee871cd2e1a064c40e9e19', 'db64872ebb86fe5dea6ec8c9b1af5820', '2024-06-20 15:19:46'),
(10, 'neslihan', 'ev', 'neslihansmks@gmail.com', '05358924190', b'1', 'nes', '$2y$10$vQECRHc6cnTzC', 1, NULL, NULL, NULL, NULL, NULL),
(11, 'Reed Chapman', 'Eum accusantium corr', 'mazifoze@mailinator.com', '05358924190', b'1', 'vudywehapa', '$2y$10$46UcoFeuqOo66', 1, NULL, NULL, NULL, NULL, NULL),
(12, 'Lawrence Parsons', 'Dolor autem voluptat', 'piwo@mailinator.com', '05358924190', b'1', 'hawydu', '$2y$10$t0vBtxbZySoT0', 1, NULL, NULL, NULL, NULL, NULL),
(13, 'Alana Perez', 'Nisi similique elige', 'haxi@mailinator.com', '05358924190', b'1', 'raqec', '$2y$10$thJ8S5NAWBMYo', 1, NULL, NULL, NULL, NULL, NULL),
(14, 'test32', 'test', 'test32@gmail.con', '05358924190', b'1', 'test32', '$2y$10$xhkX1S/xSbjYJ', 1, NULL, NULL, NULL, NULL, NULL),
(15, 'Ahmet Çakar', 'İstanbul/Bebek', 'ahmetcakar@gmail.com', '05522987063', b'1', 'ahmetcakar', '$2y$10$4/uTyXdsSz7sr', 1, NULL, NULL, NULL, NULL, NULL),
(16, 'yeni', 'yeni', 'yeni@gmail.com', '05358924190', b'1', 'yeni', '$2y$10$faqj5W.P7K82W', 1, NULL, NULL, NULL, NULL, NULL),
(17, 'kamil', 'kamil', 'kamil@gmail.com', '05358924190', b'1', 'kalim', 'kamil', 1, NULL, NULL, NULL, NULL, NULL),
(18, 'Tugrul Erciyas', 'Kayseri', 'tiger@gmail.com', '05358924190', b'1', 'tuking', '$2y$12$IrhR6mx7OgDVN', 1, NULL, NULL, NULL, NULL, NULL),
(19, '', NULL, NULL, NULL, b'1', 'eda32', 'eda123', 1, NULL, '../uploads/26.jpg', NULL, NULL, NULL),
(20, 'serdar erciyes', NULL, 'televizyonda.serdar@gmail.com', NULL, NULL, 'televizyonda.ser', '', 0, NULL, NULL, NULL, NULL, NULL),
(21, 'Fiko', 'Ankara Altındağ', 'fiko@gmail.com', '05358924190', b'1', 'fiko06', 'fiko06', 1, NULL, NULL, NULL, NULL, NULL),
(22, 'Serdar Erciyas', 'Ankar/Keçiören', 'serdarerciyas16@gmail.com', '05358924190', NULL, 'serdarerciyas16@', 'serdar123', 0, NULL, '../uploads/30.jpg', NULL, 'ec9c09408f70a7152981ec7b9108eba6', '2024-06-20 16:55:51');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_mail` (`admin_mail`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Tablo için indeksler `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `barber_id` (`barber_id`);

--
-- Tablo için indeksler `barber`
--
ALTER TABLE `barber`
  ADD PRIMARY KEY (`berber_id`),
  ADD UNIQUE KEY `berber_mail` (`berber_mail`),
  ADD UNIQUE KEY `berber_username` (`berber_username`);

--
-- Tablo için indeksler `berber_working_days`
--
ALTER TABLE `berber_working_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berber_id` (`berber_id`);

--
-- Tablo için indeksler `berber_working_hours`
--
ALTER TABLE `berber_working_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berber_id` (`berber_id`);

--
-- Tablo için indeksler `userphones`
--
ALTER TABLE `userphones`
  ADD PRIMARY KEY (`user_phone_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `barber`
--
ALTER TABLE `barber`
  MODIFY `berber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `berber_working_days`
--
ALTER TABLE `berber_working_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `berber_working_hours`
--
ALTER TABLE `berber_working_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Tablo için AUTO_INCREMENT değeri `userphones`
--
ALTER TABLE `userphones`
  MODIFY `user_phone_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`berber_id`);

--
-- Tablo kısıtlamaları `berber_working_days`
--
ALTER TABLE `berber_working_days`
  ADD CONSTRAINT `berber_working_days_ibfk_1` FOREIGN KEY (`berber_id`) REFERENCES `barber` (`berber_id`);

--
-- Tablo kısıtlamaları `berber_working_hours`
--
ALTER TABLE `berber_working_hours`
  ADD CONSTRAINT `berber_working_hours_ibfk_1` FOREIGN KEY (`berber_id`) REFERENCES `barber` (`berber_id`);

--
-- Tablo kısıtlamaları `userphones`
--
ALTER TABLE `userphones`
  ADD CONSTRAINT `userphones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
