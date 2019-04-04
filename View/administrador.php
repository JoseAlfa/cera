<?php @session_start();
if (isset($_SESSION['idu'])) {
  include_once '../Controller/determinateRuta.php';
  $rol=getRol($_SESSION['idu']);
  if ($rol!=1) {
    switch ($rol) {
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
    <title>Administrador - Ceracom</title>
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
    <header>
      <nav class="nav-extended blue darken-4">
        <div class="nav-wrapper">
          <img src="img/logos/logoceracom.jpg" align="center" width="180" height="60"><a href="#" class="brand-logo"></a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fas fa-bars"></i></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li onclick="admin.categorias();"><a href="#"><i class="fas fa-sitemap tooltipped" data-position="bottom" data-delay="50" data-tooltip="Categorías"></i></a></li>
            <li onclick="admin.empresas();"><a href="#"><i class="fas fa-building tooltipped" data-position="bottom" data-delay="50" data-tooltip="Empresas"></i></a></li>
            <li><a  class="modal-trigger" href="#perfil"><i class="fas fa-user tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil del Administrador"></i></a></li>
            <li><a href="#" onclick="app.salir();"><i class="fas fa-power-off tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cerrar sesión"></i></a></li>
          </ul>
          <ul class="side-nav" id="mobile-demo">
            <li onclick="admin.categorias();"><a href="#">Categorías</a></li>
            <li onclick="admin.empresas();"><a href="#">Empresas</a></li>
            <li><a class="modal-trigger" href="#perfil">Perfil del Administrador</a></li>
            <li onclick="app.salir();"><a href="#">Cerrar Sesión</a></li>
          </ul>
        </div>
        <div class="nav-content">
          <ul class="tabs tabs-transparent">
            <li class="tab" data-get="users"><a href="#users"><i class="fas fa-chalkboard-teacher"></i><sapan class="hide-on-small-only "> Usuarios</sapan></a></li>
            <li class="tab" data-get="grupos"><a href="#grupos"><i class="fas fa-users"></i><sapan class="hide-on-small-only"> Grupos</sapan></a></li>
            <li class="tab" data-get="servicios"><a href="#servicios"><i class="fas fa-wrench"></i><sapan class="hide-on-small-only"> Servicios</sapan></a></li>
            <li class="tab"><a class="active" href="#solicitudes"><i class="fas fa-book"></i><sapan class="hide-on-small-only"> Solicitudes</sapan></a></li> 
            <li class="tab" data-get="baseconocimientos"><a href="#baseconocimientos" ><i class="fas fa-database"></i><sapan class="hide-on-small-only"> Base de Conocimiento</sapan></a></li>
          </ul>
        </div>
      </nav>
    </header>
        <div class="row">
          <div id="users" class="col s12"></div>
          <div id="servicios" class="col s12"></div>
          <div class="row" id="solicitudes">
            <ul class="tabs tabs-transparent blue darken-2 z-depth-1">
              <li class="tab col s4" data-get="noResolve"><a class="active" href="#noResolve"><i class="far fa-clock"></i><sapan class="hide-on-small-only"> Sin Resolver</sapan></a></li>
              <li class="tab col s4" data-get="resolve"><a href="#resolve"><i class="far fa-check-circle"></i><sapan class="hide-on-small-only"> Resuelto</sapan></a></li>
              <li class="tab col s4" data-get="noAing"><a href="#noAing"><i class="fas fa-arrow-circle-down"></i><sapan class="hide-on-small-only"> No Asignado</sapan></a></li> 
            </ul>
            <div id="noResolve" class="col s12">Espere porfavor</div>
            <div id="resolve" class="col s12">Test 4</div>
            <div id="noAing" class="col s12">Test 5</div>
          </div>
          <div id="grupos" class="col s12">Test 6</div>
          <div id="baseconocimientos" class="col s12"></div>
          <div class="col" id="oterViews" hidden>
            <div class="cuer">
              <a href="#!" class="close" onclick="admin.cerrarOterView();">cerrar</a>
              <div class="">
                <div class="" id="oterViewContent">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    <footer class="page-footer blue darken-4">
      <div class="footer-copyright">
        <div class="container">
        © 2019 Ceracom, Todos los derechos reservados.
        <!--a class="grey-text text-lighten-4 right" href="#">MIT License</a-->
        </div>
      </div>
    </footer>
    <div id="perfil" class="modal modal-fixed-footer">
      <div class="modal-content">
        <diw class="row">
          <div class="col s12"><h2>Perfil</h2></div>
          <div class="col s12">
            <h4>Cambiar contraseña</h4>
          </div>
          <form onsubmit="app.changePas();return false;">
            <div class="col s12 m6">
              <div class="input-field">
                      <input id="paswordant" type="password" class="validate" required>
                      <label for="pasword">Contraseña anterior</label>
                  </div>
            </div>
            <div class="col s12 m6">
              <div class="input-field">
                      <input id="paswordnue" type="password" class="validate" required>
                      <label for="pasword">Contraseña anterior</label>
                  </div>
            </div>
            <div class="col s12">
              <button class="btn btn-block green waves-effect" type="submit" id="savePasBT">Guardar</button>
            </div>
          </form>
        </diw>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cerrar</a>
      </div>
    </div>
    <!--  Scripts-->
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/materialize.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/script.js"></script>
    <script>
      $(document).ready(function() {
        app.loadEl('noResolve','noResolve');
      });
    </script>
  </body>

<!-- Ceracom 2019 -->
</html>