<?php @session_start();
if (isset($_SESSION['idu'])) {
  include_once '../Controller/determinateRuta.php';
  $rol=getRol($_SESSION['idu']);
  if ($rol!=2) {
    switch ($rol) {
      case 1:
        header('location: administrador.php');
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
    <title>Agente - Ceracom</title>
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
              <li><a href="#"><i class="fas fa-user tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil del Agente"></i></a></li>
              <li><a href="#"><i class="fas fa-plus tooltipped" data-position="bottom" data-delay="50" data-tooltip="Otras opciones"></i></a></li>
              <li><a href="#" onclick="app.salir();"><i class="fas fa-power-off tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cerrar sesión"></i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
              <li><a href="#"><i class="fas fa-user"></i> Perfil del Agente</a></li>
              <li><a href="#"><i class="fas fa-power-off"></i> Opciones </a></li>
              <li><a href="#" onclick="app.salir();"><i class="fas fa-plus"></i> Cerrar Sesión</a></li>
            </ul>
          </div>
          <div class="nav-content">
            <ul class="tabs tabs-transparent">
              <li class="tab"><a class="active" href="#test1"><i class="fas fa-chart-line"></i><sapan class="hide-on-small-menu"> Estadísticas</sapan></a></li>
              <li class="tab"><a href="#test2"><i class="fas fa-wrench"></i><sapan class="hide-on-small-menu"> Trabajo</sapan></a></li>
              <li class="tab"><a href="#test3"><i class="far fa-clock"></i><sapan class="hide-on-small-menu"> Sin Resolver</sapan></a></li>
              <li class="tab"><a href="#test4"><i class="far fa-check-circle"></i><sapan class="hide-on-small-menu"> Resuelto</sapan></a></li>
              <li class="tab"><a href="#test5"><i class="fas fa-arrow-circle-down"></i><sapan class="hide-on-small-menu"> No Asignado</sapan></a></li>
              <li class="tab"><a href="#test6"><i class="fas fa-bell"></i><sapan class="hide-on-small-menu"> Solicitudes</sapan></a></li>
              <li class="tab"><a href="#test7"><i class="fas fa-book"></i><sapan class="hide-on-small-menu"> Base de Conocimiento</sapan></a></li>
              <li class="tab"><a href="#test8"><i class="fas fa-chart-pie"></i><sapan class="hide-on-small-menu"> Reportes</sapan></a></li>

            </ul>
          </div>
        </nav>
      </div>
    </header>
    <main>
      <div class="contenedor">
        <div class="row">
          <div id="test1" class="col s12">
            <div class="row">
                <!-- Line Chart -->
                <div class="col s12 m6">
                    <div class="card">
                        <div class="header">
                            <h5>LINE CHART</h5>
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
                <!-- Bar Chart -->
                <div class="col s12 m6">
                    <div class="card">
                        <div class="header">
                            <h5>BAR CHART</h5>
                        </div>
                        <div class="body">
                            <canvas id="bar_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>
          </div>
          <div id="test2" class="col s12">Test 2</div>
          <div id="test3" class="col s12">Test 3</div>
          <div id="test4" class="col s12">Test 4</div>
          <div id="test5" class="col s12">Test 5</div>
          <div id="test6" class="col s12">Test 6</div>
          <div id="test7" class="col s12">Test 7</div>
          <div id="test8" class="col s12">Test 8</div>
        </div>
      </div>
    </main>    
    <footer class="page-footer blue darken-4">
      <div class="footer-copyright">
        <div class="container">
        © 2019 Ceracom, Todos los derechos reservados.
        <!--a class="grey-text text-lighten-4 right" href="#">MIT License</a-->
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

<!-- Ceracom 2019 -->
</html>