<?php

function conectarDB() : mysqli {
    try {
        //code...
        $db = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_NAME']
        );

        if(!$db){
            echo "Error de conexión a la base de datos: x";
            //throw new Exception($db);
        }
        $db->set_charset('utf8');
        return $db;
        //en realidad solo basta con poner in if positivo y q retorne true en caso de exito, y si falla ya se sabe que se va al catch
    } catch (\Exception $e) {
        echo "error en la conexion de DB : " . $e;
        //die;
        //exit;
    }
}
//conectarDB();



