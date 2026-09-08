<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

// Local XAMPP defaults. Override these in .env (never commit that file).
$host = streamflix_env('STREAMFLIX_DB_HOST', '127.0.0.1');
$dbName = streamflix_env('STREAMFLIX_DB_NAME', 'streamflix');
$dbUser = streamflix_env('STREAMFLIX_DB_USER', 'root');
$dbPass = streamflix_env('STREAMFLIX_DB_PASS', '');
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $dbUser, $dbPass, $options);
