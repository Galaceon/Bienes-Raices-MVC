<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class VendedorController {

    public static function crear(Router $router) {
        
        $vendedor = new Vendedor;

        // Array con mensajes de errores
        $errores = Vendedor::getErrores();

        //Ejecutar el código despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Generar un nombre único para imagen
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            //Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
                $vendedor->setImagen($nombreImagen, 'vendedor');
            }

            // Validar que no haya campos vacios
            $errores = $vendedor->validar();

            //No hay errores
            if(empty($errores)) {
                /** SUBIDA DE ARCHIVOS */
                if(!is_dir(CARPETA_FOTOS)){
                    mkdir(CARPETA_FOTOS);
                }

            // Guardar la imagen en el Servidor
            $imagen->save(CARPETA_FOTOS . $nombreImagen);

            $vendedor->guardar();
        }
    }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);

        // Array con mensajes de errores
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];

            // Sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            // Validación
            $errores = $vendedor->validar();

            
            // SUBIDA DE ARCHIVOS
            // Genera un nombre único
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
                $vendedor->setImagen($nombreImagen, 'vendedor');
            }

            if(empty($errores)) {
                // Almacenar la imagen
                if($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image->save(CARPETA_FOTOS . $nombreImagen);
                }

                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                // tipo sirve para saber si es tipo propiedad o vendedor
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar($tipo);
                }
            }
        }
    }
}