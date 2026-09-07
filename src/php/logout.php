<?php

declare(strict_types=1);

require __DIR__ . '/session.php';
session_unset();
session_destroy();

session_start();
set_flash('success', 'You have been logged out successfully.');

header('Location: ../pages/login.php');
exit;
