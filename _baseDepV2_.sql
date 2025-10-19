-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2019 a las 01:08:58
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
-- Base de datos: `base_datos`
--

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_User` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre_usuario` varchar(200) COLLATE utf8_spanish2_ci UNIQUE NOT NULL,
  `Email` varchar(200) COLLATE utf8_spanish2_ci UNIQUE NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nivel` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `FechaNacimiento` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Activa` boolean NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cuit_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `dni_gerente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_gerente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_gerente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `telelefono` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `producto_almacen`
--

CREATE TABLE `producto_almacen` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_proveedor` int(20),
  `producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Cantidad` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
   FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



--
-- Estructura de tabla para la tabla `consumo_almacen`
--

CREATE TABLE `consumo_almacen` (
  `id_consumo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_producto` int(20),
  `cantidad` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_consumo` date NOT NULL,
  FOREIGN KEY (id_producto) REFERENCES producto_almacen(id_producto) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `orden_compras`
--

CREATE TABLE `orden_compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_producto` int(20),
  `precio` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  FOREIGN KEY (id_producto) REFERENCES producto_almacen(id_producto) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_producto` int(20), 
  `cantidad` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_pedido` date NOT NULL,
  FOREIGN KEY (id_producto) REFERENCES producto_almacen(id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE token (
  `id`            BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_User`       int(11) NOT NULL,
  `purpose`       ENUM('password_reset','email_verify') NOT NULL,
  `selector`      VARBINARY(16)   NOT NULL,           
  `validator_hash` BINARY(32)     NOT NULL,          
  `issued_at`     DATETIME(6)     NOT NULL ,
  `expires_at`    DATETIME(6)     NOT NULL,
  `used_at`       DATETIME(6)     NULL,
  FOREIGN KEY (id_User) REFERENCES usuarios(id_User)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE log (
  `id`            BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_User`       int(11) NOT NULL,
  `Action`       varchar(200) NOT NULL,
  `selector`      VARBINARY(16)   NOT NULL,           
  `DateTime`       DATETIME(6)     NULL,
  FOREIGN KEY (id_User) REFERENCES usuarios(id_User)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre_usuario`, `Email` , `password` , `nivel`, `FechaNacimiento` , `fecha_ingreso`) VALUES
('admin', 'admin@test.com', '$2y$10$YR1WO.2twGuIMuXQiiCb3enfkdZ9ua6MtJ8akf1HvyBzMOSr0pKy.' , 'administrador', '2007-10-18', '2019-07-24');


--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`cuit_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `correo_empresa`, `dni_gerente`, `nombre_gerente`, `correo_gerente`) VALUES
('20-11222333-0', 'ControlDeposito', 'Lavaisse 610', '342-460-1579', 'control@deposito.com', '37685454', 'jose martinez', 'jose.martinez.slb@gmail.com');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedor` (`nombre`, `cuit`, `ciudad`, `direccion`, `email`, `telelefono`, `fecha_ingreso`) VALUES
('indeca', '00-11222333-0', 'San martín, buenos aires', 'Hipólito Yrigoyen 4442', 'info@indeca.com.ar', '11122233', '2019-07-24'),
('cableparts', '00-22333555-0', 'capital federal', 'Av. Corrientes 848 3º \"303\"', 'info@cableparts.com.ar', '011 4444-6666', '2019-07-24'),
('munred', '00334445550', 'Olivos, Buenos aires', 'FRAY JUSTO SARMIENTO 3540', 'info@munred.com.ar', '011 11122233', '2019-07-24');

-- --------------------------------------------------------


--
-- Volcado de datos para la tabla `producto_almacen`
--

INSERT INTO `producto_almacen` (`id_proveedor`, `producto`, `precio`, `Cantidad`, `ubicacion`, `estado`, `fecha_ingreso`) VALUES
(3, 'bobina cable rg6 x 152m', '1599', '80', 'deposito-santa fe', 'activo', '2019-07-24'),
(3, 'Cablemodem Arris Sb6141 ', '4700', '70', 'deposito-santa fe', 'activo', '2019-07-24'),
(1, 'fichas rg6 x50u', '450', '120', 'deposito-santa fe', 'ACTIVO', '2019-07-24'),
(2, 'decodificador HD m&m', '1500', '120', 'deposito-santa fe', 'ACTIVO', '2019-07-24'),
(2, 'divisor 4 bocas', '180', '100', 'deposito-santa fe', 'activo', '2019-07-24'),
(1, 'divisor 3 bocas', '170', '100', 'deposito-santa fe', 'ACTIVO', '2019-07-24');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `consumo_almacen`
--

INSERT INTO `consumo_almacen` (`id_producto`, `cantidad`, `fecha_consumo`) VALUES
(1, '20', '2019-07-24'),
(3, '30', '2019-07-24');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `orden_compras`
--

INSERT INTO `orden_compras` (`id_producto`, `precio`, `cantidad`, `fecha_ingreso`) VALUES
(1 , '32000', '20',  '2019-07-24'),
(2 , '9000', '20',  '2019-07-24'),
(3 , '47000', '10', '2019-07-24');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_producto`, `cantidad`, `fecha_pedido`) VALUES
(1 , '150', '2019-07-24'),
(2 , '250', '2019-07-24');

-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
COMMIT; 