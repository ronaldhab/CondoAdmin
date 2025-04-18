-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2025 a las 02:11:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_condominios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_apartamentos`
--

CREATE TABLE `t_apartamentos` (
  `Nro_apartamento` varchar(50) NOT NULL,
  `Id_propiedad` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_apartamentos`
--

INSERT INTO `t_apartamentos` (`Nro_apartamento`, `Id_propiedad`) VALUES
('Tan-1', 1),
('Tan-2', 1),
('Tan-3', 1),
('Tan-4', 1),
('Tan-5', 1),
('Edg-1', 2),
('Edg-2', 2),
('Edg-3', 2),
('Edg-4', 2),
('Edg-5', 2),
('Can-1', 3),
('Can-2', 3),
('Can-3', 3),
('Can-4', 3),
('Can-5', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cobranzas`
--

CREATE TABLE `t_cobranzas` (
  `Id_cobranza` int(50) NOT NULL,
  `Nro_apartamento` varchar(50) NOT NULL,
  `Id_residente` int(50) NOT NULL,
  `Pagos` enum('Pagado','Deuda') NOT NULL,
  `Meses` enum('Abril','Mayo','Junio','Julio','Agosto') NOT NULL,
  `Fechas` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_cobranzas`
--

INSERT INTO `t_cobranzas` (`Id_cobranza`, `Nro_apartamento`, `Id_residente`, `Pagos`, `Meses`, `Fechas`) VALUES
(4, 'Tan-1', 19, 'Pagado', 'Abril', '2025-04-15'),
(5, 'Tan-2', 20, 'Deuda', 'Abril', '2025-04-15'),
(6, 'Tan-3', 27, 'Pagado', 'Abril', '2025-04-15'),
(7, 'Tan-4', 32, 'Deuda', 'Abril', '2025-04-15'),
(8, 'Tan-5', 24, 'Pagado', 'Abril', '2025-04-15'),
(9, 'Edg-1', 28, 'Pagado', 'Abril', '2025-04-15'),
(10, 'Edg-2', 33, 'Deuda', 'Abril', '2025-04-15'),
(11, 'Edg-3', 22, 'Pagado', 'Abril', '2025-04-15'),
(12, 'Edg-4', 25, 'Deuda', 'Abril', '2025-04-15'),
(13, 'Edg-5', 29, 'Pagado', 'Abril', '2025-04-15'),
(14, 'Can-1', 21, 'Pagado', 'Abril', '2025-04-15'),
(15, 'Can-2', 26, 'Deuda', 'Abril', '2025-04-15'),
(16, 'Can-3', 23, 'Deuda', 'Abril', '2025-04-15'),
(17, 'Can-4', 31, 'Pagado', 'Abril', '2025-04-15'),
(18, 'Can-5', 30, 'Pagado', 'Abril', '2025-04-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_propiedades`
--

CREATE TABLE `t_propiedades` (
  `Id_propiedad` int(50) NOT NULL,
  `Nom_propiedad` varchar(50) NOT NULL,
  `Direccion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_propiedades`
--

INSERT INTO `t_propiedades` (`Id_propiedad`, `Nom_propiedad`, `Direccion`) VALUES
(1, 'Tanglewood', 'Calle 8, El valle'),
(2, 'Edgefield', 'Av. Libertador'),
(3, 'Canaima', 'Av. Casanova');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_residentes`
--

CREATE TABLE `t_residentes` (
  `Id_residente` int(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Cedula` int(50) NOT NULL,
  `Telefono` bigint(50) NOT NULL,
  `Tipo_res` enum('Alquiler','Propietario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_residentes`
--

INSERT INTO `t_residentes` (`Id_residente`, `Nombre`, `Cedula`, `Telefono`, `Tipo_res`) VALUES
(19, 'Samuel Herrera', 28149479, 4242822770, 'Propietario'),
(20, 'Ronald Herrera', 28000000, 4122532854, 'Alquiler'),
(21, 'Eduardo Osorio', 28111111, 4168852469, 'Propietario'),
(22, 'Juan Castillo', 28222222, 1465871577, 'Alquiler'),
(23, 'Alexander Escalante', 28333333, 4248956321, 'Alquiler'),
(24, 'Luis Piña', 28444444, 4168752365, 'Propietario'),
(25, 'Jermaine Vargas', 28555555, 4147535248, 'Alquiler'),
(26, 'Andres Martinez', 28666666, 4146532659, 'Propietario'),
(27, 'Pedro Perez', 28777777, 4148574369, 'Alquiler'),
(28, 'Leonardo Barcenas', 28888888, 4167945621, 'Propietario'),
(29, 'Eduardo Wacher', 28999999, 4249764852, 'Propietario'),
(30, 'Adrian Carvallo', 29000000, 4125497635, 'Alquiler'),
(31, 'Alejandro Hernandez', 29111111, 4128465279, 'Propietario'),
(32, 'Maria Niño', 29222222, 4124615387, 'Alquiler'),
(33, 'Katherine Gonzalez', 29333333, 4163216798, 'Propietario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `nombre_usuario`, `contrasena`) VALUES
(4, 'Sam', '$2y$10$5ecn9k1yVBgEfkj6htme8OYAzwl9fAwgY3iWCAlHjTmnPzI0uy3oS'),
(5, 'Ronald', '$2y$10$8Hmqbu9mob2CxCB2L5KtNuCFmshB4GcUMDiJnN7lg4mfOeOwu0ANi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_apartamentos`
--
ALTER TABLE `t_apartamentos`
  ADD PRIMARY KEY (`Nro_apartamento`),
  ADD KEY `Id_propiedad` (`Id_propiedad`);

--
-- Indices de la tabla `t_cobranzas`
--
ALTER TABLE `t_cobranzas`
  ADD PRIMARY KEY (`Id_cobranza`),
  ADD KEY `Id_residente` (`Id_residente`),
  ADD KEY `Nro_apartamento` (`Nro_apartamento`);

--
-- Indices de la tabla `t_propiedades`
--
ALTER TABLE `t_propiedades`
  ADD PRIMARY KEY (`Id_propiedad`);

--
-- Indices de la tabla `t_residentes`
--
ALTER TABLE `t_residentes`
  ADD PRIMARY KEY (`Id_residente`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_cobranzas`
--
ALTER TABLE `t_cobranzas`
  MODIFY `Id_cobranza` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `t_propiedades`
--
ALTER TABLE `t_propiedades`
  MODIFY `Id_propiedad` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_residentes`
--
ALTER TABLE `t_residentes`
  MODIFY `Id_residente` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_apartamentos`
--
ALTER TABLE `t_apartamentos`
  ADD CONSTRAINT `t_apartamentos_ibfk_1` FOREIGN KEY (`Id_propiedad`) REFERENCES `t_propiedades` (`Id_propiedad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_cobranzas`
--
ALTER TABLE `t_cobranzas`
  ADD CONSTRAINT `t_cobranzas_ibfk_3` FOREIGN KEY (`Id_residente`) REFERENCES `t_residentes` (`Id_residente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_cobranzas_ibfk_4` FOREIGN KEY (`Nro_apartamento`) REFERENCES `t_apartamentos` (`Nro_apartamento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
