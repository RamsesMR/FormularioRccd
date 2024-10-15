<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Obtener los datos enviados desde la petición AJAX
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$activo = $data['activo'];
$notas = isset($data['notas']) ? $data['notas'] : '';

// Verificar si el alumno ya está inactivo y se intenta activar
$sqlVerificacion = "SELECT activo FROM alumnos WHERE id = ?";
$stmtVerificacion = $conn->prepare($sqlVerificacion);
$stmtVerificacion->bind_param('i', $id);
$stmtVerificacion->execute();
$stmtVerificacion->bind_result($estadoActual);
$stmtVerificacion->fetch();
$stmtVerificacion->close();

if ($estadoActual == 0 && $activo == 1) {
    // Si el alumno está inactivo y se intenta activar, denegar la operación
    echo json_encode(['success' => false, 'message' => 'Un alumno desactivado no puede ser reactivado.']);
    exit();
}

// Preparar la consulta para actualizar el estado y las notas del alumno
$sql = "UPDATE alumnos SET activo = ?, notas = ? WHERE id = ?";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Vincular los parámetros y ejecutar la sentencia
$stmt->bind_param('isi', $activo, $notas, $id);

if ($stmt->execute()) {
    // Responder con éxito si la actualización fue exitosa
    echo json_encode(['success' => true]);
} else {
    // Responder con error si falló la actualización
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado']);
}

// Cerrar la conexión
$conn->close();
?>
