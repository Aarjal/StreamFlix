<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

// Setup seeds development data, so it must never be exposed on a live site.
$remoteAddress = $_SERVER['REMOTE_ADDR'] ?? '';
$isCommandLine = PHP_SAPI === 'cli';
$isLocalRequest = in_array($remoteAddress, ['127.0.0.1', '::1'], true);

if (!streamflix_is_local() || (!$isCommandLine && !$isLocalRequest)) {
    http_response_code(403);
    exit('Setup is available only in the local development environment.');
}

require __DIR__ . '/db.php';

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        email VARCHAR(120) NULL,
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )'
);

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS feedback (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        name VARCHAR(80) NOT NULL,
        rating TINYINT NOT NULL,
        message VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_feedback_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
        CONSTRAINT chk_feedback_rating CHECK (rating BETWEEN 1 AND 5)
    )'
);

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS plan_selections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        plan_name ENUM("Basic", "Standard", "Premium") NOT NULL,
        billing_cycle ENUM("monthly", "yearly") NOT NULL DEFAULT "monthly",
        selected_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_plan_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    )'
);

$columnExists = static function (PDO $pdo, string $table, string $column): bool {
    $stmt = $pdo->prepare('SELECT COUNT(1) AS total FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = :table_name AND column_name = :column_name');
    $stmt->execute([
        'table_name' => $table,
        'column_name' => $column,
    ]);

    $row = $stmt->fetch();

    return ((int) ($row['total'] ?? 0)) > 0;
};

// Allow setup to upgrade databases created by earlier versions of the project.
if (!$columnExists($pdo, 'users', 'email')) {
    $pdo->exec('ALTER TABLE users ADD COLUMN email VARCHAR(120) NULL AFTER password_hash');
}

if (!$columnExists($pdo, 'users', 'is_active')) {
    $pdo->exec('ALTER TABLE users ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1 AFTER email');
}

$indexExists = static function (PDO $pdo, string $table, string $index): bool {
    $stmt = $pdo->prepare('SELECT COUNT(1) AS total FROM information_schema.statistics WHERE table_schema = DATABASE() AND table_name = :table_name AND index_name = :index_name');
    $stmt->execute([
        'table_name' => $table,
        'index_name' => $index,
    ]);

    $row = $stmt->fetch();

    return ((int) ($row['total'] ?? 0)) > 0;
};

if (!$indexExists($pdo, 'feedback', 'idx_feedback_created_at')) {
    $pdo->exec('CREATE INDEX idx_feedback_created_at ON feedback (created_at)');
}

if (!$indexExists($pdo, 'plan_selections', 'idx_plan_selected_at')) {
    $pdo->exec('CREATE INDEX idx_plan_selected_at ON plan_selections (selected_at)');
}

$demoUsername = 'demo';
$demoPasswordHash = password_hash('demo123', PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users (username, password_hash, email) VALUES (:username, :password_hash, :email) ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), email = VALUES(email), is_active = 1');
$stmt->execute([
    'username' => $demoUsername,
    'password_hash' => $demoPasswordHash,
    'email' => 'demo@streamflix.local',
]);

echo 'Setup complete. Demo user: demo / demo123';
