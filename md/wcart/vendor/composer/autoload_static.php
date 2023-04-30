<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4069fead7580c8f24cf59798fb7d9ca6
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mohammad\\Wcart\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mohammad\\Wcart\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/md/wcart/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4069fead7580c8f24cf59798fb7d9ca6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4069fead7580c8f24cf59798fb7d9ca6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4069fead7580c8f24cf59798fb7d9ca6::$classMap;

        }, null, ClassLoader::class);
    }
}