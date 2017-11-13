-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-11-2017 a las 06:38:13
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gallery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(16, 'various'),
(19, 'city'),
(20, 'landscapes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_images`
--

CREATE TABLE `gallery_images` (
  `image_id` int(11) NOT NULL,
  `image_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_category` int(11) NOT NULL,
  `image_column` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_height` int(11) NOT NULL,
  `image_date` date NOT NULL,
  `image_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_file` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `gallery_images`
--

INSERT INTO `gallery_images` (`image_id`, `image_title`, `image_category`, `image_column`, `image_height`, `image_date`, `image_status`, `image_file`) VALUES
(51, 'New', 16, 'col-md-4', 200, '2017-11-12', 'hidden', 'various2.jpg'),
(52, 'qweqwe', 16, 'col-md-4', 200, '2017-11-12', 'active', 'city3.jpg'),
(54, 'forest', 18, 'col-md-4', 200, '2017-11-12', 'active', 'nature1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pageview`
--

CREATE TABLE `pageview` (
  `id` int(11) NOT NULL,
  `page` text NOT NULL,
  `userip` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pageview`
--

INSERT INTO `pageview` (`id`, `page`, `userip`, `year`, `month`, `day`) VALUES
(3, 'gallerypage', '::1', 2017, 11, 13),
(4, 'gallerypage', '127.0.0.1', 2017, 11, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uder_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `user_password`, `user_email`, `user_phone`, `uder_role`) VALUES
(1, 'leinedam', 'Madeleine', 'Sangoi', '$2y$12$W.bIB514/bmLzdHBf/cq8u8pIiw8Njx7fUrpeh37/5yLVfvBHtMLm', 'leinedam@gmail.com', '', 'admin'),
(3, 'admin', '', '', '$2y$12$y9YeIu7UAksP0JocBJrhVuDn/5mAPL6JWsTyE4sS8qjHEU6YWThEK', 'admin@gmail.com', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indices de la tabla `pageview`
--
ALTER TABLE `pageview`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `pageview`
--
ALTER TABLE `pageview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
