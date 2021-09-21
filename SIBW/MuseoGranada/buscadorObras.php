<?php

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
    
    $seleccion_datos = "SELECT * FROM obras WHERE comentario LIKE '%$search%'";
      
  if(!($resultado_datos = mysqli_query($conexion, $seleccion_datos))){
    
    echo "Fallo del query";
    exit();
  }

    if (mysqli_num_rows($resultado_datos) > 0){ 
	     
		 echo '<p>Se han encontrado ' . mysqli_num_rows($resultado_datos) . ' resultados </p>';
	     
		 while($fila = mysqli_fetch_assoc($resultado_datos)){ 

             echo $fila['comentario'] . '<br /><hr/>';	 
         }
	  
	  } else{
			  echo "NO HAY RESULTADOS EN LA BBDD";	
	  }

?>
