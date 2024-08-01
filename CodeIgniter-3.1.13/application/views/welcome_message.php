<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
    <title>Login con PHP y Sessions</title>
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

        .input-box {
            margin: 10px 0;
        }

        .input-box label {
            display: block;
            margin-bottom: 5px;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h1>"EL DETALLE EVENTOS"</h1>
    <main>
        <div class="container">
            <h2>Iniciar Sesión</h2>
            <hr>
            <?php if (isset($error)) : ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="<?php echo site_url('Welcome/validarusuariobd'); ?>" method="POST" id="login-form">
                <div class="input-box">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" placeholder="Escribe tu email" required />
                </div>
                <div class="input-box">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Introduce tu contraseña" required />
                </div>
                <button type="submit" form="login-form" value="Submit" class="boton">Ingresar</button>
                <p>
                    <label style="color: white;">¿No tienes usuario? Entonces puedes crear una cuenta </label><a href="<?php echo site_url('Welcome/registro') ?>" style="color: blue;">aquí</a>
                </p>
            </form>
        </div>
    </main>
</body>

</html>