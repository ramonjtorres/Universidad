<?php session_start();

            if($_SESSION['TIPO'] == "Registrado"){ $tipo = 1;}
            else if($_SESSION['TIPO'] == "Moderador"){ $tipo = 2;}
            else if($_SESSION['TIPO'] == "Gestor"){ $tipo = 3;}
            else if($_SESSION['TIPO'] == "Administrador"){ $tipo = 4;}
 ?>

<header>

    <img id="logo" src="static/img/museo300x300.png" />
    <!-- LOGO DEL MUSEO -->

    <h1 id="titulo">MUSEO ARQUEOLÓGICO DE GRANADA</h1>
    <!-- TITULO DEL MUSEO -->

    <nav>
        <!-- MENU DE NAVEGACION -->
        <h2>
            <?php 
            
                echo "<a class='nave' href='logueado.php?user=".$tipo."'>Portada</a>&nbsp";
                echo "<a class='nave' href='historia.php?user=".$tipo."'>Historia</a>&nbsp";
                echo "<a class='nave' href='multimedia.php?user=".$tipo."'>Multimedia</a>&nbsp";
                echo "<a class='nave' href='coleccion.php?col=1&user=".$tipo."'>Objetos</a>&nbsp";
                echo "<a class='nave' href='coleccion.php?col=2&user=".$tipo."'>Recipientes</a>";
                include "control.php";
            
            ?>
        </h2>
    </nav>

    <div id="buscador">
        <input onselect="location.href = this.value" id="search" placeholder="Buscador de obras" list="result" />

        <datalist id="result">
          
        </datalist>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <?php if($tipo == 3 || $tipo == 4){ ?>

    <script type="text/javascript" src="static/buscadorLog.js"></script>

    <?php } else{ ?>

    <script type="text/javascript" src="static/buscador.js"></script>

    <?php } ?>

</header>
