<?php declare(strict_types=1);

use function DI\create;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    // Configure Twig
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/src/Views');
        $twig = new Environment($loader);
        $twig->addGlobal('stylesheet', APP_URL.'/src/Views/styles/style.css');
        return $twig;
    },
];
