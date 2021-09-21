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
  
  $search = '';
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  }

  $consultaUsuarios = "SELECT * from user where (Reported='1' or Banned='1') and ";

  if (isset($_POST['filtro-bloq-nobloq'])) {
    if ($_POST['filtro-bloq-nobloq']=='Cualquiera') {
      $consultaUsuarios .= " Email like '%".$search."%' or Name like '%".$search."%' ORDER BY Email";
      $resUsuarios = mysqli_query($conexion, $consultaUsuarios);
      $total = mysqli_num_rows($resUsuarios);
      $busqueda = "Cualquiera";
    }
    else if ($_POST['filtro-bloq-nobloq']=='Bloqueados') {
      $consultaUsuarios .= " Banned='1' and Reported='0' and (Email like '%".$search."%' or Name like '%".$search."%') ORDER BY Email";
      $resUsuarios = mysqli_query($conexion, $consultaUsuarios);
      $total = mysqli_num_rows($resUsuarios);
      $busqueda = "Bloqueados";
    }
    else if ($_POST['filtro-bloq-nobloq'] == 'Denunciados') {
      $consultaUsuarios = "Select * from user where Reported='1' and (Email like '%".$search."%' or Name like '%".$search."%') ORDER BY Email";
      $resUsuarios = mysqli_query($conexion, $consultaUsuarios);
      $total = mysqli_num_rows($resUsuarios);
      $busqueda = "Denunciados";
    }
  }
  else {
    $consultaUsuarios = "Select * from user where (Reported='1' or Banned='1') and (Email like '%".$search."%' or Name like '%".$search."%') ORDER BY Email";
    $resUsuarios = mysqli_query($conexion, $consultaUsuarios);
    $total = mysqli_num_rows($resUsuarios);
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
    <script>
      function mostrarAlertBloquear() {
        alert("Usuario bloqueado");
      }
      function mostrarAlertDesbloquear() {
        alert("Usuario desbloqueado");
      }
      function mostarAlertAceptar() {
        alert("Usuario aceptado");
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
                      <input type="text" placeholder="Buscar usuario..." name="search" id="search">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form" style="background-color: white; padding:5px; padding-top:12px; padding-bottom: 12px;">
                      <select style="margin-left: 3%;" name="filtro-bloq-nobloq" name="filtro-bloq-nobloq">

                         <?php 
                        if($busqueda == "Cualquiera"){ echo"<option selected>Cualquiera</option>";}
                          else{ echo"<option>Cualquiera</option>";}
                          
                          if($busqueda == "Bloqueados"){ echo"<option selected>Bloqueados</option>";}
                          else{ echo"<option>Bloqueados</option>";}
                          
                          if($busqueda == "Denunciados"){ echo"<option selected>Denunciados</option>";}
                          else{ echo"<option>Denunciados</option>";}
                          ?>
                      </select>
                      <input type="submit" id="aplicar-cambios" name="aplicar-cambios" value="Buscar" style="margin-right: 4%; float:right;">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <div class="py-3" style="">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="">
                    <div class="list-group">
                        <h3><a href="#" class="list-group-item list-group-item-action active list-group-item-info icon-users">&nbsp;Lista de Usuarios</a></h3>
                        <?php
              if (isset($_GET['email'])) {
                $email = $_GET['email'];
                $banned = $_GET['banned'];
                $reported = $_GET['reported'];
                if ($banned == 0) {
                  mysqli_query($conexion, "Update user set Banned='1' and Reported='0' where Email='".$email."'");
                }
                else if ($banned == 1){
                  mysqli_query($conexion, "Update user set Banned='0' and Reported='0' where Email='".$email."'");
                }
                else {
                  mysqli_query($conexion, "Update user set Reported='0' where Email='".$email."'");
                }
                header("Location: Users.php");
              }
              if ($total > 0) {
                while ($fila = mysqli_fetch_assoc($resUsuarios)) {

                  $email = $fila["Email"];
                  $name = $fila["Name"];
                  $banned = $fila["Banned"];
                  $reported = $fila["Reported"];

                  echo '<p class="list-group-item list-group-item-action"><b>'.$email.':</b> '.$name;
                  if ($reported == 1) {
                    echo '<a href="Users.php?email='.$email.'&banned=2&reported='.$reported.'"><img title="Permitir usuario" alt="Permitir usuario" class="icono" src="./img/tick.png" onclick="mostarAlertAceptar()" /></a><a href="Users.php?email='.$email.'&banned=2&reported='.$reported.'"><img title="Bloquear usuario" alt="Bloquear usuario" class="icono" src="./img/bloquear.png" onclick="mostrarAlertBloquear()" /></a></p>';
                  }
                  else if ($banned == 0) {
                    echo '<a href="Users.php?email='.$email.'&banned='.$banned.'&reported='.$reported.'"><img title="Bloquear usuario" alt="Bloquear usuario" class="icono" src="./img/bloquear.png" onclick="mostrarAlertBloquear()"/></a></p>';
                  }
                  else {
                    echo '<a href="Users.php?email='.$email.'&banned='.$banned.'&reported='.$reported.'"><img title="Desbloquear usuario" alt="Desbloquear usuario" class="icono2" src="./img/desbloquear.png" onclick="mostrarAlertDesbloquear()" /></a></p>';
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>

</body>
<?php
  mysqli_close($conexion);
?>

</html>
