<!DOCTYPE html>
<html lang="es">

<?php  
    
    $conexion = mysqli_connect("localhost", "root", "");
    $BD = mysqli_select_db($conexion, "museo");

    //Idioma
    mysqli_set_charset($conexion, 'utf8');


    //Comprueba conexion
    if(mysqli_connect_errno()){

        echo "Fallo de conexión: ".mysqli_connect_error();
        exit();
    }
    
    $resultado_obras = mysqli_query ($conexion, "SELECT * FROM obras WHERE `publicado` = true");
    
?>

<article>
    <?php

        if ($resultado_obras->num_rows > 0) {
                    while($array_resultado =  mysqli_fetch_assoc($resultado_obras)) {
                        echo "<div class='responsivo'><div class='galeria'><a href='index.php?obra=".$array_resultado['id']."&user=0'>";
                            echo "<img src='".$array_resultado['imagen']."' alt='".$array_resultado['Nombre']."'></a>";
                            echo "<div class='desc'>".$array_resultado['Nombre']."</div></div></div>";
                    }
                }

    ?>

</article>

</html>
