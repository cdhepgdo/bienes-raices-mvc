<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\EntradasBlog;
//use PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\PHPMailer as PHPMailerPHPMailer;
/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaginasControllers{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $entradas = EntradasBlog::get(3);
        $inicio = true;

        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'entradas' => $entradas,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){
        
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        
        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = Propiedad::inarray();
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $entradas = EntradasBlog::get(5);
        
        $router->render('paginas/blog', [
            'entradas' => $entradas
        ]);
    }
    public static function entrada(Router $router){
        $id = EntradasBlog::inarray();
        $entrada = EntradasBlog::find($id);

        $router->render('paginas/entrada', [
            'entrada' => $entrada
        ]);
    }
    public static function contacto(Router $router){
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        
            $respuestas = $_POST['contacto'];

            $mail = new PHPMailer(true);

            try {
                
                $mail->isSMTP();
                //Send using SMTP
                $mail->Host= $_ENV['EMAIL_HOST'];
                //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $_ENV['EMAIL_USER'];
                //SMTP username
                $mail->Password   = $_ENV['EMAIL_PASS'];
                //SMTP password
                $mail->SMTPSecure = 'tls'; 
                $mail->Port = $_ENV['EMAIL_PORT'];
            
                //Recipients
                $mail->setFrom('cdhepgdo@gmail.com', 'Mailer');
                if ($respuestas['email']) {
                    $mail->addAddress($respuestas['email'], 'Joe User');
                }else{
                    $mail->addAddress('correo@correo.com', 'Joe User');
                }
                
                $contenido = '<html>';

                $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';

                if ($respuestas['contacto'] === 'telefono') {
                    $contenido .= '<p>Eligio ser contactado por telefono</p>';
                    
                    $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>';
                    $contenido .= '<p>Fecha: ' . $respuestas['fecha'] . ' </p>';
    
                    $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
                }else{
                    $contenido .= '<p>Eligio ser contactado por email</p>';
                    $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
                }



                $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';

                $contenido .= '<p>Tipo: ' . $respuestas['tipo'] . ' </p>';

                $contenido .= '<p>Precio: ' . $respuestas['precio'] . ' </p>';

                $contenido .= '<p>Forma de Contacto: ' . $respuestas['contacto'] . ' </p>';


                $contenido .= '</html>';
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'new mssg';
                $mail->Body    = $contenido;
                $mail->AltBody = 'texto alternativo en caso de no soportar HTML';
            
                $mail->send();
                $mensaje = "Datos enviados correctamente";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
            
            
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
