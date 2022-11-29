<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5bc995edefc3885e6427c17df05193a
{
    public static $files = array (
        'ca3a468b086a7962c18db2611e62957e' => __DIR__ . '/../..' . '/registration.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pledg\\PledgPaymentGateway\\' => 26,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pledg\\PledgPaymentGateway\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5bc995edefc3885e6427c17df05193a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5bc995edefc3885e6427c17df05193a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf5bc995edefc3885e6427c17df05193a::$classMap;

        }, null, ClassLoader::class);
    }
}
