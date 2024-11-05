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
        .btn-danger {
            padding: 8px 20px;
            background: linear-gradient(45deg, #ff3636, #ff5555);
            color: white;
            border: 2px solid white;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
        }
        li.user-info {
            list-style-type: none;
            padding-left: 0;
        }

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
    <section class="full-box cover dashboard-sideBar">
        <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
        <div class="full-box dashboard-sideBar-ct">
            <!--SideBar Title -->
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                ADMINISTRADOR <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <!-- SideBar User info -->
            <div class="full-box dashboard-sideBar-UserInfo">
                <figure class="full-box">
                    <img src="../../assets/img/StudetMaleAvatar.png" alt="UserIcon">

                    <figcaption class="text-center text-titles">
                        <h6>Bienvenido</h6>
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
                        <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('Welcome/adminManteleria'); ?>">
                        <img src="../../assets/img/mesa.png" alt="Mantelería"> Mantelería
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminBebidas'); ?>">
                        <img src="../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>">
                        <img src="../../assets/image/solicitudes.png" alt="Solicitudes"> Solicitudes
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/empleados'); ?>">
                        <img src="../../assets/image/empleado.png" alt="Empleados"> Empleados
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/reportes'); ?>">
                        <img src="../../assets/image/reportes.png" alt="Reportes"> Reportes
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
                    <h1 class="titulo">"EL DETALLE EVENTOS"</h1>
                </div>
                <div class="col-md-6">
                    <h2 style="color:white">Solicitudes</h2>
                    <div style="margin-top: 10px; margin-right:400px">
                        <select name="solicitud_estado" id="solicitud_estado" class="form-control">
                            <option value="pendiente">Seleccione tipo de estado deseado</option>
                            <option value="pendiente">pendiente</option>
                            <option value="aprobado-esperando adelanto">aprobado-esperando adelanto</option>
                            <option value="En Curso de entrega">En Curso de entrega</option>
                            <option value="Vajilla Entregada">Vajilla Entregada</option>
                            <option value="Vajilla Recogida">Vajilla Recogida</option>
                            <option value="Evento Completado">Evento Completado</option>
                        </select>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha de Reserva</th>
                                <th>Tipo de Evento</th>
                                <th>Días</th>
                                <th>Monto Total</th>
                                <th>Estado de Pago</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_solicitudes">
                            <!-- Aquí se insertarán las filas de la tabla filtrada -->
                            <?php if (!empty($reservas)): ?>
                                <?php foreach ($reservas as $reserva): ?>
                                    <tr>
                                        <td><?= $reserva->usuario_id; ?></td>
                                        <td><?= $reserva->fecha_reserva; ?></td>
                                        <td><?= $reserva->tipo_evento; ?></td>
                                        <td><?= $reserva->dias; ?></td>
                                        <td><?= $reserva->monto_total; ?></td>
                                        <td><?= $reserva->estado_pago; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('Welcome/detalles/' . $reserva->reserva_id); ?>"
                                                class="btn btn-danger" style="color:white">Detalles</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No hay reservas disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>

    <!-- Agregamos el script para manejar el cambio en el select -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#solicitud_estado').change(function () {
                var estado = $(this).val();

                // Realizamos la petición AJAX
                $.ajax({
                    url: '<?php echo site_url("Welcome/filtrarSolicitudes"); ?>',
                    method: 'POST',
                    data: { estado: estado },
                    success: function (response) {
                        // Actualizamos la tabla con la respuesta del servidor
                        $('#tabla_solicitudes').html(response);
                    }
                });
            });
        });
    </script>

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