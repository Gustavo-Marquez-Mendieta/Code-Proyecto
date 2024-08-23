<!DOCTYPE html>
<html lang="es">

<head>
    <title>Configuración de mi Cuenta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link href="<?php echo base_url(); ?>assets/css/cambios.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">

    <style>
        /* Estilos adicionales */
        .dashboard-sideBar {
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
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
        }

        .dashboard-sideBar a:hover {
            background-color: #555;
        }

        .dashboard-sideBar img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .dashboard-contentPage {
            margin-left: 250px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .titulo {
            font-size: 60px;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 30px;
            background-image: linear-gradient(45deg, #FF6B6B, #87CEEB);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body>
    <!-- SideBar -->
    <section class="full-box cover dashboard-sideBar">
        <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
            EL DETALLE <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
        </div>
        <div class="full-box dashboard-sideBar-UserInfo">
            <figure class="full-box">
                <img src="../../assets/img/StudetMaleAvatar.png" alt="UserIcon">
                <figcaption class="text-center text-titles">
                    <?php if (isset($nombre)) : ?>
                        <h3> <?= $nombre; ?></h3>
                    <?php endif; ?>
                </figcaption>
            </figure>
            <ul class="full-box list-unstyled text-center">
                <li>
                    <a href="<?php echo site_url('Welcome/admin'); ?>" title="Inicio" class="btn-user">
                        <img src="../../assets/img/hogar.png">
                    </a>
                </li>
                <li>
                    <a href="#" title="Mi Información" class="btn-user">
                        <img src="../../assets/img/avatar (1).png">
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/configuracion'); ?>" title="Configuración">
                        <img src="../../assets/img/configuracion-de-usuario.png">
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Salir del sistema" class="btn-exit-system">
                        <img src="../../assets/img/cerrar-sesion.png">
                    </a>
                </li>
            </ul>
        </div>
        <ul class="list-unstyled full-box dashboard-sideBar-Menu">
            <li>
                <a href="<?php echo site_url('Welcome/vajilla'); ?>">
                    <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('Welcome/manteleria'); ?>">
                    <img src="../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería y Decoración
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('Welcome/bebidas'); ?>">
                    <img src="../../assets/img/vino.png" alt="Bebidas"> Bebidas
                </a>
            </li>
        </ul>
    </section>

    <!-- Content page -->
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"CONFIGURACIÓN DE MI CUENTA"</h1>
                </div>
                <div class="col-md-6">
                    <h2>Mi Cuenta</h2>

                    <form action="<?php echo site_url('Welcome/actualizarCuenta'); ?>" method="post">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo set_value('nombre', $usuario->nombre); ?>" required><br>
                        <label>Primer Apellido:</label>
                        <input type="text" name="primerApellido" value="<?php echo set_value('primerApellido', $usuario->primerApellido); ?>" required><br>
                        <label>Segundo Apellido:</label>
                        <input type="text" name="segundoApellido" value="<?php echo set_value('segundoApellido', $usuario->segundoApellido); ?>" required><br>
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="nombre_usuario" value="<?php echo set_value('nombre_usuario', $usuario->nombre_usuario); ?>" required><br>
                        <label>Teléfono:</label>
                        <input type="number" name="telefono" value="<?php echo set_value('telefono', $usuario->telefono); ?>" required><br>
                        <label>Dirección:</label>
                        <input type="text" name="direccion" value="<?php echo set_value('direccion', $usuario->direccion); ?>" required><br>
                        <label>Contraseña Actual:</label>
                        <input type="password" name="contrasena_actual" required><br>

                        <label>Nueva Contraseña:</label>
                        <input type="password" name="nueva_contrasena" required><br>

                        <input type="submit" value="Actualizar">
                    </form>

                </div>
            </div>
            <div class="col-md-6">
                <br>
            </div>
        </div>
        </div>
    </section>

    <!-- Scripts -->
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