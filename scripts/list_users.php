<?php
require __DIR__ . '/../includes/config/database.php';

$db = conectarDB();

$result = $db->query("SELECT id, email, password FROM usuarios");

if(!$result) {
    echo "Error al leer usuarios: " . $db->error . PHP_EOL;
    exit;
}

while($row = $result->fetch_assoc()) {
    echo "id: {$row['id']} | email: {$row['email']} | password: {$row['password']}" . PHP_EOL;
}

$result->free();
$db->close();
