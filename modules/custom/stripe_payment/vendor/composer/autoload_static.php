<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c5c4f8918531c6bfca24d70f819f30f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c5c4f8918531c6bfca24d70f819f30f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c5c4f8918531c6bfca24d70f819f30f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
