-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2017 a las 13:50:05
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gym`
--
CREATE DATABASE IF NOT EXISTS `gym` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gym`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE `actividad` (
  `idActividad` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `tipo`, `descripcion`, `lugar`, `nombre`) VALUES
(1, 'CompeticiÃ³n', '    Aprende a jugar al baloncesto con tus amigos    ', 'Pista central pabellon', 'BALONCESTO'),
(3, 'Competicion', 'Aprende a jugar al tenis con tus amigos', 'Pista exterior', 'TENIS'),
(4, 'Deportiva', ' Juega con tus amigos y disfruta ', 'Pista atletismo', 'FÃºtbol 7'),
(5, 'Deportiva', 'Ven a jugar al futbol sala y conviertete en un gran profesional', 'Pista interior', 'FutSal'),
(6, 'Muscular', 'jajajaaj', 'aaaa', 'BalonxD'),
(7, 'Deportiva', 'Spining con dinosaurios', 'Sala de bicicletas', 'SPINOSAURIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comenta_ejercicio`
--

DROP TABLE IF EXISTS `comenta_ejercicio`;
CREATE TABLE `comenta_ejercicio` (
  `Ejercicio_idEjercicio` int(11) NOT NULL,
  `comentario` varchar(140) DEFAULT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  `contador` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comenta_ejercicio`
--

INSERT INTO `comenta_ejercicio` (`Ejercicio_idEjercicio`, `comentario`, `Usuario_DNI`, `contador`) VALUES
(1, '', '12345678J', 1),
(1, 'Biceps tonificandose', '3', 30),
(2, '', '12345678J', 1),
(2, '', '3', 23),
(3, '', '3', 2),
(4, '', '3', 2),
(5, '', '3', 13),
(6, '', '3', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportista_hace_actividad`
--

DROP TABLE IF EXISTS `deportista_hace_actividad`;
CREATE TABLE `deportista_hace_actividad` (
  `Actividad_idActividad` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deportista_hace_actividad`
--

INSERT INTO `deportista_hace_actividad` (`Actividad_idActividad`, `Usuario_DNI`) VALUES
(1, '12345678T'),
(1, '3'),
(3, '3'),
(4, '3'),
(5, '3'),
(6, '3'),
(7, '12345678T'),
(7, '12345678Z'),
(7, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportista_inscrito`
--

DROP TABLE IF EXISTS `deportista_inscrito`;
CREATE TABLE `deportista_inscrito` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportista_sesion`
--

DROP TABLE IF EXISTS `deportista_sesion`;
CREATE TABLE `deportista_sesion` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Sesion_idSesion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deportista_sesion`
--

INSERT INTO `deportista_sesion` (`Usuario_DNI`, `Sesion_idSesion`) VALUES
('12345678T', 222341),
('3', 2),
('3', 3),
('3', 15),
('3', 222341),
('3', 222342);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportista_tiene_tabla`
--

DROP TABLE IF EXISTS `deportista_tiene_tabla`;
CREATE TABLE `deportista_tiene_tabla` (
  `Tabla_idTabla` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deportista_tiene_tabla`
--

INSERT INTO `deportista_tiene_tabla` (`Tabla_idTabla`, `Usuario_DNI`) VALUES
(1, '12345678J'),
(1, '3'),
(1, '44444444X'),
(2, '12345678J'),
(2, '3'),
(3, '12345678J'),
(3, '3'),
(100, '12345678O'),
(100, '1234578I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

DROP TABLE IF EXISTS `ejercicio`;
CREATE TABLE `ejercicio` (
  `idEjercicio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `tiempo` varchar(15) DEFAULT NULL,
  `peso` int(3) DEFAULT NULL,
  `repeticiones` varchar(25) DEFAULT NULL,
  `URLImagen` longblob,
  `contador` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`idEjercicio`, `nombre`, `descripcion`, `tipo`, `tiempo`, `peso`, `repeticiones`, `URLImagen`, `contador`) VALUES
(0, 'PiernasLargas', 'xxx', 'piernas', '', 10, '25f', 0x4d5257204920616d206120687970657261637469766520646f672064616e63696e6720746f20646973636f20456d696e656d206f662074686520736f6e67205368616b652054686174202d20496d6775722e676966, 0),
(1, 'Biceps- Flexiones concent', 'La de la imagen', 'brazos', '2 minutos', 4, '', 0x6272617a6f73312e676966, 0),
(2, 'Triceps: Flexiones a un b', 'Triceps:Flexiones a un ', 'pecho', '', 0, '', 0x6272617a6f73322e676966, 0),
(3, 'Cinta', 'Correr', 'resistencia', '30 min', 0, '', 0x63696e74612e676966, 0),
(4, 'Dominadas', 'dadsa', 'espalda', '20min', 0, '', 0x657370616c6461322e676966, 0),
(5, 'piernas hacia atras', 'dsfsdf', 'piernas', '', 32, '15-15-15-15', 0x706965726e61342e676966, 0),
(6, 'Polea tras nuca', 'sadada', 'espalda', '', 20, '12-12-10-8', 0x657370616c6461312e676966, 0),
(7, 'piernas arriba', 'dsfsdf', 'piernas', '', 80, '10-10-10-10', 0x706965726e61322e676966, 0),
(8, 'piernas hacia  adelante', 'adasdds', 'piernas', NULL, 1, '12', 0x706965726e61332e676966, 0),
(9, 'press banca 2', 'dsff', 'pecho', '', 20, '12-12-10-8', 0x706563686f322e676966, 0),
(10, 'sentadillas', 'sada', 'piernas', NULL, 8, '12-12-12-12', 0x706965726e61312e676966, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faltas_asistencia`
--

DROP TABLE IF EXISTS `faltas_asistencia`;
CREATE TABLE `faltas_asistencia` (
  `fecha` date DEFAULT NULL,
  `Sesion_idSesion` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Tabla_IDTabla` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `NEjercicios` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`Usuario_DNI`, `Tabla_IDTabla`, `Fecha`, `NEjercicios`) VALUES
('12345678J', 2, '2017-01-13 17:35:45', 2),
('3', 1, '2016-12-15 11:08:10', 1),
('3', 2, '2017-01-07 13:31:25', 2),
('3', 2, '2017-01-11 12:41:35', 1),
('3', 3, '2017-01-11 12:41:41', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

DROP TABLE IF EXISTS `sesion`;
CREATE TABLE `sesion` (
  `idSesion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT '00:00:00',
  `nPlazasMax` int(11) NOT NULL,
  `nPlazasActual` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`idSesion`, `fecha`, `hora`, `nPlazasMax`, `nPlazasActual`, `Usuario_DNI`, `Actividad_idActividad`) VALUES
(222341, '2017-01-07', '00:00:00', 10, 3, '2', 7),
(222342, '0002-02-02', '02:02:00', 1, 0, '2', 7),
(222347, '2017-01-19', '00:00:00', 3, 10, '2', 7),
(222348, '2017-01-06', '01:01:00', 3, 2, '2', 7),
(222349, '2017-01-12', '23:59:00', 5, 4, '2', 7),
(222350, '2017-01-25', '00:00:00', 3, 3, '12345678P', 7),
(222351, '2017-01-12', '23:59:00', 3, 3, '12345678P', 7),
(222352, '2017-01-12', '23:59:00', 999, 999, '12345678A', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla`
--

DROP TABLE IF EXISTS `tabla`;
CREATE TABLE `tabla` (
  `idTabla` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `instrucciones` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tabla`
--

INSERT INTO `tabla` (`idTabla`, `nombre`, `tipo`, `instrucciones`) VALUES
(1, 'Tabla 1', 'General', 'El cardio es muy bueno para ti'),
(2, 'Tabla 5', 'General', 'fdancdance'),
(3, 'Tabla 6', 'General', 'Corre mucho si puedes'),
(4, 'la X', 'General', 'bla bla'),
(100, 'bla2', 'PEF', 'asa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_tiene_ejercicio`
--

DROP TABLE IF EXISTS `tabla_tiene_ejercicio`;
CREATE TABLE `tabla_tiene_ejercicio` (
  `Ejercicio_idEjercicio` int(11) NOT NULL,
  `Tabla_idTabla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tabla_tiene_ejercicio`
--

INSERT INTO `tabla_tiene_ejercicio` (`Ejercicio_idEjercicio`, `Tabla_idTabla`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 3),
(4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `DNI` varchar(9) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `tipoDeportista` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`DNI`, `nombre`, `apellidos`, `email`, `password`, `tipo`, `tipoDeportista`) VALUES
('1', '1', '1', '1@1.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Administrador', ''),
('12345678A', 'Almudena', 'Oliveira Costas', 'almudena@gmail.com', '550e1bafe077ff0b0b67f4e32f29d751', 'Entrenador', ''),
('12345678J', 'Jose', 'Fernandez Perez', 'jose@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Deportista', 'TDU'),
('12345678M', 'Manuel', 'Lopez Perez', 'manuel@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Entrenador', NULL),
('12345678O', 'Oscar', 'perez', 'oscar@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Deportista', 'PEF'),
('12345678P', 'Pedro', 'Cuestas', 'pedro@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Entrenador', NULL),
('12345678T', 'Tristan', 'Frances', 'tristan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Deportista', 'TDU'),
('12345678W', 'Willy', 'Will', 'willi@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Entrenador', ''),
('12345678Z', 'Zorro', 'McNube', 'zorro@gmail.com', '12345678', 'Deportista', 'TDU'),
('2', '2', '2', '2dsaffsad', 'c81e728d9d4c2f636f067f89cc14862c', 'Entrenador', ''),
('3', '3', '3', '3@3.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Deportista', 'TDU'),
('44444444A', 'Alex', 'Carballo', 'alex@gmail.com', '534b44a19bf18d20b71ecc4eb77c572f', 'Entrenador', ''),
('44444444X', 'Xavier', 'Fernandez Vazquez', 'xavinavas@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Deportista', 'TDU'),
('44658606N', 'Gabriel', 'Garcia Perez', 'gabrielinhogp@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Administrador', ''),
('isma', 'isma', 'asas', 'jejeje', 'b65cb932ad941c2de600ff3c5c0c9a56', 'Administrador', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`idActividad`);

--
-- Indices de la tabla `comenta_ejercicio`
--
ALTER TABLE `comenta_ejercicio`
  ADD PRIMARY KEY (`Ejercicio_idEjercicio`,`Usuario_DNI`),
  ADD KEY `fk_Deportista_has_Ejercicio_Ejercicio1_idx` (`Ejercicio_idEjercicio`),
  ADD KEY `fk_Comenta_Ejercicio_Usuario1_idx` (`Usuario_DNI`);

--
-- Indices de la tabla `deportista_hace_actividad`
--
ALTER TABLE `deportista_hace_actividad`
  ADD PRIMARY KEY (`Actividad_idActividad`,`Usuario_DNI`),
  ADD KEY `fk_Actividad_has_Usuario_Usuario1_idx` (`Usuario_DNI`),
  ADD KEY `fk_Actividad_has_Usuario_Actividad1_idx` (`Actividad_idActividad`);

--
-- Indices de la tabla `deportista_inscrito`
--
ALTER TABLE `deportista_inscrito`
  ADD PRIMARY KEY (`Usuario_DNI`,`Actividad_idActividad`),
  ADD KEY `fk_Usuario_has_Actividad_Actividad1_idx` (`Actividad_idActividad`),
  ADD KEY `fk_Usuario_has_Actividad_Usuario1_idx` (`Usuario_DNI`);

--
-- Indices de la tabla `deportista_sesion`
--
ALTER TABLE `deportista_sesion`
  ADD PRIMARY KEY (`Usuario_DNI`,`Sesion_idSesion`),
  ADD KEY `fk_Usuario_has_Sesion_Sesion1_idx` (`Sesion_idSesion`),
  ADD KEY `fk_Usuario_has_Sesion_Usuario1_idx` (`Usuario_DNI`);

--
-- Indices de la tabla `deportista_tiene_tabla`
--
ALTER TABLE `deportista_tiene_tabla`
  ADD PRIMARY KEY (`Tabla_idTabla`,`Usuario_DNI`),
  ADD KEY `fk_Tabla_has_Usuario_Usuario1_idx` (`Usuario_DNI`),
  ADD KEY `fk_Tabla_has_Usuario_Tabla1_idx` (`Tabla_idTabla`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`idEjercicio`);

--
-- Indices de la tabla `faltas_asistencia`
--
ALTER TABLE `faltas_asistencia`
  ADD PRIMARY KEY (`Usuario_DNI`,`Sesion_idSesion`),
  ADD KEY `fk_Faltas_asistencia_Sesion1_idx` (`Sesion_idSesion`),
  ADD KEY `fk_Faltas_asistencia_Usuario1_idx` (`Usuario_DNI`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`Usuario_DNI`,`Tabla_IDTabla`,`Fecha`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`idSesion`),
  ADD KEY `fk_Sesion_Usuario1_idx` (`Usuario_DNI`),
  ADD KEY `fk_Sesion_Actividad1_idx` (`Actividad_idActividad`);

--
-- Indices de la tabla `tabla`
--
ALTER TABLE `tabla`
  ADD PRIMARY KEY (`idTabla`);

--
-- Indices de la tabla `tabla_tiene_ejercicio`
--
ALTER TABLE `tabla_tiene_ejercicio`
  ADD PRIMARY KEY (`Ejercicio_idEjercicio`,`Tabla_idTabla`),
  ADD KEY `fk_Ejercicio_has_Tabla_Tabla1_idx` (`Tabla_idTabla`),
  ADD KEY `fk_Ejercicio_has_Tabla_Ejercicio1_idx` (`Ejercicio_idEjercicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `idSesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222353;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
