<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    // XAMPP's shared temp folder may not be writable by the current user.
    // Keep development sessions inside the project instead.
    $sessionPath = __DIR__ . '/../../.sessions';

    if (!is_dir($sessionPath) && !mkdir($sessionPath, 0700, true) && !is_dir($sessionPath)) {
        throw new RuntimeException('Unable to create the local session directory.');
    }

    session_save_path($sessionPath);
    session_start();
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(?string $token): bool
{
    $sessionToken = $_SESSION['csrf_token'] ?? null;

    return is_string($token)
        && is_string($sessionToken)
        && hash_equals($sessionToken, $token);
}

function current_username(): ?string
{
    return isset($_SESSION['username']) ? (string) $_SESSION['username'] : null;
}

function pull_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return is_array($flash) ? $flash : null;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}
