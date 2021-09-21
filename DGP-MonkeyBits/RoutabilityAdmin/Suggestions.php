<?php

  $MESSAGE = "";
  $accesibleM = "";
  $accesibleR = "";
  $accesibleB = "";
  $accesibleS = "";
  $accesibleF = "";
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

  $search = '';
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  }

  $consultaRutas = "SELECT * from suggestedroute";
  $consultaLugares = "SELECT * from suggestedplace where";
  $primerFiltro = true;

  if (isset($_POST['filtroRedMovility'])) {
    if($_POST['filtroRedMovility']=='on') {
        
        $accesibleM = "1";
        $consultaRutas = "SELECT distinct suggestedroute.IdRoute, suggestedroute.Name, RedMovility, suggestedroute.MadeBy, suggestedroute.Description, suggestedroute.Image from suggestedroute, appearsuggested, place where appearsuggested.IdRoute = suggestedroute.IdRoute and appearsuggested.IdPlace = place.IdPlace and place.RedMovility = '1'";
        $consultaLugares .=" RedMovility='1'";
        $primerFiltro = false;
    }
  }
  if (isset($_POST['filtroRedVision'])) {
    if($_POST['filtroRedVision']=='on') {
        $accesibleR = "1";
      if (!$primerFiltro) {
        $consultaLugares .=" and RedVision='1'";
        $consultaRutas .= " and RedVision='1'";
      }
      else {
        $consultaRutas = "SELECT distinct suggestedroute.IdRoute, suggestedroute.Name, RedVision, suggestedroute.MadeBy, suggestedroute.Description, suggestedroute.Image from suggestedroute, appearsuggested, place where appearsuggested.IdRoute = suggestedroute.IdRoute and appearsuggested.IdPlace = place.IdPlace and place.RedVision = '1'";
        $consultaLugares .=" RedVision='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroForeigner'])) {
    if($_POST['filtroForeigner']=='on') {
        $accesibleF = "1";
      if (!$primerFiltro) {
        $consultaRutas .= " and Foreigner='1'";
        $consultaLugares .=" and Foreigner='1'";
      }
      else {
        $consultaRutas = "SELECT distinct suggestedroute.IdRoute, suggestedroute.Name, Foreigner, suggestedroute.MadeBy, suggestedroute.Description, suggestedroute.Image from suggestedroute, appearsuggested, place where appearsuggested.IdRoute = suggestedroute.IdRoute and appearsuggested.IdPlace = place.IdPlace and place.Foreigner = '1'";
        $consultaLugares .=" Foreigner='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroColourBlind'])) {
    if($_POST['filtroColourBlind']=='on') {
        $accesibleB = "1";
      if (!$primerFiltro) {
        $consultaRutas .= " and ColourBlind='1'";
        $consultaLugares .=" and ColourBlind='1'";
      }
      else {
        $consultaRutas = "SELECT distinct suggestedroute.IdRoute, suggestedroute.Name, ColourBlind, suggestedroute.MadeBy, suggestedroute.Description, suggestedroute.Image from suggestedroute, appearsuggested, place where appearsuggested.IdRoute = suggestedroute.IdRoute and appearsuggested.IdPlace = place.IdPlace and place.ColourBlind = '1'";
        $consultaLugares .=" ColourBlind='1'";
        $primerFiltro=false;
      }
    }
  }
  if (isset($_POST['filtroDeaf'])) {
    if($_POST['filtroDeaf']=='on') {
        $accesibleS = "1";
      if (!$primerFiltro) {
        $consultaRutas .=" and Deaf='1'";
        $consultaLugares .=" and Deaf='1'";
      }
      else {
        $consultaRutas = "SELECT distinct suggestedroute.IdRoute, suggestedroute.Name, Deaf, suggestedroute.MadeBy, suggestedroute.Description, suggestedroute.Image from suggestedroute, appearsuggested, place where appearsuggested.IdRoute = suggestedroute.IdRoute and appearsuggested.IdPlace = place.IdPlace and place.Deaf = '1'";
        $consultaLugares .=" Deaf='1'";
        $primerFiltro=false;
      }
    }
  }

  
  if (!$primerFiltro) {
    $consultaLugares .= " and (IdPlace like '%".$search."%' or Name like '%".$search."%') ORDER BY IdPlace";
    $consultaRutas .= " and (suggestedroute.IdRoute like '%".$search."%' or suggestedroute.Name like '%".$search."%') ORDER BY suggestedroute.IdRoute";
  }
  else {
    $consultaRutas .= " where (suggestedroute.IdRoute like '%".$search."%' or suggestedroute.Name like '%".$search."%') ORDER BY suggestedroute.IdRoute";
    $consultaLugares .= " (IdPlace like '%".$search."%' or Name like '%".$search."%') ORDER BY IdPlace";
    $primerFiltro = false;
  }
  if (isset($_POST['filtro-lugar-ruta'])) {
    if ($_POST['filtro-lugar-ruta']=='Ambos') {
      $resRutas = mysqli_query($conexion, $consultaRutas);
      $resLugares = mysqli_query($conexion, $consultaLugares);
      $total = mysqli_num_rows($resRutas) + mysqli_num_rows($resLugares);
      $busqueda = "Ambos";
    }
    else if ($_POST['filtro-lugar-ruta']=='Rutas') {
      $resRutas = mysqli_query($conexion, $consultaRutas);
      $resLugares = NULL;
      $total = mysqli_num_rows($resRutas);
      $busqueda = "Rutas";
    }
    else if ($_POST['filtro-lugar-ruta']=='Lugares') {
      $resLugares = mysqli_query($conexion, $consultaLugares);
      $resRutas = NULL;
      $total = mysqli_num_rows($resLugares);
      $busqueda = "Lugares";
    }
  }
  else {
    $resRutas = mysqli_query($conexion, $consultaRutas);
    $resLugares = mysqli_query($conexion, $consultaLugares);
    $total = mysqli_num_rows($resRutas) + mysqli_num_rows($resLugares);
  }
  
  
  $fila = NULL;
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
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>
        $("#search_form").submit(function(e){
          e.preventDefault();
        })
        $("#search").submit(function() {
          var envio = $("#search").val();
        })
        $('#')

      function mostrarAlertEliminar() {
        alert("Sugerencia eliminada");
      }
      function mostrarAlertAceptar() {
        alert("Sugerencia aceptada");
      }
    </script>

</head>

<body class="bg-primario" style="min-width: 600px;">
    <div class="py-2" style="">
      <div class="container py-3 px-3">
        <div class="row">
          <form action="" method="post" name="search_form" id="search_form" class="col-md-12">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="form">
                      <input type="text" placeholder="Buscar sugerencia..." name="search" id="search">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form" style="background-color: white; padding:5px; padding-top:12px; padding-bottom: 12px; min-width: 550px;">
                      
                      <?php
                      if($accesibleM == "1"){
                          
                        echo"<span class='icon-wheelchair' style='padding-left: 3%;'>&nbsp;<input checked type='checkbox' name='filtroRedMovility' title='Apto para movilidad reducida'></span>";   
                      }
                      else{
                          
                        echo"<span class='icon-wheelchair' style='padding-left: 3%;'>&nbsp;<input type='checkbox' name='filtroRedMovility' title='Apto para movilidad reducida'></span>";   
                      }
                      
                      if($accesibleR == "1"){
                          
                        echo"<span class='icon-eye-minus' style='padding-left: 3%;'>&nbsp;<input checked type='checkbox' name='filtroRedVision' title='Apto para visibilidad reducida'></span>";
                      }
                      else{
                          
                        echo"<span class='icon-eye-minus' style='padding-left: 3%;'>&nbsp;<input type='checkbox' name='filtroRedVision' title='Apto para visibilidad reducida'></span>";  
                      }
                      
                      if($accesibleB == "1"){
                          
                        echo"<span class='icon-eyedropper' style='padding-left: 3%;'>&nbsp;<input checked type='checkbox' name='filtroColourBlind' title='Apto para daltónicos'></span>";
                      }
                      else{
                          
                        echo"<span class='icon-eyedropper' style='padding-left: 3%;'>&nbsp;<input type='checkbox' name='filtroColourBlind' title='Apto para daltónicos'></span>";  
                      }
                      
                      if($accesibleS == "1"){
                          
                        echo"<span class='icon-deaf' style='padding-left:3%;'>&nbsp;<input checked type='checkbox' name='filtroDeaf' title='Apto para sordos'></span>";
                      }
                      else{
                          
                        echo"<span class='icon-deaf' style='padding-left:3%;'>&nbsp;<input type='checkbox' name='filtroDeaf' title='Apto para sordos'></span>";
                      }
                      
                      if($accesibleF == "1"){
                          
                        echo"<span class='icon-language' style='padding-left: 3%;'>&nbsp;<input checked type='checkbox' name='filtroForeigner' title='Apto en varios idiomas'></span>";
                      }
                      else{
                          
                        echo"<span class='icon-language' style='padding-left: 3%;'>&nbsp;<input type='checkbox' name='filtroForeigner' title='Apto en varios idiomas'></span>";  
                      }
                      ?>  
                
                      <select style="margin-left: 3%;" name="filtro-lugar-ruta" name="filtro-lugar-ruta">
                        <?php 
                          
                          if($busqueda == "Ambos"){ echo"<option selected>Ambos</option>";}
                          else{ echo"<option>Ambos</option>";}
                          
                          if($busqueda == "Rutas"){ echo"<option selected>Rutas</option>";}
                          else{ echo"<option>Rutas</option>";}
                          
                          if($busqueda == "Lugares"){ echo"<option selected>Lugares</option>";}
                          else{ echo"<option>Lugares</option>";}
                        ?>
                      </select>
                      <input type="submit" id="aplicar-cambios" name="aplicar-cambios" value="Buscar" style="margin-right: 10px; float: right;">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
        <div class="container" style="min-width: 600px;">
            <div class="row">
                <div class="col-md-12" style="">
                    <div class="list-group" id="resultados">
                        <h3><a href="#" class="list-group-item list-group-item-action active list-group-item-info icon-drawer">&nbsp;Lista de Sugerencias</a></h3>
                        <?php
              if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($_GET['tipo'] == 0) {
                  mysqli_query($conexion, "DELETE from suggestedplace where IdPlace='".$id."'");
                }
                else if ($_GET['tipo']==1){
                  mysqli_query($conexion, "DELETE from suggestedroute where IdRoute='".$id."'");
                }
                else if ($_GET['tipo']==2) {
                  $madeby = $_GET['madeby'];
                  $localitation = $_GET['localitation'];
                  $name = $_GET['name'];
                  $description = $_GET['description'];
                  $image = $_GET['image'];
                  $email = $_SESSION['EMAIL'];    //Aquí hay que usar el nombre del admin que tiene iniciada la sesión
                  mysqli_query($conexion, "Insert into place(IdPlace, Email, MadeBy, Name, Description, Localitation, Image) values('NULL', '$email', '$madeby', '$name', '$description', '$localitation', '$image')");
                  mysqli_query($conexion, "DELETE from suggestedplace where IdPlace='".$id."'");
                }
                else {
                  $madeby = $_GET['madeby'];
                  $name = $_GET['name'];
                  $description = $_GET['description'];
                  $image = $_GET['image'];
                  $email = $_SESSION['EMAIL'];
                  mysqli_query($conexion, "Insert into route(IdRoute, Email, MadeBy, Name, Description, Image) values('NULL', '$email', '$madeby', '$name', '$description', '$image')");
                  mysqli_query($conexion, "DELETE from suggestedroute where IdRoute='".$id."'");      
                }
                header("Location: Suggestions.php");
              }

              if ($total > 0) {
                if ($resRutas !=NULL) {
                  while($fila = mysqli_fetch_assoc($resRutas)){
                    $id = $fila['IdRoute'];
                    $name = $fila['Name'];
                    $madeby = $fila['MadeBy'];
                    $description = $fila['Description'];
                    $image = $fila['Image'];
                     echo '<p class="list-group-item list-group-item-action"><b>Ruta';
                      echo '('.$id.'):</b>'.$name;
                      echo '<a href="Suggestions.php?id='.$id.'&tipo=1" alt="añadir"><img title="Borrar sugerencia" alt="Borrar sugerencia" class="icono" src="./img/cruz.svg" onclick="mostrarAlertEliminar()" /></a>';
                      echo '<a href="Suggestions.php?id='.$id.'&madeby='.$madeby.'&description='.$description.'&name='.$name.'&image='.$image.'&tipo=3" alt="eliminar"><img title="Aceptar sugerencia" onclick="mostrarAlertAceptar()" alt="Aceptar sugerencia" class="icono" src="./img/incluir.png" /></a></p>';

                  } 
                }
                if ($resLugares!=NULL) {
                  while($fila = mysqli_fetch_assoc($resLugares)){
                    $id = $fila['IdPlace'];
                    $name = $fila['Name'];
                    $madeby = $fila['MadeBy'];
                    $description = $fila['Description'];
                    $image = $fila['Image'];
                    $localitation = $fila['Localitation'];

                     echo '<p class="list-group-item list-group-item-action"><b>Lugar';
                      echo '('.$id.'):</b>'.$name;
                      echo '<a href="Suggestions.php?id='.$id.'&tipo=0" alt="añadir"><img title="Borrar sugerencia" alt="Borrar sugerencia" class="icono" src="./img/cruz.svg" onclick="mostrarAlertEliminar()" /></a>';
                      echo '<a href="Suggestions.php?id='.$id.'&madeby='.$madeby.'&description='.$description.'&localitation='.$localitation.'&name='.$name.'&image='.$image.'&tipo=2" alt="eliminar"><img title="Aceptar sugerencia" alt="Aceptar sugerencia" class="icono" src="./img/incluir.png" onclick="mostrarAlertAceptar()"/></a></p>';

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
