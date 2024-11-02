<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
    <title>Verificación de Email</title>
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
            <h2>Verificación de Email</h2>
            <hr>
            <div class="input-box">
                <label for="usuario">Usuario:</label>
                <input type="email" name="usuario" id="usuario" placeholder="Introduce tu correo electrónico"
                    required />
                <button type="button" onclick="verificarEmail()" id="btn-verificar" class="boton-verificar">Verificar
                    Email</button>
            </div>

            <div id="codigo-verificacion" style="display: none;">
                <label for="codigo">Código de verificación:</label>
                <input type="text" name="codigo_verificacion" id="codigo_verificacion"
                    placeholder="Introduce el código enviado a tu correo" />
                <button type="button" onclick="verificarCodigo()" class="boton-verificar">Verificar Código</button>
            </div>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <a href="<?php echo site_url('Welcome/index') ?>" class="boton">Volver</a>
        </div>
    </main>

    <script>
        function verificarEmail() {
            const email = document.getElementById('usuario').value;

            document.getElementById('usuario').disabled = true;
            document.getElementById('btn-verificar').disabled = true;

            fetch('<?php echo site_url('Welcome/validarCorreo'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'usuario=' + encodeURIComponent(email)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Se ha enviado un código de verificación a tu correo: ' + data.debug_code);
                        document.getElementById('codigo-verificacion').style.display = 'block';
                    } else {
                        alert('Error: ' + data.message);
                        document.getElementById('usuario').disabled = false;
                        document.getElementById('btn-verificar').disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al verificar el correo');
                    document.getElementById('usuario').disabled = false;
                    document.getElementById('btn-verificar').disabled = false;
                });
        }

        function verificarCodigo() {
            const codigo = document.getElementById('codigo_verificacion').value;

            fetch('<?php echo site_url('Welcome/verificarCodigo'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'codigo=' + encodeURIComponent(codigo)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        window.location.href = '<?php echo site_url('Welcome/registro_form'); ?>';
                    } else {
                        alert('Error: ' + data.message + '\nPor favor, intente nuevamente');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al verificar el código');
                });
        }
    </script>
</body>

</html>