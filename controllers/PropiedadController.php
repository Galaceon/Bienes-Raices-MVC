<?php
namespace Controllers;
use MVC\Router;

class PropiedadController {
    public static function index(Router $router) {
        
        $router->render('propiedades/admin', [
            'mensaje' => 'desde la vista',
            'propiedad' => 'casoplon',
            'precio' => [1, 2, 3]
        ]);
    }

        public function crear() {
        echo "creando";
    }

        public function actualizar() {
        echo "actualizando";
    }
}