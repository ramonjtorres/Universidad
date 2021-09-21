<?php

$coleccion = $_GET["col"];
$user = $_GET["user"];

?>

    <!DOCTYPE html>
    <html lang="es">

    <?php
    
    include "head.php";
        
    if($user == 0){    
    
        include "header.php";
        
        include "colection.php";
        
    } else{
        
        include "headerLog.php";
        include "colectionLog.php";
    }
    ?>

        <body>

            <?php
        
        include "sidebar.php";
        include "footer.php";
        
        ?>

        </body>

    </html>
