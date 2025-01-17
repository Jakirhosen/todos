<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit670b295558ff8f00893eb22eb9bd7415
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Todos\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Todos\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Todos\\operation' => __DIR__ . '/../..' . '/src/operation.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit670b295558ff8f00893eb22eb9bd7415::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit670b295558ff8f00893eb22eb9bd7415::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit670b295558ff8f00893eb22eb9bd7415::$classMap;

        }, null, ClassLoader::class);
    }
}
