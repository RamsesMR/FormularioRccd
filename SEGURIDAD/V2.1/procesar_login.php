<?php
// Incluir conexión a la base de datos
include('conexion.php');

// Comprobar si los datos han sido enviados por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $contrasena = $conn->real_escape_string($_POST['contrasena']);

    // Consulta para verificar el usuario, la contraseña y obtener el centro
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $resultado = $conn->query($sql);

    // Si se encuentra un registro coincidente
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        // Verificar si el campo jefe es igual a 1
        if ($fila['jefe'] == 1) {
            // Guardar centro y otros datos en la sesión
            $_SESSION['centro'] = $fila['centro'];
            $_SESSION['usuario'] = $usuario;
            
            // Redirigir a panel.php si el usuario es jefe
            header('Location: panel.php');
            exit();
        } else {
            // Mostrar mensaje de error si el usuario no es jefe
            header('Location: acceso_jefes.php?error=jefe');
            exit();
        }
    } else {
        // Redirigir de vuelta a acceso_jefes.php con un mensaje de error si el usuario o la contraseña son incorrectos
        header('Location: acceso_jefes.php?error=1');
        exit();
    }
} else {
    // Si no se accede a la página por POST, redirigir a acceso_jefes.php
    header('Location: acceso_jefes.php');
    exit();
}
