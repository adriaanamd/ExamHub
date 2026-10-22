<?php

declare(strict_types=1);

namespace App\Shared\Runtime;

use RuntimeException;

final class RuntimePolicy
{
    private const MINIMUM_VERSION = '8.5.12';

    public static function assertSupported(string $version): void
    {
        if (version_compare($version, self::MINIMUM_VERSION, '<')) {
            throw new RuntimeException(
                'PHP 8.5.12+ is required; detected ' . $version . '.',
            );
        }
    }
}
