<?php

declare(strict_types=1);

/** @var string $pageTitle */
/** @var array<int, string> $extraStyles */
/** @var string $pageDescription */

$pageTitle = $pageTitle ?? 'StreamFlix';
$extraStyles = $extraStyles ?? [];
$pageDescription = $pageDescription ?? 'StreamFlix - Discover award-winning films, fan favorites, and something new for every mood. Stream movies on your terms.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://streamflix.example.com/">
    <meta property="og:image" content="https://streamflix.example.com/assets/images/background.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta name="twitter:image" content="https://streamflix.example.com/assets/images/background.jpg">
    <link rel="icon" href="../../assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/svg+xml" href="../../assets/images/favicon.svg">
    <link rel="apple-touch-icon" href="../../assets/images/apple-touch-icon.png">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="../styles/style.css">
    <?php foreach ($extraStyles as $stylePath): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($stylePath) ?>">
    <?php endforeach; ?>
</head>
