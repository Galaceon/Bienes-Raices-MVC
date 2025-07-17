<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropiedadController {
    public static function index(Router $router) {

        $propiedades = Propiedad::all();
        
        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Array con mensajes de errores
        $errores = Propiedad::getErrores();

        //Ejecutar el código despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            //Generar un nombre único para imagen
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            //Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores este vacio para enviar la info a la db
            if(empty($errores)) {
                /** SUBIDA DE ARCHIVOS */
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en el Servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);


                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        // Array con mensajes de errores
        $errores = Propiedad::getErrores();


        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
}