<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link href="<?php echo base_url(); ?>assets/css/cambios.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/tabla.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">

    <style>
        /* Estilos adicionales que puedas necesitar */
        .dashboard-sideBar {
            /* Estilos de la barra lateral */
            left: 0;
            z-index: 2;
            background-image: url('<?php echo base_url(); ?>assets/img/copa.jpg');
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
            position: relative;
            /* Añadido */
            z-index: 1;
            /* Añadido */
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
            margin-top: 20px;
            margin-left: 30px;
            /* Ajusta este valor según sea necesario */
            background-image: linear-gradient(45deg, #FF6B6B, #87CEEB);
            /* Degradado de coral a celeste */
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .titulo {
            font-size: 60px;
            font-weight: bold;
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
            <!-- SideBar Title -->
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                ADMINISTRADOR <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <!-- SideBar User info -->
            <div class="full-box dashboard-sideBar-UserInfo">
                <figure class="full-box">
                    <img src="<?php echo base_url(); ?>assets/img/StudetMaleAvatar.png" alt="UserIcon">
                    <figcaption class="text-center text-titles">
                        <?php if (isset($nombre)): ?>
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
                        <a href="<?php echo site_url('Welcome/adminUser'); ?>" title="Usuarios" class="btn-user">
                            <img src="../../assets/img/avatar (1).png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/AdminConfiguracion'); ?>" title="Configuracion">
                            <img src="../../assets/img/configuracion-de-usuario.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Salir del sistema"
                            class="btn-exit-system">
                            <img src="../../assets/img/cerrar-sesion.png">
                        </a>
                    </li>
                </ul>
            </div>
            <!-- SideBar Menu -->
            <ul class="list-unstyled full-box dashboard-sideBar-Menu">
                <li>
                    <a href="<?php echo site_url('Welcome/adminVajilla'); ?>">
                        <img src="<?php echo base_url(); ?>assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminManteleria'); ?>">
                        <img src="<?php echo base_url(); ?>assets/img/mesa.png" alt="Mantelería y Decoración">
                        Mantelería y Decoración
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminBebidas'); ?>">
                        <img src="<?php echo base_url(); ?>assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>">
                        <img src="../../assets/image/solicitudes.png" alt="Bebidas"> Solicitudes
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Content page -->
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"Detalles del"</h1>
                </div>
                <div class="col-md-6">
                    <h2 style="color:white">Detalles de la Reserva #<?= $reserva->reserva_id; ?></h2>
                    <p style="color:white"><strong>Fecha de Reserva:</strong> <?= $reserva->fecha_reserva; ?></p>
                    <p style="color:white"><strong>Tipo de Evento:</strong> <?= $reserva->tipo_evento; ?></p>
                    <p style="color:white"><strong>Días:</strong> <?= $reserva->dias; ?></p>
                    <p style="color:white"><strong>Monto Total:</strong> <?= $reserva->monto_total; ?></p>
                    <p style="color:white"><strong>Estado de Pago:</strong> <?= $reserva->estado_pago; ?></p>

                    <h3 style="color:white">Detalles</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detalles)): ?>
                                <?php foreach ($detalles as $detalle): ?>
                                    <?php
                                    // Determinar el nombre, tipo y precio según el detalle
                                    $nombre = 'Desconocido';
                                    $tipo = 'Desconocido';
                                    $precio = 0;

                                    if (!empty($detalle->vajilla_nombre)) {
                                        $nombre = $detalle->vajilla_nombre;
                                        $tipo = $detalle->vajilla_tipo;
                                        $precio = $detalle->vajilla_precio;
                                    } elseif (!empty($detalle->decoracion_plan)) {
                                        $nombre = $detalle->decoracion_plan;
                                        $tipo = $detalle->decoracion_tipo;
                                        $precio = $detalle->decoracion_precio;
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $nombre; ?></td>
                                        <td><?php echo $tipo; ?></td>
                                        <td><?php echo 'Bs. ' . number_format($precio, 2); ?></td>
                                        <td><?php echo $detalle->cantidad; ?></td>
                                        <td><?php echo 'Bs. ' . number_format($precio * $detalle->cantidad, 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No hay detalles disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>

                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>" class="btn btn-primary"
                        style="color:white">Volver a
                        Solicitudes</a>
                    <a href="<?php echo site_url('Welcome/aprobar_solicitud/' . $reserva->reserva_id); ?>"
                        class="btn btn-success" style="color:white">Aprobar Solicitud</a>

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