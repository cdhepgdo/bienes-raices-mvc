<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\BlogController;
use Controllers\loginController;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasControllers;
use Model\Propiedad;

$router = new Router();
//debuguear(new PropiedadController);
PropiedadController::setRouterInstance($router);

//ACCESO PRIVADO
//propiedades
$router->get(
    '/admin', 
    PropiedadController::class . '::index'
);

$router->get(
    '/propiedades/crear',
    PropiedadController::class . '::crear'
);
$router->post(
    '/propiedades/crear',
    PropiedadController::class . '::crear'
);

$router->get(
    '/propiedades/actualizar', PropiedadController::class . '::actualizar'
);
$router->post(
    '/propiedades/actualizar', PropiedadController::class . '::actualizar'
);
$router->post(
    '/propiedades/eliminar', PropiedadController::class . '::eliminar'
);


//vendedores

$router->get(
    '/vendedores/crear',
    VendedorController::class . '::crear'
);
$router->post(
    '/vendedores/crear',
    VendedorController::class . '::crear'
);

$router->get(
    '/vendedores/actualizar', VendedorController::class . '::actualizar'
);
$router->post(
    '/vendedores/actualizar', VendedorController::class . '::actualizar'
);
$router->post(
    '/vendedores/eliminar', VendedorController::class . '::eliminar'
);

//entradas-blog
$router->get(
    '/entradas_blog/crear',
    BlogController::class . '::crear'
);
$router->post(
    '/entradas_blog/crear',
    BlogController::class . '::crear'
);

$router->get(
    '/entradas_blog/actualizar', BlogController::class . '::actualizar'
);
$router->post(
    '/entradas_blog/actualizar', BlogController::class . '::actualizar'
);
$router->post(
    '/entradas_blog/eliminar', BlogController::class . '::eliminar'
);

//ACCESO PUBLICO
$router->get(
    '/', PaginasControllers::class . '::index'
);
$router->get(
    '/nosotros', PaginasControllers::class . '::nosotros'
);
$router->get(
    '/propiedades', PaginasControllers::class . '::propiedades'
);
$router->get(
    '/propiedad', PaginasControllers::class . '::propiedad'
);
$router->get(
    '/blog', PaginasControllers::class . '::blog'
);
$router->get(
    '/entrada', PaginasControllers::class . '::entrada'
);
$router->get(
    '/contacto', PaginasControllers::class . '::contacto'
);
$router->post(
    '/contacto', PaginasControllers::class . '::contacto'
);

//login y auth
$router->get(
    '/login', loginController::class . '::login'
);
$router->post(
    '/login', loginController::class . '::login'
);
$router->get(
    '/logout', loginController::class . '::logout'
);


//$router->render('paginas/listado');
$router->comprobarRutas();