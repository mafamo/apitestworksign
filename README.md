# Prueba de un api rest para fichajes

El proyecto está realizado en Laravel 9 y por lo tanto necesita una versión superior a php 8.0.6. Para facilitar las cosas se entrega junto a los ficheros necesarios para generar su propia composición de contenedores con Docker. Es requisito que la máquina donde se pruebe tenga instalados tanto Docker como Docker Compose.

## Instalación

### Docker

Para facilitar el uso con la aplicación se han añadido uns scripts shell, los más útiles son:

* _start_ Inicia el contenedor y si la imágen no existe la crea.
* _shell_ Da acceso a la shell dentro del contenedor.
* _stop_ Para el contenedor.

### Laravel.

Para terminar la instalación del proyecto hay que entrar en la shell del contenedor una vez iniciado este para ejecutar una serie de pasos:

1 _Instalación de dependencias_

```BASH
composer install
```
2 _Inicialización de la BBDD_

```BASH
php artisan migrate --seed
```

## Uso

Una vez terminada la instalación se pueden utilizar ya los puntos de acceso de la api en la ruta [http://localhost:8080](http://localhost:8080) y se puede ver la BBDD creada en un PHPMYADMIN accesible en [http://localhost:8081](http://localhost:8081).

Para facilitar las pruebas de los puntos de acceso se ha añadido un [proyecto](./Insomnia_ApiTestWorkSign.json) de [Insomnia](https://insomnia.rest/).

No hay autentificación.

Los puntos de acceso creados son los siquientes.

* GET User

    GET http://localhost:8080/api/user/{user_id}

* CREATE User

    POST http://localhost:8080/api/user/create

    PARAMS:
    ```JSON
    {
        "name": "Test",
        "email": "test@test.com"
    }
    ```
* DELETE User

    DELETE http://localhost:8080/api/user/{user_id}

* UPDATE User

    PUT http://localhost:8080/api/user/{user_id}

    PARAMS:

    ```JSON
    {
	    "name": "Test updated",
	    "email": "test1update@test.com"
    }
    ```
* GET ALL Users

    GET http://localhost:8080/api/user/all

* GET WorkEntry

    GET http://localhost:8080/api/workentry/{workentry_id}

* CREATE WorkEntry

    POST http://localhost:8080/api/workentry/create

    PARAMS:

    ```JSON
    {
	    "user_id": 2,
	    "start_date": "2022-05-01 10:00:00",
	    "end_date": "2022-05-01 18:00:00"
    }
    ```
* DELETE WorkEntry

    DELETE http://localhost:8080/api/workentry/{workentry_id}

* UPDATE WorkEntry

    PUT http://localhost:8080/api/workentry/{workentry_id}

    PARAMS:

    ```JSON
    {
	    "user_id": 2,
	    "start_date": "2022-05-01 10:00:00",
	    "end_date": "2022-05-01 18:00:00"
    }
    ```
* GET BY USER WorkEntries

    GET http://localhost:8080/api/workentry/user/{user_id}

Además también se han creado unos pocos test de aceptación que se pueden ejecutar dentro de la shell del contenedor de la siguiente forma:

```BASH
php artisan test
```
