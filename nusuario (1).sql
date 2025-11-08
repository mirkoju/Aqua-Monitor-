-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2025 a las 02:34:03
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nusuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas_llenado`
--

CREATE TABLE `alertas_llenado` (
  `id` int(11) NOT NULL,
  `tanque` varchar(50) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'no leida',
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas_llenado`
--

INSERT INTO `alertas_llenado` (`id`, `tanque`, `porcentaje`, `estado`, `fecha`) VALUES
(65, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:14'),
(66, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:16'),
(67, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:18'),
(68, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:20'),
(69, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:22'),
(70, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:24'),
(71, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:26'),
(72, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:29'),
(73, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:31'),
(74, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:33'),
(75, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:35'),
(76, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:37'),
(77, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:39'),
(78, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:41'),
(79, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:43'),
(80, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:46'),
(81, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:48'),
(82, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:50'),
(83, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:52'),
(84, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:54'),
(85, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:56'),
(86, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:30:58'),
(87, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:00'),
(88, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:02'),
(89, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:04'),
(90, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:07'),
(91, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:09'),
(92, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:11'),
(93, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:13'),
(94, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:15'),
(95, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:17'),
(96, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:19'),
(97, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:21'),
(98, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:23'),
(99, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:25'),
(100, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:28'),
(101, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:30'),
(102, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:32'),
(103, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:34'),
(104, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:36'),
(105, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:38'),
(106, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:40'),
(107, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:42'),
(108, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:44'),
(109, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:46'),
(110, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:48'),
(111, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:51'),
(112, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:31:53'),
(113, 'Tacho 20L', 24, 'no leida', '2025-09-23 02:31:59'),
(114, 'Tacho 20L', 20, 'no leida', '2025-09-23 02:32:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_agua`
--

CREATE TABLE `historial_agua` (
  `id` int(11) NOT NULL,
  `tanque_id` int(11) NOT NULL,
  `tanque` varchar(50) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_agua`
--

INSERT INTO `historial_agua` (`id`, `tanque_id`, `tanque`, `porcentaje`, `estado`, `fecha`) VALUES
(1626, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:07'),
(1627, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:10'),
(1628, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:12'),
(1629, 1, 'Tacho 20L', 89, 'normal', '2025-09-23 02:33:15'),
(1630, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:17'),
(1631, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:19'),
(1632, 1, 'Tacho 20L', 85, 'normal', '2025-09-23 02:33:21'),
(1633, 1, 'Tacho 20L', 86, 'normal', '2025-09-23 02:33:23'),
(1634, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:26'),
(1635, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:28'),
(1636, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:30'),
(1637, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:36'),
(1638, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:38'),
(1639, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:40'),
(1640, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:42'),
(1641, 1, 'Tacho 20L', 86, 'normal', '2025-09-23 02:33:44'),
(1642, 1, 'Tacho 20L', 86, 'normal', '2025-09-23 02:33:46'),
(1643, 1, 'Tacho 20L', 87, 'normal', '2025-09-23 02:33:49'),
(1644, 1, 'Tacho 20L', 84, 'normal', '2025-09-23 02:33:51'),
(1645, 1, 'Tacho 20L', 86, 'normal', '2025-09-23 02:33:53'),
(1646, 1, 'Tacho 20L', 85, 'normal', '2025-09-23 02:33:55'),
(1647, 1, 'Tacho 20L', 602, 'normal', '2025-09-23 02:33:57'),
(1648, 1, 'Tacho 20L', 85, 'normal', '2025-09-23 02:33:59'),
(1649, 1, 'Tacho 20L', 85, 'normal', '2025-09-23 02:34:01'),
(1650, 1, 'Tacho 20L', 85, 'normal', '2025-09-23 02:34:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registonuevo`
--

CREATE TABLE `registonuevo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registonuevo`
--

INSERT INTO `registonuevo` (`id`, `nombre`, `apellido`, `email`, `usuario`, `contrasena`, `rol`) VALUES
(3, 'bruno', 'dagostino', '123456@gmai.com', 'jbt', '$2y$10$Mrddo0ZCuXL3qa3YSOorNutlP7URxL6qrM5kbrCFISGY/imY3eylK', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registronuevo`
--

CREATE TABLE `registronuevo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tanque_niveles`
--

CREATE TABLE IF NOT EXISTS `tanque_niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanque_id` int(11) NOT NULL DEFAULT 1,
  `porcentaje` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas_llenado`
--
ALTER TABLE `alertas_llenado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_agua`
--
ALTER TABLE `historial_agua`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registonuevo`
--
ALTER TABLE `registonuevo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `registronuevo`
--
ALTER TABLE `registronuevo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indices de la tabla `tanque_niveles`
--
ALTER TABLE `tanque_niveles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas_llenado`
--
ALTER TABLE `alertas_llenado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `historial_agua`
--
ALTER TABLE `historial_agua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1651;

--
-- AUTO_INCREMENT de la tabla `registonuevo`
--
ALTER TABLE `registonuevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registronuevo`
--
ALTER TABLE `registronuevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tanque_niveles`
--
ALTER TABLE `tanque_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
