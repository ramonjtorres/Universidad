<?php

  $MESSAGE = "";

  session_start();

  //Consultamos los datos de la obra

  $conexion = mysqli_connect("localhost", "root", "");
  $BD = mysqli_select_db($conexion, "bdr");

  function ordenarComentarios($a, $b) {
    if ($a["Date"] < $b["Date"]) {
      return -1;
    }
    else if ($a["Date"] > $b["Date"]) {
      return 1;
    }
    else {
      if ($a["Time"] < $b["Time"]) {
        return -1;
      }
      else if ($a["Time"] > $b["Time"]){
        return 1;
      }
      else {
        return 0;
      }
    }
  }

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

  $consultaRutas = "SELECT * from routecomments where Reported = '1' and (IdRoute like '%".$search."%' or Email like '%".$search."%' or Content like '%".$search."%') ORDER BY Date, Time asc";
  $consultaLugares = "SELECT * from placecomments where Reported = '1' and (IdPlace like '%".$search."%' or Email like '%".$search."%' or Content like '%".$search."%') ORDER BY Date, Time asc";

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
  $comentarios = array();

  if ($resLugares != NULL)
    while ($fila = mysqli_fetch_assoc($resLugares)) {
      array_push($comentarios, $fila);
    }
  if ($resRutas != NULL)
    while ($fila = mysqli_fetch_assoc($resRutas)) {
      array_push($comentarios, $fila);
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
      function mostrarAlertEliminar() {
        alert("Comentario eliminado");
      }
      function mostrarAlertPermitir() {
        alert("Comentario permitido");
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
                      <input type="text" placeholder="Buscar comentario..." name="search" id="search">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form" style="background-color: white; padding:5px; padding-top:12px; padding-bottom: 12px;">
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
                      <input type="submit" id="aplicar-cambios"  name="aplicar-cambios" value="Buscar" style="margin-right: 4%; float:right;">
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
                        <h3><a href="#" class="list-group-item list-group-item-action active list-group-item-info icon-bubble">&nbsp;Lista de Comentarios </a></h3>
                        <?php
              if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $email = $_GET['email'];
                $date = $_GET['date'];
                $time = $_GET['time'];
                if ($_GET['tipo'] == 0) {
                  mysqli_query($conexion, "DELETE from placecomments where IdPlace='".$id."' and Email='".$email."' and Date='".$date."' and Time='".$time."'");
                }
                else if ($_GET['tipo'] == 1){
                  mysqli_query($conexion, "DELETE from routecomments where IdRoute='".$id."' and Email='".$email."' and Date='".$date."' and Time='".$time."'");
                }
                else if ($_GET['tipo'] == 2) {
                  mysqli_query($conexion, "UPDATE placecomments SET Reported = '0' where IdPlace='".$id."' and Email='".$email."' and Date='".$date."' and Time='".$time."'");
                }
                else if ($_GET['tipo'] == 3) {
                  mysqli_query($conexion, "UPDATE routecomments SET Reported = '0' where IdRoute='".$id."' and Email='".$email."' and Date='".$date."' and Time='".$time."'");
                }
                header("Location: Comments.php");
              }
              if ($total > 0) {
                usort($comentarios, 'ordenarComentarios');
                for ($i=0; $i<$total; $i++) {
                        $fila = $comentarios[$i];
                        $email = $fila["Email"];
                        if (isset($fila["IdRoute"])) {
                          $id = $fila["IdRoute"];
                          $ruta = true;
                        }
                        else {
                          $id = $fila["IdPlace"];
                          $ruta = false;
                        }
                        $date = $fila["Date"];
                        $time = $fila["Time"];
                        $content = $fila["Content"];

                      if ($ruta) {
                        echo '<p class="list-group-item list-group-item-action miembro-lista"><b>'.$email.'('.$time.', '.$date.'):</b> '. $content;
                        echo '<a href="Comments.php?id='.$id.'&email='.$email.'&date='.$date.'&time='.$time.'&tipo=1"><img title="Eliminar comentario" alt="Eliminar comentario" class="icono" src="./img/cruz.svg" onclick="mostrarAlertEliminar()" /></a>';
                        echo '<a href="Comments.php?id='.$id.'&email='.$email.'&date='.$date.'&time='.$time.'&tipo=3"><img title="Permitir comentario" alt="Eliminar comentario" class="icono" src="./img/tick.png" onclick="mostrarAlertPermitir()" /></a></p>';
                      }
                      else {
                        echo '<p class="list-group-item list-group-item-action miembro-lista"><b>'.$email.'('.$time.', '.$date.'):</b> '. $content;
                        echo '<a href="Comments.php?id='.$id.'&email='.$email.'&date='.$date.'&time='.$time.'&tipo=0"><img title="Eliminar comentario" alt="Eliminar comentario" class="icono" src="./img/cruz.svg" onclick="mostrarAlertEliminar()" /></a>';
                        echo '<a href="Comments.php?id='.$id.'&email='.$email.'&date='.$date.'&time='.$time.'&tipo=2"><img title="Permitir comentario" alt="Eliminar comentario" class="icono" src="./img/tick.png" onclick="mostrarAlertPermitir()" /></a></p>';
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
