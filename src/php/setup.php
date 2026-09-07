<?php

declare(strict_types=1);

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

$stmt = $pdo->prepare('INSERT INTO users (username, password_hash, email) VALUES (:username, :password_hash, :email) ON DUPLICATE KEY UPDATE username = username');
$stmt->execute([
    'username' => $demoUsername,
    'password_hash' => $demoPasswordHash,
    'email' => 'demo@streamflix.local',
]);

echo 'Setup complete. Demo user: demo / demo123';
