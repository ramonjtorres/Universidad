<?php

session_start();

    if($_SESSION['TIPO'] == "Registrado"){ $tipo = 1;}
    else if($_SESSION['TIPO'] == "Moderador"){ $tipo = 2;}
    else if($_SESSION['TIPO'] == "Gestor"){ $tipo = 3;}
    else if($_SESSION['TIPO'] == "Administrador"){ $tipo = 4;}

include "head.php";

//Consultamos los datos de la obra

$conexion = mysqli_connect("localhost", "root", "");
$BD = mysqli_select_db($conexion, "museo");

//Comprueba conexion
if(mysqli_connect_errno()){
    
    echo "Fallo de conexión: ".mysqli_connect_error();
    exit();
} 

if(isset($_POST["cambiar"])){

    $password = $_POST["Password"];
    $nombre = $_POST["Nombre"];
    $email = $_POST["Email"];

    if(!empty($_POST["Password"])){

        mysqli_query($conexion, "UPDATE `tiposusuarios` SET `Password`='".$password." WHERE `Correo`='".$_SESSION['EMAIL']."'");
    }
    
    if(!empty($_POST["Nombre"])){

        mysqli_query($conexion, "UPDATE `tiposusuarios` SET `Nombre`='".$nombre."' WHERE `Correo`='".$_SESSION['EMAIL']."'");
        
    }
       
    if(!empty($_POST["Email"])){

        mysqli_query($conexion, "UPDATE `tiposusuarios` SET `Correo`='".$email."' WHERE `Correo`='".$_SESSION['EMAIL']."'");
    
        $MESSAGE = "SE HAN MODIFICADO LOS DATOS";
     }
}

?>

    <!DOCTYPE html>
    <html lang="es">

    <div id="popup" class="popup">

        <h1>Configuración del Perfil</h1>

        <label id="advert">INTRODUCIR SIEMPRE TODOS LOS DATOS, AUNQUE ÉSTOS NO SE VAYAN A CAMBIAR</label>

        <fieldset>

            <?php 
            
            echo "<p><b>Nombre: <b/>".$_SESSION['USERNAME']."</p><p><b>Email: <b/>".$_SESSION['EMAIL']."</p><br/>";
            
            
            ?>

            <form action="config.php" method="post">

                <label>Introduce tu nombre</label>
                <input type="nombre" value="" name="Nombre" onFocus="if(this.value=='Nombre')this.value='' ">

                <label>Introduce tu email</label>
                <input type="email" value="" name="Email" onFocus="if(this.value=='Email')this.value='' ">

                <label>Introduce tu contraseña</label>
                <input type="password" value="" name="Password" onFocus="if(this.value=='Password')this.value='' ">

                <input type="submit" name="cambiar" value="Cambiar">

            </form>

        </fieldset>

        <?php echo "<a class='botonlista'' href='logueado.php?user=".$tipo."'>Volver a la página principal</a><br/>"; ?>

    </div>

    </html>

    <?php if (!empty($MESSAGE)) {echo "<p class=\"ERROR\">" . "MESSAGE: ". $MESSAGE . "</p>";} ?>
