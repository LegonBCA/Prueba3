<?php
// ===================================================================
// ARCHIVO: auth.php
// PROPÓSITO: Middleware de autenticación para proteger rutas
// AUTOR: Desarrollado por usuario, comentado por IA
// ===================================================================

// Inicializar o reanudar la sesión PHP
// session_start() debe llamarse antes de acceder a $_SESSION
// Permite mantener el estado del usuario autenticado entre páginas
session_start();

// Verificar si el usuario está autenticado
// $_SESSION['user'] se establece cuando el usuario inicia sesión exitosamente
// Si no existe esta variable de sesión, significa que no está autenticado
if (!isset($_SESSION['user'])) {
  // Redirigir al usuario no autenticado a la página de login
  // header() envía un encabezado HTTP de redirección al navegador
  header("Location: login.php");
  
  // Terminar la ejecución del script inmediatamente
  // exit evita que se ejecute código adicional después de la redirección
  exit;
}

// NOTA: Si llegamos aquí, el usuario está autenticado
// El script que incluya este archivo puede continuar ejecutándose
// Este es un patrón común de middleware para proteger páginas privadas
?>
  