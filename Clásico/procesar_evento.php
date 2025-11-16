<?php
// 1. Recuperar datos del formulario

// SECCIÓN 1: Información Personal
$nombre = $_POST["nombre"] ?? "";
$email = $_POST["email"] ?? "";
$telefono = $_POST["telefono"] ?? "No rellenado";
$fecha_nacimiento = $_POST["fecha_nacimiento"] ?? "";
$genero = $_POST["genero"] ?? "No especificado"; 
// SECCIÓN 2: Información del Evento
$fecha_evento = $_POST["fecha_evento"] ?? "";
$tipo_entrada = $_POST["tipo_entrada"] ?? "general";

$vegetariano = ($_POST["vegetariano"] ?? "No") === "vegetariano" ? "Sí" : "No";
$vegano = ($_POST["vegano"] ?? "No") === "vegano" ? "Sí" : "No";
$sin_gluten = ($_POST["sin_gluten"] ?? "No") === "sin_gluten" ? "Sí" : "No";
$sin_preferencias = ($_POST["sin_preferencias"] ?? "No") === "sin_preferencias" ? "Sí" : "No";

// SECCIÓN 3: Información de Acceso
$usuario = $_POST["usuario"] ?? "";
$password = $_POST["password"] ?? "";
$confirmacion = $_POST["confirmacion"] ?? "";

// SECCIÓN 4: Preferencias
$notificaciones = $_POST["notificaciones"] ?? "No"; 
$terminos_condiciones = $_POST["terminos_condiciones"] ?? "No"; 

// SECCIÓN 5: Encuesta
// Esperado: calificación entre 1 y 10
$calificacion = $_POST["calificacion"] ?? "5";
$comentarios = $_POST["comentarios"] ?? "";

// SECCIÓN 6: Archivo Adjuntado
$archivo_nombre = isset($_FILES["archivo"]["name"]) ? $_FILES["archivo"]["name"] : "No se subió archivo";
$archivo_error = $_FILES["archivo"]["error"] ?? 4; 

// 2. Validación del servidor

$errores = []; // Un array para guardar los mensajes de error

// Validación de campos obligatorios (required)

if (empty($nombre)) {
    $errores[] = "El nombre completo es obligatorio.";
}

if (empty($email)) {
    $errores[] = "El correo electrónico es obligatorio.";
}else{
    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }
}

if (empty($fecha_nacimiento)) {
    $errores[] = "La fecha de nacimiento es obligatoria.";
}

if (empty($usuario)) {
    $errores[] = "El nombre de usuario es obligatorio.";
}

if (empty($password)) {
    $errores[] = "La contraseña es obligatoria.";
}

if (empty($confirmacion)) {
    $errores[] = "La confirmación de la contraseña es obligatoria.";
}

// Validar términos y condiciones
if ($terminos_condiciones !== "Acepto") {
    $errores[] = "Debes aceptar los términos y condiciones.";
}

// Validar que la contraseña y confirmación coincidan
if ($password !== $confirmacion) {
    $errores[] = "Las contraseñas no coinciden.";
}

// Validar que la calificación esté entre 1 y 10
if ($calificacion < 1 || $calificacion > 10) {
    $errores[] = "La calificación debe estar entre 1 y 10.";
}


// Imprimimos el esqueleto HTML del recibo
echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '    <title>Recibo de Registro</title>';
echo '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
echo '</head>';
echo '<body class="bg-light">';
echo '    <div class="container mt-5">';
echo '        <div class="row justify-content-center">';
echo '            <div class="col-md-8">';

// Comprobamos si la lista de errores NO está vacía
if (!empty($errores)) {
    
    // ESCENARIO 1: Hay errores de validación
    echo '        <div class="card border-danger">';
    echo '            <div class="card-header bg-danger text-white">Error en el envío</div>';
    echo '            <div class="card-body text-danger">';
    echo '                <p>Por favor, corrige los siguientes errores:</p>';
    echo '                <ul class="list-group list-group-flush">';
    
    // Usamos un bucle para imprimir cada error de la lista
    foreach ($errores as $error) {
        echo '                    <li class="list-group-item text-danger">' . $error . '</li>';
    }
    
    echo '                </ul>';
    echo '            </div>';
    echo '        </div>';

} else {
    
// ESCENARIO 2: Todo salió bien y no hay errores
echo '        <div class="card border-success">';
echo '            <div class="card-header bg-success text-white">¡Registro completado!</div>';
echo '            <div class="card-body">';
echo '                <h5 class="card-title">Gracias, ' . htmlspecialchars($nombre) . '</h5>';
echo '                <p>Tu recibo de registro:</p>';
echo '                <ul class="list-group list-group-flush">'; // <-- Se abre Caja 3 (list-group)
echo '                    <li class="list-group-item"><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</li>';
echo '                    <li class="list-group-item"><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>';
echo '                    <li class="list-group-item"><strong>Usuario:</strong> ' . htmlspecialchars($usuario) . '</li>';
echo '                    <li class="list-group-item"><strong>Fecha del Evento:</strong> ' . htmlspecialchars($fecha_evento) . '</li>';
echo '                    <li class="list-group-item"><strong>Tipo de Entrada:</strong> ' . htmlspecialchars($tipo_entrada) . '</li>';
echo '                    <li class="list-group-item"><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</li>';
echo '                    <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> ' . htmlspecialchars($fecha_nacimiento) . '</li>';
echo '                    <li class="list-group-item"><strong>Género:</strong> ' . htmlspecialchars($genero) . '</li>';
echo '                    <li class="list-group-item"><strong>Preferencias Alimenticias:</strong> ' . htmlspecialchars($comidaTexto) . '</li>';
echo '                </ul>';
echo '            </div>'; 
echo '        </div>'; 
}

// Final de la página
echo '            </div>';
echo '        </div>';
echo '    </div>';
echo '</body>';
echo '</html>';

?>
