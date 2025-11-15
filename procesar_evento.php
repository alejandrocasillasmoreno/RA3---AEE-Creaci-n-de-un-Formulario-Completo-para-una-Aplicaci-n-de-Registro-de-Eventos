<?php
// SECCIÓN 1: Información Personal
$nombre = $_POST["nombre"] ?? "";
$email = $_POST["email"] ?? "";
$telefono = $_POST["telefono"] ?? "No rellenado";
$fecha_nacimiento = $_POST["fecha_nacimiento"] ?? "";
$genero = $_POST["genero"] ?? "No especificado"; 
// SECCIÓN 2: Información del Evento
$fecha_evento = $_POST["fecha_evento"] ?? "";
$tipo_entrada = $_POST["tipo_entrada"] ?? "general";

$vegetariano = $_POST["vegetariano"] ?? "No";
$vegano = $_POST["vegano"] ?? "No"; 
$sin_gluten = $_POST["sin_gluten"] ?? "No";
$sin_preferencias = $_POST["sin_preferencias"] ?? "No";

// SECCIÓN 3: Información de Acceso
$usuario = $_POST["usuario"] ?? "";
$password = $_POST["password"] ?? "";
$confirmacion = $_POST["confirmacion"] ?? "";

// SECCIÓN 4: Preferencias
$notificaciones = $_POST["notificaciones"] ?? "No"; 
$terminos_condiciones = $_POST["terminos_condiciones"] ?? "No"; 

// SECCIÓN 5: Encuesta
$calificacion = $_POST["calificacion"] ?? "5";
$comentarios = $_POST["comentarios"] ?? "";

// SECCIÓN 6: Archivo Adjuntado
$archivo_nombre = $_FILES["archivo"]["name"] ?? "No se subió archivo";
$archivo_error = $_FILES["archivo"]["error"] ?? 4; 
?>
