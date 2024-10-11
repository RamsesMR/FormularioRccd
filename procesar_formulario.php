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

                function crearUsuario()
                {
                    $getNombreEmail = '';
                    $getApellidoEmail = '';

                    $apellidoCantidad = str_word_count(($_POST['apellidos']));
                    $nombreCantidad = str_word_count(($_POST['nombre']));

                    if ($apellidoCantidad >= 1) {


                        $apellidousuario = str_word_count(($_POST['apellidos']), 1);

                        $getApellidoEmail = $apellidousuario[0];
                    }
                    //  elseif ($apellidoCantidad >= 2) {

                    //     $apellidousuario = str_word_count(($_POST['apellidos']), 1);

                    //     $getApellidoEmail = $apellidousuario[0] . "." . $apellidousuario[1];
                    // }

                    if ($nombreCantidad >= 1) {

                        $nombreUsuario = str_word_count(($_POST['nombre']), 1);

                        $getNombreEmail = $nombreUsuario[0] . ".";
                    }
                    // elseif ($nombreCantidad >= 2) {

                    //     $nombreUsuario = str_word_count(($_POST['nombre']), 1);
                    //     $getNombreEmail = $nombreUsuario[0] . "." . $nombreUsuario[1] . ".";
                    // }

                    return $getNombreEmail . $getApellidoEmail . "@rccdmadrid.es";
                }

                $usuario = crearUsuario();


                //consultaremos primero la tabla USUARIOS donde se encuentra la informacion de los usuarios por aprobar por los centros 
                $sqlConsulta = "SELECT usuario FROM usuarios";
                $resultado = $conn->query($sqlConsulta);


                if ($resultado->num_rows > 0) {
                    // Recorrer los resultados de usuarios existentes
                    while ($fila = $resultado->fetch_assoc()) {
                        // Comprobamos si el usuario ya existe
                        if ($fila["usuario"] == $usuario) {
                            $contador = 1; // Inicializamos un contador


                            while (true) {

                                $usuarioSinDominio = str_replace("@rccdmadrid.es", "", $usuario);

                                //le quitamos el contador
                                if (preg_match('/[0-9]+$/', $usuarioSinDominio)) {

                                    $usuarioSinDominio = preg_replace('/[0-9]+$/', $contador, $usuarioSinDominio);
                                } else {

                                    $usuarioSinDominio = $usuarioSinDominio . $contador;
                                }

                                // Añadimos de nuevo el dominio
                                $usuarioNuevo = $usuarioSinDominio . "@rccdmadrid.es";

                                // Verificamos si el nuevo usuario ya existe en la base de datos
                                $sqlCheckUsuario = "SELECT usuario FROM alumnos WHERE usuario = '$usuarioNuevo'";
                                $resultadoCheck = $conn->query($sqlCheckUsuario);

                                // Si no existe el nuevo usuario, actualizamos el valor de $usuario y salimos del bucle
                                if ($resultadoCheck->num_rows == 0) {
                                    $usuario = $usuarioNuevo;
                                    break;
                                }


                                $contador++;
                            }
                        }
                    }
                }


                //consulta la table ALUMNOS donde enviara toda la informacion del formulario para traernos informacion de los usuario y verificar que no hayan usuarios duplicados al momento de crear un usuario
                $sqlConsulta = "SELECT usuario FROM alumnos";
                $resultado = $conn->query($sqlConsulta);


                if ($resultado->num_rows > 0) {
                    // Recorrer los resultados de usuarios existentes
                    while ($fila = $resultado->fetch_assoc()) {
                        // Comprobamos si el usuario ya existe
                        if ($fila["usuario"] == $usuario) {
                            $contador = 1; // Inicializamos un contador


                            while (true) {

                                $usuarioSinDominio = str_replace("@rccdmadrid.es", "", $usuario);

                                //le quitamos el contador
                                if (preg_match('/[0-9]+$/', $usuarioSinDominio)) {

                                    $usuarioSinDominio = preg_replace('/[0-9]+$/', $contador, $usuarioSinDominio);
                                } else {

                                    $usuarioSinDominio = $usuarioSinDominio . $contador;
                                }

                                // Añadimos de nuevo el dominio
                                $usuarioNuevo = $usuarioSinDominio . "@rccdmadrid.es";

                                // Verificamos si el nuevo usuario ya existe en la base de datos
                                $sqlCheckUsuario = "SELECT usuario FROM alumnos WHERE usuario = '$usuarioNuevo'";
                                $resultadoCheck = $conn->query($sqlCheckUsuario);

                                // Si no existe el nuevo usuario, actualizamos el valor de $usuario y salimos del bucle
                                if ($resultadoCheck->num_rows == 0) {
                                    $usuario = $usuarioNuevo;
                                    break;
                                }


                                $contador++;
                            }
                        }
                    }
                }


                // $usuario= crearUsuario();

                // Crear la consulta para insertar los datos en la base de datos


                $sql = "INSERT INTO `alumnos`(`email`, `tipo_identidad`,`numero_documento`, `centro_formacion`, `nombre`, `apellidos`, `telefono`, `localidad`, `sexo`, `fecha_nacimiento`, `estudios`, `situacion_laboral`, `conocido` ,`renta_minima`, `notificaciones_email`,`consentimiento`, `fecha_registro`,`usuario`,`menor_edad`) VALUES (
                    '$email', '$tipoDocumento', '$numeroDocumento', '$centro', '$nombre', '$apellidos', '$telefono', '$localidad', '$sexo', 
                    '$fnacimiento', '$estudios', '$slaboral', '$comoconocido','$renta','$notificacionCorreo','$consentimiento','$fechaRegistro','$usuario','$menorEdad')";


                // Ejecutar la consulta
                if ($conn->query($sql) === TRUE) {
                    echo "Datos guardados correctamente.";
                } else {
                    echo "Error al guardar los datos: " . $conn->error;
                }

                // Cerrar la conexión
                $conn->close();
            }
        }
    
 else {
    echo "Método no permitido.";
}
