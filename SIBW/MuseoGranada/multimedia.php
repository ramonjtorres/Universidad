<!DOCTYPE html>
<html lang="es">

<?php
    
$user = $_GET["user"];    

//Consultamos los datos de la obra

$conexion = mysqli_connect("localhost", "root", "");
$BD = mysqli_select_db($conexion, "museo");

//Idioma
mysqli_set_charset($conexion, 'utf8');


//Comprueba conexion
if(mysqli_connect_errno()){
    
    echo "Fallo de conexión: ".mysqli_connect_error();
    exit();
}

$seleccion_videos = "SELECT * FROM videos";

if(!($resultado_videos = mysqli_query($conexion, $seleccion_videos))){
    
    echo "Fallo del query de videos";
    exit();
}

    include "head.php";
    
    if($user == 0){    
    
        include "header.php";
    } else{
        
        include "headerLog.php";
    }
    
?>

    <body>

        <?php    
      
            include "sidebar.php";
        
        ?>

        <article id="multi">

            <?php if($user != 0){ ?>

            <form action="subir.php" id="video" method="post">
                <p><u><b>Subir video:</b></u></p>
                <p><b>URL: </b><input id="url" required value="url" name="url" type="text" placeholder="URL del video"></p>

                <br/><br/><input type="submit" name="subir" value="Subir"><br/>

            </form>

            <?php }?>

            <!-- TABLA CON VIDEOS -->

            <div class="scroll">

                <?php
                
                    echo "</br>";
                    echo "<hr/>";
                
                    while($array_resultado_videos = mysqli_fetch_assoc($resultado_videos)) {
                        
                        echo "<iframe width='560' height='315'  src='".$array_resultado_videos["url"]."' frameborder='2' allow='autoplay; encrypted-media' allowfullscreen ></iframe>"."</br><b>Usuario: ".$array_resultado_videos["nombre"]."</b>";
                        echo "<hr/>";
                    }
                ?>

                    <div id="videos" style="left:218px"></div>

            </div>

        </article>

        <?php    
        
            include "footer.php";
    
        ?>

    </body>

</html>
