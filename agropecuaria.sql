-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-12-2020 a las 06:26:01
-- Versión del servidor: 10.2.36-MariaDB-log
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gomezriveraagrop_v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `id` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`id`, `finca_id`, `insumo_id`, `cantidad`, `valor`) VALUES
(1, 2, 744, 50, 7800),
(2, 4, 739, 24, 8000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_labor`
--

CREATE TABLE `bodega_labor` (
  `id` int(11) NOT NULL,
  `registro_id` int(11) NOT NULL,
  `bodega_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bodega_labor`
--

INSERT INTO `bodega_labor` (`id`, `registro_id`, `bodega_id`, `cantidad`, `valor`) VALUES
(1, 6, 2, 24, 8000),
(2, 7, 2, 5, 8000),
(3, 10, 2, 25, 8000),
(4, 14, 2, 25, 8000),
(5, 24, 2, 24, 8000),
(6, 25, 2, 5, 8000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `telefono` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nit`, `nombre`, `telefono`) VALUES
(1, 3, 'ABEL GONZALES', ''),
(2, 21, 'ADAIME', ''),
(3, 979797, 'AGROPECUARIA EL CAPIRO', ''),
(4, 2147483647, 'AGROPECUARIA LA MAQUINA', ''),
(5, 5544, 'ALBERTO GARCES', ''),
(6, 70723181, 'ALBERTO MEJIA', ''),
(7, 8888, 'ALEJANDRO GONZALES', ''),
(8, 654466, 'ALEX', ''),
(9, 2, 'ALONSO', ''),
(10, 5, 'ANDRES', ''),
(11, 78243, 'ANDRES MAURICIO RICO', ''),
(12, 8, 'ANGEL', ''),
(13, 2147483647, 'ARBOTEK', ''),
(14, 2147483647, 'ASOPROAGRI', ''),
(15, 7777, 'AVICAL', ''),
(16, 64646446, 'BERNARDO HINCAPIE', ''),
(17, 9999888, 'BLACK QUEEN', ''),
(18, 65465482, 'CAMILO', ''),
(19, 555555, 'CARLOS ADOLFO RICO', ''),
(20, 10249201, 'CARLOS ESCOBAR', ''),
(21, 24292670, 'CARMENZA GOMEZ', ''),
(22, 339452675, 'CAROLINA ACEVEDO', ''),
(23, 9, 'CIELO', ''),
(24, 900725985, 'COMCAFE GRAJALES S A S', ''),
(25, 95632323, 'COMERCIALIZADORA', ''),
(26, 25255521, 'COMERCIALIZADORA LOS TIOS', ''),
(27, 750356415, 'COMPRA DE CAFE LA TRECE', '8531589'),
(28, 2147483647, 'COOP DE CULTIVADORES LA MEJOR', ''),
(29, 2147483647, 'COOPERATIVA DE CAFICULTORES', ''),
(30, 654654654, 'CRISTIAN GIRALDO', ''),
(31, 2147483647, 'CUATRO MILPAS', ''),
(32, 7987189, 'DAVID MENA', ''),
(33, 79377045, 'DIEGO FERNANDO CATANO', ''),
(34, 1212, 'DIEGO JARAMILLO', ''),
(35, 2147483647, 'DTA EL ARROYO', ''),
(36, 99999999, 'EDIER ESTEBAN GRAJALES', ''),
(37, 900774345, 'ESPARRAGOS SOLVERDE S.A.S.', ''),
(38, 98794, 'FABIO', ''),
(39, 3232, 'FACUNDO', ''),
(40, 323, 'FELIPE', ''),
(41, 2147483647, 'FERNANDO (RISARALDA)', ''),
(42, 564564, 'FINCA LA CAMELIA', ''),
(43, 69416, 'GERARDO CARVAJAL', ''),
(44, 1053778150, 'GERMAN ESTRADA', ''),
(45, 12551, 'GERMAN GONZALES (MONACO)', ''),
(46, 658446, 'GILBERTO RESTREPO', ''),
(47, 6548641, 'GOLLO (COSTEÃ‘O)', ''),
(48, 2222, 'GUSTAVO', ''),
(49, 2147483647, 'GUTIERREZ JARAMILLO HERMANOS', ''),
(50, 2147483647, 'HACIENDA EL SINAI', ''),
(51, 1214139, 'HACIENDA LA PALMERA', ''),
(52, 2147483647, 'HACIENDA LA TENTACION SAS', ''),
(53, 10234055, 'HAROLD BOTERO JARAMILLO', ''),
(54, 900998536, 'HASS DIAMOND COMPANY SAS', '63300062'),
(55, 6463, 'HDA EL CHAPARRAL', ''),
(56, 5642311, 'HDA LOS ALPES', ''),
(57, 321, 'HERNEY CARDONA', ''),
(58, 900403794, 'INVERSIONES NECOCLI SA', ''),
(59, 13, 'JAIME', ''),
(60, 5498412, 'JAIME TRUJILLO', ''),
(61, 2323, 'JAIRO ANDRES', ''),
(62, 363, 'JAVIER MOLINA', ''),
(63, 0, 'JORGE', ''),
(64, 1, 'JORGE JARAMILLO', ''),
(65, 323232, 'JOSE R', ''),
(66, 666565, 'JUAN ALBERTO', ''),
(67, 321231, 'JUAN CARLOS', ''),
(68, 10243016, 'JULIAN ECHEVERRY VALLEJO', ''),
(69, 654321, 'JULIO', ''),
(70, 2147483647, 'LA MESETA S.A', ''),
(71, 2147483647, 'LOUIS DREYFUS COMMODITIES', ''),
(72, 3022222, 'MARCELO JARAMILLO', ''),
(73, 1054920177, 'MAURICIO RICO MARIN', ''),
(74, 900667418, 'MAURYFRUTIVERES SAS', '3102058152'),
(75, 15, 'MERARDO', ''),
(76, 222, 'MERCALDAS', ''),
(77, 9999, 'N.N', ''),
(78, 9832464, 'NELSON (RISARALDA)', ''),
(79, 44306048, 'OSCAR DE JESUS RAMIREZ', '3206910335'),
(80, 2147483647, 'PRECOOPCAFE', '3527363'),
(81, 2147483647, 'PROVEEDOR', '8532400'),
(82, 65497, 'RICAURTE VALENCIA', ''),
(83, 777, 'RODRIGO', ''),
(84, 46544321, 'RUBEN GRAJALES', ''),
(85, 4656465, 'SOCIOS AHUYAMA', ''),
(86, 80080000, 'SUBASTA SANTAGUEDA', ''),
(87, 43450805, 'TRILLADORA LA PRADERA', '8534949'),
(88, 79797, 'VALERIO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `insumo_id`, `valor`, `cantidad`, `finca_id`, `usuario_id`, `proveedor_id`, `n_factura`, `fecha`) VALUES
(1, 744, 7800, 50, 2, 3, 16, '4587', '2019-03-07'),
(2, 739, 8000, 78, 4, 2, 12, '24587', '2019-07-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `id` int(11) NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `sociedad_id` int(11) NOT NULL,
  `finca_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `identificacion` varchar(128) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `telefono` varchar(128) NOT NULL,
  `concepto` text NOT NULL,
  `valor_letras` varchar(128) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultivo`
--

CREATE TABLE `cultivo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cultivo`
--

INSERT INTO `cultivo` (`id`, `nombre`) VALUES
(1, 'AGUACATE'),
(2, 'MAIZ'),
(3, 'CITRICOS'),
(4, 'CAFE'),
(5, 'GUAYABA'),
(6, 'PLATANO'),
(7, 'PASTOS'),
(8, 'GUADUA'),
(9, 'FRIJOL'),
(10, 'ALMACIGO'),
(11, 'BANANO'),
(12, 'PITAHAYA'),
(13, 'ESPARRAGO'),
(14, 'AHUYAMA'),
(15, 'MACADAMIA'),
(16, 'HACIENDA'),
(17, 'VARIOS'),
(18, 'FERTILIZANTE ORGANICO'),
(19, 'LOMBRICULTIVO'),
(20, 'AVICOLA'),
(21, 'ARBORIZACION'),
(22, 'LULO'),
(23, 'PIMIENTA'),
(24, 'CACAO'),
(25, 'GRANADILLA'),
(26, 'PIMENTON'),
(27, 'MADERABLES'),
(28, 'LIMON'),
(29, 'EQUINOS'),
(30, 'SUBPRODUCTOS CAFE'),
(31, 'GANADO'),
(32, 'OTROS'),
(33, 'id_cultivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despache`
--

CREATE TABLE `despache` (
  `id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(128) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `n_remision` int(11) NOT NULL,
  `observacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `despache`
--

INSERT INTO `despache` (`id`, `lote_id`, `producto_id`, `fecha`, `cantidad`, `unidad`, `cliente_id`, `n_remision`, `observacion`) VALUES
(1, 2, 64, '2019-03-12', 78, '', 2, 7899, 'una observaciÃ³n'),
(2, 2, 64, '2019-03-12', 34, '45 / racimos', 1, 4521, 'segundo reporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(70) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `identificacion`, `nombre`, `apellidos`) VALUES
(1, '1053872432', 'Juan Carlos', 'Giraldo Rios'),
(2, '4545121', 'pepito', 'peres'),
(3, '988546456', 'Alejandro', 'Asweb'),
(4, '789456123', 'Nuevo', 'apellidos'),
(5, '98456456', 'Pedro', 'Giraldo'),
(6, '789654123', 'Otro empleado', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finca`
--

CREATE TABLE `finca` (
  `id` int(11) NOT NULL,
  `id_sociedad` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `finca`
--

INSERT INTO `finca` (`id`, `id_sociedad`, `nombre`) VALUES
(2, 2, 'SINAI'),
(3, 3, 'CAMELIA'),
(4, 4, 'PALMERA'),
(5, 4, 'SINAI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_administrativos`
--

CREATE TABLE `gastos_administrativos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `finca_id` int(11) NOT NULL,
  `rubro_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `observacion` text NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_financieros`
--

CREATE TABLE `gastos_financieros` (
  `id` int(11) NOT NULL,
  `finca_id` int(11) DEFAULT NULL,
  `rubro_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `valor` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_otros`
--

CREATE TABLE `gastos_otros` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `finca_id` int(11) NOT NULL,
  `rubro_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `observacion` text NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos_otros`
--

INSERT INTO `gastos_otros` (`id`, `fecha`, `finca_id`, `rubro_id`, `valor`, `n_factura`, `observacion`, `tipo`) VALUES
(1, '2019-07-17', 4, 1, 85000, '8744554', 'Ninguna', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_post`
--

CREATE TABLE `gastos_post` (
  `id` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `rubro_id` int(11) NOT NULL,
  `cultivo_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `valor` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos_post`
--

INSERT INTO `gastos_post` (`id`, `finca_id`, `rubro_id`, `cultivo_id`, `fecha`, `n_factura`, `valor`, `observacion`, `tipo`) VALUES
(1, 4, 1, 1, '2019-07-18', '784521', 87000, 'ninguna', 1),
(2, 4, 1, 1, '2019-08-08', '4512178', 450000, 'Este es un presupuesto de un beneficio post cosecha', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `bodega_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `proceso` int(11) NOT NULL,
  `operacion` varchar(128) NOT NULL COMMENT '0 : salida, 1 : entrada, 2:reajuste',
  `cantidad` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `valor_ant` int(11) DEFAULT NULL COMMENT 'solo se coloca cuando se registra una compra por si se borra el registro dejar el valor con el que estaba el insumo',
  `cantidad_ant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `bodega_id`, `fecha`, `proceso`, `operacion`, `cantidad`, `valor`, `valor_ant`, `cantidad_ant`) VALUES
(1, 1, '2019-03-07', 1, '1', 50, 7800, 0, 0),
(2, 2, '2019-07-11', 2, '1', 78, 8000, 0, 0),
(3, 2, '2019-08-09', 14, '0', 25, 0, 8000, 78),
(4, 2, '2019-08-09', 24, '0', 24, 0, 8000, 53),
(5, 2, '2019-08-09', 25, '0', 5, 0, 8000, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `unidad` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insumo`
--

INSERT INTO `insumo` (`id`, `nombre`, `unidad`) VALUES
(729, 'PADAN                                             ', 'Grs'),
(730, 'BURIL                                             ', 'Grs'),
(731, 'CIPERMETRINA                                      ', 'cc'),
(732, 'ZELLUS                                            ', 'Grs'),
(733, 'VERTIMEC                                          ', 'cc'),
(734, 'NUFOS                                             ', 'cc'),
(735, 'HELMTOX                                           ', 'cc'),
(736, 'RIDOMIL                                           ', 'Grs'),
(737, 'PROCLAIM                                          ', 'Grs'),
(738, 'PIRINEX                                           ', 'cc'),
(739, 'YUDO                                              ', 'cc'),
(740, 'ABAMECAL                                          ', 'cc'),
(741, 'LANNATE                                           ', 'cc'),
(742, 'LUFENURON                                         ', 'cc'),
(743, 'VOLIAM FLEXI                                      ', 'cc'),
(744, 'SHARFENTIURON                                     ', 'cc'),
(745, 'KOMPRESSOR                                        ', 'cc'),
(746, 'CONNECT DUO                                       ', 'cc'),
(747, 'ATAKID                                            ', 'Grs'),
(748, 'MAGISTER                                          ', 'cc'),
(749, 'VULCANO                                           ', 'cc'),
(750, 'MAGEOS                                            ', 'Grs'),
(751, 'AMULET                                            ', 'cc'),
(752, 'CYMETRIC                                          ', 'cc'),
(753, 'FURADAN GRANULADO                                 ', 'Grs'),
(754, 'RUGBY 10G                                         ', 'Grs'),
(755, 'LEPECID                                           ', 'cc'),
(756, 'CONFIDOR                                          ', 'cc'),
(757, 'LOCION CABALLO                                    ', 'cc'),
(758, 'KONTAKT                                           ', 'cc'),
(759, 'METAREX                                           ', 'Grs'),
(760, 'JABON INDUSTRIAL                                  ', 'cc'),
(761, 'LASH X 135GRS                                     ', 'Grs'),
(762, 'ASTUTO                                            ', 'cc'),
(763, 'BOLIAN FLEXI                                      ', 'cc'),
(764, 'TROMPA SB                                         ', 'Grs'),
(765, 'FLUMITE                                           ', 'cc'),
(766, 'LEPIMOLT                                          ', 'cc'),
(767, 'NEMAZINC                                          ', 'kgrs'),
(768, 'FIPRONIL                                          ', 'cc'),
(769, 'FULMINATOR                                        ', 'cc'),
(770, 'CIGARAL 70WP                                      ', 'Grs'),
(771, 'EXALT                                             ', 'cc'),
(772, 'BUPROFENSH 25SC                                   ', 'cc'),
(773, 'HELD                                              ', 'cc'),
(774, 'ESTOCADA 90SP                                     ', 'Grs'),
(775, 'LATIGO                                            ', 'cc'),
(776, 'HELOPRID                                          ', 'cc'),
(777, 'CLORPIRICOL                                       ', 'cc'),
(778, 'ENGEO                                             ', 'cc'),
(779, 'MONITOR                                           ', 'cc'),
(780, 'AIKIDO                                            ', 'cc'),
(781, 'GOLPE 5 ME                                        ', 'cc'),
(782, 'EPINGLE EW                                        ', 'cc'),
(783, 'PROAXIS                                           ', 'cc'),
(784, 'PIRESTAR                                          ', 'cc'),
(785, 'APPALUS                                           ', 'cc'),
(786, 'OMI-88                                            ', 'cc'),
(787, 'OBERON                                            ', 'cc'),
(788, 'DINASTIA                                          ', 'cc'),
(789, 'PIRISOLE                                          ', 'cc'),
(790, 'PROFITOX                                          ', 'Grs'),
(791, 'TOTTEM                                            ', 'Grs'),
(792, 'RAFAGA GRANULADO                                  ', 'Grs'),
(793, 'NUVAN                                             ', 'cc'),
(794, 'FENTOPEN 500EC                                    ', 'cc'),
(795, 'ALBATROSS                                         ', 'cc'),
(796, 'PONTO                                             ', 'cc'),
(797, 'BINGO SG                                          ', 'Grs'),
(798, 'KIT BROCA (NUTAR 100GRS + KAISO 30GRS) X CANECA   ', 'Grs'),
(799, 'METHOX                                            ', 'Grs'),
(800, 'SEROK                                             ', 'Grs'),
(801, 'CAYENE                                            ', 'cc'),
(802, 'SUNFIRE                                           ', 'cc'),
(803, 'NUMETRIN                                          ', 'cc'),
(804, 'ABAMECTINA                                        ', 'cc'),
(805, 'SPIRAL                                            ', 'cc'),
(806, 'CIPERLAQ                                          ', 'cc'),
(807, 'PREZA                                             ', 'cc'),
(808, 'FURY 40 E.C                                       ', 'cc'),
(809, 'REGENT                                            ', 'cc'),
(810, 'KARATE                                            ', 'cc'),
(811, 'CANDONGA                                          ', 'cc'),
(812, 'SISTEMÃN                                          ', 'cc'),
(813, 'RIFLE                                             ', 'cc'),
(814, 'PROVADO COMBI                                     ', 'cc'),
(815, 'ARRIERO                                           ', 'Grs'),
(816, 'DANISARABA                                        ', 'cc'),
(817, 'AGRIDOR                                           ', 'cc'),
(818, 'BELT                                              ', 'cc'),
(819, 'MALATHIÃ“N                                         ', 'cc'),
(820, 'BENEFIT                                           ', 'cc'),
(821, 'EVISECT                                           ', 'Grs'),
(822, 'PROCYL                                            ', 'cc'),
(823, 'NILO                                              ', 'cc'),
(824, 'DRACO                                             ', 'cc'),
(825, 'PERSEO                                            ', 'cc'),
(826, 'INVETRINA                                         ', 'cc'),
(827, 'BRIGADA 100EC                                     ', 'cc'),
(828, 'IMPERIUS                                          ', 'cc'),
(829, 'BOREY 300SC                                       ', 'cc'),
(830, 'LORSBAN 4E                                        ', 'cc'),
(831, 'NUMEK                                             ', 'cc'),
(832, 'ABASAC                                            ', 'cc'),
(833, 'CLORPIRIFOS                                       ', 'cc'),
(834, 'PROTEUS                                           ', 'cc'),
(835, 'DECIS                                             ', 'cc'),
(836, 'SEVIN 80                                          ', 'Grs'),
(837, 'DOMINEX                                           ', 'cc'),
(838, 'IMIDOGEN                                          ', 'cc'),
(839, 'CARBOFURAN                                        ', 'cc'),
(840, 'BROJOTA                                           ', 'cc'),
(841, 'LORSBAN POLVO                                     ', 'Grs'),
(842, 'ELTRA                                             ', 'cc'),
(843, 'METHAVIN                                          ', 'Grs'),
(844, 'IMAPRID                                           ', 'cc'),
(845, 'PILARMATE                                         ', 'Grs'),
(846, 'FURADAN LIQUIDO                                   ', 'cc'),
(847, 'ATTA KILL                                         ', 'Grs'),
(848, 'GEMINIS                                           ', 'Grs'),
(849, 'BAYTROIDE                                         ', 'cc'),
(850, 'MATABABOSAS                                       ', 'Grs'),
(851, 'MITAC                                             ', 'cc'),
(852, 'RAFAGA                                            ', 'cc'),
(853, 'POLYTHION                                         ', 'cc'),
(854, 'DANTOTSU                                          ', 'cc'),
(855, 'LARVIN                                            ', 'cc'),
(856, 'EFECTRINA                                         ', 'cc'),
(857, 'MICROESSENTIAL                                    ', 'BULTO x 50'),
(858, 'TERRA SORB RADICULAR                              ', 'cc'),
(859, 'CALCIPHITE                                        ', 'cc'),
(860, 'AGRIMINS GRANULADO                                ', 'BULTO X 46KG'),
(861, '25-15-0-2-3                                       ', 'BULTO x 50'),
(862, '15-4-23-4                                         ', 'BULTO x 50'),
(863, 'MULTI NPK                                         ', 'Grs'),
(864, 'ROOTEX                                            ', 'Grs'),
(865, 'TOTTAL                                            ', 'cc'),
(866, 'NITROFER MAGNESIO                                 ', 'BULTO x 50'),
(867, 'FERTIGRO                                          ', 'cc'),
(868, 'SOLUFOX                                           ', 'Kg'),
(869, '25-4-24                                           ', 'BULTO x 50'),
(870, 'COSMOQUEL                                         ', 'Grs'),
(871, 'HUMUS LIQUIDO NOVATERRA                           ', 'cc'),
(872, 'MEJISULMAC P                                      ', 'Kg'),
(873, 'NITRAX                                            ', 'BULTO x 50'),
(874, 'BIO Q SC                                          ', 'cc'),
(875, 'GO UP                                             ', 'cc'),
(876, 'ATP UP                                            ', 'cc'),
(877, 'ALFA PROTEIN                                      ', 'cc'),
(878, '17-6-18-4.4-2.8 TRADICION CAFETERA YARA           ', 'BULTO x 50'),
(879, 'SOLUCAT 10-52-10                                  ', 'Grs'),
(880, 'POLIQUEL CALCIO                                   ', 'cc'),
(881, 'BOROLIQ                                           ', 'cc'),
(882, 'WUXAL TAPA NEGRA                                  ', 'cc'),
(883, 'SUL.MANGANESO MICROFERTIZA                        ', 'Bts x 20'),
(884, 'CAL HARD                                          ', 'cc'),
(885, 'HUMIAGRO                                          ', 'cc'),
(886, 'MAINSTAY CALCIO                                   ', 'cc'),
(887, '13.5-6.4-21.4-7MG-8.6S+ZINC                       ', 'BULTO x 50'),
(888, 'LOMBRICOL FOE-01                                  ', 'cc'),
(889, 'FOSFATO MONOAMONICO                               ', 'Grs'),
(890, 'KCL STANDAR                                       ', 'BULTO x 50'),
(891, 'SULCATEC (SULFATO DE POTACIO)                     ', 'Grs'),
(892, 'PLATANERO 11-5-27-7-9                             ', 'BULTO x 50'),
(893, 'COSMO R-14                                        ', 'Grs'),
(894, 'SELECTO                                           ', 'cc'),
(895, 'SIFOL                                             ', 'Grs'),
(896, 'TRAZEX MENORES                                    ', 'Grs'),
(897, 'CALFERMAGNESIO                                    ', 'Kg'),
(898, '22-3-20 ESPECIAL                                  ', 'Bts'),
(899, 'NUTRIPLEX 10-55-10                                ', 'Grs'),
(900, 'GLUCOKEL MAGNESIO                                 ', 'cc'),
(901, 'TERRA VITE                                        ', 'cc'),
(902, 'AGROFAST                                          ', 'cc'),
(903, 'KEYLATE MAGNESIO                                  ', 'cc'),
(904, 'NUTRIFOLIAR                                       ', 'cc'),
(905, 'FOSCROP                                           ', 'cc'),
(906, 'WUXAL TAPA VERDE                                  ', 'cc'),
(907, 'SECUESTRANTE                                      ', 'Grs'),
(908, '10-3-26-9-6                                       ', 'BULTO x 50'),
(909, 'AMINOACIDOS                                       ', 'cc'),
(910, 'KRISTA KP 13-3-43                                 ', 'BULTO x 50'),
(911, 'AGROCAFE 25-4-24                                  ', 'Bts'),
(912, '17-6-18-6-7 MEZCLA ESPECIAL                       ', 'BULTO x 50'),
(913, 'CAMPOFOS                                          ', 'Grs'),
(914, 'SILIKHUM                                          ', 'cc'),
(915, 'MICROFERTIL                                       ', 'Bts'),
(916, 'K-FOL                                             ', 'Grs'),
(917, 'FOLTRON                                           ', 'cc'),
(918, 'KELATEX CALCIO                                    ', 'Grs'),
(919, '16.5-6.9-23.4-4.4MG-5.3S+ZINC                     ', 'BULTO x 50'),
(920, 'STIMULATE 50                                      ', 'cc'),
(921, 'OMEX K                                            ', 'cc'),
(922, 'CALCINIT                                          ', 'Bts x 50'),
(923, 'ACIDO FOSFORICO 85% (35KG-17LTS)                  ', 'cc'),
(924, '13-26-10-3                                        ', 'Bts x 50'),
(925, 'RAIZAL                                            ', 'Grs'),
(926, 'HORMONAGRO 1                                      ', 'Grs'),
(927, 'HORMONAGRO 2                                      ', 'cc'),
(928, 'MICORRIZAFER                                      ', 'bulto x 10 kilos'),
(929, 'NITRATO DE POTASIO                                ', 'Bts x 50'),
(930, 'SULFATO DE MAGNESIO                               ', 'Grs'),
(931, 'KORN KALI                                         ', 'Bts x 50'),
(932, 'SULCAMAG                                          ', 'Bts x 50'),
(933, 'HIDROBORO                                         ', 'Bts x 50'),
(934, 'VICOR                                             ', 'Grs'),
(935, 'DHAFOS                                            ', 'Bts x 50'),
(936, 'KIESERSIN-P                                       ', 'Grs'),
(937, 'SOLUN K-P                                         ', 'Bts x 50'),
(938, 'K-ZINC                                            ', 'Bts x 20'),
(939, 'KIESERITA                                         ', 'Bts x 50'),
(940, 'FERTIBORO                                         ', 'Grs'),
(941, 'HIDRAM                                            ', 'Bts x 50'),
(942, 'SAL BLANCA                                        ', 'Grs'),
(943, 'NITRAFOS                                          ', 'Grs'),
(944, 'RAFOS                                             ', 'Bts x 50'),
(945, 'KAFE CALDAS                                       ', 'Bts x 50'),
(946, 'FOLIAGRICOL DESARROLLO                            ', 'Grs'),
(947, 'LEVANTE                                           ', 'Bts x 50'),
(948, 'MEJISULMAG                                        ', 'btos. 40'),
(949, 'K-BOR                                             ', 'Bts x 20'),
(950, 'BIOPLANT                                          ', 'cc'),
(951, 'CAL                                               ', 'Grs'),
(952, 'KELATEX ZINC                                      ', 'Grs'),
(953, 'MANGANESO                                         ', 'Bts x 20'),
(954, 'COSMO ION BORO                                    ', 'Grs'),
(955, 'ANA BOR                                           ', 'cc'),
(956, 'BORPAG                                            ', 'cc'),
(957, 'MICORRIZA                                         ', 'Bts x 50'),
(958, 'CAL DOLOMITA                                      ', 'Bts x 50'),
(959, 'D.A.P.                                            ', 'BULTO x 50'),
(960, 'AMIGO                                             ', 'Bts x 50'),
(961, 'KCL                                               ', 'BULTO x 50'),
(962, 'ZIMPROG                                           ', 'cc'),
(963, 'BIOSOL                                            ', 'Grs'),
(964, 'NITRABOR                                          ', 'BULTO x 50'),
(965, 'HIPOTENSOR                                        ', 'cc'),
(966, 'ION FOS K                                         ', 'cc'),
(967, 'CODIPHOS                                          ', 'Bts x 50'),
(968, 'SOP                                               ', 'Bts x 50'),
(969, 'BORO                                              ', 'Grs'),
(970, 'SULFATO DE ZINC                                   ', 'Bts x 20'),
(971, 'MICROZIN                                          ', 'Bts x 20'),
(972, 'SAM                                               ', 'Bts x 50'),
(973, 'FITOLEX                                           ', 'cc'),
(974, '17-6-18-2                                         ', 'Bts x 50'),
(975, 'UREA                                              ', 'Bts x 50'),
(976, '15-4-24                                           ', 'Bts x 50'),
(977, 'NITRASAM                                          ', 'Bts x 50'),
(978, 'NUTRISOB                                          ', 'cc'),
(979, 'ELEMENTOS MENORES                                 ', 'kgrs'),
(980, 'BORAX TECNICO                                     ', 'Kg'),
(981, 'KELATEX MANGANESO                                 ', 'Grs'),
(982, 'SULFATO DE AMONIO                                 ', 'Bts x 50'),
(983, '40481', 'Bts x 50'),
(984, 'POLIQUIUR                                         ', 'cc'),
(985, 'KELMIX                                            ', 'bultos x 46'),
(986, 'ABOTEK                                            ', 'Bts x 50'),
(987, 'FERTIMENORES                                      ', 'Bts x 50'),
(988, 'AGRIMIN                                           ', 'Bts x 50'),
(989, 'TECNO VERDE                                       ', 'cc'),
(990, 'MAGNESERITA                                       ', 'Bts x 50'),
(991, 'HUMIFLUID                                         ', 'cc'),
(992, 'PHOSTROL                                          ', 'cc'),
(993, 'BORIC ACID                                        ', 'bultos x 25'),
(994, 'KELAG CALCIO                                      ', 'kgrs'),
(995, 'MAGNESIL                                          ', 'Bts x 50'),
(996, 'BIO ROOT                                          ', 'cc'),
(997, 'BOROSOL                                           ', 'Grs'),
(998, 'BORO CALCIO                                       ', 'cc'),
(999, 'CALFERZINC                                        ', 'Bts x 20'),
(1000, 'REMITAL                                           ', 'Bts x 50'),
(1001, 'NITROFER CALCIO                                   ', 'Kg'),
(1002, 'MEJIMENORES                                       ', 'Kg'),
(1003, 'DITHANE                                           ', 'cc'),
(1004, 'COSECHANDO                                        ', 'cc'),
(1005, 'COPRISOL                                          ', 'cc'),
(1006, 'AGROSIN ZEO                                       ', 'btos. 40'),
(1007, 'VUSAR                                             ', 'Grs'),
(1008, 'POLIQUEL MULTI                                    ', 'cc'),
(1009, 'BOROGRAN                                          ', 'Grs'),
(1010, 'WASA                                              ', 'cc'),
(1011, '14-4-23-4                                         ', 'Bts x 50'),
(1012, 'ENMIENTRA TRIPLE 30                               ', 'Bts x 50'),
(1013, 'MAN CROP                                          ', 'Grs'),
(1014, 'NUTRIFEED                                         ', 'Grs'),
(1015, 'CAB                                               ', 'Grs'),
(1016, 'PRODUCCION                                        ', 'Bts x 50'),
(1017, 'CODIPAN                                           ', 'Grs'),
(1018, 'GLUCOKEL ZINC                                     ', 'cc'),
(1019, 'MASAI                                             ', 'cc'),
(1020, 'MICROFULL                                         ', 'Bts x 46'),
(1021, 'PROGIMM                                           ', 'Grs'),
(1022, 'TRICHOFOL                                         ', 'cc'),
(1023, 'YARAMILA                                          ', 'Bts x 50'),
(1024, 'VOLPAG                                            ', 'cc'),
(1025, 'SULFAMON                                          ', 'Bts x 50'),
(1026, 'MAGNESIO                                          ', 'Bts x 50'),
(1027, 'KIMEL GRANULADO                                   ', 'kgrs'),
(1028, 'KLIP K                                            ', 'cc'),
(1029, 'SULF.MANGANESO TECMAGAN                           ', 'bultos x 25'),
(1030, 'BORO FORIAREL                                     ', 'Bts x 20'),
(1031, 'BORO CATERQUIM                                    ', 'Bts x 20'),
(1032, 'MAGNESIO TECNICO                                  ', 'Bts x 50'),
(1033, 'MATERIA ORGANICA                                  ', 'kgrs'),
(1034, 'CUBOZINC (BOROZINCO)                              ', 'Kg'),
(1035, '15-15-15                                          ', 'BULTO x 50'),
(1036, 'MICROMAGNESIO                                     ', 'Kg'),
(1037, 'BOROZINCO LIQUIDO                                 ', 'cc'),
(1038, 'B TIMIN                                           ', 'Grs'),
(1039, 'FRUTOKA                                           ', 'Grs'),
(1040, 'FOSFATO MONOPOTASICO                              ', 'Kg'),
(1041, 'ZINC MAYQA                                        ', 'cc'),
(1042, 'OXIDO DE MAGNESIO                                 ', 'BULTO x 50'),
(1043, 'ZINCOFERTIL (BOROZINCO)                           ', 'Kg'),
(1044, 'AGRIMINS TOTTAL INICIO                            ', 'BULTO x 50'),
(1045, '44124', 'BULTO x 50'),
(1046, 'AGRIMINS TOTTAL CAFETERO                          ', 'BULTO x 50'),
(1047, '40478', 'BULTO x 50'),
(1048, '13-6-23 CON NITROEXTEND                           ', 'BULTO x 50'),
(1049, 'HUMITA 15                                         ', 'cc'),
(1050, 'HUMUS ALFA                                        ', 'cc'),
(1051, 'REBROTE                                           ', 'Kg'),
(1052, 'ZINCOBOR                                          ', 'cc'),
(1053, '20-3-19 + MENORES CON NITROEXTEND                 ', 'BULTO x 50'),
(1054, '11-22-5 + MENORES                                 ', 'BULTO x 50'),
(1055, 'CAMPOFERT NK580                                   ', 'BULTO x 50'),
(1056, 'KEYLATE ZINC                                      ', 'cc'),
(1057, 'KELIK POTASIO                                     ', 'cc'),
(1058, 'NUTRIPLEX 5-5-45                                  ', 'Grs'),
(1059, '13.9 - 5 - 26.7+4.9MG + 6S + 0.01ZN PRECISAGRO    ', 'BULTO x 50'),
(1060, '15.3 - 4.9 - 26.4 + 4.3MGO + 5.2S + 0.03ZN        ', 'BULTO x 50'),
(1061, '19.5 - 23 - 0 + 12S                               ', 'BULTO x 50'),
(1062, 'NITROCROP 23                                      ', 'cc'),
(1063, 'STOLLER COOPER                                    ', 'cc'),
(1064, 'ROOT FEED                                         ', 'Grs'),
(1065, 'MICROKEL BORO                                     ', 'cc'),
(1066, 'DKP 500                                           ', 'cc'),
(1067, 'FOSFITEK GOLD POTASIO                             ', 'Grs'),
(1068, 'MICROKEL ZINC                                     ', 'Grs'),
(1069, 'AS PROTECCION                                     ', 'cc'),
(1070, 'VICOR 3                                           ', 'BULTO X 46KG'),
(1071, 'NOVAPLANT CA+B+ZN                                 ', 'cc'),
(1072, 'KLIP BORO                                         ', 'Grs'),
(1073, 'FLOWER POWER                                      ', 'cc'),
(1074, 'GLUCOKEL MOLIBDENO                                ', 'cc'),
(1075, 'HUMINOVA                                          ', 'cc'),
(1076, 'SULFEX MAGNESIO                                   ', 'Kg'),
(1077, 'FITOKAL B                                         ', 'cc'),
(1078, 'CEROSSTRES                                        ', 'cc'),
(1079, 'MICROKEL MAGNESIO                                 ', 'Grs'),
(1080, 'AGRIMINS K CA B                                   ', 'cc'),
(1081, 'NUTRICOLJAP                                       ', 'BULTO X 46KG'),
(1082, 'TRIADAMIN                                         ', 'cc'),
(1083, 'VP 80                                             ', 'Grs'),
(1084, 'PROMIFERTIL                                       ', 'cc'),
(1085, '41267', 'BULTO x 50'),
(1086, 'COLJAP ZINC                                       ', 'Grs'),
(1087, 'AGRO-K                                            ', 'Grs'),
(1088, 'RETOÃ‘O                                            ', 'Grs'),
(1089, 'NITROCALCIO+B                                     ', 'Grs'),
(1090, '15-3-30 + MENORES                                 ', 'BULTO x 50'),
(1091, 'RUTER                                             ', 'cc'),
(1092, '15-5-25 + MENORES                                 ', 'BULTO x 50'),
(1093, '16-16-16                                          ', 'BULTO x 50'),
(1094, '45332', 'BULTO x 50'),
(1095, 'K-LLENADO                                         ', 'cc'),
(1096, '38681', 'BULTO x 50'),
(1097, 'EMBAJADOR                                         ', 'BULTO x 50'),
(1098, 'SOLUKATEC                                         ', 'BULTO X 25 KILOS'),
(1099, 'NITROMAG                                          ', 'BULTO x 50'),
(1100, 'ZINTRAC                                           ', 'cc'),
(1101, 'AZUTEK                                            ', 'BULTO x 50'),
(1102, '40512', 'Grs'),
(1103, 'MICRORRIEGO CALCIO MAGNESIO                       ', 'cc'),
(1104, '20-4-19+MENORES Y NITROEXTEND                     ', 'BULTO x 50'),
(1105, '15 - 9 -20                                        ', 'BULTO x 50'),
(1106, 'FOSFOSTRESS                                       ', 'cc'),
(1107, 'ZINC TIP                                          ', 'cc'),
(1108, 'KELASYS MANGANESO                                 ', 'Grs'),
(1109, 'FOTOSINT                                          ', 'cc'),
(1110, 'MAGIC PLUS                                        ', 'cc'),
(1111, 'AGROSTIM                                          ', 'cc'),
(1112, '11251', 'BULTO x 50'),
(1113, 'MICRORRIEGO MENORES                               ', 'Kg'),
(1114, 'FOSKAPRIN                                         ', 'cc'),
(1115, 'HALCON RADICULAR                                  ', 'BULTO X 46KG'),
(1116, 'TRICHOCAL BORO                                    ', 'cc'),
(1117, 'NUTRISTIM CALCIO                                  ', 'cc'),
(1118, 'SOLUPLANT KLLENADO                                ', 'cc'),
(1119, '13-3-23-9                                         ', 'BULTO x 50'),
(1120, 'COMCAT                                            ', 'Grs'),
(1121, 'MEJICORRECTIO CA POLVO                            ', 'BULTO x 50'),
(1122, 'UAN 32                                            ', 'cc'),
(1123, 'POLIQUEL MAGNESIO                                 ', 'cc'),
(1124, '14-5-25 + MENORES SULFATO DE POTASIO              ', 'BULTO x 50'),
(1125, '19-4-19 + NITROXTEN                               ', 'BULTO x 50'),
(1126, 'SOLUPOTASSE                                       ', 'Kg'),
(1127, 'FORGE                                             ', 'cc'),
(1128, '19.6 -6,8 -20.5 +3, 9MG -4.7S +WOLFTRAX ZINC      ', 'BULTO x 50'),
(1129, 'HUMUS LIQ. NOVATERRA FERTIGRO                     ', 'cc'),
(1130, '18.4 -8.2 - 22.1 +3.3MGO -4S + WOLFTRAX ZINC      ', 'BULTO x 50'),
(1131, 'FORMADOR                                          ', 'cc'),
(1132, 'BORTRAC                                           ', 'cc'),
(1133, 'CABTRAC                                           ', 'cc'),
(1134, 'M.A.P                                             ', 'BULTO x 50'),
(1135, 'GLOBAFOL                                          ', 'cc'),
(1136, 'SULFEX ZINC                                       ', 'Kg'),
(1137, 'NITRATO DE MAGNESIO                               ', 'cc'),
(1138, 'NUTRIPLEX 20-20-20                                ', 'Grs'),
(1139, 'SULFATO DE POTACIO                                ', 'BULTO x 50'),
(1140, 'KELATEX HIERRO                                    ', 'Grs'),
(1141, 'INTEGRADOR YARA                                   ', 'BULTO x 50'),
(1142, 'SOLUFOS                                           ', 'Grs'),
(1143, 'NUTRIPLEX 30-10-10                                ', 'Grs'),
(1144, 'OMEX BIO 8                                        ', 'cc'),
(1145, 'KELATEX MAGNESIO                                  ', 'Grs'),
(1146, 'ZINCPROD                                          ', 'cc'),
(1147, 'KELATEX COBRE                                     ', 'Grs'),
(1148, 'MENORES FRUTALES                                  ', 'Kg'),
(1149, 'MICROSEM X 46KG                                   ', 'BULTO X 46KG'),
(1150, 'BOROZINCO                                         ', 'Kg'),
(1151, '19-6-21                                           ', 'BULTO x 50'),
(1152, 'EPSOTOP                                           ', 'Kg'),
(1153, 'NATIVO                                            ', 'cc'),
(1154, 'RIDUDOR                                           ', 'cc'),
(1155, 'CLOROX                                            ', 'Grs'),
(1156, 'CROPISOL                                          ', 'cc'),
(1157, 'PREVALOR                                          ', 'cc'),
(1158, 'DEROSAL                                           ', 'cc'),
(1159, 'CIVIS CARBENDAZIM                                 ', 'cc'),
(1160, 'CERAQUINT                                         ', 'Grs'),
(1161, 'SPORTAK                                           ', 'cc'),
(1162, 'TINNER                                            ', 'cc'),
(1163, 'TRECATOL                                          ', 'Grs'),
(1164, 'ALTO 100                                          ', 'cc'),
(1165, 'MIDAS                                             ', 'Grs'),
(1166, 'COBRETHANE                                        ', 'Grs'),
(1167, 'TRIVIA                                            ', 'Grs'),
(1168, 'SCORE                                             ', 'cc'),
(1169, 'ACUAPHYTE                                         ', 'cc'),
(1170, 'SHARBENDAZOLE                                     ', 'cc'),
(1171, 'ATLAS                                             ', 'cc'),
(1172, 'ORTHOCIDE 50%                                     ', 'Grs'),
(1173, 'DIFECOL 250 EC  X 1 LITRO                         ', 'cc'),
(1174, 'CARBENCAL                                         ', 'cc'),
(1175, 'BENLATE                                           ', 'Grs'),
(1176, 'AGUILA                                            ', 'Grs'),
(1177, 'CALIDAN                                           ', 'cc'),
(1178, 'INFINITO                                          ', 'cc'),
(1179, 'MIRAGE                                            ', 'cc'),
(1180, 'SIGANEX                                           ', 'cc'),
(1181, 'MAKIO 500                                         ', 'cc'),
(1182, 'BELICO                                            ', 'cc'),
(1183, 'TILT                                              ', 'cc'),
(1184, 'FORDAZIM                                          ', 'cc'),
(1185, 'GRADUS                                            ', 'cc'),
(1186, 'HELMTIOFAN                                        ', 'cc'),
(1187, 'AGRODINE                                          ', 'cc'),
(1188, 'CROPZIM 500                                       ', 'cc'),
(1189, 'CONTROL 720                                       ', 'cc'),
(1190, 'ELOSAL                                            ', 'cc'),
(1191, 'NUPOXIN                                           ', 'cc'),
(1192, 'ASPEN                                             ', 'cc'),
(1193, 'AZIMUT                                            ', 'cc'),
(1194, 'MANZATE                                           ', 'Grs'),
(1195, 'ESTRUENDO                                         ', 'cc'),
(1196, 'AMISTAR TOP                                       ', 'cc'),
(1197, 'FOSTAL                                            ', 'Grs'),
(1198, 'FOSTAL LIQUIDO                                    ', 'cc'),
(1199, 'FITORAZ                                           ', 'Grs'),
(1200, 'COLIZYM                                           ', 'cc'),
(1201, 'CABRIOTOP                                         ', 'Grs'),
(1202, 'MAESTRO                                           ', 'Grs'),
(1203, 'AGRIFOS                                           ', 'cc'),
(1204, 'OPUS                                              ', 'cc'),
(1205, 'HELMISTIN                                         ', 'cc'),
(1206, 'PROFOL                                            ', 'cc'),
(1207, 'COMET                                             ', 'cc'),
(1208, 'ALLIET                                            ', 'Grs'),
(1209, 'YODO SAFER                                        ', 'cc'),
(1210, 'PROPICAL                                          ', 'cc'),
(1211, 'IMPACT                                            ', 'cc'),
(1212, 'HELCOZEB                                          ', 'Grs'),
(1213, 'BENOAGRO                                          ', 'cc'),
(1214, 'MANCOL                                            ', 'cc'),
(1215, 'RALLY 40W                                         ', 'Grs'),
(1216, 'MERTEC                                            ', 'cc'),
(1217, 'CARBENDAZIM                                       ', 'cc'),
(1218, 'PROPICONAZOLE                                     ', 'cc'),
(1219, 'ELICIT 80                                         ', 'Grs'),
(1220, 'RHODAX                                            ', 'Grs'),
(1221, 'BENOPOINT                                         ', 'Grs'),
(1222, 'ANTRACOL                                          ', 'Grs'),
(1223, 'SILVACUR                                          ', 'cc'),
(1224, 'OXICLORURO DE COBRE                               ', 'Grs'),
(1225, 'BENOMYL                                           ', 'Grs'),
(1226, 'BAYFIDAN                                          ', 'cc'),
(1227, 'ALLEATO                                           ', 'Grs'),
(1228, 'PREDOSTAR                                         ', 'Grs'),
(1229, 'ARRAY 200EC                                       ', 'cc'),
(1230, 'YODO AGRICOLA                                     ', 'cc'),
(1231, 'VITAVAX                                           ', 'Grs'),
(1232, 'BASAMID                                           ', 'Grs'),
(1233, 'ANTICORROSIVO                                     ', 'cc'),
(1234, 'VINILO                                            ', 'cc'),
(1235, 'FORMOL                                            ', 'cc'),
(1236, 'ROVRAL                                            ', 'cc'),
(1237, 'KORASA                                            ', 'cc'),
(1238, 'OXICOB                                            ', 'Grs'),
(1239, 'AUTHORITY                                         ', 'cc'),
(1240, 'TOPGUN                                            ', 'cc'),
(1241, 'CUPROFIX                                          ', 'Grs'),
(1242, 'CANTUS WG                                         ', 'Grs'),
(1243, 'SIGAZOL                                           ', 'cc'),
(1244, 'ZIRAM X 750 GRS                                   ', 'Grs'),
(1245, 'TITAN 80                                          ', 'Grs'),
(1246, 'BAYLETON                                          ', 'cc'),
(1247, 'OPERA SC                                          ', 'cc'),
(1248, 'CUMBRE WT                                         ', 'Grs'),
(1249, 'CRISTAL FUNGI.BACT                                ', 'cc'),
(1250, 'CUSPIDE 480                                       ', 'cc'),
(1251, 'FAENA                                             ', 'cc'),
(1252, 'GLYFOS                                            ', 'cc'),
(1253, 'REGLONE                                           ', 'cc'),
(1254, 'DIRVO                                             ', 'Grs'),
(1255, 'GRANTIK                                           ', 'cc'),
(1256, 'DESTIERRO                                         ', 'cc'),
(1257, 'QUEMAZONE                                         ', 'cc'),
(1258, 'GLIFOSOL                                          ', 'cc'),
(1259, 'ARRASADOR                                         ', 'Grs'),
(1260, 'ZULU                                              ', 'cc'),
(1261, 'GOAL                                              ', 'cc'),
(1262, 'NAVAJO                                            ', 'Grs'),
(1263, 'EUREKA 60WG (METSULFURON)                         ', 'Grs'),
(1264, 'TROTON                                            ', 'cc'),
(1265, 'PLEDGE                                            ', 'Grs'),
(1266, 'AGROPIRIFOS 480EC                                 ', 'cc'),
(1267, 'ROUND UP                                          ', 'cc'),
(1268, 'HEAT                                              ', 'Grs'),
(1269, 'PANZER 480                                        ', 'cc'),
(1270, 'GLIPHOGAN                                         ', 'cc'),
(1271, 'AMINA                                             ', 'cc'),
(1272, 'ESCORPION                                         ', 'cc'),
(1273, 'GUADAÃ‘A 75WG                                      ', 'Grs'),
(1274, 'DUNKAN                                            ', 'cc'),
(1275, 'PARTNER 50 WP                                     ', 'Grs'),
(1276, 'ALLY                                              ', 'cc'),
(1277, 'TORDON                                            ', 'cc'),
(1278, 'CALLIQUAT                                         ', 'cc'),
(1279, 'GLIFOCAFÃ‰                                         ', 'cc'),
(1280, 'VERDICT                                           ', 'cc'),
(1281, 'METSULFURON+PICLORAM VECOL 267CC                  ', 'cc'),
(1282, 'TOUCH DOWN                                        ', 'cc'),
(1283, 'METSULFURON METYL VERDE                           ', 'Grs'),
(1284, 'PASTAR                                            ', 'cc'),
(1285, 'ROUND UP 747                                      ', 'Grs'),
(1286, 'KOLTAR                                            ', 'cc'),
(1287, 'GLUFOMAX                                          ', 'cc'),
(1288, 'SOCIO                                             ', 'Grs'),
(1289, 'METSUAGRO 600                                     ', 'Grs'),
(1290, 'FINALE                                            ', 'cc'),
(1291, 'ACCURATE                                          ', 'Grs'),
(1292, 'GALIGAN                                           ', 'cc'),
(1293, 'GLIFOLAG                                          ', 'cc'),
(1294, 'DANIR                                             ', 'cc'),
(1295, 'HELMOXONE 200SL                                   ', 'cc'),
(1296, 'PARAQUAT                                          ', 'cc'),
(1297, 'SAFARI 200                                        ', 'cc'),
(1298, 'FOSSEL + CICLON                                   ', 'cc'),
(1299, 'GLIFOGEN 648                                      ', 'cc'),
(1300, 'HELOSATE                                          ', 'cc'),
(1301, 'BELGRAN 60 WG                                     ', 'Grs'),
(1302, 'KALLAD                                            ', 'Grs'),
(1303, 'AGRATEX                                           ', 'cc'),
(1304, 'CARRIER                                           ', 'cc'),
(1305, 'INEX-A                                            ', 'cc'),
(1306, 'COOLPROTEC                                        ', 'Grs'),
(1307, 'COSMO-OIL                                         ', 'cc'),
(1308, 'SILVERADO                                         ', 'cc'),
(1309, 'COSMOAGUAS                                        ', 'Grs'),
(1310, 'ALIO                                              ', 'cc'),
(1311, 'SILWET 77 AG                                      ', 'cc'),
(1312, 'REDUX                                             ', 'cc'),
(1313, 'MIEL DE PURGA                                     ', 'cc'),
(1314, 'SINERGY                                           ', 'cc'),
(1315, 'PEGAL PH                                          ', 'cc'),
(1316, 'ACEITE MINERAL                                    ', 'cc'),
(1317, 'SILICONADO                                        ', 'cc'),
(1318, 'ADHERENTE                                         ', 'cc'),
(1319, 'FERTIAQUA                                         ', 'cc'),
(1320, 'BANOLE                                            ', 'cc'),
(1321, 'AKUAPLANT                                         ', 'cc'),
(1322, 'COSMO FLUX                                        ', 'cc'),
(1323, 'MIXEL TOP                                         ', 'cc'),
(1324, 'VINAGRE                                           ', 'cc'),
(1325, 'ACUASYS                                           ', 'Grs'),
(1326, 'NATURAL OIL                                       ', 'cc'),
(1327, 'PEGAL                                             ', 'cc'),
(1328, 'BANACLEAN                                         ', 'cc'),
(1329, 'ARPON                                             ', 'cc'),
(1330, 'PEGAL PROTECT                                     ', 'Grs'),
(1331, 'MICOSPLAG                                         ', 'Grs'),
(1332, 'CAPSIALIL                                         ', 'cc'),
(1333, 'METARHIZIUM                                       ', 'Grs'),
(1334, 'BACTNONSC                                         ', 'cc'),
(1335, 'TRICHOGRAMA                                       ', 'pulgadas'),
(1336, 'BROCARIL                                          ', 'Grs'),
(1337, 'MICOBAC                                           ', 'Grs'),
(1338, 'CRYSOPAS                                          ', 'individuos'),
(1339, 'BAUVERIA METHARIZIUM                              ', 'Grs'),
(1340, 'AGROMIX                                           ', 'Grs'),
(1341, 'MYCOBAC                                           ', 'Grs'),
(1342, 'BAUVERIA METHARIZIUM LECANICILIUM                 ', 'Grs'),
(1343, 'LECOMIX                                           ', 'cc'),
(1344, 'VERTICILLIUM LECANI                               ', 'Grs'),
(1345, 'TRICHO D                                          ', 'Grs'),
(1346, 'TRICHODERMA                                       ', 'Grs'),
(1347, 'AGRONOVA (BAUVERIA)                               ', 'Grs'),
(1348, 'METATROPICO (METARHIZIUM)                         ', 'Grs'),
(1349, 'PAECILOMYCES                                      ', 'Grs'),
(1350, 'FEACILOMYCES                                      ', 'Grs'),
(1351, 'TIMOREX                                           ', 'cc'),
(1352, 'TRICHOTROPICO                                     ', 'Grs'),
(1353, 'RHAPSODY                                          ', 'cc'),
(1354, 'BLIZ                                              ', 'Grs'),
(1355, 'PROPHYTEX                                         ', 'cc'),
(1356, 'DIPEL                                             ', 'Grs'),
(1357, 'SAFERSOIL                                         ', 'Grs'),
(1358, 'TROPIMEZCLA                                       ', 'Grs'),
(1359, 'HONGO BROCA                                       ', 'Grs'),
(1360, 'BOLIS BROCA                                       ', 'UNIDAD'),
(1361, 'BIOTRAMPA                                         ', 'cc'),
(1362, 'LECANICILLIUM LECANY                              ', 'Grs'),
(1363, 'BOVERTROPICO WP                                   ', 'Grs'),
(1364, 'BEAUVERIA BASSIANA                                ', 'Grs'),
(1365, 'E.M.                                              ', 'cc'),
(1366, 'FACELOMICES                                       ', 'Grs'),
(1367, 'PLASTICO                                          ', 'METROS'),
(1368, 'BACTOX                                            ', 'Grs'),
(1369, 'GASOLINA                                          ', 'GalÃ³n'),
(1370, 'A.C.P.M.                                          ', 'GalÃ³n'),
(1371, 'ACEITE TT                                         ', 'cc'),
(1372, 'ACEITE BOS                                        ', 'cc'),
(1373, 'ACEITE 20 W 40                                    ', 'cc'),
(1374, 'SAL 8%                                            ', 'Grs'),
(1375, 'SILICON                                           ', 'cc'),
(1376, 'HIDROXIDO DE CALCIO MALLA 320                     ', 'Kg'),
(1377, 'PEGAL V OIL                                       ', 'cc'),
(1378, 'COSMO SORB                                        ', 'Grs'),
(1379, 'CAL 40                                            ', 'cc'),
(1380, 'FOSFORITA                                         ', 'Kg'),
(1381, 'PROGIBB                                           ', 'Grs'),
(1382, 'SAL 6%                                            ', 'Bts'),
(1383, 'BOLSA PLATANO                                     ', 'Un'),
(1384, 'FIBRA                                             ', 'Un'),
(1385, 'SILICATO DE MAGNESIO                              ', 'BULTO x 50'),
(1386, 'ARBOLES AGUACATE PAPELILLO                        ', 'Un'),
(1387, 'HILO FIQUE                                        ', 'ROLLO'),
(1388, 'FIBRA BANANERA                                    ', 'Un'),
(1389, 'CINTAS PLATANO                                    ', 'Un'),
(1390, 'BOLSA ALMACIGO CAFE                               ', 'Un'),
(1391, 'COLBON                                            ', 'cc'),
(1392, 'ARBOLES AGUACATE LORENA                           ', 'Un'),
(1393, 'BIOSTAT                                           ', 'Grs'),
(1394, 'SOGA BANANERA                                     ', 'ROLLO'),
(1395, 'OPTIWATER                                         ', 'cc'),
(1396, 'GRAMAFIN                                          ', 'cc'),
(1397, 'BOLSA BANANO                                      ', 'Un'),
(1398, 'MASILLA                                           ', 'kgrs'),
(1399, 'PINTURA                                           ', 'GalÃ³n'),
(1400, 'SARAN                                             ', 'METROS'),
(1401, 'HIDROQUIPER                                       ', 'Grs'),
(1402, 'BACTHON                                           ', 'cc'),
(1403, 'TORAM                                             ', 'cc'),
(1404, 'ARBOLES LIMON TAHITY                              ', 'Un'),
(1405, 'ACONDICIONADOR DE AGUAS                           ', 'Grs'),
(1406, 'BOLSA AGUACATE                                    ', 'bolsa'),
(1407, 'SANIT T-10                                        ', 'cc'),
(1408, 'BOLSA PLASTICA                                    ', 'bolsa'),
(1409, 'ARBOLES AGUACATE HASS                             ', 'Un'),
(1410, 'ARBOLES AGUACATE SEMILL 40                        ', 'Un'),
(1411, 'BASE LIMPIDO                                      ', 'cc'),
(1412, 'NU FILM                                           ', 'cc'),
(1413, 'YESO                                              ', 'Bts x 50'),
(1414, 'CINTA                                             ', 'METROS'),
(1415, 'ESPECIFICO                                        ', 'cc'),
(1416, 'HYDROGEL                                          ', 'Grs'),
(1417, 'VERDADERO                                         ', 'Grs'),
(1418, 'LAMINA                                            ', 'individuos'),
(1419, 'SEMILLA                                           ', 'Grs'),
(1420, 'ORBIAGRO                                          ', 'Bts x 50'),
(1421, 'FOSFORO DE CAFE                                   ', 'Un'),
(1422, 'COLINO                                            ', 'COLINOS'),
(1423, 'BRACHIARIA DECUMBENS                              ', 'Grs'),
(1424, 'COLINO DE CAFE                                    ', 'Un'),
(1425, 'TANZANIA                                          ', 'cc'),
(1426, 'COLINO CACAO                                      ', 'Un'),
(1427, 'COLINO PLAT.                                      ', 'COLINOS'),
(1428, 'COLINO NARANJA                                    ', 'COLINOS'),
(1429, 'YEMAS HASS                                        ', 'individuos'),
(1430, 'CONCENTRADO DE CABALLO                            ', 'BULTO DE 40 KILOS'),
(1431, 'LIMA GAVILAN CON MANGO                            ', 'Un'),
(1432, 'NOVATERRA ENRIQUECIDO                             ', 'cc'),
(1433, 'HUMUS SOLIDO HUMEDO                               ', 'Kg'),
(1434, 'HUMUS SOLIDO NOVATERRA                            ', 'Kg'),
(1435, 'NEMAROOT                                          ', 'Grs'),
(1436, 'SINCOZIN                                          ', 'cc'),
(1437, 'THIMET                                            ', 'Kg'),
(1438, 'FLORONE                                           ', 'cc'),
(1439, 'FITOMARE                                          ', 'cc'),
(1440, 'NOVAPLANT ALGANOVA                                ', 'Grs'),
(1441, 'BIOZYME                                           ', 'cc'),
(1442, 'CRECER 500                                        ', 'Grs'),
(1443, 'BIOCEL                                            ', 'cc'),
(1444, 'ERGOSTIM                                          ', 'cc'),
(1445, 'CRECIPLANT                                        ', 'Grs'),
(1446, 'NUTRIZYME                                         ', 'cc'),
(1447, 'RADIGROW                                          ', 'cc'),
(1448, 'BASFOLIAR ALGAE                                   ', 'cc'),
(1449, 'SIAPTON                                           ', 'cc'),
(1450, 'RAZORMIN                                          ', 'cc'),
(1451, 'KASUMIN                                           ', 'cc'),
(1452, 'WEST TERRASAFE X3.78                              ', 'cc'),
(1453, 'BIOCLORO                                          ', 'cc'),
(1454, 'ACAREX                                            ', 'cc'),
(1455, 'DIFON BRIO                                        ', 'cc'),
(1456, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `id_finca` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornales`
--

CREATE TABLE `jornales` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kilos`
--

CREATE TABLE `kilos` (
  `id` int(11) NOT NULL,
  `registro_id` int(11) NOT NULL,
  `kilos` int(11) NOT NULL,
  `valor_kilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kilos`
--

INSERT INTO `kilos` (`id`, `registro_id`, `kilos`, `valor_kilo`) VALUES
(4, 14, 555, 0),
(5, 15, 100, 1),
(6, 16, 100, 1),
(7, 17, 100, 1000),
(8, 18, 100, 1000),
(9, 21, 100, 1000),
(10, 22, 100, 1000),
(11, 22, 100, 1000),
(12, 23, 100, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `labores`
--

CREATE TABLE `labores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'ninguna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `labores`
--

INSERT INTO `labores` (`id`, `nombre`, `tipo`) VALUES
(252, 'REALCE                                            ', 'ninguno'),
(253, 'ARR. MATERIAL                                     ', 'ninguno'),
(254, 'PREP. TERRENO                                     ', 'ninguno'),
(255, 'TRAZO                                             ', 'ninguno'),
(256, 'HOLLADO                                           ', 'ninguno'),
(257, 'MOVIMIENTO COLINO                                 ', 'ninguno'),
(258, 'SIEMBRA                                           ', 'ninguno'),
(259, 'DESGUASQUE                                        ', 'ninguno'),
(260, 'CLASIF. FRUTA                                     ', 'ninguno'),
(261, 'CONT. MAL-ESTAC.                                  ', 'ninguno'),
(262, 'DESTRONQUE                                        ', 'ninguno'),
(263, 'DESHOJE                                           ', 'ninguno'),
(264, 'DESHIJE                                           ', 'ninguno'),
(265, 'DESMADURE                                         ', 'ninguno'),
(266, 'EMBOLSE                                           ', 'ninguno'),
(267, 'APUNTALAMIENTO                                    ', 'ninguno'),
(268, 'FERT. EDÃFICA                                     ', 'ninguno'),
(269, 'APLIC. ENMIENDAS                                  ', 'ninguno'),
(270, 'APLIC. MAT-ORGÃNICA                               ', 'ninguno'),
(271, 'FERT. FOLIAR                                      ', 'ninguno'),
(272, 'FERT. LÃQUIDA                                     ', 'ninguno'),
(273, 'PLATEO MECÃNICO                                   ', 'ninguno'),
(274, 'PLATEO QUÃMICO                                    ', 'ninguno'),
(275, 'PLATEO MANUAL                                     ', 'ninguno'),
(276, 'CONT. MAL-SELEC                                   ', 'ninguno'),
(277, 'CONT. MAL-MÃQ.ESP                                 ', 'ninguno'),
(278, 'CONT. MAL-MACHETE                                 ', 'ninguno'),
(279, 'CONT. MAL-GUADAÃ‘A                                 ', 'ninguno'),
(280, 'CONT. MAL-MANUAL                                  ', 'ninguno'),
(281, 'DESBEJUCADA                                       ', 'ninguno'),
(282, 'CONT. MAL-AZADÃ“N                                  ', 'ninguno'),
(283, 'DESORILLE                                         ', 'ninguno'),
(284, 'CONT. FITOSANIT                                   ', 'ninguno'),
(285, 'CONT. ROYA                                        ', 'ninguno'),
(286, 'CONT. SIGATOKA                                    ', 'ninguno'),
(287, 'CONT. QUÃMICO DE BROCA                            ', 'ninguno'),
(288, 'CONT. BIOLÃ“GICO                                   ', 'ninguno'),
(289, 'EVALUACIONES                                      ', 'ninguno'),
(290, 'ZOQUEO                                            ', 'ninguno'),
(291, 'DESRAME                                           ', 'ninguno'),
(292, 'CARGUE LEÃ‘A                                       ', 'ninguno'),
(293, 'SELECC. CHUPONES                                  ', 'ninguno'),
(294, 'DESCHUPONAS                                       ', 'ninguno'),
(295, 'MANEJO TRAMPAS                                    ', 'ninguno'),
(296, 'CONT. HORMIGA                                     ', 'ninguno'),
(297, 'PISADA TALLOS                                     ', 'ninguno'),
(298, 'PINTADA TALLOS                                    ', 'ninguno'),
(299, 'PODAS SOST-(DESPUNTES)                            ', 'ninguno'),
(300, 'PODAS DE FORMACIÃ“N                                ', 'ninguno'),
(301, 'CONT. PLAGAS                                      ', 'ninguno'),
(302, 'CONT. ENFERMEDADES                                ', 'ninguno'),
(303, 'COBERTURA PLATOS                                  ', 'ninguno'),
(304, 'RESIEMBRAS                                        ', 'ninguno'),
(305, 'REGULACIÃ“N SOMBRÃO                                ', 'ninguno'),
(306, 'CONT. SUELDA                                      ', 'ninguno'),
(307, 'REC. CAFÃ‰ AL DÃA                                  ', 'recoleccion'),
(308, 'REC. CAFÃ‰ CTTO                                    ', 'recoleccion'),
(309, 'REC. CAFÃ‰ PATRÃ“N                                  ', 'recoleccion'),
(310, 'REC. AGUACATE DÃA                                 ', 'recoleccion'),
(311, 'REC. AGUACATE CTTO                                ', 'recoleccion'),
(312, 'REC. AGUACATE PATRÃ“N                              ', 'recoleccion'),
(313, 'REC. NARANJA AL DÃA                               ', 'recoleccion'),
(314, 'REC. NARANJA CTTO                                 ', 'recoleccion'),
(315, 'REC. NARANJA PATRÃ“N                               ', 'recoleccion'),
(316, 'REC. PLÃTANO AL DÃA                               ', 'recoleccion'),
(317, 'REC. PLÃTANO CTTO                                 ', 'recoleccion'),
(318, 'REC. PLÃTANO PATRÃ“N                               ', 'recoleccion'),
(319, 'REC. AHUYAMA AL DÃA                               ', 'recoleccion'),
(320, 'REC. AHUYAMA CTTO                                 ', 'recoleccion'),
(321, 'REC. AHUYAMA PATRÃ“N                               ', 'recoleccion'),
(322, 'REC. ESPARRAGO AL DÃA                             ', 'recoleccion'),
(323, 'REC. ESPARRAGO CTTO                               ', 'recoleccion'),
(324, 'REC. ESPARRAGO PATRÃ“N                             ', 'recoleccion'),
(325, 'REC. MACADAMIA AL DÃA                             ', 'recoleccion'),
(326, 'REC. MACADAMIA CTTO                               ', 'recoleccion'),
(327, 'REC. MACADAMIA PATRÃ“N                             ', 'recoleccion'),
(328, 'REC. MAÃZ AL DÃA                                  ', 'recoleccion'),
(329, 'REC. MAÃZ CTTO                                    ', 'recoleccion'),
(330, 'REC. MAÃZ PATRÃ“N                                  ', 'recoleccion'),
(331, 'REC. LIMÃ“N AL DÃA                                 ', 'recoleccion'),
(332, 'REC. LIMÃ“N CTTO                                   ', 'recoleccion'),
(333, 'REC. LIMÃ“N PATRÃ“N                                 ', 'recoleccion'),
(334, 'CERCAS                                            ', 'ninguno'),
(335, 'ENCARRADA BOLSAS                                  ', 'ninguno'),
(336, 'LLENADO DE BOLSAS                                 ', 'ninguno'),
(337, 'CONSTRUCCIÃ“N CAMAS                                ', 'ninguno'),
(338, 'MANT. ALMÃCIGO                                    ', 'ninguno'),
(339, 'ALMACIGO                                          ', 'ninguno'),
(340, 'APORQUE                                           ', 'ninguno'),
(341, 'INJERTACION                                       ', 'ninguno'),
(342, 'ELABOR. ESTACAS                                   ', 'ninguno'),
(343, 'PREP. SUSTRATO                                    ', 'ninguno'),
(344, 'CONT. TRIPS                                       ', 'ninguno'),
(345, 'CONT. ACARO                                       ', 'ninguno'),
(346, 'CONT. MOSCA BLANCA                                ', 'ninguno'),
(347, 'CONT. PEGADORES                                   ', 'ninguno'),
(348, 'ANILLADO                                          ', 'ninguno'),
(349, 'CONT. BARRENADOR                                  ', 'ninguno'),
(350, 'TRANSP. FERTILIZANTES                             ', 'ninguno'),
(351, 'RIEGO                                             ', 'ninguno'),
(352, 'DESINFECCION SEMILLA                              ', 'ninguno'),
(353, 'TRANSP. CAFE CEREZA                               ', 'ninguno'),
(354, 'INVERSION DE RAMAS                                ', 'ninguno'),
(355, 'TRANSP. CAFE HMDO                                 ', 'ninguno'),
(356, 'FERTILIZACION ORGANICA                            ', 'ninguno'),
(357, 'MOVIMIENTO INSUMOS                                ', 'ninguno'),
(358, 'CONT. MAL-RENOV                                   ', 'ninguno'),
(359, 'REPIQUE                                           ', 'ninguno'),
(360, 'DESPALILLADA                                      ', 'ninguno'),
(361, 'CONT. DE ESCAMA                                   ', 'ninguno'),
(362, 'REC. BANANO CTTO                                  ', 'recoleccion'),
(363, 'REC. BANANO DIA                                   ', 'recoleccion'),
(364, 'REC. BANANO PATRON                                ', 'recoleccion'),
(365, 'ENUMERADA                                         ', 'ninguno'),
(366, 'TRANSP. INTER LIMÃ“N                               ', 'ninguno'),
(367, 'DESMUSGADA                                        ', 'ninguno'),
(368, 'MAYORDOMO                                         ', 'ninguno'),
(369, 'PATIERO                                           ', 'ninguno'),
(370, 'CONDUCTOR                                         ', 'ninguno'),
(371, 'DESPUNTE Y CIRUGIA                                ', 'ninguno'),
(372, 'CONTROL FITOSANITARIO                             ', 'ninguno'),
(373, 'CELADOR                                           ', 'ninguno'),
(374, 'RECOGIDA Y QUEMA MADERA                           ', 'ninguno'),
(375, 'BULDOZER                                          ', 'ninguno'),
(376, 'TRAZO Y HOYADA                                    ', 'ninguno'),
(377, 'CAMINOS                                           ', 'ninguno'),
(378, 'VAQUERO                                           ', 'ninguno'),
(379, 'AFIRMADO CARRETERAS                               ', 'ninguno'),
(380, 'BROCOLOGO                                         ', 'ninguno'),
(381, 'MANTENIMIENTO CARRETERAS                          ', 'ninguno'),
(382, 'PLATEO Y DESCHUPONA                               ', 'ninguno'),
(383, 'SIEMBRA FOSFORO                                   ', 'ninguno'),
(384, 'DESCALCETE                                        ', 'ninguno'),
(385, 'FUMIGACION CARRETERAS                             ', 'fumigacion'),
(386, 'ARRIERA- BOTELLAS/RUANA                           ', 'ninguno'),
(387, 'RESIEMBRA PASTO EN PLANTULAS                      ', 'ninguno'),
(388, 'CONSTRUCCION CORRAL                               ', 'ninguno'),
(389, 'DESHIJE Y DESCALCETE                              ', 'ninguno'),
(390, 'TRATANDO COLINO                                   ', 'ninguno'),
(391, 'LIMPIA SWINGLIA                                   ', 'ninguno'),
(392, 'FERTILIZACION FOLIAR ORGANICA                     ', 'ninguno'),
(393, 'CICATRIZACION                                     ', 'ninguno'),
(394, 'DESCARGUE SISCO                                   ', 'ninguno'),
(395, 'RECOGIDA LEÃ‘A                                     ', 'ninguno'),
(396, 'RERE                                              ', 'ninguno'),
(397, 'DESCARGUE COLINO                                  ', 'ninguno'),
(398, 'RASPA CONTRATO                                    ', 'ninguno'),
(399, 'RESIEMBRA  A CHUZO                                ', 'ninguno'),
(400, 'SIEMBRA CABEZA DE TORO                            ', 'ninguno'),
(401, 'PODA SWINGLIA                                     ', 'ninguno'),
(402, 'ELIMINACION TOCONES                               ', 'ninguno'),
(403, 'ABIERTA MONTE                                     ', 'ninguno'),
(404, 'ADECUADA/LIMPIA LOTE                              ', 'ninguno'),
(405, 'CONTROL BIOLOGICO BROCA                           ', 'ninguno'),
(406, 'MANTENIMIENTO DESPULPADORAS                       ', 'ninguno'),
(407, 'SISCO                                             ', 'ninguno'),
(408, 'QUEMA MADERA                                      ', 'ninguno'),
(409, 'ELIMINACION                                       ', 'ninguno'),
(410, 'DRENAJES                                          ', 'ninguno'),
(411, 'MANTENIMIENTO FUENTES HIDRICAS                    ', 'ninguno'),
(412, 'FERTILIZACION SWINGLIA                            ', 'ninguno'),
(413, 'AMARRE                                            ', 'ninguno'),
(414, 'MOVIMIENTO/PALEO PULPA                            ', 'ninguno'),
(415, 'ELIMINACION ARBOLES                               ', 'ninguno'),
(416, 'CONSTRUCCION PESADEROS                            ', 'ninguno'),
(417, 'CONSTRUCCION Y MANTENIMIENTO INFRAESTRUCTURA      ', 'ninguno'),
(418, 'DRENCH                                            ', 'ninguno'),
(419, 'DESPUELADA                                        ', 'ninguno'),
(420, 'VARIOS/OTRAS                                      ', 'ninguno'),
(421, 'CONTROL BROCA INSECTICIDA                         ', 'ninguno'),
(422, 'COLINO- SACADO DE LA PLANTACION                   ', 'ninguno'),
(423, 'MEZCLA FERTILIZANTES                              ', 'ninguno'),
(424, 'SOCOLADA GUADUAL                                  ', 'ninguno'),
(425, 'CONT. MAL ROSADO                                  ', 'ninguno'),
(426, 'CONT. GRILLO                                      ', 'ninguno'),
(427, 'INSTALACIONES ELECTRICAS                          ', 'ninguno'),
(428, 'AGOBIANDO PLATANO                                 ', 'ninguno'),
(429, 'TUTORIADA                                         ', 'ninguno'),
(430, 'MANTENIMIENTO CERCOS                              ', 'ninguno'),
(431, 'UTZ PREPARACION                                   ', 'ninguno'),
(432, 'CONT. AFIDOS                                      ', 'ninguno'),
(433, 'AYUDANTE PATIERO                                  ', 'ninguno'),
(434, 'REC. CAFÃ‰ REVISADOR                               ', 'recoleccion'),
(435, 'ENCARGADO LOMBRICULTIVO                           ', 'ninguno'),
(436, 'AYUDANTE LOMBRICULTIVO                            ', 'ninguno'),
(437, 'ARREGLO PLATANO                                   ', 'ninguno'),
(438, 'CONT. PALOMILLA                                   ', 'ninguno'),
(439, 'EMBOLSADA CAFE                                    ', 'ninguno'),
(440, 'TRASPLANTE                                        ', 'ninguno'),
(441, 'RECOGIENDO CERCOS                                 ', 'ninguno'),
(442, 'TRINCHOS- CONST. Y MANTENIMIENTO                  ', 'ninguno'),
(443, 'QUEMA                                             ', 'ninguno'),
(444, 'MANTENIMIENTO CUARTELES                           ', 'ninguno'),
(445, 'DEMOLICION                                        ', 'ninguno'),
(446, 'JARDINERO                                         ', 'ninguno'),
(447, 'ASERRADA MADERA                                   ', 'ninguno'),
(448, 'DESCARGUE ABONO                                   ', 'ninguno'),
(449, 'TRAMPEO PICUDO                                    ', 'ninguno'),
(450, 'REFORESTACION                                     ', 'ninguno'),
(451, 'RALEO                                             ', 'ninguno'),
(452, 'PAJAREO                                           ', 'ninguno'),
(453, 'MOVIMIENTO MATERIAL                               ', 'ninguno'),
(454, 'MOVIMIENTO SISCO                                  ', 'ninguno'),
(455, 'REMOJANDO RESIEMBRAS                              ', 'ninguno'),
(456, 'SACANDO BALASTRO                                  ', 'ninguno'),
(457, 'DESGRANADA                                        ', 'ninguno'),
(458, 'CARGUE                                            ', 'ninguno'),
(459, 'SARANDEO MAIZ                                     ', 'ninguno'),
(460, 'RECOGIDA CINTA AMARRE                             ', 'ninguno'),
(461, 'RECOGIDA CINTA AMARRE                             ', 'ninguno'),
(462, 'ARRIERIA                                          ', 'ninguno'),
(463, 'PROTECCION FLORAL                                 ', 'ninguno'),
(464, 'DRENCH ORGANICO                                   ', 'ninguno'),
(465, 'SIEMBRA SOMBRIO                                   ', 'ninguno'),
(466, 'RECUPERACION VENDAVAL                             ', 'ninguno'),
(467, 'REGANDO LIXIVIADO ORGANICO                        ', 'ninguno'),
(468, 'TRANSPORTE                                        ', 'ninguno'),
(469, 'MANTENIMIENTO AGUAS                               ', 'ninguno'),
(470, 'CONT. TELARAÃ‘A                                    ', 'ninguno'),
(471, 'CONT. COGOLLERO                                   ', 'ninguno'),
(472, 'MODULOS FOE-01                                    ', 'ninguno'),
(473, 'PINTADA                                           ', 'ninguno'),
(474, 'ENCARGADO GALLINAS                                ', 'ninguno'),
(475, 'CARRETERA NUEVA                                   ', 'ninguno'),
(476, 'ARREGLO MADERA                                    ', 'ninguno'),
(477, 'PREPARACION NOVATERRA                             ', 'ninguno'),
(478, 'TAPADA ABONO                                      ', 'ninguno'),
(479, 'PODA DESCOPE                                      ', 'ninguno'),
(480, 'LLENADA HOYOS                                     ', 'ninguno'),
(481, 'BONIFICACION RECOLECTORES                         ', 'ninguno'),
(482, 'FERT. INYECTADA                                   ', 'ninguno'),
(483, 'REC. LULO AL DIA                                  ', 'recoleccion'),
(484, 'GERMINADOR                                        ', 'ninguno'),
(485, 'REC. LULO AL CONTRATO                             ', 'recoleccion'),
(486, 'FERTIRIEGO                                        ', 'ninguno'),
(487, 'INSTALACION RIEGO                                 ', 'ninguno'),
(488, 'TRAMPAS BIOLOGICAS                                ', 'ninguno'),
(489, 'CONT. NEMATODOS                                   ', 'ninguno'),
(490, 'DESPACHO FRUTA                                    ', 'ninguno'),
(491, 'INYECCION AL TALLO                                ', 'ninguno'),
(492, 'ALIMENTACION RECOLECTORES                         ', 'ninguno'),
(493, 'REC. PIMIENTA AL DIA                              ', 'recoleccion'),
(494, 'REC. PIMIENTA CONTRATO                            ', 'recoleccion'),
(495, 'REPRODUCCION POR ESQUEJE                          ', 'ninguno'),
(496, 'PODA TUTORES                                      ', 'ninguno'),
(497, 'PLATANO PARA GANADO                               ', 'ninguno'),
(498, 'PLANTULACION PIMIENTA                             ', 'ninguno'),
(499, 'REC. GRANADILLA AL DIA                            ', 'recoleccion'),
(500, 'LIMPIA EUGENIAS                                   ', 'ninguno'),
(501, 'BOTONEO                                           ', 'ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `labor_empleado`
--

CREATE TABLE `labor_empleado` (
  `id` int(11) NOT NULL,
  `registro_id` int(11) NOT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `nombre` varchar(128) NOT NULL,
  `valor` int(11) NOT NULL,
  `kilos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `labor_empleado`
--

INSERT INTO `labor_empleado` (`id`, `registro_id`, `empleado_id`, `nombre`, `valor`, `kilos`) VALUES
(2, 5, 1, '', 0, 0),
(3, 6, 1, '', 0, 0),
(4, 21, 1, '', 100000, 100),
(5, 22, 1, '', 100000, 100),
(6, 23, 1, '', 100000, 100),
(7, 24, 1, '', 85000, 0),
(8, 25, 3, '', 45000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `id_finca` int(11) NOT NULL,
  `cultivo_id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `variedad` varchar(128) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_siembra` date NOT NULL,
  `distancia_siembra` varchar(128) NOT NULL,
  `area` varchar(128) NOT NULL,
  `asnm` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id`, `id_finca`, `cultivo_id`, `nombre`, `variedad`, `cantidad`, `fecha_siembra`, `distancia_siembra`, `area`, `asnm`) VALUES
(2, 2, 23, 'Lote 1', '', 12500, '0000-00-00', '2 x 2m al cuadro', '4.67', '900'),
(3, 3, 1, 'VARIOS AGUACATE', '', 0, '0000-00-00', '', '0', '0'),
(4, 3, 1, 'PINOS 1', 'HASS', 1575, '0000-00-00', '6 X 6', '4.94', '1950'),
(5, 3, 1, 'PINOS 2', 'HASS', 813, '0000-00-00', '6 X 6', '2.55', '1950'),
(6, 3, 1, 'CAMELIA 1', 'HASS', 1693, '0000-00-00', '6 X 6', '5.31', '1900'),
(7, 3, 1, 'CAMELIA 2', 'HASS', 1933, '0000-00-00', '6 X 6', '6.06', '1900'),
(8, 3, 1, 'CAMELIA 3', 'HASS', 858, '0000-00-00', '6 X 6', '2.69', '1900'),
(9, 3, 1, 'CAMELIA 4', 'HASS', 1732, '0000-00-00', '6 X 6', '5.43', '1900'),
(10, 3, 1, 'MANAGUA 1', 'HASS', 1792, '0000-00-00', '6 X 6', '5.62', '2000'),
(11, 3, 1, 'MANAGUA 2', 'HASS', 3100, '0000-00-00', '6 X 6', '9.72', '1900'),
(12, 3, 1, 'MANAGUA 3', 'HASS', 1036, '0000-00-00', '6 X 6', '3.25', '1900'),
(13, 4, 4, 'CASTAÃ‘UELAS', '', 60000, '0000-00-00', '', '7.01', '1450'),
(14, 4, 4, 'TRIBUNAS', '', 53000, '0000-00-00', '', '6.42', '1457'),
(15, 4, 4, 'BRISAS', 'COLOMBIA, CATURRO Y SUPREMO', 46800, '0000-00-00', '1 x 1.4m', '6.98', '1514'),
(16, 4, 4, 'VEGAS', 'SUPREMO', 0, '0000-00-00', '1m X 1.5m', '19.59', '1500'),
(17, 4, 4, 'BOSQUE', 'COLOMBIA Y CASTILLO', 80000, '0000-00-00', '', '11.55', '1489'),
(18, 4, 4, 'BENEFICIADERO', 'COLOMBIA Y COSTA RICA', 42000, '0000-00-00', '', '6', '1501'),
(19, 4, 4, 'JAZMIN', 'SUPREMO', 31000, '0000-00-00', '1 x 1.4m', '3.74', '2'),
(20, 4, 4, 'GUALANDAY', 'COLOMBIA Y SUPREMO', 62200, '0000-00-00', '', '9.11', '1510'),
(21, 4, 4, 'NOGALES', 'CASTILLO', 65000, '0000-00-00', '1.2 x 1.6', '7.4', '1520'),
(22, 4, 4, 'LIBERTAD', 'COLOMBIA Y SUPREMO', 0, '0000-00-00', '', '18.53', '1498'),
(23, 4, 4, 'JUNGLA', 'COLOMBIA Y CASTILLO', 61700, '0000-00-00', '1.2m x 1.6m', '9.39', '1623'),
(24, 4, 4, 'BUENOS AIRES', 'COLOMBIA, CATURRO Y CASTILLO', 0, '0000-00-00', '', '22.64', '1723'),
(25, 4, 16, 'HACIENDA', '', 0, '0000-00-00', '', '0', '0'),
(26, 4, 6, 'PLATANO', '', 0, '0000-00-00', '', '0', '0'),
(27, 4, 4, 'VARIOS CAFE', '', 0, '0000-00-00', '', '0', '0'),
(28, 4, 19, 'LOMBRICULTIVO', '', 0, '0000-00-00', '', '0', '0'),
(29, 4, 4, 'BENEFICIADERO HDA', '', 0, '0000-00-00', '', '0', '0'),
(30, 4, 10, 'ALMACIGO', '', 0, '0000-00-00', '', '0', '0'),
(31, 4, 21, 'MADERABLES', '', 1000, '0000-00-00', '', '5', '0'),
(32, 4, 21, 'REFORESTACION', '', 1000, '0000-00-00', '', '5', '0'),
(33, 4, 4, 'CARRETERAS', '', 0, '0000-00-00', '', '0', '0'),
(34, 4, 1, 'OJO DE AGUA 1', 'HASS', 3795, '0000-00-00', '6 x 5m TRIANGULO', '9.91', '1831'),
(35, 4, 10, 'ALMACIGO ENSAYO', 'VARIAS', 3800, '0000-00-00', '', '0', '0'),
(36, 4, 26, 'INVERNADERO', '', 0, '0000-00-00', '', '0', '0'),
(37, 4, 1, 'OJO DE AGUA ZOCA CAFE', 'HASS', 647, '0000-00-00', '6X6', '2.18', '0'),
(38, 4, 1, 'OJO DE AGUA 2', 'HASS', 0, '0000-00-00', '', '0', '0'),
(39, 5, 6, 'SINAI ALTO I', '', 4000, '0000-00-00', '2 X 3', '6.09', '0'),
(40, 5, 6, 'PALMA', '', 4483, '0000-00-00', '3 x 2', '2.71', '0'),
(41, 5, 17, 'VARIOS GENERAL', '', 1000, '0000-00-00', '', '96', '0'),
(42, 5, 16, 'CASA HACIENDA', '', 0, '0000-00-00', '', '0', '0'),
(43, 5, 6, 'VARIOS PLATANO', '', 0, '0000-00-00', '', '0', '0'),
(44, 5, 7, 'VARIOS PASTOS', '', 0, '0000-00-00', '', '', ''),
(45, 5, 1, 'OLVIDO AGUACATE', 'LORENA Y SANTANA', 1174, '0000-00-00', '7M x 7M', '5.49', '1400'),
(46, 5, 1, 'ESPARRAGOS AGUACATE', 'LORENA Y SANTANA', 454, '0000-00-00', '8 x 8', '2.36', '1200'),
(47, 5, 6, 'SIRIA PLATANO', '', 0, '0000-00-00', '3m x 2m', '9.19', '0'),
(48, 5, 1, 'SINAI BAJO I AGUACATE', 'LORENA Y SANTANA', 711, '0000-00-00', '7 x 7', '3.42', '0'),
(49, 5, 1, 'VARIOS AGUACATE', '', 0, '0000-00-00', '', '0', '0'),
(50, 5, 1, 'SINAI BAJO II AGUACATE', 'PAPELILLO Y SEMILL 40', 638, '0000-00-00', '8m x 8m', '3.95', '0'),
(51, 5, 6, 'VEGA BAJO PLATANO', '', 0, '2042-09-03', '', '10.14', '0'),
(52, 5, 1, 'BASCULA AGUACATE', 'LORENA Y SANTANA', 994, '0000-00-00', '7m x 7m', '4.83', '0'),
(53, 5, 1, 'BELLAVISTA AGUACATE', 'LORENA Y SANTANA', 1481, '0000-00-00', '7 x 7', '7.09', '1250'),
(54, 5, 28, 'BELLAVISTA LIMON', 'TAHITI', 272, '0000-00-00', '7 m x 7 m', '1.13', '1300'),
(55, 5, 28, 'SINAI ALTO I LIMON', 'THAITI', 0, '0000-00-00', '', '3.27', '0'),
(56, 5, 28, 'LIMON POTRERO', 'TAHITI', 225, '0000-00-00', '7 x 7 al triangulo', '1.06', '0'),
(57, 5, 24, 'SIRIA CACAO', 'TCS01 Y SAN VICENTE', 12339, '0000-00-00', '3 X 3 M', '9.9', '0'),
(58, 5, 3, '1 NARANJA', 'SALUSTIANA', 643, '2041-12-02', '7 X 7', '3.57', '920'),
(59, 5, 3, '2 NARANJA', 'SALUSTIANA', 1256, '0000-00-00', '7 X 7', '5.18', '0'),
(60, 5, 3, '3 NARANJA', 'SALUSTIANA', 1093, '0000-00-00', '7 X 7', '5.03', '0'),
(61, 5, 3, '4 NARANJA', 'SALUSTIANA', 794, '0000-00-00', '7 X 7', '3.73', '920'),
(62, 5, 3, '5 NARANJA', 'SALUSTIANA', 727, '0000-00-00', '7 X 7', '3.48', '980'),
(63, 5, 3, '6 NARANJA', 'SALUSTIANA', 872, '0000-00-00', '7 X 7', '5.26', '950'),
(64, 5, 1, 'PALMA AGUACATE', 'SEMILL 40', 382, '2043-11-06', '9 X 9', '2.71', '1050'),
(65, 5, 1, 'VEGAS AGUACATE', 'SEMILL 40', 308, '2043-12-09', '9 X 9 TRIANGULO', '2.17', '1100'),
(66, 5, 28, 'LIMON NARANJOS', 'LIMON TAHITI', 761, '0000-00-00', '7X7', '3', '0'),
(67, 5, 28, 'SINAI ALTO 2', 'THAITI', 1016, '0000-00-00', '7X7', '4.5', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `articulo` varchar(128) NOT NULL,
  `valor` varchar(128) NOT NULL,
  `fecha` date NOT NULL,
  `n_factura` varchar(128) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `observacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pluviometria`
--

CREATE TABLE `pluviometria` (
  `id` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `milimetros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pluviometria`
--

INSERT INTO `pluviometria` (`id`, `finca_id`, `fecha`, `milimetros`) VALUES
(3, 4, '2019-08-09', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `unidad` varchar(128) NOT NULL,
  `cultivo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `unidad`, `cultivo_id`) VALUES
(1, 'PLATANO DE PRIMERA', 'Kilogramos', 6),
(2, 'PLATANO DE SEGUNDA', 'Kilogramos', 6),
(3, 'COLINO DE CAFE', 'Kilogramos', 4),
(4, 'VENTA BESTIAS', 'Kilogramos', 29),
(5, 'CAFE FEDERACION', 'Kilogramos', 4),
(6, 'PASILLA', 'Kilogramos', 30),
(7, 'RASPA', 'Kilogramos', 30),
(8, 'REPELA', 'Kilogramos', 4),
(9, 'GANADO A UTILIDAD', 'Kilogramos', 31),
(10, 'CAMAROTES', 'Kilogramos', 32),
(11, 'DESGRANADO', 'Kilogramos', 6),
(12, 'HUMUS SOLIDO HUMEDO', 'Kilogramos', 19),
(13, 'HUMUS SOLIDO SECO', 'Kilogramos', 19),
(14, 'HUMUS LIQUIDO', 'Kilogramos', 19),
(15, 'GANADO', 'Kilogramos', 31),
(16, 'PLATANO DE PRIMERA B', 'Kilogramos', 6),
(17, 'TRACTOR', 'Kilogramos', 32),
(18, 'MADERA', 'Kilogramos', 32),
(19, 'MAQUINARIA Y EQUIPOS', 'Kilogramos', 32),
(20, 'COLINO DE PLATANO', 'Kilogramos', 6),
(21, 'VOLQUETA', 'Kilogramos', 32),
(22, 'CHATARRA', 'Kilogramos', 32),
(23, 'CARBON', 'Kilogramos', 32),
(24, 'SUBSIDIO CAFE', 'Kilogramos', 4),
(25, 'BANANO', 'Kilogramos', 6),
(26, 'FOSFORO CAFE', 'Kilogramos', 4),
(27, 'ACCESORIOS GANADO', 'Kilogramos', 31),
(28, 'CAFE NESPRESSO', 'Kilogramos', 4),
(29, 'CAFE DE SEGUNDA', 'Kilogramos', 4),
(30, 'LOMBRICOL FOE-01', 'Kilogramos', 19),
(31, 'FLETES INTERNOS', 'Kilogramos', 32),
(32, 'TEJAS DE BARRO', 'Kilogramos', 32),
(33, 'NARANJA DE PRIMERA', 'Kilogramos', 3),
(34, 'NARANJA DE SEGUNDA', 'Kilogramos', 3),
(35, 'ALQUILER PASTOS', 'Kilogramos', 31),
(36, 'AGUACATE PRIMERA', 'Kilogramos', 1),
(37, 'BANANO SEGUNDA', 'Kilogramos', 6),
(38, 'AGUACATE DE SEGUNDA', 'Kilogramos', 1),
(39, 'GUINEO', 'Kilogramos', 6),
(40, 'AGUACATE DESCARTE', 'Kilogramos', 1),
(41, 'NARANJA TERCERA', 'Kilogramos', 3),
(42, 'AGUACATE SANTANA', 'Kilogramos', 1),
(43, 'AGUACATE SANTANA 2DA', 'Kilogramos', 1),
(44, 'NARANJA MANCHADA', 'Kilogramos', 3),
(45, 'NOVATERRA ENRIQUECIDO', 'Kilogramos', 19),
(46, 'LULO DE PRIMERA', 'Kilogramos', 22),
(47, 'LULO DE 2DA', 'Kilogramos', 22),
(48, 'LULO DE 3RA', 'Kilogramos', 22),
(49, 'INDEMNIZACION SEGURO', 'Kilogramos', 6),
(50, 'FLETE', 'Kilogramos', 32),
(51, 'AGUACATE SEMIL', 'Kilogramos', 1),
(52, 'LOMBRIZ ROJA CALIFORNIANA', 'Kilogramos', 19),
(53, 'OTROS', 'Kilogramos', 32),
(54, 'APORTES SOCIOS', 'Kilogramos', 32),
(55, 'HASS NACIONAL', 'Kilogramos', 1),
(56, 'HASS 2DA NACIONAL', 'Kilogramos', 1),
(57, 'AGUACATE SEMIL 2DA', 'Kilogramos', 1),
(58, 'LIMON TAHITI', 'Kilogramos', 3),
(59, 'GRANADILLA PRIMERA', 'Kilogramos', 25),
(60, 'GRANADILLA SEGUNDA', 'Kilogramos', 25),
(61, 'GRANADILLA TERCERA', 'Kilogramos', 25),
(62, 'REINTEGRO INCAPACIDAD EPS', 'Kilogramos', 32),
(63, 'REINTEGRO INCAPACIDAD EPS', 'Kilogramos', 32),
(64, 'PIMIENTA NEGRA', 'Kilogramos', 23),
(65, 'YEMAS AGUACATE', 'Kilogramos', 1),
(66, 'HASS CAL 12', 'Kilogramos', 1),
(67, 'HASS CAL 14', 'Kilogramos', 1),
(68, 'HASS CAL 16', 'Kilogramos', 1),
(69, 'HASS CAL 18', 'Kilogramos', 1),
(70, 'HASS CAL 20', 'Kilogramos', 1),
(71, 'HASS CAL 22', 'Kilogramos', 1),
(72, 'HASS CAL 24', 'Kilogramos', 1),
(73, 'HASS CAL 26', 'Kilogramos', 1),
(74, 'HASS CAL 28', 'Kilogramos', 1),
(75, 'HASS CAL 30', 'Kilogramos', 1),
(76, 'HASS CAL 32', 'Kilogramos', 1),
(77, 'AGUACATE EDRANOL', 'Kilogramos', 1),
(78, 'MAIZ-MAZORCA', 'Kilogramos', 32),
(79, 'MAIZ-MAZORCA 2DA', 'Kilogramos', 32),
(80, 'INCENTIVO POR RENOVACION', 'Kilogramos', 32),
(81, 'HASS CATEGORIA II', 'Kilogramos', 1),
(82, 'BONO VENTA CAFE', 'Kilogramos', 4),
(83, 'COMPRA- VENTA CAFE', 'Kilogramos', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `telefono` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nit`, `nombre`, `telefono`) VALUES
(1, 900766077, 'AGRICOLA EL SAMAN', '8927561'),
(2, 2147483647, 'AGRICOLA ZARAKAY SAS', '3104129380'),
(3, 2147483647, 'AGRINOS COLOMBIA', '6017831'),
(4, 24395736, 'AGRO INSUMOS DE RISARALDA', '3207386130'),
(5, 2147483647, 'AGROCALDAS S.A.S', '8810368'),
(6, 75097508, 'AGROGUATICA', ''),
(7, 2147483647, 'AGROINSUMOS DE RISARALDA', ''),
(8, 2147483647, 'AGROINSUMOS VAMOS PAL CAMPO', ''),
(9, 860511458, 'AGROINTEGRAL ANDINA SAS', ''),
(10, 913638835, 'AGROMAQUINAS', '3206751487'),
(11, 102736275, 'AGROPECUARIA LA PESEBRERA', '8507218'),
(12, 750400186, 'AGROPLAZA', '8532245'),
(13, 2147483647, 'AGROSERVICIOS EL CRUCE', '3138899482'),
(14, 2147483647, 'AGROTERRA DE OCCIDENTE', '3205424535'),
(15, 10255309, 'AGROTIENDA', '8832629'),
(16, 654564, 'ALEJANDRO (PARADOR SANTAGUEDA)', ''),
(17, 247189749, 'ALMACEN AGROPECUARIO ARAUCA', '8713937'),
(18, 243954868, 'ALMACEN AGROPLAZA', '8532254'),
(19, 2147483647, 'ALMACEN DEL CAFE', ''),
(20, 860007538, 'ALMACEN DEL CAFE ARAUCA', '8712965'),
(21, 2147483647, 'ALMACEN EL CAMPO DE HOY', ''),
(22, 2147483647, 'ALMACEN EL RUIZ', '8822869'),
(23, 2147483647, 'ALMACEN EL TRACTOR', '8730025'),
(24, 246838802, 'ALMACEN VETERINARIO', ''),
(25, 2147483647, 'ANDINO AGRICOLA', '8400108'),
(26, 1027882279, 'BLOQUERA Y ARENERA LA CAMELIA', ''),
(27, 6754764, 'CAMPOFERT', ''),
(28, 2147483647, 'CASA CAFETERA S.A.', '3205584'),
(29, 810000111, 'CASA LUKER', ''),
(30, 43409616, 'CENTRAL DE PINTURAS EL CAFETERO', ''),
(31, 900881439, 'CENTRAL DEL CAMPO SAS', '8860669'),
(32, 2147483647, 'CIAMSA', '6647911'),
(33, 891401093, 'CODEGAR LTDA', '3364036'),
(34, 2147483647, 'COLINAGRO', ''),
(35, 81000520, 'CONCENTRADOS DEL CENTRO', '8852616'),
(36, 2147483647, 'COOPCAFER PEREIRA', '3366844'),
(37, 890801626, 'COOPERATIVA DE CAFICULTORES ANSERMA', '8532512'),
(38, 2147483647, 'DELTAGRAL', ''),
(39, 805017697, 'DELTAVALLE', '3301920'),
(40, 2147483647, 'DIABONOS', ''),
(41, 100159210, 'DIEGO FERNANDO PELAEZ GOMEZ', '3105445327'),
(42, 2147483647, 'DISAGRO', '8812899'),
(43, 2147483647, 'DISTRIBUIDOR AGROPECUARIO DEL QUINDIO', '7413836'),
(44, 2147483647, 'DUWEST', '3402573'),
(45, 100159210, 'EJE ABONOS DIEGO FERNANDO PELAEZ', '3105445327'),
(46, 900129168, 'EL FARO LTDA', '3175182544'),
(47, 2147483647, 'EL HACENDADO LTDA', ''),
(48, 102645150, 'EL POTRERO', '8827048'),
(49, 75086766, 'EL VAQUERO', ''),
(50, 1053795962, 'ELIANA MUÃ‘OZ MEJIA', '3233777689'),
(51, 43450805, 'FERREINSUMOS', '8531744'),
(52, 98476316, 'FERRETERIA CONSTRUYENDO MI CASA', '8713334'),
(53, 900566612, 'GREENHOUSE CROPSCIENCE SAS', ''),
(54, 900656046, 'INSUAGRO ARAUCARIAS SAS', ''),
(55, 159068887, 'INSUMOS AGRICOLAS H.D', '8860151'),
(56, 900182782, 'INSUMOS PALAGRO', '8403402'),
(57, 2147483647, 'INSUMOS Y SOLUCIONES AGRICOLAS DE EJE (INSAE)', '8876605'),
(58, 2147483647, 'INVERSIONES AGROPECUARIAS EL BRAZIL', '8713040'),
(59, 900333276, 'INVERSIONES SAN RAYSEL SAS', '8506402'),
(60, 1059786063, 'ITALCOL AGROPECUARIA', ''),
(61, 75078732, 'J DIAZ LABORATORIO DE BIOINSUMOS', ''),
(62, 4479163, 'JOSE JAVIER MOLINA LONDOÃ‘O', ''),
(63, 2147483647, 'KARDEX PRODUCTOS 1 ENERO 2,011', ''),
(64, 30275381, 'LA TIENDA DEL CAFETERO', '3117394439'),
(65, 2147483647, 'LOUIS DREYFUS COMMODITIES', ''),
(66, 2147483647, 'MEJISULFATOS SAS', ''),
(67, 2147483647, 'MICROFERTISA S.A.', '4244990'),
(68, 304036791, 'MULTIAGRO DISTRIBUCIONES', '3107127809'),
(69, 1, 'N.N', ''),
(70, 16078185, 'NOVATERRA', ''),
(71, 2147483647, 'NUTRIABONOS', '8808922'),
(72, 900299708, 'OTUNAGRO SAS', '3200380'),
(73, 158989969, 'PABLO EMILIO GUZMAN', '3127300578'),
(74, 2147483647, 'PRECISAGRO', ''),
(75, 63570574, 'PRODUCCIONES AGRICOLAS RANCHO CAROLINA', '3113892015'),
(76, 9763819, 'RAUL ANTONIO  ACEVEDO BERMUDEZ', ''),
(77, 668575128, 'RECOPLASTIC', '3206928346'),
(78, 750735702, 'SERVICAMPO', '8500025'),
(79, 2147483647, 'SOLUCIONES MICROBIANAS DEL TROPICO', ''),
(80, 2147483647, 'SUAGRO INSUMOS AGRICOLAS', '3205566'),
(81, 900711231, 'TERRALIFE COMPANY', ''),
(82, 750663753, 'VETERAGRO', '3206940752'),
(83, 815002075, 'VITABONO', '8853071'),
(84, 1060648885, 'VIVERO EMANUEL', '3226544358'),
(85, 99568975, 'VIVERO LAS PALMAS', '3128100889'),
(86, 2147483647, 'YARA COLOMBIA S.A', '6688300'),
(87, 102551063, 'ZULUAGRO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_labor`
--

CREATE TABLE `registro_labor` (
  `id` int(11) NOT NULL,
  `labor_id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '	0:al dia , 1: al contrato',
  `estado` varchar(128) NOT NULL COMMENT '0:sin terminar o 1:terminada para labores al día, y un porcentaje para labores al contrato,cuando es una labor presupuestada acá se guarda el numero de empleados',
  `valor` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `labor` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: ejecutada, 0: presupuestado',
  `ph_inicial` varchar(6) NOT NULL,
  `ph_final` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro_labor`
--

INSERT INTO `registro_labor` (`id`, `labor_id`, `lote_id`, `fecha`, `tipo`, `estado`, `valor`, `observacion`, `labor`, `ph_inicial`, `ph_final`) VALUES
(2, 253, 13, '2019-07-14', 0, '7', 175000, 'presupuesto de una labor', 0, '', ''),
(3, 307, 22, '2019-07-14', 1, '2000', 0, 'una recolecciÃ³n al contrato', 0, '', ''),
(4, 310, 20, '2019-07-07', 1, '87', 43500, 'una recolecciÃ³n al contrato', 0, '', ''),
(5, 255, 23, '2019-07-14', 1, '', 70000, 'una tarea nueva para la prÃ³xima semana.', 0, '', ''),
(6, 252, 22, '2019-07-07', 1, '', 450000, 'vea pues', 0, '', ''),
(7, 307, 22, '2019-07-14', 1, '1000', 450000, 'recolecciÃ³n de cafÃ©', 0, '', ''),
(8, 255, 23, '2019-07-14', 0, '7', 560000, 'esto es una prueba', 0, '', ''),
(9, 255, 23, '2019-07-14', 0, '7', 560000, 'esto es una prueba', 0, '', ''),
(10, 255, 23, '2019-07-14', 0, '7', 560000, 'esto es una prueba', 0, '', ''),
(14, 308, 22, '2019-08-09', 1, '0', 0, 'Una observaciÃ³n', 1, '', ''),
(15, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(16, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(17, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(18, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(19, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(20, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(21, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(22, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(23, 309, 13, '2019-08-09', 1, '0', 0, 'Holi', 1, '', ''),
(24, 254, 22, '2019-08-09', 1, '0', 0, 'un contrato', 1, '', ''),
(25, 253, 25, '2019-08-09', 1, '1', 0, 'Una ', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros_otros`
--

CREATE TABLE `rubros_otros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rubros_otros`
--

INSERT INTO `rubros_otros` (`id`, `nombre`) VALUES
(1, 'ASESORIA TRIBUTARIA'),
(2, 'ASESORIA TECNICA'),
(3, 'ASESORIA ADMINISTRATIVA'),
(4, 'OTROS'),
(5, 'REVISORIA FISCAL'),
(6, 'CUOTAS DE FOMENTO (IMPTO)'),
(7, 'EMERGENCIA ECONOMICA'),
(8, 'DE TIMBRES (IMPTO)'),
(9, 'A LA PROPIEDAD RAIZ (IMPTO)'),
(10, 'DE VEHICULOS (IMPTO)'),
(11, 'OTROS IMPUESTOS'),
(12, 'MAQ. Y EQUIPO ( ARRDMTO)'),
(13, 'CONSTRUC. Y EDIFICACIONES (ARRDMTO)'),
(14, 'AFILIACIONES'),
(15, 'CONTRIBUCIONES'),
(16, 'CORRIENTE DEBIL (SEG.)'),
(17, 'INCENDIO (SEG.)'),
(18, 'SUSTRACCION (SEG.)'),
(19, 'FLOTA Y EQUIPO DE TRANSP. (SEG.)'),
(20, 'OBLIGAT ACCIDENTE DE TTO. (SEG.)'),
(21, 'ROTURA DE MAQ. (SEG.)'),
(22, 'OTROS SEGUROS'),
(23, 'VIDA COLECTIVA (SEG.)'),
(24, 'ACUEDUCTO Y ALCANTARILLADO'),
(25, 'TRANSP, FLETES Y ACARREOS (SERVICIOS)'),
(26, 'OTROS SERVICIOS'),
(27, 'ANALISIS Y MUESTRAS'),
(28, 'BENEFICIO DE CAFE'),
(29, 'SERVICIO TRACTOR'),
(30, 'SERVICIOS DE ADMON. (GASTOS COMUNES)'),
(31, 'OTROS- BODEGAJE'),
(32, 'CORREO, PORTES Y TELEGRAMAS'),
(33, 'TELEFONO'),
(34, 'ENERGIA ELECTRICA'),
(35, 'ASISTENCIA TECNICA'),
(36, 'VIGILANCIA'),
(37, 'EMAS RECOLECCION DE BASURAS'),
(38, 'GAS ALIMENTADERO'),
(39, 'GASTOS NOTARIALES'),
(40, 'OTROS- GASTOS LEGALES'),
(41, 'TRAMITES Y LICENCIAS'),
(42, 'RENOVACION CAMARA DE COMERCIO'),
(43, 'MAQ. Y EQUIPO ( MMTO)'),
(44, 'CONSTRUC. Y EDIFICACIONES (MMTO)'),
(45, 'MANTENIMIENTO CARRETERA'),
(46, 'EQUIPO DE COMPUT Y COMUN. (MMTO)'),
(47, 'MANTENIMIENTO ANK 156'),
(48, 'MANTENIMIENTO PLANTA ELECTRICA'),
(49, 'CALIBRACION BASCULAS'),
(50, 'MANTENIMIENTO VEHICULO'),
(51, 'MANTENIMINETO MINICARGADOR'),
(52, 'MANTENIMIENTO MOTO'),
(53, 'MANTENIMIENTO HACIENDA Y OFICINA'),
(54, 'MANTENIMIENTO WBE 820'),
(55, 'FERRETERIA'),
(56, 'MANTENIMIENTO LOMBRICULTIVO'),
(57, 'MANTENIMIENTO TRACTOR'),
(58, 'ASEO HACIENDA'),
(59, 'INSTALACIONES ELECTRICAS (MMTO)'),
(60, 'REPARACIONES LOCATIVAS (MMTO)'),
(61, 'ARMAMENTO DE VIGILANCIA (MMTO)'),
(62, 'VIAS DE COMUNICACION (MMTO)'),
(63, 'ACUEDUCTO PLANTAS Y REDES (MMTO)'),
(64, 'MANTENIMIENTO BENEFICIADERO'),
(65, 'FLOTA Y EQUIPO DE TRANSP. (MMTO)'),
(66, 'MANTENIMIENTO MAQUINARIA, EQUIPOS Y HERRAMIENTAS'),
(67, 'RECARGA EXTINTORES'),
(68, 'MANTENIMIENTO REDES ELECTRICAS'),
(69, 'MANEJO DE AGUAS'),
(70, 'PEAJES'),
(71, 'PASAJES AEREOS'),
(72, 'OTROS (GASTOS DE VIAJE)'),
(73, 'PASAJES TERRESTRES'),
(74, 'ESCOLTA'),
(75, 'MAQ Y EQUIPO (DEPREC.)'),
(76, 'ACUEDUCTO, PLANTAS Y REDES (DEPREC.)'),
(77, 'EQUIPOS DE COMPUT. Y COMUN. (DEPREC.)'),
(78, 'FLOTA Y EQUIPOS DE TRANSP. (DEPREC.)'),
(79, 'INVERSIONES EN EL CAMPO'),
(80, 'ELEMENTOS DE ASEO Y CAFETERIA'),
(81, 'COMBUSTIBLES Y LUBRICANTES'),
(82, 'COMISIONES'),
(83, 'ENVASES Y EMPAQUES'),
(84, 'UTILES, PAPELERIA Y FOTOCOPOAS'),
(85, 'LIBROS, SUSCRIPCIONES, PERIODICOS'),
(86, 'FIESTA EMPLEADOS'),
(87, 'BOTIQUINES'),
(88, 'MATERIALES DE RIO'),
(89, 'ALMACIGO'),
(90, 'PERDIDA EN VTA. Y RETIRO DE BIENES'),
(91, 'ALIMENTACION OTROS'),
(92, 'COMPRA DE EQUIPOS'),
(93, 'DESCARGUE CAFE PERGAMINO'),
(94, 'ARMAMENTO Y MUNICION'),
(95, 'TAXIS Y BUSES'),
(96, 'COMPRA COLINOS, SEMILLAS Y ARBOLES'),
(97, 'INSUMOS LOMBRICULTIVO'),
(98, 'CASINO Y RESTAURATE'),
(99, 'GASTOS NO DEDUCIBLES'),
(100, 'IMPUESTOS ASUMIDOS'),
(101, 'ATENCIONES Y REGALOS'),
(102, 'GASTOS PISCINA'),
(103, 'BONIFICACIONES'),
(104, 'DOTACION Y SUMINISTRO DE TJADORES'),
(105, 'ALIMENTACION POLICIA'),
(106, 'SUBSIDIO ESCOLAR'),
(107, 'PLATANO CAMPAMENTOS'),
(108, 'PROVISIONES'),
(109, 'EMPAQUE CAFE'),
(110, 'GASTOS VIVERO GALPON Y HUERTA'),
(111, 'SISCO'),
(112, 'CONTROL BROCA'),
(113, 'ESTOPAS'),
(114, 'UTZ CERTIFICACION'),
(115, 'INCAPACITADO'),
(116, 'INSUMOS (OTROS)'),
(117, 'SISCO- CARGUE Y DESCARGUE'),
(118, 'ACPM'),
(119, 'PAJAREO'),
(120, 'AFIRMADO'),
(121, 'COMPRA PERRO'),
(122, 'PRODUCTOS Y DROGA VETERINARIA'),
(123, 'VIGILANCIA Y SEGURIDAD'),
(124, 'TRANSPORTE'),
(125, 'BOLSAS ALMACIGO'),
(126, 'HERRAMIENTAS E IMPLEMENTOS AGRICOLAS'),
(127, 'GASTOS VARIOS'),
(128, 'DOTACION OFICINAS Y CAMPAMENTOS'),
(129, 'RETIRO INVERSIONES'),
(130, 'GASTOS BANCARIOS'),
(131, 'COSTOS Y GASTOS EJERCICIOS ANTERIORES'),
(132, 'CINTAS PLATANO'),
(133, 'TOSTADA CAFE'),
(134, 'CUBETAS HUEVOS'),
(135, 'ARENA GERMINADOR'),
(136, 'COOPERATIVA CAFE ESPECIALIDAD'),
(137, 'DESCARGUE ABONO'),
(138, 'INTERESES'),
(139, 'CORRAL'),
(140, 'MONTAJE MODULO FOE-01'),
(141, 'INSTAL. ELECTRICAS ( ADECUACIONES)'),
(142, 'OTROS (ADECUACIONES)'),
(143, 'MANTENIMIENTO CUARTELES'),
(144, 'REPARAC. LOCATIVAS (ADECUACIONES)'),
(145, 'CONSTRUCCIONES'),
(146, 'MADERA'),
(147, 'MATERIALES DE CONSTRUCCION'),
(148, 'TANQUES'),
(149, 'JARDIN'),
(150, 'COLCHONES'),
(151, 'MANTENIMIENTO SILOS'),
(152, 'CARRETERA NUEVA'),
(153, 'CERCOS'),
(154, 'TRANSPORTE CAFE EN CEREZA'),
(155, 'TRANSPORTE GANADO'),
(156, 'MOVIENDO ABONO'),
(157, 'TRANSPORTE CAFE PERGAMINO'),
(158, 'TRANSPORTE RECOLECTORES'),
(159, 'TRANSPORTE FERTILIZANTES'),
(160, 'TRANSPORTE MAIZ'),
(161, 'TRASTEO'),
(162, 'TRANSPORTE INSUMOS'),
(163, 'TRANSPORTE CONCENTRADO'),
(164, 'TRANSPORTE HUEVOS'),
(165, 'VIAJE CHINCHINA'),
(166, 'VENIDAS'),
(167, 'TRANSPORTE FRUTA BARU'),
(168, 'CARGADA DE FRUTA'),
(169, 'TRANSPORTE SISCO'),
(170, 'ALIMENTACION CONDUCTOR'),
(171, 'VUELTAS'),
(172, 'MOVIENDO MATERIAL'),
(173, 'OTROS'),
(174, 'MOVIENDO FRUTA Y CANASTILLAS'),
(175, 'OFICINA'),
(176, 'DESARROLLO SOFTWARE'),
(177, 'REFRIGERANTE TRACTOR'),
(178, 'COMBUSTIBLE Y LUBRICANTES TRACTOR'),
(179, 'TRACTOR'),
(180, 'LLANTAS TRACTOR (MANT.)'),
(181, 'DROGA E INSUMOS GANADO'),
(182, 'HERRADA BESTIAS'),
(183, 'COMPRA EQUINOS'),
(184, 'COMPRA DE GANADO'),
(185, 'CERTIFICACION PREDIO EXPORTADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros_post`
--

CREATE TABLE `rubros_post` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rubros_post`
--

INSERT INTO `rubros_post` (`id`, `nombre`) VALUES
(1, 'COMBUSTIBLES Y LUBRICANTES'),
(2, 'CISCO'),
(3, 'TRANSP. CISCO'),
(4, 'EMP. CISCO'),
(5, 'DESCARGUE SISCO'),
(6, 'ENERGIA INDUSTRIAL (SILO)'),
(7, 'ACUEDUCTO PLANTAS Y REDES'),
(8, 'JORNALES'),
(9, 'HORAS EXTRAS'),
(10, 'CESANTIAS'),
(11, 'INTERESES SOBRE LAS CESANTIAS'),
(12, 'PRIMA DE SERVICIOS'),
(13, 'VACACIONES DISFRUTADAS'),
(14, 'VACACIONES EN DINERO'),
(15, 'BONIFICACIONES'),
(16, 'DOTACION Y SUMINISTROS A TJADO'),
(17, 'APORTES A  A.R.P.'),
(18, 'APORTES EPS  Y PENSIONES'),
(19, 'APORTES CAJAS  COMPENSACION'),
(20, 'APORTES I.C.B.F.'),
(21, 'APORTES SENA'),
(22, 'GASTOS MEDICOS Y DROGAS'),
(23, 'CONTRATOS VARIOS'),
(24, 'RECOLECCION'),
(25, 'CARGUE'),
(26, 'MOVIMIENTO/ PALEO PULPA'),
(27, 'MOVIMIENTO CAFE'),
(28, 'CONSTRUCCIONES Y EDIFICACIONES'),
(29, 'VIAS DE COMUNICACIÃ“N'),
(30, 'AFIRMADO Y MATERIALES'),
(31, 'MANTENIMIENTO BENEFICIADERO'),
(32, 'MATERIALES DE CONSTRUCCION'),
(33, 'MANT. INFRAESTRUCTURA SUBPRODUCTOS'),
(34, 'FERRETERIA'),
(35, 'MTO MAQUINARIA Y EQUIPO'),
(36, 'INSTALACIONES ELECTRICAS'),
(37, 'REPARACIONES LOCATIVAS'),
(38, 'OTROS (MMTO REP MQ Y EQ)'),
(39, 'FLOTA Y EQUIPO DE TRANS (MANTEN)'),
(40, 'TRANSPORTE FLETES Y ACARREOS'),
(41, 'TRANSP. CAFE P. S.'),
(42, 'DESCARGUES CAFE PERGAMINO'),
(43, 'TRANSP. C. CEREZA'),
(44, 'VIDA COLECTIVA'),
(45, 'INCENDIO'),
(46, 'SUSTRACCION'),
(47, 'ROTURA DE MAQUINARIA'),
(48, 'OTROS SEGUROS'),
(49, 'FLOTA Y EQUIPO DE TRANSP. (SEG.)'),
(50, 'SEGURO OBLIGAT. ACC. DE TRANS.'),
(51, 'SERVICIO DE ASEO'),
(52, 'CORREO, PORTES Y TELEGRAMAS'),
(53, 'ELEMENTOS DE ASEO Y CAFETERIA'),
(54, 'OTROS (SERVICIOS)'),
(55, 'OTROS (BENEFICIO DE CAFE)'),
(56, 'OTROS ( ANALISIS Y MUESTRAS)'),
(57, 'OTROS (GASTOS VARIOS)'),
(58, 'TRAMITES Y LICENCIAS'),
(59, 'NN'),
(60, 'HERR/TAS E IMPLE/TOS AGRICOLAS'),
(61, 'DOTACION VIVIENDAS Y CAMPAMENTOS'),
(62, 'GASTOS VARIOS'),
(63, 'ENVASES Y EMPAQUES'),
(64, 'PRODUCTOS Y DROGA VETERINARIA'),
(65, 'CASINO Y RESTAURANTE'),
(66, 'TRANSPORTE'),
(67, 'PERDIDA EN VTA. Y RETIRO DE BIENES'),
(68, 'IMPUESTOS ASUMIDOS'),
(69, 'GASTOS VIVERO, GALPON Y HUERTAS'),
(70, 'ATENCIONES Y REGALOS'),
(71, 'COSTOS Y GASTOS DE EJ.ANTERIOR'),
(72, 'TAXIS Y BUSES'),
(73, 'TRANSP. PULPA'),
(74, 'MATERIALES DE RIO'),
(75, 'RECARGA EXTINTORES'),
(76, 'MOVIMIENTO SISCO'),
(77, 'ESTOPAS'),
(78, 'BODEGAJE'),
(79, 'SELECCION/CLASIFICACION'),
(80, 'SUELDOS'),
(81, 'TELEFONO'),
(82, 'EQUIPOS DE COMPUTACION Y COMUN..'),
(83, 'PASAJES TERRESTRES'),
(84, 'HOTELES Y RESTAURANTES'),
(85, 'UTILES,PAPELERIA Y FOTOCOPIAS'),
(86, 'VIGILANCIA Y SEGURIDAD'),
(87, 'SERVICIOS ADMON (GASTOS COMUNES)'),
(88, 'GAS'),
(89, 'M.O BENEFICIO Y POSCOSECHA'),
(90, 'PATIERO'),
(91, 'M.O LOTE BENEFICIO Y POSTCOSECHA'),
(92, 'MANTENIMIENTO SILOS'),
(93, 'MAQUINARIA Y EQUIPOS'),
(94, 'ESCOLTAS'),
(95, 'SEGURIDAD SOCIAL'),
(96, 'DESPACHO PLATANO'),
(97, 'DESPACHO NARANJA'),
(98, 'DESPACHO AGUACATE'),
(99, 'CLASIFICACION CEREZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro_administrativo`
--

CREATE TABLE `rubro_administrativo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rubro_administrativo`
--

INSERT INTO `rubro_administrativo` (`id`, `nombre`) VALUES
(39, 'FINANCIERO                                        '),
(40, 'MAYORDOMO                                         '),
(41, 'INCAPACIDADES                                     '),
(42, 'PATRON DE CORTE                                   '),
(43, 'TIEMPO ($) SIN TRABAJAR                           '),
(44, 'PREST-SOCIALES                                    '),
(45, 'SALUD                                             '),
(46, 'SUB. FAMILIAR                                     '),
(47, 'PREDIAL                                           '),
(48, 'OTROS IMP.                                        '),
(49, 'ELEMENTOS DE ASEO Y CAFETERIA                     '),
(50, 'ENERGIA RESIDENCIAL HDA                           '),
(51, 'TELEFONO                                          '),
(52, 'AGUA                                              '),
(53, 'CORREO                                            '),
(54, 'FERRETERIA                                        '),
(55, 'REPUESTOS                                         '),
(56, 'VEHICULOS                                         '),
(57, 'CELADOR                                           '),
(58, 'BONIFICACION                                      '),
(59, 'AGRONOMO                                          '),
(60, 'BONIFIC ADMINIST                                  '),
(61, 'BONIFICACIONES                                    '),
(62, 'CONDUCTOR                                         '),
(63, 'BONIFIC CONDUCTOR                                 '),
(64, 'ASEO HDA                                          '),
(65, 'ATENCIONES HDA                                    '),
(66, 'ALIMENTACIONES HDA                                '),
(67, 'HDA                                               '),
(68, 'CONCENTRADO PERROS                                '),
(69, 'PISCINAS                                          '),
(70, 'PROV. HACIENDA                                    '),
(71, 'GASTOS OFICINA                                    '),
(72, 'COMBUSTIBLE POLICIA                               '),
(73, 'ESTOPAS                                           '),
(74, 'ADMINISTRACION                                    '),
(75, 'PEAJES                                            '),
(76, 'ASESORIA MI FINCA                                 '),
(77, 'MANTENIMIENTO MINICARGADOR                        '),
(78, 'MEDICAMENTOS EMPLEADOS                            '),
(79, 'TARJETA CONDUCTOR                                 '),
(80, 'VARIOS VEH.                                       '),
(81, 'OFICIOS VARIOS                                    '),
(82, 'FLETES                                            '),
(83, 'MANTENIMIENTO CUARTELES                           '),
(84, 'HERRAMIENTAS                                      '),
(85, 'PROV. ANIMALES                                    '),
(86, 'GASTOS LEGALES                                    '),
(87, 'COMBUSTIBLES Y LUBRICANTES                        '),
(88, 'HONORARIOS                                        '),
(89, 'ANALISIS DE SUELOS                                '),
(90, 'VAQUERO                                           '),
(91, 'MATERIALES DE CONSTRUCCION                        '),
(92, 'SEGURIDAD SOCIAL I.S.S.                           '),
(93, 'APORTES SOCIEDADES                                '),
(94, 'OFICIAL                                           '),
(95, 'AUXILIO TRANSPORTE                                '),
(96, 'JARDINERO                                         '),
(97, 'MANTENIMIENTO WBE 820                             '),
(98, 'DONACIONES                                        '),
(99, 'POLIZA SEGURO CULTIVOS                            '),
(100, 'CELADURIA                                         '),
(101, 'OTROS RECOLECCION                                 '),
(102, 'DOTACIONES Y SUMINISTRO DE TJADORES               '),
(103, 'OTROS GANADERIA                                   '),
(104, 'DROGA VETERINARIA                                 '),
(105, 'CAPACITACIONES                                    '),
(106, 'VARIOS HDA.                                       '),
(107, 'VARIOS                                            '),
(108, 'SERVICIO DOM.                                     '),
(109, 'ASISTENCIA TECNICA                                '),
(110, 'ANALISIS FOLIAR                                   '),
(111, 'UTZ CERTIFICACION                                 '),
(112, 'CONCENTRADO CABALLOS                              '),
(113, 'ASESOR CONTABLE                                   '),
(114, 'ASESOR LABORAL                                    '),
(115, 'REVISOR FISCAL                                    '),
(116, 'COMBUSTIBLE HDA                                   '),
(117, 'CONTRATO PRADOS                                   '),
(118, 'ADMON GENERAL                                     '),
(119, 'VETERINARIO                                       '),
(120, 'COND ALTOS DEL CAMPESTRE                          '),
(121, 'EQUIPOS                                           '),
(122, 'CIRCUITO RIEGO                                    '),
(123, 'CUENTAS POR PAGAR                                 '),
(124, 'SALDOS ANTERIORES                                 '),
(125, 'MANTENIMIENTO                                     '),
(126, 'CERCAS                                            '),
(127, 'PLAN PARCIAL                                      '),
(128, 'INTERNET                                          '),
(129, 'COMBUSTIBLE MAYORDOMO                             '),
(130, 'BOLSAS ALMACIGO                                   '),
(131, 'TRACTOR                                           '),
(132, 'BOLSAS PLATANO                                    '),
(133, 'AGUA PURA- BOTELLONES                             '),
(134, 'ARRIENDO PASTOS                                   '),
(135, 'RECARGA CELULAR                                   '),
(136, 'SOFTWARE                                          '),
(137, 'VIAJE FINCA ADMON GENERAL                         '),
(138, 'LIQUIDACION                                       '),
(139, 'POLIZA SEGURO MULTIRIESGO EMPRESARIAL             '),
(140, 'GASTOS MEDICOS                                    '),
(141, 'ARRIENDO OFICINA                                  '),
(142, 'ENERGIA INDUSTRIAL (SILO)                         '),
(143, 'ENERGIA                                           '),
(144, 'AGUA OFICINA                                      '),
(145, 'ASISTENTE ADMINISTRATIVO                          '),
(146, 'CELULARES                                         '),
(147, 'CESANTIAS                                         '),
(148, 'SOAT VOLQUETA                                     '),
(149, 'CONCENTRADO PAJAROS                               '),
(150, 'CONCENTRADO PECES                                 '),
(151, 'LEASING TRACTOR                                   '),
(152, 'TELEVISION                                        '),
(153, 'EMAS RECOLECCION DE BASURAS                       '),
(154, 'BONIFICACION PATIERO                              '),
(155, 'CONCENTRADO GALLINAS                              '),
(156, 'COMPRA GALLINAS                                   '),
(157, 'REMODELACION CASA HDA                             '),
(158, 'ESCOLTA                                           '),
(159, 'INSUMOS LOMBRICULTIVO                             '),
(160, 'INSUMOS (OTROS)                                   '),
(161, 'ACPM                                              '),
(162, 'MANTENIMIENTO VEHICULOS                           '),
(163, 'OTROS (GASTOS DE VIAJE)                           '),
(164, 'TRANSPORTE                                        '),
(165, 'MATERIALES DE RIO                                 '),
(166, 'COLCHONES                                         '),
(167, 'COMPRA COLINO, SEMILLAS Y ARBOLES                 '),
(168, 'BOTIQUIN                                          '),
(169, 'COMISIONES                                        '),
(170, 'MANTENIMIENTO MAQUINARIA, EQUIPOSY HERRAMIENTAS   '),
(171, 'CONSTRUCCION RIEGO                                '),
(172, 'MANTENIMIENTO RIEGO                               '),
(173, 'COMPRA GANADO                                     '),
(174, 'COMBUSTIBLE Y LUBRICANTES TRACTOR                 '),
(175, 'TRANSPORTE FERTILIZANTES                          '),
(176, 'MANTENIMIENTO TRACTOR                             '),
(177, 'MANTENIMIENTO CUATRIMOTO                          '),
(178, 'TRANSPORTE INSUMOS                                '),
(179, 'CARGUE Y DESCARGUE                                '),
(180, 'CONSTRUCCIONES Y EDIFICACIONES (MTO)              '),
(181, 'MANTENIMIENTO PLANTA ELECTRICA                    '),
(182, 'EMPAQUE                                           '),
(183, 'MANTENIMIENTO REDES ELECTRICA                     '),
(184, 'OTROS (ADECUACIONES)                              '),
(185, 'MANTENIMIENTO CARRETERA                           '),
(186, 'ARMAMENTO Y MUNICION                              '),
(187, 'COMPRA DE EQUIPOS Y MAQUINARIA                    '),
(188, 'FIESTA FIN DE AÃ‘O EMPLEADOS                       '),
(189, 'PRIMA + VACACIONES                                '),
(190, 'COMISION VENTAS                                   '),
(191, 'TODERO                                            '),
(192, 'IMPLEMENTOS GANADERIA                             '),
(193, 'MANTENIMIENTO LOMBRICULTIVO                       '),
(194, 'ANALISIS DE LABORATORIO                           '),
(195, 'ARRIENDO TIERRA                                   '),
(196, 'BODEGAJE                                          '),
(197, 'LABORES GALLINAS                                  '),
(198, 'RIEGO                                             '),
(199, 'TRAMPAS BIOLOGICAS                                '),
(200, 'VIATICOS ASISTENTE TECNICO                        '),
(201, 'CONCENTRADO GANADO                                '),
(202, 'COMBUSTIBLE ADMON                                 '),
(203, 'MEDICION FINCAS                                   '),
(204, 'COMBUSTIBLES Y LUBRICANTES RIEGO                  '),
(205, 'CONSTRUCCION CAMILLA SELECCION FRUTA              '),
(206, 'CARRETERA NUEVA                                   '),
(207, 'MANTENIMIENTO POZOS SEPTICOS                      '),
(208, 'IMPLEMENTACION SGSST                              '),
(209, 'GASTOS OFICINA MANIZALES                          '),
(210, 'CONSTRUCCION SECADERO                             '),
(211, 'RODAMIENTO VEHICULOS                              '),
(212, 'COMBUSTIBLE Y LUBRICANTES  CUATRIMOTO             '),
(213, 'MANTENIMIENTO MOTO                                '),
(214, 'AUXILIAR TECNICO                                  '),
(215, 'BROCOLOGO                                         '),
(216, 'MANTENIMIENTO HACIENDA                            '),
(217, 'CONDUCTOR TRACTOR                                 '),
(218, 'GASTOS EN PROCESOS JUDICIALES                     '),
(219, 'MANTENIMIENTO ESPEJO DE AGUA                      '),
(220, 'PLANIFICACION CREDITO                             '),
(221, 'DESPACHO DE FRUTA                                 '),
(222, 'GEOCAMPO                                          '),
(223, 'SAL GANADERIA                                     '),
(224, 'PRIMA                                             '),
(225, 'FERIAS Y EXPOSICIONES                             '),
(226, 'APICULTURA                                        '),
(227, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro_financiero`
--

CREATE TABLE `rubro_financiero` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rubro_financiero`
--

INSERT INTO `rubro_financiero` (`id`, `nombre`) VALUES
(1, 'INTERESES BANCARIOS'),
(2, 'INT. PARTICULARES'),
(3, 'VARIOS BANCARIOS'),
(4, '4 X MIL'),
(5, 'PLANIFICACION CREDITO'),
(6, 'INTERESES ANTICIPO'),
(7, 'COMISION BANCARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sociedad`
--

CREATE TABLE `sociedad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `nit` varchar(60) NOT NULL,
  `logo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sociedad`
--

INSERT INTO `sociedad` (`id`, `nombre`, `nit`, `logo`) VALUES
(2, 'BLACK QUEEN', '123456789', '../../img/sociedades/1551812168.png'),
(3, 'ARBOTEK SAS', '987654321', '../../img/sociedades/1551812195.png'),
(4, 'GOMEZ RIVERA', '789654123', '../../img/sociedades/1551812221.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temperatura`
--

CREATE TABLE `temperatura` (
  `id` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL,
  `semana` varchar(128) NOT NULL,
  `imagen` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `rol` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `rol`) VALUES
(1, 'administrador'),
(3, 'bodega'),
(2, 'gerente'),
(4, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombre_usuario` varchar(128) NOT NULL,
  `contrasena` varchar(128) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `identificacion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_rol`, `nombre_usuario`, `contrasena`, `nombre`, `apellido`, `identificacion`) VALUES
(1, 2, 'gerente', 'e10adc3949ba59abbe56e057f20f883e', 'Juan Carlos', 'Giraldo Rios', '1234567'),
(2, 1, 'administrador', 'e10adc3949ba59abbe56e057f20f883e', 'carlos', 'giraldo', '45782165'),
(3, 3, 'bodega', 'e10adc3949ba59abbe56e057f20f883e', 'mauricio', 'giraldo', '21457898'),
(4, 4, 'vendedor', 'e10adc3949ba59abbe56e057f20f883e', 'oscar', 'giraldo', '4578985623');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_finca`
--

CREATE TABLE `usuario_finca` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `finca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_finca`
--

INSERT INTO `usuario_finca` (`id`, `usuario_id`, `finca_id`) VALUES
(6, 1, 2),
(7, 1, 3),
(8, 1, 4),
(9, 1, 5),
(10, 2, 2),
(11, 2, 3),
(12, 2, 4),
(13, 2, 5),
(14, 3, 2),
(15, 3, 3),
(16, 3, 4),
(17, 3, 5),
(18, 4, 2),
(19, 4, 3),
(20, 4, 4),
(21, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `n_remision` varchar(128) NOT NULL,
  `pago` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `lote_id`, `producto_id`, `cliente_id`, `usuario_id`, `fecha`, `valor`, `cantidad`, `n_remision`, `pago`) VALUES
(1, 2, 64, 2, 4, '2019-01-22', 390000, 78, '7899', 'Transferencia'),
(2, 2, 64, 3, 4, '2019-03-12', 148500, 33, '56445', 'Efectivo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `finca_id_2` (`finca_id`,`insumo_id`),
  ADD KEY `finca_id` (`finca_id`),
  ADD KEY `insumo_id` (`insumo_id`),
  ADD KEY `cantidad` (`cantidad`);

--
-- Indices de la tabla `bodega_labor`
--
ALTER TABLE `bodega_labor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registro_id` (`registro_id`),
  ADD KEY `bodega_id` (`bodega_id`) USING BTREE;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_finca` (`finca_id`),
  ADD KEY `id_usuario` (`usuario_id`),
  ADD KEY `id_proveedor` (`proveedor_id`),
  ADD KEY `id_producto` (`insumo_id`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `n_factura` (`n_factura`),
  ADD KEY `finca_id` (`finca_id`),
  ADD KEY `sociedad_id` (`sociedad_id`);

--
-- Indices de la tabla `cultivo`
--
ALTER TABLE `cultivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despache`
--
ALTER TABLE `despache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finca_id` (`lote_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificacion` (`identificacion`);

--
-- Indices de la tabla `finca`
--
ALTER TABLE `finca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sociedad` (`id_sociedad`);

--
-- Indices de la tabla `gastos_administrativos`
--
ALTER TABLE `gastos_administrativos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rubro_id` (`rubro_id`),
  ADD KEY `finca_id` (`finca_id`);

--
-- Indices de la tabla `gastos_financieros`
--
ALTER TABLE `gastos_financieros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finca_id` (`finca_id`),
  ADD KEY `rubro_id` (`rubro_id`);

--
-- Indices de la tabla `gastos_otros`
--
ALTER TABLE `gastos_otros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rubro_id` (`rubro_id`),
  ADD KEY `finca_id` (`finca_id`);

--
-- Indices de la tabla `gastos_post`
--
ALTER TABLE `gastos_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finca_id` (`finca_id`),
  ADD KEY `rubro_id` (`rubro_id`),
  ADD KEY `cultivo_id` (`cultivo_id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bodega` (`bodega_id`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_finca` (`id_finca`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `jornales`
--
ALTER TABLE `jornales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `kilos`
--
ALTER TABLE `kilos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registro_id` (`registro_id`) USING BTREE;

--
-- Indices de la tabla `labores`
--
ALTER TABLE `labores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `labor_empleado`
--
ALTER TABLE `labor_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registro_id` (`registro_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_finca` (`id_finca`),
  ADD KEY `producto_id` (`cultivo_id`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finca_id` (`finca_id`);

--
-- Indices de la tabla `pluviometria`
--
ALTER TABLE `pluviometria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `finca_id_2` (`finca_id`,`fecha`),
  ADD KEY `finca_id` (`finca_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cultivo_id` (`cultivo_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_labor`
--
ALTER TABLE `registro_labor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labor_id` (`labor_id`),
  ADD KEY `lote_id` (`lote_id`);

--
-- Indices de la tabla `rubros_otros`
--
ALTER TABLE `rubros_otros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubros_post`
--
ALTER TABLE `rubros_post`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubro_administrativo`
--
ALTER TABLE `rubro_administrativo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubro_financiero`
--
ALTER TABLE `rubro_financiero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sociedad`
--
ALTER TABLE `sociedad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temperatura`
--
ALTER TABLE `temperatura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `finca_id_2` (`finca_id`,`semana`),
  ADD KEY `finca_id` (`finca_id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rol` (`rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuario_finca`
--
ALTER TABLE `usuario_finca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `finca_id` (`finca_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lote_id` (`lote_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bodega`
--
ALTER TABLE `bodega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bodega_labor`
--
ALTER TABLE `bodega_labor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cultivo`
--
ALTER TABLE `cultivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `despache`
--
ALTER TABLE `despache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `finca`
--
ALTER TABLE `finca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `gastos_administrativos`
--
ALTER TABLE `gastos_administrativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos_financieros`
--
ALTER TABLE `gastos_financieros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos_otros`
--
ALTER TABLE `gastos_otros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gastos_post`
--
ALTER TABLE `gastos_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1457;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornales`
--
ALTER TABLE `jornales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kilos`
--
ALTER TABLE `kilos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `labores`
--
ALTER TABLE `labores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT de la tabla `labor_empleado`
--
ALTER TABLE `labor_empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pluviometria`
--
ALTER TABLE `pluviometria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `registro_labor`
--
ALTER TABLE `registro_labor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `rubros_otros`
--
ALTER TABLE `rubros_otros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT de la tabla `rubros_post`
--
ALTER TABLE `rubros_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `rubro_administrativo`
--
ALTER TABLE `rubro_administrativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT de la tabla `rubro_financiero`
--
ALTER TABLE `rubro_financiero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sociedad`
--
ALTER TABLE `sociedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temperatura`
--
ALTER TABLE `temperatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_finca`
--
ALTER TABLE `usuario_finca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD CONSTRAINT `bodega_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bodega_ibfk_2` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bodega_labor`
--
ALTER TABLE `bodega_labor`
  ADD CONSTRAINT `bodega_labor_ibfk_3` FOREIGN KEY (`registro_id`) REFERENCES `registro_labor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bodega_labor_ibfk_4` FOREIGN KEY (`bodega_id`) REFERENCES `bodega` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_4` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD CONSTRAINT `comprobante_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comprobante_ibfk_2` FOREIGN KEY (`sociedad_id`) REFERENCES `sociedad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `despache`
--
ALTER TABLE `despache`
  ADD CONSTRAINT `despache_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `despache_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `finca`
--
ALTER TABLE `finca`
  ADD CONSTRAINT `finca_ibfk_1` FOREIGN KEY (`id_sociedad`) REFERENCES `sociedad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_administrativos`
--
ALTER TABLE `gastos_administrativos`
  ADD CONSTRAINT `gastos_administrativos_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gastos_administrativos_ibfk_2` FOREIGN KEY (`rubro_id`) REFERENCES `rubro_administrativo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_financieros`
--
ALTER TABLE `gastos_financieros`
  ADD CONSTRAINT `gastos_financieros_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gastos_financieros_ibfk_2` FOREIGN KEY (`rubro_id`) REFERENCES `rubro_financiero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_otros`
--
ALTER TABLE `gastos_otros`
  ADD CONSTRAINT `gastos_otros_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gastos_otros_ibfk_2` FOREIGN KEY (`rubro_id`) REFERENCES `rubros_otros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos_post`
--
ALTER TABLE `gastos_post`
  ADD CONSTRAINT `gastos_post_ibfk_1` FOREIGN KEY (`cultivo_id`) REFERENCES `cultivo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gastos_post_ibfk_2` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gastos_post_ibfk_3` FOREIGN KEY (`rubro_id`) REFERENCES `rubros_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`bodega_id`) REFERENCES `bodega` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`id_finca`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `insumos_ibfk_3` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jornales`
--
ALTER TABLE `jornales`
  ADD CONSTRAINT `jornales_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `kilos`
--
ALTER TABLE `kilos`
  ADD CONSTRAINT `kilos_ibfk_1` FOREIGN KEY (`registro_id`) REFERENCES `registro_labor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `labor_empleado`
--
ALTER TABLE `labor_empleado`
  ADD CONSTRAINT `labor_empleado_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `labor_empleado_ibfk_3` FOREIGN KEY (`registro_id`) REFERENCES `registro_labor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`id_finca`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`cultivo_id`) REFERENCES `cultivo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `maquinaria_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pluviometria`
--
ALTER TABLE `pluviometria`
  ADD CONSTRAINT `pluviometria_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`cultivo_id`) REFERENCES `cultivo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_labor`
--
ALTER TABLE `registro_labor`
  ADD CONSTRAINT `registro_labor_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_labor_ibfk_2` FOREIGN KEY (`labor_id`) REFERENCES `labores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temperatura`
--
ALTER TABLE `temperatura`
  ADD CONSTRAINT `temperatura_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tipo_usuario` (`id`);

--
-- Filtros para la tabla `usuario_finca`
--
ALTER TABLE `usuario_finca`
  ADD CONSTRAINT `usuario_finca_ibfk_1` FOREIGN KEY (`finca_id`) REFERENCES `finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_finca_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
