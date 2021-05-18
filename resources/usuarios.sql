-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2021 a las 13:55:11
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

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
  `Contraseña` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre completo`, `Correo`, `Contraseña`, `token`) VALUES
('Celx2', 'Celeste Laura', 'celeste@correo.com', '$2y$10$LUOxhS8HnkE3ZPffdkisGeEhi8/WSQV8e/xGP.WzDDxGxngUwTy0C', '0'),
('Javat00', 'Aarón Espinosa', 'aaron@correo.com', '$2y$10$LUOxhS8HnkE3ZPffdkisGeEhi8/WSQV8e/xGP.WzDDxGxngUwTy0C', '0'),
('Kaarel', 'Carlos Marín', 'carlos@correo.com', '$2y$10$LUOxhS8HnkE3ZPffdkisGeEhi8/WSQV8e/xGP.WzDDxGxngUwTy0C', '0'),
('Menkord', 'Antonio Fernández', 'antonio@correo.com', '$2y$10$LUOxhS8HnkE3ZPffdkisGeEhi8/WSQV8e/xGP.WzDDxGxngUwTy0C', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
