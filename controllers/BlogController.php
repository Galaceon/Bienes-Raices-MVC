<?php
namespace Controllers;
use MVC\Router;
use Model\Blog;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class BlogController {
    public static function crear(Router $router) {
        $blog = new Blog;

        // Array con mensajes de errores
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una instancia nueva
            $blog = new Blog($_POST('blog'));

            // Generar un nombre único para imagen
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            // Realiza un resize a la imagen con intervention
            if($_FILES['blog']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['blog']['tmp_name']['imagen'])->cover(600, 450);
                $blog->setImagen($nombreImagen);
            }

            // Validar
            $errores = $blog->validar();

            if(empty($errores)) {
                /** SUBIDA DE ARCHIVOS */
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en el Servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);


                $blog->guardar();
            }

            $router->render('blogs/crear', [
                'blog' => $blog,
                'errores' => $errores
            ]);
        }

        
    }
}