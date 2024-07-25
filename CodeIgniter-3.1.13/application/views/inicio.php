<!DOCTYPE html>
<html lang="es">

<head>
  <title>Inicio</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <style>
    /* Estilos adicionales que puedas necesitar */
    .dashboard-sideBar {
      /* Estilos de la barra lateral */
      left: 0;
      z-index: 2;
      background-image: url('../../assets/img/copa.jpg');
      background-color: #333;
      color: white;
      width: 250px;
      position: fixed;
      height: 100%;
      overflow-y: auto;
    }

    .dashboard-sideBar a {
      /* Estilos de los enlaces en la barra lateral */
      display: block;
      padding: 10px 20px;
      color: white;
      text-decoration: none;
    }

    .dashboard-sideBar a:hover {
      /* Estilos para el estado hover de los enlaces */
      background-color: #555;
    }

    .dashboard-sideBar .btn-sideBar-SubMenu {
      /* Estilos para los enlaces del submenú */
      padding-left: 30px;
      position: relative;
    }

    .dashboard-sideBar .btn-sideBar-SubMenu::after {
      /* Estilos para la flecha del submenú */
      content: "\f0d7";
      font-family: "Material Icons";
      position: absolute;
      right: 20px;
    }

    .dashboard-contentPage {
      /* Estilos para el contenido principal */
      margin-left: 250px;
      padding: 20px;
    }

    /* Estilos para las imágenes en los enlaces */
    .dashboard-sideBar img {
      width: 24px;
      /* Ajusta el tamaño según tus necesidades */
      height: 24px;
      margin-right: 10px;
      /* Espacio entre la imagen y el texto */
      vertical-align: middle;
      /* Alineación vertical */
    }

    .frase {
      font-size: 40px;
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
      margin-left: 30px;
      /* Ajusta este valor según sea necesario */
      background-image: linear-gradient(45deg, #FF6B6B, #87CEEB);
      /* Degradado de coral a celeste */
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
  </style>
</head>

<body>
  <!-- SideBar -->
  <section class="full-box cover dashboard-sideBar">
    <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
    <div class="full-box dashboard-sideBar-ct">
      <!--SideBar Title -->
      <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
        EL DETALLE <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
      </div>
      <!-- SideBar User info -->
      <div class="full-box dashboard-sideBar-UserInfo">
        <figure class="full-box">
          <img src="./assets/avatars/AdminMaleAvatar.png" alt="UserIcon"> <!-- Imagen de avatar -->

          <figcaption class="text-center text-titles">
            <?php if (isset($nombre)) : ?>
              <h3>Bienvenido, <?= $nombre; ?></h3>
            <?php endif; ?>
          </figcaption>
        </figure>

        <ul class="full-box list-unstyled text-center">
          <li>
            <a href="<?php echo site_url('Welcome/validarusuariobd'); ?>" title="Mis Cursos" class="btn-user">
              <i class="zmdi zmdi-home"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('Welcome/validarusuariobd'); ?>" title="Mis Cursos" class="btn-user">
              <i class="zmdi zmdi-account-circle"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('Welcome/validarusuariobd'); ?>" title="Mi cuenta">
              <i class="zmdi zmdi-settings"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Salir del sistema" class="btn-exit-system">
              <i class="zmdi zmdi-power"></i>
            </a>
          </li>
        </ul>
      </div>
      <!-- SideBar Menu -->
      <ul class="list-unstyled full-box dashboard-sideBar-Menu">
        <li>
          <a href="basico.php">
            <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
          </a>
        </li>
        <li>
          <a href="intermedio.php">
            <img src="../../assets/img/mesa-de-comedor.png" alt="Mantelería y Decoración"> Mantelería y Decoración
          </a>
        </li>
        <li>
          <a href="avanzado.php">
            <img src="../../assets/img/bebida-fria.png" alt="Bebidas"> Bebidas
          </a>
        </li>
      </ul>
    </div>
  </section>

  <!-- Content page-->
  <section class="full-box dashboard-contentPage" id="inicio">
    <!-- Content page -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <br>
          <br>
          <br>
          <h1 class="text-titles" style="color: white;">Cursos <small>Gratuitos</small></h1>
        </div>
        <div class="col-md-6">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </div>
        <div class="col-md-6">

        </div>

      </div>
    </div>
  </section>

  <!--====== Scripts -->
  <script src="./js/jquery-3.1.1.min.js"></script>
  <script src="./js/sweetalert2.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/material.min.js"></script>
  <script src="./js/ripples.min.js"></script>
  <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="./js/main.js"></script>
  <script>
    $.material.init();
  </script>
</body>

</html>