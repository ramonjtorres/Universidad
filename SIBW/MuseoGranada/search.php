<?php

$user = $_GET["user"];

session_start();

            if($_SESSION['TIPO'] == "Registrado"){ $user = 1;}
            else if($_SESSION['TIPO'] == "Moderador"){ $user = 2;}
            else if($_SESSION['TIPO'] == "Gestor"){ $user = 3;}
            else if($_SESSION['TIPO'] == "Administrador"){ $user = 4;}

if(!isset($_POST['search'])){ exit('No se ha escrito nada');}

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
    
  $search = mysqli_real_escape_string($conexion, $_POST['search']);
    
  if($user == 0){

    $seleccion_datos = "SELECT Nombre, id FROM obras WHERE Nombre LIKE '%$search%' AND publicado = true";

  }
  else{
      
    $seleccion_datos = "SELECT Nombre, id FROM obras WHERE Nombre LIKE '%$search%'";
  }
      
  if(!($resultado_datos = mysqli_query($conexion, $seleccion_datos))){
    
    echo "Fallo del query";
    exit();
  }

  while ($row = mysqli_fetch_assoc($resultado_datos)) {
      
    echo "<option value='index.php?obra=".$row[id]."&user=".$user."'>".$row[Nombre]."</option>";
  }

?>
