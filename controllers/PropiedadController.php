<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;
use Model\EntradasBlog;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController {
    public static $routerInstance;
    public static function setRouterInstance($router){
        self::$routerInstance = $router; // Método para asignar la instancia de Router a la propiedad estática
    }

    public static function index($router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedores::all();
        $entradas = EntradasBlog::all();
        $resultado = $_GET['resultado']?? null;

        $mensaje = mostrarNotificacion(intval($resultado));

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'entradas' => $entradas,
            'mensaje' => $mensaje
        ]);
    }
    public static function crear($router){
        $propiedad = new Propiedad;
        $vendedores = Vendedores::all();

        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST);

            $imagenF = $_FILES['propiedad'];

            if ($imagenF['tmp_name']['imagen']) {
                //debuguear($imagenF);

                //creamos el nombre unico que tendra la imagen y añadimnos las extension
                $nombreImagen = md5( uniqid( rand(), true)) ."_".$imagenF['name']['imagen'];
                //debuguear($nombreImagen);
                
                //realiza un resize a la imagen con intervetion
                $image = Image::make($imagenF['tmp_name']['imagen'])->fit(800,600);
    
                //asignamos el nombre al atributo "imagen" de la clase
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();
            //debuguear($propiedad);
            if (empty($errores)) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);//si la carpeta no existe aca se va a crear
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->crear();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
        
    }

    public static function actualizar($router){
        $id = Propiedad::inarray();

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedores::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = [];
            foreach ($_POST as $key => $value) {
                $args[$key] = $value;
            }
            //cambiamos los datos de la instancia con los q se mandaron via post(nuevos datos)
            $propiedad->sincronizar($args);
            //validamos que todos los campos esten llenos correctamente
            $errores = $propiedad->validar();
            //nos traemos el nombre de la imagen
            $nombreImagen = $propiedad->imagen;
            //en caso de subir otra ijmagen nos traemos esos datos
            $imagen = $_FILES['propiedad'];

            if (empty($errores)) {
            
                if ($imagen['tmp_name']['imagen']) {
        
                    //creamos el nombre unico que tendra la imagen y añadimnos las extension
                    $nombreImagen = md5( uniqid( rand(), true)) ."_".$imagen['name']['imagen'];
                    
                    //realiza un resize a la imagen con intervetion
                    $image = Image::make($imagen['tmp_name']['imagen'])->fit(800,600);
        
                    //asignamos el nombre al atributo "imagen" de la clase
                    $propiedad->setImagen($nombreImagen);
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                    //move_uploaded_file($imagen['tmp_name']['imagen'], CARPETA_IMAGENES.$nombreImagen );
                }
                
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
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

                    $propiedad = Propiedad::find($id);  
                    $propiedad->eliminar(); 
        
                }else{
                    debuguear('es invalida');
                }
            }
        }
    }
}