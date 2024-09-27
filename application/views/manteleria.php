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
            <!--SideBar Title -->
            <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
                EL DETALLE <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
            </div>
            <!-- SideBar User info -->
            <div class="full-box dashboard-sideBar-UserInfo">
                <figure class="full-box">
                    <img src="../../assets/img/StudetMaleAvatar.png" alt="UserIcon"> <!-- Imagen de avatar -->
                    <figcaption class="text-center text-titles">
                        <li class="user-info">
                            <h6>Bienvenido</h6>
                            <span class="user-name" style="font-size:20px"> <?= $nombre; ?></span>
                        </li>
                    </figcaption>
                </figure>

                <ul class="full-box list-unstyled text-center">
                    <li>
                        <a href="<?php echo site_url('Welcome/inicio'); ?>" title="Inicio" class="btn-user">
                            <img src="../../assets/img/hogar.png">
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Mis Reservas" class="btn-user">
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
    <section class="full-box dashboard-contentPage" id="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <h1 class="titulo">"Manteleria"</h1>
                    <?php foreach ($manteleria as $row) { ?>
                        <div class="col-12 col-md-4 mt-5 text-center Products">
                            <div class="card">
                                <div class="card-image">
                                    <img class="card-img-top"
                                        src="<?php echo base_url('./assets/img/' . $row['imagen']); ?>"
                                        alt="<?php echo $row['nombre']; ?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                                    <p class="card-text"><?php echo $row['tipo']; ?></p>
                                    <p class="card-text">Bs. <?php echo $row['precio']; ?></p>
                                    <p class="card-text p_puntos">
                                        <span class="stock" style="color:white">Manteles disponibles:
                                            <span class="available-stock"><?php echo $row['stock']; ?></span>
                                        </span>
                                    </p>
                                    <div class="quantity-container">
                                        <h6>Cantidad Manteles</h6>
                                        <div class="quantity-controls">
                                            <button class="btn btn-decrease" style="color:white"
                                                onclick="decreaseQuantity(this, <?php echo $row['stock']; ?>)">-</button>
                                            <span class="quantity">0</span>
                                            <button class="btn btn-increase" style="color:white"
                                                onclick="increaseQuantity(this, <?php echo $row['stock']; ?>)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Enlace para agregar al carrito con la cantidad seleccionada -->
                                <form
                                    action="<?php echo site_url('Welcome/agregar_al_carrito/manteleria/' . $row['manteleria_id']); ?>"
                                    method="post" onsubmit="updateQuantityInput(this)">
                                    <input type="hidden" name="cantidad" class="input-cantidad" value="0">
                                    <!-- Este valor será actualizado por JS -->
                                    <button type="submit" class="btn"
                                        title="Agregar <?php echo $row['nombre']; ?> al carrito" style="color:white">
                                        Agregar al Servicio
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
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
        function updateQuantityInput(form) {
            let quantityElement = form.closest('.card').querySelector('.quantity'); // El span que contiene la cantidad seleccionada
            let quantityInput = form.querySelector('.input-cantidad'); // El input oculto que enviará el valor

            quantityInput.value = parseInt(quantityElement.textContent); // Actualiza el valor del input oculto con la cantidad seleccionada
        }
        function increaseQuantity(button, maxStock) {
            let quantityElement = button.previousElementSibling; // El span que contiene la cantidad seleccionada
            let stockElement = button.closest('.card-body').querySelector('.available-stock'); // El span que contiene los manteles disponibles
            let quantityInput = button.closest('.card-body').querySelector('.input-cantidad'); // El input oculto que se enviará en el formulario

            let quantity = parseInt(quantityElement.textContent); // Cantidad seleccionada actual
            let availableStock = parseInt(stockElement.textContent); // Manteles disponibles actuales

            if (availableStock > 0) {
                quantityElement.textContent = quantity + 1; // Incrementar la cantidad visualmente
                stockElement.textContent = availableStock - 1; // Disminuir el stock visualmente
                quantityInput.value = quantity + 1; // Actualizar el valor del input oculto
            } else {
                alert("No hay suficiente stock disponible.");
            }
        }

        function decreaseQuantity(button, maxStock) {
            let quantityElement = button.nextElementSibling; // El span que contiene la cantidad seleccionada
            let stockElement = button.closest('.card-body').querySelector('.available-stock'); // El span que contiene los manteles disponibles
            let quantityInput = button.closest('.card-body').querySelector('.input-cantidad'); // El input oculto que se enviará en el formulario

            let quantity = parseInt(quantityElement.textContent); // Cantidad seleccionada actual
            let availableStock = parseInt(stockElement.textContent); // Manteles disponibles actuales

            if (quantity > 0) {
                quantityElement.textContent = quantity - 1; // Disminuir la cantidad visualmente
                stockElement.textContent = availableStock + 1; // Incrementar el stock visualmente
                quantityInput.value = quantity - 1; // Actualizar el valor del input oculto
            }
        }

    </script>
</body>

</html>