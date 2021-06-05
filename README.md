## Sobre cstrike-webadmin

El proyecto cstrike-webadmin intenta ser una página que ayude a los administradores agregando las principales características para administrar un servidor actualmente. Facilitamos algunas tareas habituales como gestionar los administradores, asignarle rangos, prohibir jugadores, entre otras cosas.  

### Pre requisitos 📋
```
Composer
NPM
Base de datos relacional (MySQL, MariaDB)
```

### Instalación 🔧

1. Clone el repositorio en su máquina local o servidor

```
# git clone https://github.com/stefanofabi/cstrike-webadmin.git
```

2. Cree una copia del archivo .env.example y cámbiele el nombre a .env. En su interior editaremos las variables de entorno para establecer la conexión a la base de datos

```
# cd cstrike-webadmin
# cp .env.example .env
# vim .env
```

3. Proceda a instalar las dependencias requeridas para el proyecto y generar los archivos javascript y estilos

```
# composer install
# npm install
# npm run dev
```
4. Cree un enlace a la carpeta de almacenamiento que contiene todo lo relacionado con la aplicación y cree la clave de la aplicación que protegerá las sesiones de los usuarios y otros datos.

```
# php artisan storage:link
# php artisan key:generate
```

5. Finalmente ejecute las migraciones y semillas.

```
# php artisan migrate
# php artisan db:seed
```

6. La ejecución de las semillas le permitirá iniciar sesión con algunos usuarios de prueba.
```
- Administrator 
Email: admin@community
Password: password
```

¡Recuerde modificar las contraseñas en producción!


## Contribuyendo

¡Gracias por considerar contribuir con la aplicación cstrike-webadmin! Podés hacerlo en: 
- [MercadoPago](https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c93808479896d7201798d47849b0243)
- [PayPal](https://paypal.me/4evergaming)
- [Bitcoin](https://www.blockchain.com/btc/address/1BxrkKPuLTkYUAeMrxzLEKvr5MGFu3NLpU)

## Hosting
¿Estas considerando alquilar un servidor de Counter-Strike 1.6? No dudes en visitar la página de nuestro principal patrocinador [4evergaming](https://4evergaming.com.ar)
