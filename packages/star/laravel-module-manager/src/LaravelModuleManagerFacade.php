<?php

namespace Star\LaravelModuleManager;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Star\LaravelModuleManager\Skeleton\SkeletonClass
 */
class LaravelModuleManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-module-manager';
    }
}
