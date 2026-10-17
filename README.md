# Sistema organizador de tareas escolares

Aplicación web para organizar tareas escolares, hecha con CodeIgniter 4 (PHP), Blade y MariaDB. Tiene interfaz en inglés y español.

## Qué incluye

- Registro con correo de activación
- Inicio de sesión con "Remember me"
- Recuperación de contraseña por correo
- Perfil: editar datos, cambiar contraseña, subir y eliminar imagen
- Usuarios (solo administradores): crear, ver, editar y eliminar
- Tareas: crear, ver, editar, eliminar, buscar y paginar

## Arquitectura

Aplicación monolítica de 3 capas:

Controlador -> Servicio -> Repositorio -> Modelo -> Base de datos

Las vistas están en Blade (`app/Views`).

## Requisitos

Ubuntu 22.04 o superior (VirtualBox), PHP 8.1 o superior, MariaDB, Composer y Git.

## Instalación

```bash
git clone https://github.com/mguerrap7-afk/proyecto_finalmg.git
cd proyecto_finalmg
composer install
cp .env.example .env
```

Crea la base de datos:

```sql
CREATE DATABASE proyecto_final CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'taskappd'@'localhost' IDENTIFIED BY 'TU_CLAVE';
GRANT ALL PRIVILEGES ON proyecto_final.* TO 'taskappd'@'localhost';
FLUSH PRIVILEGES;
```

Edita `.env` y cambia los valores `CAMBIAR` (clave de la base de datos y datos SMTP del correo). Después:

```bash
mkdir -p public/uploads/profiles
php spark migrate
php spark serve
```

Abre `http://localhost:8080`.

## Primer administrador

1. Regístrate en `/signup` y activa la cuenta con el enlace del correo.
2. En phpMyAdmin, tabla `users`, cambia `is_admin` a `1`.
3. Cierra sesión y vuelve a entrar.