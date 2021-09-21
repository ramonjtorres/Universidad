-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2018 a las 18:16:18
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
-- Base de datos: `museo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coleccion`
--

CREATE TABLE `coleccion` (
  `id` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coleccion`
--

INSERT INTO `coleccion` (`id`, `nombre`) VALUES
(1, 'Objetos'),
(2, 'Recipientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colecciones`
--

CREATE TABLE `colecciones` (
  `id_col` int(100) NOT NULL,
  `id_obra` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colecciones`
--

INSERT INTO `colecciones` (`id_col`, `id_obra`) VALUES
(1, 2),
(1, 8),
(1, 6),
(1, 10),
(1, 11),
(1, 5),
(2, 3),
(2, 1),
(2, 12),
(2, 9),
(2, 7),
(2, 4),
(1, 13),
(1, 13),
(1, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(100) NOT NULL,
  `comentarios_obra` int(20) NOT NULL,
  `IP` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nombre` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Correo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `Texto` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Información de los comentarios';

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentarios_obra`, `IP`, `Nombre`, `Correo`, `Fecha`, `Texto`) VALUES
(1, 1, '192.168.45.0.1', 'Ramon', 'ramonjtorres@correo.ugr.es', '2018-06-18 10:34:09', 'Mola [Mensaje editado por el Moderador]'),
(2, 1, '192.172.68.0.3', 'Fernando', 'fernando4rodri@correo.ugr.es', '2018-06-18 12:44:59', 'No esta mal [Mensaje editado por el Moderador]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacensura`
--

CREATE TABLE `listacensura` (
  `Palabra` varchar(10) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `listacensura`
--

INSERT INTO `listacensura` (`Palabra`) VALUES
('tonto'),
('adufe'),
('cafre'),
('lerdo'),
('melón'),
('orate'),
('ovejo'),
('calvo'),
('patán'),
('Jaime');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id` int(30) NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `dimensiones` text NOT NULL,
  `procedencia` text NOT NULL,
  `comentario` text NOT NULL,
  `imagen` text NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `Nombre`, `fecha`, `dimensiones`, `procedencia`, `comentario`, `imagen`, `publicado`) VALUES
(1, 'Alabastrón con inscripción jeroglífica', '2012-02-02', 'Alabastro, debastado, pulimentación y abrasión. Altura, 57 cm.; diámetro, 33,5 cm. Protohistoria, cultura fenicia, mediados del siglo VII a.C.', 'Necrópolis de Laurita, tumba 16, Almuñécar, Granada.', 'Alabastrón egipcio de forma ovoidal con dos asas, faltándole una. Presenta una inscripción jeroglífica que rodea toda la pieza a la altura de las asas. El texto jeroglífico dice lo siguiente: \'... Tu corazón se embriagará para hacer lo que place constantemente a tu corazón. Embriágate hasta la eternidad. Sé feliz estando sobrio. Lo que ella ama constantemente es la embriaguez. Trenza una corona y colócala sobre tu cabeza (después que) ella se haya untado con incienso. Actúa constantemente de acuerdo con tu corazón Protege en Bubastis al Ka de Osor(cón)...\' . Bubastis es un lugar situado en el Delta del Nilo; Osorcón fue un personaje relacionado con la familia real bubastita que debió vivir en la época de los reyes libios, entre los siglos IX-VIII a.C. La inscripción es una alusión al efecto jubiloso del vino relacionado con la persona de Osorcón, que sería el receptor del vino embasado en este excepcional recipiente. Este alabastrón formaba parte del ajuar de la tumba 15 de la necrópolis de Laurita, en su interior se contenían las cenizas del difunto.', './static/img/alabastronconinscripcion.jpg', 1),
(2, 'Bifaz cordiforme', '2012-02-04', 'Sílex, talla. Longitud, 12 cm.; anchura, 8,9 cm. Paleolítico Inferior, Achelense Superior/ Final, 100.000 a.C.', 'Solana del Zamborino, Fonelas, Granada.', 'El yacimiento de la Solana del Zamborino se sitúa en el Oeste de la depresión de Guadix, a 7 Km. de Fonelas. En 1972 se iniciaron las excavaciones bajo la dirección de Miguel Botella. El estudio de la estratigrafía, de los restos óseos y líticos permitió conocer los diversos usos del lugar: primero, como cazadero de forma ocasional; después, como cazadero estacional de manera intensiva, así como de asentamiento humano durante el periodo que duraba la caza; y por último, se documentó el abandono progresivo del yacimiento. En las distintas campañas de excavaciones se registraron gran cantidad de restos óseos de animales, entre los que predominaban especímenes jóvenes de équidos y bóvidos, y de instrumentos líticos utilizados por los grupos cazadores- recolectores. La industria lítica está realizada sobre todo en cuarzo y cuarcita, siendo escasos los útiles realizados en sílex, como en este caso. El repertorio lítico está compuesto por bifaces, cantos tallados unifaciales y bifaciales, raederas, denticulados, raspadores y muescas. El bifaz es el útil más destacado del Achelense, con mayor grado de complejidad técnica que en las fases anteriores y está realizado por la talla alterna y centrípeta -hacia el centro-, en las dos caras del núcleo de materia prima utilizada hasta conseguir una extremidad distal apuntada que confiere al útil una morfología más larga que ancha.', './static/img/bifazcordiforme.jpg', 1),
(3, 'Copa de vástago cuadrado', '2012-02-05', 'Cerámica, a mano. Altura, 27 cm.; diámetro de la boca, 21 cm.; diámetro de la base, 17,9 cm. Edad del Bronce, cultura argárica, 1.900-1.200 a.C.', 'Cerro de la Encina, Monachil, Granada.', 'Esta copa de pie alto de cerámica, realizada a mano y de cocción oxidante, presenta varias peculiaridades, como su gran tamaño, los mamelones que circundan la parte superior de la copa y la forma cuadrada de su vástago que descansa sobre una base convexa circular. La copa forma parte de la vajilla habitual utilizada en los poblados argáricos del sureste peninsular. Esta vajilla estaba compuesta por cuencos, ollas de formas simples y carenadas y vasos troncocónicos. Estos objetos se utilizaban en las cocinas domésticas y también como elementos de ajuar en los enterramientos situados debajo del suelo de las viviendas. El contexto inmediato de la pieza es poco conocido, aunque se sabe que procede del poblado argárico del Cerro de la Encima.', './static/img/copavastagocuadrado.jpg', 1),
(4, 'Reproducción de diadema', '2012-02-06', 'Oro, batido. Longitud, 53,5 cm.; anchura, 5,7 cm.; grosor, 1,2 cm. Calcolítico, 2.700- 1.800 a.C.', 'Cueva de los Murciélagos, Albuñol, Granada.', 'La diadema es una cinta de oro fina, más ancha en el centro, con perforaciones en los extremos. Está realizada mediante la técnica de batido. Según el relato de Manuel de Góngora, la diadema estaba colocada sobre el cráneo de un esqueleto masculino, que formaba parte de un enterramiento colectivo. Sin embargo, este relato es difícil de creer: primero, porque aunque se conservasen los esqueletos es imposible que éstos se mantuviesen en posición sentada, ya que la pérdida de la masa muscular hace que los huesos pierdan su posición original y caigan al suelo; segundo, porque los materiales cerámicos conservados pertenecen al neolítico y la diádema, por su tipólogía y técnica, pertenecería a un período posterior dentro de la Edad del Cobre; tercero, tanto en el relato como en los comentarios sobre éste se identifican los esqueletos como femeninos y como masculinos, sin embargo, las personas que los identificaron no tenían ninguna formación científica para distinguir las características sexuales de los restos óseos; cuarto, es difícil también que en el neolítico aparezcan enterramientos colectivos, ya que este ritual se documenta en la cultura de los dolmenes. Lo que sí sabemos es: que este tipo de orfebrería se da en el Calcolítico; que la zona de Albuñol está cerca de un yacimiento aurífero secundario ubicado en la depresión de Ugijar-Alcolea; que la Cueva de los Murciélagos, a finales del siglo XIX, se explotó para extraer plomo y que el oro nativo aparece, a veces, asociado en vetas a metales pesados como el plomo.', './static/img/reproducciondiadema.jpg', 1),
(5, 'Crátera de campana de figuras rojas', '2012-02-07', 'Cerámica, torno. Altura, 32 cm.; diámetro boca, 37 cm.; diámetro base, 15,2 cm. Protohistoria, cultura ibérica, siglo IV a.C.', 'Zona de Baza', 'Esta crátera de campana de figuras rojas sobre fondo negro tiene dos escenas pintadas que están limitadas por una cenefa de hojas de laurel entre dos líneas horizontales y por una banda de meandros entre líneas horizontales, con un motivo geométrico central. El anverso presenta una escena con tema dionisiaco. En el centro aparece una figura alada en levitación que lleva en la mano izquierda un collar y en la derecha el tímpano o pandero. Toda la figura y sus objetos están pintados en blanco. Al lado izquierdo de esta figura, que se interpreta como Ariadna, se encuentra una ménade sentada, y junto a ella, un sátiro de pie que porta el tirso, símbolo de Dionisios. Al lado derecho de Ariadna se encuentra un sátiro sentado tocando el aulos, o doble flauta, y a su lado una ménade en pie portando también un tirso y un collar. El reverso presenta una escena de palestra o gimnasio, con tres personajes masculinos en pie envueltos en sus mantos: el de la izquierda mantiene en su mano un disco; un aríbalo -frasco de perfumes y ungüentos- queda en el aire entre la figura anterior y la central, que parece que conversa con la tercera figura, que porta a su vez un báculo -símbolo de autoridad- ; entre ambos aparece un trozo de columna cortada, simulando que el tercer personaje del báculo está en el interior de algún edificio y los otros dos personajes, fuera. La crátera de campana es la forma más popular de los talleres griegos y su difusión por todo el Mediterráneo se produce a partir de la segunda mitad del siglo V a.C. hasta la interrupción del comercio fenicio en el siglo IV a.C. Su presencia en bastante común en necrópolis ibéricas formando parte del ajuar del difunto.', './static/img/Crateracampanafigurasrojas.jpg', 1),
(6, 'Espada de lengua de carpa', '2012-02-08', 'Bronce, molde. Longitud, 80 cm.; empuñadura, 9,5 cm.; anchura de hoja, 4 cm. Edad del Bronce, cultura del Bronce Final, primera mitad siglo X a.C.', 'Cerro de la Miel de Moraleda de Zafayona, Granada.', 'El Cerro de la Miel, junto al Cerro de la Mora, constituye un complejo arqueológico que ha proporcionado una serie de útiles metálicos del Bronce Final interesantes, en el sentido de que quedan contextualizados con el restos de los materiales cerámicos. Entre aquellos se encuentra esta espada de lengua de carpa realizada en bronce en una sola pieza. La empuñadura presenta cinco calados para alojar los remaches para su enmangue. La parte proximal de la empuñadura presenta dos ensanchamientos laterales triangulares que continúan cada uno con una escotadura, que también facilitarían el enmangue. La hoja es tripartita y termina en una punta alargada y fina que es la que le da el nombre de lengua de carpa.', './static/img/espadalenguacarpa.jpg', 1),
(7, 'Fuente carenada con incrustaciones metálicas', '2012-02-09', 'Cerámica, a mano. Altura 12 cm.; diámetro máximo, 31 cm.; botones cobre, 6 cm. Edad del Bronce, cultura del Bronce Final, 850-750 a.C.', 'Pinos-Puente, Granada.', 'Fuente carenada con decoración de incrustaciones metálicas de bronce, con forma de casquete esférico y carena alta. Esta pieza está encuadrada dentro del horizonte Bronce Final II, que se caracteriza por los influjos que desde la cultura tartésica llegan a la zona del sureste. Los últimos momentos de este horizonte están relacionados con los primeros asentamientos fenicios en la costa. Esta fuente parece proceder del Cerro de los Infantes en Pinos Puente, donde existió un asentamiento del Bronce Final caracterizado por grandes cabañas de planta oval cuyo espacio interior no estaba compartimentado pero sí especializado en zonas de distintas tareas domésticas y artesanales.', './static/img/fuentecarenada.jpg', 1),
(8, 'Ídolo antropomorfo masculino', '2012-02-10', 'Marfil tallado. Altura, 16,6 cm.; anchura máxima, 5,2 cm. Calcolítico, 2.700-2.300 a.C.', 'El Malagón, Cúllar, Granada.', 'Este ídolo apareció en los niveles superiores del interior de la cabaña F, de planta circular que mantenía el zócalo de piedra y alzado de tapial, hoy desaparecido. En su interior se documentó un banco adosado a la pared y un hogar. Esta cabaña era parte de un conjunto con otras que formaban un poblado fortificado. La actividad principal de este poblado, que explotaba los recursos minerales de su entorno, estaba relacionada con la metalurgia del cobre. El ídolo es estilizado y le falta la parte superior del cuerpo, donde se localiza un hueco de forma cuadrangular en el que se engarzaría otra pieza que completaría la figura masculina. En cuanto a su significado, hay varias hipótesis: considerado como un objeto artístico dentro de la iconografía de la Edad del cobre o como un elemento simbólico que conectaría la vida cotidiana con la muerte.', './static/img/idoloantropomorfomasculino.jpg', 1),
(9, 'Kotile', '2012-02-11', 'Cerámica, torno. Altura, 8,2 cm.; anchura, 9,5 cm. Protohistoria, cultura fenicia, 650 a.C', 'Necrópolis de Laurita, tumba 19, nicho B, Almuñécar, Granada.', 'Vaso de forma troncocónica invertida con dos asas que está decorado con motivos geométricos en color negro. Es un kotile protocorintio de estilo subgeométrico fechado en la primera mitad del siglo VII a.C. Este vaso de cerámica griega preclásica es un ejemplo del comercio de productos suntuarios que los fenicios llevaban a cabo por todo el Mediterráneo. Su presencia en una tumba está relacionada con los banquetes funerarios de influencia griega que los fenicios adoptarían.', './static/img/kotile.jpg', 1),
(10, 'Frontal de Neandertal', '2012-02-12', 'Hueso. Longitud, 11 cm.; altura, 9 cm. Paleolítico Medio, Musteriense, 100.000-30.000 a.C.', 'Cueva de la Carigüela, Piñar, Granada.', 'Este fósil homínido corresponde, por sus características físicas, al frontal de un niño del tipo neandertal terminal o clásico europeo. Estas características son: el gran espesor de los huesos, el torus supraorbital desarrollado, las órbitas oculares cuadrangulares y un espacio entre ellas bastante ancho. Además del frontal, se excavaron dos fragmentos de parietal pertenecientes a un adulto nearderthal. La Cueva de la Carigüela se situa a unos 600 metros de Piñar, en la comarca granadina de los Montes Orientales. Este yacimiento se conoce desde las primeras décadas del siglo XX. La estratigrafía de la cueva presenta una sedimentación continua desde finales del Pleistoceno Medio, 145.000 a.C., hasta la Edad del Bronce, 1.900 a.C. La etapa más conocida es la del Paleolítico Medio (145.000 - 29.000 a.C.), se trata de la secuencia más larga de esta época encontrada en la Península y una de las más detalladas que se conocen. Durante este intervalo temporal los neardertales frecuentaron la cavidad y dejaron allí no sólo sus instrumentos líticos (la industria denominada Musteriense), sino también los restos de animales que consumieron y otras evidencias de sus distintas actividades, lo que supone información sobre sus modos de vida durante la primera mitad de la última glaciación. Además, cuando la cueva no era habitada, hienas, lobos y leopardos la utilizaban como cubil, añadiendo los fragmentos de sus presas a los huesos abandonados por los neardertales. Lo más probable es que fueran los depredadores los que introdujeran en la cavidad los restos humanos que se han encontrado en sus niveles pleistocénicos, el más importante de los cuales es este fragmento de frontal infantil de Homo nearderthalensis.', './static/img/frontalneandhertal.jpg', 1),
(11, 'Sandalias de esparto', '2012-02-13', 'Esparto, cestería cordada y trenzada. 20 x 10 x 8 cm.; 21 x 9,8 x 8,5 cm. Neolítico Tardío, 3.500-2.700 a.C.', 'Cueva de los Murciélagos, Albuñol, Granada.', 'La Cueva de los Murciélagos, situada en la sierra litoral de la Contraviesa junto a la localidad de Albuñol, fue descubierta en 1831 por un vecino del lugar que aprovechaba la capa de guano depositado por los murciélagos en la entrada de la cueva, sustancia que pudo ser la causante de la buena conservación de los objetos de materia orgánica depositados en su interior. En 1857 una compañía minera inició la explotación de la cueva debido a la aparición de material de plomo. Se abrieron varias salas en el interior, donde se localizaron y destruyeron objetos de gran interés arqueológico, según refiere Manuel de Góngora en su obra de 1868. Este recuperó algunos de manos de los expoliadores, con cuyos informes reconstruiría las circunstancias del descubrimiento. En el repertorio de materiales recuperados por Góngora destacan, por su excepcional conservación, los objetos realizados en esparto: distintos tipos de cestillos, tapaderas, esteras y sandalias. Las dos sandalias del Museo Arqueológico de Granada están realizadas en esparto con núcleo central compuesto, que consiste en rodear ese núcleo con una cuerda en espiral, por torsión ó trenzado, que completa la suela. Entre los objetos recuperados, están presentes también los realizados en madera de roble, como medio cuenco y dos punzones que forman parte del depósito en el Museo Arqueológico de Granada. El yacimiento de La Cueva de los Murciélagos es excepcional debido a los escasos restos orgánicos prehistóricos conservados en la Península.', './static/img/sandaliasesparto.jpg', 1),
(12, 'Urna funeraria con esqueleto infantil', '2012-02-14', 'Cerámica, a mano. Altura, 32,5 cm.; diámetro boca, 33 cm. Edad del Bronce, cultura argárica, 1.900 -1.200 a.C.', 'Fuente Amarga, Galera, Granada.', 'Esta pieza es una urna de cerámica a mano en la que se depósito un cadáver infantil. Tiene forma parabólica y borde recto con incisiones verticales alrededor de todo el diámetro de la boca. Presenta dos mamelones puntiagudos cerca del borde. El yacimiento de Fuente Amarga se sitúa en un cerro junto a la cañada de Fuenteamarga. En la excavación se documentaron diferentes zonas: una de hábitat, con muros de aterrazamiento y algunas sepulturas en el interior de las viviendas; otra con abundantes sepulturas en covacha; y, por último, un silo excavado en la roca y un enterramiento medieval en fosa. En la cultura argárica los tipos de enterramientos documentados son: fosa excavada en la roca; fosa revestida de piedra; fosa profunda; de tipo monumental -gran fosa revestida de piedras y con estructura de madera y ramas- ; en urna, en cista y en pithos.', './static/img/urnafunerariaesqueletoinfantil.jpg', 1),
(13, 'Sacerdote de CÃ¡diz', '0000-00-00', 'Bronce y oro', 'CÃ¡diz, Edad del Hierro. Siglo VII a.C.', 'Escultura conocida con ese nombre, se ha propuesto que sea la representaciÃ³n del dios Ptah, con la cara cubierta con una mÃ¡scara de oro. A pesar de su analogÃ­a no se puede pensar en ella como un dios egipcio y sÃ­, en cambio, como la imagen de alguno de los dioses protectores del comercio internacional que estaba teniendo lugar en la antigua Gadir.\r\n\r\nLa composiciÃ³n de su bronce, con arsÃ©nico y zinc, hace pensar que se trata de una pieza importada, posiblemente de Fenicia.', './static/img/sacerdote.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposusuarios`
--

CREATE TABLE `tiposusuarios` (
  `Tipo` varchar(100) NOT NULL DEFAULT 'Anónimo',
  `Nombre` varchar(1000) NOT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiposusuarios`
--

INSERT INTO `tiposusuarios` (`Tipo`, `Nombre`, `Correo`, `Password`) VALUES
('Administrador', 'admin', 'admin@admin', 'admin'),
('Gestor', 'gestor', 'gestor@gestor', 'gestor'),
('Moderador', 'moderador', 'moder@moder', 'moderador'),
('Registrado', 'RamonJesus', 'ramonjtorres@correo.ugr.es', 'ramon'),
('Registrado', 'Fernando', 'fernanditokitkat@gmail.com', 'kitkat'),
('Registrado', 'Pablito', 'clavounclavito@hotmail.com', 'clavito'),
('Moderador', 'moderador2', 'moder2@moder2', 'moder2'),
('Gestor', 'gestor2', 'gestor2@gestor2', 'gestor2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(30) NOT NULL,
  `nombre` varchar(100) DEFAULT 'Anónimo',
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id`, `nombre`, `url`) VALUES
(1, 'gestor', 'https://www.youtube.com/embed/-qKKz0f9JTI'),
(2, 'gestor', 'https://www.youtube.com/embed/Ytt1ghxYcFw'),
(3, 'gestor', 'https://www.youtube.com/embed/FbsdBmlOVx4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
