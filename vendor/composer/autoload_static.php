<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit31c7558db6c17479b37f3e70d2e50de4
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit31c7558db6c17479b37f3e70d2e50de4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit31c7558db6c17479b37f3e70d2e50de4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}