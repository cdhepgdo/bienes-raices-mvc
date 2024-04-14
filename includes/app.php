<?php
//se crean constantes donde se almacenan la direcciones de los archivos enla carpeta "template"

require __DIR__ .'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'config/databases.php';
$db = conectarDB();//me premite usarlo 'config/databases.php'
require 'funciones.php';

use Model\ActiveRecord;
//use App\Propiedad;//me premite usarlo '/../vendor/autoload.php'


ActiveRecord::setDB($db);//convierte la variable principal "$db" en la referencia de la conexion a la db

?>
