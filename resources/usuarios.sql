-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2021 a las 17:55:34
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(255) NOT NULL,
  `Nombre completo` text DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Contraseña` varchar(255) DEFAULT NULL
  `token` varchar(255) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre completo`, `Correo`, `Contraseña`, `token`) VALUES
('Celx2', 'Celeste Laura', 'celeste@correo.com', '$2y$10$MO4130M7uRtadsYhvBZbvusMOAO0IxfpCizMLJcUnOYwtAoF1puhW', '0'),
('Javat00', 'Aarón Espinosa', 'aaron@correo.com', '$2y$10$MO4130M7uRtadsYhvBZbvusMOAO0IxfpCizMLJcUnOYwtAoF1puhW', '0'),
('Kaarel', 'Carlos Marín', 'carlos@correo.com', '$2y$10$MO4130M7uRtadsYhvBZbvusMOAO0IxfpCizMLJcUnOYwtAoF1puhW', '0'),
('Menkord', 'Antonio Fernández', 'antonio@correo.com', '$2y$10$MO4130M7uRtadsYhvBZbvusMOAO0IxfpCizMLJcUnOYwtAoF1puhW', '0');

--
-- Índices para tablas volcadas
--s

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
