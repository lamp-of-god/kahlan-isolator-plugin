<?php
namespace LampOfGod\Kahlan\Plugin;

use Kahlan\Jit\ClassLoader;
use LampOfGod\Kahlan\Jit\Patcher\Isolator as Patcher;

/**
 * Plugin that allows to isolate functions from given file.
 */
class Isolator
{
    /**
     * Performs functions isolation and requires them from given file.
     *
     * @param string $file   File path to isolate functions from.
     */
    public static function isolate($file)
    {
        $interceptor = ClassLoader::instance();
        $interceptor->patchers()->add('isolator', new Patcher());
        $interceptor->loadFile($file);
        $interceptor->patchers()->remove('isolator');
    }
}
