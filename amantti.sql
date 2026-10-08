-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 04:34:52
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
-- Base de datos: `amantti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'Labiales', 1),
(2, 'Bases', 1),
(3, 'Deliniadores', 1),
(4, 'Correctores', 1),
(5, 'Polvos', 1),
(6, 'Pestañinas', 1),
(7, 'Rubores', 1),
(8, 'Paletas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_facturas`
--

CREATE TABLE `detalle_facturas` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `valor`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'carrito'),
(4, 'comprado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `cantidad`, `categoria`, `proveedor`, `estado`) VALUES
(1, 'Labial de MAYBELLIN', 'El labial MAYBELLIN proporciona un tono natural y uniforme con textura suave y cremosa para una experiencia increíble.', 50000, '../Img/LABIAL_DE_MAYBELLIN.png', 10, 1, 1, 1),
(2, 'Labial de TRENDY ', 'El labial TRENDY tiene una textura ultra suave y cremosa que se difumina perfectamente sobre cualquier tipo de labios lo que lo convierte en un producto sumamente bueno en calidad precio.', 10000, '../Img/LABIAL_DE_TRENDY.png', 10, 1, 1, 1),
(3, 'Base CHANEL', 'La base CHANEL proporciona un tono natural y uniforme, sin lucir artificial con una ultra textura suave y muy cremosa.', 150000, '../Img/BASE_CHANEL.png', 5, 2, 6, 1),
(4, 'BASE DE TLM', 'La BASE TLM ofrece una cobertura completa y uniforme para ocultar imperfecciones y lograr un acabado perfecto gracias a su alta calidad.', 95000, '../Img/BASE_DE_TLM.png', 10, 2, 6, 1),
(5, 'DELINEADOR DE TRENDY', ' Ofrece varios beneficios, como su versatilidad para lograr diferentes estilos de maquillaje, incluyendo looks clásicos y elegantes. ', 20000, '../Img/DELINEADOR_DE_TRENDY.png', 30, 3, 7, 1),
(6, 'DELINEADOR DE SAMY', 'El delineador de Samy permite crear líneas precisas y definidas, lo que ayuda a realzar la forma de los ojos dándole un mayor impacto a tu mirada.', 10000, '../Img/DELINEADOR_DE_SAMY.png', 40, 3, 7, 1),
(7, 'CORRECTOR RUBY ROSE', 'El corrector de Ruby Rose ofrece una cobertura perfecta para imperfecciones en la cara, ojeras, manchas y cicatrices.', 17000, '../Img/CORRECTOR_RUBY_ROSE.png', 25, 4, 4, 1),
(8, 'CORECTOR DE MAYBELLINE', 'El corrector de Maybelline ofrece varios beneficios, como: Cobertura perfecta de imperfecciones, ojeras y cicatrices de manera natural.', 42500, 'CORRECTOR_DE_MAYBELLINE.png', 15, 4, 4, 1),
(9, 'POLVOS SUELTOS DE RUBY ROSE', 'Los polvos sueltos de Ruby Rose ofrecen varios beneficios, como: Controlar el brillo, Fijar el maquillaje, Suavizar la piel y Proteger la piel.', 30000, '../Img/POLVOS_SUELTOS_DE_RUBY_ROSE.png', 10, 5, 5, 1),
(10, 'POLVOS SUELTOS DE TRENDY', 'Ayuda a controlar el brillo y la apariencia grasosa en la piel y disimula las imperfecciones menores como cicatrices o manchas.', 20000, '../Img/POLVOS_SUELTOS_DE_TRENDY.png', 40, 5, 5, 1),
(11, 'PESTAÑINA DE TRENDY', 'Volumen inmediato: Gracias a sus microfibras miniatura, logra un volumen inmediato y notable en las pestañas.', 15000, '../Img/PESTAÑINA_DE_TRENDY.png', 50, 6, 3, 1),
(12, 'PESTAÑINA DE MAYBELLINE', 'Volumen extremo: Logra un volumen extremo y notable en las pestañas y su fórmula es ligera y no pesada, lo que hace que sea cómoda de llevar.', 60000, '../Img/PESTAÑINA_DE_MAYBELLINE.png', 10, 6, 3, 1),
(13, 'RUBOR DE MAYBELLINE', 'Proporciona un color natural y saludable a las mejillas el cual es duradero y resistente al agua, lo que hace que dure todo el día sin desvanecerse.', 30000, 'RUBOR_DE_MAYBELLINE.png', 15, 7, 2, 1),
(14, 'RUBOR DE TRENDY', 'Da un toque de color natural y saludable a las mejillas el cual ayuda a definir los pómulos y a dar profundidad al rostro.', 25000, '../Img/RUBOR_DE_TRENDY.png', 35, 7, 2, 1),
(15, 'Paleta Nude de Huda Beauty', 'Incluye 18 tonos en una variedad de acabados: mates, metálicos y con brillo. Los colores son mayormente neutros y rosados, ideales para looks suaves y elegantes.', 25000, '../Img/Paleta Nude de Huda Beauty.png', 10, 8, 8, 1),
(16, 'Paleta Gorgeous Me Eye Shadow Tray', 'Paleta de sombras de ojos conocida por su amplia gama de colores, ideal para crear looks versátiles. Ofrece una combinación de tonos neutros, cálidos y vibrantes, con acabados mate, satinado y brillante.', 40000, '../Img/Paleta Gorgeous Me Eye Shadow Tray.png', 20, 8, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `producto` varchar(255) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `direccion`, `telefono`, `producto`, `estado`) VALUES
(1, 'Distribuidora Belleza Uno', 'Calle 1 # 10-01', '3000000001', 'Labial', 1),
(2, 'Cosméticos del Valle', 'Calle 2 # 20-02', '3000000002', 'Rubor', 1),
(3, 'Importadora Glam', 'Calle 3 # 30-03', '3000000003', 'Pestañina', 1),
(4, 'Proveedora Rostro Ideal', 'Calle 4 # 40-04', '3000000004', 'Corrector', 1),
(5, 'Suministros Polvo Fino', 'Calle 5 # 50-05', '3000000005', 'Polvos', 1),
(6, 'Bases y Tonos S.A.S.', 'Calle 6 # 60-06', '3000000006', 'Base', 1),
(7, 'Trazo Perfecto Ltda.', 'Calle 7 # 70-07', '3000000007', 'Delineador', 1),
(8, 'Paletas Color Demo', 'Calle 8 # 80-08', '3000000008', 'Paletas', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `correo`, `contraseña`, `rol_id`, `estado`) VALUES
(1, 'Admin', 'Demo', 'admin@amantti.com', '$2y$10$67ptGuX0GW5bl2ohO/XdWOaIYE39AJc4kDV.qkvMqxTXsBLsLUWmq', 1, 1),
(2, 'Cliente', 'Demo', 'cliente@amantti.com', '$2y$10$ztly2PTGdwUiQOi9nsmM4e8FlR0zF7ob9I3fqPkKasTDkU9hGgjr.', 2, 1),
(3, 'Laura', 'Gómez', 'laura.gomez@example.com', '$2y$10$ztly2PTGdwUiQOi9nsmM4e8FlR0zF7ob9I3fqPkKasTDkU9hGgjr.', 2, 1),
(4, 'Andrés', 'Pérez', 'andres.perez@example.com', '$2y$10$ztly2PTGdwUiQOi9nsmM4e8FlR0zF7ob9I3fqPkKasTDkU9hGgjr.', 2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `fk_estado_parametros` (`estado`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria`),
  ADD KEY `fk_proveedor` (`proveedor`),
  ADD KEY `fk_estado` (`estado`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD CONSTRAINT `detalle_facturas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_estado_parametros` FOREIGN KEY (`estado`) REFERENCES `parametros` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `parametros` (`id`),
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`proveedor`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
