-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-05-2021 a las 16:36:31
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
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `Nombre_usuario` varchar(255) DEFAULT NULL,
  `IDReceta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`Nombre_usuario`, `IDReceta`) VALUES
('Celx2', 64),
('Menkord', 77),
('Kaarel', 80),
('Kaarel', 81),
('Javat00', 65),
('Javat00', 68),
('Celx2', 81),
('Celx2', 71),
('Javat00', 81),
('Menkord', 69);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `ID` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Nombre` text DEFAULT NULL,
  `Categoría` text DEFAULT NULL,
  `Me_gusta` int(11) DEFAULT 0,
  `Imagen` varchar(255) DEFAULT NULL,
  `Ingredientes` varchar(255) DEFAULT NULL,
  `Preparación` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`ID`, `Usuario`, `Nombre`, `Categoría`, `Me_gusta`, `Imagen`, `Ingredientes`, `Preparación`) VALUES
(64, 'Celx2', 'Spaghetti a la boloñesa', 'Pastas', 1, 'pictures/ea5d2f1c4608232e07d3aa3d998e5135.jpeg', 'recipes/64_ingredients.txt', 'recipes/64_preparation.txt'),
(65, 'Celx2', 'Galletas de avena y chocolate', 'Desayunos', 1, 'pictures/fc490ca45c00b1249bbe3554a4fdf6fb.jpeg', 'recipes/65_ingredients.txt', 'recipes/65_preparation.txt'),
(66, 'Javat00', 'Solomillo a la pimienta', 'Carnes', 0, 'pictures/3295c76acbf4caaed33c36b1b5fc2cb1.jpeg', 'recipes/66_ingredients.txt', 'recipes/66_preparation.txt'),
(67, 'Javat00', 'Pan de ajo', 'Aperitivos', 0, 'pictures/735b90b4568125ed6c3f678819b6e058.jpeg', 'recipes/67_ingredients.txt', 'recipes/67_preparation.txt'),
(68, 'Javat00', 'Ensalada César', 'Ensaladas', 1, 'pictures/a3f390d88e4c41f2747bfa2f1b5f87db.jpeg', 'recipes/68_ingredients.txt', 'recipes/68_preparation.txt'),
(69, 'Kaarel', 'Salmón al horno', 'Pescados', 1, 'pictures/14bfa6bb14875e45bba028a21ed38046.jpeg', 'recipes/69_ingredients.txt', 'recipes/69_preparation.txt'),
(71, 'Kaarel', 'Sopa de cebolla', 'Sopas', 1, 'pictures/e2c420d928d4bf8ce0ff2ec19b371514.jpeg', 'recipes/71_ingredients.txt', 'recipes/71_preparation.txt'),
(76, 'Menkord', 'Tortilla de patatas vegana', 'Vegano', 0, 'pictures/fbd7939d674997cdb4692d34de8633c4.jpeg', 'recipes/76_ingredients.txt', 'recipes/76_preparation.txt'),
(77, 'Menkord', 'Mantequilla de anacardos', 'Vegano', 1, 'pictures/28dd2c7955ce926456240b2ff0100bde.jpeg', 'recipes/77_ingredients.txt', 'recipes/77_preparation.txt'),
(78, 'Menkord', 'Bowl vegetariano', 'Vegetariano', 0, 'pictures/35f4a8d465e6e1edc05f3d8ab658c551.jpeg', 'recipes/78_ingredients.txt', 'recipes/78_preparation.txt'),
(79, 'Celx2', 'Risotto de setas', 'Arroces', 0, 'pictures/d1fe173d08e959397adf34b1d77e88d7.jpeg', 'recipes/79_ingredients.txt', 'recipes/79_preparation.txt'),
(80, 'Menkord', 'Salsa verde', 'Salsas', 1, 'pictures/f033ab37c30201f73f142449d037028d.jpeg', 'recipes/80_ingredients.txt', 'recipes/80_preparation.txt'),
(81, 'Celx2', 'Ratatouille', 'Vegano', 3, 'pictures/43ec517d68b6edd3015b3edc9a11367b.jpeg', 'recipes/81_ingredients.txt', 'recipes/81_preparation.txt');

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
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
