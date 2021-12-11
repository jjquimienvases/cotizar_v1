-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-10-2018 a las 01:31:52
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `delta3_data`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `hr_entrada` time NOT NULL,
  `fecha` date NOT NULL,
  `detalle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `hr_entrada`, `fecha`, `detalle`) VALUES
(3, '06:11:00', '2018-10-08', 'Ingreso de Televisor LED Smart TV 40"'),
(4, '09:17:14', '2018-10-08', 'Ingreso de Minicomponente SAMSUMG'),
(5, '13:25:00', '2018-10-08', 'Ingreso de Reproductor Blu-ray Panasonic'),
(6, '15:17:14', '2018-10-08', 'Ingreso de PlayStation 4 PRO 1TR'),
(7, '08:38:00', '2018-10-09', 'Ingreso de Laptop DELL 1TB 12GR RAM '),
(8, '12:17:14', '2018-10-09', 'Ingreso de XBox 360 c/ Juego Gratis'),
(9, '08:38:00', '2018-10-10', 'Ingreso de Reproductor DVD '),
(10, '17:17:14', '2018-10-11', 'Ingreso de Marvel''s Spiderman PS4 '),
(11, '18:38:00', '2018-10-11', 'Ingreso de Iphone XS 125GB'),
(12, '21:34:22', '2018-10-11', 'Ingreso de HUAWEY P Smart 64GB'),
(13, '08:38:00', '2018-10-12', 'Ingreso de Samsung J8 32GB'),
(14, '12:17:14', '2018-10-12', 'Ingreso de Motorola G5 Plus 32GB'),
(15, '14:38:00', '2018-10-12', 'Ingreso de Naruto Ninja Storm Trilogy'),
(16, '17:17:14', '2018-10-12', 'Ingreso de God of War PS4'),
(17, '18:38:00', '2018-10-12', 'Ingreso de Nintendo WI'),
(18, '21:34:22', '2018-10-12', 'Ingreso de Audifonos Sony');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
