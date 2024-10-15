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

// Variables de paginación
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 10;
$offset = ($pagina > 1) ? ($pagina - 1) * $limite : 0;

// Obtener los filtros de búsqueda y de estado
$dni = isset($_POST['dni']) ? $_POST['dni'] : '';
$filtro_estado = isset($_POST['estado']) ? $_POST['estado'] : '';

// Consulta base para los alumnos
$sql_base = "SELECT nombre, apellidos, numero_documento, activo, id FROM alumnos WHERE centro_formacion = '$centroUsuario'";

// Aplicar búsqueda por DNI si existe
if (!empty($dni)) {
    $sql_base .= " AND numero_documento LIKE '%$dni%'";
}

// Aplicar filtro por estado si existe
if ($filtro_estado !== '') {
    if ($filtro_estado == 'Pendiente') {
        $sql_base .= " AND activo IS NULL";
    } elseif ($filtro_estado == 'Validado') {
        $sql_base .= " AND activo = 1";
    } elseif ($filtro_estado == 'Desactivado') {
        $sql_base .= " AND activo = 0";
    }
}

// Agregar la limitación para la paginación
$sql_base .= " LIMIT $limite OFFSET $offset";

// Ejecutar la consulta
$resultado = $conn->query($sql_base);

// Obtener el total de alumnos para la paginación
$sql_total = "SELECT COUNT(*) as total FROM alumnos WHERE centro_formacion = '$centroUsuario'";
$total_alumnos = $conn->query($sql_total)->fetch_assoc()['total'];
$total_paginas = ceil($total_alumnos / $limite);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="header-custom text-white text-center py-3"></header>
    <div class="container mt-5">
        <h2 class="text-center">Alumnos/as del centro: <?php echo htmlspecialchars($centroUsuario); ?></h2><br>

        <!-- Formulario de búsqueda de alumno por DNI -->
        <div class="container mt-3">
            <form method="POST" action="panel.php">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" maxlength="9" class="form-control form-control-sm" name="dni" placeholder="Buscar DNI" value="<?php echo htmlspecialchars($dni); ?>">
                            <button class="btn btn-primary btn-sm" type="submit">Buscar por DNI</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Formulario de filtrado por estado -->
        <div class="container mt-3">
            <form method="POST" action="panel.php">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <select class="form-select form-select-sm" name="estado">
                                <option value="">Filtrar por estado</option>
                                <option value="Pendiente" <?php echo ($filtro_estado == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="Validado" <?php echo ($filtro_estado == 'Validado') ? 'selected' : ''; ?>>Validado</option>
                                <option value="Desactivado" <?php echo ($filtro_estado == 'Desactivado') ? 'selected' : ''; ?>>Desactivado</option>
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit">Filtrar por Estado</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de alumnos -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Número de Documento</th>
                    <th>Acción</th>
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

                        // Comprobar el estado del campo activo
                        echo '<td>';

                        if (is_null($fila['activo'])) {
                            echo '<button id="botonEnviar" value="' . $fila['id'] . '" onclick="enviarValor(this)" class="btn btn-success me-2">Validar</button>';
                            echo '<button id="botonRechazar" value="' . $fila['id'] . '" onclick="rechazarValor(this)" class="btn btn-danger">Rechazar</button>';
                        } elseif ($fila['activo'] == 1) {
                            echo '<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#desactivarModal" data-documento="' . htmlspecialchars($fila['numero_documento']) . '">Desactivar alumno</button>';
                        } elseif ($fila['activo'] == 0) {
                            echo '<span class="text-muted">Alumno/a desactivado/a</span>';
                        }

                        echo '</td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No se encontraron alumnos para este centro</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($pagina > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="panel.php?pagina=<?php echo $pagina - 1; ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                    <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                        <a class="page-link" href="panel.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina < $total_paginas) : ?>
                    <li class="page-item">
                        <a class="page-link" href="panel.php?pagina=<?php echo $pagina + 1; ?>" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Modal para desactivar alumno -->
        <div class="modal fade" id="desactivarModal" tabindex="-1" aria-labelledby="desactivarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="desactivarModalLabel">Desactivar Alumno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="desactivar_alumno.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="numero_documento" id="numeroDocumentoInput">
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo de la desactivación (máx. 200 caracteres):</label>
                                <textarea class="form-control" id="motivo" name="motivo" maxlength="200" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Desactivar Alumno</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para validar
        function enviarValor(e) {

            let botonVerificar = confirm("¿Deseas verificar al alumno?")

            if (botonVerificar) {

                let valor = e.value; // Capturar el valor del botón

                // Enviar el valor del botón al servidor con fetch
                fetch('panel.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            valor: valor,
                            accion: 'aprobar' // Acción para aprobar
                        }) // Convertir el valor en un objeto JSON
                    })
                    .then(response => response.text()) // Convertir respuesta a texto
                    .then(data => {
                        console.log(data); // Mostrar la respuesta en la consola
                        location.reload(); // Recargar la página después de la acción
                    })
                    .catch(error => console.error('Error:', error)); // Manejo de errores

            }

        }

        // Función para rechazar
        function rechazarValor(e) {

            let botonRechazar = confirm("¿Deseas Rechazar al alumno?")

            if (botonRechazar) {

                let valor2 = e.value; // Capturar el valor del botón

                // Enviar el valor del botón al servidor con fetch
                fetch('panel.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            valor: valor2,
                            accion: 'rechazar' // Acción para rechazar
                        }) // Convertir el valor en un objeto JSON
                    })
                    .then(response => response.text()) // Convertir respuesta a texto
                    .then(data => {
                        console.log(data); // Mostrar la respuesta en la consola
                        location.reload(); // Recargar la página después de la acción
                    })
                    .catch(error => console.error('Error:', error)); // Manejo de errores

            }

        }

        // Modal de desactivación
        var desactivarModal = document.getElementById('desactivarModal');
        desactivarModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var documento = button.getAttribute('data-documento');
            var inputDocumento = desactivarModal.querySelector('#numeroDocumentoInput');
            inputDocumento.value = documento;
        });
    </script>
</body>

</html>
<?php
// Asegúrate de iniciar la conexión a la base de datos aquí
include 'conexion.php';  // O el archivo donde esté la conexión $conn

// Recibir los datos enviados desde JavaScript
$data = file_get_contents('php://input');
$decoded = json_decode($data, true);

// Verificar si se recibieron los datos correctamente
if (isset($decoded['valor']) && isset($decoded['accion'])) {
    $valorRecibido = $decoded['valor'];
    $accion = $decoded['accion'];

    // Determinar la acción a realizar según el valor de 'accion'
    if ($accion == 'aprobar') {
        // Consulta para obtener los detalles del usuario y verificar si no ha sido asignado
        $sqlConsulta = $conn->prepare("SELECT usuario, contrasena, id FROM usuarios WHERE asignado = '0' AND jefe = '0' AND id = ?");
        $sqlConsulta->bind_param("i", $valorRecibido); // 'id' es un número entero
        $sqlConsulta->execute();
        $resultado = $sqlConsulta->get_result();

        // Verificar si hay usuarios no asignados
        if ($resultado->num_rows > 0) {
            // Obtener el primer resultado
            if ($fila = $resultado->fetch_assoc()) {
                $usuario = $fila["usuario"];
                $contrasena = $fila["contrasena"];
                $id = $fila["id"];

                // Actualizar estado de "asignado" en la tabla 'usuarios'
                $sqlUpdate = $conn->prepare("UPDATE usuarios SET asignado = 1 WHERE id = ? AND asignado = 0");
                $sqlUpdate->bind_param("i", $valorRecibido); // Usar el id

                if ($sqlUpdate->execute() === TRUE) {

                    // echo " - Estado actualizado a asignado";

                    $fechaAlta = date('Y-m-d');

                    // Actualizar tabla 'alumnos' y establecer 'activo' a 1
                    $sql1 = $conn->prepare("UPDATE alumnos SET usuario = ?, contrasena = ?, fecha_alta= ? ,activo = 1 WHERE id = ?");
                    $sql1->bind_param("sssi", $usuario, $contrasena,$fechaAlta, $valorRecibido); // Preparar los valores

                    if ($sql1->execute() === TRUE) {
                        echo "Datos guardados correctamente en la tabla alumnos.";
                    } else {
                        echo "Error al guardar los datos: " . $conn->error;
                    }
                } else {
                    echo " - Error al actualizar el estado de asignado: " . $conn->error;
                }
            }
        } else {
            echo "No hay usuarios no asignados.";
        }
    } elseif ($accion == 'rechazar') {
        // Borrar registro de la tabla 'alumnos'
        $sqlDelete = $conn->prepare("DELETE FROM alumnos WHERE id = ?");
        $sqlDelete->bind_param("i", $valorRecibido); // Usar el id

        if ($sqlDelete->execute() === TRUE) {
            echo "Registro de alumno eliminado correctamente.";
        } else {
            echo " - Error al borrar el registro: " . $conn->error;
        }

        // Actualizar el campo 'centro' de usuarios
        $sqlDelete2 = $conn->prepare("UPDATE usuarios SET centro = NULL, asignado=0 WHERE id = ?");
        $sqlDelete2->bind_param("i", $valorRecibido); // Usar el id

        if ($sqlDelete2->execute() === TRUE) {
            echo "Centro actualizado correctamente en la tabla usuarios.";
        } else {
            echo " - Error al actualizar el campo 'centro': " . $conn->error;
        }
    } else {
        echo "Acción no reconocida.";
    }
}
//else {
//   echo "No se recibió ningún valor o acción.";
//}

// Cerrar la conexión a la base de datos
$conn->close();
?>