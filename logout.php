<?php
// ===================================================================
// ARCHIVO: logout.php
// PROPÓSITO: Cerrar sesión del usuario y limpiar variables de sesión
// AUTOR: Desarrollado por usuario, comentado por IA
// ===================================================================

// Inicializar o reanudar la sesión actual
// Necesario para poder acceder y destruir las variables de sesión
session_start();

// Destruir completamente la sesión del usuario
// session_destroy() elimina todos los datos de sesión del servidor
// y invalida el ID de sesión actual
session_destroy();

// Redirigir al usuario a la página de login
// Después del logout, el usuario debe volver a autenticarse
header("Location: login.php");

// NOTA: No se necesita exit() aquí porque el archivo termina inmediatamente
// El usuario será redirigido automáticamente al login
?>