<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit859015e4c66222febc8ba0175eb1d08f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\OptionsResolver\\' => 34,
        ),
        'E' => 
        array (
            'Endroid\\QrCode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\OptionsResolver\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/options-resolver',
        ),
        'Endroid\\QrCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/endroid/qrcode/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit859015e4c66222febc8ba0175eb1d08f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit859015e4c66222febc8ba0175eb1d08f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
