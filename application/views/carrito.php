<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link href="<?php echo base_url(); ?>assets/css/cambios.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/formulario.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/botoncaida.css" rel="stylesheet">
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

        .titulo {
            color: #ff6b6b;
            margin: 20px 0;
        }

        .table {
            background: rgba(255, 255, 255, 0.1);
            margin-bottom: 30px;
        }

        .table thead th {
            background: rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .table tbody td {
            color: #fff;
        }

        .mt-3 h4 {
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 5px;
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

        .btn-danger {
            padding: 8px 20px;
            background: linear-gradient(45deg, #ff3636, #ff5555);
            color: white;
            border: 2px solid white;
            /* Borde blanco para más contraste */
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            /* Sombra en el texto */
            position: relative;
            z-index: 1;
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #ff0000, #ff3636);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.8);
            transform: scale(1.05);
            border-color: #ffcccc;
            letter-spacing: 1px;
        }

        .btn-danger:active {
            transform: scale(0.95);
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.6);
        }

        /* Asegurarnos que el texto "Eliminar" sea siempre visible */
        .btn-danger span {
            position: relative;
            z-index: 2;
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
                    <img src="../../assets/img/StudetMaleAvatar.png" alt="UserIcon">
                    <figcaption class="text-center text-titles">
                        <?php if (isset($nombre)): ?>
                            <h3><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <?php endif; ?>
                    </figcaption>
                </figure>

                <ul class="full-box list-unstyled text-center">
                    <li>
                        <a href="<?php echo site_url('Welcome/user'); ?>" title="Inicio" class="btn-user">
                            <img src="../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/mis_reservas'); ?>" title="Mi Informacion"
                            class="btn-user">
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
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"EL DETALLE EVENTOS"</h1>
                    <h1 class="titulo">Servicios a Adquirir</h1>
                </div>
                <div class="col-md-6">


                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $total_carrito = 0;
                    if (!empty($carrito)):
                        // Separar items por tipo
                        $items_vajilla = array_filter($carrito, function ($item) {
                            return $item['tipo_producto'] == 'vajilla';
                        });
                        $items_manteleria = array_filter($carrito, function ($item) {
                            return $item['tipo_producto'] == 'manteleria';
                        });
                        ?>
                        <!-- Tabla de Vajilla -->
                        <?php if (!empty($items_vajilla)): ?>
                            <h3 style="color:white;">Vajilla</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad (Cajas)</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items_vajilla as $item): ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo base_url('./assets/img/' . $item['imagen']); ?>"
                                                    alt="<?php echo $item['nombre']; ?>" style="width: 100px;">
                                            </td>
                                            <td><?php echo $item['nombre']; ?></td>
                                            <td><?php echo 'Bs. ' . number_format($item['precio'], 2); ?></td>
                                            <td><?php echo $item['cantidad']; ?></td>
                                            <td><?php echo 'Bs. ' . number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                                            <td>
                                                <button type="button"
                                                    onclick="eliminarProducto(<?= $item['vajilla_id']; ?>, 'vajilla', <?= $item['cantidad']; ?>)"
                                                    class="btn btn-danger btn-sm text-white">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $total_carrito += $item['precio'] * $item['cantidad']; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>

                        <!-- Tabla de Mantelería -->
                        <?php if (!empty($items_manteleria)): ?>
                            <h3 style="color:white;">Mantelería</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items_manteleria as $item): ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo base_url('./assets/img/' . $item['imagen']); ?>"
                                                    alt="<?php echo $item['nombre']; ?>" style="width: 100px;">
                                            </td>
                                            <td><?php echo $item['nombre']; ?></td>
                                            <td><?php echo 'Bs. ' . number_format($item['precio'], 2); ?></td>
                                            <td><?php echo $item['cantidad']; ?></td>
                                            <td><?php echo 'Bs. ' . number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                                            <td>
                                                <button type="button"
                                                    onclick="eliminarProducto(<?= $item['manteleria_id']; ?>, 'manteleria', <?= $item['cantidad']; ?>)"
                                                    class="btn btn-danger btn-sm text-white">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $total_carrito += $item['precio'] * $item['cantidad']; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="mt-3">
                            <h4>Total General: Bs. <?php echo number_format($total_carrito, 2); ?></h4>
                        </div>
                        <div class="mt-3 text-center">
                            <h4 class="mb-4">Total General: Bs. <?php echo number_format($total_carrito, 2); ?></h4>
                            <button type="button" class="animated-button btn btn-proceed" data-bs-toggle="modal"
                                data-bs-target="#reservationModal" alt="Proceder Reserva" style="background: blue;">
                                <div class="button-content">
                                    <i>P</i><i>r</i><i>o</i><i>c</i><i>e</i><i>d</i><i>e</i><i>r</i><i>&nbsp;</i><i>R</i><i>e</i><i>s</i><i>e</i><i>r</i><i>v</i><i>a</i>
                                </div>
                            </button>
                        </div>
                    <?php else: ?>
                        <p style="color:white">El carrito está vacío.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </section>

    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Información para la Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reservationForm" action="<?php echo site_url('Welcome/guardar_reserva'); ?>"
                        method="post">
                        <div class="form-group">
                            <label for="fecha_reserva">Fecha de Reserva:</label>
                            <input type="date" id="fecha_reserva" name="fecha_reserva" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dias">Días:</label>
                            <input type="number" id="dias" name="dias" class="form-control" min="1" required
                                placeholder="Ingrese días del evento">
                        </div>
                        <div class="form-group">
                            <label for="evento">Evento:</label>
                            <select id="evento" name="evento" class="form-control" required>
                                <option value="">Selecciona un evento</option>
                                <option value="Matrimonio">Matrimonio</option>
                                <option value="Bautizo">Bautizo</option>
                                <option value="Cumpleaños">Cumpleaños</option>
                                <option value="15 Años">15 Años</option>
                                <option value="Fiesta de Santito">Fiesta de Santito</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detalle_evento">Descripción del evento:</label>
                            <textarea id="detalle_evento" name="detalle_evento" class="form-control" rows="4"
                                placeholder="Escribe aquí la descripción del evento"></textarea>
                        </div>
                        <div class="form-group">
                            <label>¿Desea garzones en su reserva? Costo por garzón 150 Bs.</label>
                            <div>
                                <input type="radio" id="garzones_si" name="garzones" value="si"
                                    onclick="mostrarCantidadGarzones()" required>
                                <label for="garzones_si">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="garzones_no" name="garzones" value="no"
                                    onclick="ocultarCantidadGarzones()" required>
                                <label for="garzones_no">No, solo vajilla</label>
                            </div>
                        </div>
                        <div class="form-group" id="cantidad_garzones_div" style="display: none;">
                            <label for="cantidad_garzones">Cantidad de Garzones:</label>
                            <input type="number" id="cantidad_garzones" name="cantidad_garzones" class="form-control"
                                min="1" placeholder="Ingrese la cantidad de garzones" oninput="calcularTotal()">
                        </div>
                        <p>Total del Servicio: Bs. <span
                                id="total_servicio"><?php echo number_format($total_carrito, 2); ?></span></p>
                        <input type="hidden" name="monto_total" id="monto_total" value="<?php echo $total_carrito; ?>">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmarReserva">
                        Confirmar Reserva
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Después tus scripts locales -->
    <script src="<?php echo base_url(); ?>assets/js/material.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ripples.min.js"></script>
    <style>
        /* Reset de estilos que pueden interferir */
        .swal2-container {
            z-index: 999999 !important;
        }

        .swal2-popup {
            font-size: 1rem !important;
        }

        .swal2-actions {
            z-index: 999999 !important;
        }

        /* Estilos para los botones */
        .swal2-popup .btn {
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: 500;
        }

        .swal2-popup .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .swal2-popup .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        /* Asegurar que no haya elementos residuales del modal */
        .modal-backdrop {
            display: none !important;
        }

        body.modal-open {
            overflow: auto !important;
            padding-right: 0 !important;
        }

        /* Asegurar que los botones sean clickeables */
        .swal2-actions button {
            pointer-events: auto !important;
            cursor: pointer !important;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('.modal-backdrop').remove();
            $('.btn-proceed').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('#reservationModal')
                    .addClass('show')
                    .css('display', 'block')
                    .attr('aria-hidden', 'false');
                $('body')
                    .addClass('modal-open')
                    .append('<div class="modal-backdrop fade show"></div>');
            });
            $('.close, .btn-secondary').click(function () {
                $('#reservationModal')
                    .removeClass('show')
                    .css('display', 'none')
                    .attr('aria-hidden', 'true');

                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
            $('.btn-proceed').on('click', function () {
                console.log('Botón clickeado');
            });

            $('#reservationModal').on('show.bs.modal', function () {
                console.log('Modal mostrándose');
            });

            $('#reservationModal').on('shown.bs.modal', function () {
                console.log('Modal mostrado');
            });
        });
        const costoGarzon = 150;
        let totalCarrito = <?php echo $total_carrito; ?>;

        function mostrarCantidadGarzones() {
            document.getElementById('cantidad_garzones_div').style.display = 'block';
        }

        function ocultarCantidadGarzones() {
            document.getElementById('cantidad_garzones_div').style.display = 'none';
            document.getElementById('cantidad_garzones').value = '';
            calcularTotal();
        }

        function calcularTotal() {
            let cantidadGarzones = document.getElementById('cantidad_garzones').value;
            let totalGarzones = cantidadGarzones ? cantidadGarzones * costoGarzon : 0;
            let totalServicio = totalCarrito + totalGarzones;

            document.getElementById('total_servicio').innerText = totalServicio.toFixed(2);
            document.getElementById('monto_total').value = totalServicio.toFixed(2);
        }
        function submitReservation() {
            const form = document.getElementById('reservationForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Guardar los datos del formulario antes de cualquier operación
            const formData = new FormData(form);
            const serializedData = $(form).serialize();

            // Cerrar el modal Bootstrap
            $('#reservationModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            // Mostrar loading
            Swal.fire({
                title: 'Procesando...',
                text: 'Por favor espere',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false
            });

            // Realizar la petición AJAX
            $.ajax({
                url: '<?= site_url('Welcome/guardar_reserva'); ?>',
                type: 'POST',
                data: serializedData,
                dataType: 'json',
                success: function (response) {
                    Swal.close();

                    if (response.success) {
                        // Crear funciones para manejar las acciones
                        function descargarPDF() {
                            const tempForm = document.createElement('form');
                            tempForm.method = 'POST';
                            tempForm.action = '<?= site_url('Welcome/generar_pdf_reserva'); ?>';
                            tempForm.target = '_blank';

                            for (let [key, value] of formData.entries()) {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = key;
                                input.value = value;
                                tempForm.appendChild(input);
                            }

                            document.body.appendChild(tempForm);
                            tempForm.submit();
                            document.body.removeChild(tempForm);
                        }

                        function redirigir() {
                            window.location.href = '<?= site_url('Welcome/carrito'); ?>';
                        }

                        // Mostrar el mensaje de éxito con botones personalizados
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success m-2',
                                cancelButton: 'btn btn-secondary m-2'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire({
                            title: '¡Reserva Exitosa!',
                            text: response.message,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Descargar PDF',
                            cancelButtonText: 'Cerrar',
                            reverseButtons: true,
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                descargarPDF();
                                setTimeout(redirigir, 1000);
                            } else {
                                redirigir();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message || 'Error al procesar la reserva',
                            icon: 'error'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error de conexión con el servidor',
                        icon: 'error'
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }

        // Inicialización
        $(document).ready(function () {
            // Limpiar cualquier modal residual
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');

            // Configurar el botón de confirmar reserva
            $('#btnConfirmarReserva').off('click').on('click', function (e) {
                e.preventDefault();
                submitReservation();
            });

            // Asegurar que el modal se cierre correctamente
            $('#reservationModal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
        });
        const fechaInput = document.getElementById('fecha_reserva');
        const hoy = new Date();
        const formatoFecha = hoy.toISOString().split('T')[0];
        fechaInput.min = formatoFecha;
        $(document).ready(function () {
            $('#btnConfirmarReserva').off('click').on('click', function (e) {
                e.preventDefault();
                submitReservation();
            });
        });

        function eliminarProducto(id, tipo, cantidad) {
            $.ajax({
                url: '<?= site_url('Welcome/eliminar_producto_carrito'); ?>',
                type: 'POST',
                data: {
                    id: id,
                    tipo: tipo,
                    cantidad: cantidad
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Producto Eliminado',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error de conexión',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                }
            });
        }
    </script>

</body>

</html>