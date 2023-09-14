<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbc5e51dd234ce84b10526b411da30432
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Vittascience\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vittascience\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'Vittascience\\' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbc5e51dd234ce84b10526b411da30432::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbc5e51dd234ce84b10526b411da30432::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbc5e51dd234ce84b10526b411da30432::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
