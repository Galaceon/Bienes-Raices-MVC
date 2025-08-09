<?php

namespace Model;

class Blog extends ActiveRecord {
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'titulo', 'autor', 'contenido', 'imagen', 'creado'];

    public $id;
    public $titulo;
    public $autor;
    public $contenido;
    public $imagen;
    public $creado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->creado = date('Y/m/d');
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if(!$this->autor) {
            self::$errores[] = "Debe haber un autor";
        }
        if(!$this->contenido) {
            self::$errores[] = "Debes haber un contenido textual";
        }
        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }
}