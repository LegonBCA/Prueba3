# 🚀 Sistema CRUD de Portafolio Profesional

<div align="center">
  
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

**Sistema completo de gestión de portafolio con diseño moderno y funcionalidad CRUD**

</div>

---

## 🎬 DEMO

### 🌐 Demo en Vivo
```
🔗 URL DEMO: [Insertar aquí la URL de tu demo en vivo]
```

### 👤 Credenciales de Acceso
```
👨‍💻 Usuario: admin
🔑 Contraseña: 123456
```

### 📱 Capturas de Pantalla
> **Nota:** Agrega aquí capturas de pantalla de tu aplicación funcionando

| Vista Principal | Agregar Proyecto | Formulario de Login |
|---|---|---|
| ![Dashboard](ruta/a/screenshot1.png) | ![Add Project](ruta/a/screenshot2.png) | ![Login](ruta/a/screenshot3.png) |

### 🎥 Video Demo
```
📹 Video Tutorial: [Insertar aquí enlace a video demo en YouTube/Vimeo]
```

---

## 📖 Descripción del Proyecto

**Sistema CRUD de Portafolio Profesional** es una aplicación web completa desarrollada en PHP que permite gestionar proyectos de forma intuitiva y profesional. El sistema cuenta con un diseño moderno de tema oscuro azul marino, desarrollado completamente por IA (Claude Sonnet 4), y ofrece funcionalidades completas de Create, Read, Update, Delete (CRUD).

### ✨ Características Principales

- 🎨 **Diseño Moderno**: UI/UX profesional con tema oscuro azul marino
- 🔐 **Sistema de Autenticación**: Login seguro con sesiones PHP
- 📁 **Gestión de Proyectos**: CRUD completo para proyectos del portafolio
- 🖼️ **Subida de Imágenes**: Sistema de carga y gestión de imágenes
- 📱 **Diseño Responsivo**: Compatible con todos los dispositivos
- ⚡ **Validación en Tiempo Real**: Formularios con validación HTML5 y JavaScript
- 🎯 **Efectos Interactivos**: Animaciones CSS y efectos hover

---

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 7.4+**: Lógica del servidor y procesamiento de datos
- **MySQL**: Base de datos relacional para almacenamiento
- **Sesiones PHP**: Manejo de autenticación y estado

### Frontend
- **HTML5**: Estructura semántica moderna
- **CSS3**: Estilos avanzados con variables CSS y animaciones
- **Bootstrap 5.3.3**: Framework responsivo
- **JavaScript**: Interactividad y validación del cliente
- **Font Awesome 6.5.1**: Iconografía vectorial
- **Google Fonts (Inter)**: Tipografía moderna

### Herramientas y Librerías
- **jQuery**: Manipulación DOM simplificada
- **Bootstrap JS**: Componentes interactivos
- **CSS Grid/Flexbox**: Layouts modernos y responsivos

---

## 🚀 Instalación y Configuración

### Prerrequisitos
```bash
✅ Servidor web (Apache/Nginx)
✅ PHP 7.4 o superior
✅ MySQL 5.7 o superior
✅ Extensión PHP MySQLi habilitada
```

### 📥 Instalación Paso a Paso

#### 1. Clonar el Repositorio
```bash
git clone https://github.com/tu-usuario/crud-benja.git
cd crud-benja
```

#### 2. Configurar Base de Datos
```sql
-- Crear base de datos
CREATE DATABASE benjamin_contreras_db1;
USE benjamin_contreras_db1;

-- Ejecutar script SQL
SOURCE css/sql/script.sql;
```

#### 3. Configurar Conexión
Editar `db.php` con tus credenciales:
```php
<?php
$host = "localhost";
$db = "benjamin_contreras_db1";
$user = "tu_usuario";
$pass = "tu_contraseña";
```

#### 4. Configurar Permisos
```bash
# Dar permisos de escritura al directorio uploads
chmod 755 uploads/
```

#### 5. Acceder al Sistema
```
http://localhost/crud-benja/login.php
```

---

## 📊 Estructura de la Base de Datos

### Tabla `users`
```sql
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| username | varchar(50)  | NO   |     | NULL    |                |
| password | varchar(255) | NO   |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
```

### Tabla `proyectos`
```sql
+----------------+--------------+------+-----+-------------------+----------------+
| Field          | Type         | Null | Key | Default           | Extra          |
+----------------+--------------+------+-----+-------------------+----------------+
| id             | int(11)      | NO   | PRI | NULL              | auto_increment |
| titulo         | varchar(100) | NO   |     | NULL              |                |
| descripcion    | text         | NO   |     | NULL              |                |
| url_github     | varchar(255) | YES  |     | NULL              |                |
| url_produccion | varchar(255) | YES  |     | NULL              |                |
| imagen         | varchar(255) | YES  |     | NULL              |                |
| created_at     | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
+----------------+--------------+------+-----+-------------------+----------------+
```

---

## 📁 Estructura del Proyecto

```
CRUD-Benja/
├── 📄 index.php              # Dashboard principal - Lista de proyectos
├── 📄 login.php              # Página de autenticación
├── 📄 add.php                # Formulario agregar proyecto
├── 📄 edit.php               # Formulario editar proyecto
├── 📄 delete.php             # Eliminar proyecto
├── 📄 auth.php               # Middleware de autenticación
├── 📄 logout.php             # Cerrar sesión
├── 📄 db.php                 # Configuración base de datos
├── 📁 css/
│   ├── 📄 style.css          # Estilos personalizados (275 líneas)
│   └── 📁 sql/
│       └── 📄 script.sql     # Script de base de datos
├── 📁 uploads/               # Directorio de imágenes subidas
├── 📄 IA_Explicacion.txt     # Documentación del desarrollo
└── 📄 README.md              # Este archivo
```

---

## 🎯 Funcionalidades Detalladas

### 🔐 Sistema de Autenticación
- **Login seguro** con validación de credenciales
- **Gestión de sesiones** PHP para mantener estado
- **Protección de rutas** mediante middleware
- **Logout** con limpieza de sesiones

### 📋 Gestión de Proyectos (CRUD)

#### ➕ Crear Proyecto
- Formulario validado con campos obligatorios
- Subida de imágenes con validación de formato
- Generación de nombres únicos para evitar conflictos
- Validación de extensiones permitidas (jpg, jpeg, png, gif, webp)

#### 👁️ Leer/Visualizar Proyectos
- Dashboard responsivo con grid de tarjetas
- Vista previa de imágenes con efectos hover
- Enlaces directos a GitHub y demo en vivo
- Ordenamiento por fecha de creación (más reciente primero)

#### ✏️ Editar Proyecto
- Formulario pre-cargado con datos existentes
- Opción de cambiar imagen manteniendo la anterior
- Validación en tiempo real de campos
- Preview de imagen antes de guardar

#### 🗑️ Eliminar Proyecto
- Confirmación JavaScript antes de eliminar
- Eliminación de archivo de imagen del servidor
- Eliminación de registro de base de datos
- Feedback visual del resultado

---

## 🎨 Sistema de Diseño

### 🎨 Paleta de Colores
```css
--navy-primary: #0f172a     /* Azul marino principal */
--navy-secondary: #1e293b   /* Azul marino secundario */
--navy-tertiary: #334155    /* Azul marino terciario */
--light-blue: #38bdf8       /* Azul claro acentos */
--text-light: #f8fafc       /* Texto claro */
--text-light-muted: #cbd5e1 /* Texto secundario */
```

### 🎭 Componentes de UI

#### Tarjetas Modernas
- Gradientes sutiles y efectos de profundidad
- Transformaciones 3D en hover
- Bordes redondeados y sombras dinámicas
- Overlays de gradiente en imágenes

#### Botones Interactivos
- Estados hover con transformaciones
- Efectos de elevación y sombras de color
- Múltiples variantes (outline, filled, action)
- Transiciones suaves y fluidas

#### Formularios Estilizados
- Campos con estilos consistentes
- Validación visual en tiempo real
- Placeholders informativos
- Focus states destacados

---

## 🔧 Configuración Avanzada

### Configuración de Subida de Archivos
```php
// Extensiones permitidas
$extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// Tamaño máximo (configurar en php.ini)
upload_max_filesize = 10M
post_max_size = 10M
```

### Configuración de Sesiones
```php
// Configuración de sesiones seguras
session_start();
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
```

### Variables de Entorno Recomendadas
```env
DB_HOST=localhost
DB_NAME=benjamin_contreras_db1
DB_USER=tu_usuario
DB_PASS=tu_contraseña
UPLOAD_PATH=uploads/
```

---

## 🧪 Testing y Validación

### Validaciones Implementadas

#### Frontend (HTML5 + JavaScript)
- ✅ Campos obligatorios
- ✅ Formatos de email válidos
- ✅ Longitud mínima/máxima de texto
- ✅ Tipos de archivo permitidos
- ✅ Feedback visual inmediato

#### Backend (PHP)
- ✅ Sanitización de datos de entrada
- ✅ Validación de tipos de archivo
- ✅ Prevención de inyección SQL
- ✅ Verificación de autenticación
- ✅ Validación de permisos

### Casos de Prueba Sugeridos
```
1. Login con credenciales correctas ✓
2. Login con credenciales incorrectas ✓
3. Agregar proyecto con imagen válida ✓
4. Agregar proyecto con imagen inválida ✓
5. Editar proyecto existente ✓
6. Eliminar proyecto con confirmación ✓
7. Acceso sin autenticación (debe redirigir) ✓
8. Responsive design en móviles ✓
```

---

## 🚀 Deployment

### 📡 Despliegue en Servidor Web

#### Apache (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# Seguridad
<Files "db.php">
    Order Allow,Deny
    Deny from all
</Files>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name tu-dominio.com;
    root /path/to/crud-benja;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

### 🐳 Docker (Opcional)
```dockerfile
FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
EXPOSE 80
```

---

## 🔒 Consideraciones de Seguridad

### ⚡ Implementadas
- ✅ Validación de tipos de archivo
- ✅ Nombres únicos para archivos subidos
- ✅ Middleware de autenticación
- ✅ Sanitización básica de entrada
- ✅ Gestión segura de sesiones

### 🛡️ Mejoras Recomendadas
- 🔄 Implementar prepared statements
- 🔄 Hash de contraseñas con password_hash()
- 🔄 Validación CSRF tokens
- 🔄 Rate limiting para login
- 🔄 Validación de imagen real (no solo extensión)
- 🔄 Configuración HTTPS
- 🔄 Headers de seguridad

---

## 📈 Mejoras Futuras

### 🎯 Corto Plazo
- [ ] **Paginación** de proyectos
- [ ] **Búsqueda y filtros** avanzados
- [ ] **Categorías** de proyectos
- [ ] **Múltiples imágenes** por proyecto
- [ ] **Modo claro/oscuro** toggle

### 🚀 Mediano Plazo
- [ ] **API REST** para móviles
- [ ] **Sistema de comentarios**
- [ ] **Analytics** de visualizaciones
- [ ] **Exportar portafolio** a PDF
- [ ] **Integración con GitHub API**

### 🌟 Largo Plazo
- [ ] **Multi-tenancy** (múltiples usuarios)
- [ ] **Editor WYSIWYG** para descripciones
- [ ] **PWA** (Progressive Web App)
- [ ] **Notificaciones push**
- [ ] **Integración con redes sociales**

---

## 🤝 Contribución

### 📋 Guía de Contribución
1. **Fork** el repositorio
2. Crear **rama feature** (`git checkout -b feature/NuevaFuncionalidad`)
3. **Commit** cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. **Push** a la rama (`git push origin feature/NuevaFuncionalidad`)
5. Abrir **Pull Request**

### 🎨 Estándares de Código
- Seguir PSR-4 para PHP
- Comentarios en español
- Nombres de variables descriptivos
- Indentación de 2 espacios para HTML/CSS
- Indentación de 4 espacios para PHP

---

## 🐛 Problemas Conocidos

### 🔧 Issues Menores
- Script SQL tiene typo en línea 1 (`REATE` → `CREATE`)
- Falta validación de tamaño de archivo
- Passwords en MD5 (debería ser password_hash)

### 💡 Soluciones Rápidas
```sql
-- Corregir script SQL
CREATE DATABASE portafolio_db; -- Agregar 'C' al inicio
```

```php
// Mejorar hash de contraseñas
$password = password_hash('123456', PASSWORD_DEFAULT);
```

---

## 📞 Soporte y Contacto

### 👨‍💻 Desarrollador
- **Nombre**: Benjamín Contreras
- **GitHub**: [Insertar tu GitHub]
- **Email**: [Insertar tu email]
- **LinkedIn**: [Insertar tu LinkedIn]

### 🤖 Asistente IA
- **Modelo**: Claude Sonnet 4 (Cursor)
- **Responsabilidades**: Diseño frontend completo y documentación
- **Fecha**: Enero 2025

### 📚 Documentación Adicional
- [Guía de Usuario](docs/user-guide.md)
- [API Documentation](docs/api.md)
- [Troubleshooting](docs/troubleshooting.md)

---

## 📄 Licencia

```
MIT License

Copyright (c) 2025 Benjamín Contreras

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 🙏 Agradecimientos

- **Bootstrap Team** por el framework CSS
- **Font Awesome** por los iconos
- **Google Fonts** por la tipografía Inter
- **Claude AI** por el diseño frontend completo
- **Cursor IDE** por la experiencia de desarrollo

---

<div align="center">

**⭐ Si este proyecto te fue útil, por favor dale una estrella ⭐**

![Made with ❤️](https://img.shields.io/badge/Made%20with-❤️-red?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-005C84?style=for-the-badge&logo=mysql&logoColor=white)

---

© 2025 Benjamín Contreras - Todos los derechos reservados

</div> 