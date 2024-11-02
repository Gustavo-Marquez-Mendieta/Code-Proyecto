<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/cambios.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/cards.css" rel="stylesheet">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dashboard-sideBar {
            left: 0;
            z-index: 2;
            background-image: url("../../assets/img/copaga.jpg");
            background-color: #333;
            color: white;
            width: 250px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <!-- SideBar -->
    <section class="full-box cover dashboard-sideBar">
        <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
        <div class="full-box dashboard-sideBar-ct">
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                EL DETALLE <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <div class="full-box dashboard-sideBar-UserInfo">
                <figure class="full-box">
                    <img src="../../assets/img/StudetMaleAvatar.png" alt="UserIcon">
                    <figcaption class="text-center text-titles">
                        <li class="user-info">
                            <h6>Bienvenido</h6>
                            <span class="user-name" style="font-size:20px"> <?= $nombre; ?></span>
                        </li>
                    </figcaption>
                </figure>

                <ul class="full-box list-unstyled text-center">
                    <li>
                        <a href="<?php echo site_url('Welcome/user'); ?>" title="Inicio" class="btn-user">
                            <img src="../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/mis_reservas'); ?>" title="Mi Informacion" class="btn-user">
                            <img src="../../assets/img/avatar (1).png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/configuracion'); ?>" title="Configuracion">
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
                    <a href="<?php echo site_url('Welcome/vajilla'); ?>">
                        <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/manteleria'); ?>">
                        <img src="../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/bebidas'); ?>">
                        <img src="../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/carrito'); ?>">
                        <img src="../../assets/img/carrito-de-compras.png" alt="Carrito"> Servicios a adquirir
                    </a>
                </li>
            </ul>

            <!-- Sección de redes sociales con texto arriba e íconos más juntos -->
            <div style="text-align: center; margin-top: 50px;">
                <h5 style="margin-bottom: 15px;">Síguenos en nuestras redes sociales</h5>
                <ul class="list-unstyled" style="display: flex; justify-content: center; gap: 10px;">
                    <li>
                        <a href="https://www.facebook.com/people/El-Detalle-Eventos/100063608673458/?mibextid=ZbWKwL"
                            target="_blank" title="Facebook">
                            <i class="fab fa-facebook" style="font-size: 24px; color: #1877f2;"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/@detalle_eventos?is_from_webapp=1&sender_device=pc"
                            target="_blank" title="TikTok">
                            <i class="fab fa-tiktok" style="font-size: 24px; color: #000000;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <h1 class="titulo">Mis Eventos</h1>
                </div>

                <!-- Sección de Reservas del Usuario -->
                <div class="col-md-9">
                    <?php if (!empty($reservas)): ?>
                        <h3>Reservas Realizadas:</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha de Reserva</th>
                                    <th>Tipo de Evento</th>
                                    <th>Días</th>
                                    <th>Monto Total</th>
                                    <th>Estado de Pago</th>
                                    <th>Garzones</th>
                                    <th>Detalle del Evento</th>
                                    <th>Detalles</th> <!-- Nueva columna para el botón -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservas as $reserva): ?>
                                    <tr>
                                        <td><?= $reserva->fecha_reserva; ?></td>
                                        <td><?= $reserva->tipo_evento; ?></td>
                                        <td><?= $reserva->dias; ?></td>
                                        <td>$<?= number_format($reserva->monto_total, 2); ?></td>
                                        <td><?= $reserva->estado_pago; ?></td>
                                        <td><?= $reserva->garzones; ?></td>
                                        <td><?= $reserva->detalle_evento; ?></td>
                                        <td>
                                            <a href="<?= site_url('welcome/detalle_evento/' . $reserva->reserva_id); ?>"
                                                class="btn btn-info">
                                                Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No se han encontrado reservas.</p>
                    <?php endif; ?>
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