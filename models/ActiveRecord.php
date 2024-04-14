<?php

namespace Model;

class ActiveRecord{

    public static function inarray() {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $conslt = "select id from " . static::$tabla;
        $conslt_ids = self::$db->query($conslt);
        $ids = array();
        if($conslt_ids->num_rows > 0){
            while($row = $conslt_ids->fetch_assoc()) {
                $ids[] = $row["id"];
            }
        }
        //debuguear($ids);
        
        if ($id && (in_array($id, $ids))) {
            return $id;
        }else{
            //debuguear($_SERVER["PATH_INFO"]);
            if ($_SERVER["PATH_INFO"] === "/propiedad") {
                header("Location: ../");
            }elseif($_SERVER["PATH_INFO"] === "/entrada"){
                header("Location: ../");
            }else{
                header("Location: /admin");
            }
            //debuguear();
        }
        /* $comando = "SELECT * FROM " . static::$tabla . " WHERE id = $id;";//se alista el comando para la consulta
        $consulta = self::$db->query($comando);//se envia la consulta SQL a la db y obtiene la respuesta
        if ($consulta->num_rows === 0) {
            header('location: /bienesraices/');
        } */
    }

    //guardara la conexion o ref de la conexion a la db
    protected static $db;
    

    //define la conexion a la db
    public static function setDB($baseDatos){
        self::$db = $baseDatos;
    }
    public static function getDB(){
        echo "<pre>";
        var_dump(static::$db);
        echo "</pre>";
    }

    //campos de la tabla "propiedad"
    protected static $columnasDB = [];

    protected static $tabla = '';

    //contenedor de errores
    protected static $errores = [];

    

    //protected static $sanitizado = [];

    

    
    //subida de archovos
    public function setImagen($imagen){

        $this->borrarImagen();
        
        if($imagen){
            $this->imagen = $imagen;
        }
    }//asigna al atributo "imagen" el nombre de la imagen pasada por parametro

    public function guardar(){
        if ($this->id) {
            $this->Actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear(){

        //sanitizar los datos
        $atributos = $this->sanitizarAtr();
        

        //crear la consulta de insercion con datos sanitizados
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES( '";
        $query .= join("', '",array_values($atributos));
        $query .= "')";
        //debuguear($query);

        //ejecutar la consulta de insercion
        $res = self::$db->query($query);
        
        //return $res;
        if ($res) {
            header("Location: ../admin?resultado=1");
            exit;
        }

    }

    public function Actualizar(){
        $atributos = $this->sanitizarAtr();
        
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[$key] = "$key= ";
            $valores[$key] .= is_numeric($value) ? intval($value) : "'$value'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        
        //debuguear($query);
        $resultado = self::$db->query($query);
        if ($resultado) {
            header("Location: ../admin?resultado=2");
            exit;
        }
    }

    //
    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDB as $key) {
            if($key === 'id') continue;
            $atributos[$key] = $this->$key;
        }
        return $atributos;
    }//retorna un array asociativo donde las keys de este, tendran el mismo nombre de los atributos y los valores insertados en el formulario

    public function sanitizarAtr(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }//retorna un array-replica del objeto instanciado con los valores insertados ya sanitizados

    public static function getErrores(){
        
        return static::$errores;
    }

   public function validar(){
        static::$errores = [];
        return self::$errores;
    }


    public static function all($num = false) : array {
        $num = $num;
        if($num){
            $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $num;
        }else{
            $query = "SELECT * FROM " . static::$tabla;
        }

        $resultado = self::consultarSQL($query);
        return $resultado;
        
    }//retorna el array con los resultados de la consulta en forma de objetos obtenido del metodo "consultarSQL()"
    public static function get($number) : array {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $number;

        $resultado = self::consultarSQL($query);
        return $resultado;
        
    }//retorna el array con los resultados de la consulta en forma de objetos obtenido del metodo "consultarSQL()"

    public static function consultarSQL($query){
        /* var_dump(static::class);
        debuguear(static::$tabla); */
        //consultar la base de datos
        $resultados = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while($registro = $resultados->fetch_assoc()){
            //va agregando los resultados de esa consulta al array en forma de objeto por medio del metodo 'crearObj()'
            $array[] = self::crearObj($registro);
        }
        //liberar memoria
        $resultados->free();

        //retornar el array con los registros en forma de objeto
        return $array;

    }//ejecuta la consulta y recorre los resultqados, luego va añadiendo al array nuevo cada registro retornado de la consulta en forma de objeto-replica(por el metodo crearObj) de la instancia actual, y retorna el array de objcts

    protected static function crearObj($registro){
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }//toma un registro en forma de array como parametro, crea una nueva instancia de la clase y compara que las llaves del registro tengan el mismo nombre que los atributos de la inst, y si es asi entonces tambien le asigna el valor y por ultimo retorna el objeto con los valores seteados


    //recorre el array de objct's devuelto por "all()"
    //convierte el atributo "id" del objeto en int y lo compara con el id pasado por parametro
    //si ambos ids coinciden retorna el objeto actual
    public static function Actualiza($id){
        $propiedad = self::all();
        foreach ($propiedad as $key) {
            $var = filter_var($key->id, FILTER_VALIDATE_INT);
            if($var === $id){
                return $key;
            }
        }
    }
    //opcion 2 del metodo "Actualizar()"
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id limit 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }//retorna el primero objeto-replica del array obtenido con los resultados de la consulta

    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if (property_exists($this, $key) && preg_match('/[A-Za-z0-9]/', $value)) {
                $this->$key = $value;
            }
        }
        /* foreach($this as $key => $value){
            $this->$key = self::$db->escape_string($value);
        } */
        //debuguear($this);
        //return $this;
    }

    public function eliminar(){
        //eliminar propiedad
        $query = "DELETE from " . static::$tabla . " where id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header("Location: ../admin?resultado=3");
            //exit;
        }
    }

    public function borrarImagen(){
        if ($this->id) {
            $exist = file_exists(CARPETA_IMAGENES . $this->imagen);
            $exist2 = file_exists(CARPETA_IMAGENES_BLOG . $this->imagen);
            if ($exist ) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }elseif ($exist2) {
                unlink(CARPETA_IMAGENES_BLOG . $this->imagen);
            }
        }
    }
}