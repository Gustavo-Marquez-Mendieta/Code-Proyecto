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
            background-image: url("../../../assets/img/copaga.jpg");
            background-color: #333;
            color: white;
            width: 250px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        body {
            background-image: url('path/to/your/background-image.jpg');
            background-size: cover;
            background-position: center;
        }

        #inicio {
            color: white;
            padding: 2rem;
        }

        .titulo {
            font-size: 2.5rem;
            color: #f06464;
            /* Make the title color stand out */
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .table-bordered {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.6);
            /* Semi-transparent background */
            color: #fff;
            /* White text for better contrast */
            border-radius: 10px;
            overflow: hidden;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* Light border */
            text-align: left;
        }

        .table-bordered th {
            font-weight: bold;
            width: 40%;
            color: #ddd;
        }
    </style>
</head>

<body>
    <section class="full-box cover dashboard-sideBar">
        <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
        <div class="full-box dashboard-sideBar-ct">
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                EL DETALLE <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <div class="full-box dashboard-sideBar-UserInfo">
                <figure class="full-box">
                    <img src="../../../assets/img/StudetMaleAvatar.png" alt="UserIcon">
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
                            <img src="../../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/mis_reservas'); ?>" title="Mi Informacion" class="btn-user">
                            <img src="../../../assets/img/avatar (1).png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/configuracion'); ?>" title="Configuracion">
                            <img src="../../../assets/img/configuracion-de-usuario.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Salir del sistema"
                            class="btn-exit-system">
                            <img src="../../../assets/img/cerrar-sesion.png">
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SideBar Menu -->
            <ul class="list-unstyled full-box dashboard-sideBar-Menu">
                <li>
                    <a href="<?php echo site_url('Welcome/vajilla'); ?>">
                        <img src="../../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/manteleria'); ?>">
                        <img src="../../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/bebidas'); ?>">
                        <img src="../../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/carrito'); ?>">
                        <img src="../../../assets/img/carrito-de-compras.png" alt="Carrito"> Servicios a adquirir
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
                    <h1 class="titulo">Detalle del Evento</h1>
                </div>
                <div class="col-md-9">
                    <?php if ($reserva): ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha de Reserva</th>
                                <td><?= $reserva->fecha_reserva; ?></td>
                            </tr>
                            <tr>
                                <th>Tipo de Evento</th>
                                <td><?= $reserva->tipo_evento; ?></td>
                            </tr>
                            <tr>
                                <th>Días</th>
                                <td><?= $reserva->dias; ?></td>
                            </tr>
                            <tr>
                                <th>Monto Total</th>
                                <td>$<?= number_format($reserva->monto_total, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Estado de Pago</th>
                                <td><?= $reserva->estado_pago; ?></td>
                            </tr>
                            <tr>
                                <th>Garzones</th>
                                <td><?= $reserva->garzones; ?></td>
                            </tr>
                            <tr>
                                <th>Detalle del Evento</th>
                                <td><?= $reserva->detalle_evento; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de Entrega de Vajilla</th>
                                <td><?= $reserva->fecha_entrega_vajilla ?? 'No disponible'; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de Recogida de Vajilla</th>
                                <td><?= $reserva->fecha_recogida_vajilla ?? 'No disponible'; ?></td>
                            </tr>
                        </table>

                        <!-- Sección de Detalles de Vajilla -->
                        <h3 style="text-align: center;">Detalles de Vajilla</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vajilla</th>
                                    <th>Cantidad</th>
                                    <th>Precio por Caja</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $hay_vajilla = false; ?>
                                <?php foreach ($detalles as $detalle): ?>
                                    <?php if ($detalle->nombre_vajilla): ?>
                                        <?php $hay_vajilla = true; ?>
                                        <tr>
                                            <td><?= $detalle->nombre_vajilla; ?></td>
                                            <td><?= $detalle->cantidad; ?></td>
                                            <td><?= round($detalle->precio, 2); ?>Bs.</td>
                                            <td><?= round($detalle->cantidad * $detalle->precio, 2); ?>Bs</td>
                                            <!-- Calculo del total -->
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$hay_vajilla): ?>
                                    <tr>
                                        <td colspan="4">No se adquirió vajilla.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <h3 style="text-align: center;">Detalles de Mantelería</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mantelería</th>
                                    <th>Cantidad</th>
                                    <th>Precio Mesa + 10 sillas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $hay_manteleria = false; ?>
                                <?php foreach ($detalles as $detalle): ?>
                                    <?php if ($detalle->nombre_manteleria): ?>
                                        <?php $hay_manteleria = true; ?>
                                        <tr>
                                            <td><?= $detalle->nombre_manteleria; ?></td>
                                            <td><?= $detalle->cantidad; ?></td>
                                            <td><?= round($detalle->precio, 2); ?>Bs.</td>
                                            <td><?= round($detalle->cantidad * $detalle->precio, 2); ?>Bs</td>
                                            <!-- Calculo del total -->
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$hay_manteleria): ?>
                                    <tr>
                                        <td colspan="4">No se adquirió mantelería.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p>Detalles no disponibles para esta reserva.</p>
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