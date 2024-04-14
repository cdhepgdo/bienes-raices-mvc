<?php

namespace Controllers;

use Model\EntradasBlog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController{
    public static function crear($router){
        $entrada = new EntradasBlog;
        $errores = EntradasBlog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entrada = new EntradasBlog($_POST);
            
            $imagenF = $_FILES['imagen'];
            if ($imagenF['tmp_name']) {
                //debuguear($imagenF);

                //creamos el nombre unico que tendra la imagen y añadimnos las extension
                $nombreImagen = md5( uniqid( rand(), true)) ."_".$imagenF['name'];
                //debuguear($nombreImagen);
                
                //realiza un resize a la imagen con intervetion
                $image = Image::make($imagenF['tmp_name'])->fit(800,600);
    
                //asignamos el nombre al atributo "imagen" de la clase
                $entrada->setImagen($nombreImagen);
            }

            $errores = $entrada->validar();
            if (empty($errores)) {

                if (!is_dir(CARPETA_IMAGENES_BLOG)) {
                    mkdir(CARPETA_IMAGENES_BLOG);//si la carpeta no existe aca se va a crear
                }

                $image->save(CARPETA_IMAGENES_BLOG . $nombreImagen);

                $entrada->crear();
            }
        }

        $router->render('/entradas_blog/crear', [
            'errores' => $errores,
            'entrada' => $entrada
        ]);
    }
    public static function actualizar($router){
        $id = EntradasBlog::inarray();
        $entrada = EntradasBlog::find($id);
        $errores = EntradasBlog::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = [];
            foreach ($_POST as $key => $value) {
                $args[$key] = $value;
            }
            //cambiamos los datos de la instancia con los q se mandaron via post(nuevos datos)
            $entrada->sincronizar($args);
            //validamos que todos los campos esten llenos correctamente
            $errores = $entrada->validar();
            //nos traemos el nombre de la imagen
            $nombreImagen = $entrada->imagen;
            //en caso de subir otra ijmagen nos traemos esos datos
            $imagen = $_FILES['imagen'];

            if (empty($errores)) {
            
                if ($imagen['tmp_name']) {
        
                    //creamos el nombre unico que tendra la imagen y añadimnos las extension
                    $nombreImagen = md5( uniqid( rand(), true)) ."_".$imagen['name'];
                    
                    //realiza un resize a la imagen con intervetion
                    $image = Image::make($imagen['tmp_name'])->fit(800,600);
        
                    //asignamos el nombre al atributo "imagen" de la clase
                    $entrada->setImagen($nombreImagen);
                    $image->save(CARPETA_IMAGENES_BLOG . $nombreImagen);
                }
                
                $entrada->guardar();
            }
        }

        $router->render('/entradas_blog/actualizar',[
            'entrada' => $entrada,
            'errores' => $errores
        ]);
        
    }
    public static function eliminar(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $entrada = EntradasBlog::find($id);
                    $entrada->eliminar();
                }else{
                    echo 'tipo invalido';
                }
            }
        }
    }
}
