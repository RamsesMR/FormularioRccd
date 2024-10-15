<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RCCD - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .custom-fieldset {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="header-custom text-white text-center py-3">
        <h1>Acceso jefes de sala</h1>
    </header>

    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>

        <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
        <?php if (isset($_GET['error']) && $_GET['error'] == '1') { ?>
            <div class="alert alert-danger text-center">Usuario o contraseña incorrectos</div>
        <?php } ?>

        <!-- Mostrar mensaje si el usuario no es jefe de sala -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 'jefe') { ?>
            <div class="alert alert-warning text-center">Este acceso es solo para jefes de sala</div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Formulario de acceso -->
                <form action="procesar_login.php" method="POST">
                    <fieldset class="custom-fieldset">
                        <legend class="text-center">Iniciar sesión</legend>
                        
                        <div class="mb-3 text-start">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="contrasena" required>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-custom-red btn-lg mt-4">Acceder</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 Dipaweb. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
