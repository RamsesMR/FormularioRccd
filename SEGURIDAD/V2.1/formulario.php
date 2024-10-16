<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro RCCD</title>
    <!-- Cargar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cargar nuestro CSS personalizado -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 text-black text-center mb-4">Regístrate y comienza tu formación</h1>
                <form id="formulario" action="procesar_formulario.php" method="POST" enctype="multipart/form-data">
                    <!-- Sección para la cuenta -->
                    <h2 class="section-title">Información para la cuenta</h2>
                    <div class="row mb-2 mb-md-3">
                        <!-- Campo de Correo Electrónico -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="email" class="form-label">Correo Electrónico <span
                                    class="asterisk">*</span></label>
                            <input type="email"  onchange="corregirTexto(this)" class="form-control" id="email" name="email"
                                placeholder="Introduce tu email" required>
                                <span id="error-email" class="mensaje-error"></span>
                            <div class="invalid-feedback">
                                Por favor, introduce un correo válido.
                            </div>
                        </div>
                        <!-- Campo de Tipo de Documento -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="tipoDocumento" class="form-label">Tipo de Documento <span
                                    class="asterisk">*</span></label>
                            <select class="form-select" id="tipoDocumento" name="tipoDocumento" required>
                                <option selected disabled value="">Selecciona...</option>
                                <option value="dni">DNI</option>
                                <option value="pasaporte">Pasaporte</option>
                                <option value="nie">NIE</option>
                            </select>
                            <span class="mensaje-error" id="errorTipoDocumento"></span>
                            <div class="invalid-feedback">
                                Selecciona un tipo de documento válido.
                            </div>
                        </div>
                        <!-- Campo de Número de Documento -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="numeroDocumento" class="form-label">Número de Documento <span
                                    class="asterisk">*</span></label>
                            <input type="text" onchange="corregirTexto(this)" maxlength="9"  class="form-control" id="numeroDocumento" name="numeroDocumento"
                                placeholder="Introduce el número" required>

                                <span class="mensaje-error" id="numdoc-error"></span>
                            <div class="invalid-feedback">
                                Por favor, introduce un número de documento válido.
                            </div>
                        </div>
                    </div>
                <div class="row mb-2 mb-md-3">
                    <!-- Campo de Localidad -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="centro" class="form-label">Centro donde te vas a matricular: <span
                                class="asterisk">*</span></label>
                        <select id="centro"  name="centro" class="form-select" required="">
                            <option selected="" value="">Selecciona centro</option>
                            <option value="Aranjuez">Aranjuez</option>
                            <option value="Ciempozuelos">Ciempozuelos</option>
                            <option value="Fuente el Saz de Jarama">Fuente el Saz de Jarama</option>
                            <option value="Loeches">Loeches</option>
                            <option value="Molinos (Los)">Molinos (Los)</option>
                            <option value="Moralzarzal">Moralzarzal</option>
                            <option value="Mostoles">Móstoles</option>
                            <option value="Navacerrada">Navacerrada</option>
                            <option value="Pedrezuela">Pedrezuela</option>
                            <option value="Perales de Tajuña">Perales de Tajuña</option>
                            <option value="San Agustin del Guadalix">San Agustín del Guadalix</option>
                            <option value="Valdelaguna">Valdelaguna</option>
                            <option value="Valdetorres de Jarama">Valdetorres de Jarama</option>
                            <option value="Venturada">Venturada</option>
                            <option value="Villamanrique de Tajo">Villamanrique de Tajo</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un centro.
                        </div>
                    </div>
                     <!-- Campo de Edad -->
                            <div class="col-md-6">
                                <label class="form-label">¿Tienes menos de 18 años? <span
                                        class="asterisk">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="menoredad" id="menoredad_si"
                                        value="si" required>
                                    <label class="form-check-label" for="menoredad_si">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="menoredad" id="menoredad_no"
                                        value="no" required>
                                    <label class="form-check-label" for="menoredad_no">
                                        No
                                    </label>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, selecciona una opción.
                                </div>
                            </div>
                        </div>
                    <!-- Campos de Contraseña 
                    <div class="row mb-3" >
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="password" class="form-label">Contraseña <span class="asterisk">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu contraseña" required>
                            <div class="invalid-feedback">
                                Por favor, introduce una contraseña válida.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="confirmPassword" class="form-label">Confirmar Contraseña <span class="asterisk">*</span></label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirma tu contraseña" required>
                            <div class="invalid-feedback">
                                Las contraseñas no coinciden.
                            </div>
                        </div>
                    </div>-->

                    <!-- Leyenda de condiciones de la contraseña 
                    <div class="mb-3">
                        <p class="password-hint text-muted">
                            * Tu contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número. Evita usar caracteres especiales como &, $, @, -, +, %, *, o espacios.
                        </p>
                    </div>-->

                    <div class="mb-5"></div> <!-- Separación entre secciones -->

                    <!-- Sección Datos personales -->
                    <h2 class="section-title">Datos personales</h2>
                    <div class="row mb-2 mb-md-3">
                        <!-- Campo de Nombre -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="nombre" class="form-label">Nombre <span class="asterisk">*</span></label>
                            <input type="text" onchange="corregirTexto(this)" class="form-control" id="nombre" name="nombre"
                                placeholder="Introduce tu nombre" required>
                            <div class="invalid-feedback">
                                Por favor, introduce tu nombre.
                            </div>
                        </div>
                        <!-- Campo de Apellidos -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="apellidos" class="form-label">Apellidos <span class="asterisk">*</span></label>
                            <input type="text" onchange="corregirTexto(this)" class="form-control" id="apellidos" name="apellidos"
                                placeholder="Introduce tus apellidos" required>
                            <div class="invalid-feedback">
                                Por favor, introduce tus apellidos.
                            </div>
                        </div>
                        <!-- Campo de Teléfono o móvil de contacto -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="telefono" class="form-label">Teléfono o móvil de contacto <span class="asterisk">*</span></label>
                            <input type="tel"  class="form-control" id="telefono" name="telefono" placeholder="+34"
                                maxlength="9"  pattern="[0-9]{9}" required inputmode="numeric">
                                <span class="mensaje-error" id="tel-error"></span>
                            <div class="invalid-feedback">
                                Por favor, introduce un número de teléfono válido de 9 dígitos.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 mb-md-3">
                        <!-- Campo de Localidad -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="localidad" class="form-label">Localidad <span class="asterisk">*</span></label>
                            <select id="localidad" name="localidad" class="form-select" required="">
                                <option selected="" value="">Selecciona una</option>
                                <option value="Otros">Otros</option>
                                <option value="Acebeda (La)">Acebeda (La)</option>
                                <option value="Ajalvir">Ajalvir</option>
                                <option value="Alameda del Valle">Alameda del Valle</option>
                                <option value="Alamo (El)">Alamo (El)</option>
                                <option value="Alcala de Henares">Alcalá de Henares</option>
                                <option value="Alcobendas">Alcobendas</option>
                                <option value="Alcorcon">Alcorcón</option>
                                <option value="Aldea del Fresno">Aldea del Fresno</option>
                                <option value="Algete">Algete</option>
                                <option value="Alpedrete">Alpedrete</option>
                                <option value="Ambite">Ambite</option>
                                <option value="Anchuelo">Anchuelo</option>
                                <option value="Aranjuez">Aranjuez</option>
                                <option value="Arganda del Rey">Arganda del Rey</option>
                                <option value="Arroyomolinos">Arroyomolinos</option>
                                <option value="Atazar (El)">Atazar (El)</option>
                                <option value="Batres">Batres</option>
                                <option value="Becerril de la Sierra">Becerril de la Sierra</option>
                                <option value="Belmonte de Tajo">Belmonte de Tajo</option>
                                <option value="Berzosa del Lozoya">Berzosa del Lozoya</option>
                                <option value="Berrueco (El)">Berrueco (El)</option>
                                <option value="Boadilla del Monte">Boadilla del Monte</option>
                                <option value="Boalo (El)">Boalo (El)</option>
                                <option value="Braojos">Braojos</option>
                                <option value="Brea de Tajo">Brea de Tajo</option>
                                <option value="Brunete">Brunete</option>
                                <option value="Buitrago del Lozoya">Buitrago del Lozoya</option>
                                <option value="Bustarviejo">Bustarviejo</option>
                                <option value="Cabanillas de la Sierra">Cabanillas de la Sierra</option>
                                <option value="Cabrera (La)">Cabrera (La)</option>
                                <option value="Cadalso de los Vidrios">Cadalso de los Vidrios</option>
                                <option value="Camarma de Esteruelas">Camarma de Esteruelas</option>
                                <option value="Campo Real">Campo Real</option>
                                <option value="Canencia">Canencia</option>
                                <option value="Carabana">Carabaña</option>
                                <option value="Casarrubuelos">Casarrubuelos</option>
                                <option value="Cenicientos">Cenicientos</option>
                                <option value="Cercedilla">Cercedilla</option>
                                <option value="Cervera de Buitrago">Cervera de Buitrago</option>
                                <option value="Ciempozuelos">Ciempozuelos</option>
                                <option value="Cobena">Cobeña</option>
                                <option value="Colmenar del Arroyo">Colmenar del Arroyo</option>
                                <option value="Colmenar de Oreja">Colmenar de Oreja</option>
                                <option value="Colmenarejo">Colmenarejo</option>
                                <option value="Colmenar Viejo">Colmenar Viejo</option>
                                <option value="Collado Mediano">Collado Mediano</option>
                                <option value="Collado Villalba">Collado Villalba</option>
                                <option value="Corpa">Corpa</option>
                                <option value="Coslada">Coslada</option>
                                <option value="Cubas de la Sagra">Cubas de la Sagra</option>
                                <option value="Chapineria">Chapinería</option>
                                <option value="Chinchon">Chinchón</option>
                                <option value="Daganzo de Arriba">Daganzo de Arriba</option>
                                <option value="Escorial (El)">Escorial (El)</option>
                                <option value="Estremera">Estremera</option>
                                <option value="Fresnedillas de la Oliva">Fresnedillas de la Oliva</option>
                                <option value="Fresno de Torote">Fresno de Torote</option>
                                <option value="Fuenlabrada">Fuenlabrada</option>
                                <option value="Fuente el Saz de Jarama">Fuente el Saz de Jarama</option>
                                <option value="Fuentiduena de Tajo">Fuentidueña de Tajo</option>
                                <option value="Galapagar">Galapagar</option>
                                <option value="Garganta de los Montes">Garganta de los Montes</option>
                                <option value="Gargantilla del Lozoya y Pinilla de Buitrago">Gargantilla del Lozoya y
                                    Pinilla de
                                    Buitrago</option>
                                <option value="Gascones">Gascones</option>
                                <option value="Getafe">Getafe</option>
                                <option value="Grinon">Griñón</option>
                                <option value="Guadalix de la Sierra">Guadalix de la Sierra</option>
                                <option value="Guadarrama">Guadarrama</option>
                                <option value="Hiruela (La)">Hiruela (La)</option>
                                <option value="Horcajo de la Sierra-Aoslos">Horcajo de la Sierra-Aoslos</option>
                                <option value="Horcajuelo de la Sierra">Horcajuelo de la Sierra</option>
                                <option value="Hoyo de Manzanares">Hoyo de Manzanares</option>
                                <option value="Humanes de Madrid">Humanes de Madrid</option>
                                <option value="Leganes">Leganés</option>
                                <option value="Loeches">Loeches</option>
                                <option value="Lozoya">Lozoya</option>
                                <option value="Madarcos">Madarcos</option>
                                <option value="Madrid ">Madrid </option>
                                <option value="Majadahonda">Majadahonda</option>
                                <option value="Manzanares el Real">Manzanares el Real</option>
                                <option value="Meco">Meco</option>
                                <option value="Mejorada del Campo">Mejorada del Campo</option>
                                <option value="Miraflores de la Sierra">Miraflores de la Sierra</option>
                                <option value="Molar (El)">Molar (El)</option>
                                <option value="Molinos (Los)">Molinos (Los)</option>
                                <option value="Montejo de la Sierra">Montejo de la Sierra</option>
                                <option value="Moraleja de Enmedio">Moraleja de Enmedio</option>
                                <option value="Moralzarzal">Moralzarzal</option>
                                <option value="Morata de Tajuna">Morata de Tajuña</option>
                                <option value="Mostoles">Móstoles</option>
                                <option value="Navacerrada">Navacerrada</option>
                                <option value="Navalafuente">Navalafuente</option>
                                <option value="Navalagamella">Navalagamella</option>
                                <option value="Navalcarnero">Navalcarnero</option>
                                <option value="Navarredonda y San Mames">Navarredonda y San Mamés</option>
                                <option value="Navas del Rey">Navas del Rey</option>
                                <option value="Nuevo Baztan">Nuevo Baztán</option>
                                <option value="Olmeda de las Fuentes">Olmeda de las Fuentes</option>
                                <option value="Orusco de Tajuna">Orusco de Tajuña</option>
                                <option value="Paracuellos de Jarama">Paracuellos de Jarama</option>
                                <option value="Parla">Parla</option>
                                <option value="Patones">Patones</option>
                                <option value="Pedrezuela">Pedrezuela</option>
                                <option value="Pelayos de la Presa">Pelayos de la Presa</option>
                                <option value="Perales de Tajuna">Perales de Tajuña</option>
                                <option value="Pezuela de las Torres">Pezuela de las Torres</option>
                                <option value="Pinilla del Valle">Pinilla del Valle</option>
                                <option value="Pinto">Pinto</option>
                                <option value="Pinuecar-Gandullas">Piñuecar-Gandullas</option>
                                <option value="Pozuelo de Alarcon">Pozuelo de Alarcón</option>
                                <option value="Pozuelo del Rey">Pozuelo del Rey</option>
                                <option value="Prádena del Rincon">Prádena del Rincón</option>
                                <option value="Puebla de la Sierra">Puebla de la Sierra</option>
                                <option value="Quijorna">Quijorna</option>
                                <option value="Rascafria">Rascafría</option>
                                <option value="Reduena">Redueña</option>
                                <option value="Ribatejada">Ribatejada</option>
                                <option value="Rivas-Vaciamadrid">Rivas-Vaciamadrid</option>
                                <option value="Robledillo de la Jara">Robledillo de la Jara</option>
                                <option value="Robledo de Chavela">Robledo de Chavela</option>
                                <option value="Robregordo">Robregordo</option>
                                <option value="Rozas de Madrid (Las)">Rozas de Madrid (Las)</option>
                                <option value="Rozas de Puerto Real">Rozas de Puerto Real</option>
                                <option value="San Agustin del Guadalix">San Agustín del Guadalix</option>
                                <option value="San Fernando de Henares">San Fernando de Henares</option>
                                <option value="San Lorenzo de El Escorial">San Lorenzo de El Escorial</option>
                                <option value="San Martin de la Vega">San Martín de la Vega</option>
                                <option value="San Martin de Valdeiglesias">San Martín de Valdeiglesias</option>
                                <option value="San Sebastian de los Reyes">San Sebastián de los Reyes</option>
                                <option value="Santa Maria de la Alameda">Santa María de la Alameda</option>
                                <option value="Santorcaz">Santorcaz</option>
                                <option value="Santos de la Humosa (Los)">Santos de la Humosa (Los)</option>
                                <option value="Serna del Monte (La)">Serna del Monte (La)</option>
                                <option value="Serranillos del Valle">Serranillos del Valle</option>
                                <option value="Sevilla la Nueva">Sevilla la Nueva</option>
                                <option value="Somosierra">Somosierra</option>
                                <option value="Soto del Real">Soto del Real</option>
                                <option value="Talamanca de Jarama">Talamanca de Jarama</option>
                                <option value="Tielmes">Tielmes</option>
                                <option value="Titulcia">Titulcia</option>
                                <option value="Torrejon de Ardoz">Torrejón de Ardoz</option>
                                <option value="Torrejon de la Calzada">Torrejón de la Calzada</option>
                                <option value="Torrejon de Velasco">Torrejón de Velasco</option>
                                <option value="Torrelaguna">Torrelaguna</option>
                                <option value="Torrelodones">Torrelodones</option>
                                <option value="Torremocha de Jarama">Torremocha de Jarama</option>
                                <option value="Torres de la Alameda">Torres de la Alameda</option>
                                <option value="Valdaracete">Valdaracete</option>
                                <option value="Valdeavero">Valdeavero</option>
                                <option value="Valdelaguna">Valdelaguna</option>
                                <option value="Valdemanco">Valdemanco</option>
                                <option value="Valdemaqueda">Valdemaqueda</option>
                                <option value="Valdemorillo">Valdemorillo</option>
                                <option value="Valdemoro">Valdemoro</option>
                                <option value="Valdeolmos-Alalpardo">Valdeolmos-Alalpardo</option>
                                <option value="Valdepielagos">Valdepiélagos</option>
                                <option value="Valdetorres de Jarama">Valdetorres de Jarama</option>
                                <option value="Valdilecha">Valdilecha</option>
                                <option value="Valverde de Alcala">Valverde de Alcalá</option>
                                <option value="Velilla de San Antonio">Velilla de San Antonio</option>
                                <option value="Vellon (El)">Vellón (El)</option>
                                <option value="Venturada">Venturada</option>
                                <option value="Villaconejos">Villaconejos</option>
                                <option value="Villa del Prado">Villa del Prado</option>
                                <option value="Villalbilla">Villalbilla</option>
                                <option value="Villamanrique de Tajo">Villamanrique de Tajo</option>
                                <option value="Villamanta">Villamanta</option>
                                <option value="Villamantilla">Villamantilla</option>
                                <option value="Villanueva de la Canada">Villanueva de la Cañada</option>
                                <option value="Villanueva del Pardillo">Villanueva del Pardillo</option>
                                <option value="Villanueva de Perales">Villanueva de Perales</option>
                                <option value="Villar del Olmo">Villar del Olmo</option>
                                <option value="Villarejo de Salvanes">Villarejo de Salvanés</option>
                                <option value="Villaviciosa de Odon">Villaviciosa de Odón</option>
                                <option value="Villavieja del Lozoya">Villavieja del Lozoya</option>
                                <option value="Zarzalejo">Zarzalejo</option>
                                <option value="Lozoyuela-Navas-Sieteiglesias">Lozoyuela-Navas-Sieteiglesias</option>
                                <option value="Puentes Viejas">Puentes Viejas</option>
                                <option value="Tres Cantos">Tres Cantos</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, selecciona una localidad.
                            </div>
                        </div>
                        <!-- Campo de Sexo -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="sexo" class="form-label">Sexo <span class="asterisk">*</span></label>
                            <select id="sexo" name="sexo" class="form-select" required="">
                                <option selected="" value="">Selecciona uno</option>
                                <option value="femenino">Femenino</option>
                                <option value="masculino">Masculino</option>
                                <option value="otro">Prefiero no decirlo</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, elige tu sexo.
                            </div>
                        </div>
                        <!-- Campo de Fecha de nacimiento -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="fnacimiento" class="form-label">Fecha de nacimiento <span
                                    class="asterisk">*</span></label>
                            <input type="date" class="form-control" id="fnacimiento" name="fnacimiento"
                                placeholder="dd/mm/aaaa" required>
                            <div class="invalid-feedback">
                                Por favor, selecciona tu fecha de nacimiento.
                            </div>
                        </div>
                        <div class="mb-5"></div> <!-- Separación entre secciones -->

                        <!-- Sección Datos estadísticos -->
                        <h2 class="section-title">Datos estadísticos</h2>
                        <div class="row mb-2 mb-md-3">
                            <!-- Campo de Nivel de estudios -->
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="estudios" class="form-label">Nivel de estudios <span
                                        class="asterisk">*</span></label>
                                <select name="estudios" id="estudios" class="form-select" required="">
                                    <option selected="" value="">Selecciona uno</option>
                                    <option value="Educacion primaria o primer ciclo de educacion basica">Educación
                                        primaria o primer ciclo
                                        de educación básica</option>
                                    <option value="Primer ciclo de secundaria o segundo ciclo de la educacion basica">
                                        Primer ciclo de
                                        secundaria o segundo ciclo de la educación básica</option>
                                    <option value="Segundo ciclo de secundaria">Segundo ciclo de secundaria</option>
                                    <option value="Post-secundaria no terciaria (tecnico auxiliar o tecnico)">
                                        Post-secundaria no terciaria
                                        (técnico auxiliar o técnico)</option>
                                    <option
                                        value="Educacion terciaria de ciclo corto (tecnico especialista o tecnico superior)">
                                        Educación
                                        terciaria de ciclo corto (técnico especialista o técnico superior)</option>
                                    <option value="Grado, primer ciclo de licenciatura, bachiller o equivalente">Grado,
                                        primer ciclo de
                                        licenciatura, bachiller o equivalente</option>
                                    <option value="Maestria, master, segundo ciclo de licenciatura o equivalente">
                                        Maestría, máster, segundo
                                        ciclo de licenciatura o equivalente</option>
                                    <option value="Doctorado o equivalente">Doctorado o equivalente</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona tu nivel de estudios.
                                </div>
                            </div>
                            <!-- Campo de Situación laboral -->
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="slaboral" class="form-label">Situación laboral <span
                                        class="asterisk">*</span></label>
                                <select name="slaboral"  id="slaboral" class="form-select" required="">
                                    <option selected="" value="">Selecciona uno</option>
                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Activo">Activo</option>
                                    <option value="En busqueda de empleo">En busqueda de empleo</option>
                                    <option value="Jubilado">Jubilado</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona tu situación laboral.
                                </div>
                            </div>
                            <!-- Campo de Cómo conocido -->
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="comoconocido" class="form-label">¿Cómo nos has conocido? <span
                                        class="asterisk">*</span></label>
                                <select name="comoconocido"  id="comoconocido" class="form-select" required="">
                                    <option selected="" value="">Selecciona un medio</option>
                                    <option id="dynamizer" value="Dinamizador">Dinamizador</option>
                                    <option value="ONG">ONG/Asociacion</option>
                                    <option value="RRSS">Redes Sociales</option>
                                    <option value="TV">Television</option>
                                    <option value="Press">Prensa</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona una opción.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 mb-md-3">
                            <!-- Campo de Renta mínima -->
                            <div class="col-md-6">
                                <label class="form-label">¿Percibe renta mínima de inserción? <span
                                        class="asterisk">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rminima" id="rminima_si"
                                        value="si" required>
                                    <label class="form-check-label" for="rminima_si">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rminima" id="rminima_no"
                                        value="no" required>
                                    <label class="form-check-label" for="rminima_no">
                                        No
                                    </label>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, selecciona una opción.
                                </div>
                            </div>
                        </div>
                        <!-- Sección Notificaciones -->
                        <div class="mb-4">
                            <h2 class="section-title">Notificaciones</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="boletin" name="boletin">
                                <label class="form-check-label" for="boletin">
                                    Deseo recibir el boletín de noticias por email sobre nuevos cursos y formaciones.
                                </label>
                            </div>
                        </div>

                        <!-- Sección Consentimiento -->
                        <div class="mb-4">
                            <h2 class="section-title">Consentimiento</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="consentimiento"
                                    name="consentimiento" required>
                                <label class="form-check-label" for="consentimiento">
                                    <span class="asterisk">*</span> Consiento el tratamiento y uso de mis datos
                                    personales para los fines indicados en la política de privacidad y acepto los
                                    términos y condiciones.
                                </label>
                                <div class="invalid-feedback">
                                    Debes aceptar los términos y condiciones para continuar.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mx-auto">
                                <button type="submit" id="boton" class="btn btn-danger w-100">Registrarse</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="text-center mb-4" style="padding-top: 30px;">
        <img src="imgs/logos.png" alt="Logos" class="img-fluid">
    </div>


    <!-- Cargar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para manejar errores y verificar contraseñas -->
    <!-- <script>
        document.getElementById('formulario').addEventListener('submit', function (event) {
            // let form = event.target;
            // let password = document.getElementById('password');
            // let confirmPassword = document.getElementById('confirmPassword');
            // let telefono = document.getElementById('telefono');
            // let isValid = form.checkValidity(); // Verifica si el formulario cumple con las validaciones nativas de HTML5

            /*
            // Verificar si las contraseñas coinciden
            if (password.value !== confirmPassword.value) {
                event.preventDefault(); // Prevenir el envío del formulario
                confirmPassword.classList.add('is-invalid'); // Añadir clase para mostrar el mensaje de error
                isValid = false; // Marcar que el formulario no es válido
            } else {
                confirmPassword.classList.remove('is-invalid'); // Remover el mensaje de error si coinciden
            }
            */

            // Verificar si el número de teléfono tiene exactamente 9 dígitos
            if (!telefono.value.match(/^[0-9]{9}$/)) {
                event.preventDefault();
                telefono.classList.add('is-invalid');
                isValid = false;
            } else {
                telefono.classList.remove('is-invalid');
            }

            // Si el formulario no es válido, prevenimos el envío
            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Mostrar feedback de validación (por si hay otros campos vacíos o mal llenados)
            form.classList.add('was-validated');
        });

    </script> -->




   
    <script src="db.php" type="text/php"></script>
    <script src="procesar_formulario.php" type="text/php"></script>
    <script src="validar.js" type="text/javascript"></script>

</body>

</html>