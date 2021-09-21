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

$seleccion_obras = "SELECT * FROM obras";

if(!($resultado_obras = mysqli_query($conexion, $seleccion_obras))){
    
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
    <script type="text/javascript" src="static/buscadorObras.js"></script>

    <div id="popup" class="popup">

        <h1>Listado de Obras</h1>

        <fieldset>

            <form>

                <?php
        
                while($array_resultado_obras = mysqli_fetch_assoc($resultado_obras)) {
                    echo "<div><b>".$array_resultado_obras["Nombre"]."</b>"."</br></br>"."<img class='imgtabla' src='".$array_resultado_obras["imagen"]."'></div>";
                    echo "<a class='fa fa-eraser' title='Borrar' href='borrarObras.php?id=".$array_resultado_obras["id"]."'></a>&nbsp&nbsp&nbsp<a class='fa fa-file-text' title='Editar' href='editarObras.php?id=".$array_resultado_obras["id"]."'></a>";
                    echo "<hr />";
                }
        
                ?>

            </form>

        </fieldset>

        <?php echo "<a class='botonlista'' href='logueado.php?user=".$tipo."'>Volver a la página principal</a><br/>"; ?>

    </div>

    </html>
