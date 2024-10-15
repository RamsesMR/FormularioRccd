<?php


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
        ?>
        <html>
             <head>
                 <style>
                     .centered-container {
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                     }
                     fieldset {
                         border: 2px solid #5d5d5d;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 300px;
                     }
                     legend {
                         color: #5d5d5d;
                         font-size: 24px;
                         font-weight: bold;
                     }
                     p {
                         color: #e30614;
                         font-size: 20px;
                         margin-bottom: 20px;
                         font-weight: bold;
                         font-family: Arial, Helvetica, sans-serif;
                     }
                     button {
                         background-color: #5d5d5d;
                         color: white;
                         border: none;
                         padding: 10px 20px;
                         font-size: 16px;
                         cursor: pointer;
                     }
                     button:hover {
                         background-color: #4c4c4c;
                     }
                 </style>
             </head>
             <body>
             <div class="centered-container">
                 <fieldset>
                     <legend>Aviso</legend>
                     <p>El usuario ya está registrado.</p>
                     <button onclick="window.location.href='formulario.php'">Volver al formulario</button>
                 </fieldset>
             </div>
             </body>
             </html>
         <?php
        exit();  // Es importante detener la ejecución del script después de la redirección
    } else {

        //iniciamos creando usuario consultando la tabla usuario
        // Consulta para obtener los usuarios no asignado

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

        $sql1 = "SELECT  id FROM usuarios WHERE asignado = '0' and jefe = '0' and centro IS NULL";

        $resultado = $conn->query($sql1);



        //asignamos el usuario de la tabla usuario a alumnos
        if ($resultado->num_rows > 0) {
            // Recorrer los usuarios no asignados
            while ($fila = $resultado->fetch_assoc()) {
                $id = $fila["id"];



                if ($conn->query($sql1) === TRUE) {
  
                   
                } else {
                    // echo "Error al guardar los datos: " . $conn->error;
                }
                break;
            }
        } else {
            // echo "No hay usuarios no asignados.";
        }


        // Crear la consulta para insertar los datos en la base de datos alumnos

        $sql1 = "INSERT INTO `alumnos`(`email`, `tipo_identidad`, `numero_documento`, `centro_formacion`, `nombre`, `apellidos`, `telefono`, `localidad`, `sexo`, `fecha_nacimiento`, `estudios`, `situacion_laboral`, `conocido` ,`renta_minima`, `notificaciones_email`,`consentimiento`, `fecha_registro`,`menor_edad`,`id`) VALUES (
                    '$email', '$tipoDocumento', '$numeroDocumento', '$centro', '$nombre', '$apellidos', '$telefono', '$localidad', '$sexo', 
                    '$fnacimiento', '$estudios', '$slaboral', '$comoconocido','$renta','$notificacionCorreo','$consentimiento','$fechaRegistro','$menorEdad','$id')";

        if ($conn->query($sql1) === TRUE) {
            ?>              
            <html>
            <head>
                <style>
                    .centered-container {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                    }
                    fieldset {
                        border: 2px solid #5d5d5d;
                        border-radius: 10px;
                        padding: 20px;
                        text-align: center;
                        width: 300px;
                    }
                    legend {
                        color: #5d5d5d;
                        font-size: 24px;
                        font-weight: bold;
                    }
                    p {
                        color: #e30614;
                        font-size: 20px;
                        margin-bottom: 20px;
                        font-weight: bold;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                </style>
           
                <!-- Redireccionar en 5 segundos a panel.php -->
                <meta http-equiv="refresh" content="5;url=index.php">
            </head>
            <body>
            <div class="centered-container">
                <fieldset>
                    <legend>Enhorabuena</legend>
                    <h1>Tu usuario ha sido registrado con éxito</h1>
                    <p>Acude a tu centro para finalizar el proceso</p>
                </fieldset>
            </div>
            </body>
            </html>
            <?php
        }



        $sqlUpdate = "UPDATE `usuarios` SET centro = '$centro'  WHERE id='$id'";

        if ($conn->query($sqlUpdate) === TRUE) {
           
            
            
        } else {
            echo " - Error al actualizar el estado de asignado: " . $conn->error;
        }


        // Cerrar la conexión
        $conn->close();
    }
} else {
    echo "Método no permitido.";
}
