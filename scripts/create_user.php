<?php
// Uso: php scripts/create_user.php email@example.com password
// Si no se pasan argumentos, pedirá por stdin.

require __DIR__ . '/../includes/config/database.php';

function prompt($msg) {
    echo $msg;
    return trim(fgets(STDIN));
}

$email = $argv[1] ?? null;
$password = $argv[2] ?? null;

if(!$email) {
    $email = prompt("Email: ");
}
if(!$password) {
    // ocultar entrada en CLI no trivial en PHP, pedimos normal
    $password = prompt("Password: ");
}

if(!$email || !$password) {
    echo "Email y password son requeridos.\n";
    exit(1);
}

$db = conectarDB();

// Comprobar que no exista ya el email
$stmt = $db->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0) {
    echo "Ya existe un usuario con ese email.\n";
    $stmt->close();
    $db->close();
    exit(1);
}
$stmt->close();

$hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $db->prepare('INSERT INTO usuarios (email, password) VALUES (?, ?)');
$stmt->bind_param('ss', $email, $hash);
if($stmt->execute()) {
    echo "Usuario creado: $email\n";
} else {
    echo "Error al crear usuario: " . $stmt->error . "\n";
}
$stmt->close();
$db->close();
