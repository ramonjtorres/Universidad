<?php

  session_start();

    if($_SESSION['TIPO'] == "Registrado"){ $tipo = 1;}
    else if($_SESSION['TIPO'] == "Moderador"){ $tipo = 2;}
    else if($_SESSION['TIPO'] == "Gestor"){ $tipo = 3;}
    else if($_SESSION['TIPO'] == "Administrador"){ $tipo = 4;}

  $id_obra = $_GET["id"];

  $conexion = mysqli_connect("localhost", "root", "");
  $BD = mysqli_select_db($conexion, "museo");

if(isset($_POST["enviar"])){

  $nombre = $_SESSION['USERNAME'];
  $email = $_SESSION['EMAIL'];    
  $comment = $_POST["comment"];
  $ip = $_SERVER['REMOTE_ADDR'];
  $date = date(c);

  if(isset($_POST["comment"]) && !empty($_POST["comment"])){

      mysqli_query($conexion, "INSERT INTO `comentarios` (`comentarios_obra`, `IP`, `Nombre`, `Correo`, `Fecha`, `Texto`) VALUES ($id_obra, '$ip','$nombre', '$email', '$date', '$comment')");
      echo "Comentario entregado";
  }
  else{
      
     echo "Problemas al enviar comentarios";
  }
}

header("Location: logueado.php?user=".$tipo);

?>
