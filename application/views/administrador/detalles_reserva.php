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
                        <img src="../../../assets/image/decoracion.png" alt="Mantelería y Decoración"> Decoración
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
            </ul>
        </div>
    </section>

    <!-- Content page -->
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"Detalles de la Solicitud"</h1>
                </div>
                <div class="col-md-5">
                    <h2 style="color:white">Detalles de la Reserva #<?= $reserva->reserva_id; ?></h2>

                    <p style="color:white"><strong>Fecha de Reserva:</strong> <?= $reserva->fecha_reserva; ?></p>
                    <p style="color:white"><strong>Tipo de Evento:</strong> <?= $reserva->tipo_evento; ?></p>
                    <p style="color:white"><strong>Días:</strong> <?= $reserva->dias; ?></p>
                    <p style="color:white"><strong>Estado de Pago:</strong> <?= $reserva->estado_pago; ?></p>
                    <p style="color:white"><strong>Cantidad de Garzones:</strong>
                        <?= $reserva->garzones; ?>
                        (<?= $reserva->garzones * 150; ?> Bs.) <!-- Precio por garzón -->
                    </p>
                    <?php
                    // Calculamos el costo total de los garzones
                    $costo_garzones = $reserva->garzones * 150;

                    // Sumamos el costo de los garzones al monto total
                    $monto_total_con_garzones = $reserva->monto_total + $costo_garzones;
                    ?>

                    <p style="color:white"><strong>Monto Total:</strong>
                        <?= $monto_total_con_garzones; ?> Bs. <!-- Monto total actualizado -->
                    </p>
                    <h3 style="color:white">Detalles</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Detalle</th>
                                <th>Vajilla</th>
                                <th>Decoración</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Garzones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detalles)): ?>
                                <?php foreach ($detalles as $detalle): ?>
                                    <tr>
                                        <td><?= $detalle->detalle_id; ?></td>
                                        <td><?= $detalle->vajilla_nombre; ?></td>
                                        <td><?= $detalle->decoracion_nombre . ' ' . $detalle->tipo . ''; ?></td>
                                        <td><?= $detalle->cantidad; ?></td>
                                        <td><?= $detalle->cantidad * $detalle->precio; ?> .Bs</td>
                                        <td id="garzonList_<?= $detalle->detalle_id; ?>"></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No hay detalles disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>


                    <br><br>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>" class="btn btn-primary"
                        style="color:white">Volver a
                        Solicitudes</a>
                    <a href="<?php echo site_url('Welcome/aprobar_solicitud/' . $reserva->reserva_id); ?>"
                        class="btn btn-success" style="color:white">Aprobar Solicitud</a>
                </div>
                <div class="col-md-4">
                    <h3 style="color:white">Garzones para el Evento</h3>
                    <table id="garzonesTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id Garzon</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Celular</th>
                            </tr>
                        </thead>
                        <tbody id="garzonesTableBody">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="garzonSelect" style="color:white;">Seleccionar Garzón:</label>
                        <select id="garzonSelect" class="form-control">
                            <?php foreach ($empleados as $empleado): ?>
                                <option value="<?= $empleado->empleado_id; ?>"
                                    data-nombre="<?= htmlspecialchars($empleado->nombre); ?>"
                                    data-apellido-paterno="<?= htmlspecialchars($empleado->apellido_paterno); ?>"
                                    data-apellido-materno="<?= htmlspecialchars($empleado->apellido_materno); ?>"
                                    data-celular="<?= htmlspecialchars($empleado->celular); ?>">
                                    <?= htmlspecialchars($empleado->nombre); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" id="agregarGarzonBtn" class="btn btn-info" style="color:white">Agregar a
                            la lista</button>
                        <button type="button" id="guardarGarzonesBtn" class="btn btn-success"
                            style="color:white">Agregar
                            Garzones al Evento</button>
                    </div>
                    <h3 style="color:white;">Garzones Asignados para esta Fiesta</h3>
                    <?php if (!empty($garzones_asignados)): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Garzón</th>
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
                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const garzonesSeleccionados = [];

        // Función para agregar garzón a la lista
        document.getElementById('agregarGarzonBtn').addEventListener('click', function () {
            const garzonSelect = document.getElementById('garzonSelect');
            const garzonId = garzonSelect.value;
            const garzonNombre = garzonSelect.options[garzonSelect.selectedIndex].dataset.nombre;
            const garzonApellidoPaterno = garzonSelect.options[garzonSelect.selectedIndex].dataset.apellidoPaterno;
            const garzonApellidoMaterno = garzonSelect.options[garzonSelect.selectedIndex].dataset.apellidoMaterno;
            const garzonCelular = garzonSelect.options[garzonSelect.selectedIndex].dataset.celular;

            if (!garzonesSeleccionados.includes(garzonId)) {
                // Agregar a la tabla
                const row = `<tr>
                            <td>${garzonId}</td>
                            <td>${garzonNombre}</td>
                            <td>${garzonApellidoPaterno}</td>
                            <td>${garzonApellidoMaterno}</td>
                            <td>${garzonCelular}</td>
                         </tr>`;
                document.getElementById('garzonesTableBody').innerHTML += row;

                // Agregar a la lista de seleccionados
                garzonesSeleccionados.push(garzonId);
            } else {
                alert('El garzón ya está en la lista.');
            }
        });

        // Función para enviar los garzones seleccionados al servidor
        // Función para enviar los garzones seleccionados al servidor
        document.getElementById('guardarGarzonesBtn').addEventListener('click', function () {
            const reservaId = <?= $reserva->reserva_id; ?>;  // Obtener el ID de la reserva
            if (garzonesSeleccionados.length > 0) {
                // Enviar los datos al servidor con AJAX
                fetch('<?= site_url('Welcome/agregar_garzones_evento'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        reserva_id: reservaId,
                        garzones: garzonesSeleccionados
                    })
                }).then(response => response.json())
                    .then(data => {
                        if (data.success && data.exists) {
                            // Al menos uno de los garzones ya estaba asignado
                            alert('Uno o más garzones ya están asignados a esta reserva.');
                            location.reload();  // Recargar la página para actualizar la lista
                        } else if (data.success && !data.exists) {
                            // Todos los garzones fueron agregados correctamente
                            alert('Garzones agregados correctamente al evento.');
                            location.reload();  // Recargar la página
                        } else {
                            // Error al agregar garzones
                            alert('Error al agregar los garzones.');
                        }
                    });
            } else {
                alert('No has seleccionado ningún garzón.');
            }
        });
        $(document).ready(function () {
            // Cuando se hace clic en el botón "Quitar"
            $('.quitar-garzon').on('click', function () {
                var empleado_id = $(this).data('empleado-id');
                var reserva_id = $(this).data('reserva-id');
                var row = $('#garzon_row_' + empleado_id); // Obtener la fila correspondiente

                // Confirmar la eliminación
                if (confirm('¿Está seguro de que desea quitar este garzón?')) {
                    $.ajax({
                        url: '<?= site_url('Welcome/quitar_garzon'); ?>',
                        type: 'POST',
                        data: { empleado_id: empleado_id, reserva_id: reserva_id },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                // Eliminar la fila de la tabla
                                row.remove();
                                alert(response.message);
                                window.location.reload();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function () {
                            alert('Ocurrió un error al intentar quitar al garzón.');
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>