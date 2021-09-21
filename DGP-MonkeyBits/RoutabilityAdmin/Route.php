<?php

  $MESSAGE = "";
  $id = $_GET['id'];

  session_start();

  //Consultamos los datos de la obra

  $conexion = mysqli_connect("localhost", "root", "");
  $BD = mysqli_select_db($conexion, "bdr");

  //Comprueba conexion
  if(mysqli_connect_errno()){
    
      echo "Fallo de conexión: ".mysqli_connect_error();
      exit();
  }

  /* cambiar el conjunto de caracteres a utf8 */
  if (!$conexion->set_charset("utf8")) {
            
      printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexion->error);
      exit();
  }

  if(!($Routes = mysqli_query($conexion,"SELECT * FROM route WHERE IdRoute=".$id))){
    
            echo "Fallo del query de selección de la ruta";
            exit();

        }

  if(!($Places = mysqli_query($conexion, "SELECT * FROM appearverified, place WHERE place.IdPlace = appearverified.IdPlace AND appearverified.IdRoute=".$id))){
    
            echo "Fallo del query de selección del lugar";
            exit();

  }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoutabilityAdmin</title>
    <link rel="shortcut icon" href="./img/monkeybits2.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.1.3.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="fonts.css" type="text/css">

</head>

<body class="bg-primario">
    <div class="py-2" style="">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="">
                    <div class="list-group">
                        <h3><a href="#" class="list-group-item list-group-item-action active list-group-item-info icon-map">&nbsp;Información de la ruta</a></h3>
                        <?php

                  if ($Routes != NULL)
                    $rutas = mysqli_fetch_array($Routes);
                  
                    if ($rutas != NULL) {

                    $id = $rutas["IdRoute"];
                    $nombre = $rutas["Name"];
                    $desc = $rutas["Description"];
                    $img = $rutas["Image"];
                    $imgdesc = $rutas["ImageDescription"];
                    
                    $movilidad=1;
                    $vision=1;
                    $color=1;
                    $sordo=1;
                    $extranjero=1;
                        
                    while($array_resultado = mysqli_fetch_assoc($Places)){
                        
                        $movilidad*=$array_resultado['RedMovility'];
                        $vision*=$array_resultado['RedVision'];
                        $color*=$array_resultado['ColourBlind'];
                        $sordo*=$array_resultado['Deaf'];
                        $extranjero*=$array_resultado['Foreigner'];
                       
                    }    
                        
                    echo '<div class="list-group-item list-group-item-action miembro-lista">';
                    echo '<h4><u><b>'.$nombre.'</b></u></h4>'; 
                    echo '<img class="foto" title="foto de '.$nombre.' Descripción:'.$imgdesc.'" alt="Foto de '.$nombre.'" src="'.$img.'">';
                    echo '<p><b>Descripción:</b><br><br>'.$desc.'</p>';
                    echo '<p><b>Accesibilidad:</b>
                    <br><br>';
    
                    if($movilidad == 1){
                                        
                        echo "<b>Movilidad Reducida</b>: Si<br>";
                    }
                    else{
                                        
                        echo "<b>Movilidad Reducida</b>: No<br>";
                    }
                        
                    if($vision == 1){
                                        
                        echo "<b>Vision Reducida</b>: Si<br>";
                    }
                    else{
                                        
                        echo "<b>Vision Reducida</b>: No<br>";
                    }
                    
                    if($color == 1){
                                        
                        echo "<b>Daltónicos</b>: Si<br>";
                    }
                    else{
                                        
                        echo "<b>Daltónicos</b>: No<br>";
                    }
                    
                    if($sordo == 1){
                                        
                        echo "<b>Incapacidad Auditiva</b>: Si<br>";
                    }
                    else{
                                        
                        echo "<b>Incapacidad Auditiva</b>: No<br>";
                    }
                        
                    if($extranjero == 1){
                                        
                        echo "<b>Idiomas</b>: Si<br>";
                    }
                    else{
                                        
                        echo "<b>Idiomas</b>: No<br>";
                    }
                    '</p>';
                    echo '<hr>';
                    echo '<div><b>Lugares de la ruta:</b>';
                                    
                    //SE OBTIENEN DE LA BBDD LOS LUGARES DE LA RUTA
                    $resultado_lugares_appear = mysqli_query($conexion, "SELECT appearverified.IdPlace, place.Name FROM `appearverified`,`place` WHERE appearverified.IdPlace = place.IdPlace AND appearverified.IdRoute=".$id." ORDER BY appearverified.Sequence ASC");

                    if ($resultado_lugares_appear->num_rows > 0) {
                                        
                        //BUCLE DE LUGARES DE LA RUTA
                        while($array_resultado2 = mysqli_fetch_assoc($resultado_lugares_appear)){    
                                    
                            echo"<p><a href='Place.php?id=".$array_resultado2['IdPlace']."'><br/><b>".$array_resultado2['Name']."</b></a></p>";

                        }
                    }

                    echo '</div>';
                    echo '</div>';
                  }              
            ?>
                    </div>
                    <div class="py-2">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo"<a class='btn btn btn-primary btn-light icon-pencil' href='editRoutes.php?id=".$id."'>&nbspEditar</a>";?>
                                <a href="viewRoutes.php" class="btn btn-light icon-map">&nbsp;Volver a lista de rutas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
  mysqli_close($conexion);
?>

</html>
