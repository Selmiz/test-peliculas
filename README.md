# Proyecto Peliculas y Turnos

Esta Aplicación esta desarrollado en Laravel y VueJs

## Requisitos
Tener instalado nodejs, Laravel y Postgresql

## Pasos para ejecutar la aplicación
1. Clonar repositorio
https://github.com/Selmiz/test-peliculas
2. Una vez clonado el proyecto:

2.1 Ingresar a la carpeta apimovies y ejecutar el comando:
``` composer install ```

2.1.1 Levantar el proyecto con el siguiente comando:
Ejecutar las migraciones y seeders
``` php artisan migrate ```
``` php artisan db:seed ```
``` php artisan storage:link```
``` php artisan serve ```
NOTA: se configuró en la ruta local: http://127.0.0.1:8000

2.2 Ingresar a la carpeta front y ejecutar el comando:
```npm i```

2.2.1 Levantar proyecto
``` npm run serve ```

3. Ingresar a la ruta de front http://localhost:8080/ e iniciar sesión:
con cuenta la siguiente cuenta:
``` usuario: admin@correo.com ```
``` contraseña: password ```

