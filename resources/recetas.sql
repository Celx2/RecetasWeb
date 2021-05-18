-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2021 a las 17:55:30
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
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `ID` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Nombre` text DEFAULT NULL,
  `Categoría` text DEFAULT NULL,
  `Me_gusta` int(11) DEFAULT 0,
  `Imagen` varchar(255) DEFAULT NULL,
  `Ingredientes` text DEFAULT NULL,
  `Preparación` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`ID`, `Usuario`, `Nombre`, `Categoría`, `Me gusta`, `Imagen`, `Ingredientes`, `Preparación`) VALUES
(3, 'Celx2', 'Fajitas de ternera', 'Picante', 0, 'Futura ruta', '500gr ternera bla bla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nunc arcu, ultrices id consectetur ornare, feugiat et metus. Donec porta sapien eu nisi euismod tempor. Aenean dapibus pretium dui quis cursus. Nullam commodo at nisi eget bibendum. Ut dapibus sapien et tortor commodo elementum. Suspendisse ultrices, ante ut rhoncus rhoncus, mi diam convallis tellus, ultricies finibus lectus lorem et erat. Integer porttitor non nibh sed vulputate. Nullam in pellentesque enim. Ut accumsan justo tellus. Vestibulum vel nibh purus. Duis faucibus nunc vel lacinia faucibus. Ut nibh sem, consequat eget nulla vel, iaculis mollis tortor. Vestibulum augue erat, egestas sed lobortis in, pellentesque et erat. Mauris a magna eu est hendrerit imperdiet non eu lorem.\r\n\r\nMauris eleifend in nunc eu fermentum. Nulla nec molestie diam. Etiam rutrum elit ut tortor tempus rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam quis rutrum leo. Aliquam erat volutpat. Nulla id dignissim sem, id ultrices nibh. Etiam ac ligula odio. Pellentesque consequat libero in faucibus congue. Curabitur quis lacus hendrerit, facilisis neque in, rhoncus lacus. Nam ut sapien felis.'),
(4, 'Javat00', 'Pizza', 'Italiana', 0, 'Futura ruta', 'masa bla bla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nunc arcu, ultrices id consectetur ornare, feugiat et metus. Donec porta sapien eu nisi euismod tempor. Aenean dapibus pretium dui quis cursus. Nullam commodo at nisi eget bibendum. Ut dapibus sapien et tortor commodo elementum. Suspendisse ultrices, ante ut rhoncus rhoncus, mi diam convallis tellus, ultricies finibus lectus lorem et erat. Integer porttitor non nibh sed vulputate. Nullam in pellentesque enim. Ut accumsan justo tellus. Vestibulum vel nibh purus. Duis faucibus nunc vel lacinia faucibus. Ut nibh sem, consequat eget nulla vel, iaculis mollis tortor. Vestibulum augue erat, egestas sed lobortis in, pellentesque et erat. Mauris a magna eu est hendrerit imperdiet non eu lorem.\r\n\r\nMauris eleifend in nunc eu fermentum. Nulla nec molestie diam. Etiam rutrum elit ut tortor tempus rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam quis rutrum leo. Aliquam erat volutpat. Nulla id dignissim sem, id ultrices nibh. Etiam ac ligula odio. Pellentesque consequat libero in faucibus congue. Curabitur quis lacus hendrerit, facilisis neque in, rhoncus lacus. Nam ut sapien felis.'),
(1, 'Kaarel', 'Arroz con pollo', 'Fitness', 0, 'Futura ruta', 'bla bla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nunc arcu, ultrices id consectetur ornare, feugiat et metus. Donec porta sapien eu nisi euismod tempor. Aenean dapibus pretium dui quis cursus. Nullam commodo at nisi eget bibendum. Ut dapibus sapien et tortor commodo elementum. Suspendisse ultrices, ante ut rhoncus rhoncus, mi diam convallis tellus, ultricies finibus lectus lorem et erat. Integer porttitor non nibh sed vulputate. Nullam in pellentesque enim. Ut accumsan justo tellus. Vestibulum vel nibh purus. Duis faucibus nunc vel lacinia faucibus. Ut nibh sem, consequat eget nulla vel, iaculis mollis tortor. Vestibulum augue erat, egestas sed lobortis in, pellentesque et erat. Mauris a magna eu est hendrerit imperdiet non eu lorem.\r\n\r\nMauris eleifend in nunc eu fermentum. Nulla nec molestie diam. Etiam rutrum elit ut tortor tempus rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam quis rutrum leo. Aliquam erat volutpat. Nulla id dignissim sem, id ultrices nibh. Etiam ac ligula odio. Pellentesque consequat libero in faucibus congue. Curabitur quis lacus hendrerit, facilisis neque in, rhoncus lacus. Nam ut sapien felis.'),
(2, 'Menkord', 'Galletas con chocolate', 'Snacks', 0, 'Futura ruta', 'bla bla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nunc arcu, ultrices id consectetur ornare, feugiat et metus. Donec porta sapien eu nisi euismod tempor. Aenean dapibus pretium dui quis cursus. Nullam commodo at nisi eget bibendum. Ut dapibus sapien et tortor commodo elementum. Suspendisse ultrices, ante ut rhoncus rhoncus, mi diam convallis tellus, ultricies finibus lectus lorem et erat. Integer porttitor non nibh sed vulputate. Nullam in pellentesque enim. Ut accumsan justo tellus. Vestibulum vel nibh purus. Duis faucibus nunc vel lacinia faucibus. Ut nibh sem, consequat eget nulla vel, iaculis mollis tortor. Vestibulum augue erat, egestas sed lobortis in, pellentesque et erat. Mauris a magna eu est hendrerit imperdiet non eu lorem.\r\n\r\nMauris eleifend in nunc eu fermentum. Nulla nec molestie diam. Etiam rutrum elit ut tortor tempus rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam quis rutrum leo. Aliquam erat volutpat. Nulla id dignissim sem, id ultrices nibh. Etiam ac ligula odio. Pellentesque consequat libero in faucibus congue. Curabitur quis lacus hendrerit, facilisis neque in, rhoncus lacus. Nam ut sapien felis.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`Usuario`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
