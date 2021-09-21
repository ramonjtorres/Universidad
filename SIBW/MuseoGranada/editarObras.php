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

        /* cambiar el conjunto de caracteres a utf8 */
        if (!$conexion->set_charset("utf8")) {
            
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexion->error);
            exit();
        }
        
    if(isset($_POST["editar"])){
        
         $nom=$_POST['nombre'];
         $dim=$_POST['dimension'];
         $proc=$_POST['proc'];
         $desc=$_POST['descripcion'];
         $img=$_POST['imagen'];
         $col=$_POST['colect'];
        
        if(!($QUERY = mysqli_query($conexion, "UPDATE `obras` SET `Nombre`='".$nom."',`dimensiones`='".$dim."',`procedencia`='".$proc."',`comentario`='".$desc."',`imagen`='".$img."' WHERE `id`=".$_SESSION["id"])) || !($QUERY2 = mysqli_query($conexion, "UPDATE `colecciones` SET `id_col`=".$col." WHERE `id_obra`=".$_SESSION["idobra"]))){
    
            echo "Fallo del query de edición";
            exit();   
        }
        else{
            
            $text = $desc;
            $nombre=$nom;
            $dimension=$dim;
            $procedencia=$proc;
            $imagen=$img;
            $coleccion=$col;
            
            echo "Comentario modificado correctamente";
        }
        
    } else {
        
        if(!($text_result = mysqli_query($conexion, "SELECT * FROM `obras` WHERE `id`=".$id))){
    
            echo "Fallo del query de selección1";
            exit();

        }
        
        if(!($text_res = mysqli_query($conexion, "SELECT * FROM `colecciones` WHERE `id_obra`=".$id))){
    
            echo "Fallo del query de selección2";
            exit();

        }

        $_SESSION["idobra"] = $id;
        $texto = mysqli_fetch_assoc($text_result);
        $co = mysqli_fetch_assoc($text_res);
        $text = $texto["comentario"];
        $nombre=$texto['Nombre'];
        $dimension=$texto['dimensiones'];
        $procedencia=$texto['procedencia'];
        $imagen=$texto['imagen'];
        $coleccion=$co['id_col'];
        
    }

?>

    <html lang="es">

    <div id="popup" class="popup">

        <fieldset>

            <h1>Modificar Obra</h1>

            <?php echo "<form action='editarObras.php?id='".$id."' method='post'>";
                
                echo "<label>Nombre de la Obra:</label><br/>";
                echo "<br/><input type='nombre' required value='".$nombre."' name='nombre' onBlur='if(this.value=='')this.value='nombre'' onFocus='if(this.value=='nombre')this.value='' '><br/><br/>";

                echo "<label>Dimensiones de la Obra:</label><br/>";
                echo "<br/><input type='dimension' required value='".$dimension."' name='dimension' onBlur='if(this.value=='')this.value='dimension'' onFocus='if(this.value=='dimension')this.value='' '><br/><br/>";

                echo "<label>Procedencia de la Obra:</label><br/>";
                echo "<br/><input type='proc' required value='".$procedencia."' name='proc' onBlur='if(this.value=='')this.value='proc'' onFocus='if(this.value=='proc')this.value='' '><br/><br/>";

                echo "<label>Imagen de la Obra:</label><br/>";
                echo "<br/><input type='imagen' required value='".$imagen."' name='imagen' onBlur='if(this.value=='')this.value='imagen'' onFocus='if(this.value=='imagen')this.value='' '><br/><br/>";

                echo "<label>Coleccion de la Obra:</label>";
                echo "<br/><label>Actualmente sólo existen 2 colecciones: Recipientes y Objetos.</label><br/>";
                echo "<br/><input type='colect' required value='".$coleccion."' name='colect' onBlur='if(this.value=='')this.value='colect'' onFocus='if(this.value=='colect')this.value='' '><br/><br/>";
            
                echo "<label>Descripcion de la Obra:</label><br/>";
                echo "<br/><textarea required value='' name='descripcion' oninput='censura()' placeholder='Escribe el descripción de la obra' maxlength='10000' rows='10' cols='50'>".$text."</textarea><br/><br/>";
                
                ?>

            <input type="submit" name="editar" value="Editar">

            <?php echo "</form>"; ?>

        </fieldset>

        <?php echo "<a class='botonlista' ' href='logueado.php?user=".$tipo." '>Volver a la página principal</a><br/>"; ?>
    </div>

    </html>
