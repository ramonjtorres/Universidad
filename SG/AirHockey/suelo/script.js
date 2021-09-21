/// Several functions, including the main

/// The scene graph
scene = null;

//restricciones de movimiento
restric1 = null;
restric2 = null;

/// The GUI information
GUIcontrols = null;

/// The object for the statistics
stats = null;

/// A boolean to know if the left button of the mouse is down
mouseDown = false;

//booleanas para el movimiento de las palas
moveLeft1 = false;
moveLeft2 = false;
moveRight1 = false;
moveRight2 = false;

players2 = false;  //multiplayer
punto1 = 0;        //punto del player 1
punto2 = 0;        //punto del player 2
reiniciar = false; // false disco en el player2 true disco en el playe1

applicationMode = TheScene.INSTRUCCIONES;   //Modo en el que esta el juego

/// It creates the GUI and, optionally, adds statistic information
/**
 * @param withStats - A boolean to show the statictics or not
 */
function createGUI(withStats) {
    GUIcontrols = new function () {
        this.axis = true;
        this.luz = true;
        this.lightIntensity = 0.5;
        this.musica = true;    //controla la musica de fondo true o false
        this.movrandom = false;
    }

    var gui = new dat.GUI();
    var axisLights = gui.addFolder('Axis and Lights');
    axisLights.add(GUIcontrols, 'axis').name('Axis on/off :');
    axisLights.add(GUIcontrols, 'luz').name('luz on/off :'); //EXAMEN
    axisLights.add(GUIcontrols, 'lightIntensity', 0, 1.0).name('Light intensity :');
    axisLights.add(GUIcontrols, 'musica').name('Musica on/off :').listen();
    axisLights.add(GUIcontrols, 'movrandom').name('Movimiento random on/off :').listen();

    if (withStats)
        stats = initStats();
}

/// It adds statistics information to a previously created Div
/**
 * @return The statistics object
 */
function initStats() {

    var stats = new Stats();

    stats.setMode(0); // 0: fps, 1: ms

    // Align top-left
    stats.domElement.style.position = 'absolute';
    stats.domElement.style.left = '0px';
    stats.domElement.style.top = '0px';

    $("#Stats-output").append(stats.domElement);

    return stats;
}

/// It shows a feed-back message for the user
/**
 * @param str - The message
 */
function setMessage(str) {
    document.getElementById("Messages").innerHTML = "<h2>" + str + "</h2>";
}

/// Funcón que controla la puntuación
function puntuacion(){
    scene.pantalla2.addEventListener('collision', function(object){         ///Listener para detectar gol del player2
        
        var audio = document.getElementById("gol");
        audio.play();
        audio.volume = 0.4;
        
        punto1 += 1;                                            //Se suma un gol se borra el disco y se llama a restart
        document.getElementById("puntos1").innerHTML = punto1;
        scene.remove(scene.disco);
        reiniciar = true;
        restart();
        
    });
    scene.pantalla1.addEventListener('collision', function(object){         ///Listener para detectar gol del player1
        
        var audio = document.getElementById("gol");
        audio.play();
        audio.volume = 0.4;
        
        punto2 += 1;                                            //Se suma un gol se borra el disco y se llama a restart
        document.getElementById("puntos2").innerHTML = punto2;
        scene.remove(scene.disco);
        reiniciar = false;
        restart();
        
    });
}

///Función que reestablece la posición de la pelota y los player cuando se anota un punto
function restart(){
    
    scene.player1.__dirtyPosition = true;
    scene.player2.__dirtyPosition = true;
    scene.disco.__dirtyPosition = true;
    
    scene.player1.position.x = 0;
    scene.player2.position.x = 0;
    
    if(reiniciar){                        //player1
        scene.disco.position.z = 11;
        scene.disco.position.x = 3;
    }
    else{                                           //player2
        scene.disco.position.z = -11;
        scene.disco.position.x = 3;
    }
    scene.add(scene.disco);
    
    scene.disco.setAngularFactor(new THREE.Vector3(0, 0, 0));            //desactiva la rotacion del disco
}

//Fin de la partida                                 terminar !!!!!!!!!!!!!!!!!!!!!!!!!!

function findepartida() {

    if (applicationMode == TheScene.PANTALLAFINAL) {
        
        blocker2.style.display = '-webkit-box';
        
        if(players2 == false){
           
            if (punto1 > punto2) {

                document.getElementById("fin").innerHTML = "EL GANADOR ES LA IA";
            } else if (this.punto1 < this.punto2) {

                document.getElementById("fin").innerHTML = "EL GANADOR ES EL JUGADOR ";
            } else {

                document.getElementById("fin").innerHTML = "HA SIDO UN EMPATE";
            }
           }

        else{
            
            if (punto1 > punto2) {

                document.getElementById("fin").innerHTML = "EL GANADOR ES EL JUGADOR 1";
            } else if (this.punto1 < this.punto2) {

                document.getElementById("fin").innerHTML = "EL GANADOR ES EL JUGADOR 2";
            } else {

                document.getElementById("fin").innerHTML = "HA SIDO UN EMPATE";
            }
        }
    }

}

/// Función que elige modo de juego
function mode(modo) {

    var vmenu = document.getElementById('menu');
    vmenu.style.display = 'none';

    if (modo == 1) {
        var player = document.getElementById('player');
        player.style.display = 'block';
        applicationMode = TheScene.MODE;

    } else if (modo == 2) {
        var players = document.getElementById('players');
        players.style.display = 'block';
        applicationMode = TheScene.MODE;
        players2 = true;
    }
}

/// Función que empieza el juego
function empezar(modo) {

    if (modo == 1) {
        
        applicationMode = TheScene.EN_JUEGO;
        
        var player = document.getElementById('player');
        player.style.display = 'none';
        
        scene.hero1 = "imgs/boss.jpg";
        
        scene.gameMode();    
    }

    if (modo == 2) {
        
        applicationMode = TheScene.EN_JUEGO;
        
        var players = document.getElementById('players');
        players.style.display = 'none';
        
        scene.gameMode();
    }
    
    puntuacion();
    
    restric1 = new Physijs.SliderConstraint(scene.player2, scene.ground.campo, scene.ground.campo.position, new THREE.Vector3(0, 1, 0));

    scene.addConstraint(restric1);

    restric1.setLimits(-3.63, 3.63);

    
    restric2 = new Physijs.SliderConstraint(scene.player1, scene.ground.campo, scene.ground.campo.position, new THREE.Vector3(0, 1, 0));

    scene.addConstraint(restric2);

    restric2.setLimits(-3.63, 3.63);
    
    render();
    
    var audio = document.getElementById("inicio");
    audio.pause();
}

/// Función que empieza el juego
function elegir(heroe, mdj) {   //mdj modo de juego

    if (mdj == 1) {

        if (heroe == 1) {

            scene.hero2 = "imgs/blackangel.jpg";
            document.getElementById("1").style.backgroundColor = "blue";
            document.getElementById("2").style.backgroundColor = "";
            document.getElementById("3").style.backgroundColor = "";
            document.getElementById("4").style.backgroundColor = "";
        }

        if (heroe == 2) {

            scene.hero2 = "imgs/Green-Arrow-Archer-Girl.jpg";
            document.getElementById("1").style.backgroundColor = "";
            document.getElementById("2").style.backgroundColor = "blue";
            document.getElementById("3").style.backgroundColor = "";
            document.getElementById("4").style.backgroundColor = "";

        }

        if (heroe == 3) {

            scene.hero2 = "imgs/guerrero.jpg";
            document.getElementById("1").style.backgroundColor = "";
            document.getElementById("2").style.backgroundColor = "";
            document.getElementById("3").style.backgroundColor = "blue";
            document.getElementById("4").style.backgroundColor = "";

        }

        if (heroe == 4) {

            scene.hero2 = "imgs/valkyrie.jpg";
            document.getElementById("1").style.backgroundColor = "";
            document.getElementById("2").style.backgroundColor = "";
            document.getElementById("3").style.backgroundColor = "";
            document.getElementById("4").style.backgroundColor = "blue";

        }
    }

    if (mdj == 2) {

        if (heroe == 1) {

            scene.hero1 = "imgs/blackangel.jpg";
            document.getElementById("5").style.backgroundColor = "blue";
            document.getElementById("6").style.backgroundColor = "";
            document.getElementById("7").style.backgroundColor = "";
            document.getElementById("8").style.backgroundColor = "";
        }

        if (heroe == 2) {

            scene.hero1 = "imgs/Green-Arrow-Archer-Girl.jpg";
            document.getElementById("5").style.backgroundColor = "";
            document.getElementById("6").style.backgroundColor = "blue";
            document.getElementById("7").style.backgroundColor = "";
            document.getElementById("8").style.backgroundColor = "";

        }

        if (heroe == 3) {

            scene.hero1 = "imgs/guerrero.jpg";
            document.getElementById("5").style.backgroundColor = "";
            document.getElementById("6").style.backgroundColor = "";
            document.getElementById("7").style.backgroundColor = "blue";
            document.getElementById("8").style.backgroundColor = "";

        }

        if (heroe == 4) {

            scene.hero1 = "imgs/valkyrie.jpg";
            document.getElementById("5").style.backgroundColor = "";
            document.getElementById("6").style.backgroundColor = "";
            document.getElementById("7").style.backgroundColor = "";
            document.getElementById("8").style.backgroundColor = "blue";

        }

        if (heroe == 5) {

            scene.hero2 = "imgs/blackangel.jpg";
            document.getElementById("9").style.backgroundColor = "red";
            document.getElementById("10").style.backgroundColor = "";
            document.getElementById("11").style.backgroundColor = "";
            document.getElementById("12").style.backgroundColor = "";

        }

        if (heroe == 6) {

            scene.hero2 = "imgs/Green-Arrow-Archer-Girl.jpg";
            document.getElementById("9").style.backgroundColor = "";
            document.getElementById("10").style.backgroundColor = "red";
            document.getElementById("11").style.backgroundColor = "";
            document.getElementById("12").style.backgroundColor = "";

        }

        if (heroe == 7) {

            scene.hero2 = "imgs/guerrero.jpg";
            document.getElementById("9").style.backgroundColor = "";
            document.getElementById("10").style.backgroundColor = "";
            document.getElementById("11").style.backgroundColor = "red";
            document.getElementById("12").style.backgroundColor = "";

        }

        if (heroe == 8) {

            scene.hero2 = "imgs/valkyrie.jpg";
            document.getElementById("9").style.backgroundColor = "";
            document.getElementById("10").style.backgroundColor = "";
            document.getElementById("11").style.backgroundColor = "";
            document.getElementById("12").style.backgroundColor = "red";

        }
    }
}

/// It processes the clic-down of the mouse
/**
 * @param event - Mouse information
 */
function onMouseDown(event) {
    if (event.ctrlKey && players2 == false) {
        // The Trackballcontrol only works if Ctrl key is pressed
        scene.getCameraControls().enabled = true;
    } else {
        scene.getCameraControls().enabled = false;
    }
}

/// It processes the window size changes
function onWindowResize() {
    
    if(players2 == true){
        scene.setCamera2Aspect(window.innerWidth / window.innerHeight);
        renderer.setSize(window.innerWidth, window.innerHeight);
    }
    scene.setCameraAspect(window.innerWidth / window.innerHeight);
    renderer.setSize(window.innerWidth, window.innerHeight);
}

/// Añadimos los listeners y la actualización de la posición de las palas

function addListeners() {

    var onKeyDown = function (event) {
        switch (event.keyCode) {

            case 37: // left

                moveLeft1 = true;

                break;
            case 39: // right

                moveRight1 = true;
                break;
            case 65: // a

                moveLeft2 = true;
                break;
            case 68: // d

                moveRight2 = true;
                break;
        }

    };

    var onKeyUp = function (event) {
        switch (event.keyCode) {

            case 37: // left

                moveLeft1 = false;

                break;
            case 39: // right

                moveRight1 = false;
                break;
            case 65: // a

                moveLeft2 = false;
                break;
            case 68: // d

                moveRight2 = false;
                break;
        }
    };
    
    var onKeyPress = function (event) {
                
        switch (event.which) {

            case 32: // space

                if (applicationMode == TheScene.INSTRUCCIONES) {                          ///pantalla inicial de instrucciones                    
                    
                    var blocker = document.getElementById('blocker');
                    blocker.style.display = 'none';
                    applicationMode = TheScene.MENU;
                    var vmenu = document.getElementById('menu');
                    vmenu.style.display = 'block';
                }

                else if (applicationMode == TheScene.PAUSA) {       //quitar pantalla de pausa terminar !!!!!!!!
                    applicationMode = TheScene.EN_JUEGO;
                    var blocker = document.getElementById('blocker');
                    blocker.style.display = 'none';
                    
                    render();                    
                } 
                else if(applicationMode == TheScene.EN_JUEGO){                  //poner pantalla de pausa terminar !!!!!
                    applicationMode = TheScene.PAUSA;
                    var blocker = document.getElementById('blocker');
                    blocker.style.display = '-webkit-box';
                    blocker.style.opacity = 0.8;                         
                }

                break;
        }
    };

    window.addEventListener("keypress", onKeyPress, false);
    window.addEventListener("keydown", onKeyDown, false);
    window.addEventListener("keyup", onKeyUp, false);
}

function actualizarPosicion() {
        
        if (moveRight1) {

            restric1.enableLinearMotor(-8, 10);
        } else if (moveLeft1) {

            restric1.enableLinearMotor(8, 10);
        }

        if (!moveLeft1 && !moveRight1) {

            restric1.enableLinearMotor(0, 10);

        }
    
        if (moveRight2) {

            restric2.enableLinearMotor(8, 10);
        } else if (moveLeft2) {

            restric2.enableLinearMotor(-8, 10);

        }

        if (!moveLeft2 && !moveRight2) {

            restric2.enableLinearMotor(0, 10);

        }
}

/// It creates and configures the WebGL renderer
/**
 * @return The renderer
 */
function createRenderer() {
    var renderer = new THREE.WebGLRenderer();
    renderer.setClearColor(new THREE.Color(0xCCEEFF ), 1.0);
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.shadowMap.enabled = true;
    return renderer;
}

/// It renders every frame
function render() {
    
    findepartida();
    
    stats.update();
    scene.animate(GUIcontrols);    
    
    //Comprueba si el juego esta parado

    if (applicationMode == TheScene.EN_JUEGO) {

        requestAnimationFrame(render);
        scene.simulate();
        actualizarPosicion();
    }    
    
    if(players2 == false){
        
         if(scene.disco.position.x == scene.player1.position.x){
        
            restric2.enableLinearMotor(0, 10);       
        }
        else if(scene.disco.position.x > scene.player1.position.x){

            restric2.enableLinearMotor(-2.5, 10);       
        }
        else if(scene.disco.position.x < scene.player1.position.x){

            restric2.enableLinearMotor(2.5, 10);       
        }
        
        renderer.setViewport(0, 0, 1 * window.innerWidth, 1 * window.innerHeight);
        renderer.setScissor(0, 0, 1 * window.innerWidth, 1 * window.innerHeight);
        renderer.setScissorTest(true);
        scene.getCameraControls().update();
        renderer.render(scene, scene.getCamera());
    }    
    else{ 
        
        renderer.setViewport(0, 0, 0.5 * window.innerWidth, 1 * window.innerHeight);
        renderer.setScissor(0, 0, 0.5 * window.innerWidth, 1 * window.innerHeight);
        renderer.setScissorTest(true);
        renderer.render(scene, scene.getCamera());

        renderer.setViewport(0.5 * window.innerWidth, 0,  0.5 * window.innerWidth, 1 * window.innerHeight);
        renderer.setScissor(0.5 * window.innerWidth, 0,  0.5 * window.innerWidth, 1 * window.innerHeight);
        renderer.setScissorTest(true);
        renderer.render(scene, scene.getCamera2());
    }
    
    renderer.setViewport(0.1 * window.innerWidth, 811,  0.2 * window.innerWidth, 0.2 * window.innerHeight);
    renderer.setScissor(0.1 * window.innerWidth, 868,  0.2 * window.innerWidth, 0.08 * window.innerHeight);
    renderer.setScissorTest(true);
    renderer.render(scene, scene.getCameraGlobal());
    
}

/// The main function
$(function () {

    Physijs.scripts.worker = "../libs/physijs_worker.js";
    Physijs.scripts.ammo = "../libs/ammo.js";

    // create a render and set the size
    renderer = createRenderer();
    // add the output of the renderer to the html element
    $("#WebGL-output").append(renderer.domElement);
    // liseners
    window.addEventListener("resize", onWindowResize);
    window.addEventListener("mousedown", onMouseDown, true);

    addListeners();
    
    // create a scene, that will hold all our elements such as objects, cameras and lights.
    scene = new TheScene(renderer.domElement);

    scene.setGravity = new THREE.Vector3(0, -50, 0);
    
    document.getElementById("puntos1").innerHTML = 0;
    document.getElementById("puntos2").innerHTML = 0;

    createGUI(true);
    
    var audio = document.getElementById("inicio");
    audio.play();
    audio.volume = 0.6;

});
