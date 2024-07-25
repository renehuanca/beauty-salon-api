<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<img src="https://res.cloudinary.com/renehuanca/image/upload/v1721863354/beauty-salon/screenshot-api.png" alt="Swagger beauty api image">

## Beauty Salon API

Este proyecto es una API desarrollada en Laravel para la gestión de un salón de belleza. La API permite la administración de usuarios, servicios y la autenticación de los mismos. Está diseñada para ser robusta, segura y fácil de usar, facilitando la integración con aplicaciones frontend y móviles.

## Caracteristicas

- **Gestion de Usuarios**: Registro, inicio de sesión, actualización de perfil y eliminación de cuentas de usuario.
- **Autenticación**: Implementación de autenticación con tokens de Sanctum para asegurar la comunicación y proteger los datos.
- **Gestión de Servicios**: Creación, actualización, visualización y eliminación de servicios ofrecidos por el salón de belleza.
- **Reservas**: Gestión de reservas para los usuarios, permitiendo la programación de citas.
- **Roles y Permisos**: Diferentes niveles de acceso y permisos para clientes y administradores.

## Requisitos

- PHP >= 8.2
- Composer
- Laravel >= 11
- MySQL o cualquier otra base de datos compatible con Laravel

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/renehuanca/beauty-salon-api.git
    cd beauty-salon-api
    ```

2. Instala las dependencias:
    ```bash
    composer install
    ```

3. Configura el archivo `.env`:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configura tu base de datos en el archivo `.env`.

5. Ejecuta las migraciones y los seeders:
    ```bash
    php artisan migrate --seed
    ```

6. Inicia el servidor de desarrollo:
    ```bash
    php artisan serve
    ```

## Uso

La API utiliza autenticación Sanctum stateless para proteger las rutas. A continuación se muestra como funciona:

La documentación de la api se encuentra accediendo localmente a:

```bash
http://127.0.0.1:8000/api/documentation
```

Luego se le mostrará la interfaz de Swagger: debe registrar un nuevo usuario y se le otorgará un token en cuerpo de la respuesta, luego ir a ```Autorize``` para agregar el token como:

```bash
Bearer tutoken
```

Luego autoriza para poder realizar otras peticiones que estan protegidas.

## Contribución

Si deseas contribuir al proyecto, por favor, sigue los siguientes pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Añadir nueva funcionalidad'`).
4. Empuja la rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

## Licencia

Este proyecto está bajo la licencia MIT.