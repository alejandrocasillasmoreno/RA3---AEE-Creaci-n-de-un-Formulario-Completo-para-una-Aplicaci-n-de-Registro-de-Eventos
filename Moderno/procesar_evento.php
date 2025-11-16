<?php
$respuesta = [
    'status' => 'error', // Por defecto es 'error'
    'errores' => [],     // Un array para guardar los mensajes de error
    'htmlRecibo' => ''   // Aquí guardaremos el HTML del recibo si todo va bien
];

// 1. Recuperar datos del formulario
$nombre = $_POST["nombre"] ?? "";
$email = $_POST["email"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$fecha_nacimiento = $_POST["fecha_nacimiento"] ?? "";
$genero = $_POST["genero"] ?? "No especificado"; 
$fecha_evento = $_POST["fecha_evento"] ?? "";
$tipo_entrada = $_POST["tipo_entrada"] ?? "general";
$usuario = $_POST["usuario"] ?? "";
$password = $_POST["password"] ?? "";
$confirmacion = $_POST["confirmacion"] ?? "";
$terminos_condiciones = $_POST["terminos_condiciones"] ?? "No"; 
$comentarios = $_POST["comentarios"] ?? "Sin comentarios";
$archivo_nombre = $_FILES["archivo"]["name"] ?? "No se subió archivo";

// 2. VALIDACIÓN DEL SERVIDOR
if (empty($nombre)) {
    $respuesta['errores'][] = "El nombre completo es obligatorio.";
}
if (empty($email)) {
    $respuesta['errores'][] = "El correo electrónico es obligatorio.";
}else{ 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $respuesta['errores'][] = "El formato del correo electrónico es inválido.";

    }
}

if (empty($fecha_nacimiento)) {
    $respuesta['errores'][] = "La fecha de nacimiento es obligatoria.";
}

if (empty($usuario)) {
    $respuesta['errores'][] = "El nombre de usuario es obligatorio.";
}

if (empty($password)) {
    $respuesta['errores'][] = "La contraseña es obligatoria.";
}

if ($password !== $confirmacion) {
    $respuesta['errores'][] = "Las contraseñas no coinciden.";
}

if ($terminos_condiciones !== "Acepto") {
    $respuesta['errores'][] = "Debes aceptar los términos y condiciones.";
}



// 3. COMPROBAR RESULTADO DE VALIDACIÓN
if (empty($respuesta['errores'])) {
    
    // Cambia el estado a "éxito"
    $respuesta['status'] = 'exito';

    $respuesta['htmlRecibo'] = '
        <div class="alert alert-success">
            <h3>¡Registro completado con éxito! (Método REST)</h3>
            <p>Gracias por registrarte, <strong>' . htmlspecialchars($nombre) . '</strong>.</p>
        </div>
        <div class="card">
            <div class="card-header">Resumen de tu registro</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</li>
                <li class="list-group-item"><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>
                <li class="list-group-item"><strong>Usuario:</strong> ' . htmlspecialchars($usuario) . '</li>
                <li class="list-group-item"><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</li>
                <li class="list-group-item"><strong>Fecha Nacimiento:</strong> ' . htmlspecialchars($fecha_nacimiento) . '</li>
                <li class="list-group-item"><strong>Género:</strong> ' . htmlspecialchars($genero) . '</li>
                <li class="list-group-item"><strong>Fecha Evento:</strong> ' . htmlspecialchars($fecha_evento) . '</li>
                <li class="list-group-item"><strong>Entrada:</strong> ' . htmlspecialchars($tipo_entrada) . '</li>
                <li class="list-group-item"><strong>Comentarios:</strong> ' . htmlspecialchars($comentarios) . '</li>
                <li class="list-group-item"><strong>Archivo:</strong> ' . htmlspecialchars($archivo_nombre) . '</li>
            </ul>
        </div>';
} 

// 4. DEVOLVER LA RESPUESTA COMO JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
exit(); 
?>