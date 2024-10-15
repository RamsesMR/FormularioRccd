<?php
$numeroDocumento = $_POST['numeroDocumento'];


// Definir el directorio de subida
$directorio = 'uploads/' . $numeroDocumento;


// Verificar si el directorio ya existe, si no, crearlo
if (!is_dir($directorio)) {
    // Crear el directorio con permisos 0777
    if (mkdir($directorio, 0777, true)) {
        // Asignar permisos 0777 al directorio recién creado
        chmod($directorio, 0777);
    } else {
        die("Error al crear el directorio.");
    }
}

// Validar y subir la primera imagen (cara frontal del DNI)
if (isset($_FILES['dni_frontal'])) {
    $dni_frontal = $_FILES['dni_frontal'];

    // Verificar si el archivo es una imagen y que no supere los 5MB
    if ($dni_frontal['size'] > 5242880) { // 5MB = 5 * 1024 * 1024 bytes
        die("El archivo es demasiado grande. Tamaño máximo permitido es 5MB.");
    }

    $tipo = mime_content_type($dni_frontal['tmp_name']);
    if (!in_array($tipo, ['image/jpeg', 'image/png', 'image/gif'])) {
        die("El archivo debe ser una imagen (JPG, PNG, GIF).");
    }

    // Mover el archivo al directorio correcto
    $ruta_frontal = $directorio . '/dni_frontal.' . pathinfo($dni_frontal['name'], PATHINFO_EXTENSION);
    move_uploaded_file($dni_frontal['tmp_name'], $ruta_frontal);
}

// Validar y subir la segunda imagen (cara trasera del DNI)
if (isset($_FILES['dni_reverso'])) {
    $dni_reverso = $_FILES['dni_reverso'];

    // Verificar si el archivo es una imagen y que no supere los 5MB
    if ($dni_reverso['size'] > 5242880) { // 5MB = 5 * 1024 * 1024 bytes
        die("El archivo es demasiado grande. Tamaño máximo permitido es 5MB.");
    }

    $tipo = mime_content_type($dni_reverso['tmp_name']);
    if (!in_array($tipo, ['image/jpeg', 'image/png', 'image/gif'])) {
        die("El archivo debe ser una imagen (JPG, PNG, GIF).");
    }

    // Mover el archivo al directorio correcto
    $ruta_reverso = $directorio . '/dni_reverso.' . pathinfo($dni_reverso['name'], PATHINFO_EXTENSION);
    move_uploaded_file($dni_reverso['tmp_name'], $ruta_reverso);
}

?>
