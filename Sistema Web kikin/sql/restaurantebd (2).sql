-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2021 a las 06:00:23
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurantebd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayudantedecocina`
--

CREATE TABLE `ayudantedecocina` (
  `idAyudantedeCocina` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ayudantedecocina`
--

INSERT INTO `ayudantedecocina` (`idAyudantedeCocina`, `nombre`, `apellido`, `estado`) VALUES
(100, 'Candelaria', 'Toleto Herrero', 1),
(101, 'Juan', 'Alvarado Riquelme', 1),
(102, 'Mirko', 'Suarez Suice', 1),
(103, 'Freddy', 'Vega Espinoza', 1),
(104, 'Milagros', 'Ramirez Tello', 1),
(105, 'Alejandro', 'Toledo Torres', 1),
(106, 'Pedro', 'Borja Hurtado', 1),
(107, 'Pablo', 'Serrano Milque', 1),
(108, 'Ildenfonso', 'Barbero Saenz', 1),
(109, 'Laura', 'Orozco Lopez', 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `idColaborador` varchar(20) NOT NULL,
  `contraseñaColaborador` varchar(100) DEFAULT NULL,
  `correoColaborador` varchar(45) DEFAULT NULL,
  `estadoColaborador` int(11) DEFAULT NULL,
  `idRol` int(11) NOT NULL,
  `DNI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`idColaborador`, `contraseñaColaborador`, `correoColaborador`, `estadoColaborador`, `idRol`, `DNI`) VALUES
('abenavides', 'abenavides', '2017100179@ucss.pe', 1, 106, 60606066),
('alino', 'alino', '2017100576@ucss.pe', 1, 104, 60606061),
('aquivio', 'aquivio', '2016100507@ucss.pe', 1, 101, 60606060),
('csanchez', 'csanchez', '2017100179@ucss.pe', 1, 107, 60606070),
('ctorres', 'ctorres', 'jorgefchc@gmail.com', 1, 106, 60606068),
('jchavez', 'jchavez', '2016100294@ucss.pe', 1, 102, 60606062),
('jchu', 'jchu', 'jorgefchc@gmail.com', 1, 106, 60606069),
('lluna', 'lluna', 'jorgefchc@gmail.com', 1, 107, 60606067),
('mbazz', 'mbazz', '2017100179@ucss.pe', 1, 107, 60606071),
('nhuertas', 'nhuertas', '2017100560@ucss.pe', 1, 103, 60606063),
('pmarcos', 'pmarcos', '2017100179@ucss.pe', 1, 105, 60606072),
('rrupay', 'rrupay', 'ichig292@gmail.com', 1, 101, 60606065);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaenvio`
--

CREATE TABLE `colaenvio` (
  `idPedido` int(11) NOT NULL,
  `idRepartidor` int(11) NOT NULL,
  `ComentarioReparto` varchar(45) DEFAULT NULL,
  `estadoEnvio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colamozo`
--

CREATE TABLE `colamozo` (
  `idPedido` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colapreparacion`
--

CREATE TABLE `colapreparacion` (
  `idPedido` int(11) NOT NULL,
  `idAyudantedeCocina` int(11) NOT NULL,
  `estadoPreparacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comensal`
--

CREATE TABLE `comensal` (
  `idComensal` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Celular` varchar(45) DEFAULT NULL,
  `DNI` int(8) DEFAULT NULL,
  `contraseña` varchar(300) DEFAULT NULL,
  `tipoComensal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comensal`
--

INSERT INTO `comensal` (`idComensal`, `nombre`, `apellido`, `Correo`, `Celular`, `DNI`, `contraseña`, `tipoComensal`) VALUES
(100, 'COMENSAL', 'LOCAL', NULL, NULL, 0, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantedepago`
--

CREATE TABLE `comprobantedepago` (
  `idComprobantedePago` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idComensal` int(11) NOT NULL,
  `FechaComprobante` varchar(45) DEFAULT NULL,
  `tipoPago` int(11) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL,
  `igv` decimal(10,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantedepagodeproductosrequeridos`
--

CREATE TABLE `comprobantedepagodeproductosrequeridos` (
  `idcomprobanteProdR` int(11) NOT NULL,
  `idOrdendePago` int(11) NOT NULL,
  `idrecepcion` int(11) NOT NULL,
  `MontoTotal` decimal(15,2) DEFAULT NULL,
  `FechaComprobante` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleordenprodrequeridos`
--

CREATE TABLE `detalleordenprodrequeridos` (
  `idOrdenPedidoProdR` int(11) NOT NULL,
  `idProductos` int(11) NOT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `estadoproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idPedido` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleplato`
--

CREATE TABLE `detalleplato` (
  `idPlato` int(11) NOT NULL,
  `idProductos` int(11) NOT NULL,
  `cantidadProducto` int(11) DEFAULT NULL,
  `fechaIngrediente` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerecepcionproductosrequeridos`
--

CREATE TABLE `detallerecepcionproductosrequeridos` (
  `idrecepcion` int(11) NOT NULL,
  `idProductos` int(11) NOT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `fechaVen` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionreclamo`
--

CREATE TABLE `evaluacionreclamo` (
  `idEvaluacionReclamo` int(11) NOT NULL,
  `idReclamo` int(11) NOT NULL,
  `detalle` varchar(300) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idProductos` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `Stock` decimal(5,2) DEFAULT NULL,
  `Fechadevenc` date DEFAULT NULL,
  `Categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idProductos`, `Nombre`, `Descripcion`, `Stock`, `Fechadevenc`, `Categoria`) VALUES
(100, 'Pollo Fresco', 'Con Menudencia Trozado en 8 Piezas x UNID', '10.00', '2022-02-04', 1),
(101, 'Pollipavo', 'Con Menudencia X UNID', '23.00', '2022-02-04', 1),
(102, 'Pollo Fresco', 'Con Menudencia', '50.00', '2022-02-04', 1),
(104, 'Lechuga Americana', 'por unidades', '20.00', '2022-02-04', 1),
(105, 'Fideo Spaghetti', 'Bolsa de 12 unidades de 1Kg', '27.00', '2022-02-04', 1),
(106, 'Atún Campomar', 'Lata de 170gr', '18.00', '2022-02-04', 1),
(107, 'Bolsas blancas 16x15', 'paquete de 100 unidades', '24.00', NULL, 2),
(108, 'Plato contenedor 1/4 pollo', 'Paquete por 50 unidades', '15.00', NULL, 2),
(109, 'Papa Amarrilla', 'Saco de 90kg', '10.00', '2022-02-04', 1),
(110, 'Taper con tapa ajicero', '2 onzas por 100 unidades', '18.00', NULL, 2),
(111, 'Taper con tapa', '8 onzas por 50 unidades', '24.00', NULL, 2),
(112, 'Arroz', 'Saco de 100kg', '4.00', '2022-02-04', 1),
(113, 'Frijol Castilla', 'Saco de 40kg', '20.00', '2022-02-04', 1),
(114, 'Aceite Vegetal Primor', 'Caja por 6 unidades', '25.00', '2022-02-04', 1),
(115, 'Cebolla Blanca', 'Saco de 40kg', '5.00', '2022-02-04', 1),
(116, 'Aji amarillo entero', 'Por kilo ', '8.00', '2022-02-04', 1),
(117, 'Frejolito Chino', 'Por Kilo', '30.00', '2022-02-04', 1),
(118, 'Zanahoria', 'Saco por 40 Kilos', '6.00', '2022-02-04', 1),
(119, 'Chuleta de Pierna de Cerdo', 'Presentación 0.8 kg aprox.', '60.00', '2022-02-04', 1),
(120, 'Chuleta de Lomo de Cerdo', 'Presentación 0.8 kg aprox.', '32.00', '2022-02-04', 1),
(121, 'Chuleta Parrillera de Cerdo', 'Presentación 0.8 kg aprox.', '110.00', '2022-02-04', 1),
(122, 'Langostinos Precocidos', 'Bolsa de 300gr', '80.00', '2022-02-04', 1),
(123, 'Limon', 'Saco de 40kg', '12.00', '2022-02-04', 1),
(124, 'Quezo Mozzarella', 'Paquete de 1KG', '32.00', '2022-02-04', 1),
(125, 'Inka Kola 1.5L', 'Paquete x 6 unid', '150.00', '2022-02-04', 1),
(126, 'Inka Kola 1.5L', 'Paquete de 6uni', '150.00', '2022-02-04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `idMesa` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`idMesa`, `descripcion`, `estado`) VALUES
(0, 'Mesa Aplicación', 1),
(1, 'Mesa para 3 a 5 personas', 1),
(2, 'Mesa para 2 a 4 personas', 1),
(3, 'Mesa para 4 a 6 personas', 1),
(4, 'Mesa para 2 a 4 personas', 1),
(5, 'Mesa para 3 a 5 personas', 1),
(6, 'Mesa para 4 a 6 personas', 1),
(7, 'Mesa para 4 a 6 personas', 1),
(8, 'Mesa para 4 a 6 personas', 1),
(9, 'Mesa para 3 a 5 personas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notacredito`
--

CREATE TABLE `notacredito` (
  `idNotaCredito` int(11) NOT NULL,
  `idReclamo` int(11) NOT NULL,
  `montoCredito` decimal(10,2) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `codigoOpcion` int(11) NOT NULL,
  `descripcionOpcion` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`codigoOpcion`, `descripcionOpcion`, `estado`, `idRol`) VALUES
(202, 'Generar Pedido en Local', 1, 106),
(203, 'Generar reclamo', 1, 101),
(204, 'Registrar Pago', 1, 102),
(205, 'Generar pago al proveedor', 1, 102),
(206, 'Generar nota de crédito', 1, 102),
(207, 'Evaluación de Reclamo', 1, 105),
(208, 'Asignar pedido', 1, 103),
(209, 'Generar Platos del día', 1, 103),
(210, 'Orden de productos requeridos', 1, 103),
(211, 'Recepcionar productos requeridos', 1, 104),
(212, 'Orden de pago de prod. requeridos', 1, 104),
(213, 'Recepcionar Pedido', 1, 107),
(214, 'Asignar Mozo', 1, 103),
(215, 'Generar Comprobante de Pago', 1, 102),
(216, 'Asignar Reparto', 1, 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordendepagoproductosrequeridos`
--

CREATE TABLE `ordendepagoproductosrequeridos` (
  `idOrdendePago` int(11) NOT NULL,
  `idrecepcion` int(11) NOT NULL,
  `nombreProveedor` varchar(45) DEFAULT NULL,
  `Monto` decimal(15,2) DEFAULT NULL,
  `IGV` decimal(15,2) DEFAULT NULL,
  `FechaOrden` date DEFAULT NULL,
  `documentoSalida` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenpedidoproductorequeridos`
--

CREATE TABLE `ordenpedidoproductorequeridos` (
  `idOrdendePedidoProdR` int(11) NOT NULL,
  `Estado` int(11) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `idComensal` int(11) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `tipoEntrega` int(11) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `fechaPedido` date DEFAULT NULL,
  `HoraPedido` time DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `DNI` int(11) NOT NULL,
  `nombrepersona` varchar(45) DEFAULT NULL,
  `apellidopaterno` varchar(45) DEFAULT NULL,
  `apellidomaterno` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`DNI`, `nombrepersona`, `apellidopaterno`, `apellidomaterno`) VALUES
(60606060, 'Alba', 'Jimenez', 'Quivio'),
(60606061, 'Alonso', 'Lino', 'Caceres'),
(60606062, 'Jorge', 'Chavez', 'Cachay'),
(60606063, 'Nilver', 'Huertas', 'Gutierrez'),
(60606065, 'Ronaldo', 'Rupay', 'Palomino'),
(60606066, 'Alfredo', 'Benavides', 'Contreras'),
(60606067, 'Luis', 'Luna', 'Lunera'),
(60606068, 'Carlos', 'Torres', 'Wuong'),
(60606069, 'Juan', 'Chu', 'Joy'),
(60606070, 'Carlos', 'Sanchez', 'Avila'),
(60606071, 'Mateo', 'Bazz', 'Sanchez'),
(60606072, 'Pol', 'Marcos', 'Jimenez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `idPlato` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `cantidadPlatos` varchar(45) DEFAULT NULL,
  `PrecioU` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `actualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`idPlato`, `Nombre`, `Descripcion`, `cantidadPlatos`, `PrecioU`, `imagen`, `actualizacion`) VALUES
(100, 'Parrilla Familiar', '1 Cuadril + 1 Churrasco + 1 Chuleta + 2 Chorizos + 2 Palitos de anticucho + 1/2 Pollo a la leña + 1 Porción de mollejitas a la parrilla + papas fritas + ensalada + Gaseosa 1.5 Lt', '0', '79.00', 'https://sistemkikin.000webhostapp.com/platos/100.png', '2021-12-06'),
(101, 'Parrilla para dos', '1 Churrasco + 1 Chuleta + 1 Chorizo + 1 Palito de anticucho + 1/4 Pollo a la leña + 1 Porción de mollejitas a la parrilla + papas fritas + ensalada', '0', '45.00', 'https://sistemkikin.000webhostapp.com/platos/101.jpg', '2021-12-06'),
(102, '1/4 Pollo a la leña', '1/4 Pollo +papas fritas +ensalada ', '0', '13.50', 'https://sistemkikin.000webhostapp.com/platos/102.jpg', '2021-12-06'),
(103, '1/2 Pollo a la leña', '1/2 Pollo +papas fritas +ensalada + Inka Kola 1.5L', '0', '26.00', 'https://sistemkikin.000webhostapp.com/platos/103.png', '2021-12-06'),
(104, '1 Pollo a la leña', '1 Pollo + papas fritas +ensalada', '0', '48.00', 'https://sistemkikin.000webhostapp.com/platos/104.png', '2021-12-06'),
(105, '2 Pollos a la leña', '2 Pollos a la leña  + papas fritas +ensalada + 2 Inka Kola 1.5L', '0', '100.00', 'https://sistemkikin.000webhostapp.com/platos/105.jpeg', '2021-12-06'),
(106, 'Churrasco a la parrilla', '1 Filete de Carne + Papas Sancochadas + Ensalada', '0', '18.00', 'https://sistemkikin.000webhostapp.com/platos/106.jpg', '2021-12-06'),
(107, 'Churrasco a lo pobre', '1 Filete de Carne + 1 Porcion de Platano + 1 Porcion de Huevo + 1 Porcion de Arroz + Papas(Fritas o Sancochadas) + Ensalada', '0', '19.00', 'https://sistemkikin.000webhostapp.com/platos/107.png', '2021-12-06'),
(108, 'Chuleta de cerdo', '1 Chuleta de cerdo + 1 Porcion de Arroz + Papas(Fritas o Sancochadas) + Ensalada', '0', '20.00', 'https://sistemkikin.000webhostapp.com/platos/108.jpg', '2021-12-06'),
(109, 'Piqueo Carretillero', '1 Palito de anticucho + 1 Chorizo + 1 Porción de mollejitas', '0', '22.00', 'https://sistemkikin.000webhostapp.com/platos/109.jpg', '2021-12-06'),
(110, 'Pechuga de Pollo a la Parrilla', 'Pechuga a la parrilla + papas fritas y ensalada', '0', '15.00', 'https://sistemkikin.000webhostapp.com/platos/110.jpg', '2021-12-06'),
(111, 'Pechuga Rellena', 'Pechuga rellena con queso mozzarella y tocino ahumado + papas fritas y ensalada', '0', '18.00', 'https://sistemkikin.000webhostapp.com/platos/111.jpg', '2021-12-06'),
(112, 'Anticuchos', '2 Palitos de anticucho + papas fritas + ensalada', '0', '15.00', 'https://sistemkikin.000webhostapp.com/platos/112.jpeg', '2021-12-06'),
(113, 'Mollejitas a la parrilla', 'Mollejitas a la parrilla con chimichurri + papas fritas + ensalada', '0', '13.00', 'https://sistemkikin.000webhostapp.com/platos/113.jpg', '2021-12-06'),
(114, 'Chorizo a la parrilla', '2 Chorizos a la parrilla + papas fritas y ensalada', '0', '10.00', 'https://sistemkikin.000webhostapp.com/platos/114.jpg', '2021-12-06'),
(115, 'Cuadril a la parrilla', 'Carne a la parrilla', '0', '18.00', 'https://sistemkikin.000webhostapp.com/platos/115.jpg', '2021-12-06'),
(116, 'Aeropuerto', 'Tallarín saltado con arroz chaufa y tortilla de huevo', '0', '11.00', 'https://sistemkikin.000webhostapp.com/platos/116.jpg', '2021-12-06'),
(117, 'Chaufa de Pollo', 'Arroz chaufa de pollo y tortilla de huevo', '0', '10.00', 'https://sistemkikin.000webhostapp.com/platos/117.jpg', '2021-12-06'),
(118, 'Chaufa Especial', 'Pollo, carne, chancho y langostino', '0', '19.50', 'https://sistemkikin.000webhostapp.com/platos/118.jpg', '2021-12-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionproductosrequeridos`
--

CREATE TABLE `recepcionproductosrequeridos` (
  `idrecepcion` int(11) NOT NULL,
  `fechaRecep` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamo`
--

CREATE TABLE `reclamo` (
  `idReclamo` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `detalleReclamo` varchar(300) DEFAULT NULL,
  `fechaReclamo` date DEFAULT NULL,
  `tipoReclamo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

CREATE TABLE `repartidor` (
  `idRepartidor` int(11) NOT NULL,
  `vehiculo` varchar(45) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL,
  `DNI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `repartidor`
--

INSERT INTO `repartidor` (`idRepartidor`, `vehiculo`, `Estado`, `DNI`) VALUES
(100, 'ITALIKA NEGRA FT 150 HEAVY DUTY', 1, 60606067),
(101, 'SUZUKI AZUL AX100', 1, 60606070),
(102, 'ITALIKA BLANCO DT150 DELIVERY', 1, 60606071);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `descripcionrol` varchar(45) DEFAULT NULL,
  `estadorol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `descripcionrol`, `estadorol`) VALUES
(101, 'Recepcionista', 1),
(102, 'Cajero', 1),
(103, 'Jefe de Cocina', 1),
(104, 'Almacenero', 1),
(105, 'Supervisor de Reclamos', 1),
(106, 'Mozo', 1),
(107, 'Repartidor', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ayudantedecocina`
--
ALTER TABLE `ayudantedecocina`
  ADD PRIMARY KEY (`idAyudantedeCocina`);

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`idColaborador`,`idRol`,`DNI`),
  ADD KEY `fk_Colaborador_Rol1` (`idRol`),
  ADD KEY `fk_Colaborador_Persona1` (`DNI`);

--
-- Indices de la tabla `colaenvio`
--
ALTER TABLE `colaenvio`
  ADD PRIMARY KEY (`idPedido`,`idRepartidor`),
  ADD KEY `fk_Pedido_has_Repartidor_Repartidor1` (`idRepartidor`);

--
-- Indices de la tabla `colamozo`
--
ALTER TABLE `colamozo`
  ADD PRIMARY KEY (`idPedido`,`DNI`),
  ADD KEY `fk_Pedido_has_Persona_Persona1` (`DNI`);

--
-- Indices de la tabla `colapreparacion`
--
ALTER TABLE `colapreparacion`
  ADD PRIMARY KEY (`idPedido`,`idAyudantedeCocina`),
  ADD KEY `fk_Pedido_has_AyudantedeCocina_AyudantedeCocina1` (`idAyudantedeCocina`);

--
-- Indices de la tabla `comensal`
--
ALTER TABLE `comensal`
  ADD PRIMARY KEY (`idComensal`);

--
-- Indices de la tabla `comprobantedepago`
--
ALTER TABLE `comprobantedepago`
  ADD PRIMARY KEY (`idComprobantedePago`,`idPedido`,`idComensal`),
  ADD KEY `fk_ComprobantedePago_Pedido1` (`idPedido`,`idComensal`);

--
-- Indices de la tabla `comprobantedepagodeproductosrequeridos`
--
ALTER TABLE `comprobantedepagodeproductosrequeridos`
  ADD PRIMARY KEY (`idcomprobanteProdR`,`idOrdendePago`,`idrecepcion`),
  ADD KEY `fk_comprobantedePagodeProductosRequeridos_OrdendePagoProducto1` (`idOrdendePago`,`idrecepcion`);

--
-- Indices de la tabla `detalleordenprodrequeridos`
--
ALTER TABLE `detalleordenprodrequeridos`
  ADD PRIMARY KEY (`idOrdenPedidoProdR`,`idProductos`),
  ADD KEY `fk_OrdendePedido_has_Producto_Producto1` (`idProductos`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`idPedido`,`idPlato`),
  ADD KEY `fk_Pedidos_has_Platos_Platos1` (`idPlato`);

--
-- Indices de la tabla `detalleplato`
--
ALTER TABLE `detalleplato`
  ADD PRIMARY KEY (`idPlato`,`idProductos`),
  ADD KEY `fk_Producto_has_listaProductosMenu_Producto1` (`idProductos`);

--
-- Indices de la tabla `detallerecepcionproductosrequeridos`
--
ALTER TABLE `detallerecepcionproductosrequeridos`
  ADD PRIMARY KEY (`idrecepcion`,`idProductos`),
  ADD KEY `fk_Producto_has_recepcionProductosrequeridos_Producto1` (`idProductos`);

--
-- Indices de la tabla `evaluacionreclamo`
--
ALTER TABLE `evaluacionreclamo`
  ADD PRIMARY KEY (`idEvaluacionReclamo`,`idReclamo`),
  ADD KEY `fk_EvaluacionReclamo_Reclamo1` (`idReclamo`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idProductos`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idMesa`);

--
-- Indices de la tabla `notacredito`
--
ALTER TABLE `notacredito`
  ADD PRIMARY KEY (`idNotaCredito`,`idReclamo`),
  ADD KEY `fk_notaCredito_Reclamo1` (`idReclamo`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`codigoOpcion`,`idRol`),
  ADD KEY `fk_Opciones_Rol1` (`idRol`);

--
-- Indices de la tabla `ordendepagoproductosrequeridos`
--
ALTER TABLE `ordendepagoproductosrequeridos`
  ADD PRIMARY KEY (`idOrdendePago`,`idrecepcion`),
  ADD KEY `fk_OrdendePago_recepcionProductosrequeridos1` (`idrecepcion`);

--
-- Indices de la tabla `ordenpedidoproductorequeridos`
--
ALTER TABLE `ordenpedidoproductorequeridos`
  ADD PRIMARY KEY (`idOrdendePedidoProdR`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`,`idComensal`,`idMesa`),
  ADD KEY `fk_Pedidos_Comensal1` (`idComensal`),
  ADD KEY `fk_Pedido_Mesa1` (`idMesa`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`idPlato`);

--
-- Indices de la tabla `recepcionproductosrequeridos`
--
ALTER TABLE `recepcionproductosrequeridos`
  ADD PRIMARY KEY (`idrecepcion`);

--
-- Indices de la tabla `reclamo`
--
ALTER TABLE `reclamo`
  ADD PRIMARY KEY (`idReclamo`,`idPedido`),
  ADD KEY `fk_Reclamo_Pedidos1` (`idPedido`);

--
-- Indices de la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD PRIMARY KEY (`idRepartidor`,`DNI`),
  ADD KEY `fk_Repartidor_Persona1` (`DNI`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `fk_Colaborador_Persona1` FOREIGN KEY (`DNI`) REFERENCES `persona` (`DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Colaborador_Rol1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `colaenvio`
--
ALTER TABLE `colaenvio`
  ADD CONSTRAINT `fk_Pedido_has_Repartidor_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_has_Repartidor_Repartidor1` FOREIGN KEY (`idRepartidor`) REFERENCES `repartidor` (`idRepartidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `colamozo`
--
ALTER TABLE `colamozo`
  ADD CONSTRAINT `fk_Pedido_has_Persona_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_has_Persona_Persona1` FOREIGN KEY (`DNI`) REFERENCES `persona` (`DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `colapreparacion`
--
ALTER TABLE `colapreparacion`
  ADD CONSTRAINT `fk_Pedido_has_AyudantedeCocina_AyudantedeCocina1` FOREIGN KEY (`idAyudantedeCocina`) REFERENCES `ayudantedecocina` (`idAyudantedeCocina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_has_AyudantedeCocina_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comprobantedepago`
--
ALTER TABLE `comprobantedepago`
  ADD CONSTRAINT `fk_ComprobantedePago_Pedido1` FOREIGN KEY (`idPedido`,`idComensal`) REFERENCES `pedido` (`idPedido`, `idComensal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comprobantedepagodeproductosrequeridos`
--
ALTER TABLE `comprobantedepagodeproductosrequeridos`
  ADD CONSTRAINT `fk_comprobantedePagodeProductosRequeridos_OrdendePagoProducto1` FOREIGN KEY (`idOrdendePago`,`idrecepcion`) REFERENCES `ordendepagoproductosrequeridos` (`idOrdendePago`, `idrecepcion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleordenprodrequeridos`
--
ALTER TABLE `detalleordenprodrequeridos`
  ADD CONSTRAINT `fk_OrdendePedido_has_Producto_OrdendePedido1` FOREIGN KEY (`idOrdenPedidoProdR`) REFERENCES `ordenpedidoproductorequeridos` (`idOrdendePedidoProdR`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdendePedido_has_Producto_Producto1` FOREIGN KEY (`idProductos`) REFERENCES `inventario` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fk_Pedidos_has_Platos_Pedidos1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedidos_has_Platos_Platos1` FOREIGN KEY (`idPlato`) REFERENCES `platos` (`idPlato`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleplato`
--
ALTER TABLE `detalleplato`
  ADD CONSTRAINT `fk_Producto_has_listaProductosMenu_Producto1` FOREIGN KEY (`idProductos`) REFERENCES `inventario` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_listaProductosMenu_listaProductosMenu1` FOREIGN KEY (`idPlato`) REFERENCES `platos` (`idPlato`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallerecepcionproductosrequeridos`
--
ALTER TABLE `detallerecepcionproductosrequeridos`
  ADD CONSTRAINT `fk_Producto_has_recepcionProductosrequeridos_Producto1` FOREIGN KEY (`idProductos`) REFERENCES `inventario` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_recepcionProductosrequeridos_recepcionProduct1` FOREIGN KEY (`idrecepcion`) REFERENCES `recepcionproductosrequeridos` (`idrecepcion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacionreclamo`
--
ALTER TABLE `evaluacionreclamo`
  ADD CONSTRAINT `fk_EvaluacionReclamo_Reclamo1` FOREIGN KEY (`idReclamo`) REFERENCES `reclamo` (`idReclamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notacredito`
--
ALTER TABLE `notacredito`
  ADD CONSTRAINT `fk_notaCredito_Reclamo1` FOREIGN KEY (`idReclamo`) REFERENCES `reclamo` (`idReclamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `fk_Opciones_Rol1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ordendepagoproductosrequeridos`
--
ALTER TABLE `ordendepagoproductosrequeridos`
  ADD CONSTRAINT `fk_OrdendePago_recepcionProductosrequeridos1` FOREIGN KEY (`idrecepcion`) REFERENCES `recepcionproductosrequeridos` (`idrecepcion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Mesa1` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedidos_Comensal1` FOREIGN KEY (`idComensal`) REFERENCES `comensal` (`idComensal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reclamo`
--
ALTER TABLE `reclamo`
  ADD CONSTRAINT `fk_Reclamo_Pedidos1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD CONSTRAINT `fk_Repartidor_Persona1` FOREIGN KEY (`DNI`) REFERENCES `persona` (`DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
