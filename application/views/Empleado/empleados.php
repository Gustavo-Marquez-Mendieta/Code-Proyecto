<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link href="<?php echo base_url(); ?>assets/css/cambios.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/tabla.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <style>
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

        body .modal {
            z-index: 9999 !important;
            background-color: rgba(0, 0, 0, 0.5);
        }

        body .modal-backdrop {
            z-index: 9998 !important;
        }

        body .modal-dialog {
            margin: 1.75rem auto;
            max-width: 500px;
        }

        body .modal-content {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        body .modal-header {
            background: linear-gradient(45deg, #FF6B6B, #87CEEB);
            color: white;
            border-radius: 8px 8px 0 0;
            border-bottom: none;
        }

        body .modal-title {
            color: white;
            font-weight: bold;
        }

        body .modal-body {
            padding: 20px;
        }

        body .form-group label {
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        body .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 0.5rem;
        }

        body .form-control:focus {
            border-color: #87CEEB;
            box-shadow: 0 0 0 0.2rem rgba(135, 206, 235, 0.25);
        }

        .dashboard-contentPage {
            margin-left: 250px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .btn-success {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }

        .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-primary:hover,
        .btn-success:hover,
        .btn-danger:hover {
            opacity: 0.9 !important;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin: 0 2px;
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

    <!-- Contenido principal -->
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="titulo">"Empleados"</h1>
                    <?php if ($this->session->flashdata('success_message')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success_message'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-7">
                    <a href="<?= site_url('Welcome/agregar_empleado'); ?>" class="btn btn-primary"
                        style="color:white; margin:20px">Agregar Empleado</a>
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
                            <?php foreach ($empleados as $empleado): ?>
                                <tr>
                                    <td><?= $empleado->empleado_id; ?></td>
                                    <td><?= $empleado->nombre; ?></td>
                                    <td><?= $empleado->apellido_paterno; ?></td>
                                    <td><?= $empleado->apellido_materno; ?></td>
                                    <td><?= $empleado->celular; ?></td>
                                    <td>
                                        <?php if ($empleado->estado == 1): ?>
                                            <button type="button" onclick="editarEmpleado(
                '<?= $empleado->empleado_id; ?>', 
                '<?= htmlspecialchars($empleado->nombre); ?>', 
                '<?= htmlspecialchars($empleado->apellido_paterno); ?>', 
                '<?= htmlspecialchars($empleado->apellido_materno); ?>', 
                '<?= htmlspecialchars($empleado->celular); ?>'
            )" class="btn btn-primary btn-sm text-white">
                                                Editar
                                            </button>
                                            <a href="<?= site_url('Welcome/eliminar_empleado/' . $empleado->empleado_id); ?>"
                                                class="btn btn-danger btn-sm text-white">Eliminar</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('Welcome/reactivar_empleado/' . $empleado->empleado_id); ?>"
                                                class="btn btn-success btn-sm text-white">Reactivar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="modalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalEditarEmpleadoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarEmpleadoLabel">Editar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarEmpleado">
                        <input type="hidden" id="empleado_id" name="empleado_id">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success text-white" id="btnGuardarCambios">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tus scripts locales -->
    <script src="<?php echo base_url(); ?>assets/js/material.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ripples.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <!-- Script para el manejo del modal -->
    <script>
        $(document).ready(function () {
            // Verificar que jQuery está cargado
            console.log('jQuery version:', $.fn.jquery);

            // Función para editar empleado
            window.editarEmpleado = function (empleado_id, nombre, apellido_paterno, apellido_materno, celular) {
                console.log('Editando empleado:', empleado_id);

                // Llenar el formulario
                $('#empleado_id').val(empleado_id);
                $('#nombre').val(nombre);
                $('#apellido_paterno').val(apellido_paterno);
                $('#apellido_materno').val(apellido_materno);
                $('#celular').val(celular);

                // Mostrar el modal de forma manual
                $('#modalEditarEmpleado').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            };

            $('#btnGuardarCambios').on('click', function () {
                var empleado_id = $('#empleado_id').val();
                var formData = $('#formEditarEmpleado').serialize();

                $.ajax({
                    url: '<?= site_url('Welcome/actualizar_empleado/') ?>' + empleado_id,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Primero ocultamos el modal de edición
                        $('#modalEditarEmpleado').modal('hide');
                        $('.modal-backdrop').remove(); // Elimina el backdrop del modal

                        // Mostramos el SweetAlert con cierre automático
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Empleado actualizado correctamente',
                            icon: 'success',
                            showConfirmButton: false, // Oculta el botón de OK
                            allowOutsideClick: false, // Evita que se cierre al hacer clic fuera
                            timer: 2000 // Se cerrará automáticamente después de 2 segundos
                        }).then(() => {
                            window.location.href = window.location.href;
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo actualizar el empleado',
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                });
            });
            window.testModal = function () {
                $('#modalEditarEmpleado').modal('show');
            }

            if (typeof $.material !== 'undefined') {
                $.material.init();
            }
        });
    </script>
</body>

</html>