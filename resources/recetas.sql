-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2021 a las 13:55:07
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
(1, 'Kaarel', 'Arroz con pollo', 'Fitness', 2, 'Futura ruta', 'bla bla', '3'),
(2, 'Menkord', 'Galletas con chocolate', 'Snacks', 57, 'Futura ruta', 'bla bla', '4'),
(3, 'Celx2', 'Fajitas de ternera', 'Picante', 224, 'Futura ruta', '500gr ternera bla bla', '1'),
(4, 'Javat00', 'Ternera de Pizza', 'Italiana', 15, 'pictures/d41d8cd98f00b204e9800998ecf8427e.jpeg', '4', '5'),
(49, 'Javat00', 'Gazpacho', 'Fitness', 10, 'pictures/f457c545a9ded88f18ecee47145a72c0.jpeg', 'resources/49_ingredients.txt', 'resources/49_preparation.txt'),
(54, 'Javat00', 'canelones en salsa de buey', 'Italiana', 0, 'pictures/a684eceee76fc522773286a895bc8436.jpeg', 'resources/54_ingredients.txt', 'resources/54_preparation.txt'),
(55, 'Javat00', 'script', 'Fitness', 0, 'pictures/b53b3a3d6ab90ce0268229151c9bde11.jpeg', 'resources/55_ingredients.txt', 'resources/55_preparation.txt'),
(56, 'Javat00', 'drop table recetas', 'Fitness', 0, 'pictures/9f61408e3afb633e50cdf1b20de6f466.jpeg', 'resources/56_ingredients.txt', 'resources/56_preparation.txt'),
(60, 'Javat00', 'papas fritas fit', 'Fitness', 0, 'pictures/072b030ba126b2f4b2374f342be9ed44.jpeg', 'resources/60_ingredients.txt', 'resources/60_preparation.txt'),
(62, 'Javat00', 'Pepsi', 'Bebidas', 0, 'pictures/44f683a84163b3523afe57c2e008bc8c.jpeg', 'resources/62_ingredients.txt', 'resources/62_preparation.txt');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
