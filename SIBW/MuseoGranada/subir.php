<?php

  session_start();

  $conexion = mysqli_connect("localhost", "root", "");
  $BD = mysqli_select_db($conexion, "museo");

  $id = mysqli_query($conexion, "SELECT id FROM `videos` ORDER BY `id` DESC") + 1;
  $name = $_SESSION['USERNAME'];
  $url = $_POST["url"];

  if(isset($_POST["url"]) && !empty($_POST["url"])){

  mysqli_query($conexion, "INSERT INTO `videos` (`id`, `nombre`, `url`) VALUES ($id, '$name','$url')");
  echo "Datos enviados";
  header("Location: multimedia.php?user=1");
  }
  else{
      
     echo "Problemas al insertar los datos";
  }

?>
