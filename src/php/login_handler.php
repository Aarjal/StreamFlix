<?php

declare(strict_types=1);

require __DIR__ . '/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$rememberMe = isset($_POST['remember_me']);
$csrfToken = $_POST['csrf_token'] ?? null;

if (!verify_csrf(is_string($csrfToken) ? $csrfToken : null)) {
    set_flash('error', 'Session expired. Please try login again.');
    header('Location: ../pages/login.php');
    exit;
}

if ($username === '' || $password === '') {
    set_flash('error', 'Please enter both username and password.');
    header('Location: ../pages/login.php');
    exit;
}

try {
    require __DIR__ . '/db.php';

    $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = :username LIMIT 1');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['username'] = $user['username'];

        if ($rememberMe) {
            setcookie('remembered_username', $user['username'], [
                'expires' => time() + (60 * 60 * 24 * 30),
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        } else {
            setcookie('remembered_username', '', [
                'expires' => time() - 3600,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        }

        set_flash('success', 'Login successful. Welcome back, ' . $user['username'] . '!');

        header('Location: ../pages/home.php');
        exit;
    }

    set_flash('error', 'Invalid username or password.');
    header('Location: ../pages/login.php');
    exit;
} catch (Throwable $error) {
    set_flash('error', 'Database connection issue. Check phpMyAdmin and table setup.');
    header('Location: ../pages/login.php');
    exit;
}
