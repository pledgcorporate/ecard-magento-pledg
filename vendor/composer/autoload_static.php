<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0289d8ca71919c5555329b5399a4d1c7
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit0289d8ca71919c5555329b5399a4d1c7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0289d8ca71919c5555329b5399a4d1c7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0289d8ca71919c5555329b5399a4d1c7::$classMap;

        }, null, ClassLoader::class);
    }
}
