<?php
// APUNTANDO AL SERVIDOR LOCAL PARA HACER LAS PRUEBAS

// $servername = "localhost"; 
// $database = "formrccdmadrid";
// $username = "root";
// $password = "";

//APUNTANDO AL SERVIDOR REMOTO

$servername = "dat.dipaweb.net";
$database = "formrccdmadrid";
$username = "Formrccdmadrid";
$password = "PjfjDgUA16KUho7J";



// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
echo "Conexión a la base de datos exitosa";

// Cerrar la conexión
// mysqli_close($conn);
?>