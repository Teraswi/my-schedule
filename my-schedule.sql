-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 20 2024 г., 22:03
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my-schedule`
--

-- --------------------------------------------------------

--
-- Структура таблицы `!01.12 (пятница)`
--

CREATE TABLE `!01.12 (пятница)` (
  `id_ch` int(11) NOT NULL,
  `Группа` varchar(100) NOT NULL,
  `12` varchar(50) NOT NULL,
  `13` varchar(50) NOT NULL,
  `34` varchar(50) NOT NULL,
  `41` varchar(50) NOT NULL,
  `24` varchar(50) NOT NULL,
  `46` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `!01.12 (пятница)`
--

INSERT INTO `!01.12 (пятница)` (`id_ch`, `Группа`, `12`, `13`, `34`, `41`, `24`, `46`) VALUES
(1, '1) 8.00 - 8.45', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, '2) 8.55 - 9.40', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, '3) 9.50 - 10.35', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(4, '4) 10.45 - 11.30', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(9, 'Обед', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(10, '5) 12.15 - 13.00', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(11, '6) 13.10 - 13.55', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(12, '7) 14.05 - 14.50', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(13, '8) 15.00 - 15.45', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(14, '9) 15.55 - 16.40', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(15, '10) 16.50 - 17.35', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(16, '11) 17.45 - 18.30', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(17, '12) 18.40 - 19.25', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `!22.11 (среда)`
--

CREATE TABLE `!22.11 (среда)` (
  `id_ch` int(11) NOT NULL,
  `Группа` varchar(100) NOT NULL,
  `12` varchar(50) NOT NULL,
  `13` varchar(50) NOT NULL,
  `34` varchar(50) NOT NULL,
  `41` varchar(50) NOT NULL,
  `24` varchar(50) NOT NULL,
  `46` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `!22.11 (среда)`
--

INSERT INTO `!22.11 (среда)` (`id_ch`, `Группа`, `12`, `13`, `34`, `41`, `24`, `46`) VALUES
(1, '1) 8.00 - 8.45', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, '2) 8.55 - 9.40', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, '3) 9.50 - 10.35', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(4, '4) 10.45 - 11.30', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(5, 'Обед', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, '5) 12.15 - 13.00', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(7, '6) 13.10 - 13.55', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(8, '7) 14.05 - 14.50', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(9, '8) 15.00 - 15.45', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(10, '9) 15.55 - 16.40', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(11, '10) 16.50 - 17.35', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '11) 17.45 - 18.30', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '12) 18.40 - 19.25', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `12`
--

CREATE TABLE `12` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `12`
--

INSERT INTO `12` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `13`
--

CREATE TABLE `13` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `13`
--

INSERT INTO `13` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `14`
--

CREATE TABLE `14` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `14`
--

INSERT INTO `14` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `15`
--

CREATE TABLE `15` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `15`
--

INSERT INTO `15` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `21`
--

CREATE TABLE `21` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `21`
--

INSERT INTO `21` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `22`
--

CREATE TABLE `22` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `22`
--

INSERT INTO `22` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `23`
--

CREATE TABLE `23` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `23`
--

INSERT INTO `23` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `24`
--

CREATE TABLE `24` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `24`
--

INSERT INTO `24` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `25`
--

CREATE TABLE `25` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `25`
--

INSERT INTO `25` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `26`
--

CREATE TABLE `26` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `26`
--

INSERT INTO `26` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `31`
--

CREATE TABLE `31` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `31`
--

INSERT INTO `31` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `32`
--

CREATE TABLE `32` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `32`
--

INSERT INTO `32` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `33`
--

CREATE TABLE `33` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `33`
--

INSERT INTO `33` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `34`
--

CREATE TABLE `34` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `34`
--

INSERT INTO `34` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `35`
--

CREATE TABLE `35` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `35`
--

INSERT INTO `35` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'БЖ(Кол)-БЖ(Фад)', 'Практика(Викт)', 'Станд.(Карп)', 'Станд.(Карп)', '&nbsp;', '-/Ин.яз(Горд)'),
(2, 'БЖ(Кол)-БЖ(Фад)', 'Практика(Викт)', 'ИС(Сог)', 'Станд.(Карп)', '&nbsp;', '-/Ин.яз(Горд)'),
(3, 'ДМ(Карп)', 'ИС(Сог)', 'ИС(Сог)', 'Физра', 'ИС(Сог)', 'МДК 08.01(Викт)'),
(4, 'ДМ(Карп)', 'ИС(Сог)', 'ДМ(Карп)', 'Физра', 'ИС(Сог)', 'МДК 08.01(Викт)'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Ин-яз(Анис) / -', 'ЧМ(Карп)', 'УП по ПМ 05', 'МДК 08.01(Викт)', 'УП по ПМ 05', 'Практика(Викт)'),
(7, 'Ин-яз(Анис) / -', 'ЧМ(Карп)', 'УП по ПМ 05', 'МДК 08.01(Викт)', 'УП по ПМ 05', '&nbsp;'),
(8, '&nbsp;', 'УП по ПМ 05', 'Кл. час', 'ЧМ(Карп)', 'УП по ПМ 05', '&nbsp;'),
(9, '&nbsp;', 'УП по ПМ 05', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(10, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `36`
--

CREATE TABLE `36` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `36`
--

INSERT INTO `36` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `41`
--

CREATE TABLE `41` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `41`
--

INSERT INTO `41` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `42`
--

CREATE TABLE `42` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `42`
--

INSERT INTO `42` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `43`
--

CREATE TABLE `43` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `43`
--

INSERT INTO `43` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `44`
--

CREATE TABLE `44` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `44`
--

INSERT INTO `44` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `45`
--

CREATE TABLE `45` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `45`
--

INSERT INTO `45` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `46`
--

CREATE TABLE `46` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `46`
--

INSERT INTO `46` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `1116`
--

CREATE TABLE `1116` (
  `Time` int(11) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `1116`
--

INSERT INTO `1116` (`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(2, 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1', 'Пара 1'),
(3, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(4, 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2', 'Пара 2'),
(5, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(6, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(7, 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3', 'Пара 3'),
(8, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(9, 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4', 'Пара 4'),
(10, 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5', 'Пара 5'),
(11, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;'),
(13, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_s` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `groups` int(11) NOT NULL,
  `date_receipts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_s`, `surname`, `name`, `patronymic`, `groups`, `date_receipts`) VALUES
(1, 'Круглов', 'Никита', 'Андреевич', 35, '2024-04-29 13:12:11'),
(2, 'Иванова', 'Софья', 'Руслановна', 15, '2024-04-29 13:24:16'),
(3, 'Косарев', 'Дмитрий', 'Алексеевич', 1116, '2024-04-29 13:24:16'),
(4, 'Белов', 'Максим', 'Андреевич', 15, '2024-04-29 13:24:16'),
(5, 'Попова', 'Ева', 'Дмитриевна', 15, '2024-04-29 13:24:16'),
(6, 'Фокина', 'София', 'Дмитриевна', 15, '2024-04-29 13:24:16'),
(7, 'Ученик ', 'А', 'Б', 1116, '2024-06-20 14:45:13'),
(8, 'Ученик ', 'А', 'Б', 1116, '2024-06-20 14:45:30'),
(9, 'Ученик ', 'А', 'Б', 1116, '2024-06-20 14:45:34'),
(10, 'Ученик ', 'А', 'Б', 1116, '2024-06-20 14:45:36'),
(11, 'Ученик ', 'А', 'Б', 1116, '2024-06-20 14:47:56'),
(12, 'Студент ', 'А', 'Б', 1116, '2024-06-20 14:49:15'),
(13, 'Ученик ', 'А', 'Б', 12, '2024-06-20 14:50:02'),
(14, 'Ученик ', 'А', 'Б', 12, '2024-06-20 14:50:04'),
(15, 'Ученик ', 'А', 'Б', 12, '2024-06-20 14:50:06'),
(16, 'Ученик ', 'А', 'Б', 12, '2024-06-20 14:50:07'),
(17, 'Ученик ', 'А', 'Б', 12, '2024-06-20 14:50:09'),
(18, 'Ученик ', 'А', 'Б', 13, '2024-06-20 14:50:52'),
(19, 'Ученик ', 'А', 'Б', 13, '2024-06-20 14:50:54'),
(20, 'Ученик ', 'А', 'Б', 13, '2024-06-20 14:50:56'),
(21, 'Ученик ', 'А', 'Б', 13, '2024-06-20 14:50:57'),
(22, 'Ученик ', 'А', 'Б', 13, '2024-06-20 14:50:59'),
(23, 'Ученик ', 'А', 'Б', 14, '2024-06-20 14:51:03'),
(24, 'Ученик ', 'А', 'Б', 14, '2024-06-20 14:51:05'),
(25, 'Ученик ', 'А', 'Б', 14, '2024-06-20 14:51:06'),
(26, 'Ученик ', 'А', 'Б', 14, '2024-06-20 14:51:08'),
(27, 'Ученик ', 'А', 'Б', 14, '2024-06-20 14:51:10'),
(28, 'Ученик ', 'А', 'Б', 14, '2024-06-20 14:51:11'),
(29, 'Ученик ', 'А', 'Б', 15, '2024-06-20 14:52:02'),
(30, 'Ученик ', 'А', 'Б', 21, '2024-06-20 14:52:06'),
(31, 'Ученик ', 'А', 'Б', 21, '2024-06-20 14:52:08'),
(32, 'Ученик ', 'А', 'Б', 21, '2024-06-20 14:52:09'),
(33, 'Ученик ', 'А', 'Б', 21, '2024-06-20 14:52:11'),
(34, 'Ученик ', 'А', 'Б', 21, '2024-06-20 14:52:12'),
(35, 'Ученик ', 'А', 'Б', 22, '2024-06-20 14:52:16'),
(36, 'Ученик ', 'А', 'Б', 22, '2024-06-20 14:52:18'),
(37, 'Ученик ', 'А', 'Б', 22, '2024-06-20 14:52:20'),
(38, 'Ученик ', 'А', 'Б', 22, '2024-06-20 14:52:21'),
(39, 'Ученик ', 'А', 'Б', 22, '2024-06-20 14:52:23'),
(40, 'Ученик ', 'А', 'Б', 23, '2024-06-20 14:52:26'),
(41, 'Ученик ', 'А', 'Б', 23, '2024-06-20 14:52:28'),
(42, 'Ученик ', 'А', 'Б', 23, '2024-06-20 14:52:29'),
(43, 'Ученик ', 'А', 'Б', 23, '2024-06-20 14:52:31'),
(44, 'Ученик ', 'А', 'Б', 23, '2024-06-20 14:52:32'),
(45, 'Ученик ', 'А', 'Б', 24, '2024-06-20 14:52:36'),
(46, 'Ученик ', 'А', 'Б', 24, '2024-06-20 14:52:38'),
(47, 'Ученик ', 'А', 'Б', 24, '2024-06-20 14:52:39'),
(48, 'Ученик ', 'А', 'Б', 24, '2024-06-20 14:52:41'),
(49, 'Ученик ', 'А', 'Б', 24, '2024-06-20 14:52:43'),
(50, 'Ученик ', 'А', 'Б', 24, '2024-06-20 14:52:45'),
(51, 'Ученик ', 'А', 'Б', 25, '2024-06-20 14:52:59'),
(52, 'Ученик ', 'А', 'Б', 25, '2024-06-20 14:53:02'),
(53, 'Ученик ', 'А', 'Б', 25, '2024-06-20 14:53:03'),
(54, 'Ученик ', 'А', 'Б', 25, '2024-06-20 14:53:05'),
(55, 'Ученик ', 'А', 'Б', 25, '2024-06-20 14:53:06'),
(56, 'Ученик ', 'А', 'Б', 26, '2024-06-20 14:53:10'),
(57, 'Ученик ', 'А', 'Б', 26, '2024-06-20 14:53:12'),
(58, 'Ученик ', 'А', 'Б', 26, '2024-06-20 14:53:14'),
(59, 'Ученик ', 'А', 'Б', 26, '2024-06-20 14:53:16'),
(60, 'Ученик ', 'А', 'Б', 26, '2024-06-20 14:53:17'),
(61, 'Ученик ', 'А', 'Б', 31, '2024-06-20 14:53:22'),
(62, 'Ученик ', 'А', 'Б', 31, '2024-06-20 14:53:23'),
(63, 'Ученик ', 'А', 'Б', 31, '2024-06-20 14:53:25'),
(64, 'Ученик ', 'А', 'Б', 31, '2024-06-20 14:53:26'),
(65, 'Ученик ', 'А', 'Б', 31, '2024-06-20 14:53:28'),
(66, 'Ученик ', 'А', 'Б', 32, '2024-06-20 14:53:32'),
(67, 'Ученик ', 'А', 'Б', 32, '2024-06-20 14:53:33'),
(68, 'Ученик ', 'А', 'Б', 32, '2024-06-20 14:53:35'),
(69, 'Ученик ', 'А', 'Б', 32, '2024-06-20 14:53:36'),
(70, 'Ученик ', 'А', 'Б', 32, '2024-06-20 14:53:38'),
(71, 'Ученик ', 'А', 'Б', 33, '2024-06-20 14:53:41'),
(72, 'Ученик ', 'А', 'Б', 33, '2024-06-20 14:53:43'),
(73, 'Ученик ', 'А', 'Б', 33, '2024-06-20 14:53:45'),
(74, 'Ученик ', 'А', 'Б', 33, '2024-06-20 14:53:46'),
(75, 'Ученик ', 'А', 'Б', 33, '2024-06-20 14:53:48'),
(76, 'Ученик ', 'А', 'Б', 34, '2024-06-20 14:53:52'),
(77, 'Ученик ', 'А', 'Б', 34, '2024-06-20 14:53:55'),
(78, 'Ученик ', 'А', 'Б', 34, '2024-06-20 14:53:57'),
(79, 'Ученик ', 'А', 'Б', 34, '2024-06-20 14:53:58'),
(80, 'Ученик ', 'А', 'Б', 34, '2024-06-20 14:54:00'),
(81, 'Ученик ', 'А', 'Б', 35, '2024-06-20 14:54:05'),
(82, 'Ученик ', 'А', 'Б', 35, '2024-06-20 14:54:07'),
(83, 'Ученик ', 'А', 'Б', 35, '2024-06-20 14:54:10'),
(84, 'Ученик ', 'А', 'Б', 35, '2024-06-20 14:54:12'),
(85, 'Ученик ', 'А', 'Б', 36, '2024-06-20 14:54:26'),
(86, 'Ученик ', 'А', 'Б', 36, '2024-06-20 14:54:28'),
(87, 'Ученик ', 'А', 'Б', 36, '2024-06-20 14:54:30'),
(88, 'Ученик ', 'А', 'Б', 36, '2024-06-20 14:54:31'),
(89, 'Ученик ', 'А', 'Б', 36, '2024-06-20 14:54:33'),
(90, 'Ученик ', 'А', 'Б', 41, '2024-06-20 14:54:52'),
(91, 'Ученик ', 'А', 'Б', 41, '2024-06-20 14:54:55'),
(92, 'Ученик ', 'А', 'Б', 41, '2024-06-20 14:54:56'),
(93, 'Ученик ', 'А', 'Б', 41, '2024-06-20 14:54:58'),
(94, 'Ученик ', 'А', 'Б', 41, '2024-06-20 14:54:59'),
(95, 'Ученик ', 'А', 'Б', 42, '2024-06-20 14:55:03'),
(96, 'Ученик ', 'А', 'Б', 42, '2024-06-20 14:55:05'),
(97, 'Ученик ', 'А', 'Б', 42, '2024-06-20 14:55:07'),
(98, 'Ученик ', 'А', 'Б', 42, '2024-06-20 14:55:09'),
(99, 'Ученик ', 'А', 'Б', 42, '2024-06-20 14:55:10'),
(100, 'Ученик ', 'А', 'Б', 43, '2024-06-20 14:55:15'),
(101, 'Ученик ', 'А', 'Б', 43, '2024-06-20 14:55:17'),
(102, 'Ученик ', 'А', 'Б', 43, '2024-06-20 14:55:18'),
(103, 'Ученик ', 'А', 'Б', 43, '2024-06-20 14:55:20'),
(104, 'Ученик ', 'А', 'Б', 43, '2024-06-20 14:55:22'),
(105, 'Ученик ', 'А', 'Б', 44, '2024-06-20 14:55:27'),
(106, 'Ученик ', 'А', 'Б', 44, '2024-06-20 14:55:29'),
(107, 'Ученик ', 'А', 'Б', 44, '2024-06-20 14:55:31'),
(108, 'Ученик ', 'А', 'Б', 44, '2024-06-20 14:55:33'),
(109, 'Ученик ', 'А', 'Б', 44, '2024-06-20 14:55:35'),
(110, 'Ученик ', 'А', 'Б', 45, '2024-06-20 14:55:39'),
(111, 'Ученик ', 'А', 'Б', 45, '2024-06-20 14:55:40'),
(112, 'Ученик ', 'А', 'Б', 45, '2024-06-20 14:55:42'),
(113, 'Ученик ', 'А', 'Б', 45, '2024-06-20 14:55:44'),
(114, 'Ученик ', 'А', 'Б', 45, '2024-06-20 14:55:46'),
(115, 'Ученик ', 'А', 'Б', 46, '2024-06-20 14:55:50'),
(116, 'Ученик ', 'А', 'Б', 46, '2024-06-20 14:55:52'),
(117, 'Ученик ', 'А', 'Б', 46, '2024-06-20 14:55:54'),
(118, 'Ученик ', 'А', 'Б', 46, '2024-06-20 14:55:55'),
(119, 'Ученик ', 'А', 'Б', 46, '2024-06-20 14:55:57');

-- --------------------------------------------------------

--
-- Структура таблицы `techer`
--

CREATE TABLE `techer` (
  `id_tech` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `items` varchar(1000) NOT NULL,
  `medical` date DEFAULT NULL,
  `exit_medical` date DEFAULT NULL,
  `session` date DEFAULT NULL,
  `exit_session` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `techer`
--

INSERT INTO `techer` (`id_tech`, `surname`, `name`, `patronymic`, `items`, `medical`, `exit_medical`, `session`, `exit_session`) VALUES
(1, 'Карпова ', 'Татьяна ', 'Юрьевна', 'Стандартизация, Численные методы, Дискретная математика', '2023-06-19', '2023-08-21', NULL, NULL),
(2, 'Согомонян', 'Инна', 'Эдуардовна', 'МДК 05.02, База данных', NULL, NULL, '2023-07-10', '2024-08-09'),
(3, 'Фирсова', 'Алина', 'Сергеевна', 'Физическая культура', '2024-06-02', NULL, NULL, NULL),
(4, 'Анисимова', 'Анна', 'Владимировна', 'Английский язык, Немецкий язык', NULL, NULL, NULL, NULL),
(5, 'Тюрина', 'Надежда', 'Николаевна', 'Математика, Физика', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `time`
--

CREATE TABLE `time` (
  `id_T` int(11) NOT NULL,
  `Time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `time`
--

INSERT INTO `time` (`id_T`, `Time`) VALUES
(1, '1) 8.00 - 8.45'),
(2, '2) 8.55 - 9.40'),
(3, '3) 9.50 - 10.35'),
(4, '4) 10.45 - 11.30'),
(5, 'Обед'),
(6, '5) 12.15 - 13.00'),
(7, '6) 13.10 - 13.55'),
(8, '7) 14.05 - 14.50'),
(9, '8) 15.00 - 15.45'),
(10, '9) 15.55 - 16.40'),
(11, '10) 16.50 - 17.35'),
(12, '11) 17.45 - 18.30'),
(13, '12) 18.40 - 19.25');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_u` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_u`, `login`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(3, 'techer', '3360fe6a1cb0cf87d94071081345bffc', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `!01.12 (пятница)`
--
ALTER TABLE `!01.12 (пятница)`
  ADD PRIMARY KEY (`id_ch`);

--
-- Индексы таблицы `!22.11 (среда)`
--
ALTER TABLE `!22.11 (среда)`
  ADD PRIMARY KEY (`id_ch`);

--
-- Индексы таблицы `12`
--
ALTER TABLE `12`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `13`
--
ALTER TABLE `13`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `14`
--
ALTER TABLE `14`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `15`
--
ALTER TABLE `15`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `21`
--
ALTER TABLE `21`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `22`
--
ALTER TABLE `22`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `23`
--
ALTER TABLE `23`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `24`
--
ALTER TABLE `24`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `25`
--
ALTER TABLE `25`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `26`
--
ALTER TABLE `26`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `31`
--
ALTER TABLE `31`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `32`
--
ALTER TABLE `32`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `33`
--
ALTER TABLE `33`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `34`
--
ALTER TABLE `34`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `35`
--
ALTER TABLE `35`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `36`
--
ALTER TABLE `36`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `41`
--
ALTER TABLE `41`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `42`
--
ALTER TABLE `42`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `43`
--
ALTER TABLE `43`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `44`
--
ALTER TABLE `44`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `45`
--
ALTER TABLE `45`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `46`
--
ALTER TABLE `46`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `1116`
--
ALTER TABLE `1116`
  ADD PRIMARY KEY (`Time`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_s`);

--
-- Индексы таблицы `techer`
--
ALTER TABLE `techer`
  ADD PRIMARY KEY (`id_tech`);

--
-- Индексы таблицы `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id_T`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `!01.12 (пятница)`
--
ALTER TABLE `!01.12 (пятница)`
  MODIFY `id_ch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `!22.11 (среда)`
--
ALTER TABLE `!22.11 (среда)`
  MODIFY `id_ch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `12`
--
ALTER TABLE `12`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `13`
--
ALTER TABLE `13`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `14`
--
ALTER TABLE `14`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `15`
--
ALTER TABLE `15`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `21`
--
ALTER TABLE `21`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `22`
--
ALTER TABLE `22`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `23`
--
ALTER TABLE `23`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `24`
--
ALTER TABLE `24`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `25`
--
ALTER TABLE `25`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `26`
--
ALTER TABLE `26`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `31`
--
ALTER TABLE `31`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `32`
--
ALTER TABLE `32`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `33`
--
ALTER TABLE `33`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `34`
--
ALTER TABLE `34`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `35`
--
ALTER TABLE `35`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `36`
--
ALTER TABLE `36`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `41`
--
ALTER TABLE `41`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `42`
--
ALTER TABLE `42`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `43`
--
ALTER TABLE `43`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `44`
--
ALTER TABLE `44`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `45`
--
ALTER TABLE `45`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `46`
--
ALTER TABLE `46`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `1116`
--
ALTER TABLE `1116`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT для таблицы `techer`
--
ALTER TABLE `techer`
  MODIFY `id_tech` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `time`
--
ALTER TABLE `time`
  MODIFY `id_T` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
