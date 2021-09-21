/// The Model Facade class. The root node of the graph.
/**
 * @param renderer - The renderer to visualize the scene
 */
class TheScene extends Physijs.Scene {

    constructor(renderer) {
        super();

        // Attributes

        this.ambientLight = null;
        this.spotLight = null;
        this.camera = null;
        this.camera2 = null;
        this.cameraglobal = null;
        this.trackballControls = null;
        this.ground = null;
        
        this.player1 = null;
        this.player2 = null;
        this.disco = null;
        
        this.pantalla1 = null;
        this.pantalla2 = null;
        this.hero1 = "imgs/boss.jpg";
        this.hero2 = "imgs/boss.jpg";
        
        this.time = false  ///terminar en el script
        this.timeinterval = null;       ///timer del marcador
        
        this.audio = null;
        this.limittime = document.getElementById("limittime");
        this.musica = false;

        this.createLights();
        this.axis = new THREE.AxisHelper(25);
        this.add(this.axis);
    }
    
    gameMode(){
        
        if(players2){
            this.audio = document.getElementById("multyplayer");
        }
        else{
            this.audio = document.getElementById("oneplayer");
        }
        
        var ale = Math.floor(Math.random() * (3 + 1) );
        
        this.ground = new Ground(ale);
        this.createCamera();
        this.createModel();
        this.timer();
    }

    /// It creates the camera and adds it to the graph
    /**
     * @param renderer - The renderer associated with the camera
     */
    createCamera(renderer) {
        
        this.cameraglobal = new THREE.PerspectiveCamera(55, window.innerWidth / window.innerHeight, 0.1, 100);
        this.cameraglobal.position.set(0, 26.4, 0);
        var look = new THREE.Vector3(0, 0, 0);
        this.cameraglobal.lookAt(look);
        
        this.cameraglobal.rotation.z = -Math.PI/2;
        
        this.add(this.cameraglobal);
        
        if(players2 == false){
            
            this.camera = new THREE.PerspectiveCamera(55, window.innerWidth / window.innerHeight, 0.1, 2000);
            this.camera.position.set(0, 14, 26.2);
            var look = new THREE.Vector3(0, 6, 0);
            this.camera.lookAt(look);

            this.trackballControls = new THREE.TrackballControls(this.camera, renderer);
            this.trackballControls.rotateSpeed = 5;
            this.trackballControls.zoomSpeed = -2;
            this.trackballControls.panSpeed = 0.5;
            this.trackballControls.target = look;

            this.add(this.camera);
        }
        else{
            
        this.camera = new THREE.PerspectiveCamera(55, window.innerWidth / window.innerHeight, 0.1, 2000);
        
        this.camera2 = new THREE.PerspectiveCamera(55, window.innerWidth / window.innerHeight, 0.1, 2000);

        //this.camera.position.set(0, 900, -100);
        
        this.camera.position.set(0, 14, -26.2);
        this.camera2.position.set(0, 14, 26.2);

        var look = new THREE.Vector3(0, 6, 0);
        var look2 = new THREE.Vector3(0, 6, 0);

        this.camera.lookAt(look2);
        this.camera2.lookAt(look);

        //Controles para la vista general

        /*this.trackballControls = new THREE.TrackballControls(this.camera, renderer);
        this.trackballControls.rotateSpeed = 5;
        this.trackballControls.zoomSpeed = -2;
        this.trackballControls.panSpeed = 0.5;
        this.trackballControls.target = look;*/

        //Controles para la vista subjetiva

        this.add(this.camera);
        this.add(this.camera2);
        }
    }

    /// It creates lights and adds them to the graph
    createLights() {
        // add subtle ambient lighting
        this.ambientLight = new THREE.AmbientLight(0xccddee, 0.35);
        this.add(this.ambientLight);

        // add spotlight for the shadows
        this.spotLight = new THREE.SpotLight(0xffffff);
        this.spotLight.position.set(0, 38, 0);
        this.spotLight.castShadow = true;
        // the shadow resolution
        this.spotLight.shadow.mapSize.width = 2048
        this.spotLight.shadow.mapSize.height = 2048;
        this.add(this.spotLight);
    }

    /// It creates the geometric model: crane and ground
    /**
     * @return The model
     */
    createModel() {

        //creacion del campo y fondo
        this.add(this.ground.paredder);
        this.add(this.ground.paredizq);
        this.add(this.ground.paredinfder);
        this.add(this.ground.paredinfizq);
        this.add(this.ground.paredsupder);
        this.add(this.ground.paredsupizq);
        this.add(this.ground.esquina1);
        this.add(this.ground.esquina2);
        this.add(this.ground.esquina3);
        this.add(this.ground.esquina4);
        this.add(this.ground.campo);
        this.add(this.ground.ground);

        
        //creacion del disco y players
        var elementos = new JugadorAndPuck();

        this.disco = elementos.puck;

        this.disco.position.y += 1.75;
        this.disco.position.z = 11;
        this.disco.position.x = 3;
        
        this.add(this.disco);
        
        this.disco.setAngularFactor(new THREE.Vector3(0, 0, 0));

        this.player1 = elementos.player1;

        this.player1.position.z = -11.4;
        this.player1.position.y += 0.755;

        this.player2 = elementos.player2;

        this.player2.position.z = 11.4;
        this.player2.position.y += 0.755;

        this.add(this.player1);
        this.add(this.player2);
        
        
        //creacion de los personajes la pantallas
        this.personajes();
    }
    
    //Crear personajes
    
    personajes(){
        
        var loader = new THREE.TextureLoader();
        var material = new THREE.MeshPhongMaterial({map: loader.load(this.hero1), emissive:0x151515});

        this.pantalla1 = new Physijs.PlaneMesh(new THREE.PlaneGeometry(10, 10), material, 0);

        this.pantalla1.position.y = 5.75;
        this.pantalla1.position.z = -13.5;

        this.add(this.pantalla1);

        material = new THREE.MeshPhongMaterial({map: loader.load(this.hero2), emissive:0x1F1F1F});

        this.pantalla2 = new Physijs.PlaneMesh(new THREE.PlaneGeometry(10, 10), material, 0);

        this.pantalla2.rotation.y = Math.PI;
        this.pantalla2.position.y = 5.75;
        this.pantalla2.position.z = 13.5;

        this.add(this.pantalla2);
    }
    
    //Timer
    
    timer(){
        
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            return {
                'total': t,
                'minutes': minutes,
                'seconds': seconds
            };
        }
        
        function initializeClock(endtime) {

            function updateClock() {
                
                    var t = getTimeRemaining(endtime);

                    var puntos = document.getElementById("tiempo").innerHTML = ('0' + t.minutes).slice(-2) + ":" + ('0' + t.seconds).slice(-2);

                    if (t.total == 1000 * 11) {

                        GUIcontrols.musica = false;
                        this.limittime = document.getElementById("limittime");
                        this.limittime.play();
                        this.limittime.volume = 0.4;

                    }

                    if (t.total == 0) {

                        var audio = document.getElementById("muerte");

                        this.limittime.pause();
                        this.limittime.currentTime = 0;

                        audio.play();

                        applicationMode = TheScene.PANTALLAFINAL;
                        
                        console.log("fin");
                        clearInterval(this.timeinterval);
                    }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        this.deadline = new Date(Date.parse(new Date()) + 3 * 60 * 1000);
        initializeClock(this.deadline);
        
    }

    /// It sets the crane position according to the GUI
    /**
     * @controls - The GUI information
     */
    animate(controls) {
        this.axis.visible = controls.axis;
        this.spotLight.visible = controls.luz;
        this.spotLight.intensity = controls.lightIntensity;
        
        if(controls.movrandom){
            
            var aux = new THREE.Vector3(0, 0, 0);
            
            aux.z = Math.floor(Math.random() * (6 + 1));
            
            this.disco.setLinearVelocity(aux);
        }
        else{
           
            this.disco.setAngularVelocity(new THREE.Vector3(0, 0, 0));
        }

        if (controls.musica == true) {

            if (this.musica == false) {
                this.audio.play();
                this.audio.volume = 0.5;
                this.musicascene = true;
                this.musica = true;
            }

        } else {

            if (this.musica == true) {
                this.audio.pause();
                this.audio.currentTime = 0;
                this.musicascene = true;
                this.musica = false;
            }
        }

    }

    /// It returns the camera
    /**
     * @return The camera
     */
    getCamera() {
        return this.camera;
    }
    
    /// It returns the camera2
    /**
     * @return The camera2
     */
    getCamera2() {
        return this.camera2;
    }
    
    /// It returns the camera2
    /**
     * @return The camera2
     */
    getCameraGlobal() {
        return this.cameraglobal;
    }

    /// It returns the camera controls
    /**
     * @return The camera controls
     */
    getCameraControls() {
        return this.trackballControls;
    }

    /// It updates the aspect ratio of the camera
    /**
     * @param anAspectRatio - The new aspect ratio for the camera
     */
    setCameraAspect(anAspectRatio) {
        this.camera.aspect = anAspectRatio;
        this.camera.updateProjectionMatrix();
    }
    
    setCamera2Aspect(anAspectRatio) {
        this.camera2.aspect = anAspectRatio;
        this.camera2.updateProjectionMatrix();
    }

}

TheScene.INSTRUCCIONES = 0;
TheScene.MENU = 1;
TheScene.MODE = 2;
TheScene.PAUSA = 3;
TheScene.PANTALLAFINAL = 4;
TheScene.EN_JUEGO = 5;
