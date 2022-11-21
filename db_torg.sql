-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 21 2022 г., 22:02
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `torg`
--
CREATE DATABASE IF NOT EXISTS `torg` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `torg`;

-- --------------------------------------------------------

--
-- Структура таблицы `tovary`
--

CREATE TABLE `tovary` (
  `id` int(11) NOT NULL,
  `name_` varchar(30) NOT NULL,
  `prc` int(11) NOT NULL,
  `sklad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tovary`
--

INSERT INTO `tovary` (`id`, `name_`, `prc`, `sklad`) VALUES
(1, 'AAA', 1000, 12),
(2, 'BBB', 2000, 8),
(3, 'CCC', 800, 15),
(6, 'DDD', 1000, 13),
(8, 'EEE', 828, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE `worker` (
  `id` int(11) NOT NULL,
  `FIO` varchar(30) NOT NULL,
  `work` varchar(30) NOT NULL CHECK (`work` = 'a' or `work` = 'b' or `work` = 'c'),
  `date_` date NOT NULL,
  `pay` int(11) NOT NULL CHECK (`pay` > 100 and `pay` < 50000)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`id`, `FIO`, `work`, `date_`, `pay`) VALUES
(1, 'A', 'a', '2020-11-05', 20000),
(2, 'B', 'b', '2021-11-30', 1500),
(3, 'C', 'a', '2020-06-30', 2000),
(4, 'D', 'b', '2022-11-11', 1500),
(6, 'E', 'c', '2022-11-09', 1111),
(7, 'F', 'b', '2021-01-12', 999);

--
-- Триггеры `worker`
--
DELIMITER $$
CREATE TRIGGER `date_check` BEFORE INSERT ON `worker` FOR EACH ROW BEGIN
	IF NEW.date_ > CURDATE() THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid date!';
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE `zakaz` (
  `id` int(11) NOT NULL,
  `date_pr` date NOT NULL DEFAULT current_timestamp(),
  `count_` int(11) NOT NULL,
  `id_tov` int(11) NOT NULL,
  `id_zkzch` int(11) NOT NULL,
  `id_pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `zakaz`
--

INSERT INTO `zakaz` (`id`, `date_pr`, `count_`, `id_tov`, `id_zkzch`, `id_pass`) VALUES
(1, '2022-11-01', 10, 1, 1, 1),
(2, '2022-11-04', 5, 2, 2, 1),
(6, '2022-11-06', 8, 3, 1, 6),
(7, '2022-11-08', 11, 6, 4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `zakazch`
--

CREATE TABLE `zakazch` (
  `id` int(11) NOT NULL,
  `name_` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `limitk` int(11) NOT NULL CHECK (`limitk` <= 5000000)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `zakazch`
--

INSERT INTO `zakazch` (`id`, `name_`, `phone`, `limitk`) VALUES
(1, 'Aa', '+375', 100000),
(2, 'Bb', '375', 2500000),
(4, 'Dd', '123', 321342),
(5, 'Ee', '1357', 1000),
(6, 'Cc', '456', 1111111);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tovary`
--
ALTER TABLE `tovary`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zakaz`
--
ALTER TABLE `zakaz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`id_tov`),
  ADD KEY `fk2` (`id_zkzch`),
  ADD KEY `fk3` (`id_pass`);

--
-- Индексы таблицы `zakazch`
--
ALTER TABLE `zakazch`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tovary`
--
ALTER TABLE `tovary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `zakaz`
--
ALTER TABLE `zakaz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `zakazch`
--
ALTER TABLE `zakazch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `zakaz`
--
ALTER TABLE `zakaz`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_tov`) REFERENCES `tovary` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_zkzch`) REFERENCES `zakazch` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_pass`) REFERENCES `worker` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
