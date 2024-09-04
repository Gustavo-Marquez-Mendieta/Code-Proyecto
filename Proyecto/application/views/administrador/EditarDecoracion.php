<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar Decoración</title>
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
        .dashboard-sideBar {
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
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
        }

        .dashboard-sideBar a:hover {
            background-color: #555;
        }

        .dashboard-sideBar .btn-sideBar-SubMenu {
            padding-left: 30px;
            position: relative;
        }

        .dashboard-sideBar .btn-sideBar-SubMenu::after {
            content: "\f0d7";
            font-family: "Material Icons";
            position: absolute;
            right: 20px;
        }

        .dashboard-contentPage {
            margin-left: 250px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .dashboard-sideBar img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .frase {
            font-size: 40px;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 30px;
            background-image: linear-gradient(45deg, #FF6B6B, #87CEEB);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .titulo {
            font-size: 60px;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 30px;
            background-image: linear-gradient(45deg, #FF6B6B, #87CEEB);
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
                        <img src="<?php echo base_url(); ?>assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminManteleria'); ?>">
                        <img src="<?php echo base_url(); ?>assets/img/mesa.png" alt="Mantelería y Decoración">
                        Mantelería y Decoración
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/adminBebidas'); ?>">
                        <img src="<?php echo base_url(); ?>assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/solicitudes'); ?>">
                        <img src="../../assets/image/solicitudes.png" alt="Bebidas"> Solicitudes
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
                            <?php if (!empty($decoracion)): ?>
                                <?php if (isset($decoracion) && is_array($decoracion)): ?>
                                    <form
                                        action="<?php echo site_url('Welcome/editarDecoracion/' . $decoracion['decoracion_id']); ?>"
                                        method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="decoracion_id"
                                            value="<?php echo htmlspecialchars($decoracion['decoracion_id']); ?>">
                                        <input type="hidden" name="imagen_actual"
                                            value="<?php echo htmlspecialchars($decoracion['imagen']); ?>">

                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <select class="form-control" id="tipo" name="tipo" required>
                                                <option value="">Selecciona un tipo</option>
                                                <option value="Manteleria" <?php echo ($decoracion['tipo'] == 'Manteleria') ? 'selected' : ''; ?>>Mantelería</option>
                                                <option value="Decoracion" <?php echo ($decoracion['tipo'] == 'Decoracion') ? 'selected' : ''; ?>>Decoración</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="number" name="precio" id="precio"
                                                value="<?php echo htmlspecialchars($decoracion['precio']); ?>"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="plan">Plan</label>
                                            <select class="form-control" id="plan" name="plan" required>
                                                <option value="">Selecciona un plan</option>
                                                <option value="Basico" <?php echo ($decoracion['plan'] == 'Basico') ? 'selected' : ''; ?>>Básico</option>
                                                <option value="Intermedio" <?php echo ($decoracion['plan'] == 'Intermedio') ? 'selected' : ''; ?>>Intermedio</option>
                                                <option value="Premium" <?php echo ($decoracion['plan'] == 'Premium') ? 'selected' : ''; ?>>Premium</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="imagen">Imagen</label>
                                            <input type="file" name="imagen" id="imagen" class="form-control">
                                            <img src="<?php echo base_url('assets/img/' . $decoracion['imagen']); ?>"
                                                alt="Imagen actual" width="100">
                                        </div>
                                        <input type="submit" value="Actualizar" class="btn btn-primary">
                                        <a href="<?php echo site_url('Welcome/adminManteleria'); ?>"
                                            class="btn btn-danger">Cancelar</a>
                                    </form>
                                <?php else: ?>
                                    <p>No hay datos disponibles.</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>No se ha encontrado la decoración.</p>
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