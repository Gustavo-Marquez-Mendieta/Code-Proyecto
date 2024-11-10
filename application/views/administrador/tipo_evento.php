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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                        <img src="../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminBebidas'); ?>">
                        <img src="../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>">
                        <img src="../../assets/image/solicitudes.png" alt="Bebidas"> Solicitudes
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/empleados'); ?>">
                        <img src="../../assets/image/empleado.png" alt="Bebidas"> Empleados
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
                    <h1 class="titulo">Reportes</h1>
                    <h1 class="titulo">Reporte por Tipo de Evento</h1>
                    <select name="reportes" id="reportes" style="margin-top: 10px;" onchange="location = this.value;">
                        <option value="">Seleccione un reporte</option>
                        <option value="<?php echo site_url('Welcome/reportes'); ?>">Reporte por fecha</option>
                        <option value="<?php echo site_url('Welcome/tipo_evento'); ?>">Reporte por tipo de evento
                        </option>
                        <option value="<?php echo site_url('Welcome/reporte_empleado'); ?>">Reporte de empleados
                        </option>
                        <option value="<?php echo site_url('Welcome/reporte_barras'); ?>">Reporte en barras</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <form action="<?php echo site_url('Welcome/reporte_evento'); ?>" method="post">
                        <div class="form-group">
                            <label for="evento">Seleccione un tipo de evento:</label>
                            <select id="evento" name="evento" class="form-control" required>
                                <option value="">Selecciona un evento</option>
                                <option value="Matrimonio" <?= isset($evento_seleccionado) && $evento_seleccionado == 'Matrimonio' ? 'selected' : ''; ?>>Matrimonio</option>
                                <option value="Bautizo" <?= isset($evento_seleccionado) && $evento_seleccionado == 'Bautizo' ? 'selected' : ''; ?>>Bautizo</option>
                                <option value="Cumpleaños" <?= isset($evento_seleccionado) && $evento_seleccionado == 'Cumpleaños' ? 'selected' : ''; ?>>Cumpleaños</option>
                                <option value="15 Años" <?= isset($evento_seleccionado) && $evento_seleccionado == '15 Años' ? 'selected' : ''; ?>>15 Años</option>
                                <option value="Fiesta de Santito" <?= isset($evento_seleccionado) && $evento_seleccionado == 'Fiesta de Santito' ? 'selected' : ''; ?>>Fiesta de Santito
                                </option>
                                <option value="Otro" <?= isset($evento_seleccionado) && $evento_seleccionado == 'Otro' ? 'selected' : ''; ?>>Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de inicio:</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required
                                value="<?php echo isset($fecha_inicio) ? $fecha_inicio : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de fin:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required
                                value="<?php echo isset($fecha_fin) ? $fecha_fin : ''; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" style="color:white">Generar Reporte</button>
                    </form>
                </div>
                <div class="col-md-9">
                    <?php if (isset($eventos) && !empty($eventos)): ?>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" style="color:white" onclick="exportarPDF()">
                                    <i class="fas fa-file-pdf"></i> Exportar a PDF
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Tipo de Evento</th>
                                            <th>Fecha de Reserva</th>
                                            <th>Días</th>
                                            <th>Monto Total</th>
                                            <th>Estado de Pago</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($eventos) && !empty($eventos)): ?>
                                            <?php foreach ($eventos as $evento): ?>
                                                <tr>
                                                    <td><?php echo $evento->cliente_nombre . ' ' . $evento->cliente_primerApellido . ' ' . $evento->cliente_segundoApellido; ?>
                                                    </td>
                                                    <td><?php echo $evento->tipo_evento; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($evento->fecha_reserva)); ?></td>
                                                    <td><?php echo $evento->dias; ?></td>
                                                    <td><?php echo number_format($evento->monto_total, 2); ?> Bs.</td>
                                                    <td><?php echo $evento->estado_pago; ?></td>
                                                    <td>
                                                        <?php if (isset($evento->reserva_id)): ?>
                                                            <button type="button" class="btn-details"
                                                                onclick="cargarDetallesReserva(<?php echo $evento->reserva_id; ?>)">
                                                                Ver Detalles
                                                            </button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No se encontraron reservas para el tipo de
                                                    evento y rango de fechas seleccionado.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php elseif (isset($eventos)): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <p>No se encontraron eventos del tipo seleccionado en el rango de fechas especificado.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </section>
    <div class="modal fade" id="detallesReservaModal" tabindex="-1" aria-labelledby="detallesReservaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallesReservaModalLabel">Detalles de la Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- Contenedor para las dos columnas -->
                        <div class="row">
                            <!-- Columna Izquierda: Información Principal -->
                            <div class="col-md-6">
                                <div class="info-section">
                                    <h6 class="section-subtitle">Información Principal</h6>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Cliente</th>
                                            <td id="modal-cliente"></td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de Reserva</th>
                                            <td id="modal-fecha-reserva"></td>
                                        </tr>
                                        <tr>
                                            <th>Tipo de Evento</th>
                                            <td id="modal-tipo-evento"></td>
                                        </tr>
                                        <tr>
                                            <th>Días</th>
                                            <td id="modal-dias"></td>
                                        </tr>
                                        <tr>
                                            <th>Monto Total</th>
                                            <td id="modal-monto-total"></td>
                                        </tr>
                                        <tr>
                                            <th>Estado de Pago</th>
                                            <td id="modal-estado-pago"></td>
                                        </tr>
                                        <tr>
                                            <th>Garzones</th>
                                            <td id="modal-garzones"></td>
                                        </tr>
                                        <tr>
                                            <th>Detalle del Evento</th>
                                            <td id="modal-detalle-evento"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Columna Derecha: Información de Gestión -->
                            <div class="col-md-6">
                                <div class="info-section">
                                    <h6 class="section-subtitle">Información de Gestión</h6>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Aprobado por</th>
                                            <td id="modal-aprobado-por"></td>
                                        </tr>
                                        <tr>
                                            <th>Entregado por</th>
                                            <td id="modal-entregado-por"></td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de Entrega</th>
                                            <td id="modal-fecha-entrega"></td>
                                        </tr>
                                        <tr>
                                            <th>Recogido por</th>
                                            <td id="modal-recogido-por"></td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de Recogida</th>
                                            <td id="modal-fecha-recogida"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de Detalles de Vajilla -->
                        <div class="details-section">
                            <h3 class="section-title">Detalles de Vajilla</h3>
                            <div id="vajilla-details">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Vajilla</th>
                                            <th>Cantidad</th>
                                            <th>Precio por Caja</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="vajilla-items">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Sección de Detalles de Mantelería -->
                        <div class="details-section">
                            <h3 class="section-title">Detalles de Mantelería</h3>
                            <div id="manteleria-details">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mantelería</th>
                                            <th>Cantidad</th>
                                            <th>Precio Mesa + 10 sillas</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="manteleria-items">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Al final del body, antes del cierre -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Después tus scripts locales -->
    <script src="<?php echo base_url(); ?>assets/js/material.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ripples.min.js"></script>
    <style>
        .modal-body .row {
            margin-bottom: 2rem;
        }

        .info-section {
            height: 100%;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .info-section {
                margin-bottom: 1.5rem;
            }

            .col-md-6:last-child .info-section {
                margin-bottom: 0;
            }
        }

        /* Ajustar el ancho del modal para que quepa mejor el contenido en dos columnas */
        .modal-dialog {
            max-width: 1000px !important;
        }

        /* Asegurar que las tablas en las columnas tengan el mismo alto */
        .info-section table {
            height: 100%;
        }

        /* Ajustar el espaciado en dispositivos móviles */
        @media (max-width: 768px) {
            .modal-body {
                padding: 1rem;
            }

            .info-section {
                padding: 1rem;
            }

            .col-md-6 {
                padding: 0 0.5rem;
            }
        }

        .modal {
            display: none;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 1050 !important;
            overflow-x: hidden;
            overflow-y: auto;
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .modal.show {
            display: block !important;
            opacity: 1 !important;
        }

        /* Asegurar que SweetAlert2 aparezca encima del modal */
        .swal2-container {
            z-index: 2000 !important;
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 0.5rem;
            pointer-events: all;
            transform: none !important;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }
        }

        .modal-content {
            background: white !important;
            position: relative !important;
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            pointer-events: auto !important;
            outline: 0 !important;
        }

        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(45deg, #1e88e5, #1976d2);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .modal-header .btn-close {
            background-color: white;
            opacity: 0.8;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .modal-body table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .modal-body th {
            background-color: #f0f7ff;
            color: #2c3e50;
            font-weight: 600;
            padding: 12px 15px;
        }

        .modal-body td {
            padding: 12px 15px;
            color: #34495e;
        }

        /* Estilos para las secciones de detalles */
        .modal-body h3 {
            color: #1976d2;
            font-size: 1.3rem;
            margin: 1.5rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e3f2fd;
        }

        /* Estilos para la tabla de información principal */
        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border-color: #e9ecef;
        }

        /* Estilos para las tablas de vajilla y mantelería */
        #vajilla-details,
        #manteleria-details {
            margin-top: 2rem;
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Colores para estados específicos */
        td[id="modal-estado-pago"] {
            font-weight: 600;
        }

        td[id="modal-monto-total"] {
            color: #2196f3;
            font-weight: 600;
        }

        /* Estilo para mensajes de "No disponible" */
        td:contains("No disponible"),
        td:contains("No se adquirió") {
            color: #9e9e9e;
            font-style: italic;
        }

        /* Estilos para el botón de cerrar */
        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 1rem;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
        }

        /* Efecto de hover en las filas de las tablas */
        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        /* Estilo para encabezados de secciones */
        .section-title {
            color: #ff5252;
            background-color: #fff3f3;
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .modal-body {
                padding: 1rem;
            }

            .table th,
            .table td {
                padding: 8px;
            }

            .modal-title {
                font-size: 1.2rem;
            }
        }

        /* Animación al abrir el modal */
        .modal.fade .modal-dialog {
            transform: scale(0.8);
            transition: transform 0.3s ease-in-out;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }

        /* Estilos para las celdas de totales */
        td:last-child {
            font-weight: 600;
            color: #1976d2;
        }

        /* Estilo para la información resaltada */
        .highlight-info {
            background-color: #e3f2fd;
            border-radius: 4px;
            padding: 2px 6px;
        }

        .section-subtitle {
            color: #1976d2;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e3f2fd;
        }

        .info-section {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .info-section table th {
            width: 30%;
            background-color: #f8f9fa;
        }

        /* Estilo para la información de gestión */
        #modal-aprobado-por,
        #modal-entregado-por,
        #modal-recogido-por {
            font-weight: 500;
            color: #2196f3;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .info-section {
                padding: 1rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }
        }
    </style>
    <script>
        function exportarPDF() {
            const tipoEvento = document.getElementById('evento').value;
            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;

            if (!tipoEvento || !fechaInicio || !fechaFin) {
                Swal.fire({
                    title: 'Error',
                    text: 'Por favor, primero genere un reporte seleccionando el tipo de evento y las fechas',
                    icon: 'error',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            // Mostrar loading
            Swal.fire({
                title: 'Generando PDF',
                text: 'Por favor espere...',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Crear y enviar formulario
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= site_url('Welcome/exportar_reporte_evento'); ?>';

            // Agregar campos
            const eventoInput = document.createElement('input');
            eventoInput.type = 'hidden';
            eventoInput.name = 'evento';
            eventoInput.value = tipoEvento;
            form.appendChild(eventoInput);

            const fechaInicioInput = document.createElement('input');
            fechaInicioInput.type = 'hidden';
            fechaInicioInput.name = 'fecha_inicio';
            fechaInicioInput.value = fechaInicio;
            form.appendChild(fechaInicioInput);

            const fechaFinInput = document.createElement('input');
            fechaFinInput.type = 'hidden';
            fechaFinInput.name = 'fecha_fin';
            fechaFinInput.value = fechaFin;
            form.appendChild(fechaFinInput);

            // Enviar formulario
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>
    <script>
        let detallesModal;

        $(document).ready(function () {
            // Inicializar el modal
            detallesModal = new bootstrap.Modal(document.getElementById('detallesReservaModal'), {
                keyboard: true,
                backdrop: 'static'
            });

            // Limpiar backdrops residuales
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');

            // Manejar el cierre del modal
            $('#detallesReservaModal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                // No limpiar el contenido aquí para mantener los datos
            });

            // Manejar el botón de cerrar
            $('.btn-close, .btn-secondary').on('click', function () {
                detallesModal.hide();
            });
        });

        function cargarDetallesReserva(reservaId) {
            console.log('Cargando detalles para reserva:', reservaId);

            // Limpiar contenido previo
            $('#vajilla-items').empty();
            $('#manteleria-items').empty();

            // Mostrar el modal
            if (detallesModal) {
                detallesModal.show();
            } else {
                console.error('Modal no inicializado');
                return;
            }

            // Realizar la petición AJAX
            $.ajax({
                url: '<?php echo site_url('Welcome/obtener_detalles_reserva/'); ?>' + reservaId,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log('Respuesta recibida:', response);

                    if (response.reserva) {
                        // Llenar información principal
                        $('#modal-cliente').text(
                            response.reserva.cliente_nombre + ' ' +
                            response.reserva.cliente_primerApellido + ' ' +
                            response.reserva.cliente_segundoApellido
                        );
                        $('#modal-fecha-reserva').text(response.reserva.fecha_reserva || 'No disponible');
                        $('#modal-tipo-evento').text(response.reserva.tipo_evento || 'No disponible');
                        $('#modal-dias').text(response.reserva.dias || 'No disponible');
                        $('#modal-monto-total').text((response.reserva.monto_total || 0) + ' Bs.');
                        $('#modal-estado-pago').text(response.reserva.estado_pago || 'No disponible');
                        $('#modal-garzones').text(response.reserva.garzones || 'No disponible');
                        $('#modal-detalle-evento').text(response.reserva.detalle_evento || 'No disponible');

                        // Llenar información de gestión
                        $('#modal-aprobado-por').text(
                            (response.reserva.aprobado_nombre ?
                                response.reserva.aprobado_nombre + ' ' +
                                response.reserva.aprobado_primerApellido + ' ' +
                                response.reserva.aprobado_segundoApellido : 'No asignado')
                        );

                        $('#modal-entregado-por').text(
                            (response.reserva.entregado_nombre ?
                                response.reserva.entregado_nombre + ' ' +
                                response.reserva.entregado_primerApellido + ' ' +
                                response.reserva.entregado_segundoApellido : 'No asignado')
                        );

                        $('#modal-recogido-por').text(
                            (response.reserva.recogido_nombre ?
                                response.reserva.recogido_nombre + ' ' +
                                response.reserva.recogido_primerApellido + ' ' +
                                response.reserva.recogido_segundoApellido : 'No asignado')
                        );

                        $('#modal-fecha-entrega').text(response.reserva.fecha_entrega_vajilla || 'No establecida');
                        $('#modal-fecha-recogida').text(response.reserva.fecha_recogida_vajilla || 'No establecida');

                        // Procesar detalles de vajilla y mantelería
                        if (response.detalles) {
                            let hayVajilla = false;
                            let hayManteleria = false;

                            response.detalles.forEach(function (detalle) {
                                if (detalle.vajilla_id) {
                                    hayVajilla = true;
                                    $('#vajilla-items').append(`
                                <tr>
                                    <td>${detalle.nombre_vajilla || ''}</td>
                                    <td>${detalle.cantidad}</td>
                                    <td>${detalle.precio} Bs.</td>
                                    <td>${(detalle.cantidad * detalle.precio).toFixed(2)} Bs.</td>
                                </tr>
                            `);
                                } else if (detalle.manteleria_id) {
                                    hayManteleria = true;
                                    $('#manteleria-items').append(`
                                <tr>
                                    <td>${detalle.nombre_manteleria || ''}</td>
                                    <td>${detalle.cantidad}</td>
                                    <td>${detalle.precio} Bs.</td>
                                    <td>${(detalle.cantidad * detalle.precio).toFixed(2)} Bs.</td>
                                </tr>
                            `);
                                }
                            });

                            if (!hayVajilla) {
                                $('#vajilla-items').html('<tr><td colspan="4">No se adquirió vajilla.</td></tr>');
                            }
                            if (!hayManteleria) {
                                $('#manteleria-items').html('<tr><td colspan="4">No se adquirió mantelería.</td></tr>');
                            }
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la petición AJAX:', error);
                    console.error('Estado:', status);
                    console.error('Respuesta:', xhr.responseText);
                    alert('Error al cargar los detalles de la reserva');
                }
            });
        }
    </script>
</body>

</html>