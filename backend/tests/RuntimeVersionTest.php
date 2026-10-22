<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Shared\Runtime\RuntimePolicy;

RuntimePolicy::assertSupported('8.5.12');

try {
    RuntimePolicy::assertSupported('8.5.11');
    throw new \RuntimeException('A vulnerable PHP 8.5 runtime was accepted.');
} catch (\RuntimeException $exception) {
    if (!str_contains($exception->getMessage(), 'PHP 8.5.12+ is required')) {
        throw $exception;
    }
}

fwrite(STDOUT, "PHP2Shell runtime boundary tests passed.\n");
