# Symfony Skeleton

## Rama main
En esta rama esta la configuracion basica de solo symfony sin BD

## Rama data_base_skeleton

En esta rama se ecuentra la configuracion de la conexion a un BD postgressql

En esta rama esta la configuracion basica de un esqueleto con symfony-6.1, php:8.2 y postgresql 16

Tambien el correspondiente docker con su archivo de make file.

### Antes de crear asegurese que todas las referecnias, a los nombres de contenendores red y demas comfiguracion de docker en el **docker-compose.yml** y Makefile correspondan a los nombres que se desee poner a las aplicaciones 

## Proceso para crear un proyecto en symfony con docker php > 8 doctrine

Estos son los pasos a seguir cuando desee crear un proyecto de symfony para futuras pruebas, videos de configuracion [link](https://www.youtube.com/watch?v=4BfbO3QN-pY) y [link](https://www.youtube.com/watch?v=bqaMXiw1Xjw)

## Contenedores Docker

### Construir el contenedor Docker

```bash
make build
```

### iniciar los contenedores Docker:
```bash
make start
```

## Crear el proyecto symfony

## Ingresar al contenedor para crear el proyecto de symfony

```bash
make ssh-be
```

### En el contenedor ejecutar el comando para crear el proyecto

```bash
symfony new --dir=project --full
```
creamos el proyecto en una carpeta llamada **project** dado que si lo creamos en la misma carpeta de la que estamos aprtiendo nos va a dar error, por que ya existen archivos ahi.
Puede dar error por la configuracion de git pero si es por ese no hay lio ```exit status 128```

Movemos el contenido de la carpeta **project** a la carpeta raiz y eliminamos la carpeta **project**

Se crean archivos como el **compose.yml** este se verifica y si ya tiene lo que hemos de instalar en el **docker-compose.yml** lo eliminamos


### Iniciar los servicios del contenedor en un servidor de symfony:

se puede hacer desde dentro del contenedor, pero tambien se puede realizar desde fuera con ayuda del comando
```bash
make run
```

Posteriormente se procede a probar si se ha ejecutado correctamente hiendo a la ruta ***http://localhost:1000/***

## instalamos el orm

dentro del contenedor ejecutamos

```bash
composer require orm
```

## Cambiamos la configuracion del ***.env*** para que haga la conexion con la BD

La informacion de usuario contraseña y base de datos se encunentra en el archivo
**docker-compose.yml** en dodne se definio el contenedor de mysql, la direccion a la  que debe apuntar no es local host dado que se estan ejecutando en la misma red
```yml
container_name: symfony_skeleton-postgres
POSTGRES_USER: user
POSTGRES_PASSWORD: passwd
POSTGRES_DB: symfony_skeleton
```

```bash
DATABASE_URL="postgresql://user:passwd@symfony_skeleton-postgres:5432/symfony_skeleton?serverVersion=16&charset=utf8"
```

### Se reinician los conntenedores para verificar la conexion y se crea la BD
```bash
make restart
```

## Instalacion del command business

Instalar el bundle
```bash 
composer require league/tactician-bundle
```

dentro del archivo **services.yml** configuramos para que se puedan establecer los buses de inyeccion
```yml
    App\Application\:
        resource: '../src/Application/*'
        exclude: '../src/Application/*/Command/*'
        tags:
            - { name: tactician.handler, typehints: true }
```
## estructura de carpetas para que funcione la inyeccion de dependencias
```
    src
    |---Application
    |   |---AlgunaAplicacion
    |       |---Command
    |       |   |---AlgoCommand.php
    |       |---AlgoHandler.php
    |---Command
    |   |---AlgunaAplicacion
    |       |---EjecutaAlgoCommand.php
    |---Controller
    |   |---AlgunaAplicacion
    |       |---RutaController.php
    |---Service
    |   |---AlgunaAplicacion
    |       |---AlgunService.php
    |       |---AlgunClient.php
    |---Repository
    |   |---AlgunaAplicacion
    |       |---AlgunRepository.php
    |---...
```

## Autenticacion de usuario con jwt

Generar las claves publicas y privadas con el comando 
``` sf lexik:jwt:generate-keypair ```

