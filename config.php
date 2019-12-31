<?php declare(strict_types=1);

use function DI\create;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    // Configure Twig
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/src/Views');
        return new Environment($loader);
    },
];
