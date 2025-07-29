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

