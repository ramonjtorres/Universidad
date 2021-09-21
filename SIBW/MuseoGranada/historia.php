<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Mi museo</title>

    <link rel="stylesheet" href="static/style.css">
    <!-- SE UTILIZA PARA UTILIZAR LOS ESTILOS DE CSS -->
    <link rel="shortcut icon" href="static/img/museo300x300.png" type="image/png">

</head>

<body>

    <?php
    
        $user = $_GET["user"];  
    
        if($user == 0){    
    
            include "header.php";
        } else{

            include "headerLog.php";
        }
    
        include("sidebar.php");
    
        ?>

        <article>

            <p class="texto">El Museo Arqueológico de Granada fue uno de los primeros fundados en España, junto a los de Barcelona y Valladolid, siguiendo las huellas del Museo Arqueológico Nacional, creado en 1867. Entre los años 1842 y 1879 no existió como tal museo sino que fue un Gabinete de Antigüedades dependiente de la Comisión de Monumentos de Granada, a cargo del eminente pintor Manuel Gómez-Moreno González, que además se encargó de recoger los primeros restos que se hallaron en Atarfe pertenecientes a la antigua ciudad emiral-califal de Medina Elvira (siglo VIII-XI) y otros de distintas épocas que fueron donados a dicha Comisión.</p>

            <p class="texto">Los esfuerzos de la Comisión de Monumentos y del Ayuntamiento de la ciudad dieron como fruto la creación en el año 1879 del Museo Arqueológico Provincial de Granada, formando su primera colección con los fondos de la Comisión de Monumentos, con dos secciones: Arqueológica y de Bellas Artes. Su primer director fue Francisco Góngora del Carpio (1879-1919), hijo del célebre arqueólogo Francisco de Góngora y Martínez. Desde esta fecha hasta mediados del siglo XX compartió local con la Comisión de Monumentos, o con la Academia de Nª Sª de las Angustias, y sufrió un largo peregrinaje por distintos edificios de la ciudad como el Convento de Santa Cruz la Real, unos bajos del Ayuntamiento, y un edificio en la Calle Arandas, ninguno de ellos apropiado para la función museística.</p>

            <p class="texto">En 1917 se adquirió la Casa de Castril, a los herederos del insigne arabista Leopoldo Eguilaz y Yanguas, para ubicar definitivamente el Museo. La casa se halla enclavada en la Carrera del Darro, en el antiguo barrio árabe de Ajsaris, sede a partir del siglo XVI de parte de la nobleza granadina, como muestran sus construcciones blasonadas. La Casa de Castril es uno de las mejores palacios renacentistas de Granada y perteneció a la familia de Hernando de Zafra, secretario de los Reyes Católicos, que participó activamente en la conquista de Granada y en sus Capitulaciones. En lo alto de la fachada está grabada la fecha de su construcción: 1539. Esta obra ha sido atribuída a Sebastián de Alcántara, uno de los más destacados discípulos de Diego de Siloe.</p>

            <p class="texto">También aparece en la fachada el escudo de la familia con la torre de Comares de la Alhambra, en la que podemos observar perfectamente las celosías de madera de las ventanas principales del salón como existían en su época y que con acierto han sido colocadas de nuevo por el Patronato de la Alhambra. Una bella ventana de esquina en lo alto tiene el lema ¿Esperándola del Cielo¿, que ha sido inspiración de diversas leyendas románticas:</p>

            <p class="texto">Esta casa señorial está formada por un zaguán con escalera y ventanales de clara tradición renacentista desde el que se accede hasta el patio central con salas abiertas a las galerías baja y alta, y un bello jardín posterior. Sufrió una transformación radical para la instalación en ella del Museo. De 1917 a 1941 el arquitecto Fernando Wilhelmi Manzano realizó en ella una profunda reforma estructural, respetando los elementos constructivos más destacados, como la escalera del zaguán, las galerías del patio o algunas armaduras de madera del techo de las salas. Además, al Norte del jardín de la casa, añadió un pabellón de dos plantas. El Museo de Bellas Artes que ocupaba el pabellón nuevo a Norte del jardín, se trasladó al palacio de Carlos V en 1946. Francisco Prieto-Moreno Pardo será el arquitecto que haga las reformas posteriores de 1955 a 1974. En 1962 se adquirió la Casa del pintor Rafael Latorre, aledaña a la Casa de Castril para convertirla en una ampliación del espacio del Museo.</p>

            <p class="texto">En ese largo periodo fueron sus directores Joaquín Villalba Bru (1919-1922), y personalidades de tal relevancia en la vida cultural y universitaria granadina como Antonio Gallego Burín (1922-1931) y Joaquina Egüaras Ibáñez (1931-1967).</p>

            <p class="texto">Siendo directora Angela Mendoza Egüaras (1967-1988), se realizó su configuración actual, trás la reforma de 1970, que abarcan desde la Prehistoria hasta el final de la Edad Media. En 1980 se creó la Sección Etnológica pero nunca se ha desarrollado por desgracia, aunque existen en reserva espléndidas colecciones de vidrio de Castril y de cerámica granadina de Fajalauza.</p>

            <p class="texto">En 1984 la Junta de Andalucía asumió las competencias en materia de cultura y con ella este Museo, comenzando una larga etapa de renovación y modernización. En la actualidad estamos en un proceso de remodelación global en el que se contemplan como ejes básicos la valoración de pocas piezas y su exposición atendiendo a la nueva didáctica, aplicando los modernos medios multimedia. Este nuevo discurso expositivo permitirá la comprensión de objetos y etapas históricas a los visitantes de cualquier nivel cultural, pero sobre todo incidiendo en la etapa escolar.</p>

        </article>

        <?php
    include("footer.php");
    ?>
</body>

</html>
