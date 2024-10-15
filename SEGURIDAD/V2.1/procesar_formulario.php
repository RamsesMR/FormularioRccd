<?php

echo "El archivo PHP se ejecutó correctamente";
// Incluir el archivo de conexión a la base de datos
include('conexion.php');





// Verificar que los datos hayan sido enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por el formulario mediante POST
    $email = $conn->real_escape_string($_POST['email']);
    $tipoDocumento = $conn->real_escape_string($_POST['tipoDocumento']);
    $numeroDocumento = $conn->real_escape_string($_POST['numeroDocumento']);
    $centro = $conn->real_escape_string($_POST['centro']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellidos = $conn->real_escape_string($_POST['apellidos']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $localidad = $conn->real_escape_string($_POST['localidad']);
    $sexo = $conn->real_escape_string($_POST['sexo']);
    $fnacimiento = $conn->real_escape_string($_POST['fnacimiento']);
    $estudios = $conn->real_escape_string($_POST['estudios']);
    $slaboral = $conn->real_escape_string($_POST['slaboral']);
    $comoconocido = $conn->real_escape_string($_POST['comoconocido']);
    $menorEdad;


    //aqui vamos a verificar el que dni que el usuario ingreso en el formulario no haya concidencia en la base que datos alumnos
    //si esta registrado dara un 
    $sqlConsulta = "SELECT numero_documento FROM alumnos WHERE numero_documento = '$numeroDocumento'";
    $resultado = $conn->query($sqlConsulta);

    if ($resultado->num_rows > 0) {
        // Si el DNI ya existe
        echo "El usuario ya está registrado";
        header("Location: formulario.php");
        exit();  // Es importante detener la ejecución del script después de la redirección
    } else {

        //iniciamos creando usuario consultando la tabla usuario
        // Consulta para obtener los usuarios no asignados
        $sqlConsulta = "SELECT usuario, contrasena FROM usuarios WHERE asignado = '0' and jefe = '0'";
        $resultado = $conn->query($sqlConsulta);

        if ($resultado->num_rows > 0) {
            // Recorrer los usuarios no asignados
            while ($fila = $resultado->fetch_assoc()) {
                $usuario = $fila["usuario"];
                $contrasena = $fila["contrasena"];

             

                    // Después de crear el nuevo usuario, actualiza el campo 'asignado' a 1 en la tabla original
                    $sqlUpdate = "UPDATE usuarios SET asignado = '1', centro ='$centro' WHERE usuario = '$usuario' and contrasena='$contrasena'";

                    if ($conn->query($sqlUpdate) === TRUE) {
                        echo " - Estado actualizado a asignado";
                        break;
                    } else {
                        echo " - Error al actualizar el estado de asignado: " . $conn->error;
                    }


                   
                
            }
        } else {
            echo "No hay usuarios no asignados.";
        } //fin de crear usuario


        if ($_POST['menoredad'] == "si") {
            $menorEdad = "si";
        } else {
            $menorEdad = "no";
        }

        $renta = "";
        if (($_POST['rminima']) == "si") {
            $renta = "si";
        } else {
            $renta = "no";
        }


        $fechaRegistro = $fecha_envio = date('Y-m-d H:i:s');

        $notificacionCorreo;

        if (isset($_POST['boletin'])) {

            $notificacionCorreo = "si";
        } else {
            $notificacionCorreo = "no";
        }

        $consentimiento;

        if (isset($_POST['consentimiento'])) {
            $consentimiento = "si";
        } else {
            $consentimiento = "no";
        }

        


        // Crear la consulta para insertar los datos en la base de datos alumnos

        $sql1 = "INSERT INTO `alumnos`(`email`, `tipo_identidad`, `numero_documento`, `centro_formacion`, `nombre`, `apellidos`, `telefono`, `localidad`, `sexo`, `fecha_nacimiento`, `estudios`, `situacion_laboral`, `conocido` ,`renta_minima`, `notificaciones_email`,`consentimiento`, `fecha_registro`,`usuario`,`contrasena`,`menor_edad`) VALUES (
                    '$email', '$tipoDocumento', '$numeroDocumento', '$centro', '$nombre', '$apellidos', '$telefono', '$localidad', '$sexo', 
                    '$fnacimiento', '$estudios', '$slaboral', '$comoconocido','$renta','$notificacionCorreo','$consentimiento','$fechaRegistro','$usuario','$contrasena','$menorEdad')";

        if ($conn->query($sql1) === TRUE) {
            echo "Datos guardados correctamente en la tabla alumnos.";
        } else {
            echo "Error al guardar los datos: " . $conn->error;
        }

    

        // Cerrar la conexión
        $conn->close();
    }
} else {
    echo "Método no permitido.";
}
