<?php

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

$id_obra = $_GET["obra"];
$seleccion_datos = "SELECT * FROM obras WHERE id = ".$id_obra;
$seleccion_comentarios = "SELECT * FROM comentarios WHERE comentarios_obra = ".$id_obra;

if(!($resultado_datos = mysqli_query($conexion, $seleccion_datos))){
    
    echo "Fallo del query";
    exit();
}

if(!($resultado_comentarios = mysqli_query($conexion, $seleccion_comentarios))){
    
    echo "Fallo del query de comentarios";
    exit();
}

//Pasamos el resultado a un array para extraer el id

$array_resultado_datos = mysqli_fetch_assoc($resultado_datos);
//$array_resultado_comentarios = mysqli_fetch_assoc($resultado_comentarios);

//Extraemos del array las variables que utilizaremos

$nombre = $array_resultado_datos["Nombre"];
$fecha = $array_resultado_datos["fecha"];
$dimensiones = $array_resultado_datos["dimensiones"];
$procedencia = $array_resultado_datos["procedencia"];
$comentario = $array_resultado_datos["comentario"];
$imagen = $array_resultado_datos["imagen"];
mysqli_close($conexion);

?>

    <!DOCTYPE html>
    <html lang="es">

    <?php
    
    $user = $_GET["user"];  
    
    include "head.php";

    if($user == 0){    
    
        include "header.php";
    } else{
        
        include "headerLog.php";
    }
    
    ?>

        <body>

            <?php
        
        include "sidebarObras.php";
        include "obra.php";
        include "comentarios.php";
        include "footer.php";
        
        ?>

        </body>

    </html>
