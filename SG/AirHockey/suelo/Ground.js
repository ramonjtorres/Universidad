class Ground {

    constructor(tipo) {

        //Material de las paredes

        var material1 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 1.1);

        var material2 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 1.1);

        var material3 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 0.9);

        var material4 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 0.9);

        var material5 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 0.9);

        var material6 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 0.9);

        var material7 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 1);

        var material8 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 1);

        var material9 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 1);

        var material10 = new Physijs.createMaterial(new THREE.MeshPhongMaterial({
            color: 0x58acfa,
            shininess: 70
        }), 0, 1);

        //Material del campo

        var loader = new THREE.TextureLoader();

        
        switch(tipo){
                
            case 0:
                var materialcampo = new Physijs.createMaterial(new THREE.MeshPhongMaterial({map: loader.load("imgs/suelo2.png"), shininess: 70}), 0, 0);

                //Material del fondo

                var material = new THREE.MeshPhongMaterial({color: 0x9f2ae4, shininess: 70});
                break;
                
            case 1:
                var materialcampo = new Physijs.createMaterial(new THREE.MeshPhongMaterial({map: loader.load("imgs/suelo3.png"), shininess: 70}), 0, 0);

                //Material del fondo

                var material = new THREE.MeshPhongMaterial({color: 0xFFFAFA, shininess: 70, emissive:0x343434});
                break;
                
            case 2:
                var materialcampo = new Physijs.createMaterial(new THREE.MeshPhongMaterial({map: loader.load("imgs/suelo4.png"), shininess: 70}), 0, 0);

                //Material del fondo

                var material = new THREE.MeshPhongMaterial({color: 0xEA9749, shininess: 70});
                break;
                
            case 3:
                var materialcampo = new Physijs.createMaterial(new THREE.MeshPhongMaterial({map: loader.load("imgs/suelo5.jpg"), shininess: 70}), 0, 0);

                //Material del fondo

                var material = new THREE.MeshPhongMaterial({color: 0x45A237, shininess: 70});
                break;
        }

        material.side = THREE.DoubleSide;

        //Generacion del fondo

        var ground = new THREE.PlaneGeometry(100, 100, 20, 20);

        for (var i = 0; i < ground.vertices.length; i++) {
            ground.vertices[i].z += (Math.random() * 1.5) - 0.75;
        }
        ground.verticesNeedUpdate = true;
        ground.computeFlatVertexNormals();
        ground.computeFaceNormals();

        this.ground = new THREE.Mesh(ground, material);
        this.ground.rotation.x = -Math.PI / 2;
        this.ground.receiveShadow = true;
        this.ground.updateMatrix();
        this.ground.autoUpdateMatrix = false;

        //Campo de juego  

        this.campo = new Physijs.BoxMesh(new THREE.BoxGeometry(10.4, 1.5, 27, 1, 1, 1), materialcampo, 0);

        this.paredizq = new Physijs.BoxMesh(new THREE.BoxGeometry(1.25, 0.2, 25, 1, 1, 1), material1, 0);

        this.paredizq.rotation.z = Math.PI / 2;
        this.paredizq.position.y = 1.375;
        this.paredizq.position.x = -5.1;


        this.paredder = new Physijs.BoxMesh(new THREE.BoxGeometry(1.25, 0.2, 25, 1, 1, 1), material2, 0);

        this.paredder.rotation.z = Math.PI / 2;
        this.paredder.position.y = 1.375;
        this.paredder.position.x = 5.1;


        this.paredinfder = new Physijs.BoxMesh(new THREE.BoxGeometry(3.5, 0.2, 1.25, 1, 1, 1), material3, 0);

        this.paredinfder.rotation.x = Math.PI / 2;
        this.paredinfder.position.y = 1.375;
        this.paredinfder.position.z = -12.6;
        this.paredinfder.position.x = 3.45;


        this.paredinfizq = new Physijs.BoxMesh(new THREE.BoxGeometry(3.5, 0.2, 1.25, 1, 1, 1), material4, 0);

        this.paredinfizq.rotation.x = Math.PI / 2;
        this.paredinfizq.position.y = 1.375;
        this.paredinfizq.position.z = -12.6;
        this.paredinfizq.position.x = -3.45;


        this.paredsupder = new Physijs.BoxMesh(new THREE.BoxGeometry(3.5, 0.2, 1.25, 1, 1, 1), material5, 0);

        this.paredsupder.rotation.x = Math.PI / 2;
        this.paredsupder.position.y = 1.375;
        this.paredsupder.position.z = 12.6;
        this.paredsupder.position.x = 3.45;


        this.paredsupizq = new Physijs.BoxMesh(new THREE.BoxGeometry(3.5, 0.2, 1.25, 1, 1, 1), material6, 0);

        this.paredsupizq.rotation.x = Math.PI / 2;
        this.paredsupizq.position.y = 1.375;
        this.paredsupizq.position.z = 12.6;
        this.paredsupizq.position.x = -3.45;


        this.esquina1 = new Physijs.BoxMesh(new THREE.BoxGeometry(1.5, 0.2, 1.25, 1, 1, 1), material7, 0);

        this.esquina1.rotation.x = Math.PI / 2;
        this.esquina1.rotation.z = Math.PI / 4;
        this.esquina1.position.y = 1.375;
        this.esquina1.position.z = 12.1;
        this.esquina1.position.x = -4.6;

        this.esquina2 = new Physijs.BoxMesh(new THREE.BoxGeometry(1.5, 0.2, 1.25, 1, 1, 1), material8, 0);

        this.esquina2.rotation.x = Math.PI / 2;
        this.esquina2.rotation.z = Math.PI / 4;
        this.esquina2.position.y = 1.375;
        this.esquina2.position.z = -12.1;
        this.esquina2.position.x = 4.6;

        this.esquina3 = new Physijs.BoxMesh(new THREE.BoxGeometry(1.5, 0.2, 1.25, 1, 1, 1), material9, 0);

        this.esquina3.rotation.x = Math.PI / 2;
        this.esquina3.rotation.z = (-45 * Math.PI) / 180;
        this.esquina3.position.y = 1.375;
        this.esquina3.position.z = 12.1;
        this.esquina3.position.x = 4.6;

        this.esquina4 = new Physijs.BoxMesh(new THREE.BoxGeometry(1.5, 0.2, 1.25, 1, 1, 1), material10, 0);

        this.esquina4.rotation.x = Math.PI / 2;
        this.esquina4.rotation.z = (-45 * Math.PI) / 180;
        this.esquina4.position.y = 1.375;
        this.esquina4.position.z = -12.1;
        this.esquina4.position.x = -4.6;

        this.paredizq.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.paredder.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.paredinfder.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.paredinfizq.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.paredsupder.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.paredsupizq.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.esquina1.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.esquina2.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.esquina3.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
        this.esquina4.addEventListener('collision', function (object) {
            var audio = document.getElementById("palas");
            audio.play();
        });
    }
}
