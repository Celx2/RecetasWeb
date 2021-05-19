-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-05-2021 a las 16:38:11
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id16810550_proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(255) NOT NULL,
  `Nombre_completo` text DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre_completo`, `Correo`, `Contraseña`, `token`) VALUES
('Celx2', 'Celeste Laura', 'celeste@correo.com', '$2y$10$LUOxhS8HnkE3ZPffdkisGeEhi8/WSQV8e/xGP.WzDDxGxngUwTy0C', '0'),
('das95balas', 'David Alcázar', 'das95balas@gmail.com', '$2y$10$vLhoF7kaL9TnCByMfPSsFuPuEeRexhFUDA.AwyDCBTxgCxnDzdlxi', '0'),
('Javat00', 'Aarón Espinosa', 'aaron@correo.com', '$2y$10$7XYMlXa9kn00f4uC6W1yAO/8HBMC0O6wOUvW6o.EZpv3VI3kcPxOW', '0'),
('juli00', 'Julio Iglesias', 'julio@correo.com', '$2y$10$s4mrE9NOFIGfv5yy.h6BBuEdJ4OVksDx5jLTQh8l3uSy7PdXf1F3a', '0'),
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
