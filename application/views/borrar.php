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
                            <button type="button" class="btn btn-proceed" data-toggle="modal"
                                data-target="#reservationModal">
                                Proceder con la Solicitud
                            </button>
                        </div>
                    <?php else: ?>
                        <p style="color:white">El carrito está vacío.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>