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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* Estilos adicionales que puedas necesitar */
        .dashboard-sideBar {
            /* Estilos de la barra lateral */
            left: 0;
            z-index: 2;
            background-image: url('<?php echo base_url(); ?>assets/img/copaga.jpg');
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
                        <h6>Bienvenido</h6>
                        <?php if (isset($nombre)): ?>
                            <h3> <?= $nombre; ?></h3>
                        <?php endif; ?>
                    </figcaption>
                </figure>
                <ul class="full-box list-unstyled text-center">
                    <li>
                        <a href="<?php echo site_url('Welcome/admin'); ?>" title="Inicio" class="btn-user">
                            <img src="../../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/adminUser'); ?>" title="Usuarios" class="btn-user">
                            <img src="../../../assets/img/avatar (1).png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/AdminConfiguracion'); ?>" title="Configuracion">
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
                    <a href="<?php echo site_url('Welcome/adminVajilla'); ?>">
                        <img src="../../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('Welcome/adminManteleria'); ?>">
                        <img src="../../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminBebidas'); ?>">
                        <img src="../../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>">
                        <img src="../../../assets/image/solicitudes.png" alt="Solicitudes"> Solicitudes
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/empleados'); ?>">
                        <img src="../../../assets/image/empleado.png"> Empleados
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/reportes'); ?>">
                        <img src="../../../assets/image/reportes.png" alt="Reportes"> Reportes
                    </a>
                </li>
            </ul>
        </div>
    </section>


    <?php
    $ocultarElementos = ['cancelado', 'Vajilla Entregada', 'Vajilla Recogida', 'Evento Completado'];
    ?>
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"Detalles de la Solicitud"</h1>
                </div>
                <div class="col-md-6">
                    <h2 style="color:white">Detalles de la Reserva #<?= $reserva->reserva_id; ?></h2>

                    <p style="color:white"><strong>Fecha de Reserva:</strong> <?= $reserva->fecha_reserva; ?></p>
                    <p style="color:white"><strong>Tipo de Evento:</strong> <?= $reserva->tipo_evento; ?></p>
                    <p style="color:white"><strong>Días:</strong> <?= $reserva->dias; ?></p>
                    <p style="color:white"><strong>Estado de Evento:</strong> <?= $reserva->estado_pago; ?></p>
                    <p style="color:white"><strong>Cantidad de Garzones:</strong> <?= $reserva->garzones; ?></p>
                    <p style="color:white"><strong>Total:</strong> <?= $reserva->monto_total; ?> Bs.</p>

                    <h3 style="color:white">Detalles</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Detalle</th>
                                <th>Vajilla</th>
                                <th>Mantelería</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Detalles de Recojo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detalles)): ?>
                                <?php foreach ($detalles as $detalle): ?>
                                    <tr id="detalle_row_<?= $detalle->detalle_id; ?>">
                                        <td><?= $detalle->detalle_id; ?></td>
                                        <td><?= $detalle->vajilla_nombre; ?></td>
                                        <td><?= $detalle->manteleria_nombre . ' ' . $detalle->tipo; ?></td>
                                        <td>
                                            <?php if (!in_array($reserva->estado_pago, $ocultarElementos)): ?>
                                                <form method="post"
                                                    action="<?= site_url('Welcome/actualizarCantidad/' . $detalle->detalle_id); ?>">
                                                    <input type="number" name="cantidad" class="form-control"
                                                        value="<?= $detalle->cantidad; ?>" min="1" required>
                                                    <button type="submit" class="btn btn-success btn-sm mt-2"
                                                        style="color:white">Actualizar</button>
                                                </form>
                                            <?php else: ?>
                                                <?= $detalle->cantidad; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td id="precio_<?= $detalle->detalle_id; ?>">
                                            <?= $detalle->cantidad * $detalle->precio; ?> Bs.
                                        </td>
                                        <td><?= $detalle->detalles; ?></td>
                                        <td>
                                            <?php if (!in_array($reserva->estado_pago, $ocultarElementos)): ?>
                                                <a href="<?= site_url('Welcome/eliminarDetalle/' . $detalle->detalle_id); ?>"
                                                    class="btn btn-danger" style="color:black"
                                                    onclick="return confirm('¿Estás seguro de eliminar este detalle?');">Eliminar</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No hay detalles disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <br><br>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>" class="btn btn-primary"
                        style="color:white">Volver a Solicitudes</a>

                    <?php if ($reserva->estado_pago == 'Pendiente'): ?>
                        <a href="<?php echo site_url('Welcome/aprobar_solicitud/' . $reserva->reserva_id); ?>"
                            class="btn btn-success" style="color:white">Aprobar Solicitud</a>
                        <a href="<?php echo site_url('Welcome/cancelar_solicitud/' . $reserva->reserva_id); ?>"
                            class="btn btn-success" style="color:white">Cancelar Solicitud</a>
                    <?php elseif ($reserva->estado_pago == 'aprobado-esperando adelanto'): ?>
                        <a href="<?php echo site_url('Welcome/recibir_adelanto/' . $reserva->reserva_id); ?>"
                            class="btn btn-info" style="color:white">Adelanto Recibido</a>
                    <?php elseif ($reserva->estado_pago == 'En Curso de entrega'): ?>
                        <a href="#" id="btnEntregarVajilla"
                            data-url="<?= site_url('Welcome/entregar_vajilla/' . $reserva->reserva_id); ?>"
                            class="btn btn-warning" style="color:white">
                            Entregar Vajilla
                        </a>
                        <?php if ($reserva->garzones == 0): ?>
                            <p style="color:yellow; margin-top:10px;">Advertencia: No hay garzones asignados a esta reserva.</p>
                        <?php endif; ?>
                    <?php elseif ($reserva->estado_pago == 'Vajilla Entregada'): ?>
                        <form action="<?= site_url('Welcome/guardar_detalles_recogida/' . $reserva->reserva_id); ?>"
                            method="post" style="margin-top: 20px;">
                            <div class="form-group">
                                <label for="detalles" style="color:white">Detalles de la Recogida:</label>
                                <textarea class="form-control" id="detalles" name="detalles" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="color:white">Agregar detalles y recoger
                                vagilla</button>
                        </form>
                    <?php elseif ($reserva->estado_pago == 'Vajilla Recogida'): ?>
                        <a href="<?php echo site_url('Welcome/terminar_evento/' . $reserva->reserva_id); ?>"
                            class="btn btn-danger" style="color:white">Terminar Evento</a>
                    <?php endif; ?>
                </div>

                <?php if (!in_array($reserva->estado_pago, $ocultarElementos)): ?>
                    <div class="col-md-4">
                        <form>
                            <h3 style="color:white">Gestión de Garzones</h3>

                            <!-- Selector de garzones -->
                            <div class="form-group">
                                <label for="garzonSelect" style="color:white;">Seleccionar Garzón:</label>
                                <select id="garzonSelect" class="form-control" style="background-color:white">
                                    <?php foreach ($empleados as $empleado): ?>
                                        <option value="<?= $empleado->empleado_id; ?>"
                                            data-nombre="<?= htmlspecialchars($empleado->nombre); ?>"
                                            data-apellido-paterno="<?= htmlspecialchars($empleado->apellido_paterno); ?>"
                                            data-apellido-materno="<?= htmlspecialchars($empleado->apellido_materno); ?>"
                                            data-celular="<?= htmlspecialchars($empleado->celular); ?>">
                                            <?= htmlspecialchars($empleado->nombre . ' ' . $empleado->apellido_paterno . ' ' . $empleado->apellido_materno); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" id="agregarGarzonBtn" class="btn btn-info mt-2"
                                    style="color:white">Agregar Garzón</button>
                            </div>

                            <!-- Tabla de garzones asignados -->
                            <h3 style="color:white;">Garzones Asignados para esta Fiesta</h3>
                            <?php if (!empty($garzones_asignados)): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Celular</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($garzones_asignados as $garzon): ?>
                                            <tr>
                                                <td><?= $garzon->empleado_id; ?></td>
                                                <td><?= htmlspecialchars($garzon->nombre); ?></td>
                                                <td><?= htmlspecialchars($garzon->apellido_paterno); ?></td>
                                                <td><?= htmlspecialchars($garzon->apellido_materno); ?></td>
                                                <td><?= htmlspecialchars($garzon->celular); ?></td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm quitar-garzon"
                                                        data-empleado-id="<?= $garzon->empleado_id; ?>"
                                                        data-reserva-id="<?= $reserva->reserva_id; ?>"
                                                        style="color:white">Quitar</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p style="color:white;">No hay garzones asignados a esta reserva.</p>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!--====== Scripts ======-->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .custom-icon {
            width: 80px;
            height: 80px;
            margin: auto;
            position: relative;
            box-sizing: content-box;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Estilo para el check */
        .check-circle {
            width: 80px;
            height: 80px;
            border: 2px solid #4BB543;
            border-radius: 50%;
            position: relative;
        }

        .check-circle::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            height: 60px;
            border-right: 4px solid #4BB543;
            border-bottom: 4px solid #4BB543;
            transform: translate(-50%, -70%) rotate(45deg);
        }

        /* Estilo para la señal de advertencia */
        .warning-sign {
            width: 80px;
            height: 80px;
            border: 2px solid #FFA500;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #FFA500;
            font-weight: bold;
        }

        /* Estilo para la X de error */
        .error-sign {
            width: 80px;
            height: 80px;
            border: 2px solid #DC3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #DC3545;
            font-weight: bold;
        }

        /* Ajustes generales del popup */
        .swal2-popup {
            padding: 1em !important;
        }

        .swal2-icon {
            border: none !important;
            background: none !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const maxGarzones = <?= $reserva->garzones ?>;
            const garzonesActuales = <?= !empty($garzones_asignados) ? count($garzones_asignados) : 0 ?>;
            const btnEntregarVajilla = document.getElementById('btnEntregarVajilla');

            function showActionAlert(title, text = '', icon = 'success', redirectUrl = null) {
                let iconHtml;
                let iconColor;

                switch (icon) {
                    case 'success':
                        iconHtml = '<div class="custom-icon"><div class="check-circle"></div></div>';
                        iconColor = '#4BB543';
                        break;
                    case 'warning':
                        iconHtml = '<div class="custom-icon"><div class="warning-sign">!</div></div>';
                        iconColor = '#FFA500';
                        break;
                    case 'error':
                        iconHtml = '<div class="custom-icon"><div class="error-sign">×</div></div>';
                        iconColor = '#DC3545';
                        break;
                }

                Swal.fire({
                    title: title,
                    text: text,
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    background: 'rgba(0, 0, 0, 0.8)',
                    backdrop: false,
                    color: '#ffffff',
                    width: 'auto',
                    padding: '1em',
                    iconHtml: iconHtml,
                    customClass: {
                        popup: 'custom-alert-class',
                        icon: 'custom-icon-class'
                    }
                }).then(() => {
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                });
            }

            // Ocultar elementos si no se requieren garzones
            if (maxGarzones === 0) {
                const garzonSelect = document.getElementById('garzonSelect');
                const agregarGarzonBtn = document.getElementById('agregarGarzonBtn');

                if (garzonSelect) garzonSelect.style.display = 'none';
                if (agregarGarzonBtn) agregarGarzonBtn.style.display = 'none';

                const mensaje = document.createElement('p');
                mensaje.style.color = 'white';
                mensaje.textContent = 'No se requieren garzones para este evento';
                if (garzonSelect && garzonSelect.parentNode) {
                    garzonSelect.parentNode.appendChild(mensaje);
                }
            }

            // Agregar garzón
            document.getElementById('agregarGarzonBtn')?.addEventListener('click', function () {
                if (maxGarzones === 0) {
                    showActionAlert('Información', 'No se requieren garzones para este evento', 'warning');
                    return;
                }

                if (garzonesActuales >= maxGarzones) {
                    showActionAlert('Límite Alcanzado', `No se pueden agregar más garzones. El límite requerido es ${maxGarzones}.`, 'warning');
                    return;
                }

                const garzonSelect = document.getElementById('garzonSelect');
                const garzonId = garzonSelect.value;
                const reservaId = <?= $reserva->reserva_id; ?>;

                fetch('<?= site_url('Welcome/agregar_garzones_evento'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        reserva_id: reservaId,
                        garzones: [garzonId]
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.exists) {
                            showActionAlert('Información', 'El garzón ya está asignado a esta reserva.', 'warning');
                        } else if (data.success && !data.exists) {
                            showActionAlert('¡Éxito!', 'Garzón agregado correctamente al evento.', 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showActionAlert('Error', 'Error al agregar el garzón.', 'error');
                        }
                    });
            });

            // Entregar vajilla
            if (btnEntregarVajilla) {
                btnEntregarVajilla.addEventListener('click', function (e) {
                    e.preventDefault();
                    const urlEntrega = this.dataset.url;

                    if (maxGarzones === 0) {
                        showActionAlert('Vajilla Entregada', 'La vajilla fue entregada correctamente', 'success');
                        setTimeout(() => window.location.href = urlEntrega, 2000);
                    } else if (garzonesActuales < maxGarzones) {
                        showActionAlert('¡Atención!',
                            `No se puede entregar la vajilla. Faltan garzones por asignar. Se requieren ${maxGarzones} garzones y solo hay ${garzonesActuales} asignados.`,
                            'warning'
                        );
                    } else {
                        showActionAlert('Vajilla Entregada', 'La vajilla fue entregada correctamente', 'success');
                        setTimeout(() => window.location.href = urlEntrega, 2000);
                    }
                });
            }

            // Quitar garzón
            $('.quitar-garzon').on('click', function () {
                var empleado_id = $(this).data('empleado-id');
                var reserva_id = $(this).data('reserva-id');

                $.ajax({
                    url: '<?= site_url('Welcome/quitar_garzon'); ?>',
                    type: 'POST',
                    data: { empleado_id: empleado_id, reserva_id: reserva_id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            showActionAlert('¡Éxito!', 'Garzón eliminado correctamente', 'success');
                            setTimeout(() => window.location.reload(), 2000);
                        } else {
                            showActionAlert('Error', response.message, 'error');
                        }
                    },
                    error: function () {
                        showActionAlert('Error', 'Ocurrió un error al intentar quitar al garzón.', 'error');
                    }
                });
            });

            // Recoger Vajilla - Versión corregida
            const formRecogerVajilla = document.querySelector('form[action*="guardar_detalles_recogida"]');
            if (formRecogerVajilla) {
                formRecogerVajilla.addEventListener('submit', function (e) {
                    e.preventDefault(); // Importante: previene el envío normal del formulario
                    const formData = new FormData(this);
                    const url = this.action;

                    // Deshabilitar el botón para evitar doble envío
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) submitButton.disabled = true;

                    fetch(url, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            showActionAlert('¡Vajilla Recogida!', 'La vajilla ha sido recogida exitosamente', 'success');
                            setTimeout(() => {
                                window.location.href = '<?= site_url('Welcome/solicitudes'); ?>';
                            }, 2000);
                        })
                        .catch(error => {
                            showActionAlert('Error', 'Ocurrió un error al recoger la vajilla', 'error');
                            if (submitButton) submitButton.disabled = false;
                        });
                });
            }

            // Aprobar Solicitud
            const btnAprobarSolicitud = document.querySelector('a[href*="aprobar_solicitud"]');
            if (btnAprobarSolicitud) {
                btnAprobarSolicitud.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.href;
                    showActionAlert('¡Solicitud Aprobada!', 'La solicitud ha sido aprobada exitosamente', 'success');
                    setTimeout(() => window.location.href = url, 2000);
                });
            }

            // Cancelar Solicitud
            const btnCancelarSolicitud = document.querySelector('a[href*="cancelar_solicitud"]');
            if (btnCancelarSolicitud) {
                btnCancelarSolicitud.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.href;
                    showActionAlert('Solicitud Cancelada', 'La solicitud ha sido cancelada', 'success');
                    setTimeout(() => window.location.href = url, 2000);
                });
            }

            // Recibir Adelanto
            const btnRecibirAdelanto = document.querySelector('a[href*="recibir_adelanto"]');
            if (btnRecibirAdelanto) {
                btnRecibirAdelanto.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.href;
                    showActionAlert('¡Adelanto Registrado!', 'El adelanto ha sido registrado correctamente', 'success');
                    setTimeout(() => window.location.href = url, 2000);
                });
            }

            // Terminar Evento
            const btnTerminarEvento = document.querySelector('a[href*="terminar_evento"]');
            if (btnTerminarEvento) {
                btnTerminarEvento.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.href;
                    showActionAlert('¡Evento Terminado!', 'El evento ha sido terminado exitosamente', 'success');
                    setTimeout(() => window.location.href = url, 2000);
                });
            }
        });
    </script>
</body>

</html>