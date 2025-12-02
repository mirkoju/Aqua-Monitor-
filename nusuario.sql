-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2025 a las 03:31:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
  `tanque_id` int(11) DEFAULT 1,
  `tanque` varchar(50) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'no leida',
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas_llenado`
--

INSERT INTO `alertas_llenado` (`id`, `tanque_id`, `tanque`, `porcentaje`, `estado`, `fecha`) VALUES
(0, 1, 'Tacho 20L - 3', 0, 'no leida', '2025-11-09 23:29:47');

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
(0, 1, 'Tacho 20L - 1', 50, 'normal', '2025-11-09 23:26:51'),
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
-- Estructura de tabla para la tabla `tanques`
--

CREATE TABLE `tanques` (
  `id_tanque` int(11) NOT NULL,
  `nombre_tanque` varchar(50) NOT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tanques`
--

INSERT INTO `tanques` (`id_tanque`, `nombre_tanque`, `ubicacion`, `id_usuario`) VALUES
(1, 'Tacho 20L', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tanque_niveles`
--

CREATE TABLE `tanque_niveles` (
  `id` int(11) NOT NULL,
  `tanque_id` int(11) NOT NULL DEFAULT 1,
  `porcentaje` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas_llenado`
--
ALTER TABLE `alertas_llenado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alertas_tanque` (`tanque_id`);

--
-- Indices de la tabla `historial_agua`
--
ALTER TABLE `historial_agua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_historial_tanque` (`tanque_id`);

--
-- Indices de la tabla `registonuevo`
--
ALTER TABLE `registonuevo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `tanques`
--
ALTER TABLE `tanques`
  ADD PRIMARY KEY (`id_tanque`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tanque_niveles`
--
ALTER TABLE `tanque_niveles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_niveles_tanque` (`tanque_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tanques`
--
ALTER TABLE `tanques`
  MODIFY `id_tanque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tanque_niveles`
--
ALTER TABLE `tanque_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas_llenado`
--
ALTER TABLE `alertas_llenado`
  ADD CONSTRAINT `fk_alertas_tanque` FOREIGN KEY (`tanque_id`) REFERENCES `tanques` (`id_tanque`);

--
-- Filtros para la tabla `historial_agua`
--
ALTER TABLE `historial_agua`
  ADD CONSTRAINT `fk_historial_tanque` FOREIGN KEY (`tanque_id`) REFERENCES `tanques` (`id_tanque`);

--
-- Filtros para la tabla `tanques`
--
ALTER TABLE `tanques`
  ADD CONSTRAINT `tanques_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `registonuevo` (`id`);

--
-- Filtros para la tabla `tanque_niveles`
--
ALTER TABLE `tanque_niveles`
  ADD CONSTRAINT `fk_niveles_tanque` FOREIGN KEY (`tanque_id`) REFERENCES `tanques` (`id_tanque`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
