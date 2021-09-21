-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2018 a las 17:05:12
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminuser`
--

CREATE TABLE `adminuser` (
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `adminuser`
--

INSERT INTO `adminuser` (`Email`) VALUES
('admin1@gmail.com'),
('admin2@hotmail.com'),
('dgp.monkeybits@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appearsuggested`
--

CREATE TABLE `appearsuggested` (
  `IdPlace` int(4) NOT NULL,
  `IdRoute` int(4) NOT NULL,
  `Sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `appearsuggested`
--

INSERT INTO `appearsuggested` (`IdPlace`, `IdRoute`, `Sequence`) VALUES
(1, 1, 1),
(1, 2, 1),
(3, 1, 1),
(8, 3, 1),
(9, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appearverified`
--

CREATE TABLE `appearverified` (
  `IdPlace` int(8) NOT NULL,
  `IdRoute` int(8) NOT NULL,
  `Sequence` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `appearverified`
--

INSERT INTO `appearverified` (`IdPlace`, `IdRoute`, `Sequence`) VALUES
(1, 3, 0),
(1, 7, 1),
(1, 8, 0),
(1, 9, 0),
(1, 13, 4),
(1, 15, 1),
(2, 2, 0),
(2, 7, 3),
(2, 8, 1),
(3, 3, 1),
(3, 5, 0),
(3, 7, 4),
(3, 8, 2),
(3, 10, 0),
(3, 11, 0),
(3, 15, 2),
(4, 1, 1),
(4, 3, 2),
(4, 7, 2),
(4, 8, 3),
(4, 11, 1),
(4, 13, 1),
(4, 15, 3),
(5, 2, 1),
(5, 5, 1),
(5, 8, 4),
(5, 11, 2),
(5, 13, 2),
(6, 3, 3),
(6, 5, 2),
(6, 8, 5),
(6, 13, 3),
(6, 15, 4),
(7, 5, 3),
(7, 6, 1),
(7, 8, 6),
(7, 15, 5),
(8, 5, 4),
(8, 8, 7),
(8, 11, 3),
(8, 12, 1),
(9, 8, 8),
(9, 11, 4),
(9, 12, 2),
(9, 15, 6),
(10, 5, 5),
(10, 8, 9),
(10, 11, 5),
(10, 12, 3),
(11, 5, 6),
(11, 8, 10),
(11, 11, 6),
(11, 12, 4),
(12, 5, 7),
(12, 8, 11),
(12, 9, 1),
(12, 11, 7),
(13, 4, 0),
(13, 5, 8),
(13, 8, 12),
(14, 8, 13),
(14, 11, 8),
(15, 5, 9),
(15, 8, 14),
(15, 9, 2),
(15, 15, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoriteplaces`
--

CREATE TABLE `favoriteplaces` (
  `IdPlace` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoriteroutes`
--

CREATE TABLE `favoriteroutes` (
  `IdRoute` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `favoriteroutes`
--

INSERT INTO `favoriteroutes` (`IdRoute`, `Email`) VALUES
(1, 'usuario1@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `place`
--

CREATE TABLE `place` (
  `IdPlace` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `MadeBy` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Description` text COLLATE utf8_spanish2_ci NOT NULL,
  `Localitation` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Image` text COLLATE utf8_spanish2_ci NOT NULL,
  `ImageDescription` text COLLATE utf8_spanish2_ci,
  `RedMovility` tinyint(1) DEFAULT '0',
  `RedVision` tinyint(1) DEFAULT '0',
  `ColourBlind` tinyint(1) DEFAULT '0',
  `Deaf` tinyint(1) DEFAULT '0',
  `Foreigner` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `place`
--

INSERT INTO `place` (`IdPlace`, `Email`, `MadeBy`, `Name`, `Description`, `Localitation`, `Image`, `ImageDescription`, `RedMovility`, `RedVision`, `ColourBlind`, `Deaf`, `Foreigner`) VALUES
(1, 'admin1@gmail.com', 'usuario1@gmail.com', 'Cruz de Lagos', 'Delimitado por los viales Avda. Fernando de los Rios , calle Grabador David Roberts y Avda. Don Bosco se extiende este bonito parque. El parque fue remodelado, tras la contruccion bajo el mismo de un aparcamiento subterraneo.\r\n\r\nDistrito: Zaidin\r\nSuperficie: 13.157 metros cuadrados\r\nTipo de parque: Cerrado', 'Delimitado por los viales Avda. Fernando de los Rios , calle Grabador David Roberts', 'http://www.jimenezbrasa.com/ihdi/getImageGal1Proyectos.aspx?ID=251&W=-1&H=-1&LW=754&LH=390&CW=-1&CH=-1&CVA=2&CHA=2&CC=FFFFFF&CF=1&R=0&lang=1&LL=0', 'El parque fue remodelado, tras la contruccion bajo el mismo de un aparcamiento subterraneo.', 1, 0, 0, 0, 1),
(2, 'admin2@hotmail.com', 'usuario1@gmail.com', 'Capilla Real de Granada', 'La Capilla Real de Granada es un templo de culto catolico, ubicado en el centro de la ciudad de Granada, Espania.\r\n\r\nActualmente forma un anexo a la Catedral de dicha ciudad, siendo ambos templos una de sus grandes atracciones turisticas. Fue fundada como capilla funeraria por los Reyes Catolicos, Isabel I de Castilla y Fernando II de Aragon, y asimismo alberga las sepulturas de su hija y heredera Juana la Loca y el esposo de esta, Felipe el Hermoso. ', 'Calle Oficios, s/n, 18001 Granada', 'https://upload.wikimedia.org/wikipedia/commons/a/a7/Royal_Chapel_of_Granada_%28Spain%29.jpg', 'La Capilla Real de Granada es un templo de culto catolico, ubicado en el centro de la ciudad de Granada, Espania.', 1, 0, 0, 0, 1),
(3, 'dgp.monkeybits@gmail.com', NULL, 'Parque Almunia', 'Delimitado por los viales Avda. de Andalucia, Calle Periodista Eugenio Selles y Calle Periodista Jose Mezcua Ruiz se extiende este bonito parque.\r\n\r\nTiene una distribucion triangular rodeado por una valla y muro, ademas de existir distintas pantallas vegetales en cada uno de los lados: cipres, pruno, espino de fuego y laurel. Se desarrolla a partir de diversos paseos que se complementan y relacionan a lo largo de todo su recorrido, delimitando numerosas zonas de estancia con elementos caracteristicos como el quiosco de musica o la fuente con pergola de glicinas en su parte posterior. Uno de los elementos principales del parque es la acequia, atravesada por puentecillos de piedra que dan paso a cuadros de aromaticas, hacia un lado, y a una paseo de arces, al otro.\r\n\r\nDistrito: Chana\r\nSuperficie: 32.142 metros cuadrados\r\nTipo de parque: Cerrado', 'Delimitado por los viales Avda. de Andalucia. Granada.', 'http://www.besarsengranada.es/wp-content/uploads/2015/05/besarse-en-granada-flores-parque-almunia-5_21390.jpg', 'Tiene una distribucion triangular rodeado por una valla y muro, ademas de existir distintas pantallas vegetales en cada uno de los lados: cipres, pruno, espino de fuego y laurel. Se desarrolla a partir de diversos paseos que se complementan y relacionan a lo largo de todo su recorrido, delimitando numerosas zonas de estancia con elementos caracteristicos como el quiosco de musica o la fuente con pergola de glicinas en su parte posterior. Uno de los elementos principales del parque es la acequia, atravesada por puentecillos de piedra que dan paso a cuadros de aromaticas, hacia un lado, y a una paseo de arces, al otro.', 1, 0, 0, 0, 1),
(4, '', NULL, 'Parque Federico Garcia Lorca', 'El Parque Garcia Lorca, con cuatro entradas , se desarrolla alrededor de la Huerta de San Vicente, en los terrenos que antiguamente pertenecian a la familia de Federico Garcia Lorca. El parque esta constituido por diversos paseos , destacando dos avenidas: el paseo de la alameda , el cual se desarrolla paralelamente al rio y se dirige al estanque , y el paseo de tilos, desde la entrada principal hasta las zonas de servicios Delimitados por estos paseos y caminos, existen diversos sectores que terminan de configurar este parque: los jardines neoplasticistas, las acequias, la fuente cibernetica, el bosque de ribera, la rosaleda y las huertas.\r\n\r\nDistrito: Ronda\r\nSuperficie: 70.000 metros cuadrados\r\nTipo de parque: Cerrado', 'Entre las calles Arabial , Virgen Blanca y el Camino de Purchil.', 'https://www.conmishijos.com/assets/planes/4000/4120-parque-federico-garcia-lorca-granada.jpg', 'El Parque Garcia Lorca, con cuatro entradas , se desarrolla alrededor de la Huerta de San Vicente, en los terrenos que antiguamente pertenecian a la familia de Federico Garcia Lorca. ', 1, 0, 0, 0, 1),
(5, '', 'usuariobloqueado@gmail.com', 'Catedral de Granada', 'La Santa Iglesia Catedral Metropolitana de la Encarnacion de Granada es un templo catolico de la ciudad espaniola de Granada, sede de la archidiocesis de la ciudad. El templo es una de las obras cumbres del Renacimiento espaniol. ', 'Calle Gran Via de Colon, 5, 18001 Granada', 'http://catedraldegranada.com/wp-content/uploads/2015/12/22.jpg', 'El templo es una de las obras cumbres del Renacimiento espaniol. ', 1, 0, 0, 0, 1),
(6, 'dgp.monkeybits@gmail.com', NULL, 'Jardines del Triunfo', 'Se extiende este bonito parque, que tiene una distribucion triangular rodeado por una valla y muro, ademas de existir distintas pantallas vegetales en cada uno de los lados: cipres, pruno, espino de fuego y laurel. Se desarrolla a partir de diversos paseos que se complementan y relacionan a lo largo de todo su recorrido, delimitando numerosas zonas de estancia con elementos caracteristicos como el quiosco de musica o la fuente con pergola de glicinas en su parte posterior. Uno de los elementos principales del parque es la acequia, atravesada por puentecillos de piedra que dan paso a cuadros de aromaticas, hacia un lado, y a una paseo de arces, al otro.\r\n\r\nDistrito: Chana\r\nSuperficie: 32.142 metros cuadrados\r\nTipo de parque: Cerrado', 'Avda. de Andalucia, c/Periodista Eugenio Selles, c/Periodista Jose Mezcua Ruiz.', 'http://2.bp.blogspot.com/_vf7VA2YFrwU/TP_aQ1j9O1I/AAAAAAAAEDM/9BAgOnll5js/s400/8%2Bde%2Bdiciembre%2B1.jpg', 'Se extiende este bonito parque, que tiene una distribucion triangular rodeado por una valla y muro, ademas de existir distintas pantallas vegetales en cada uno de los lados: cipres, pruno, espino de fuego y laurel. ', 1, 0, 0, 0, 1),
(7, 'dgp.monkeybits@gmail.com', NULL, 'Mirador de San Nicolas', 'El Mirador de San Nicolas es quizas el mas famoso de Granada. Desde que Bill Clinton lo visitara en 1997 y dijera que vio la puesta de sol mas bonita del mundo, se ha convertido en visita obligada para los turistas.\r\n\r\nLa belleza de este mirador es innegable: la Alhambra y el Generalife frente a frente, la ciudad a sus pies y Sierra Nevada detras.\r\n\r\nEl encanto de su entorno, en pleno barrio del Albaycin, con sus calles empedradas, sus aljibes, sus bares de tapas y sus gentes, aniade sabor a la estampa. \r\n\r\nEsta siempre animado, con foraneos y locales. Abundan los vendedores de artesania y grupos que con sus guitarras improvisan toques flamencos.', 'Albaicin, Granada', 'http://nisnomad.com/wp-content/uploads/2016/08/IMG_20160812_081240.jpg', 'La belleza de este mirador es innegable: la Alhambra y el Generalife frente a frente, la ciudad a sus pies y Sierra Nevada detras.', 1, 0, 0, 0, 1),
(8, 'dgp.monkeybits@gmail.com', NULL, 'Alhambra', 'Es una ciudad palatina andalusi situada en Granada, en comunidad autonoma de Andalucia, Espania. Consiste en un conjunto de palacios, jardines y fortaleza que albergaba una verdadera ciudadela dentro de la propia ciudad de Granada, que servia como alojamiento al monarca y a la corte del Reino nazari de Granada. Su verdadero atractivo, como en otras obras musulmanas de la epoca, no solo radica en los interiores, cuya decoracion esta entre las cumbres del arte andalusi, sino tambien en su localizacion y adaptacion, generando un paisaje nuevo pero totalmente integrado con la naturaleza preexistente.', 'Calle Real de la Alhambra', 'https://cdn.getyourguide.com/img/tour_img-989388-148.jpg', 'Es una ciudad palatina andalusi situada en Granada, en comunidad autonoma de Andalucia, Espania.', 1, 1, 0, 0, 1),
(9, 'dgp.monkeybits@gmail.com', NULL, 'Generalife', 'Es la villa con jardines habitada por los reyes musulmanes de Granada como lugar de descanso, situado en la ciudad espaniola de Granada, en Andalucia. Fue concebida como villa rural, donde jardines ornamentales, huertos y arquitectura se integraban, en las cercanias de la Alhambra. El origen del nombre esta discutido. Algunos abogan por Yannat al-Arif como huerta del arquitecto, o jardin del arquitecto aunque pudo significar el mas excelso jardin. Ese huerto real era comun en las cortes hispano-arabes y es fruto de las reformas y aniadidos que le aportaron los diferentes sultanes.', ' Exterior de las murallas de la Alhambra, al este, en la ladera del Cerro del Sol.', 'https://media-cdn.tripadvisor.com/media/photo-s/11/7e/aa/fb/jardines-del-generalife.jpg', 'Es la villa con jardines habitada por los reyes musulmanes de Granada como lugar de descanso, situado en la ciudad espaniola de Granada, en Andalucia.', 1, 1, 0, 0, 1),
(10, 'dgp.monkeybits@gmail.com', NULL, 'Patio de los leones', 'El Patio de los Leones es el centro del Palacio que lleva este nombre. Es diferente al del Palacio de Comares, debido al eje del jardin anterior, del siglo XIII, sobre el que se disenia y a que el banio de Comares tiene un eje Norte-Sur y el palacio de los Leones tiene un eje Este-Oeste.', 'Calle Real de la Alhambra.', 'http://cadenaser00.epimg.net/emisora/imagenes/2016/08/30/radio_granada/1472561813_422996_1472561946_noticia_normal.jpg', 'El Patio de los Leones es el centro del Palacio que lleva este nombre.', 1, 1, 0, 0, 1),
(11, 'dgp.monkeybits@gmail.com', NULL, 'Palacio de Carlos V', 'El palacio de Carlos V es una construccion renacentista situada en la colina de la Alhambra de la ciudad espaniola de Granada, en Andalucia. Desde 1958, es sede del Museo de Bellas Artes de Granada y, desde 1994, también es sede del Museo de la Alhambra.', 'calle de la Alhambra', 'https://www.101viajes.com/sites/default/files/palacio-carlos-v.jpg', 'El palacio de Carlos V es una construccion renacentista situada en la colina de la Alhambra de la ciudad espaniola de Granada.', 1, 1, 0, 0, 1),
(12, 'dgp.monkeybits@gmail.com', NULL, 'Cartuja de Granada', 'El Real Monasterio de Nuestra Seniora de la Asuncion de la Cartuja, situado en la ciudad espaniola de Granada, comunidad autonoma de Andalucia. Albergo a una comunidad de monjes cartujos desde su fundacion en el siglo XVI hasta la exclaustracion del anio 1835. Aunque mezcla diversos estilos, representa una de las cumbres de la arquitectura barroca espaniola. ', ' Paseo de Cartuja, s/n, 18011 Granada', 'https://www.101viajes.com/sites/default/files/cartuja-granada.jpg', 'El Real Monasterio de Nuestra Seniora de la Asuncion de la Cartuja, situado en la ciudad espaniola de Granada, comunidad autonoma de Andalucia.', 1, 0, 0, 0, 0),
(13, 'dgp.monkeybits@gmail.com', NULL, 'Parque de las Ciencias', 'El Parque de las Ciencias de Andalucia-Granada es el primer museo interactivo de ciencia de Andalucia. Fue inaugurado en mayo de 1995​ ocupando en la actualidad 70 000 metros cuadrados. Esta situado en una zona centrica de Granada y se ha convertido en uno de los principales reclamos turisticos de la ciudad.', 'Av. de la Ciencia, s/n, 18006 Granada', 'https://saposyprincesas.elmundo.es/wp-content/uploads/2012/02/523920_296336390436539_1020146384_n.jpg', 'El Parque de las Ciencias de Andalucia-Granada es el primer museo interactivo de ciencia de Andalucia.', 1, 1, 0, 1, 1),
(14, 'dgp.monkeybits@gmail.com', NULL, 'Alcazaba', 'Fortaleza del s. XIII en la Alhambra con vistas panoramicas en su torre vigia principal, la Torre de la Vela.', 'Alhambra, Granada', 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Alcazaba3.jpg', 'Fortaleza del s. XIII en la Alhambra con vistas panoramicas en su torre vigia principal, la Torre de la Vela.', 1, 0, 0, 0, 1),
(15, 'dgp.monkeybits@gmail.com', NULL, 'Sacromonte', 'El Sacromonte es conocido como el barrio gitano. Los visitantes acuden a este cerro de Granada por la noche en busca de cante y baile. Los locales situados por el Camino del Sacromonte, en la ladera del cerro, ofrecen dramaticos espectaculos de flamenco. El Museo Cuevas del Sacromonte conserva viviendas excavadas en la roca. En la Abadia del Sacromonte hay reliquias y vistas panoramicas de la ciudad. Las rutas de senderismo y ciclismo conducen a las montanias.', 'Barrio de Granada', 'https://alhambra-de-granada.es/images/sacromonte_granada_visita.jpg', 'El Sacromonte es conocido como el barrio gitano. Los visitantes acuden a este cerro de Granada por la noche en busca de cante y baile. ', 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `placecomments`
--

CREATE TABLE `placecomments` (
  `IdPlace` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Content` varchar(130) COLLATE utf8_spanish2_ci NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Reported` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `placecomments`
--

INSERT INTO `placecomments` (`IdPlace`, `Email`, `Content`, `Date`, `Time`, `Reported`) VALUES
(1, 'usuario1@gmail.com', 'Mu bonito', '2018-10-18', '12:00:00', 0),
(2, 'usuario2@gmail.com', 'Arriba Espania', '2018-10-18', '12:00:00', 0),
(3, 'usuario3@gmail.com', 'Vamo a calmarno', '2018-10-18', '12:00:00', 0),
(4, 'usuario4@gmail.com', 'Vamo a pelearno', '2018-10-18', '12:00:00', 0),
(5, 'usuario1@gmail.com', 'Vamo a aproba', '2018-10-18', '12:00:00', 0),
(6, 'usuario2@gmail.com', 'Vamo a programa', '2018-10-18', '12:00:00', 0),
(7, 'usuario3@gmail.com', 'Vamo a ser malos', '2018-10-18', '12:00:00', 0),
(8, 'usuario4@gmail.com', 'Vamono de party', '2018-10-18', '12:00:00', 0),
(9, 'usuario1@gmail.com', 'Albondigas con Tomatico', '2018-10-18', '12:00:00', 0),
(10, 'usuario2@gmail.com', 'Chefstagram mola', '2018-10-18', '12:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `route`
--

CREATE TABLE `route` (
  `IdRoute` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `MadeBy` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Description` text COLLATE utf8_spanish2_ci NOT NULL,
  `Image` text COLLATE utf8_spanish2_ci NOT NULL,
  `ImageDescription` text COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `route`
--

INSERT INTO `route` (`IdRoute`, `Email`, `MadeBy`, `Name`, `Description`, `Image`, `ImageDescription`) VALUES
(1, 'admin1@gmail.com', 'usuario1@gmail.com', 'Ruta de Federico Garcia Lorca', 'Visita los lugares mas lorquianos de Granada', 'https://brecacha.files.wordpress.com/2014/02/paulorcablog.jpg', 'Imagen de una estatua de Federico Garcia Lorca sentado en un banco de un parque de Granada'),
(2, 'admin2@hotmail.com', 'usuario2@gmail.com', 'Ruta de las Iglesias ', 'Una ruta para encontrar la fe de nuevo.', 'https://laicismo.org/wp-content/uploads/2017/06/iglesia-Santafe.jpg', 'Una ruta para encontrar la fe de nuevo.'),
(3, 'admin1@gmail.com', 'usuario1@gmail.com', 'Ruta de los parques', 'Flora, guiris y bellas artes', 'http://cdn.granadadigital.es/wp-content/uploads/2015/07/parque-garcia-lorca-e1436265526271.jpg', 'Flora, guiris y bellas artes'),
(4, 'admin1@gmail.com', 'usuario3@gmail.com', 'Ruta de las ciencias', 'Mucha ciencia ', 'https://static1.ideal.es/www/pre2017/multimedia/noticias/201608/10/media/granada/parque-ciencias_xoptimizadax.jpg', 'Aguita fresquita'),
(5, 'admin1@gmail.com', 'usuario1@gmail.com', 'Mejores lugares de Granada', 'Paseo por los mejores sitios', 'https://www.nationalgeographic.com.es/medio/2018/05/22/granada_e81858d3.jpg', 'Bonita Granada'),
(6, 'dgp.monkeybits@gmail.com', NULL, 'Miradores de Granada', 'Vamo a mirar un poquito', 'https://static2.ideal.es/www/pre2017/multimedia/noticias/201601/29/media/cortadas/alixares-mirador-42--575x323.jpg', 'Plantas, construcciones y mirador'),
(7, 'dgp.monkeybits@gmail.com', NULL, 'Parques y Jardines de Granada', 'Muchos jardines, florecicas, alguna que otra farola, y de vez en cuando te cae agua de las fuentes.', 'https://guiasgranada.com/advisor/wp-content/uploads/2017/06/garcia1.jpg', 'Muchos jardines, florecicas, alguna que otra farola, y de vez en cuando te cae agua de las fuentes.'),
(8, '', 'usuario3@gmail.com', 'Ruta Desafio: Granada a full', 'Ruta por todos los lugares turisticos de Granada, para turistas extremos', 'https://www.livingtours.com/media/catalog/product/cache/2/image/830x545/17f82f742ffe127f42dca9de82fb58b1/g/r/granada1_2.jpg', 'Granada en su esplendor'),
(9, '', 'usuario1@gmail.com', 'Ruta de los gitanos', 'Prueba Granada', 'http://granadaatraves.com/wp-content/uploads/2014/02/sacromonte11.jpg', 'Sacromonte y tirando pal monte'),
(10, '', 'usuario4@gmail.com', 'Ruta de La Chana', 'Bellas Artes, Informaticos y alguna que otra sorpresa', 'https://www.granadahoy.com/2018/10/29/granada/Edificio-ETSIIT-UGR_1295580543_90659642_667x375.jpg', 'Por un tercer edificio'),
(11, '', 'usuario1@gmail.com', 'Ruta Horizontal', 'De Almunia a la Alhambra', 'https://www.laalmuniadelvalle.com/wp-content/uploads/2016/03/visitar-la-alhambra-540x303.jpg', 'De Almunia a la Alhambra'),
(12, 'dgp.monkeybits@gmail.com', NULL, 'Tour de la Alhambra', 'Ruta por algunos de los puntos turisticos mas importantes de la Alhambra, recorriendo sus grandes puertas, palaciones y jardines.', 'https://images.placesonline.com/photos/46695_granada_alcazaba.jpg?quality=80&w=710&h=510&mode=crop', 'Ruta por algunos de los puntos turisticos mas importantes de la Alhambra'),
(13, '', NULL, 'Ruta del centro de Granada', 'Bares y Kebabs', 'https://www.wuking.com/files/guia/art-centro-granada.jpg', 'Kebabs'),
(14, '', NULL, 'Ruta del cansancio', 'No hay mucho que hacer', 'https://www.lcbhoteles.es/wp-content/uploads/2017/05/HABITACION-DOBLE-ESTANDAR-DE-1-O-2-CAMAS7.jpg', 'Camita y a roncar'),
(15, '', NULL, 'Ruta del salto', 'Arte ', 'http://www.turgranada.es/wp-content/blogs.dir/2/files_mf/cache/th_8e735c5fb9f20d17096a998987c257d7_Parque_Arquitecto_Ramon_Garro_Atarfe.jpg?x53512', 'Mucho arte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routecomments`
--

CREATE TABLE `routecomments` (
  `IdRoute` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Content` text COLLATE utf8_spanish2_ci NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Reported` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `routecomments`
--

INSERT INTO `routecomments` (`IdRoute`, `Email`, `Content`, `Date`, `Time`, `Reported`) VALUES
(1, 'usuario1@gmail.com', 'Arriba Granada', '2018-10-18', '12:00:00', 0),
(2, 'usuario2@gmail.com', 'Somos de segunda', '2018-10-18', '12:00:00', 0),
(3, 'usuario3@gmail.com', 'Viva Virxe', '2018-10-18', '12:00:00', 0),
(4, 'usuario4@gmail.com', 'DGP aprobado', '2018-10-18', '12:00:00', 0),
(5, 'usuario1@gmail.com', 'Matricula for you', '2018-10-18', '12:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suggestedplace`
--

CREATE TABLE `suggestedplace` (
  `IdPlace` int(8) NOT NULL,
  `MadeBy` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Description` text COLLATE utf8_spanish2_ci NOT NULL,
  `Localitation` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Image` text COLLATE utf8_spanish2_ci NOT NULL,
  `RedMovility` tinyint(1) DEFAULT '0',
  `RedVision` tinyint(1) DEFAULT '0',
  `ColourBlind` tinyint(1) DEFAULT '0',
  `Deaf` tinyint(1) DEFAULT '0',
  `Foreigner` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suggestedroute`
--

CREATE TABLE `suggestedroute` (
  `IdRoute` int(8) NOT NULL,
  `MadeBy` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Description` text COLLATE utf8_spanish2_ci NOT NULL,
  `Image` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Banned` tinyint(1) DEFAULT '0',
  `Reported` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`Email`, `Name`, `Banned`, `Reported`) VALUES
('usuario1@gmail.com', 'Usuario1', 0, 1),
('usuario2@gmail.com', 'Usuario2', 0, 0),
('usuario3@gmail.com', 'Usuario3', 1, 1),
('usuario4@gmail.com', 'Usuario4', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visit`
--

CREATE TABLE `visit` (
  `IdRoute` int(8) NOT NULL,
  `IdPlace` int(8) NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Date` date NOT NULL,
  `Rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `visit`
--

INSERT INTO `visit` (`IdRoute`, `IdPlace`, `Email`, `Date`, `Rating`) VALUES
(2, 2, 'usuario1@gmail.com', '2018-11-14', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adminuser`
--
ALTER TABLE `adminuser`
  ADD PRIMARY KEY (`Email`);

--
-- Indices de la tabla `appearsuggested`
--
ALTER TABLE `appearsuggested`
  ADD PRIMARY KEY (`IdPlace`,`IdRoute`),
  ADD KEY `appearsuggested_ibfk_2` (`IdRoute`);

--
-- Indices de la tabla `appearverified`
--
ALTER TABLE `appearverified`
  ADD PRIMARY KEY (`IdPlace`,`IdRoute`),
  ADD KEY `appearverified_ibfk_2` (`IdRoute`);

--
-- Indices de la tabla `favoriteplaces`
--
ALTER TABLE `favoriteplaces`
  ADD PRIMARY KEY (`IdPlace`,`Email`),
  ADD KEY `favoritesplaces_ibfk_1` (`Email`);

--
-- Indices de la tabla `favoriteroutes`
--
ALTER TABLE `favoriteroutes`
  ADD PRIMARY KEY (`IdRoute`,`Email`),
  ADD KEY `favoritesroutes_ibfk_1` (`Email`);

--
-- Indices de la tabla `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`IdPlace`),
  ADD UNIQUE KEY `Localitation` (`Localitation`),
  ADD KEY `Email` (`Email`),
  ADD KEY `place_ibfk_2` (`MadeBy`);

--
-- Indices de la tabla `placecomments`
--
ALTER TABLE `placecomments`
  ADD PRIMARY KEY (`IdPlace`,`Email`,`Date`,`Time`),
  ADD KEY `placecomments_ibfk_1` (`Email`);

--
-- Indices de la tabla `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`IdRoute`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD KEY `Email` (`Email`),
  ADD KEY `MadeBy` (`MadeBy`);

--
-- Indices de la tabla `routecomments`
--
ALTER TABLE `routecomments`
  ADD PRIMARY KEY (`IdRoute`,`Email`,`Date`,`Time`),
  ADD KEY `routecomments_ibfk_1` (`Email`);

--
-- Indices de la tabla `suggestedplace`
--
ALTER TABLE `suggestedplace`
  ADD PRIMARY KEY (`IdPlace`),
  ADD KEY `suggestedplace_ibfk_1` (`MadeBy`);

--
-- Indices de la tabla `suggestedroute`
--
ALTER TABLE `suggestedroute`
  ADD PRIMARY KEY (`IdRoute`),
  ADD KEY `MadeBy` (`MadeBy`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- Indices de la tabla `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`IdRoute`,`IdPlace`,`Email`),
  ADD KEY `visit_ibfk_1` (`IdPlace`),
  ADD KEY `visit_ibfk_3` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `place`
--
ALTER TABLE `place`
  MODIFY `IdPlace` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `route`
--
ALTER TABLE `route`
  MODIFY `IdRoute` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `suggestedplace`
--
ALTER TABLE `suggestedplace`
  MODIFY `IdPlace` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `suggestedroute`
--
ALTER TABLE `suggestedroute`
  MODIFY `IdRoute` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appearsuggested`
--
ALTER TABLE `appearsuggested`
  ADD CONSTRAINT `appearsuggested_ibfk_1` FOREIGN KEY (`IdPlace`) REFERENCES `place` (`IdPlace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appearsuggested_ibfk_2` FOREIGN KEY (`IdRoute`) REFERENCES `route` (`IdRoute`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `appearverified`
--
ALTER TABLE `appearverified`
  ADD CONSTRAINT `appearverified_ibfk_1` FOREIGN KEY (`IdPlace`) REFERENCES `place` (`IdPlace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appearverified_ibfk_2` FOREIGN KEY (`IdRoute`) REFERENCES `route` (`IdRoute`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoriteplaces`
--
ALTER TABLE `favoriteplaces`
  ADD CONSTRAINT `favoriteplaces_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteplaces_ibfk_2` FOREIGN KEY (`IdPlace`) REFERENCES `place` (`IdPlace`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoriteroutes`
--
ALTER TABLE `favoriteroutes`
  ADD CONSTRAINT `favoriteroutes_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteroutes_ibfk_2` FOREIGN KEY (`IdRoute`) REFERENCES `route` (`IdRoute`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `placecomments`
--
ALTER TABLE `placecomments`
  ADD CONSTRAINT `placecomments_ibfk_1` FOREIGN KEY (`IdPlace`) REFERENCES `place` (`IdPlace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `placecomments_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `routecomments`
--
ALTER TABLE `routecomments`
  ADD CONSTRAINT `routecomments_ibfk_1` FOREIGN KEY (`IdRoute`) REFERENCES `route` (`IdRoute`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routecomments_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suggestedplace`
--
ALTER TABLE `suggestedplace`
  ADD CONSTRAINT `suggestedplace_ibfk_1` FOREIGN KEY (`MadeBy`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suggestedroute`
--
ALTER TABLE `suggestedroute`
  ADD CONSTRAINT `suggestedroute_ibfk_1` FOREIGN KEY (`MadeBy`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`IdRoute`) REFERENCES `route` (`IdRoute`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`IdPlace`) REFERENCES `place` (`IdPlace`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
