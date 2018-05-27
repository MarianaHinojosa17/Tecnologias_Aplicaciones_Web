-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-05-2018 a las 18:31:19
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pract8`
--
CREATE DATABASE IF NOT EXISTS `pract8` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pract8`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `matricula` varchar(7) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `id_carrera` int(10) NOT NULL,
  `id_tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `matricula`, `nombre`, `id_carrera`, `id_tutor`) VALUES
(1, '1530269', 'Mariana Hinojosa', 6, 1),
(3, '1530370', 'Fher Torres', 9, 1),
(4, '1656772', 'Luz Paulina Hinojosa Tijerina', 8, 2),
(5, '1428990', 'Milton Eliseo', 10, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre`) VALUES
(6, 'ITI'),
(7, 'ITM'),
(8, 'IM'),
(9, 'PyMES'),
(10, 'ISA'),
(11, 'Negocios'),
(12, 'Administrac'),
(13, 'Comunicacio'),
(14, 'Licencia'),
(15, 'Lice'),
(16, 'hola'),
(18, 'hola'),
(19, 'Mecatronica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `id_maestro` int(11) NOT NULL,
  `id_carrera` int(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id_maestro`, `id_carrera`, `nombre`, `email`, `pass`) VALUES
(1, 6, 'Francisco Torres', 'paco@correo.com', 'paco'),
(2, 10, 'Malena', 'malena@correo.com', 'malena'),
(3, 9, 'Mariana', 'mariana@correo.com', 'mariana'),
(4, 6, 'Alberto Robledo', 'robledo@correo.com', 'robledo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE `tutoria` (
  `id_tutoria` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `tema_tutoria` varchar(100) NOT NULL,
  `id_maestro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tutoria`
--

INSERT INTO `tutoria` (`id_tutoria`, `fecha`, `hora`, `tipo`, `tema_tutoria`, `id_maestro`) VALUES
(1, '2018-05-31', '8:00', 'grupal', 'Desarrollo Web', 0),
(2, '2018-05-29', '13:00', 'individual', 'App para dispositivos moviles', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria_info`
--

CREATE TABLE `tutoria_info` (
  `id_tutoria` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tutoria_info`
--

INSERT INTO `tutoria_info` (`id_tutoria`, `id_alumno`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_tutor` (`id_tutor`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`id_maestro`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD PRIMARY KEY (`id_tutoria`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indices de la tabla `tutoria_info`
--
ALTER TABLE `tutoria_info`
  ADD KEY `id_tutoria` (`id_tutoria`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id_maestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  MODIFY `id_tutoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_tutor`) REFERENCES `maestros` (`id_maestro`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD CONSTRAINT `maestros_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `tutoria_info`
--
ALTER TABLE `tutoria_info`
  ADD CONSTRAINT `tutoria_info_ibfk_1` FOREIGN KEY (`id_tutoria`) REFERENCES `tutoria` (`id_tutoria`),
  ADD CONSTRAINT `tutoria_info_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
