class JugadorAndPuck {
    constructor() {
        this.puck = null;
        this.player1 = null;
        this.player2 = null;

        this.createPuck();
        this.createPlayer1();
        this.createPlayer2();

    }
    createPuck() {

        var material = new Physijs.createMaterial(new THREE.MeshPhongMaterial({ color: 0xF7FE2E, shininess: 70}), 0, 0.8);

        this.puck = new Physijs.CylinderMesh(new THREE.CylinderGeometry(0.5, 0.5, 0.25, 16), material, 50);
        this.puck.position.y = 0.125;
        this.puck.castShadow = true;
    }

    createPlayer1() {

        var material = new Physijs.createMaterial(new THREE.MeshPhongMaterial({color: 0x040FF, shininess: 70}), 0, 1);

        this.player1 = new Physijs.CylinderMesh(new THREE.CylinderGeometry(1, 1, 0.6, 16), material, 20);
        this.player1.position.y = 0.3;
        this.player1.castShadow = true;

        var cabeza = new Physijs.SphereMesh(new THREE.SphereGeometry(0.4, 80, 80), material, 4);
        cabeza.position.y = 0.8;
        cabeza.castShadow = true;

        var cuello = new Physijs.CylinderMesh(new THREE.CylinderGeometry(0.4, 0.4, 0.6, 16), material, 6);
        cuello.position.y = 0.6;
        cuello.castShadow = true;

        this.player1.add(cuello);
        this.player1.add(cabeza);

        this.player1.addEventListener('collision', function (object) {
            
            var audio = document.getElementById("palas");
            audio.play();
            });

    }

    createPlayer2() {

        var material = new Physijs.createMaterial(new THREE.MeshPhongMaterial({color: 0xFF0000, shininess: 70}), 0, 1);

        this.player2 = new Physijs.CylinderMesh(new THREE.CylinderGeometry(1, 1, 0.6, 16), material, 20);
        this.player2.position.y = 0.3;
        this.player2.castShadow = true;

        var cabeza = new Physijs.SphereMesh(new THREE.SphereGeometry(0.4, 80, 80), material, 4);
        cabeza.position.y = 0.8;
        cabeza.castShadow = true;

        var cuello = new Physijs.CylinderMesh(new THREE.CylinderGeometry(0.4, 0.4, 0.6, 16), material, 6);
        cuello.position.y = 0.6;
        cuello.castShadow = true;

        this.player2.add(cuello);
        this.player2.add(cabeza);

        this.player2.addEventListener('collision', function (object) {

            var audio = document.getElementById("palas");
            audio.play();
        });

    }

}
