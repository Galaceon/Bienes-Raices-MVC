<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

function conectarDB() : mysqli {
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME']
    );

    if(!$db) {
        echo "Error, no se pudo conectar";
        exit;
    }

    return $db;
}