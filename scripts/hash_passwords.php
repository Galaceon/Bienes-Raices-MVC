<?php
// Script para rehasear contraseñas en la tabla `usuarios`.
// Uso (CLI): php scripts/hash_passwords.php

require __DIR__ . '/../includes/config/database.php';

$db = conectarDB();

// Selecciona id, password de todos los usuarios
$result = $db->query("SELECT id, password FROM usuarios");

if(!$result) {
    echo "Error al leer usuarios: " . $db->error . PHP_EOL;
    exit;
}

$updated = 0;

while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $password = $row['password'];

    // Si la contraseña ya es un hash reconocible por password_get_info, saltar
    $info = password_get_info($password);
    echo "Procesando id=$id, password='{$password}', algoName={$info['algoName']}" . PHP_EOL;
    if($info['algoName'] !== 'unknown') {
        echo " - ya es hash, saltando\n";
        continue;
    }

    // Opcional: se puede filtrar por longitud o pattern. Aquí asumimos que cualquier string
    // no hasheado debe rehasearse
    $newHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
    $stmt->bind_param('si', $newHash, $id);
    if($stmt->execute()) {
        $updated++;
        echo " - actualizado\n";
    } else {
        echo "Error actualizando user $id: " . $stmt->error . PHP_EOL;
    }
    $stmt->close();
}

echo "Rehashed passwords: $updated\n";
$result->free();
$db->close();
