<?php

    $id = $_GET["id"];

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
        
    if(isset($_POST["editar"])){
        
        $descripcion=$_POST['descripcion']." [Mensaje editado por el Moderador]";
        
        if(!($QUERY = mysqli_query($conexion, "UPDATE `comentarios` SET `Texto`='".$descripcion."' WHERE `id_comentario`=".$_SESSION["id"]))){
    
        echo "Fallo del query de edición";
        exit();
        }else{
            
            $text = $descripcion;
            echo "Comentario modificado correctamente";
        }
        
    } else {
        
        if(!($text_result = mysqli_query($conexion, "SELECT * FROM `comentarios` WHERE `id_comentario`=".$id))){
    
            echo "Fallo del query de selección";
            exit();

        }

        $_SESSION["id"] = $id;
        $texto = mysqli_fetch_assoc($text_result);
        $text = $texto["Texto"];
        
    }

?>

    <html lang="es">

    <div id="popup" class="popup">

        <fieldset>

            <h1>Modificar Comentario</h1>

            <?php echo "<form action='editarComentarios.php?id='".$id."' method='post'>"; ?>

            <label>Comentario:</label><br/>

            <?php 
                
                    echo "<br/><textarea required value='' name='descripcion' oninput='censura()' placeholder='Escribe el comentario de la obra' maxlength='10000' rows='10' cols='50'>".$text."</textarea><br/><br/>";
                
                ?>

            <input type="submit" name="editar" value="Editar">

            <?php echo "</form>"; ?>

        </fieldset>

        <?php echo "<a class='botonlista' ' href='logueado.php?user=".$tipo." '>Volver a la página principal</a><br/>"; ?>
    </div>

    </html>