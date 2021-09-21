<article>

    <div>

        <?php if($user == 3 || $user == 4){ 
        
            echo "<a class='fa fa-eraser' title='Borrar' href='borrarObras.php?id=".$id_obra."'></a>&nbsp&nbsp&nbsp<a class='fa fa-file-text' title='Editar' href='editarObras.php?id=".$id_obra."'></a>";
        
        } ?>


        <?php if($nombre != ""){ ?>

        <!-- INFORMACIÓN DE LA OBRA -->

        <h1 id="obra">
            <?php echo $nombre; ?>
        </h1>

        <p class="texto">
            <?php echo $dimensiones; ?>
        </p>

        <?php if($procedencia != ""){ ?>
        <h2 id="obra">Procedencia</h2>

        <p class="texto">
            <?php echo $procedencia; } ?>
        </p>

        <?php if ($nombre == "Bifaz cordiforme"){ ?>

        <ul class="galeria">
            <li><a href="#img1"><img <?php echo "src='".$imagen. "'" ?>></a></li>
            <li><a href="#img2"><img src="./static/img/bifazcordiforme1.jpg"></a></li>
            <li><a href="#img3"><img src="./static/img/bifazcordiforme2.jpg"></a></li>
        </ul>

        <div class="modal" id="img1">
            <h3>Imagen 1</h3>
            <div class="imagen">
                <a href="#img3">&#60;</a>
                <a href="#img2"><img src="./static/img/bifazcordiforme1.jpg"></a>
                <a href="#img2">></a>
            </div>
            <a class="cerrar" href="">X</a>
        </div>

        <div class="modal" id="img2">
            <h3>Imagen 2</h3>
            <div class="imagen">
                <a href="#img1">&#60;</a>
                <a href="#img3"><img src="./static/img/bifazcordiforme2.jpg"></a>
                <a href="#img3">></a>
            </div>
            <a class="cerrar" href="">X</a>
        </div>

        <div class="modal" id="img3">
            <h3>Imagen 3</h3>
            <div class="imagen">
                <a href="#img2">&#60;</a>
                <a href="#img1"><img <?php echo "src='".$imagen. "'" ?>></a>
                <a href="#img1">></a>
            </div>
            <a class="cerrar" href="">X</a>
        </div>

        <?php } else{ ?>

        <img id="foto" <?php echo "src='".$imagen. "'" ?> />

        <?php } ?>

        <?php if($comentario != ""){ ?>
        <h2 id="obra">Comentarios</h2>

        <p class="texto">
            <?php echo $comentario; } ?>
        </p>

        <p class="texto"><b>
            <?php echo $fecha; ?></b>
        </p>

        <!-- BOTONES SOCIALES -->

        <script type="text/javascript">
            var nombre = '<?php echo $nombre; ?>';

            var uf = "https://www.facebook.com/sharer.php?status=Se publicará en Facebook el siguiente mensaje: " + nombre + " Vía @MuseoArqueologicoG";

            var ut = "https://twitter.com/home?status=Se publicará en Twitter el siguiente mensaje: " + nombre + " Vía @MuseoArqueologicoG";

        </script>

        <a href="javascript:void(0);" onclick="window.open(uf,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Facebook"><img class="social" alt="Compartir en facebook" src="https://cdn.tahonadedonpio.es/wp-content/uploads/social/facebook-long.png" title="Compartir en facebook" /></a>

        <a href="javascript:void(0);" onclick="window.open(ut,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Twitter"><img alt="Compartir en twitter" class="social" src="https://cdn.tahonadedonpio.es/wp-content/uploads/social/twitter-long.png" title="Compartir en twitter"/></a>

        <a title="Imprimir" href="./imprimir/alabastron_imprimir.html"><img class="social" src="https://www.entrerios.gov.ar/fiscalia/images/BOTON%20IMPRIMIR.png"></a>

        <?php } else echo "<h1> No existe la broma </h1>"; ?>

    </div>

</article>
