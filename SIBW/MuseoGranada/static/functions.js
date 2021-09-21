var a = 0;

function show_hide() {

    var hcb = document.getElementById("hcb");

    if (a == 0) {

        hcb.style.display = "block";
        a++;
    } else {

        hcb.style.display = "none";
        a--;
    }
}

function censura() {

    var lista = ["tonto", "adufe", "cafre", "lerdo", "melón", "orate", "ovejo", "calvo", "patán", "Jaime"];

    var palabra = document.getElementById("comment");
    var textarea = palabra.value;

    for (var i = 0; i < lista.length; i++) {

        regex = new RegExp("(^|\\s)" + lista[i] + "($|(?=\\s))", "gi");

        textarea = textarea.replace(regex, "***** ");
        console.log(textarea);
    }
    palabra.value = textarea;
}

function enviar() {

    var nombre = document.getElementById("nombre").value;
    var email = document.getElementById("email").value;
    var comentario = document.getElementById("comment").value;
    var fecha = new Date();
    var dd = fecha.getDate();
    var mm = fecha.getMonth() + 1;
    var yyyy = fecha.getFullYear();
    var hours = fecha.getHours();
    var minutes = fecha.getMinutes();
    var seconds = fecha.getSeconds();

    fecha = dd + "/" + mm + "/" + yyyy + " " + hours + ":" + minutes + ":" + seconds;

    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    if (nombre == "") {

        document.getElementById("nombre").focus();
        alert("El nombre está vacío");

    } else if (email == "") {

        document.getElementById("email").focus();
        alert("El email está vacío");

    } else if (comentario == "") {

        document.getElementById("comment").focus();
        alert("El comentario está vacío");

    } else if (!emailRegex.test(email)) { //COMPROBAR EMAIL

        alert("El email es incorrecto");

    } else if (nombre == "Anónimo") {

        alert("Solo los usuarios registrados pueden comentar");

    } else {

        var div = document.getElementById("ListaComentarios");
        div.innerHTML += "<div><p><b>Autor:</b>" + nombre + "</p><p><b>" + fecha + "</b></p><p>" + comentario + "</p></div><hr/>";
        document.getElementById("nombre").value = "";
        document.getElementById("email").value = "";
        document.getElementById("comment").value = "";
    }
}

function comprobar() {

    var pass = document.getElementById("Tipo").value;

    if (pass != "Registrado" || pass != "Gestor" || pass != "Moderador" || pass != "Administrador"){

        alert("Los permisos que puede introducir son: Registrado, Gestor, Moderador, o Administrador");

    }
}

    function subir() {

        var nombre = document.getElementById("nombre").value;
        var url = document.getElementById("url").value;

        if (nombre == "") {

            document.getElementById("nombre").focus();
            alert("El nombre está vacío");

        } else if (url == "") {

            document.getElementById("url").focus();
            alert("El URL está vacío");

        } else {

            var div = document.getElementById("videos");
            div.innerHTML += "<div><iframe width='560' height='315'  src='" + url + "' frameborder='2' allow='autoplay; encrypted-media' allowfullscreen ></iframe></br><p><b>Autor:</b>" + nombre + "</p><hr/></div>";

            document.getElementById("nombre").value = "";
            document.getElementById("url").value = "";
        }
    }
