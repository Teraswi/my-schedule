-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 25 2024 г., 17:02
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
  `Группа` int(11) NOT NULL,
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

INSERT INTO `!01.12 (пятница)` (`Группа`, `12`, `13`, `34`, `41`, `24`, `46`) VALUES
(0, 'dsadasd', 'dasdasd', 'asdas', 'dasdas', 'dasd', 'asdasd'),
(0, 'adsdsad', 'asdasd', 'sadas', 'dasda', 'sdasd', 'asd'),
(1, 'dsadasd', 'dasdasd', 'asdas', 'dasdas', 'dasd', 'asdasd'),
(0, 'adsdsad', 'asdasd', 'sadas', 'dasda', 'sdasd', 'asd');

-- --------------------------------------------------------

--
-- Структура таблицы `!22.11 (среда)`
--

CREATE TABLE `!22.11 (среда)` (
  `Группа` int(11) NOT NULL,
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

INSERT INTO `!22.11 (среда)` (`Группа`, `12`, `13`, `34`, `41`, `24`, `46`) VALUES
(1, 'фвфыв', 'фывфывфы', 'вфывфы', 'вфывфывфы', 'вфывфы', 'вфывфыв'),
(2, 'фывфывфыв', 'фывфыв', 'фывфыв', 'фывфыв', 'фывыф', 'фывфывыф'),
(3, 'вфывфыв', 'фывфыв', 'фывфывф', 'ывфыв', 'фывфывфы', 'вфывфывфы'),
(4, 'фывфывыфв', 'ыфвфыв', 'фывфы', 'вфывфы', 'фыв', 'вфывфывы');

-- --------------------------------------------------------

--
-- Структура таблицы `12`
--

CREATE TABLE `12` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `13`
--

CREATE TABLE `13` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `14`
--

CREATE TABLE `14` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `15`
--

CREATE TABLE `15` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `21`
--

CREATE TABLE `21` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `22`
--

CREATE TABLE `22` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `23`
--

CREATE TABLE `23` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `24`
--

CREATE TABLE `24` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `25`
--

CREATE TABLE `25` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `26`
--

CREATE TABLE `26` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `31`
--

CREATE TABLE `31` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `32`
--

CREATE TABLE `32` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `33`
--

CREATE TABLE `33` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `34`
--

CREATE TABLE `34` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(12, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;');

-- --------------------------------------------------------

--
-- Структура таблицы `36`
--

CREATE TABLE `36` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `41`
--

CREATE TABLE `41` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `42`
--

CREATE TABLE `42` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `43`
--

CREATE TABLE `43` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `44`
--

CREATE TABLE `44` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `45`
--

CREATE TABLE `45` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `46`
--

CREATE TABLE `46` (
  `Time` varchar(50) NOT NULL,
  `Monday` varchar(100) DEFAULT NULL,
  `Tuesday` varchar(100) DEFAULT NULL,
  `Wednesday` varchar(100) DEFAULT NULL,
  `Thursday` varchar(100) DEFAULT NULL,
  `Friday` varchar(100) DEFAULT NULL,
  `Saturday` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `1116`
--

CREATE TABLE `1116` (
  `Time` varchar(50) NOT NULL,
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
('100', '-', '-', '-', '-', '-', '-');

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
(1, 'Карпова ', 'Татьяна ', 'Юрьевна', 'Стандартизация, Численные метода, Дискретная математика', '2023-06-19', '2023-08-21', NULL, NULL),
(2, 'Согомонян', 'Инна', 'Эдуардовна', 'МДК 05.02, База данных', NULL, NULL, '2023-07-10', '2024-08-09'),
(3, 'Фирсова', 'Алина', 'Сергеевна', 'Физическая культура', '0000-00-00', NULL, NULL, NULL),
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
  ADD KEY `id_T` (`Группа`);

--
-- Индексы таблицы `!22.11 (среда)`
--
ALTER TABLE `!22.11 (среда)`
  ADD KEY `id_T` (`Группа`);

--
-- Индексы таблицы `35`
--
ALTER TABLE `35`
  ADD PRIMARY KEY (`Time`);

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
-- AUTO_INCREMENT для таблицы `35`
--
ALTER TABLE `35`
  MODIFY `Time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
