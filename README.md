Tienda en Línea
================

Este proyecto está basado en Laravel, tiene instalados los módulos "mcamara/laravel-localization" para manejo de múltiples idiomas y "zizaco/confide" para gestión de usuarios

Estructura del proyecto
-----------------------
Carpeta raíz / : Se encuentra el script de generación de la base de datos inicial con las tablas y datos necesarios para empezar el desarrollo.
Carpeta /src: En esta carpeta se encuentra la la instalación de Laravel 4.2 con los módulos descritos anteriormente
Carpeta /inspinia_admin_theme: Contiene el template en el cual se basa el diseño de la interfaz gráfica del proyecto

Plantillas y diseño de pantallas
---------------------------------
Se cuenta con la plantilla base "src/app/views/layouts/template.blade.php", en la cual debe basarse el desarrollo de todas las vistas del proyecto.

La plantilla base puede parecer incompleta, pero no es necesario y debe modificarse nada en ella, a excepción de corrección de errores, los cuales deben ser notificados a los administradores del proyecto.

El template
------------
Favor de tomar los controles y demás elementos gráficos de la plantilla ubicada en /inspinia_admin_theme

Estándares de desarrollo
-------------------------
Debe apegarse a los estándares PSR-1 y PSR-2 en cuanto a convenciones de nombramiento de objetos y estilo de codificación
https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md

Documentación del código
------------------------
Debe apegarse al estántar PSR-5 de PHPDoc.
Documentar todas las clases y funciones generadas, cómo mínimo el propósito de cada clase y función, los parámetros que recibe y la salida éstas, así como el propósito de las variables y las secciones importantes dentro de cada función o método.
https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md
