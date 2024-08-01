<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
    <title>Registro de usuario</title>
    <style>
        img {
            display: block;
            margin: 0 auto;
        }

        h1 {
            position: absolute;
            top: 100px;
            right: 100px;
            color: white;
            font-size: 70px;
            font-family: 'Forte', sans-serif;
        }

        h2 {
            text-align: center;
            color: white;
            font-size: 40px;
            font-family: 'Forte', sans-serif;
        }

        .boton {
            background-color: transparent;
            border-color: aqua;
            width: 100%;
            height: 45px;
            color: white;
            font-family: 'Arial', sans-serif;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 10px;
        }

        .boton:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <main>
        <h1>"EL DETALLE EVENTOS"</h1>
        <div class="container">
            <h2>Registro Nuevo Usuario</h2>
            <hr>
            <form action="<?php echo site_url('Welcome/registrarusuariobd'); ?>" method="POST" id="login-form">
                <div class="input-box">
                    <label for="usuario">Usuario:</label>
                    <input type="email" name="usuario" id="usuario" placeholder="Introduce tu correo electrónico" required />
                </div>
                <div class="input-box">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Introduce tu contraseña" required />
                </div>
                <div class="input-box">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" required />
                </div>
                <div class="input-box">
                    <label for="primerApellido">Primer Apellido:</label>
                    <input type="text" name="primerApellido" id="primerApellido" placeholder="Introduce tu primer apellido" required />
                </div>
                <div class="input-box">
                    <label for="segundoApellido">Segundo Apellido:</label>
                    <input type="text" name="segundoApellido" id="segundoApellido" placeholder="Introduce tu segundo apellido" />
                </div>
                <div class="input-box">
                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" id="celular" placeholder="Introduce tu número de celular" required />
                </div>
                <button type="submit" form="login-form" value="Submit" class="boton">Registrar</button>
            </form>
            <?php if(isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if(isset($success)): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>
            <a href="<?php echo site_url('Welcome/index') ?>" class="boton">Volver</a>
        </div>
    </main>
</body>

</html>
