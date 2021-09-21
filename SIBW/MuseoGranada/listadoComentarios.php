<?php

session_start();

    if($_SESSION['TIPO'] == "Registrado"){ $tipo = 1;}
    else if($_SESSION['TIPO'] == "Moderador"){ $tipo = 2;}
    else if($_SESSION['TIPO'] == "Gestor"){ $tipo = 3;}
    else if($_SESSION['TIPO'] == "Administrador"){ $tipo = 4;}

include "head.php";

//Consultamos los datos de la obra

$conexion = mysqli_connect("localhost", "root", "");
$BD = mysqli_select_db($conexion, "museo");

//Comprueba conexion
if(mysqli_connect_errno()){
    
    echo "Fallo de conexión: ".mysqli_connect_error();
    exit();
}

$seleccion_comentarios = "SELECT * FROM comentarios";

if(!($resultado_comentarios = mysqli_query($conexion, $seleccion_comentarios))){
    
    echo "Fallo del query de comentarios";
    exit();
}
 
?>

    <!DOCTYPE html>
    <html lang="es">

    <div id="buscador">
        <input type="text" id="search" placeholder="Buscador de descripciones" list="result" />

        <div id="result">

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="static/buscadorComentarios.js"></script>


    <div id="popup" class="popup">

        <h1>Listado de Comentarios</h1>

        <fieldset>

            <form>

                <?php
        
                while($array_resultado_comentarios = mysqli_fetch_assoc($resultado_comentarios)) {
                    echo "<b>".$array_resultado_comentarios["Nombre"]."</b>"."</br></br><b>".$array_resultado_comentarios["Fecha"]."</b>"."<p>".$array_resultado_comentarios["Texto"]."</p>";
                    echo "<a class='fa fa-eraser' title='Borrar' href='borrarComentarios.php?id=".$array_resultado_comentarios["id_comentario"]."'></a>&nbsp&nbsp&nbsp<a class='fa fa-file-text' title='Editar' href='editarComentarios.php?id=".$array_resultado_comentarios["id_comentario"]."'></a>";
                    echo "<hr />";
                }
        
                ?>

            </form>

        </fieldset>

        <?php echo "<a class='botonlista'' href='logueado.php?user=".$tipo."'>Volver a la página principal</a><br/>"; ?>

    </div>

    </html>
