-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 173.230.154.140
-- Tiempo de generación: 20-06-2020 a las 23:41:58
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cotpruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_modificada`
--

CREATE TABLE `factura_modificada` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_receiver_name` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `guia` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `factura_modificada`
--

INSERT INTO `factura_modificada` (`order_id`, `user_id`, `order_receiver_name`, `estado`, `guia`) VALUES
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario'),
(1, 2, 'cesar', 'alistamiento', 'imagen.jpg'),
(0, 0, 'cliente', 'estadoactual', 'fichero_usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_orden`
--

CREATE TABLE `factura_orden` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_receiver_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `order_receiver_address` text CHARACTER SET utf8 NOT NULL,
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `order_tax_per` varchar(250) CHARACTER SET utf8 NOT NULL,
  `order_total_after_tax` double(10,2) NOT NULL,
  `order_amount_paid` decimal(10,2) NOT NULL,
  `order_total_amount_due` decimal(10,2) NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura_orden`
--

INSERT INTO `factura_orden` (`order_id`, `user_id`, `order_date`, `order_receiver_name`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `note`) VALUES
(1, 1, '2020-06-20 14:59:40', 'cesar', 'carrera 82 ', '4513.66', '857.60', '19', 5371.26, '0.00', '5371.26', 'Primera factura '),
(2, 2, '2020-06-20 15:29:26', 'cesar', 'jj quimi envases', '1900.00', '361.00', '19', 2261.00, '0.00', '2261.00', 'factura'),
(3, 3, '2020-06-20 17:44:18', 'leiner mena', 'cra 22h', '11172000.00', '0.00', '', 11172000.00, '0.00', '11172000.00', 'cotizacion de cesar para leiner'),
(6, 3, '2020-06-20 17:46:41', 'lorena', 'carrera 25 \r\n', '13466250.00', '0.00', '', 13466250.00, '0.00', '13466250.00', 'para lorena cotizacion de cesar ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_orden_producto`
--

CREATE TABLE `factura_orden_producto` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura_orden_producto`
--

INSERT INTO `factura_orden_producto` (`order_item_id`, `order_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES
(1, 1, '16', 'Jean Paul Gaultier, Le Male by', '95.00', '23.15', '2198.96'),
(2, 1, '16', 'Jean Paul Gaultier, Le Male by', '100.00', '23.15', '2314.70'),
(4, 2, 'calvin klein', '52', '95.00', '20.00', '1900.00'),
(5, 3, '1', 'Lacoste,   L.12.12 Blanc by', '56.00', '1.00', '11172000.00'),
(8, 6, '9', 'Chanel,  Allure Homme by  ', '95.00', '1.00', '13466250.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_usuarios`
--

CREATE TABLE `factura_usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura_usuarios`
--

INSERT INTO `factura_usuarios` (`id`, `email`, `password`, `first_name`, `last_name`, `mobile`, `address`) VALUES
(2, 'leinermenar@outlook.com', 'leinermena', 'leiner', 'mena', 3054272615, 'carrera 22h #58 - 18 sur'),
(3, 'csar-981@hotmail.com', 'sophia2103', 'Cesar', 'Alvarado', 3134662153, 'carrera 25 #66 -82'),
(4, 'info@envasesyperfumeria.com', 'quimienvases ', 'viviana ', 'Echeverria', 3134662153, 'carrera 25 #66 - 82 ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `factura_orden`
--
ALTER TABLE `factura_orden`
  ADD PRIMARY KEY (`order_id`);

--
-- Indices de la tabla `factura_orden_producto`
--
ALTER TABLE `factura_orden_producto`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indices de la tabla `factura_usuarios`
--
ALTER TABLE `factura_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura_orden`
--
ALTER TABLE `factura_orden`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `factura_orden_producto`
--
ALTER TABLE `factura_orden_producto`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `factura_usuarios`
--
ALTER TABLE `factura_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
