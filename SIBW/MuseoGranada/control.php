<ul class="botonmenu" id="menu">
    <li><input type="checkbox" name="list" id="perfil"><label for="perfil">Tu Perfil</label>
        <ul class="interior">

            <?php if($user == 1){ ?>

            <li><a class="opcion" href="./config.php">Configurar Perfil</a></li>
            <li><a class="opcion" href="./logout.php">Cerrar Sesión</a></li>

            <?php } else if($user == 2){ ?>

            <li><a class="opcion" href="./config.php">Configurar Perfil</a></li>
            <li><a class="opcion" href="./listadoComentarios.php">Listado de Comentarios</a></li>
            <li><a class="opcion" href="./logout.php">Cerrar Sesión</a></li>

            <?php } else if($user == 3){ ?>

            <li><a class="opcion" href="./config.php">Configurar Perfil</a></li>
            <li><a class="opcion" href="./añadir.php">Añadir Obra</a></li>
            <li><a class="opcion" href="./listadoObras.php">Listado de Obras</a></li>
            <li><a class="opcion" href="./logout.php">Cerrar Sesión</a></li>

            <?php } else if($user == 4){ ?>

            <li><a class="opcion" href="./config.php">Configurar Perfil</a></li>
            <li><a class="opcion" href="./añadir.php">Añadir Obra</a></li>
            <li><a class="opcion" href="./listadoComentarios.php">Listado de Comentarios</a></li>
            <li><a class="opcion" href="./listadoObras.php">Listado de Obras</a></li>
            <li><a class="opcion" href="./permiso.php">Modificar Permisos</a></li>
            <li><a class="opcion" href="./logout.php">Cerrar Sesión</a></li>

            <?php }?>

        </ul>
    </li>
</ul>
