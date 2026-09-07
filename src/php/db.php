<?php

declare(strict_types=1);

$host = 'sql311.infinityfree.com';
$dbName = 'if0_41392703_data_projector';
$dbUser = 'if0_41392703';
$dbPass = '(Your vPanel Password)';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $dbUser, $dbPass, $options);
