<?php
// Script de prueba para simular login usando la lógica de LoginController
require __DIR__ . '/../includes/app.php';

use Model\Admin;

// Credenciales a probar
$email = 'anto@gmail.com';
$password = '6667';

$auth = new Admin(['email' => $email, 'password' => $password]);

$errores = $auth->validar();
if(!empty($errores)) {
    echo "Errores de validación:\n";
    print_r($errores);
    exit;
}

$resultado = $auth->existeUsuario();
if(!$resultado) {
    echo "Usuario no encontrado\n";
    print_r(Admin::getErrores());
    exit;
}

$autenticado = $auth->comprobarPassword($resultado);
if($autenticado) {
    echo "Autenticado OK\n";
} else {
    echo "Fallo autenticación\n";
    print_r(Admin::getErrores());
}
