-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2021 a las 17:45:30
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

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
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `ID` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Nombre` text DEFAULT NULL,
  `Categoría` text DEFAULT NULL,
  `Me_gusta` int(11) NOT NULL DEFAULT 0,
  `Imagen` varchar(255) DEFAULT NULL,
  `Ingredientes` varchar(255) DEFAULT NULL,
  `Preparación` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`ID`, `Usuario`, `Nombre`, `Categoría`, `Me_gusta`, `Imagen`, `Ingredientes`, `Preparación`) VALUES
(64, 'Celx2', 'Spaghetti a la boloñesa', 'Pastas', 0, 'pictures/ea5d2f1c4608232e07d3aa3d998e5135.jpeg', 'recipes/64_ingredients.txt', 'recipes/64_preparation.txt'),
(65, 'Celx2', 'Galletas de avena y chocolate', 'Desayunos', 0, 'pictures/fc490ca45c00b1249bbe3554a4fdf6fb.jpeg', 'recipes/65_ingredients.txt', 'recipes/65_preparation.txt'),
(66, 'Javat00', 'Solomillo a la pimienta', 'Carnes', 0, 'pictures/3295c76acbf4caaed33c36b1b5fc2cb1.jpeg', 'recipes/66_ingredients.txt', 'recipes/66_preparation.txt'),
(67, 'Javat00', 'Pan de ajo', 'Aperitivos', 0, 'pictures/735b90b4568125ed6c3f678819b6e058.jpeg', 'recipes/67_ingredients.txt', 'recipes/67_preparation.txt'),
(68, 'Javat00', 'Ensalada César', 'Ensaladas', 0, 'pictures/a3f390d88e4c41f2747bfa2f1b5f87db.jpeg', 'recipes/68_ingredients.txt', 'recipes/68_preparation.txt'),
(69, 'Kaarel', 'Salmón al horno', 'Pescados', 0, 'pictures/14bfa6bb14875e45bba028a21ed38046.jpeg', 'recipes/69_ingredients.txt', 'recipes/69_preparation.txt'),
(71, 'Kaarel', 'Sopa de cebolla', 'Sopas', 0, 'pictures/e2c420d928d4bf8ce0ff2ec19b371514.jpeg', 'recipes/71_ingredients.txt', 'recipes/71_preparation.txt'),
(72, 'Javat00', 'Arroz con leche', 'Postres', 0, 'pictures/32bb90e8976aab5298d5da10fe66f21d.jpeg', 'recipes/72_ingredients.txt', 'recipes/72_preparation.txt'),
(74, 'Javat00', 'Batido de frutos rojos', 'Desayunos', 0, 'pictures/ad61ab143223efbc24c7d2583be69251.jpeg', 'recipes/74_ingredients.txt', 'recipes/74_preparation.txt'),
(76, 'Menkord', 'Tortilla de patatas vegana', 'Vegano', 0, 'pictures/fbd7939d674997cdb4692d34de8633c4.jpeg', 'recipes/76_ingredients.txt', 'recipes/76_preparation.txt'),
(77, 'Menkord', 'Mantequilla de anacardos', 'Vegano', 0, 'pictures/28dd2c7955ce926456240b2ff0100bde.jpeg', 'recipes/77_ingredients.txt', 'recipes/77_preparation.txt'),
(78, 'Menkord', 'Bowl vegetariano', 'Vegetariano', 0, 'pictures/35f4a8d465e6e1edc05f3d8ab658c551.jpeg', 'recipes/78_ingredients.txt', 'recipes/78_preparation.txt'),
(79, 'Celx2', 'Risotto de setas', 'Arroces', 0, 'pictures/d1fe173d08e959397adf34b1d77e88d7.jpeg', 'recipes/79_ingredients.txt', 'recipes/79_preparation.txt'),
(80, 'Menkord', 'Salsa verde', 'Salsas', 0, 'pictures/f033ab37c30201f73f142449d037028d.jpeg', 'recipes/80_ingredients.txt', 'recipes/80_preparation.txt'),
(81, 'Celx2', 'Ratatouille', 'Vegano', 1, 'pictures/43ec517d68b6edd3015b3edc9a11367b.jpeg', 'recipes/81_ingredients.txt', 'recipes/81_preparation.txt');

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
