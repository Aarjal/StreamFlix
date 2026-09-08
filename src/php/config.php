<?php

declare(strict_types=1);

/**
 * Reads optional local configuration from .env without requiring a package.
 * Real environment variables always take priority over values in the file.
 */
function streamflix_env(string $key, ?string $default = null): ?string
{
    static $fileValues = null;

    $systemValue = getenv($key);
    if ($systemValue !== false) {
        return $systemValue;
    }

    if ($fileValues === null) {
        $envPath = dirname(__DIR__, 2) . '/.env';
        $fileValues = is_file($envPath)
            ? (parse_ini_file($envPath, false, INI_SCANNER_RAW) ?: [])
            : [];
    }

    $value = $fileValues[$key] ?? $default;

    return is_string($value) ? $value : $default;
}

function streamflix_is_local(): bool
{
    return streamflix_env('APP_ENV', 'local') === 'local';
}
