<?php

session_start();

include "head.php";

//Consultamos los datos de la obra

$conexion = mysqli_connect("localhost", "root", "");
$BD = mysqli_select_db($conexion, "museo");

//Comprueba conexion
if(mysqli_connect_errno()){
    
    echo "Fallo de conexión: ".mysqli_connect_error();
    exit();
}
 
if(isset($_POST["login"])){
 
    if(!empty($_POST['Email']) && !empty($_POST['Password'])) {
         
         $EMAIL=$_POST['Email'];
         $PASSWORD=$_POST['Password'];

    if(!($QUERY = mysqli_query($conexion, "SELECT * FROM tiposusuarios WHERE Correo ='".$EMAIL."' AND Password ='".$PASSWORD."'"))){
    
        echo "Fallo del query";
        exit();
    }

    $NUMROWS=mysqli_num_rows($QUERY);

    if($NUMROWS!=0){

         while($ROW=mysqli_fetch_assoc($QUERY)){

             $USERNAME=$ROW['Nombre'];
             $DBEMAIL=$ROW['Correo'];
             $DBPASSWORD=$ROW['Password'];
             $TIPO = $ROW["Tipo"];
         }

        if($EMAIL == $DBEMAIL && $PASSWORD == $DBPASSWORD){

            $_SESSION['logged'] = 'yes';
            $_SESSION['USERNAME'] = $USERNAME;
            $_SESSION['EMAIL'] = $EMAIL;
            $_SESSION['PASSWORD'] = $DBPASSWORD;
            $_SESSION['TIPO'] = $TIPO;
            
            /* REDIRECT BROWSER */
            
            if($TIPO == "Registrado"){ header('Location: logueado.php?user=1');}
            else if($TIPO == "Moderador"){ header('Location: logueado.php?user=2');}
            else if($TIPO == "Gestor"){ header('Location: logueado.php?user=3');}
            else if($TIPO == "Administrador"){ header('Location: logueado.php?user=4');}
         }
     }
     else {
      
        $MESSAGE = "EMAIL Ó CONTRASEÑA INVALIDA";
     }

   }
}
?>

    <!DOCTYPE html>
    <html lang="es">

    <div id="popup" class="popup">

        <h1>Login</h1>

        <fieldset>

            <form action="login.php" method="post" autocomplete="on">

                <input type="email" required value="Email" name="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' ">

                <input type="password" required value="Password" name="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' ">

                <input type="submit" name="login" value="Login">
                <p class="regtext">¿No estás registrado?<a href="signUp.php">Registrate aquí</a></p>

            </form>

            <a class="inicio" href="portada.php">Volver a la página de Inicio</a>

        </fieldset>

    </div>

    </html>

    <?php if (!empty($MESSAGE)) {echo "<p class=\"ERROR\">" . "MESSAGE: ". $MESSAGE . "</p>";} ?>
