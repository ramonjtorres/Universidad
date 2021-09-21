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

if(!($array_usuarios = mysqli_query($conexion, "SELECT * FROM `tiposusuarios`"))){
    
    echo "Fallo del query de usuarios";
    exit();
}

if(isset($_POST["cambiar"])){

    if(!empty($_POST["Tipo"]) && !empty($_POST["Email"])){

        $email = $_POST["Email"];
        $permiso = $_POST["Tipo"];
        
        mysqli_query($conexion, "UPDATE `tiposusuarios` SET `Tipo`='".$permiso."' WHERE `Correo`='".$email."'");
    
        $MESSAGE = "SE HAN MODIFICADO LOS DATOS";
     }
     else {
      
        $MESSAGE = "NO SE HAN PODIDO MODIFICAR LOS DATOS";
     }
}

?>

    <!DOCTYPE html>
    <html lang="es">

    <div id="popup" class="popup">

        <h1>Configuración de Permisos</h1>

        <fieldset>

            <?php
        
                while($resultado_usuarios = mysqli_fetch_assoc($array_usuarios)) {
                    echo "<b>Permisos: ".$resultado_usuarios["Tipo"]."</b>"."</br><b>Nombre: ".$resultado_usuarios["Nombre"]."</b>"."</br><b>Email: ".$resultado_usuarios["Correo"]."</b>";
                    echo "<hr />";
                }
        
                ?>

                <label id="advert">Los permisos que puede tener son:</label>
                <label id="advert">Registrado, Gestor, Moderador, o Administrador</label>

                <form action="permiso.php" method="post">

                    <label>Introduce email del usuario</label>
                    <input id="Email" type="email" required value="" name="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' ">

                    <label>Introduce sus nuevos permisos</label>
                    <input id="Tipo" type="tipo" required value="" name="Tipo" onBlur="if(this.value=='')this.value='Tipo'" onFocus="if(this.value=='Tipo')this.value='' ">

                    <input type="submit" onclick="comprobar()" name="cambiar" value="Cambiar">

                </form>

        </fieldset>

        <?php echo "<a class='botonlista'' href='logueado.php?user=".$tipo."'>Volver a la página principal</a><br/>"; ?>

    </div>

    </html>

    <?php if (!empty($MESSAGE)) {echo "<p class=\"ERROR\">" . "MESSAGE: ". $MESSAGE . "</p>";} ?>
