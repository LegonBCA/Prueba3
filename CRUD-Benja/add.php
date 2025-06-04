<?php
// ===================================================================
// ARCHIVO: add.php
// PROPÓSITO: Formulario para agregar nuevos proyectos al portafolio
// AUTOR: Desarrollado por usuario, comentado por IA
// ===================================================================

// Incluir middleware de autenticación
// Solo usuarios autenticados pueden agregar proyectos
include 'auth.php';

// Incluir configuración de base de datos
// Necesario para insertar nuevos proyectos
include 'db.php';

// Variables para mensajes de estado
$success_message = '';  // Mensaje cuando el proyecto se guarda exitosamente
$error_message = '';    // Mensaje cuando ocurre algún error

// Verificar si el formulario fue enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Obtener datos del formulario
  // Capturar todos los campos enviados desde el formulario HTML
  $titulo = $_POST['titulo'];                // Título del proyecto
  $descripcion = $_POST['descripcion'];      // Descripción detallada
  $url_github = $_POST['url_github'];        // URL del repositorio GitHub (opcional)
  $url_produccion = $_POST['url_produccion']; // URL del proyecto en producción (opcional)

  // PROCESAMIENTO DE IMAGEN SUBIDA
  // Validar y procesar imagen subida por el usuario
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    
    // Obtener información del archivo subido
    $imagen = $_FILES['imagen']['name'];        // Nombre original del archivo
    $tmp = $_FILES['imagen']['tmp_name'];       // Ubicación temporal del archivo
    
    // Extraer extensión del archivo para validación
    $extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
    
    // Lista de extensiones permitidas por seguridad
    // Solo se permiten formatos de imagen comunes y seguros
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    // Verificar que la extensión sea válida
    if (in_array($extension, $extensiones_permitidas)) {
      
      // Generar nombre único para evitar conflictos
      // time() genera timestamp único + nombre original
      $nombre_imagen = time() . '_' . $imagen;
      
      // Mover archivo desde ubicación temporal a directorio final
      if (move_uploaded_file($tmp, "uploads/$nombre_imagen")) {
        
        // INSERTAR PROYECTO EN BASE DE DATOS
        // Si la imagen se subió correctamente, guardar proyecto
        $sql = "INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen) 
                VALUES ('$titulo', '$descripcion', '$url_github', '$url_produccion', '$nombre_imagen')";
        
        // Ejecutar consulta de inserción
        if ($conn->query($sql)) {
          // ÉXITO: Redirigir al dashboard para ver el nuevo proyecto
          header("Location: index.php");
          exit();
        } else {
          // ERROR: Fallo en la base de datos
          $error_message = "Error al guardar el proyecto.";
        }
        
      } else {
        // ERROR: No se pudo mover el archivo subido
        $error_message = "Error al subir la imagen.";
      }
      
    } else {
      // ERROR: Formato de imagen no permitido
      $error_message = "Formato de imagen no válido. Use JPG, PNG, GIF o WebP.";
    }
    
  } else {
    // ERROR: No se seleccionó imagen o hubo error en la subida
    $error_message = "Por favor selecciona una imagen.";
  }
}
// FIN DE LA LÓGICA PHP - Continúa el HTML del formulario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proyecto - Portafolio</title>
    
    <!-- Bootstrap CSS 5.3.3 - Framework responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome - Iconos vectoriales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Tipografía moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark-blue">
    
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-lg mb-5">
        <div class="container">
            <!-- Logo clickeable que regresa al dashboard -->
            <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="index.php">
                <i class="fas fa-code text-light-blue me-3 fs-3"></i>
                <span class="text-light">Mi Portafolio</span>
            </a>
            
            <!-- Botones de navegación -->
            <div class="d-flex gap-3">
                <!-- Botón para volver al dashboard -->
                <a href="index.php" class="btn btn-outline-light-blue btn-modern">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
                
                <!-- Botón para cerrar sesión -->
                <a href="logout.php" class="btn btn-outline-danger btn-modern">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal centrado -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Cabecera de la página -->
                <div class="text-center mb-5">
                    <!-- Título principal con icono -->
                    <h1 class="display-5 fw-bold text-light mb-3">
                        <i class="fas fa-plus-circle text-light-blue me-3"></i>
                        Nuevo Proyecto
                    </h1>
                    
                    <!-- Subtítulo descriptivo -->
                    <p class="lead text-light-muted">Agrega un nuevo proyecto a tu portafolio</p>
                    
                    <!-- Línea decorativa -->
                    <div class="d-inline-block">
                        <div class="bg-light-blue" style="height: 3px; width: 60px; border-radius: 50px;"></div>
                    </div>
                </div>

                <!-- Contenedor del formulario con estilos modernos -->
                <div class="form-container fade-in-up">
                    
                    <!-- Mostrar mensajes de error si existen -->
                    <?php if(!empty($error_message)): ?>
                        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>

                    <!-- FORMULARIO PRINCIPAL -->
                    <!-- enctype="multipart/form-data" es necesario para subir archivos -->
                    <!-- method="post" envía datos de forma segura -->
                    <!-- class="needs-validation" habilita validación HTML5 -->
                    <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row">
                            
                            <!-- CAMPO: TÍTULO DEL PROYECTO -->
                            <div class="col-12 mb-4">
                                <label for="titulo" class="form-label form-label-modern">
                                    <i class="fas fa-heading me-2"></i>Título del Proyecto
                                </label>
                                <input type="text" 
                                       class="form-control form-control-modern" 
                                       id="titulo" 
                                       name="titulo" 
                                       placeholder="Ej: Sistema de Gestión de Inventario" 
                                       required
                                       maxlength="100">
                                <!-- Mensaje de validación HTML5 -->
                                <div class="invalid-feedback">
                                    Por favor ingresa el título del proyecto.
                                </div>
                            </div>

                            <!-- CAMPO: DESCRIPCIÓN DEL PROYECTO -->
                            <div class="col-12 mb-4">
                                <label for="descripcion" class="form-label form-label-modern">
                                    <i class="fas fa-align-left me-2"></i>Descripción
                                </label>
                                <!-- Textarea para descripciones largas -->
                                <textarea class="form-control form-control-modern" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          rows="4" 
                                          placeholder="Describe tu proyecto, tecnologías utilizadas y características principales..."
                                          required
                                          maxlength="500"></textarea>
                                
                                <!-- Contador de caracteres dinámico -->
                                <div class="form-text text-light-muted">
                                    <small><span id="char-count">0</span>/500 caracteres</small>
                                </div>
                                
                                <!-- Mensaje de validación -->
                                <div class="invalid-feedback">
                                    Por favor ingresa una descripción del proyecto.
                                </div>
                            </div>

                            <!-- CAMPOS: URLs OPCIONALES (GitHub y Producción) -->
                            <!-- Diseño responsivo: 2 columnas en pantallas medianas+ -->
                            <div class="col-md-6 mb-4">
                                <label for="url_github" class="form-label form-label-modern">
                                    <i class="fab fa-github me-2"></i>URL de GitHub
                                </label>
                                <!-- Campo tipo URL para validación automática -->
                                <input type="url" 
                                       class="form-control form-control-modern" 
                                       id="url_github" 
                                       name="url_github" 
                                       placeholder="https://github.com/usuario/proyecto">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="url_produccion" class="form-label form-label-modern">
                                    <i class="fas fa-external-link-alt me-2"></i>URL de Producción
                                </label>
                                <!-- Campo tipo URL para validación automática -->
                                <input type="url" 
                                       class="form-control form-control-modern" 
                                       id="url_produccion" 
                                       name="url_produccion" 
                                       placeholder="https://mi-proyecto.com">
                            </div>

                            <!-- CAMPO: IMAGEN DEL PROYECTO -->
                            <div class="col-12 mb-4">
                                <label for="imagen" class="form-label form-label-modern">
                                    <i class="fas fa-image me-2"></i>Imagen del Proyecto
                                </label>
                                <!-- Campo file con filtro de imágenes -->
                                <input type="file" 
                                       class="form-control form-control-modern" 
                                       id="imagen" 
                                       name="imagen" 
                                       accept="image/*" 
                                       required>
                                
                                <!-- Información sobre formatos permitidos -->
                                <div class="form-text text-light-muted">
                                    <small>Formatos admitidos: JPG, PNG, GIF, WebP. Tamaño máximo: 5MB</small>
                                </div>
                                
                                <!-- Mensaje de validación -->
                                <div class="invalid-feedback">
                                    Por favor selecciona una imagen para el proyecto.
                                </div>
                            </div>

                            <!-- PREVIEW DE IMAGEN -->
                            <!-- Se muestra dinámicamente cuando el usuario selecciona una imagen -->
                            <div class="col-12 mb-4">
                                <div id="image-preview" class="d-none">
                                    <label class="form-label form-label-modern">Vista previa:</label>
                                    <div class="text-center">
                                        <!-- Imagen de preview con estilos -->
                                        <img id="preview-img" class="img-fluid rounded" style="max-height: 200px; border: 2px solid var(--light-blue);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-end">
                                    <!-- Botón cancelar: vuelve al dashboard -->
                                    <a href="index.php" class="btn btn-outline-secondary btn-modern">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    
                                    <!-- Botón guardar: envía el formulario -->
                                    <button type="submit" class="btn btn-light-blue btn-modern">
                                        <i class="fas fa-save me-2"></i>Guardar Proyecto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript para funcionalidad interactiva -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // ===============================================================
        // JAVASCRIPT PARA FUNCIONALIDAD INTERACTIVA DEL FORMULARIO
        // ===============================================================
        
        // VALIDACIÓN DE FORMULARIOS HTML5
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Obtener todos los formularios con validación
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    // Agregar evento de envío a cada formulario
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            // Si no es válido, prevenir envío y mostrar errores
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        // Agregar clase para mostrar estilos de validación
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // CONTADOR DE CARACTERES EN TIEMPO REAL
        document.getElementById('descripcion').addEventListener('input', function() {
            const charCount = this.value.length;
            // Actualizar contador visual
            document.getElementById('char-count').textContent = charCount;
        });

        // PREVIEW DE IMAGEN EN TIEMPO REAL
        document.getElementById('imagen').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Crear lector de archivos
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Mostrar preview de la imagen seleccionada
                    const preview = document.getElementById('image-preview');
                    const img = document.getElementById('preview-img');
                    img.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                // Leer archivo como Data URL para preview
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>