-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-06-2018 a las 09:46:13
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventarios`
--
CREATE DATABASE IF NOT EXISTS `inventarios` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `inventarios`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_tienda`, `nombre_categoria`, `descripcion_categoria`, `date_added`) VALUES
(1, 2, 'Abarrotes', 'Productos para el area de abarrotes', '2018-05-09'),
(12, 1, 'Higiene y Limpieza', 'Categoria de productos del departamento de higiene y limpieza', '2018-06-07'),
(13, 1, 'Electrodomesticos', 'Productos de la seccion de electrodomesticos', '2018-06-06'),
(14, 2, 'Ropa Dama', 'Categoria para los productos del departamento de ropa para dama', '2018-06-14'),
(15, 2, 'Ropa Caballero', 'Categoria para los productos del departamento de ropa para caballero', '2018-06-22'),
(16, 1, 'Vinos y Licores', 'Categoria para los productos del departamento de vinos y licores', '2018-06-28'),
(17, 2, 'Frutas y Verduras', 'Departamento para los productos de frutas y verduras', '2018-06-15'),
(18, 1, 'Calzado', 'Departamento de calzado', '2018-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nota` varchar(255) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_producto`, `id_tienda`, `user_id`, `fecha`, `nota`, `referencia`, `cantidad`) VALUES
(1, 9, 1, 1, '2018-06-05', 'jajajja', '4324', 10),
(2, 9, 1, 1, '2018-06-05', 'Se traspasa 5 cajas de cereal Corn Flakes', '2039', 5),
(3, 9, 1, 1, '2018-06-05', 'kdajdks', '39483', 1),
(4, 1, 1, 1, '2018-06-05', 'kshaihdiw', '452', 20),
(5, 17, 2, 1, '2018-06-06', 'Se realiza el movimiento de 15 blusas', '8392', 10),
(6, 19, 1, 1, '2018-06-06', 'jshdjak', '3621', 15),
(7, 1, 1, 1, '2018-06-06', '', '', 0),
(8, 15, 1, 3, '2018-06-09', 'Freidora LG se pasa 5', '1012', -6),
(9, 15, 1, 3, '2018-06-09', 'jakdha', '1223', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_venta`
--

CREATE TABLE `info_venta` (
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `info_venta`
--

INSERT INTO `info_venta` (`id_producto`, `id_venta`, `precio`, `cantidad`) VALUES
(22, 13, 10, 3),
(23, 13, 25, 10),
(15, 14, 341, 3),
(24, 14, 860, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` char(255) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `date_added` date NOT NULL,
  `precio_producto` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_producto`, `codigo_producto`, `nombre_producto`, `date_added`, `precio_producto`, `stock`, `id_categoria`, `id_tienda`) VALUES
(1, '12000', 'Coca-cola', '2018-05-10', 18.5, 230, 1, 2),
(9, '1738', 'Cereal Corn Flakes', '2018-06-30', 54.5, 103, 1, 2),
(10, '1234', 'Papel Sanitario', '2018-06-30', 34, 82, 12, 1),
(11, '4371', 'Leche LALA', '2018-06-09', 17.3, 0, 1, 2),
(12, '7392', 'Frijo Del Valle', '2018-06-16', 23.1, 0, 1, 2),
(13, '1938', 'Shampoo Caprice', '2018-06-30', 23.5, 0, 12, 1),
(15, '17393', 'Freidora LG', '2018-06-06', 340.9, 6, 13, 1),
(16, '2341', 'Pantalon Levis', '2018-06-29', 278, 78, 14, 2),
(17, '8392', 'Blusa Roja', '2018-06-14', 89.4, 118, 14, 2),
(18, '1344', 'Camisa Cuadros', '2018-06-16', 256.9, 56, 15, 2),
(19, '1739', 'Vino Tinto', '2018-06-16', 136, 13, 16, 1),
(20, '1731', 'Cerveza Corona', '2018-06-01', 168, 20, 16, 1),
(21, '2613', 'Pollo', '2018-06-14', 90, 100, 1, 1),
(22, '13', 'Trapeador', '2018-06-09', 10, 78, 12, 1),
(23, '10001', 'Escoba Sipm', '2018-06-21', 25, 60, 12, 1),
(24, '1234', 'Tenis Nike2', '2018-06-16', 860, 35, 18, 1),
(26, '123', 'fdsa', '2018-06-22', 4321, 321, 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `id_tienda` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id_tienda`, `codigo`, `nombre`, `descripcion`, `fecha`, `estado`) VALUES
(0, '1212', '', '', '2018-06-05', 'Activo'),
(1, '1234', 'Walmart', 'Tienda para todo y mas', '2018-06-20', 'Activo'),
(2, '9876', 'Soriana', 'Tienda para el mexicano bien', '2018-06-27', 'Desactivo'),
(3, '87024', 'HEB', 'Tienda HEB', '2018-06-23', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password_hash` varchar(255) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `id_tienda`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 0, 'Guillermo', 'Perez', 'superadmin', 'admin', 'admin@gmail.com', '2018-05-23'),
(3, 1, 'Mariana Magdalena', 'Hinojosa Tijerina', 'malena', 'malena123', 'malena@correo.com', '2018-06-07'),
(4, 2, 'Fher Francisco', 'Torres Paz', 'fher', 'fher', 'fher@correo.com', '2018-06-21'),
(5, 2, 'Mario', 'Rodriguez', 'mario', 'mario', 'mario@correo.com', '2018-06-23'),
(6, 3, 'Paulina ', 'Hinojosa', 'paulina', 'paulina123', 'pau@correo.com', '2018-06-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_tienda`, `fecha`, `total`) VALUES
(13, 1, '2018-06-11', '280'),
(14, 1, '2018-06-11', '1883');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_tienda` (`id_tienda`),
  ADD KEY `id_tienda_2` (`id_tienda`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`id_tienda`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
