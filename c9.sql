-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2016 a las 16:27:30
-- Versión del servidor: 5.5.53-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c9`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(64) NOT NULL,
  `Password` varchar(64) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Admin`
--

INSERT INTO `Admin` (`Id`, `Nombre`, `Password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calendario`
--

CREATE TABLE IF NOT EXISTS `Calendario` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dia` varchar(32) NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `DuracionCita` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Calendario`
--

INSERT INTO `Calendario` (`Id`, `Dia`, `HoraInicio`, `HoraFin`, `DuracionCita`) VALUES
(1, '1', '09:00:00', '14:00:00', 15),
(2, '1', '16:00:00', '20:00:00', 15),
(3, '4', '09:00:00', '14:00:00', 15),
(4, '5', '09:00:00', '14:00:00', 15),
(5, '4', '16:00:00', '20:00:00', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cita`
--

CREATE TABLE IF NOT EXISTS `Cita` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Paciente` int(11) NOT NULL,
  `Especialidad` int(11) NOT NULL,
  `FechaIni` datetime NOT NULL,
  `FechaFin` datetime DEFAULT NULL,
  `Consulta` int(11) DEFAULT NULL,
  `Especialista` int(11) DEFAULT NULL,
  `Informe` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Paciente` (`Paciente`),
  KEY `TipoEspecialidad` (`Especialidad`),
  KEY `Especialista` (`Especialista`),
  KEY `Informe` (`Informe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `Cita`
--

INSERT INTO `Cita` (`Id`, `Paciente`, `Especialidad`, `FechaIni`, `FechaFin`, `Consulta`, `Especialista`, `Informe`) VALUES
(32, 40, 5, '2016-12-22 09:00:00', '2016-12-22 09:15:00', NULL, 1, 13),
(33, 40, 1, '2016-12-22 09:00:00', '2016-12-22 09:15:00', NULL, NULL, NULL),
(34, 20, 3, '2016-12-22 09:15:00', '2016-12-22 09:30:00', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DatosClinicos`
--

CREATE TABLE IF NOT EXISTS `DatosClinicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Paciente` int(11) NOT NULL,
  `GrupoSanguineo` varchar(8) DEFAULT NULL,
  `Alergias` varchar(1024) DEFAULT NULL,
  `Tratamiento` varchar(1024) DEFAULT NULL,
  `Comentarios` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Paciente` (`Paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Especialista`
--

CREATE TABLE IF NOT EXISTS `Especialista` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dni` varchar(9) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Apellido1` varchar(128) NOT NULL,
  `Apellido2` varchar(128) DEFAULT NULL,
  `Especialidad` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Dni` (`Dni`),
  KEY `Especialidad` (`Especialidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `Especialista`
--

INSERT INTO `Especialista` (`Id`, `Dni`, `Password`, `Nombre`, `Apellido1`, `Apellido2`, `Especialidad`) VALUES
(1, '111111111', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Pepe', 'Garcia', 'Rodríguez', 1),
(10, '12345678A', 'a1305ca10f94f2340770c73e26d427588f236709', 'NombreEspecialista', 'Apellido1Especialista', 'Apellidos2Especialista', 1),
(11, '12345678j', '94d95ac4b15b3f446726d99290614fb3bb7e0109', 'paquito', 'Reyes', 'Alba', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Informe`
--

CREATE TABLE IF NOT EXISTS `Informe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(1024) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `Informe`
--

INSERT INTO `Informe` (`Id`, `Descripcion`) VALUES
(13, 'informe del paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paciente`
--

CREATE TABLE IF NOT EXISTS `Paciente` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dni` varchar(9) NOT NULL,
  `Nombre` varchar(128) NOT NULL,
  `Apellido1` varchar(128) NOT NULL,
  `Apellido2` varchar(128) DEFAULT NULL,
  `Telefono` int(24) DEFAULT NULL,
  `Direccion` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Dni` (`Dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `Paciente`
--

INSERT INTO `Paciente` (`Id`, `Dni`, `Nombre`, `Apellido1`, `Apellido2`, `Telefono`, `Direccion`) VALUES
(1, '000000000', 'shurmanio', 'botecrite', 'grijando', 1234, 'direccion0'),
(20, '123446789', 'Adrián', 'Reyes Alba', 'Reyes Alba', 647243014, 'C/Mandarina Bloque 1 Puerta 1A'),
(40, '11111111j', 'pepe', 'reyes', 'gonzalez', 651245148, 'larga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoEspecialidad`
--

CREATE TABLE IF NOT EXISTS `TipoEspecialidad` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(64) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `TipoEspecialidad`
--

INSERT INTO `TipoEspecialidad` (`Id`, `Nombre`) VALUES
(1, 'Traumatología'),
(2, 'Urología'),
(3, 'Otorrinolaringología'),
(4, 'Dermatología'),
(5, 'Pediatría');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Cita`
--
ALTER TABLE `Cita`
  ADD CONSTRAINT `Especialista` FOREIGN KEY (`Especialista`) REFERENCES `Especialista` (`Id`),
  ADD CONSTRAINT `Informe` FOREIGN KEY (`Informe`) REFERENCES `Informe` (`Id`),
  ADD CONSTRAINT `Pacientes` FOREIGN KEY (`Paciente`) REFERENCES `Paciente` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TipoEspecialidad` FOREIGN KEY (`Especialidad`) REFERENCES `TipoEspecialidad` (`Id`);

--
-- Filtros para la tabla `DatosClinicos`
--
ALTER TABLE `DatosClinicos`
  ADD CONSTRAINT `Paciente` FOREIGN KEY (`Paciente`) REFERENCES `Paciente` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Especialista`
--
ALTER TABLE `Especialista`
  ADD CONSTRAINT `Especialista_ibfk_1` FOREIGN KEY (`Especialidad`) REFERENCES `TipoEspecialidad` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
