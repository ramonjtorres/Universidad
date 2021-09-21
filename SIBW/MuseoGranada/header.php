<header>

    <img id="logo" src="static/img/museo300x300.png" />
    <!-- LOGO DEL MUSEO -->

    <h1 id="titulo">MUSEO ARQUEOLÓGICO DE GRANADA</h1>
    <!-- TITULO DEL MUSEO -->

    <nav>
        <!-- MENU DE NAVEGACION -->
        <h2><a class="nave" href="portada.php">Portada</a>
            <a class="nave" href="historia.php?user=0">Historia</a>
            <a class="nave" href="multimedia.php?user=0">Multimedia</a>
            <a class="nave" href="coleccion.php?col=1&user=0">Objetos</a>
            <a class="nave" href="coleccion.php?col=2&user=0">Recipientes</a>

            <a class="boton" href="login.php">Iniciar Sesión</a>
            <a class="boton" href="signUp.php">Suscríbete</a>
        </h2>
    </nav>

    <div id="buscador">
        <input onselect="location = this.value" id="search" placeholder="Buscador de obras" list="result" />

        <datalist id="result">
          
        </datalist>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="static/buscador.js"></script>

</header>
