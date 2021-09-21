<?php

$id = $_GET["id"];
$MESSAGE = "";

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

if(isset($_POST["editar"])){
         
         $nombre=$_POST['nombre'];
         $descripcion=$_POST['descripcion'];
         $imagen=$_POST['imagen'];
         $imageDescription = $_POST['Imagedescription'];
    
        //EDITAMOS TABLA RUTA
        if(!($QUERY = mysqli_query($conexion, "UPDATE `route` SET `Name`='".$nombre."', `Description`='".$descripcion."', `Image`='".$imagen."', `ImageDescription`='".$imageDescription."' WHERE `IdRoute`=".$id))){

            $MESSAGE = "ERROR AL EDITAR LA RUTA";
        }
    
        //EDITAMOS TABLA APPEAR
        if(!($text_result2 = mysqli_query($conexion, "SELECT Sequence FROM appearverified WHERE IdRoute=".$id." ORDER BY Sequence ASC"))){
    
            echo "Fallo del query de selección de puntos de ruta";
            exit();

        }
    
        $texto2 = mysqli_fetch_assoc($text_result2);
    
        $sequence=$texto2['Sequence'];
        $lugares = $_POST['lugares'];
    
        //ELIMINAMOS LOS LUGARES DE LA RUTA
        if(!($QUERY2 = mysqli_query($conexion, "DELETE FROM `appearverified` WHERE IdRoute=".$id))){
        
            $MESSAGE = "ERROR AL BORRAR LOS PUNTOS DE RUTA";
        }
    
        foreach ($lugares as $lugar=>$value) {
            
            //INTRODUCIMOS LOS NUEVOS LUGARES DE LA RUTA
            if(!($QUERY2 = mysqli_query($conexion, "INSERT INTO `appearverified`(`IdPlace`, `IdRoute`, `Sequence`) VALUES ('".$value."', '".$id."', '".$sequence."')"))){

                $MESSAGE = "ERROR AL EDITAR LOS PUNTOS DE RUTA";
            }
            
            $sequence+=1;
        }
    
            $nomb=$nombre;
            $desc=$descripcion;
            $img=$imagen;
            $imgdesc=$imageDescription;
            
            $MESSAGE = "RUTA EDITADA";

} else {
        
        //OBTENEMOS LOS DATOS QUE YA TENIAMOS DE LA BBDD PARA MOSTRARLOS Y SER EDITABLES
        if(!($text_result = mysqli_query($conexion, "SELECT * FROM route WHERE IdRoute=".$id))){
    
            echo "Fallo del query de selección de ruta";
            exit();

        }
    
        $texto = mysqli_fetch_assoc($text_result);
        $nomb=$texto['Name'];
        $desc=$texto['Description'];
        $img=$texto['Image']; 
        $imgdesc=$texto['ImageDescription']; 

}
       
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoutabilityAdmin</title>
    <link rel="shortcut icon" href="./img/monkeybits2.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./theme.css" type="text/css">
    <link rel="stylesheet" href="./fonts.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function mostrarAccion(mens) {
        alert(mens);
      }
      $(document).ready(function() {
        var men = '<?php echo $MESSAGE; ?>';
        if (men != "")
          mostrarAccion(men);
      });
  </script>
</head>

<body class="bg-primario">
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="display-3"><b>Routability: Granada</b></h1>
                </div>
            </div>

            <fieldset>

                <h1>Editar una ruta</h1>

                <?php echo"<form action='editRoutes.php?id=".$id."' method='post'>"; ?>
                <div class="row">

                    <div class="col-md-6">
                        <?php echo"<div class='form-group'> <h4><b>Nombre de la ruta:</b></h4><input type='nombre' class='form-control' required value='".$nomb."' name='nombre' placeholder='Introducir el nombre' onBlur='if(this.value=='')this.value='nombre'' onFocus='if(this.value=='nombre')this.value='' '></div>"; ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo"<div class='form-group'> <h4><b>Imagen de la ruta:</b></h4><input type='imagen' class='form-control' required value='".$img."' name='imagen' placeholder='Introducir la imagen' onBlur='if(this.value=='')this.value='imagen'' onFocus='if(this.value=='imagen')this.value='' '></div>"; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Descripción de la ruta</b></h4><br/><textarea name='descripcion' placeholder='Escribe la descripción de la ruta...' maxlength='10000' rows='10' cols='56' onFocus='if(this.value=='descripcion')this.value='' '>".$desc."</textarea></div>";?>
                    </div>
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Vista previa</b></h4><img title='Imagen Ruta' alt='Imagen Ruta' class='img-fluid d-block float-left p-2' style='border-radius: 15px 50px 30px;' src='".$img."' width='640' height='320'></div>"?>
                    </div>
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Descripción de la imagen</b></h4><br/><textarea name='Imagedescription' placeholder='Escribe la descripción de la imagen...' maxlength='10000' rows='10' cols='56' onFocus='if(this.value=='Imagedescription')this.value='' '>".$imgdesc."</textarea></div>";?>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <h4><b>Lugares:</b></h4><br />
                            <div class="scroll" style="border-radius:5px; background-color:white;">
                                <?php
                                    
                                //SE OBTIENEN DE LA BBDD LOS LUGARES QUE NO SON DE LA RUTA
                                $resultado_lugares = mysqli_query($conexion, "SELECT place.IdPlace, place.Name FROM `place` WHERE NOT place.IdPlace IN (SELECT appearverified.IdPlace FROM appearverified WHERE appearverified.IdRoute=".$id.")");

                                if ($resultado_lugares->num_rows > 0) {

                                    //BUCLE DE LUGARES DE LA RUTA
                                    while($array_resultado = mysqli_fetch_assoc($resultado_lugares)){    

                                        echo"<p>&nbsp&nbsp<input name='lugares[]' type='checkbox' id='".$array_resultado['IdPlace']."' value=".$array_resultado['IdPlace']." <br/>&nbsp&nbsp<b>".$array_resultado['Name']."</b></p>";

                                    }
                                }
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4><b>Lugares de la ruta:</b></h4><br />
                            <div class="scroll" style="border-radius:5px; background-color:white;">
                                <?php
                                
                                //SE OBTIENEN DE LA BBDD LOS LUGARES DE LA RUTA
                                $resultado_lugares_appear = mysqli_query($conexion, "SELECT appearverified.IdPlace, place.Name FROM `appearverified`,`place` WHERE appearverified.IdPlace = place.IdPlace AND appearverified.IdRoute=".$id." ORDER BY appearverified.Sequence ASC");

                                if ($resultado_lugares_appear->num_rows > 0) {

                                    //BUCLE DE LUGARES DE LA RUTA
                                    while($array_resultado2 = mysqli_fetch_assoc($resultado_lugares_appear)){    

                                        echo"<p>&nbsp&nbsp<input name='lugares[]' type='checkbox' id='".$array_resultado2['IdPlace']."' value=".$array_resultado2['IdPlace']." checked <br/>&nbsp&nbsp<b>".$array_resultado2['Name']."</b></p>";

                                    }
                                }
                                    ?>
                            </div>
                            <hr>
                            <div>
                                <input class="btn btn btn-primary btn-light icon-home" type="submit" name="editar" value="Editar">
                                &nbsp<a class="btn btn btn-primary btn-light icon-map" href="viewRoutes.php">&nbsp;Volver a lista de rutas</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo"</form>";?>
            </fieldset>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
</body>

</html>
