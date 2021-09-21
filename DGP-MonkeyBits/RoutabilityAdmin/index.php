<!DOCTYPE html>
<html>
<!-- ES NECESARIO QUE EL SCRIPT ESTÉ DEBAJO DE TODO EL HTML O AL MENOS DETRAS DEL HEAD PARA QUE FUNCIONE EL FIREBASE -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RoutabilityAdmin</title>
  <link rel="shortcut icon" href="./img/monkeybits2.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="theme.css" type="text/css">
  <link rel="stylesheet" href="fonts.css" type="text/css">

  <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyALMvr5CqpG1Et8qP8BNQ0uFt6P_H0kvhI",
      authDomain: "adminroutability.firebaseapp.com",
      databaseURL: "https://adminroutability.firebaseio.com",
      projectId: "adminroutability",
      storageBucket: "adminroutability.appspot.com",
      messagingSenderId: "253774242478"
    };
    firebase.initializeApp(config);
  </script>
 
</head>

<?php
    
    session_start();
    
    $_SESSION['EMAIL'] = null;
    
if(isset($_POST["login"])){
 
    if(!empty($_POST['Email']) && !empty($_POST['Password'])) {
         
         $EMAIL=$_POST['Email'];
         $PASSWORD=$_POST['Password']; 
         ?>

         <script>
            var exito = true;
            firebase.auth().signInWithEmailAndPassword('<?php echo $EMAIL ?>', '<?php echo $PASSWORD ?>').catch(function(error) {
    
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            if (errorCode === 'auth/wrong-password') {
              exito = false;
              alert('Contraseña incorrecta');
            }
            else if (errorCode === 'auth/invalid-email') {
              exito = false;
              alert('Correo electrónico inválido');
            }
            else if (errorCode === 'auth/user-disabled') {
              exito = false;
              alert('Usuario desestimado');
            }
            else if(errorCode === 'auth/user-not-found') {
              exito = false;
              alert('Usuario no encontrado');
            }
            else{
              exito = true;
            }
            <?php
              $_SESSION["EMAIL"] = $_POST["Email"];
            ?>
          });
  
         </script>
    <?php
             
     } 
   }
?>    
    
<body class="bg-primario" style="">
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3"><img title="Logo MonkeyBits" alt="Logo MonkeyBits" class="img-fluid d-block float-left p-2" src="./img/monkeybits2.png" width="200" height="10"></div>
        <div class="col-md-7">
          <h1 class="display-3">Routability: Granada</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5" style="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mx-auto col-md-12 col-10 bg-white p-5 border border-dark rounded-0" style=" transform:  translateY(-120px) ; min-width: 325px">
            <h1 class="mb-4 w-25" style=" transform:  translateY(-20px)  scale(1.5);"><b>Iniciar Sesión</b></h1>
            
            <form action="index.php" method="post" autocomplete="on">
                
              <div class="form-group"> <input type="email" required value="Email" name="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' " class="form-control" placeholder="Enter email" id="form9"> </div>
                <div class="form-group mb-3"> <input type="password" required value="Password" name="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " class="form-control" placeholder="Password" id="form10"> <small class="form-text text-muted text-right"></small> </div> <button type="submit" name="login" value="Login" class="btn bg-primario"><b>Iniciar Sesión</b></button>
            </form>
              
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
</body>
<script>

  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      // User is signed in.
      var displayName = user.displayName;
      var email = user.email;
      var emailVerified = user.emailVerified;
      var photoURL = user.photoURL;
      var isAnonymous = user.isAnonymous;
      var uid = user.uid;
      var providerData = user.providerData;
      location.href="Home.php";
      console.log("Sesión iniciada");
    } else {
      console.log("Usuario no inicia sesión");
    }
});


</script>
</html>