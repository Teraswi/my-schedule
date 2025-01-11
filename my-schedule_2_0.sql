-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 11 2025 г., 15:17
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
-- База данных: `my-schedule_2.0`
--

-- --------------------------------------------------------

--
-- Структура таблицы `day`
--

CREATE TABLE `day` (
  `id_d` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `day`
--

INSERT INTO `day` (`id_d`, `name`) VALUES
(1, 'Понедельник'),
(2, 'Вторник'),
(3, 'Среда'),
(4, 'Четверг'),
(5, 'Пятница'),
(6, 'Суббота');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id_group` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id_group`, `name`) VALUES
(1, '11/16'),
(2, '12'),
(3, '13'),
(4, '14');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_subject`
--

CREATE TABLE `groups_subject` (
  `id` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `groups_subject`
--

INSERT INTO `groups_subject` (`id`, `id_sub`, `id_group`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `office`
--

CREATE TABLE `office` (
  `id_of` int(11) NOT NULL,
  `number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `office`
--

INSERT INTO `office` (`id_of`, `number`) VALUES
(1, '1'),
(2, '1а');

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `id_d` int(11) NOT NULL,
  `id_time` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_of` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`id`, `id_d`, `id_time`, `id_sub`, `id_group`, `id_of`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 1, 2, 2, 2, 1),
(3, 1, 2, 4, 1, 2),
(4, 1, 3, 2, 1, 2),
(5, 1, 4, 1, 1, 2),
(6, 2, 1, 3, 1, 1),
(8, 2, 3, 2, 1, 2),
(9, 3, 1, 4, 1, 2),
(10, 3, 2, 1, 1, 1),
(11, 2, 3, 4, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_student` int(11) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `patronymic` varchar(50) DEFAULT NULL,
  `id_group` int(11) NOT NULL,
  `date_receipts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_student`, `Surname`, `Name`, `patronymic`, `id_group`, `date_receipts`) VALUES
(1, 'Косарев', ' Дмитрий', ' Алексеевич', 1, '2025-01-11 13:15:34');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `id_sub` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id_sub`, `name`) VALUES
(1, 'Математика'),
(2, 'Физика'),
(3, 'Русский язык'),
(4, 'Родной язык');

-- --------------------------------------------------------

--
-- Структура таблицы `techer`
--

CREATE TABLE `techer` (
  `id_tech` int(11) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL,
  `items` varchar(1000) DEFAULT NULL,
  `medical` date DEFAULT NULL,
  `exit_medical` date DEFAULT NULL,
  `session` date DEFAULT NULL,
  `exit_session` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `time`
--

CREATE TABLE `time` (
  `id_time` int(11) NOT NULL,
  `Time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `time`
--

INSERT INTO `time` (`id_time`, `Time`) VALUES
(1, '1) 8.00 - 8.45'),
(2, '2) 8.55 - 9.45'),
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
-- Индексы таблицы `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id_d`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_group`);

--
-- Индексы таблицы `groups_subject`
--
ALTER TABLE `groups_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sub` (`id_sub`),
  ADD KEY `id_group` (`id_group`);

--
-- Индексы таблицы `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id_of`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_d` (`id_d`),
  ADD KEY `id_time` (`id_time`),
  ADD KEY `id_sub` (`id_sub`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_of` (`id_of`),
  ADD KEY `id_of_2` (`id_of`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id_group` (`id_group`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_sub`);

--
-- Индексы таблицы `techer`
--
ALTER TABLE `techer`
  ADD PRIMARY KEY (`id_tech`);

--
-- Индексы таблицы `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id_time`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `day`
--
ALTER TABLE `day`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `groups_subject`
--
ALTER TABLE `groups_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `office`
--
ALTER TABLE `office`
  MODIFY `id_of` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `techer`
--
ALTER TABLE `techer`
  MODIFY `id_tech` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `time`
--
ALTER TABLE `time`
  MODIFY `id_time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups_subject`
--
ALTER TABLE `groups_subject`
  ADD CONSTRAINT `groups_subject_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groups_subject_ibfk_2` FOREIGN KEY (`id_sub`) REFERENCES `subject` (`id_sub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_d`) REFERENCES `day` (`id_d`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`id_sub`) REFERENCES `subject` (`id_sub`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_5` FOREIGN KEY (`id_of`) REFERENCES `office` (`id_of`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
