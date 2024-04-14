<?php

//use Model\ActiveRecord;
namespace model;

class Admin extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

/*     public function validar(){
        if (!$this->email) {
            self::$errores = 'Debe colocar un email'
        }
        if (!$this->password) {
            self::$errores = 'Debe colocar un password'
        }
        return self::$errores;
    } */
    public function validar() {
    
        // Validar contraseña
        if (empty($this->password)) {
            self::$errores[] = "La contraseña no puede estar vacía.";
        }/*  elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,}$/", $this->password)) {
            self::$errores[] = "La contraseña debe tener al menos 7 caracteres, una letra mayúscula y un número.";
        } */
    
        // Validar correo electrónico
        if (empty($this->email)) {
            self::$errores[] = "El correo electrónico no puede estar vacío.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = "El formato del correo electrónico no es válido.";
        }
    
        return self::$errores;
    }

    public function comprobarEmail(){
        //revisar si el usr existe on no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'Este usuario no existe';
            return false;
        }
        return $resultado;
    }//lanza una consulta para ver si el email escrito en el formulario existe y retorna el resultado de la consulta en caso de que si exista, y si no, retorna false

    public function comprobarPassword($resultado){
        $user = $resultado->fetch_object();

        $passForm = $this->password;
        $passDB = $user->password;

        $auth = password_verify($passForm, $passDB);
        if (!$auth) {
            self::$errores[] = 'Clave invalida';
        }
        return $auth;
    }

    public function autenticar(){
        session_start();
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        //debuguear($_SESSION);

        header('Location: /admin');
    }
    
}