<?php

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

include "head.php";

//Consultamos los datos de la obra

$conexion = mysqli_connect("localhost", "root", "");
$BD = mysqli_select_db($conexion, "museo");

//Comprueba conexion
if(mysqli_connect_errno()){
    
    echo "Fallo de conexión: ".mysqli_connect_error();
    exit();
}

if(isset($_POST["register"])){
 
    if(!empty($_POST['Email']) && !empty($_POST['Nombre']) && !empty($_POST['Password'])) {
         
         $EMAIL=$_POST['Email'];
         $USERNAME=$_POST['Nombre'];
         $PASSWORD=$_POST['Password'];

         $QUERY=mysqli_query($conexion, "SELECT * FROM tiposusuarios WHERE Nombre='".$USERNAME."'");
         $NUMROWS=mysqli_num_rows($QUERY);

         if($NUMROWS==0){

             $SQL="INSERT INTO tiposusuarios (Tipo, Nombre, Correo, Password) VALUES('Registrado', '$USERNAME', '$EMAIL', '$PASSWORD')";

            $RESULT=mysqli_query($conexion, $SQL);

             if($RESULT){
                 
                header('Location: login.php');
             }
             else {
             
                 $MESSAGE = "ERROR AL INGRESAR LOS DATOS";
             }
        } 
        
        else {
            
            $MESSAGE = "EL NOMBRE DE USUARIO YA EXISTE. POR FAVOR, INTÉNTALO CON OTRO";
         }

    }
    else {
    
        $MESSAGE = "TODOS LOS CAMPOS DEBEN DE ESTAR RELLENOS";
    }
}
?>

    <!DOCTYPE html>
    <html lang="es">

    <div id="popup" class="popup">

        <h1>Suscribete</h1>

        <fieldset>

            <form action="signUp.php" method="post">

                <input type="nombre" required value="Nombre" name="Nombre" onBlur="if(this.value=='')this.value='Nombre'" onFocus="if(this.value=='Nombre')this.value='' ">

                <input type="email" required value="Email" name="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' ">

                <input type="password" required value="Password" name="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' ">

                <input type="submit" name="register" id="register" value="Suscribirse">
                <p class="regtext">¿Ya tienes cuenta?<a HREF="login.php">Entra aquí</a></p>
            </form>

            <a class="inicio" href="portada.php">Volver a la página de Inicio</a>

        </fieldset>
    </div>

    </html>

    <?php if (!empty($MESSAGE)) {echo "<p class=\"ERROR\">" . "MENSAJE: ". $MESSAGE . "</p>";} ?>
