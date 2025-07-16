<?php

namespace MVC;
class Router {
    public $rutasGET = [];
    public $rutasPOST = [];


    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        if($fn) {
            // La url existe y hay una funcion asociativa
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada";
        }
    }

    public function render($view, $datos = []) {

        foreach($datos as  $key => $value) {
            $$key = $value;
        }

        // Inicia memoria del buffer, para guardar todo lo siguiente que pasemos
        ob_start();

        // Lo de este include es guardado en el buffer, pero aun no se muestra en el DOM
        include __DIR__ . "/views/$view.php";

        //ob_get_clean almacena todo lo que hemos guardado en el buffer en la variable contenido y limpia el buffer para la proxima ocasion.
        $contenido = ob_get_clean();

        // Mostramos en el DOM el layout(header + $contenido + footer), $contenido dependera del link que visitemos
        include __DIR__ . "/views/layout.php";
    }
}