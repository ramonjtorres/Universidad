<?php

    $value = $_GET["id"];

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

    if(!($QUERY = mysqli_query($conexion, "DELETE FROM `obras` WHERE `id`=".$value))){
    
        echo "Fallo del query";
        exit();
    }else{
        
        echo "Obra borrada correctamente";
    }

    echo "<a class='botonlista'' href='logueado.php?user=".$tipo."'>Volver a la página principal</a><br/>";

?>
