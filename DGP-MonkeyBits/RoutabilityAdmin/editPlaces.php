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
         $localization=$_POST['localization'];
         $imagen=$_POST['imagen'];
         $imagenDesc=$_POST['imagenDescription'];
         $mov = $_POST['movilidad'];
         $vis = $_POST['vision'];
         $col = $_POST['color'];
         $sor = $_POST['sordo'];
         $ext = $_POST['extranjero'];
    
    if(!($QUERY = mysqli_query($conexion, "UPDATE `place` SET `Name`='".$nombre."', `Description`='".$descripcion."', `Localitation`='".$localization."', `Image`='".$imagen."', `ImageDescription`='".$imagenDesc."', `RedMovility`='".$mov."', `RedVision`='".$vis."', `ColourBlind`='".$col."', `Deaf`='".$sor."', `Foreigner`='".$ext."' WHERE `IdPlace`=".$id))){
    
        $MESSAGE = "ERROR AL EDITAR EL LUGAR";
        
        echo "Fallo del query de lugares";
        exit();
    }
    else{
        
        $nomb=$nombre;
        $desc=$descripcion;
        $loc=$localization;
        $img=$imagen;
        $imgdesc=$imagenDesc;
        $movilidad=$mov;
        $vision=$vis;
        $color=$col;
        $sordo=$sor;
        $extranjero=$ext;
        
        $MESSAGE = "LUGAR EDITADO";
    }

} else {
        
        if(!($text_result = mysqli_query($conexion, "SELECT * FROM place WHERE IdPlace=".$id))){
    
            echo "Fallo del query de selección de lugar";
            exit();

        }
    
        $texto = mysqli_fetch_assoc($text_result);
        $nomb=$texto['Name'];
        $desc=$texto['Description'];
        $loc=$texto['Localitation'];
        $img=$texto['Image'];
        $imgdesc=$texto['ImageDescription'];
        $movilidad=$texto['RedMovility'];
        $vision=$texto['RedVision'];
        $color=$texto['ColourBlind'];
        $sordo=$texto['Deaf'];
        $extranjero=$texto['Foreigner'];
    

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
    <link rel="stylesheet" href="theme.css" type="text/css">
    <link rel="stylesheet" href="fonts.css" type="text/css">
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

                <h1>Editar un lugar</h1>

                <?php echo "<form action='editPlaces.php?id=".$id."' method='post'>"; ?>
                <div class="row">

                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Nombre del lugar</b></h4><input type='nombre' class='form-control' required value='".$nomb."' name='nombre' placeholder='Introducir el nombre' onBlur='if(this.value=='')this.value='nombre'' onFocus='if(this.value=='nombre')this.value='''></div>"?>
                    </div>
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Imagen del lugar</b></h4><input type='imagen' class='form-control' required value='".$img."' name='imagen' placeholder='Introducir la imagen' onBlur='if(this.value=='')this.value='imagen'' onFocus='if(this.value=='imagen')this.value='' '></div>"?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Descripción del lugar</b></h4><br/><textarea name='descripcion' placeholder='Escribe la descripción del lugar...' maxlength='10000' rows='10' cols='56' onFocus='if(this.value=='descripcion')this.value='' '>".$desc."</textarea></div>"?>
                    </div>
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Vista previa</b></h4><img title='Imagen Lugar' alt='Imagen Lugar' class='img-fluid d-block float-left p-2' style='border-radius: 15px 50px 30px;' src='".$img."' width='640' height='320'></div>"?>
                    </div>
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Descripción de la imagen</b></h4><br/><textarea name='imagenDescription' placeholder='Escribe la descripción de la imagen...' maxlength='10000' rows='10' cols='56' onFocus='if(this.value=='imagenDescription')this.value='' '>".$imgdesc."</textarea></div>"?>
                    </div>
                    <div class="col-md-6">
                        <?php echo "<div class='form-group'> <h4><b>Localización del lugar</b></h4><br/><textarea  name='localization' placeholder='Escribe la localización del lugar...' maxlength='10000' rows='10' cols='56' onFocus='if(this.value=='localization')this.value='' '>".$loc."</textarea></div>"?>
                        <hr>
                        <div>
                            <input class="btn btn btn-primary btn-light icon-home" type="submit" name="editar" value="Editar">
                            &nbsp<a class="btn btn btn-primary btn-light icon-library" href="viewPlaces.php">&nbsp;Volver a lista de lugares</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4><b>Accesibilidad del lugar</b></h4><br />

                            <div class="accesibilidad" style="padding:16px;">
                                <p class="icon-wheelchair">&nbsp&nbsp Movilidad Reducida: <select name="movilidad" id="movilidad">

                                        <?php
    
                                        if($movilidad == 1){
                                        
                                            echo "<option selected value=1>Si</option>";
                                            echo "<option value=0>No</option>";
                                        }
                                        else{
                                            
                                            echo "<option value=1>Si</option>";
                                            echo "<option selected value=0>No</option>";
                                        }
                                    ?>
                                    </select></p>

                                <p class="icon-eye-minus">&nbsp&nbsp Visión Reducida: <select name="vision" id="vision">

                                        <?php
                                        if($vision == 1){
                                        
                                            echo "<option selected value=1>Si</option>";
                                            echo "<option value=0>No</option>";
                                        }
                                        else{
                                            
                                            echo "<option value=1>Si</option>";
                                            echo "<option selected value=0>No</option>";
                                        }
                                        ?>

                                    </select></p>

                                <p class="icon-eyedropper">&nbsp&nbsp Daltónicos: <select name="color" id="color">

                                        <?php
                                        if($color == 1){
                                        
                                            echo "<option selected value=1>Si</option>";
                                            echo "<option value=0>No</option>";
                                        }
                                        else{
                                            
                                            echo "<option value=1>Si</option>";
                                            echo "<option selected value=0>No</option>";
                                        }
                                        ?>

                                    </select></p>

                                <p class="icon-deaf">&nbsp&nbsp Incapacidad auditiva: <select name="sordo" id="sordo">

                                        <?php
                                        if($sordo == 1){
                                        
                                            echo "<option selected value=1>Si</option>";
                                            echo "<option value=0>No</option>";
                                        }
                                        else{
                                            
                                            echo "<option value=1>Si</option>";
                                            echo "<option selected value=0>No</option>";
                                        }
                                        ?>

                                    </select></p>

                                <p class="icon-language">&nbsp&nbsp Idiomas: <select name="extranjero" id="extranjero">

                                        <?php
                                        if($extranjero == 1){
                                        
                                            echo "<option selected value=1>Si</option>";
                                            echo "<option value=0>No</option>";
                                        }
                                        else{
                                            
                                            echo "<option value=1>Si</option>";
                                            echo "<option selected value=0>No</option>";
                                        }
                                        ?>

                                    </select></p>
                            </div>

                        </div>
                        <?php echo "</form>"?>
            </fieldset>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
</body>

</html>
