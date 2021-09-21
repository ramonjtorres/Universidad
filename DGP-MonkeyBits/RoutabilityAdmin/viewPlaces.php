<?php

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
  $res = mysqli_query($conexion, "SELECT count(*) from place");
  $numPlaces = mysqli_fetch_array($res);
  $numeroPlaces = $numPlaces[0];
  $numPaginas = $numeroPlaces/10 +1;
  $numUltimaPagina = $numeroPlaces % 10;
  $Places= NULL;
  $consulta = "SELECT * FROM place";
  $primerFiltro = true;

  $search = '';
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  }

  if (isset($_POST['filtroRedMovility'])) {
    if($_POST['filtroRedMovility']=='on') {
        $consulta .=" where RedMovility='1'";
        $primerFiltro = false;
    }
  }
  if (isset($_POST['filtroRedVision'])) {
    if($_POST['filtroRedVision']=='on') {
      if (!$primerFiltro) {
        $consulta .= " and RedVision='1'";
      }
      else {
        $consulta .=" where RedVision='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroForeigner'])) {
    if($_POST['filtroForeigner']=='on') {
      if (!$primerFiltro) {
        $consulta .=" and Foreigner='1'";
      }
      else {
        $consulta .=" where Foreigner='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroColourBlind'])) {
    if($_POST['filtroColourBlind']=='on') {
      if (!$primerFiltro) {
        $consulta .=" and ColourBlind='1'";
      }
      else {
        $consulta .=" where ColourBlind='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroDeaf'])=='on') {
    if($_POST['filtroDeaf']) {
      if (!$primerFiltro) {
        $consulta .=" and Deaf='1'";
      }
      else {
        $consulta .=" where Deaf='1'";
        $primerFiltro=false;
      }
    }
  }
  if (!$primerFiltro) {
    $consulta .= " and (IdPlace like '%".$search."%' or Name like '%".$search."%') ORDER BY IdPlace";
  }
  else {
    $consulta .= " where (IdPlace like '%".$search."%' or Name like '%".$search."%') ORDER BY IdPlace";
    $primerFiltro = false;
  }

  if ($numPlaces[0]>0) {
    $Places = mysqli_query($conexion,$consulta);
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
    <script>
      function mostrarAlert() {
        alert("Lugar eliminado");
      }
    </script>

</head>

<body class="bg-primario">
   <div class="py-2" style="">
      <div class="container py-3 px-3">
        <div class="row">
          <form action="" method="post" name="search_form" id="search_form" class="col-md-12">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="form">
                      <input type="text" placeholder="Buscar lugar..." name="search" id="search">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form" style="background-color: white; padding:5px; height:50px; padding-top:12px;">
                      <span class="icon-wheelchair" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroRedMovility" title="Apto para movilidad reducida"></span>
                      <span class="icon-eye-minus" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroRedVision" title="Apto para visibilidad reducida"></span>
                      <span class="icon-eyedropper" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroColourBlind" title="Apto para daltónicos"></span>
                      <span class="icon-deaf" style="padding-left:3%;">&nbsp;<input type="checkbox" name="filtroDeaf" title="Apto para sordos"></span>
                      <span class="icon-language" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroForeigner" title="Apto en varios idiomas"></span>
                      <input type="submit" id="aplicar-cambios" name="aplicar-cambios" value="Buscar" style="margin-left: 7%;">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <div class="py-2" style="">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="">
                    <div class="list-group">
                        <h3><a href="#" class="list-group-item list-group-item-action active list-group-item-info icon-library">&nbsp;Lista de Lugares</a></h3>
                        <?php
              if (isset($_GET['id'])) {
                
                  $id = $_GET['id'];
                  
                  mysqli_query($conexion, "DELETE from place where IdPlace='".$id."'");
                  
                  header("Location: viewPlaces.php");
              }
              if ($numeroPlaces < 10)
                $maxLista = 10;
              else 
                $maxLista = $numeroPlaces;
              for ($k = 0; $k < $maxLista; $k++) {
                $lugares = NULL;
                if ($lugares == NULL) {
                  if ($Places != NULL)
                    $lugares = mysqli_fetch_array($Places);
                  
                    if ($lugares != NULL) {

                    $id = $lugares["IdPlace"];
                    $nombre = $lugares["Name"];

                    echo '<p class="list-group-item list-group-item-action miembro-lista"><a href="Place.php?id='.$id.'">'.$nombre.'</a>';  
                      
                    echo '<a href="viewPlaces.php?id='.$id.'"><img class="icono" title="Eliminar Lugar" alt="Eliminar Lugar" src="./img/cruz.svg" onclick="mostrarAlert()" /></a>';
                    echo '<a href="editPlaces.php?id='.$id.'"><img class="icono3" title="Editar Lugar" alt="Editar Lugar" src="./img/editar.png" /></a></p>';   
                  }
                }
              }
              
            ?>
                    </div>
                    <div class="py-2">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="Home.php" class="btn btn-light margenes icon-home">&nbsp;Volver a administración</a>
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
