<?php 

namespace Model;

class Vendedores extends ActiveRecord{
    protected static $tabla = "vendedores";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public function __construct($args = [])
    {
        /* $sanitizado = [];
        foreach ($args as $key => $value) {
            # code...
            if($key === "id") continue;
            $sanitizado[$key] = self::$db->escape_string($value);
        } */
        //debuguear($sanitizado);

        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    
    public function validar(){
        //debuguear($this);
        if ($this->nombre != '') {
            if(strlen($this->nombre) > 45){
                self::$errores[] = 'El nombre no debe ser mayor a 45 caracteres';
            }else if(!preg_match('/^[A-Za-z\s]+$/', $this->nombre)){
                self::$errores[] = "El nombre no puede contener caracteres especiales o numeros";
            }
        }else{
            self::$errores[] = "Debe colocar un nombre ";
        }//--
        if ($this->apellido != '') {
            if(strlen($this->apellido) > 45){
                self::$errores[] = 'El apellido no debe ser mayor a 45 caracteres';
            }else if(!preg_match('/^[A-Za-z\s]+$/', $this->apellido)){
                self::$errores[] = "El apellido no puede contener caracteres especiales o numeros";
            }
        }else{
            self::$errores[] = "Debe colocar un apellido ";
        }//--
        if ($this->telefono != '') {
            if (strlen($this->telefono) > 10) {
                self::$errores[] = "El telefono no debe tener mas 10 numeros";
            }
        }else{
            self::$errores[] = "Debe colocar un numero de telefono";
        }//--

        return self::$errores;
    }
    
}