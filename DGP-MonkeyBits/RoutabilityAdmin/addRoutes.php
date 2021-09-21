<?php

$MESSAGE = "";
$imagenDescripcion = "";

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

if(isset($_POST["aniadir"])){
 
    if(!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['lugares']) && !empty($_POST['imagen'])){
         
         $nombre=$_POST['nombre'];
         $descripcion=$_POST['descripcion'];
         $imagen=$_POST['imagen'];
         $imagenDesc=$_POST['imagenDescripcion'];
         $email = $_SESSION['EMAIL'];

        if(!($QUERY = mysqli_query($conexion, "INSERT INTO `route`(`IdRoute`, `Email`, `MadeBy`, `Name`, `Description`, `Image`, `ImageDescription`) VALUES (null, '$email', null, '$nombre', '$descripcion', '$imagen', '$imagenDesc')"))){

            echo "Fallo del query de rutas";
            exit();
        }
        
        if(!($ruta = mysqli_query($conexion, "SELECT * FROM `route` WHERE `Name`='".$nombre."'"))){

            echo "Fallo del query de obtención de id de ruta";
            exit();
        }
        
        $route = mysqli_fetch_assoc($ruta);
        $id = $route["IdRoute"];
        $sequence=1;
        $lugares = $_POST['lugares'];

        foreach ($lugares as $lugar=>$value) {

            if(!($QUERY = mysqli_query($conexion, "INSERT INTO `appearverified`(`IdPlace`, `IdRoute`, `Sequence`) VALUES ('$value', '$id', '$sequence')"))){

                echo "Fallo del query de adición de lugares";
                exit();
            }
            
            $sequence+=1;
        }

        $MESSAGE = "RUTA AÑADIDA";
    
    } else {
      
        $MESSAGE = "ERROR AL AÑADIR LA RUTA";
     }
}

$search = '';
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  }
$consultaLugares = "SELECT * FROM place where";

 $primerFiltro = true;

  if (isset($_POST['filtroRedMovility'])) {
    if($_POST['filtroRedMovility']=='on') {
        $consultaLugares .=" RedMovility='1'";
        $primerFiltro = false;
    }
  }
  if (isset($_POST['filtroRedVision'])) {
    if($_POST['filtroRedVision']=='on') {
      if (!$primerFiltro) {
        $consultaLugares .=" and RedVision='1'";
      }
      else {
        $consultaLugares .=" RedVision='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroForeigner'])) {
    if($_POST['filtroForeigner']=='on') {
      if (!$primerFiltro) {
        $consultaLugares .=" and Foreigner='1'";
      }
      else {
        $consultaLugares .=" Foreigner='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroColourBlind'])) {
    if($_POST['filtroColourBlind']=='on') {
      if (!$primerFiltro) {
        $consultaLugares .=" and ColourBlind='1'";
      }
      else {
        $consultaLugares .=" ColourBlind='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroDeaf'])=='on') {
    if($_POST['filtroDeaf']) {
      if (!$primerFiltro) {
        $consultaLugares .=" and Deaf='1'";
      }
      else {
        $consultaLugares .=" Deaf='1'";
        $primerFiltro=false;
      }
    }
  }
  if (!$primerFiltro)
    $consultaLugares .= " and (IdPlace like '%".$search."%' or Name like '%".$search."%') ORDER BY IdPlace";
  else {
    $consultaLugares .= " (IdPlace like '%".$search."%' or Name like '%".$search."%') ORDER BY IdPlace";
    $primerFiltro = false;
  }
  $resultado_lugares = mysqli_query($conexion, $consultaLugares);
  $total = mysqli_num_rows($resultado_lugares);
       
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
          <h1>Añadir una ruta</h1>
          <h4><b>Lugares:</b></h4>
            <div class="py-2" style="">
              <div class="container py-3 px-3">
                <div class="row">
                  <form action="" method="post" name="search_form" id="search_form" class="col-md-12">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form">
                              <input type="text" placeholder="Filtre sus lugares a añadir..." name="search" id="search">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form" style="background-color: white; padding:5px; height:50px; padding-top:12px;">
                              <span class="icon-wheelchair" style="padding-left: 4%;">&nbsp;<input type="checkbox" name="filtroRedMovility" title="Apto para movilidad reducida"></span>
                              <span class="icon-eye-minus" style="padding-left: 4%;">&nbsp;<input type="checkbox" name="filtroRedVision" title="Apto para visibilidad reducida"></span>
                              <span class="icon-eyedropper" style="padding-left: 4%;">&nbsp;<input type="checkbox" name="filtroColourBlind" title="Apto para daltónicos"></span>
                              <span class="icon-deaf" style="padding-left:4%;">&nbsp;<input type="checkbox" name="filtroDeaf" title="Apto para sordos"></span>
                              <span class="icon-language" style="padding-left: 4%;">&nbsp;<input type="checkbox" name="filtroForeigner" title="Apto en varios idiomas"></span>
                              <input type="submit" id="aplicar-cambios" name="aplicar-cambios" value="Filtrar" style="margin-right: 4%; float: right;">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            <fieldset>

                <form action="addRoutes.php" method="post">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                              <div class="scroll" style="border-radius:5px; background-color:white;">
                                  <?php
    
                                  if ($total) {
                                      while($array_resultado =  mysqli_fetch_assoc($resultado_lugares)) {
                                          echo"<p>&nbsp&nbsp<input name='lugares[]' type='checkbox' id='".$array_resultado['IdPlace']."' value=".$array_resultado['IdPlace']."<br/>&nbsp&nbsp<b>".$array_resultado['Name']." (".$array_resultado['IdPlace'].")</b></p>";
                                      }
                                  }
                                  ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <h4><b>Nombre de la ruta:</b></h4><input type="nombre" class="form-control" required value="" name="nombre" placeholder="Introducir el nombre" onBlur="if(this.value=='')this.value='nombre'" onFocus="if(this.value=='nombre')this.value='' ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4><b>Imagen de la ruta:</b></h4><input type="imagen" class="form-control" required value="" name="imagen" placeholder="Introducir la imagen" onBlur="if(this.value=='')this.value='imagen'" onFocus="if(this.value=='imagen')this.value='' ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4><b>Descripción de la ruta:</b></h4><br /><textarea required value="" name="descripcion" placeholder="Escribe la descripción de la ruta..." maxlength="10000" rows="10" cols="56" style="width:100%; height: 50%;" onFocus="if(this.value=='descripcion')this.value='' "></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                        <h4><b>Descripción de la imagen</b></h4>
                                        <textarea style="margin-top: 22px;" required value="" name="imagenDescripcion" placeholder="Escribe la descripción de la imagen..." maxlength="10000" rows="10" cols="56" style="width:100%; height: 50%;" onFocus="if(this.value=='imagenDescripcion')this.value='' "></textarea>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                                    <input class="btn btn btn-primary btn-light icon-home" type="submit" name="aniadir" value="Añadir">
                                    &nbsp<a class="btn btn btn-primary btn-light icon-home" href="Home.php">&nbsp;Volver a administración</a>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
</body>

</html>
