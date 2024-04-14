<?php
namespace Model;

class EntradasBlog extends ActiveRecord{
    protected static $tabla = "entradas_blog";
    protected static $columnasDB = ['id','titulo','fecha','autor','imagen','descripcion_corta','descripcion_completa'];

    public $id;
    public $titulo;
    public $fecha;
    public $imagen;
    public $autor;
    public $descripcion_corta;
    public $descripcion_completa;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->descripcion_corta = $args['descripcion_corta'] ?? '';
        $this->descripcion_completa = $args['descripcion_completa'] ?? '';
    }

    public function validar(){
        if ($this->titulo === '') {
            static::$errores[] = "Debe colocar un tituloo";
        }
        if (strlen($this->titulo) > 45) {
            self::$errores[] = "El titulo no debe tener mas 45 caracteres";
        }
        if ($this->fecha === '') {
            self::$errores[] = "Debe colocar una fecha";
        }
        if ($this->autor === '') {
            self::$errores[] = "Debe colocar el nombre del autor";
        }
        if ($this->descripcion_corta === '') {
            self::$errores[] = "Debe colocar una descripcion corta";
        }
        if ($this->descripcion_completa === '') {
            self::$errores[] = "Debe colocar la descripcion completa";
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
}