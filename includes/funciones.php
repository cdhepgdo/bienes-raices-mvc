<?php
use Model\ActiveRecord;

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenF/');
define('CARPETA_IMAGENES_BLOG', $_SERVER['DOCUMENT_ROOT'] . '/images_blog/');

//require 'app.php';//se importa el shortcut para las direcciones de los archivos en la carpeta "template"

function incluirTemplate( string $nombre, bool $inicio = false){
    //en caso de que al llamar a la funcion sin el segundo argumento, este sera false, caso contrario, sera lo que se coloque en dicho argumento

    include TEMPLATES_URL . "/$nombre.php";//esta direccion representa todo el codigo dentro de ese archivo como si estuviera escrito aca mismo

}

function estadoAutenticado() {
    session_start();
    
    if (!$_SESSION['login']) {
        header("location: /bienesraices");
    }
}

function debuguear($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}

//Escapa / sanitizar HTML
function s($html){
    $s = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    return $s;
}

function validarTipoContenido($tipo){
    $arr_tipos = ['propiedad', 'vendedor', 'entrada'];
    return in_array($tipo, $arr_tipos);
}

function mostrarNotificacion($resultado){
    $mensaje = '';

    switch ($resultado) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}


