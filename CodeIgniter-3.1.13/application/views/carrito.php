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

        .btn-vaciar {
            margin-top: 20px;
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
                EL DETALLE <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <!-- SideBar User info -->
            <div class="full-box dashboard-sideBar-UserInfo">
                <figure class="full-box">
                    <img src="../../assets/img/StudetMaleAvatar.png" alt="UserIcon"> <!-- Imagen de avatar -->
                    <figcaption class="text-center text-titles">
                        <?php if (isset($nombre)) : ?>
                            <h3><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <?php endif; ?>
                    </figcaption>
                </figure>

                <ul class="full-box list-unstyled text-center">
                    <li>
                        <a href="<?php echo site_url('Welcome/inicio'); ?>" title="Inicio" class="btn-user">
                            <img src="../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/informacionUsuario'); ?>" title="Mi Informacion" class="btn-user">
                            <img src="../../assets/img/avatar (1).png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/configuracion'); ?>" title="Configuracion">
                            <img src="../../assets/img/configuracion-de-usuario.png">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Salir del sistema" class="btn-exit-system">
                            <img src="../../assets/img/cerrar-sesion.png">
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SideBar Menu -->
            <ul class="list-unstyled full-box dashboard-sideBar-Menu">
                <li>
                    <a href="<?php echo site_url('Welcome/vajilla'); ?>">
                        <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/manteleria'); ?>">
                        <img src="../../assets/img/mesa.png" alt="Mantelería y Decoración"> Mantelería y Decoración
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/bebidas'); ?>">
                        <img src="../../assets/img/vino.png" alt="Bebidas"> Bebidas
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/carrito'); ?>">
                        <img src="../../assets/img/carrito-de-compras.png" alt="Carrito"> Carrito
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
                    <h1 class="titulo">"EL DETALLE EVENTOS - Carrito"</h1>
                </div>
                <div class="col-md-10">
                    <h1 class="titulo">Carrito de Compras</h1>
                    <table class="table">
                        <tbody>
                            <?php if (!empty($productos)): ?>
                                <table class="table carrito-table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($productos as $producto): ?>
                                            <tr>
                                            <td><?php echo htmlspecialchars($producto['tipo'] . ' - ' . $producto['plan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>Bs. <?php echo number_format($producto['precio'], 2); ?></td>
                                                <td><?php echo $producto['cantidad']; ?></td>
                                                <td>Bs. <?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('Welcome/eliminar_del_carrito/' . $producto['decoracion_id']); ?>" class="btn btn-danger"style="color: white;">Quitar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>El carrito está vacío.</p>
                            <?php endif; ?>
                    </table>

                    <!-- Botón para vaciar el carrito -->
                    <form action="<?php echo site_url('Welcome/vaciar_carrito'); ?>" method="post">
                        <button type="submit" class="btn btn-warning btn-vaciar" style="color: white;">Vaciar Carrito</button>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Mi Tienda. Todos los derechos reservados.</p>
    </footer>
    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/counterup/counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/venobox/venobox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/aos/aos.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>