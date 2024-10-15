<?php
session_start();
include('conexion.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: acceso_jefes.php');
    exit();
}

// Obtener el valor del centro del usuario
$centroUsuario = $_SESSION['centro'];

// Consulta para extraer los alumnos cuyo campo centro coincida con el del usuario autenticado
$sql = "SELECT nombre, apellidos, numero_documento FROM alumnos WHERE centro_formacion = '$centroUsuario'";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Alumnos del centro: <?php echo htmlspecialchars($centroUsuario); ?></h2>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Número de Documento</th>
                    <th>Validar</th>
                    <th>Rechazar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar los resultados si existen
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['numero_documento']) . "</td>";
                        echo '<td><button class="btn btn-success">Validar</button></td>';
                        echo '<td><button class="btn btn-danger">Rechazar</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No se encontraron alumnos para este centro</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
