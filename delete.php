<?php
// ===================================================================
// ARCHIVO: delete.php
// PROPÓSITO: Eliminar un proyecto específico de la base de datos
// AUTOR: Desarrollado por usuario, comentado por IA
// ===================================================================

// Incluir middleware de autenticación
// Verificar que el usuario esté logueado antes de permitir eliminación
include 'auth.php';

// Incluir configuración de base de datos
// Obtener la conexión $conn para realizar operaciones SQL
include 'db.php';

// Obtener el ID del proyecto a eliminar desde la URL
// $_GET['id'] contiene el parámetro pasado como ?id=valor en la URL
// Este ID identifica de forma única el proyecto a eliminar
$id = $_GET['id'];

// Ejecutar consulta SQL para eliminar el proyecto
// DELETE FROM elimina registros que cumplan la condición WHERE
// Se elimina el proyecto cuyo campo 'id' coincida con el valor recibido
$conn->query("DELETE FROM proyectos WHERE id=$id");

// Redirigir de vuelta al dashboard principal
// Después de eliminar, mostrar la lista actualizada de proyectos
header("Location: index.php");

// NOTA: Esta implementación es básica y podría mejorarse con:
// - Validación del ID recibido
// - Verificación de que el proyecto existe antes de eliminar
// - Prepared statements para mayor seguridad
// - Confirmación de eliminación exitosa
?>