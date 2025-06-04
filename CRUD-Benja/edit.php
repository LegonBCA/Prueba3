<?php
include 'auth.php';
include 'db.php';

$id = $_GET['id'];
$proyecto = $conn->query("SELECT * FROM proyectos WHERE id=$id")->fetch_assoc();

if (!$proyecto) {
    header("Location: index.php");
    exit();
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $url_github = $_POST['url_github'];
  $url_produccion = $_POST['url_produccion'];

  $img_sql = "";
  if ($_FILES['imagen']['name']) {
    $imagen = $_FILES['imagen']['name'];
    $extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
    
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (in_array($extension, $extensiones_permitidas)) {
      $nombre_imagen = time() . '_' . $imagen;
      if (move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/$nombre_imagen")) {
        $img_sql = ", imagen='$nombre_imagen'";
      } else {
        $error_message = "Error al subir la imagen.";
      }
    } else {
      $error_message = "Formato de imagen no válido.";
    }
  }

  if (empty($error_message)) {
    $sql = "UPDATE proyectos SET titulo='$titulo', descripcion='$descripcion', url_github='$url_github', url_produccion='$url_produccion' $img_sql WHERE id=$id";
    if ($conn->query($sql)) {
      header("Location: index.php");
      exit();
    } else {
      $error_message = "Error al actualizar el proyecto.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto - Portafolio</title>
    <!-- Bootstrap CSS 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark-blue">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-lg mb-5">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="index.php">
                <i class="fas fa-code text-light-blue me-3 fs-3"></i>
                <span class="text-light">Mi Portafolio</span>
            </a>
            <div class="d-flex gap-3">
                <a href="index.php" class="btn btn-outline-light-blue btn-modern">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
                <a href="logout.php" class="btn btn-outline-danger btn-modern">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-light mb-3">
                        <i class="fas fa-edit text-light-blue me-3"></i>
                        Editar Proyecto
                    </h1>
                    <p class="lead text-light-muted">Actualiza la información de tu proyecto</p>
                    <div class="d-inline-block">
                        <div class="bg-light-blue" style="height: 3px; width: 60px; border-radius: 50px;"></div>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="form-container fade-in-up">
                    <!-- Imagen actual -->
                    <?php if($proyecto['imagen']): ?>
                        <div class="mb-4">
                            <label class="form-label form-label-modern">Imagen actual:</label>
                            <div class="text-center">
                                <img src="uploads/<?= $proyecto['imagen'] ?>" 
                                     class="img-fluid rounded glow-effect" 
                                     style="max-height: 200px; border: 2px solid var(--light-blue);" 
                                     alt="<?= $proyecto['titulo'] ?>">
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Mensajes -->
                    <?php if(!empty($error_message)): ?>
                        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row">
                            <!-- Título -->
                            <div class="col-12 mb-4">
                                <label for="titulo" class="form-label form-label-modern">
                                    <i class="fas fa-heading me-2"></i>Título del Proyecto
                                </label>
                                <input type="text" 
                                       class="form-control form-control-modern" 
                                       id="titulo" 
                                       name="titulo" 
                                       value="<?= htmlspecialchars($proyecto['titulo']) ?>" 
                                       required
                                       maxlength="100">
                                <div class="invalid-feedback">
                                    Por favor ingresa el título del proyecto.
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="col-12 mb-4">
                                <label for="descripcion" class="form-label form-label-modern">
                                    <i class="fas fa-align-left me-2"></i>Descripción
                                </label>
                                <textarea class="form-control form-control-modern" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          rows="4" 
                                          required
                                          maxlength="500"><?= htmlspecialchars($proyecto['descripcion']) ?></textarea>
                                <div class="form-text text-light-muted">
                                    <small><span id="char-count"><?= strlen($proyecto['descripcion']) ?></span>/500 caracteres</small>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa una descripción del proyecto.
                                </div>
                            </div>

                            <!-- URLs -->
                            <div class="col-md-6 mb-4">
                                <label for="url_github" class="form-label form-label-modern">
                                    <i class="fab fa-github me-2"></i>URL de GitHub
                                </label>
                                <input type="url" 
                                       class="form-control form-control-modern" 
                                       id="url_github" 
                                       name="url_github" 
                                       value="<?= htmlspecialchars($proyecto['url_github']) ?>"
                                       placeholder="https://github.com/usuario/proyecto">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="url_produccion" class="form-label form-label-modern">
                                    <i class="fas fa-external-link-alt me-2"></i>URL de Producción
                                </label>
                                <input type="url" 
                                       class="form-control form-control-modern" 
                                       id="url_produccion" 
                                       name="url_produccion" 
                                       value="<?= htmlspecialchars($proyecto['url_produccion']) ?>"
                                       placeholder="https://mi-proyecto.com">
                            </div>

                            <!-- Nueva imagen -->
                            <div class="col-12 mb-4">
                                <label for="imagen" class="form-label form-label-modern">
                                    <i class="fas fa-image me-2"></i>Nueva Imagen (opcional)
                                </label>
                                <input type="file" 
                                       class="form-control form-control-modern" 
                                       id="imagen" 
                                       name="imagen" 
                                       accept="image/*">
                                <div class="form-text text-light-muted">
                                    <small>Deja vacío para mantener la imagen actual. Formatos admitidos: JPG, PNG, GIF, WebP</small>
                                </div>
                            </div>

                            <!-- Preview de nueva imagen -->
                            <div class="col-12 mb-4">
                                <div id="image-preview" class="d-none">
                                    <label class="form-label form-label-modern">Nueva imagen:</label>
                                    <div class="text-center">
                                        <img id="preview-img" class="img-fluid rounded" style="max-height: 200px; border: 2px solid var(--light-blue);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="index.php" class="btn btn-outline-secondary btn-modern">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-modern">
                                        <i class="fas fa-save me-2"></i>Actualizar Proyecto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Validación de formularios
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Contador de caracteres
        document.getElementById('descripcion').addEventListener('input', function() {
            const charCount = this.value.length;
            document.getElementById('char-count').textContent = charCount;
        });

        // Preview de nueva imagen
        document.getElementById('imagen').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    const img = document.getElementById('preview-img');
                    img.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>