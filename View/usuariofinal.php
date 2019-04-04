<?php @session_start();
if (isset($_SESSION['idu'])) {
  include_once '../Controller/determinateRuta.php';
  $rol=getRol($_SESSION['idu']);
  if ($rol!=3) {
    switch ($rol) {
      case 1:
        header('location: administrador.php');
        break;
      case 2:
        header('location: agente.php');
        break;
      default:
        session_destroy();
        header('location: login.php');
        break;
    }
  }
}else{
  header('location: login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from materializecss.com/css-transitions.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Sep 2017 19:50:13 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Ceracom ">
    <title>Usuario - Ceracom</title>
    <!--  Android 5 Chrome Color-->
    <meta name="theme-color" content="#EE6E73">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="./css/all.css">
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link href="./css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!--link href="../fonts.googleapis.com/icone91f.css?family=Material+Icons" rel="stylesheet"-->
  </head>
  <body class="grey lighten-4">
    <div class="pre">
      <div class="preloader-wrapper big active">
        <div class="spinner-layer loadcol">
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
    <header>
      <div class="navbar-fixed">
        <nav class="nav-extended blue darken-4">
          <div class="nav-wrapper">
            <img src="img/logos/logoceracom.jpg" align="center" width="180" height="60"><a href="#" class="brand-logo"></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fas fa-bars"></i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="#"><i class="fas fa-user tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil del Usuario"></i></a></li>
              <li><a href="#"><i class="fas fa-plus tooltipped" data-position="bottom" data-delay="50" data-tooltip="Otras opciones"></i></a></li>
              <li><a onclick="app.salir();" href="#"><i class="fas fa-power-off" data-position="bottom" data-delay="50" data-tooltip="Cerrar sesión"></i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
              <li><a href="#"><i class="fas fa-user"></i> Perfil del Usuario</a></li>
              <li><a href="#"><i class="fas fa-power-off"></i> Opciones </a></li>
              <li><a onclick="app.salir();" href="#"><i class="fas fa-plus"></i> Cerrar Sesión</a></li>
            </ul>
          </div>
          <div class="nav-content">
            <ul class="tabs tabs-transparent">
              <li class="tab"><a class="active" href="#test1"><i class="fas fa-briefcase"></i><sapan class="hide-on-small-menu"> Inicio</sapan></a></li>
              <li class="tab"><a href="#nuevasolicitud"><i class="fas fa-file-alt"></i><sapan class="hide-on-small-menu"> Nueva Solicitud</sapan></a></li>
              <li class="tab"><a href="#test3"><i class="fas fa-bell"></i><sapan class="hide-on-small-menu"> Solicitudes</sapan></a></li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <main>

      <div class="contenedor" id="test1">
        <div class="row">
          <div class="carousel" id="test1"><img src="img/servicios/mama.jpg" width="1200px" height="300px" align="center"></div>
          <div class="carousel" id="test1"><img src="img/servicios/presion.jpg" width="1200px" height="300px" align="center"></div>
          </div>
          </div>

          <div class="contenedor" id="nuevasolicitud">
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Coloque el titulo de su solicitud" id="titulo_solicitud" type="text" class="validate">
          <label for="titulo_solicitud">Titulo de la Solicitud</label>
        </div>
        <div class="input-field col s12">
          <input placeholder="Coloque la descripcion de su solicitud" id="descripcion_solicitud" type="text" class="validate">
          <label for="descripcion_solicitud">Descripción de la Solicitud</label>
        </div>
      </div>
      <div class="row">
        <div <button class="btn waves-effect waves-light" type="submit" name="action">
          <i class="material-icons right">Enviar archivo</i>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Coloque el tema de la solicitud" id="tema_solicitud" type="text" class="validate">
          <label for="email">Tema de la solicitud</label>
        </div>
      </div>
        <div class="row" align="right">
        <a class="waves-effect waves-light btn"><i class="material-icons left">Cancelar</i></a>
        <a class="waves-effect waves-light btn"><i class="material-icons right">Enviar</i></a>
        </div>
    </form>
  </div>

          <div id="test3" class="col s12">Test 3</div>
        </div>   
    <footer class="page-footer blue darken-4">
      <div class="footer-copyright">
        <div class="container">
        © 2019 Ceracom, Todos los derechos reservados.
        </div>
      </div>
    </footer>

    <!--  Scripts-->
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/materialize.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/script.js"></script>
    <!-- Chart Plugins Js -->
    <script src="./js/chartjs/Chart.bundle.js"></script>
    <script src="./js/chartjs.js"></script>

  </body>
</html>