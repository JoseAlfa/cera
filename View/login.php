<?php @session_start();
if (isset($_SESSION['idu'])) {
  include_once '../Controller/determinateRuta.php';
  $rol=getRol($_SESSION['idu']);
  switch ($rol) {
    case 1:
      header('location: administrador.php');
      break;
    case 2:
      header('location: agente.php');
      break;
    case 3:
      header('location: usuariofinal.php');
      break;
    default:
      session_destroy();
      header('location: login.php');
      break;
  }
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Ceracom ">
    <title>Inicio de sesión - Ceracom</title>
    <!--  Android 5 Chrome Color-->
    <meta name="theme-color" content="#EE6E73">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!--link href="../fonts.googleapis.com/icone91f.css?family=Material+Icons" rel="stylesheet"-->
  </head>
  <body class="grey lighten-4">
    <div class="pre" style="height: 97%;">
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-green-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
    <main>
      <div class="container">
        <div class="row logc">
          <h4 class="t-center l-h">Mesa de servico</h4>
          <div class="col s1 m2 l4"></div>
          <div class="col s10 m8 l4 card t-center">
            <p>Incio de sesión</p>
            <form id="loginForm">
              <div class="input-field">
                <input id="username" type="text" class="validate" required>
                <label for="username">Usuario</label>
              </div>
              <div class="input-field">
                <input id="pasword" type="password" class="validate" required>
                <label for="pasword">Contraseña</label>
              </div>
             </li> <button type="submit" class="btn waves-effect blue right" id="enviar" >Iniciar</button>
            </form>
          </div>
          <div class="col s12"><p class="t-center">© 2019 Ceracom, Todos loa derechos reservados.</p></div>
          
        </div>
      </div>
    </main>   

    <!--  Scripts-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/login.js"></script>

  </body>

<!-- Ceracom 2019 -->
</html>