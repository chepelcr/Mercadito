-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2022 a las 00:37:19
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercadito_seguridad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_accion` int(11) NOT NULL,
  `nombre_accion` int(11) NOT NULL,
  `fecha_creacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `id_fila` int(11) NOT NULL,
  `tabla` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `accion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `auditorias_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `auditorias_view` (
`id_auditoria` int(11)
,`id_fila` int(11)
,`tabla` varchar(100)
,`accion` varchar(100)
,`id_usuario` int(11)
,`nombre_usuario` varchar(100)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrasenia_usuarios`
--

CREATE TABLE `contrasenia_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_contrasenia` int(11) NOT NULL,
  `contrasenia` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `intentos_fallidos` int(11) NOT NULL DEFAULT 0,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_bloqueo` datetime NOT NULL,
  `fecha_desbloqueo` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_expiracion` datetime NOT NULL,
  `fecha_eliminacion` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `contrasenia_usuarios`
--

INSERT INTO `contrasenia_usuarios` (`id_usuario`, `id_contrasenia`, `contrasenia`, `intentos_fallidos`, `bloqueado`, `fecha_bloqueo`, `fecha_desbloqueo`, `fecha_creacion`, `fecha_modificacion`, `fecha_expiracion`, `fecha_eliminacion`, `estado`) VALUES
(1, 1, 'oKWcpw==', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-11-13 15:33:30', '2021-12-02 17:43:10', '2021-12-03 00:43:10', '0000-00-00 00:00:00', 1),
(2, 2, '0tvZ1uaVppiQ', 0, 0, '2021-12-03 00:24:18', '2021-12-03 00:25:18', '2021-11-15 11:13:27', '2021-12-02 17:34:09', '2022-12-03 00:34:09', '0000-00-00 00:00:00', 1),
(3, 3, '09zY5uHO3JOP', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-11-17 15:57:27', '2021-11-17 16:03:08', '2022-11-17 23:03:08', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `error`
--

CREATE TABLE `error` (
  `id_error` int(11) NOT NULL,
  `sentencia` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `controlador` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` tinyint(1) NOT NULL,
  `nombre_modulo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre_modulo`, `fecha_creacion`) VALUES
(1, 'sucursal', '2021-11-24 22:52:51'),
(2, 'empresa', '2021-11-24 22:52:51'),
(3, 'seguridad', '2021-11-24 22:52:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_submodulos`
--

CREATE TABLE `modulos_submodulos` (
  `id_modulo` int(11) NOT NULL,
  `id_submodulo` int(11) NOT NULL,
  `nombre_submodulo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `modulos_submodulos`
--

INSERT INTO `modulos_submodulos` (`id_modulo`, `id_submodulo`, `nombre_submodulo`, `fecha_creacion`) VALUES
(1, 1, 'facturacion', '2021-11-25 05:57:14'),
(1, 2, 'inventario', '2021-11-25 05:57:14'),
(1, 3, 'caja', '2021-11-25 05:57:14'),
(2, 1, 'clientes', '2021-11-25 05:59:25'),
(2, 2, 'productos', '2021-11-25 05:59:25'),
(2, 3, 'sucursales', '2021-11-25 05:59:25'),
(2, 4, 'informacion', '2021-11-25 05:59:25'),
(3, 1, 'usuarios', '2021-11-25 06:00:52'),
(3, 2, 'roles', '2021-11-25 06:00:52'),
(3, 3, 'auditorias', '2021-11-25 06:00:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulos_acciones`
--

CREATE TABLE `submodulos_acciones` (
  `id_modulo` int(11) NOT NULL,
  `id_submodulo` int(11) NOT NULL,
  `id_accion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `submodulos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `submodulos_view` (
`id_modulo` int(11)
,`nombre_modulo` varchar(100)
,`id_submodulo` int(11)
,`nombre_submodulo` varchar(100)
,`fecha_creacion` datetime
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_identificacion` varchar(1) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula_usuario` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_nacionalidad` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL DEFAULT 1,
  `id_ubicacion` int(11) NOT NULL,
  `otras_senias` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_eliminacion` datetime DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `tipo_identificacion`, `cedula_usuario`, `sexo`, `correo`, `telefono`, `id_nacionalidad`, `id_rol`, `id_ubicacion`, `otras_senias`, `fecha_nacimiento`, `fecha_registro`, `fecha_actualizacion`, `fecha_eliminacion`, `estado`) VALUES
(1, 'Johnny ', 'Campos', 'N', '01-0743-0845', 'M', 'johnny.campos@gmail.com', '8708 7970', 52, 1, 1, '', '1997-01-03', '2021-11-13 15:33:30', '2021-11-13 15:33:30', '2021-12-03 00:42:06', 0),
(2, 'Jose Pablo', 'Campos Solano', 'N', '01-1664-0506', 'M', 'chepelcr70@gmail.com', '7039 1069', 52, 1, 4907, 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', '1997-01-03', '2021-11-15 11:13:27', '2021-11-15 11:13:27', NULL, 1),
(3, 'Vilma', 'Corella Artavia', 'N', '102440077', 'F', 'vilmacorella@yahoo.com', '89890512', 52, 2, 4907, 'De la escuela Mora y Cañas, 150M sur y 75M oeste. Casa blanca con portón gris.', '1935-12-20', '2021-11-17 15:57:27', '2021-11-17 15:57:27', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura para la vista `auditorias_view`
--
DROP TABLE IF EXISTS `auditorias_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `auditorias_view`  AS SELECT `a`.`id_auditoria` AS `id_auditoria`, `a`.`id_fila` AS `id_fila`, `a`.`tabla` AS `tabla`, `a`.`accion` AS `accion`, `a`.`id_usuario` AS `id_usuario`, `u`.`nombre` AS `nombre_usuario`, `a`.`created_at` AS `created_at` FROM (`auditoria` `a` join `usuarios` `u` on(`a`.`id_usuario` = `u`.`id_usuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `submodulos_view`
--
DROP TABLE IF EXISTS `submodulos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `submodulos_view`  AS SELECT `s`.`id_modulo` AS `id_modulo`, `m`.`nombre_modulo` AS `nombre_modulo`, `s`.`id_submodulo` AS `id_submodulo`, `s`.`nombre_submodulo` AS `nombre_submodulo`, `s`.`fecha_creacion` AS `fecha_creacion` FROM (`modulos_submodulos` `s` join `modulos` `m` on(`s`.`id_modulo` = `m`.`id_modulo`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`);

--
-- Indices de la tabla `contrasenia_usuarios`
--
ALTER TABLE `contrasenia_usuarios`
  ADD PRIMARY KEY (`id_contrasenia`);

--
-- Indices de la tabla `error`
--
ALTER TABLE `error`
  ADD PRIMARY KEY (`id_error`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `modulos_submodulos`
--
ALTER TABLE `modulos_submodulos`
  ADD PRIMARY KEY (`id_modulo`,`id_submodulo`);

--
-- Indices de la tabla `submodulos_acciones`
--
ALTER TABLE `submodulos_acciones`
  ADD PRIMARY KEY (`id_modulo`,`id_submodulo`,`id_accion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `error`
--
ALTER TABLE `error`
  MODIFY `id_error` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
