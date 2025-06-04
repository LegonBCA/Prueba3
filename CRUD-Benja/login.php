<?php
// ===================================================================
// ARCHIVO: login.php
// PROPÓSITO: Sistema de autenticación de usuarios
// AUTOR: Desarrollado por usuario, comentado por IA
// ===================================================================

// Inicializar sesión para manejar el estado de autenticación
session_start();

// Incluir configuración de base de datos
// Necesario para verificar credenciales contra la tabla 'users'
include 'db.php';

// Variable para almacenar mensajes de error
// Se mostrará en la interfaz si las credenciales son incorrectas
$error_message = '';

// Verificar si el formulario fue enviado via POST
// $_SERVER["REQUEST_METHOD"] contiene el método HTTP utilizado (GET, POST, etc.)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Obtener datos del formulario enviado
  // $_POST contiene todos los campos enviados desde el formulario HTML
  $username = $_POST['username'];          // Campo 'username' del formulario
  $password = md5($_POST['password']);     // Campo 'password' hasheado con MD5

  // Construir consulta SQL para verificar credenciales
  // Se busca un usuario que tenga exactamente el username y password proporcionados
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  
  // Ejecutar la consulta en la base de datos
  // $conn->query() ejecuta la consulta y retorna un objeto resultado
  $result = $conn->query($sql);

  // Verificar si se encontró exactamente un usuario
  // num_rows contiene la cantidad de filas devueltas por la consulta
  if ($result->num_rows === 1) {
    
    // AUTENTICACIÓN EXITOSA
    // Crear variable de sesión para marcar al usuario como autenticado
    $_SESSION['user'] = $username;
    
    // Redirigir al dashboard principal del portafolio
    header("Location: index.php");
    
    // Terminar ejecución para evitar que se procese más código
    exit();
    
  } else {
    
    // AUTENTICACIÓN FALLIDA
    // Establecer mensaje de error que se mostrará en la interfaz
    $error_message = "Credenciales incorrectas. Por favor intenta de nuevo.";
    
  }
}
// FIN DE LA LÓGICA PHP - A partir de aquí continúa el HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Portafolio</title>
    
    <!-- Bootstrap CSS 5.3.3 - Framework CSS para diseño responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome - Biblioteca de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Tipografía Inter para diseño moderno -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Estilos personalizados del sistema -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-container">
    <!-- Contenedor principal del formulario de login -->
    <div class="login-card fade-in-up">
        
        <!-- Sección de logo y bienvenida -->
        <div class="text-center mb-4">
            <!-- Icono circular con efecto visual -->
            <div class="d-inline-flex align-items-center justify-content-center bg-light-blue rounded-circle mb-3" style="width: 80px; height: 80px;">
                <i class="fas fa-code text-white fs-2"></i>
            </div>
            <!-- Título y descripción de bienvenida -->
            <h2 class="text-light fw-bold mb-2">Bienvenido</h2>
            <p class="text-light-muted">Accede a tu portafolio de proyectos</p>
        </div>

        <!-- Mostrar mensaje de error si existe -->
        <!-- Estructura condicional PHP: solo se muestra si hay error -->
        <?php if(!empty($error_message)): ?>
            <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de autenticación -->
        <!-- method="post" envía datos de forma segura -->
        <!-- class="needs-validation" habilita validación HTML5 -->
        <!-- novalidate desactiva validación por defecto del navegador -->
        <form method="post" class="needs-validation" novalidate>
            
            <!-- Campo de usuario -->
            <div class="mb-3">
                <label for="username" class="form-label form-label-modern">
                    <i class="fas fa-user me-2"></i>Usuario
                </label>
                <input type="text" 
                       class="form-control form-control-modern" 
                       id="username" 
                       name="username" 
                       placeholder="Ingresa tu usuario" 
                       required>
                <!-- Mensaje de validación HTML5 -->
                <div class="invalid-feedback">
                    Por favor ingresa tu usuario.
                </div>
            </div>

            <!-- Campo de contraseña -->
            <div class="mb-4">
                <label for="password" class="form-label form-label-modern">
                    <i class="fas fa-lock me-2"></i>Contraseña
                </label>
                <input type="password" 
                       class="form-control form-control-modern" 
                       id="password" 
                       name="password" 
                       placeholder="Ingresa tu contraseña" 
                       required>
                <!-- Mensaje de validación HTML5 -->
                <div class="invalid-feedback">
                    Por favor ingresa tu contraseña.
                </div>
            </div>

            <!-- Botón de envío del formulario -->
            <button type="submit" class="btn btn-light-blue w-100 py-3 fw-bold">
                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
            </button>
        </form>

        <!-- Footer informativo del formulario -->
        <div class="text-center mt-4">
            <small class="text-light-muted">
                <i class="fas fa-shield-alt me-1"></i>
                Conexión segura
            </small>
        </div>
    </div>

    <!-- Bootstrap JavaScript - Funcionalidad interactiva de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script de validación de formularios HTML5 -->
    <script>
        // Función autoejecutada para validación
        (function() {
            'use strict';
            
            // Esperar a que la página se cargue completamente
            window.addEventListener('load', function() {
                
                // Obtener todos los formularios con clase 'needs-validation'
                var forms = document.getElementsByClassName('needs-validation');
                
                // Iterar sobre cada formulario encontrado
                var validation = Array.prototype.filter.call(forms, function(form) {
                    
                    // Agregar evento de envío a cada formulario
                    form.addEventListener('submit', function(event) {
                        
                        // Si el formulario no es válido según HTML5
                        if (form.checkValidity() === false) {
                            // Prevenir el envío del formulario
                            event.preventDefault();
                            // Detener la propagación del evento
                            event.stopPropagation();
                        }
                        
                        // Agregar clase para mostrar estilos de validación
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>

