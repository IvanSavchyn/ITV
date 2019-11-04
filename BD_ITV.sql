-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2019 a las 18:57:13
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `itv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bahias`
--

CREATE TABLE `bahias` (
  `idBahia` varchar(5) NOT NULL,
  `idParqueadero` varchar(5) DEFAULT NULL,
  `disponible` enum('true','false') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bahias`
--

INSERT INTO `bahias` (`idBahia`, `idParqueadero`, `disponible`) VALUES
('1', '2', 'true'),
('2', '1', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPago` int(11) NOT NULL,
  `idBahia` varchar(5) DEFAULT NULL,
  `idVehiculo` varchar(10) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `costo` decimal(6,2) NOT NULL,
  `archivo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPago`, `idBahia`, `idVehiculo`, `hora`, `fecha`, `costo`, `archivo`) VALUES
(1, '1', '1872HWN', '22:10:00', '2019-10-11', '25.03', 'ITV1872HWN.pdf'),
(2, NULL, '1234QQQ', '15:00:00', '2019-10-15', '26.00', NULL),
(3, NULL, '1111QQE', '19:22:00', '2019-11-04', '35.20', ''),
(4, '1', '1897HJH', '19:52:00', '2019-11-04', '25.00', 'ITV1897HJH.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueaderos`
--

CREATE TABLE `parqueaderos` (
  `idParqueadero` varchar(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `ubicacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parqueaderos`
--

INSERT INTO `parqueaderos` (`idParqueadero`, `nombre`, `ubicacion`) VALUES
('1', 'nomb1', 'Getafe'),
('2', 'parq2', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `aceptado` enum('true','false','admin') NOT NULL,
  `contrasenia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`dni`, `nombre`, `apellidos`, `email`, `telefono`, `direccion`, `aceptado`, `contrasenia`) VALUES
('111111111', '111111111', '111111111', '111111111', '111111111', '111111111', 'true', '111111111'),
('123456789', '123456789', '123456789', '123456789', '123456789', '123456789', 'true', '123456789'),
('222222222', '222222222', '222222222', '222222222', '222222222', '222222222', 'true', '222222222'),
('333333333', '333333333', '333333333', '333333333', '333333333', '333333333', 'true', '333333333'),
('987654321', 'Admin', 'Apellido', 'isavchyn@mail.ua', '123456789', 'getafe', 'admin', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `Tipo` varchar(7) NOT NULL,
  `costo` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`Tipo`, `costo`) VALUES
('privado', '25.00'),
('publico', '35.20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `matricula` varchar(10) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `aceptado` enum('true','false') NOT NULL,
  `idPersona` varchar(9) DEFAULT NULL,
  `idTipo` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`matricula`, `marca`, `aceptado`, `idPersona`, `idTipo`) VALUES
('1111QQE', 'Mercedes', 'true', '123456789', 'publico'),
('1234NHJ', 'Volvo', 'false', '222222222', 'privado'),
('1234QQQ', 'Volvo', 'true', '111111111', 'publico'),
('1478HYU', 'Volvo', 'false', '222222222', 'publico'),
('1872HWN', 'SEAT', 'true', '123456789', 'privado'),
('1897HJH', 'Seat', 'true', '123456789', 'privado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bahias`
--
ALTER TABLE `bahias`
  ADD PRIMARY KEY (`idBahia`),
  ADD KEY `idParqueadero` (`idParqueadero`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idBahia` (`idBahia`),
  ADD KEY `idVehiculo` (`idVehiculo`);

--
-- Indices de la tabla `parqueaderos`
--
ALTER TABLE `parqueaderos`
  ADD PRIMARY KEY (`idParqueadero`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`Tipo`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idTipo` (`idTipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bahias`
--
ALTER TABLE `bahias`
  ADD CONSTRAINT `bahias_ibfk_1` FOREIGN KEY (`idParqueadero`) REFERENCES `parqueaderos` (`idParqueadero`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idBahia`) REFERENCES `bahias` (`idBahia`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`matricula`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tarifas` (`Tipo`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
