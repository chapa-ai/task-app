-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июл 02 2021 г., 17:14
-- Версия сервера: 5.7.32
-- Версия PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `2021`
--

-- --------------------------------------------------------

--
-- Структура таблицы `signin`
--

CREATE TABLE `signin` (
  `id` int(11) NOT NULL,
  `login` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `signin`
--

INSERT INTO `signin` (`id`, `login`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `task` varchar(256) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email`, `task`, `status`) VALUES
(3, 'Anton', 'anton.chaplygin00@mail.ru', 'Take an', 1),
(4, 'Anton', 'nnnnnnnn', 'Take an umbrella', 1),
(5, 'Maxim', 'maxim_st@mail.ru', 'Finish a JS course ', 2),
(6, 'Fedor', 'fedor_iv@gmail.com', 'rewrite a peace of code', 1),
(7, 'Fedor', 'fedor_iv@gmail.com', 'Find a solution of the exercise', 1),
(8, 'Fedor', 'fedor_iv@gmail.com', 'Help Maxim tomorrow', 2),
(9, 'Maxim', '', 'try to code a new part code', 3),
(10, 'Maxim', 'maxim_st@mail.ru', 'not to be late ', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `signin`
--
ALTER TABLE `signin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
