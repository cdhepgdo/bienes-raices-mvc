<?php
echo 'hola desde po';
require_once __DIR__ . '/../../includes/app.php';

use MVC\Router;

$router = new Router();

$router->comprobarRutas();