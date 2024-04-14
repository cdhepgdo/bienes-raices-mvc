<?php
namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = "propiedades";
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamientos','creado','vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;
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
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('y-m-d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    //al utilizar self para acceder al atributo, se hace referencia al contexto de la clase en la que se define, es decir, a la clase padre, siempre y cuando no se hayan sobreescrito los atribts y metodos
    public function validar(){
        if ($this->titulo === '') {
            static::$errores[] = "Debe colocar un tituloo";
        }
        if (strlen($this->titulo) > 45) {
            self::$errores[] = "El titulo no debe tener mas 45 caracteres";
        }
        if ($this->precio === '') {
            self::$errores[] = "Debe colocar un precio";
        }
        if ($this->descripcion === '') {
            self::$errores[] = "Debe colocar una desdescripcion";
        }
        if ($this->habitaciones === '') {
            self::$errores[] = "Debe colocar un numero de habitaciones";
        }
        if ($this->wc === '') {
            self::$errores[] = "Debe colocar un numero de baños";
        }
        if ($this->estacionamientos === '') {
            self::$errores[] = "Debe colocar un numero de estacionamientos";
        }
        if ($this->vendedores_id === '') {
            self::$errores[] = "Debe colocar un numero de vendedor";
        }
        if (!$this->imagen) {
            /* $medida = (1000*100) * 40;
            if ($imagen['size'] > $medida) {
                echo $imagen['name'];
                $errores[] = "la imagen es muy grande";
            }
        }else{ */
            self::$errores[] = "Debe colocar una imagen";
        }
        return self::$errores;
    }
    public static function consultarSQL($query){
        debuguear($query);
    }
    
}