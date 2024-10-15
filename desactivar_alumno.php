<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroDocumento = $conn->real_escape_string($_POST['numero_documento']);
    $motivo = $conn->real_escape_string($_POST['motivo']);

    // Actualizar el campo activo a 0 y guardar el motivo en el campo notas
    $sql = "UPDATE alumnos SET activo = 0, notas = '$motivo' WHERE numero_documento = '$numeroDocumento'";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta al panel después de la desactivación
        header('Location: panel.php');
        exit();
    } else {
        echo "Error al desactivar el alumno: " . $conn->error;
    }
} else {
    // Si no se accede por POST, redirigir al panel
    header('Location: panel.php');
    exit();
}
?>
