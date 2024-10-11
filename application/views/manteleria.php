<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link href="<?php echo base_url(); ?>assets/css/cambios.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/card.css" rel="stylesheet">
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
            background-image: url("../../assets/img/copaga.jpg");
            background-color: #333;
            color: white;
            width: 250px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <!-- SideBar -->
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
                        <li class="user-info">
                            <h6>Bienvenido</h6>
                            <span class="user-name" style="font-size:20px"> <?= $nombre; ?></span>
                        </li>
                    </figcaption>
                </figure>

                <ul class="full-box list-unstyled text-center">
                    <li>
                        <a href="<?php echo site_url('Welcome/user'); ?>" title="Inicio" class="btn-user">
                            <img src="../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Mi Informacion" class="btn-user">
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

            <!-- SideBar Menu -->
            <ul class="list-unstyled full-box dashboard-sideBar-Menu">
                <li>
                    <a href="<?php echo site_url('Welcome/vajilla'); ?>">
                        <img src="../../assets/img/copa-con-vino.png" alt="Vajilla"> Vajilla
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Welcome/decoracion'); ?>">
                        <img src="../../assets/image/decoracion.png" alt="Mantelería y Decoración"> Decoración
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
        </div>
    </section>

    <!-- Content page -->
    <!-- Content page -->
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h1 class="titulo">"MANTELERÍA"</h1>
                </div>
                <div class="col-md-9">
                    <?php foreach ($productos as $row) { ?>
                        <div class="col-12 col-md-4 mt-5 text-center Products">
                            <div class="card">
                                <div>
                                    <img class="card-img-top" class="image"
                                        src="<?php echo base_url('./assets/img/' . $row->imagen); ?>"
                                        alt="<?php echo $row->nombre; ?>"
                                        style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title card_title"><?php echo $row->nombre; ?></h5>
                                    <p class="card-text p_puntos">
                                        <?php echo $row->tipo; ?> <br>
                                        Bs. <?php echo $row->precio; ?><br>
                                        <span class="stock">Unidades disponibles: <?php echo $row->stock; ?></span>
                                    </p>
                                    <div class="quantity-container">
                                        <h6>Cantidad</h6>
                                        <div class="quantity-controls">
                                            <button class="btn btn-decrease" style="color:white">-</button>
                                            <span class="quantity">0</span>
                                            <button class="btn btn-increase" style="color:white">+</button>
                                        </div>
                                    </div>
                                    <a href="#" class="red_button btn btn_puntos agregar-carrito" style="color:white"
                                        data-id="<?php echo $row->manteleria_id; ?>"
                                        title="Agregar <?php echo $row->nombre; ?> al carrito">
                                        Agregar al Servicio
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/material.min.js"></script>
    <script src="./js/ripples.min.js"></script>
    <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.btn-increase').click(function () {
                var quantitySpan = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantitySpan.text());
                var stockSpan = $(this).closest('.card-body').find('.stock');

                var currentStock = parseInt(stockSpan.text().split(": ")[1]);

                if (currentStock > 0) {
                    quantitySpan.text(currentQuantity + 1);
                    stockSpan.text("Unidades disponibles: " + (currentStock - 1));
                } else {
                    alert("No hay suficiente stock disponible.");
                }
            });

            $('.btn-decrease').click(function () {
                var quantitySpan = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantitySpan.text());
                var stockSpan = $(this).closest('.card-body').find('.stock');

                var currentStock = parseInt(stockSpan.text().split(": ")[1]);

                if (currentQuantity > 0) {
                    quantitySpan.text(currentQuantity - 1);
                    stockSpan.text("Unidades disponibles: " + (currentStock + 1));
                }
            });

            $('.agregar-carrito').click(function (e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var quantity = parseInt($(this).siblings('.quantity-container').find('.quantity').text());

                if (quantity > 0) {
                    window.location.href = "<?php echo site_url('Welcome/agregar_al_carrito/manteleria'); ?>/" + productId + "/" + quantity;
                } else {
                    alert('Por favor, selecciona una cantidad válida.');
                }
            });
        });
    </script>
</body>

</html>