<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Shared\Runtime\RuntimePolicy;

RuntimePolicy::assertSupported('8.5.12');

$bootstrapSource = file_get_contents(__DIR__ . '/../bootstrap/autoload.php');
if (!is_string($bootstrapSource)) {
    throw new \RuntimeException('Unable to inspect the backend bootstrap boundary.');
}

$policyCallPosition = strpos($bootstrapSource, 'RuntimePolicy::assertSupported(PHP_VERSION);');
$autoloadPosition = strpos($bootstrapSource, 'require_once $autoload;');
if ($policyCallPosition === false || $autoloadPosition === false || $policyCallPosition > $autoloadPosition) {
    throw new \RuntimeException('Backend bootstrap must enforce the patched PHP runtime before Composer autoloading.');
}

try {
    RuntimePolicy::assertSupported('8.5.11');
    throw new \RuntimeException('A vulnerable PHP 8.5 runtime was accepted.');
} catch (\RuntimeException $exception) {
    if (!str_contains($exception->getMessage(), 'PHP 8.5.12+ is required')) {
        throw $exception;
    }
}

fwrite(STDOUT, "PHP2Shell runtime boundary tests passed.\n");
