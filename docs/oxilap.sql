-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2022 a las 02:39:18
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `oxilap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido_paterno` varchar(45) DEFAULT NULL,
  `apellido_materno` varchar(45) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `expedido` enum('LP','PT','OR') DEFAULT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_direccion`
--

CREATE TABLE `cliente_direccion` (
  `id_cliente_direccion` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `departamento` enum('LA PAZ','ORURO','POTOSI') DEFAULT NULL,
  `provincia` varchar(45) DEFAULT NULL,
  `ciudad_localidad` varchar(45) DEFAULT NULL,
  `zona` varchar(100) DEFAULT NULL,
  `avenida_calle` varchar(100) DEFAULT NULL,
  `numero_puerta` varchar(10) DEFAULT NULL,
  `referencia_cercana` varchar(250) DEFAULT NULL,
  `latitud` int(11) DEFAULT NULL,
  `longitud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `url`, `icon`) VALUES
(1, 'Administrador', 'Administrator del Sistema', 'administrador', 'fas fa-user-cog \n'),
(2, 'Atencion Cliente', 'Persona encargada de atencion al Cliente', 'atencioncliente', 'fas fa-user-tie'),
(3, 'Distribuidor', 'Persona encargada de Distribuir los pedidos', 'docente', 'fas fa-money-check-alt \n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(9512, '::1', 'auth', 1654469602),
(9513, '::1', 'auth', 1654469615),
(9514, '::1', 'auth', 1654469620);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_entrega`
--

CREATE TABLE `nota_entrega` (
  `id_nota_entrega` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden_compra` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_cliente_direccion` int(11) NOT NULL,
  `tipo_emision` enum('FACTURA','RECIBO','NOTA REMISION') DEFAULT NULL,
  `fecha_orden_compra` date DEFAULT NULL,
  `factura_numero` int(11) DEFAULT NULL,
  `factura_nombre` varchar(45) DEFAULT NULL,
  `factura_nit` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra_detalle`
--

CREATE TABLE `orden_compra_detalle` (
  `id_orden_compra_detalle` int(11) NOT NULL,
  `id_orden_compra` int(11) NOT NULL,
  `id_precio` int(11) NOT NULL,
  `fecha_recarga` date DEFAULT NULL,
  `fecha_proxima_recarga` date DEFAULT NULL,
  `cantidad` mediumint(9) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `id_precio` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo_servicio` enum('VENTA','RECARGA') DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_zona` int(11) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `estado` enum('ACTIVO','DESACTIVADO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_producto_tipo` int(11) NOT NULL,
  `capacidad` varchar(45) DEFAULT NULL,
  `unidad` enum('m3','KILO') DEFAULT NULL,
  `tipo_material` varchar(45) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `codigo_producto` varchar(45) DEFAULT NULL,
  `estado_producto` enum('NUEVO','USADO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_tipo`
--

CREATE TABLE `producto_tipo` (
  `id_producto_tipo` int(11) NOT NULL,
  `tipo_producto` enum('PRO1','PRO2') DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `nombre_sucursal` varchar(45) DEFAULT NULL,
  `direccion_sucursal` varchar(550) DEFAULT NULL,
  `codigo_sucursal` varchar(10) DEFAULT NULL,
  `latitud_sucursal` int(11) DEFAULT NULL,
  `longitud_sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_producto`
--

CREATE TABLE `sucursal_producto` (
  `id_sucursal_producto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` mediumint(9) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `id_nota_entrega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$OJyTFBITbgFl20CY/FusQ.q0gclr36H7Soazwfk3NW3.ocYGtJuHq', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1654469655, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(173, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id_zona` int(11) NOT NULL,
  `nombre_zona` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id_zona`, `nombre_zona`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cliente_direccion`
--
ALTER TABLE `cliente_direccion`
  ADD PRIMARY KEY (`id_cliente_direccion`),
  ADD KEY `fk_cliente_direccion_cliente1_idx` (`id_cliente`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_entrega`
--
ALTER TABLE `nota_entrega`
  ADD PRIMARY KEY (`id_nota_entrega`),
  ADD KEY `fk_nota_entrega_sucursal1_idx` (`id_sucursal`),
  ADD KEY `fk_nota_entrega_proveedor1_idx` (`id_proveedor`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden_compra`),
  ADD KEY `fk_orden_compra_cliente1_idx` (`id_cliente`),
  ADD KEY `fk_orden_compra_cliente_direccion1_idx` (`id_cliente_direccion`);

--
-- Indices de la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  ADD PRIMARY KEY (`id_orden_compra_detalle`),
  ADD KEY `fk_orden_compra_detalle_precio1_idx` (`id_precio`),
  ADD KEY `fk_orden_compra_detalle_orden_compra1_idx` (`id_orden_compra`),
  ADD KEY `fk_orden_compra_detalle_sucursal1_idx` (`id_sucursal`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`id_precio`),
  ADD KEY `fk_precio_producto1_idx` (`id_producto`),
  ADD KEY `fk_precio_zona1_idx` (`id_zona`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_producto_tipo_idx` (`id_producto_tipo`);

--
-- Indices de la tabla `producto_tipo`
--
ALTER TABLE `producto_tipo`
  ADD PRIMARY KEY (`id_producto_tipo`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indices de la tabla `sucursal_producto`
--
ALTER TABLE `sucursal_producto`
  ADD PRIMARY KEY (`id_sucursal_producto`),
  ADD KEY `fk_sucursal_producto_producto1_idx` (`id_producto`),
  ADD KEY `fk_sucursal_producto_nota_entrega1_idx` (`id_nota_entrega`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente_direccion`
--
ALTER TABLE `cliente_direccion`
  MODIFY `id_cliente_direccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9515;

--
-- AUTO_INCREMENT de la tabla `nota_entrega`
--
ALTER TABLE `nota_entrega`
  MODIFY `id_nota_entrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  MODIFY `id_orden_compra_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `id_precio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_tipo`
--
ALTER TABLE `producto_tipo`
  MODIFY `id_producto_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal_producto`
--
ALTER TABLE `sucursal_producto`
  MODIFY `id_sucursal_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_direccion`
--
ALTER TABLE `cliente_direccion`
  ADD CONSTRAINT `fk_cliente_direccion_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_entrega`
--
ALTER TABLE `nota_entrega`
  ADD CONSTRAINT `fk_nota_entrega_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_entrega_sucursal1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `fk_orden_compra_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orden_compra_cliente_direccion1` FOREIGN KEY (`id_cliente_direccion`) REFERENCES `cliente_direccion` (`id_cliente_direccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  ADD CONSTRAINT `fk_orden_compra_detalle_orden_compra1` FOREIGN KEY (`id_orden_compra`) REFERENCES `orden_compra` (`id_orden_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orden_compra_detalle_precio1` FOREIGN KEY (`id_precio`) REFERENCES `precio` (`id_precio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orden_compra_detalle_sucursal1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `precio`
--
ALTER TABLE `precio`
  ADD CONSTRAINT `fk_precio_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precio_zona1` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id_zona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_producto_tipo` FOREIGN KEY (`id_producto_tipo`) REFERENCES `producto_tipo` (`id_producto_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sucursal_producto`
--
ALTER TABLE `sucursal_producto`
  ADD CONSTRAINT `fk_sucursal_producto_nota_entrega1` FOREIGN KEY (`id_nota_entrega`) REFERENCES `nota_entrega` (`id_nota_entrega`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sucursal_producto_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
