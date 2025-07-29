# Sistema para dar reseñas de canciones "SongReviews"
Equipo numero 5
Integrantes: Juárez Fernández Eric Aarón, Zenón Regalado Vicente de Jesús

#¿Qué hace el sistema?

*Una aplicación web de reseñas musicales donde los usuarios pueden explorar artistas, álbumes y canciones, calificarlas con estrellas (1-5) y dejar comentarios. Incluye un panel de administración completo para gestionar todo el contenido: crear/eliminar artistas, álbumes y canciones, administrar usuarios y moderar comentarios. Es como un Spotify + Goodreads pero para música, con funcionalidades tanto para usuarios finales como para administradores.


#Tipo de sistema

*Sistema web de gestión de contenido con funcionalidades sociales

#Funciones clave del sistema 
* Proceso de logueo
  ![Untitled](https://github.com/user-attachments/assets/92e67420-e213-4357-ab2a-f5a77e359a23)

* Proceso para crear una cuenta de usuario normal
  <img width="1919" height="886" alt="image" src="https://github.com/user-attachments/assets/23416ffc-b67a-4f93-9d79-014704edbc93" />

*Panel de administrador
![Untitled-1](https://github.com/user-attachments/assets/599bf0b7-d2a0-4692-bd71-5e4143e39d3b)

* CRUD de usuarios
  ![Untitled](https://github.com/user-attachments/assets/05b6f406-b5b2-458b-a095-5002c2c8dc5c)

* CRUD de artistas
  ![Untitled-1](https://github.com/user-attachments/assets/284021df-6d70-4daa-9ccf-165b2e187989)

  
* CRUD de albumes
  ![Untitled-1](https://github.com/user-attachments/assets/c96e26fe-c39e-4698-b13e-7d21f74364b9)

* CRUD de canciones
![Untitled](https://github.com/user-attachments/assets/23c2d01e-a315-468a-80ec-a1e0577fb3f7)

*CRUD de comentarios
![Untitled](https://github.com/user-attachments/assets/6b173fda-2db9-4be9-bbdd-1bfecf9809f3)



#Proceso principal (comentar opiniones sobre canciones y calificarlas)

![Untitled-1](https://github.com/user-attachments/assets/1fd08178-e728-4bdf-b14b-0153c21d35a8)


#Otras funcionalidades
* ver y buscar artistas
![Untitled-2](https://github.com/user-attachments/assets/be04d13a-0875-4a54-978d-2b7c4a10cb8e)

*ver informacion de los artistas, como los albumes y sus canciones
![Untitled-1](https://github.com/user-attachments/assets/c48ae034-e213-4e72-9181-d122ac3af5b3)

*Ver y crear playlist personales
![Untitled-2](https://github.com/user-attachments/assets/c64f27db-734f-4443-b4ce-51a50de87e86)






 #3. APIS laravel y consumo de las mismas con imágenes


Todos los Endpoints de tu API

**USUARIOS**
```http
GET     /api/usuarios                    # Listar todos los usuarios
POST    /api/usuarios                    # Crear nuevo usuario
GET     /api/usuarios/{id}               # Ver usuario específico
PUT     /api/usuarios/{id}               # Actualizar usuario
DELETE  /api/usuarios/{id}               # Eliminar usuario

# Endpoints especiales de usuarios
POST    /api/login                       # Login (ruta simple)
POST    /api/usuarios/login              # Login (ruta alternativa)
POST    /api/usuarios/register           # Registro de usuario
PUT     /api/usuarios/{id}/password      # Cambiar contraseña
```

**ARTISTAS**
```http
GET     /api/artistas                    # Listar todos los artistas
POST    /api/artistas                    # Crear nuevo artista
GET     /api/artistas/{id}               # Ver artista específico
PUT     /api/artistas/{id}               # Actualizar artista
DELETE  /api/artistas/{id}               # Eliminar artista

# Endpoints especiales de artistas
GET     /api/artistas/{id}/canciones     # Ver canciones de un artista
```

**ÁLBUMES**
```http
GET     /api/albumes                     # Listar todos los álbumes
POST    /api/albumes                     # Crear nuevo álbum
GET     /api/albumes/{id}                # Ver álbum específico
PUT     /api/albumes/{id}                # Actualizar álbum
DELETE  /api/albumes/{id}                # Eliminar álbum
```

**CANCIONES**
```http
GET     /api/canciones                   # Listar todas las canciones
POST    /api/canciones                   # Crear nueva canción
GET     /api/canciones/{id}              # Ver canción específica
PUT     /api/canciones/{id}              # Actualizar canción
DELETE  /api/canciones/{id}              # Eliminar canción
```



**CALIFICACIONES DE CANCIONES**
```http
GET     /api/calificaciones-cancion      # Ver todas las calificaciones de canciones
POST    /api/calificaciones-cancion      # Crear/actualizar calificación de canción
GET     /api/calificaciones-cancion/{id} # Ver calificación específica
PUT     /api/calificaciones-cancion/{id} # Actualizar calificación
DELETE  /api/calificaciones-cancion/{id} # Eliminar calificación
```

**PLAYLISTS**
```http
GET     /api/playlists                   # Listar todas las playlists
POST    /api/playlists                   # Crear nueva playlist
GET     /api/playlists/{id}              # Ver playlist específica
PUT     /api/playlists/{id}              # Actualizar playlist
DELETE  /api/playlists/{id}              # Eliminar playlist
```

**PLAYLIST-CANCIONES (Relación)**
```http
GET     /api/playlist-canciones          # Ver todas las relaciones playlist-canción
POST    /api/playlist-canciones          # Agregar canción a playlist
GET     /api/playlist-canciones/{id}     # Ver relación específica
PUT     /api/playlist-canciones/{id}     # Actualizar relación
DELETE  /api/playlist-canciones/{id}     # Quitar canción de playlist
```

**ARTISTA-CANCIÓN (Relación)**
```http
GET     /api/artista-cancion             # Ver todas las relaciones artista-canción
POST    /api/artista-cancion             # Crear relación artista-canción
GET     /api/artista-cancion/{id}        # Ver relación específica
PUT     /api/artista-cancion/{id}        # Actualizar relación
DELETE  /api/artista-cancion/{id}        # Eliminar relación
```

**BÚSQUEDA**
```http
GET     /api/buscar?q={termino}          # Búsqueda inteligente global
```

**CORS**
```http
OPTIONS /{any}                           # Manejo de preflight CORS
```

**Resumen por categorías:**

| Categoría | Endpoints | Funcionalidades |
|-----------|-----------|-----------------|
| **Usuarios** | 8 | CRUD + Login + Registro + Cambio password |
| **Artistas** | 6 | CRUD + Ver sus canciones |
| **Álbumes** | 5 | CRUD completo |
| **Canciones** | 5 | CRUD completo |
| **Calificaciones** | 10 | CRUD para álbumes y canciones |
| **Playlists** | 5 | CRUD completo |
| **Relaciones** | 10 | Gestión de relaciones many-to-many |
| **Búsqueda** | 1 | Búsqueda inteligente global |
| **CORS** | 1 | Soporte para frontend |







**Framework Principal:**
- **Angular 20.0.0** (última versión)
- **TypeScript 5.8.2**
- **Node.js** + **Express 5.1.0**

**Dependencias principales:**
```json
{
  "@angular/core": "^20.0.0",
  "@angular/forms": "^20.0.0",      // Para formularios reactivos
  "@angular/router": "^20.0.0",     // Para rutas
  "@angular/common": "^20.0.0",     // Pipes y directivas comunes
  "@angular/ssr": "^20.0.5",        // Server-Side Rendering
  "rxjs": "~7.8.0",                 // Programación reactiva
  "zone.js": "~0.15.0"              // Detección de cambios
}
```

**Herramientas de desarrollo:**
```json
{
  "@angular/cli": "^20.0.5",        // CLI de Angular
  "@angular/build": "^20.0.5",     // Sistema de build
  "jasmine": "~5.7.0",             // Testing framework
  "karma": "~6.4.0",               // Test runner
  "typescript": "~5.8.2"           // Compilador TypeScript
}
```

**Configuraciones especiales:**
- **SSR habilitado** (Server-Side Rendering)
- **Prettier configurado** para HTML Angular
- **TypeScript estricto** activado
- **Standalone components** (sin NgModules)
- **Puerto de desarrollo:** 4200
- **Soporte para assets** en public y `src/assets/`

**Backend esperado:**
- **Laravel API** en `http://127.0.0.1:8000`
- **Endpoints:** `/api/artistas`, `/api/albumes`, `/api/canciones`, `/api/usuarios`, `/api/calificaciones-cancion`

**Estructura de assets:**
- Imágenes en assets
- SVGs por defecto para álbumes y artistas
- Soporte para carga de archivos (imágenes de artistas/álbumes)




**Requisitos mínimos del sistema:**

**Software base:**
- **XAMPP 8.0+** (incluye Apache + MySQL + PHP)
- **Node.js 18+** (para Angular)
- **npm 9+** (gestor de paquetes)
- **Composer 2.0+** (para Laravel)

**Base de datos:**
- **MySQL 8.0+** (incluido en XAMPP)
- **phpMyAdmin** (para gestión visual de BD)

**Navegador:**
- **Chrome 100+**, **Firefox 100+**, **Edge 100+** o **Safari 15+**

**Estructura de servicios:**

**Frontend (Angular):**
```
Puerto: 4200
URL: http://localhost:4200
Comando: npm start
```

**Backend (Laravel):**
```
Puerto: 8000
URL: http://127.0.0.1:8000
Comando: php artisan serve
```

**Base de datos (MySQL):**
```
Puerto: 3306
Host: localhost
Usuario: root
Contraseña: (vacía por defecto)
```

**Configuración mínima:**
- **RAM:** 4GB mínimo, 8GB recomendado
- **Espacio en disco:** 2GB libres
- **PHP:** 8.1+ con extensiones: mysql, pdo, json, mbstring

**Pasos de instalación:**
1. Instalar **XAMPP**
2. Instalar **Node.js**
3. Instalar **Composer**
4. Crear base de datos en **phpMyAdmin**
5. Configurar **Laravel** (.env)
6. Ejecutar migraciones
7. Iniciar ambos servidores





**Instrucciones completas para ejecutar el proyecto:**

**PASO 1: Preparar la Base de Datos**

1. **Abrir XAMPP Control Panel**
2. **Iniciar servicios:**
   ```
   ✅ Apache → Start
   ✅ MySQL → Start
   ```
3. **Crear base de datos:**
   - Ir a `http://localhost/phpmyadmin`
   - Crear nueva base de datos: `song_review_db`
   - Collation: `utf8mb4_unicode_ci`

**PASO 2: Configurar Laravel (Backend)**

1. **Navegar a la carpeta del backend:**
   ```bash
   cd ruta/del/proyecto/laravel
   ```

2. **Instalar dependencias:**
   ```bash
   composer install
   ```

3. **Configurar archivo .env:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=song_review_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Ejecutar migraciones:**
   ```bash
   php artisan migrate
   ```

5. **Iniciar servidor Laravel:**
   ```bash
   php artisan serve
   ```
   ✅ **Resultado:** `http://127.0.0.1:8000`

**PASO 3: Configurar Angular (Frontend)**

1. **Abrir nueva terminal**
2. **Navegar a la carpeta del frontend:**
   ```bash
   cd ruta/del/proyecto/song-review-app
   ```

3. **Instalar dependencias:**
   ```bash
   npm install
   ```

4. **Iniciar servidor Angular:**
   ```bash
   npm start
   ```
**Resultado:** `http://localhost:4200`

**PASO 4: Verificar que todo funciona**

1. **Backend funcionando:**
   - Ir a `http://127.0.0.1:8000/api/artistas`
   - Debe mostrar JSON (aunque esté vacío)

2. **Frontend funcionando:**
   - Ir a `http://localhost:4200`
   - Debe cargar la aplicación

3. **Panel admin:**
   - Ir a `http://localhost:4200/home-admin`
   - Debe cargar el panel de administración

**COMANDOS RÁPIDOS:**

**Para iniciar todo el proyecto:**
```bash
# Terminal 1 - Laravel
cd proyecto/laravel
php artisan serve

# Terminal 2 - Angular  
cd proyecto/song-review-app
npm start

# XAMPP - Encender Apache y MySQL
```

**Solución de problemas comunes:**

- **Error de conexión DB:** Verificar que MySQL esté corriendo en XAMPP
- **Puerto ocupado:** Cambiar puerto con `ng serve --port 4201`
- **Error de CORS:** Verificar que Laravel esté en puerto 8000
- **Error 404 Laravel:** Ejecutar `php artisan route:list` para ver rutas

