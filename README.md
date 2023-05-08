## Plantilla Backend con Laravel-Lumen (Con autenticación JWT)
-----------


![jwt-auth-banner](https://cloud.githubusercontent.com/assets/1801923/9915273/119b9350-5cae-11e5-850b-c941cac60b32.png)
-----------
### Tabla de Contenido

[Descripción](#descripcion)

[Consideraciones Previas](#consideraciones-previas)

[Colaboradores](#colaboradores)

[Enlaces de Ayuda](#enlaces-ayuda)

[Licencia](#licencia)

-----------

## Descripción
Sistema Base con autenticación Auth2.

## Consideraciones Previas

Versión de PHP: 8.0.+

Abrir una terminal y ejecutar:

Ejecute **composer update**

**php artisan serve** 
Vaya a su navegador preferido (google Chrome, Firefox u otros) y escriba la siguiente dirección url:
**http://localhost:8000/**

Luego debemos hacer una migracion de las respectivas tablas para hacer uso de Auth2
**php artisan migrate**


Para el manejo de Auth2 es necesario tener dos archivo oauth-private.key y oauth-public.key  para generarlos hacer lo siguiente:
**php artisan passport:install**, este comando creara las dos llaves que necesitamos para generar token de acceso si no hemos echo la migracion con el comando php artisan migrate las creara automaticamente, Tambien podemos hacer uso del siguiente comando 
**php artisan passport:install --uuids** este comando tiene la misma funcion de crear las llaves y realizar la migracion, pero las tablas de que trae por defecto Auth2 el id de cada tabla sera tipo char de 36 caracteres
Luego un:
**php artisan passport:install**

Para actualizar los archivos necesarios para que swagger se ejecute es necesario correr los siguientes 2 comandos (esto cada vez hayan cambios en las api)


**php artisan l5-swagger:generate**

Para poder ver la documentación de swagger visitar la url siguiente:

**http://localhost:8000/api/documentation**




<!--The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).-->

