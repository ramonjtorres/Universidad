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

  $primerFiltro = true;

  $search = '';
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  }

  if (isset($_POST['filtroRedMovility'])) {
    if($_POST['filtroRedMovility']=='on') {
        $consulta = "SELECT distinct route.IdRoute, route.Name, RedMovility, route.MadeBy, route.Description, route.Image from route, appearverified, place where appearverified.IdRoute = route.IdRoute and appearverified.IdPlace = place.IdPlace and place.RedMovility = '1'";
        $primerFiltro = false;
    }
  }
  if (isset($_POST['filtroRedVision'])) {
    if($_POST['filtroRedVision']=='on') {
      if (!$primerFiltro) {
        $consulta .=" and RedVision='1'";
      }
      else {
        $consulta = "SELECT distinct route.IdRoute, route.Name, RedMovility, route.MadeBy, route.Description, route.Image from route, appearverified, place where appearverified.IdRoute = route.IdRoute and appearverified.IdPlace = place.IdPlace and place.RedVision = '1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroForeigner'])) {
    if($_POST['filtroForeigner']=='on') {
      if (!$primerFiltro) {
        $consulta .= " and Foreigner='1'";
      }
      else {
        $consulta = "SELECT distinct route.IdRoute, route.Name, RedMovility, route.MadeBy, route.Description, route.Image from route, appearverified, place where appearverified.IdRoute = route.IdRoute and appearverified.IdPlace = place.IdPlace and place.Foreigner = '1'";
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
        $consulta = "SELECT distinct route.IdRoute, route.Name, RedMovility, route.MadeBy, route.Description, route.Image from route, appearverified, place where appearverified.IdRoute = route.IdRoute and appearverified.IdPlace = place.IdPlace and place.ColourBlind = '1'";
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
        $consulta = "SELECT distinct route.IdRoute, route.Name, RedMovility, route.MadeBy, route.Description, route.Image from route, appearverified, place where appearverified.IdRoute = route.IdRoute and appearverified.IdPlace = place.IdPlace and place.Deaf = '1'";
        $primerFiltro=false;
      }
    }
  }

  
  if (!$primerFiltro) {
    $consulta .= " and (route.IdRoute like '%".$search."%' or route.Name like '%".$search."%') ORDER BY route.IdRoute";
  }
  else {
    $consulta = "Select * from route where (route.IdRoute like '%".$search."%' or route.Name like '%".$search."%') ORDER BY route.IdRoute";
    $primerFiltro = false;
  }

  $Routes = mysqli_query($conexion, $consulta);
  $numeroRoutes = mysqli_num_rows($Routes);
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
        alert("Ruta eliminada");
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
                <div class="col-md-4">
                  <div class="form">
                      <input type="text" placeholder="Buscar ruta..." name="search" id="search">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form" style="background-color: white; padding:5px; padding-top:12px; padding-bottom: 12px;">
                      <span class="icon-wheelchair" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroRedMovility" title="Apto para movilidad reducida"></span>
                      <span class="icon-eye-minus" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroRedVision" title="Apto para visibilidad reducida"></span>
                      <span class="icon-eyedropper" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroColourBlind" title="Apto para daltónicos"></span>
                      <span class="icon-deaf" style="padding-left:3%;">&nbsp;<input type="checkbox" name="filtroDeaf" title="Apto para sordos"></span>
                      <span class="icon-language" style="padding-left: 3%;">&nbsp;<input type="checkbox" name="filtroForeigner" title="Apto en varios idiomas"></span>
                      <input type="submit" id="aplicar-cambios" name="aplicar-cambios" value="Buscar" style="padding-right: : 7%; float:right;">
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
                        <h3><a href="#" class="list-group-item list-group-item-action active list-group-item-info icon-map">&nbsp;Lista de Rutas</a></h3>
                        <?php
              if (isset($_GET['id'])) {
                
                  $id = $_GET['id'];
                  
                  mysqli_query($conexion, "DELETE from route where IdRoute='".$id."'");
                  
                  header("Location: viewRoutes.php");
              }
              if ($numeroRoutes < 10)
                $maxLista = 10;
              else 
                $maxLista = $numeroRoutes;
              for ($k = 0; $k < $maxLista; $k++) {
                $rutas = NULL;
                if ($rutas == NULL) {
                  if ($Routes != NULL)
                    $rutas = mysqli_fetch_array($Routes);
                  if ($rutas != NULL) {

                    $id = $rutas["IdRoute"];
                    $nombre = $rutas["Name"];

                    echo '<p class="list-group-item list-group-item-action miembro-lista"><a href="Route.php?id='.$id.'">'.$nombre.'</a>'; 
                      
                    echo '<a href="viewRoutes.php?id='.$id.'"><img class="icono" title="Eliminar ruta" alt="Eliminar ruta" src="./img/cruz.svg" onclick="mostrarAlert()" /></a>';
                    echo '<a href="editRoutes.php?id='.$id.'"><img class="icono3" title="Editar ruta" alt="Editar ruta" src="./img/editar.png" /></a></p>';   
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
