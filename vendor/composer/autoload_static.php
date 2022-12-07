<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit926e54ece458da2458da70bc91802cee
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit926e54ece458da2458da70bc91802cee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit926e54ece458da2458da70bc91802cee::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit926e54ece458da2458da70bc91802cee::$classMap;

        }, null, ClassLoader::class);
    }
}
