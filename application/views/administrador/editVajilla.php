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
                        <img src="../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminBebidas'); ?>">
                        <img src="../../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>">
                        <img src="../../../assets/image/solicitudes.png" alt="Bebidas"> Solicitudes
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/empleados'); ?>">
                        <img src="../../../assets/image/empleado.png" alt="Bebidas"> Empleados
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
                <div class="col-md-1">
                    <br>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tbody>
                            <?php if (!empty($vajilla)): ?>
                                <?php if (isset($vajilla) && is_array($vajilla)): ?>
                                    <form action="<?php echo site_url('Welcome/updateVajilla'); ?>" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="vajilla_id"
                                            value="<?php echo htmlspecialchars($vajilla['vajilla_id']); ?>">
                                        <input type="hidden" name="imagen"
                                            value="<?php echo htmlspecialchars($vajilla['imagen']); ?>">

                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre"
                                                value="<?php echo htmlspecialchars($vajilla['nombre']); ?>" class="form-control"
                                                required style="color:white">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <input type="text" name="tipo" id="tipo"
                                                value="<?php echo htmlspecialchars($vajilla['tipo']); ?>" class="form-control"
                                                required style="color:white">
                                        </div>
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="number" name="precio" id="precio"
                                                value="<?php echo htmlspecialchars($vajilla['precio']); ?>" class="form-control"
                                                required style="color:white">
                                        </div>
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad de unidades por Caja</label>
                                            <input type="number" name="cantidad" id="cantidad"
                                                value="<?php echo htmlspecialchars($vajilla['cantidad']); ?>"
                                                class="form-control" required style="color:white">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock_cajas">Cantidad de Cajas en Stock</label>
                                            <input type="number" name="stock_cajas" id="stock_cajas"
                                                value="<?php echo htmlspecialchars($vajilla['stock_cajas']); ?>"
                                                class="form-control" required style="color:white">
                                        </div>
                                        <div class="form-group">
                                            <label for="imagen">Imagen</label>
                                            <input type="file" name="imagen" id="imagen" class="form-control">
                                            <img src="<?php echo base_url('assets/img/' . $vajilla['imagen']); ?>"
                                                alt="Imagen actual" width="100">
                                        </div>
                                        <input type="submit" value="Actualizar" class="btn btn-primary" style="color:white">
                                        <a href="<?php echo site_url('Welcome/CrudVajilla'); ?>" class="btn btn-danger"
                                            style="color:white">Cancelar</a>
                                    </form>
                                <?php else: ?>
                                    <p>No hay datos disponibles.</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>No se ha encontrado el producto.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/venobox/venobox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/aos/aos.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>