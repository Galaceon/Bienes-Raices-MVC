<?php
namespace Controllers;
use MVC\Router;

class PropiedadController {
    public static function index(Router $router) {
        
        $router->render('propiedades/admin');
    }

        public function crear() {
        echo "creando";
    }

        public function actualizar() {
        echo "actualizando";
    }
}