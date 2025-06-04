<?php
// ===================================================================
// ARCHIVO: index.php
// PROPÓSITO: Dashboard principal del portafolio - Mostrar proyectos
// AUTOR: Desarrollado por usuario, comentado por IA
// ===================================================================

// Incluir middleware de autenticación
// Verificar que el usuario esté logueado antes de mostrar el dashboard
include 'auth.php';

// Incluir configuración de base de datos
// Obtener conexión para consultar proyectos
include 'db.php';

// Consulta SQL para obtener todos los proyectos
// ORDER BY created_at DESC ordena los proyectos del más reciente al más antiguo
// Esto muestra primero los proyectos agregados recientemente
$result = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio de Proyectos</title>
    
    <!-- Bootstrap CSS 5.3.3 - Framework para diseño responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome - Iconos vectoriales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Tipografía Inter moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Estilos personalizados del sistema -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark-blue">
    
    <!-- Barra de navegación principal -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-lg mb-5">
        <div class="container">
            <!-- Logo y título del portafolio -->
            <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="#">
                <i class="fas fa-code text-light-blue me-3 fs-3"></i>
                <span class="text-light">Mi Portafolio</span>
            </a>
            
            <!-- Botones de acción en la navbar -->
            <div class="d-flex gap-3">
                <!-- Botón para agregar nuevo proyecto -->
                <a href="add.php" class="btn btn-outline-light-blue btn-modern">
                    <i class="fas fa-plus me-2"></i>Nuevo Proyecto
                </a>
                
                <!-- Botón para cerrar sesión -->
                <a href="logout.php" class="btn btn-outline-danger btn-modern">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- Sección hero con título principal -->
    <div class="container mb-5">
        <div class="text-center py-5">
            <!-- Título principal del dashboard -->
            <h1 class="display-4 fw-bold text-light mb-3">
                <i class="fas fa-laptop-code text-light-blue me-3"></i>
                Mis Proyectos
            </h1>
            
            <!-- Subtítulo descriptivo -->
            <p class="lead text-light-muted fs-5 mb-4">Explora los proyectos que he desarrollado</p>
            
            <!-- Línea decorativa -->
            <div class="d-inline-block">
                <div class="bg-light-blue" style="height: 3px; width: 80px; border-radius: 50px;"></div>
            </div>
        </div>
    </div>

    <!-- Grid de proyectos -->
    <div class="container">
        <div class="row g-4">
            
            <!-- Verificar si hay proyectos en la base de datos -->
            <?php if($result->num_rows > 0): ?>
                
                <!-- LOOP: Iterar sobre cada proyecto encontrado -->
                <?php while($row = $result->fetch_assoc()): ?>
                    
                    <!-- Columna responsiva para cada tarjeta de proyecto -->
                    <!-- col-md-6: 2 columnas en pantallas medianas -->
                    <!-- col-lg-4: 3 columnas en pantallas grandes -->
                    <div class="col-md-6 col-lg-4">
                        
                        <!-- Tarjeta del proyecto con altura uniforme -->
                        <div class="card card-modern h-100 border-0 shadow-lg">
                            
                            <!-- Contenedor de imagen con overlay -->
                            <div class="card-img-container">
                                <!-- Imagen del proyecto desde directorio uploads -->
                                <img src="uploads/<?= $row['imagen'] ?>" class="card-img-top" alt="<?= $row['titulo'] ?>">
                                
                                <!-- Gradiente superpuesto para mejor legibilidad -->
                                <div class="card-img-overlay-gradient"></div>
                            </div>
                            
                            <!-- Contenido de la tarjeta -->
                            <div class="card-body p-4">
                                
                                <!-- Título del proyecto -->
                                <h5 class="card-title text-light fw-bold mb-3"><?= $row['titulo'] ?></h5>
                                
                                <!-- Descripción del proyecto -->
                                <p class="card-text text-light-muted mb-4"><?= $row['descripcion'] ?></p>
                                
                                <!-- Enlaces externos del proyecto -->
                                <div class="d-flex gap-2 mb-4">
                                    
                                    <!-- Botón GitHub (solo si existe URL) -->
                                    <?php if(!empty($row['url_github'])): ?>
                                        <a href="<?= $row['url_github'] ?>" class="btn btn-sm btn-outline-light-blue" target="_blank">
                                            <i class="fab fa-github me-1"></i>GitHub
                                        </a>
                                    <?php endif; ?>
                                    
                                    <!-- Botón Demo en vivo (solo si existe URL) -->
                                    <?php if(!empty($row['url_produccion'])): ?>
                                        <a href="<?= $row['url_produccion'] ?>" class="btn btn-sm btn-light-blue" target="_blank">
                                            <i class="fas fa-external-link-alt me-1"></i>Ver Demo
                                        </a>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Botones de administración CRUD -->
                                <div class="d-flex gap-2">
                                    
                                    <!-- Botón EDITAR: redirige a edit.php con ID -->
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success btn-action">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    
                                    <!-- Botón ELIMINAR: redirige a delete.php con confirmación JavaScript -->
                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger btn-action" onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <!-- FIN del loop de proyectos -->
                <?php endwhile; ?>
            
            <!-- ESTADO VACÍO: Mostrar cuando no hay proyectos -->
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        
                        <!-- Diseño de estado vacío motivacional -->
                        <div class="empty-state">
                            <!-- Icono grande para estado vacío -->
                            <i class="fas fa-folder-open text-light-blue display-1 mb-4"></i>
                            
                            <!-- Mensaje principal -->
                            <h3 class="text-light mb-3">No hay proyectos aún</h3>
                            
                            <!-- Mensaje motivacional -->
                            <p class="text-light-muted mb-4">Comienza agregando tu primer proyecto</p>
                            
                            <!-- Botón de llamada a la acción -->
                            <a href="add.php" class="btn btn-light-blue btn-lg">
                                <i class="fas fa-plus me-2"></i>Agregar Primer Proyecto
                            </a>
                        </div>
                    </div>
                </div>
            
            <!-- FIN de la condición de proyectos -->
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer de la página -->
    <footer class="text-center py-5 mt-5">
        <div class="container">
            <p class="text-light-muted mb-0">
                <i class="fas fa-heart text-danger me-2"></i>
                Prueba numero 3
            </p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript para funcionalidad interactiva -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>