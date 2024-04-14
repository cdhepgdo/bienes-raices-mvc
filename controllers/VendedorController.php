<?php

namespace Controllers;

use Model\Vendedores;
use MVC\Router;

class VendedorController {

    public static function crear($router){
        
        $vendedor = new Vendedores;
        $errores = Vendedores::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $vendedor = new Vendedores($_POST);
            $errores = $vendedor->validar();

            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores,
        ]);
    }
    public static function actualizar($router){

        $id = Vendedores::inarray();
        $vendedor = Vendedores::find($id);
        $errores = Vendedores::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $args = $_POST;
            $vendedor->sincronizar($args);
            $errores = $vendedor->validar();

            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {

                    $vendedor = Vendedores::find($id);  
                    $vendedor->eliminar(); 
        
                }else{
                    debuguear('es invalida');
                }
            }else{
                echo 'chao';
            }
        }
    }
}