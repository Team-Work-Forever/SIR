<?php

namespace Config\Twig;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Twig
{
    private static $twig;

    public static function getTemplateRenderer($path = 'src/templates'): Environment
    {
        if (!static::$twig) {
            $loader = new FilesystemLoader($path);
            static::$twig = new Environment($loader);
            static::$twig->addFunction(new \Twig\TwigFunction('loadCss', [__CLASS__, 'loadCss']));
            static::$twig->addFunction(new \Twig\TwigFunction('loadAsset', [__CLASS__, 'loadAsset']));
            static::$twig->addFunction(new \Twig\TwigFunction('loadJs', [__CLASS__, 'loadJs']));
            static::$twig->addFunction(new \Twig\TwigFunction('loadPublic', [__CLASS__, 'loadPublic']));
        }

        return static::$twig;
    }

    public static function loadPublic(string $path): string
    {
        return '/public/' . $path;
    }

    public static function loadCss(string $path): string
    {
        return '/public/css/' . $path;
    }

    public static function loadAsset(string $path): string
    {
        return '/public/assets/' . $path;
    }

    public static function loadJs(string $path): string
    {
        return '/public/js/' . $path;
    }
}
