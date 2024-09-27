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
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">
</head>

<body>
    <section class="full-box cover dashboard-sideBar">
        <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
        <div class="full-box dashboard-sideBar-ct">
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                ADMINISTRADOR <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
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
            <ul class="list-unstyled full-box dashboard-sideBar-Menu">
                <li>
                    <a href="<?php echo site_url('Welcome/adminVajilla'); ?>">
                        <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminManteleria'); ?>">
                        <img src="../../assets/image/decoracion.png" alt="Mantelería y Decoración"> Decoración
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
            </ul>
        </div>
    </section>

    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"EL DETALLE EVENTOS"</h1>
                    <h1 class="frase">"Lista de Vajilla"</h1>
                </div>
                <div class="col-md-10">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID ga</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Stock de Cajas</th>
                                <th>Unidades de Caja</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($vajilla)): ?>
                                <?php foreach ($vajilla as $item): ?>
                                    <tr>
                                        <td><?= $item['vajilla_id']; ?></td>
                                        <td><?= $item['nombre']; ?></td>
                                        <td><?= $item['tipo']; ?></td>
                                        <td><?= $item['precio']; ?> Bs.</td>
                                        <td><?= $item['stock_cajas']; ?></td>
                                        <td><?= $item['cantidad']; ?> u.</td>
                                        <td><img src="<?= base_url('./assets/img/' . $item['imagen']); ?>"
                                                alt="<?= $item['nombre']; ?>" width="50"></td>
                                        <td>
                                            <a href="<?= site_url('Welcome/editarVajilla/' . $item['vajilla_id']); ?>"
                                                class="btn btn-primary btn-edit" style="color:white">Editar</a>
                                            <a href="<?= site_url('Welcome/deleteVajilla/' . $item['vajilla_id']); ?>"
                                                class="btn btn-danger btn-delete"
                                                onclick="return confirm('¿Estás seguro de eliminar este elemento?');"
                                                style="color:white">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No hay datos disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/material.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ripples.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script>
        $.material.init();
    </script>
</body>

</html>