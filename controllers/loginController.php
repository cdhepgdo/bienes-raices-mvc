<?php 

namespace Controllers;
use MVC\Router;
use Model\Admin;

class loginController{
    public static function login(Router $router){
        $errores = Admin::getErrores();
        $admin = new Admin;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = new Admin($_POST);
            $errores = $admin->validar();

            if (empty($errores)) {

                // verificar si el usuario existe
                $resultado = $admin->comprobarEmail();

                if (!$resultado) {
                    $errores = Admin::getErrores();

                }else{

                    // verificar el password
                    $auth = $admin->comprobarPassword($resultado);

                    if (!$auth) {
                        $errores = Admin::getErrores();
                    }else{
                        // Autenticar el usuario
                        $admin->autenticar();
                    }

                }

            }
        }
        
        $router->render('auth/login', [
            'errores' => $errores,
            'admin' => $admin
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];
        header('Location: /');

    }
}