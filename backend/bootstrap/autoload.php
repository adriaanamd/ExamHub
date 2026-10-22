<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Shared/Runtime/RuntimePolicy.php';
\App\Shared\Runtime\RuntimePolicy::assertSupported(PHP_VERSION);

$autoload = dirname(__DIR__) . '/vendor/autoload.php';
if (!is_file($autoload)) {
    throw new RuntimeException(
        'Composer autoload not found. Run "composer install" in the backend directory first.'
    );
}

require_once $autoload;
