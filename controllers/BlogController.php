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
            $blog = new Blog($_POST['blog']);

            // Generar un nombre único para imagen
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            // Realiza un resize a la imagen con intervention
            if($_FILES['blog']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['blog']['tmp_name']['imagen'])->cover(600, 450);
                $blog->setImagen($nombreImagen, 'blog');
            }

            // Validar
            $errores = $blog->validar();

            if(empty($errores)) {
                /** SUBIDA DE ARCHIVOS */
                if(!is_dir(CARPETA_BLOGIMAGES)){
                    mkdir(CARPETA_BLOGIMAGES);
                }

                // Guardar la imagen en el Servidor
                $imagen->save(CARPETA_BLOGIMAGES . $nombreImagen);


                $blog->guardar();
            }
        }

        $router->render('blogs/crear', [
            'blog' => $blog,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $blog = Blog::find($id);

        // Array con mensajes de errores
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['blog'];

            // Sincronizar objeto en memoria con lo que el usuario escribio
            $blog->sincronizar($args);

            // Validación
            $errores = $blog->validar();

            
            // SUBIDA DE ARCHIVOS
            // Genera un nombre único
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            if($_FILES['blog']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['blog']['tmp_name']['imagen'])->cover(800, 600);
                $blog->setImagen($nombreImagen, 'blog');
            }

            if(empty($errores)) {
                // Almacenar la imagen
                if($_FILES['blog']['tmp_name']['imagen']) {
                    $image->save(CARPETA_BLOGIMAGES . $nombreImagen);
                }

                $blog->guardar();
            }
        }

        $router->render('blogs/actualizar', [
            'blog' => $blog,
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
                    $blog = Blog::find($id);
                    $blog->eliminar($tipo);
                }
            }
        }
    }
}