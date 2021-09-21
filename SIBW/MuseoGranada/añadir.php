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

$id = 13;
 
if(isset($_POST["aniadir"])){
 
    if(!empty($_POST['nombre']) && !empty($_POST['dimension']) && !empty($_POST['proc']) && !empty($_POST['descripcion']) && !empty($_POST['imagen']) && !empty($_POST['colect'])){
         
         $nombre=$_POST['nombre'];
         $dimension=$_POST['dimension'];
         $procedencia=$_POST['proc'];
         $descripcion=$_POST['descripcion'];
         $imagen=$_POST['imagen'];
         $colect=$_POST['colect'];
         $publicado=$_POST['publicado'];

    if(!($QUERY = mysqli_query($conexion, "INSERT INTO `obras`(`id`, `Nombre`, `fecha`, `dimensiones`, `procedencia`, `comentario`, `imagen`, `publicado`) VALUES ($id, '$nombre', '', '$dimension', '$procedencia', '$descripcion', '$imagen', $publicado)"))){
    
        echo "Fallo del query de obras";
        exit();
    }
        
    if($colect == "Objetos"){
        
        $coleccion = 1;
        
    } else if($colect == "Recipientes"){
        
        $coleccion = 2;
    }       
        
    if(!($QUERY = mysqli_query($conexion, "INSERT INTO `colecciones`(`id_col`, `id_obra`) VALUES ($coleccion, $id)"))){
    
        echo "Fallo del query de colecciones";
        exit();
    }    
        
        $MESSAGE = "AÑADIDA UNA NUEVA OBRA";
        
    } else {
      
        $MESSAGE = "ERROR AL AÑADIR LA OBRA";
     }

}
       
?>

    <!DOCTYPE html>
    <html lang="es">

    <div id="popup" class="popup">

        <fieldset>

            <h1>Login</h1>

            <form action="añadir.php" method="post">

                <label>Nombre de la Obra:</label><br/>
                <br/><input type="nombre" required value="nombre" name="nombre" onBlur="if(this.value=='')this.value='nombre'" onFocus="if(this.value=='nombre')this.value='' "><br/><br/>

                <label>Dimensiones de la Obra:</label><br/>
                <br/><input type="dimension" required value="dimensión" name="dimension" onBlur="if(this.value=='')this.value='dimension'" onFocus="if(this.value=='dimension')this.value='' "><br/><br/>

                <label>Procedencia de la Obra:</label><br/>
                <br/><input type="proc" required value="procedencia" name="proc" onBlur="if(this.value=='')this.value='proc'" onFocus="if(this.value=='proc')this.value='' "><br/><br/>

                <label>Descripcion de la Obra:</label><br/>
                <br/><textarea required value="descripcion" name="descripcion" oninput="censura()" placeholder="Escribe la descripción de la obra" maxlength="10000" rows="10" cols="50" onFocus="if(this.value=='descripcion')this.value='' "></textarea><br/><br/>

                <label>Imagen de la Obra:</label><br/>
                <br/><input type="imagen" required value="imagen" name="imagen" onBlur="if(this.value=='')this.value='imagen'" onFocus="if(this.value=='imagen')this.value='' "><br/><br/>

                <label>Coleccion de la Obra:</label>
                <br/><label>Actualmente sólo existen 2 colecciones: Recipientes y Objetos.</label><br/>
                <br/><input type="colect" required value="colección" name="colect" onBlur="if(this.value=='')this.value='colect'" onFocus="if(this.value=='colect')this.value='' ">

                <label>Publicación de la Obra:</label>
                <br/><label>Poner "true" para publicar o "false" para no publicarla</label><br/>
                <br/><input type="publicado" required value="publicado" name="publicado" onBlur="if(this.value=='')this.value='publicado'" onFocus="if(this.value=='publicado')this.value='' ">

                <input type="submit" name="aniadir" value="Añadir">

            </form>

        </fieldset>

        <?php echo "<a class='botonlista'' href='logueado.php?user=".$tipo."'>Volver a la página principal</a><br/>"; ?>

    </div>

    </html>

    <?php if (!empty($MESSAGE)) {echo "<p class=\"ERROR\">" . "MESSAGE: ". $MESSAGE . "</p>";} ?>
